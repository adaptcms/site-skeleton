<template>
  <Multiselect
    v-if="optionsList.length"
    :id="`form-${field.column_name}`"
    :fieldName="field.column_name"
    :errors="errors"
    :options="optionsList"
    :value="selected"
    @input="update"
  />
</template>

<script>
import get from 'lodash.get'
import Multiselect from '@/Adaptcms/Base/ui/components/Form/Multiselect'

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
    Multiselect
  },

  computed: {
    options () {
      return get(this.formMeta, this.field.column_name, [])
    },

    optionsList () {
      return this.options.map(row => {
        return row.label
      })
    }
  },

  data () {
    return {
      selected: []
    }
  },

  methods: {
    update (newVal) {
      let values = this.options.filter(row => newVal.indexOf(row.label) !== -1)

      values = values.map(row => row.id)

      this.$emit('input', values)
    }
  },

  mounted () {
    if (!this.selected.length && this.value) {
      let relatedModule = this.modules.find(row => row.id === this.field.meta.related_module)

      this.selected = this.value.map(row => row[relatedModule.primary_field.column_name])
    }
  }
}
</script>
