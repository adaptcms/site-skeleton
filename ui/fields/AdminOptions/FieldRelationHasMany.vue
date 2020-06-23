<template>
  <div class="flex-col">
    <label for="form-related_module" class="text-lg font-normal text-gray-700 w-auto">
      Related Module
      <span class="text-sm text-red-500 font-bold">*</span>
    </label>

    <SelectField
      id="form-related_module"
      :errors="errors"
      v-model="related_module"
    >
      <template v-slot:options>
        <option
          v-for="row in modulesList"
          :key="`module-${row.id}`"
          :value="row.id"
        >
          {{ row.name }}
        </option>
      </template>
    </SelectField>
  </div>
</template>

<script>
import get from 'lodash.get'
import SelectField from '@/Adaptcms/Base/ui/components/Form/SelectField'

export default {
  props: [
    'value',
    'field',
    'module',
    'errors'
  ],

  components: {
    SelectField
  },

  watch: {
    value (newVal, oldVal) {
      if ((newVal !== oldVal) && get(newVal, 'related_module', null)) {
        this.related_module = newVal.related_module
      }
    },

    related_module (newVal, oldVal) {
      if (newVal !== oldVal) {
        this.$emit('input', { related_module: newVal })

        let relatedModule = this.modulesList.find(row => {
          return row.id === newVal
        })

        this.$emit('name', `${relatedModule.name} Id`)
      }
    }
  },

  computed: {
    modulesList () {
      return this.modules.filter(module => {
        return module.id !== this.module.id
      })
    }
  },

  data () {
    return {
      related_module: null
    }
  },

  mounted () {
    if (!this.related_module && get(this.value, 'related_module', null)) {
      this.related_module = this.value.related_module
    }
  }
}
</script>
