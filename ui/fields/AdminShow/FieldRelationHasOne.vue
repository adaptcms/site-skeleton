<template>
  <div v-if="modelValue && labelField">
    <span class="block text-gray-500">
      {{ modelValue[labelField] }}
    </span>
  </div>
</template>

<script>
export default {
  props: [
    'value',
    'field',
    'model',
    'module',
    'action'
  ],

  computed: {
    modelValue () {
      return this.model[this.field.slug]
    }
  },

  data () {
    return {
      labelField: null
    }
  },

  mounted () {
    let relatedModule = this.modules.find(row => row.id === this.field.meta.related_module)

    this.labelField = relatedModule.primary_field.column_name
  }
}
</script>
