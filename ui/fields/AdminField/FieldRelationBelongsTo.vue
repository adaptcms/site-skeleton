<template>
  <SelectField
    v-if="options.length"
    :id="`form-${field.column_name}`"
    :fieldName="field.column_name"
    :errors="errors"
    v-model="selected"
  >
    <template v-slot:options>
      <option
        v-for="row in options"
        :key="`option-${row.id}`"
        :value="row.id"
      >
        {{ row.label }}
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
      return get(this.formMeta, this.field.column_name, [])
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
