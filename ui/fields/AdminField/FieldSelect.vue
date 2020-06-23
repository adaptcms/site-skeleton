<template>
  <SelectField
    v-if="field.meta && field.meta.options"
    :id="`form-${field.column_name}`"
    :fieldName="field.column_name"
    :errors="errors"
    v-model="selected"
  >
    <template v-slot:options>
      <option
        v-for="option in options"
        :key="`option-${option}`"
        :value="option"
      >
        {{ option }}
      </option>
    </template>
  </SelectField>
</template>

<script>
import get from 'lodash.get'
import SelectField from '@/Adaptcms/Base/ui/components/Form/SelectField'

export default {
  props: [
    'value',
    'field',
    'errors',
    'formMeta',
    'model',
    'module',
    'action'
  ],

  components: {
    SelectField
  },

  watch: {
    value (newVal, oldVal) {
      if (newVal !== oldVal) {
        this.selected = newVal
      }
    },

    selected (newVal, oldVal) {
      if (newVal !== oldVal) {
        this.$emit('input', newVal)
      }
    }
  },

  computed: {
    options () {
      let options = get(this.field, 'meta.options', null)

      if (options) {
        options = options.split(',')
      }

      return options
    }
  },

  data () {
    return {
      selected: null
    }
  },

  mounted () {
    if (!this.selected) {
      this.selected = this.value
    }
  }
}
</script>
