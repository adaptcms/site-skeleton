<template>
  <quill-editor
    :id="`form-${field.column_name}`"
    class="text-base block mt-1 w-full h-48 mb-12"
    v-model="selected"
    :options="editorOptions"
  />
</template>

<script>
import 'quill/dist/quill.snow.css'
import { quillEditor } from 'vue-quill-editor'

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
    quillEditor
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

  data () {
    return {
      selected: null,
      editorOptions: {
        theme: 'snow',
        modules: {
          toolbar: [
            [ 'bold', 'italic', 'underline', 'strike' ],
            [ 'blockquote', 'code-block' ]
          ]
        }
      }
    }
  },

  mounted () {
    if (!this.selected) {
      this.selected = this.value
    }
  }
}
</script>
