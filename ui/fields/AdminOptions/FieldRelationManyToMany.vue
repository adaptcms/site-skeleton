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
      if ((newVal !== oldVal)) {
        if (get(newVal, 'related_module', null)) {
          this.related_module = newVal.related_module
        }

        if (get(newVal, 'join_table', null)) {
          this.join_table = newVal.join_table
        }
      }
    },

    related_module (newVal, oldVal) {
      if (newVal !== oldVal) {
        let relatedModule = this.modulesList.find(row => {
          return row.id === newVal
        })

        this.join_table = `${this.module.slug}_${relatedModule.slug}`

        this.$emit('name', `${relatedModule.name} Id`)
      }
    },

    join_table (newVal, oldVal) {
      if (newVal !== oldVal) {
        this.$emit('input', {
          join_table: newVal,
          related_module: this.related_module,
          parent_module: this.module.id
        })
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
      related_module: null,
      join_table: null
    }
  },

  mounted () {
    if (!this.related_module && get(this.value, 'related_module', null)) {
      this.related_module = this.value.related_module
    }

    if (!this.join_table && get(this.value, 'join_table', null)) {
      this.join_table = this.value.join_table
    }
  }
}
</script>
