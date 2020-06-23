<template>
  <div v-if="labelField">
    <div
      v-for="item in value"
      :key="`item-${item.id}`"
      class="text-gray-500"
    >
      <span>{{ item[labelField] }}</span>
    </div>
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
