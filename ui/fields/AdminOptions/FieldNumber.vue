<template>
  <div class="flex-col">
    <div class="w-full mb-2">
      <label for="form-min" class="text-lg font-normal text-gray-700 w-auto">
        Minimum Value
      </label>

      <input
        type="text"
        id="form-min"
        class="text-base py-3 px-3 shadow-sm block mt-1 border w-full"
        v-model="selected.min"
      />
    </div>

    <div class="w-full mb-2">
      <label for="form-max" class="text-lg font-normal text-gray-700 w-auto">
        Maximum Value
      </label>

      <input
        type="text"
        id="form-max"
        class="text-base py-3 px-3 shadow-sm block mt-1 border w-full"
        v-model="selected.max"
      />
    </div>

    <div class="w-full">
      <label for="form-step" class="text-lg font-normal text-gray-700 w-auto">
        Step Value
        <span class="text-xs text-gray-500">
          (increment amount, ex. 0.01 pressing up becomes 0.02, 0.03, etc.)
        </span>
      </label>

      <input
        type="text"
        id="form-step"
        class="text-base py-3 px-3 shadow-sm block mt-1 border w-full"
        v-model="selected.step"
      />
    </div>
  </div>
</template>

<script>
import isEmpty from 'lodash.isempty'

export default {
  props: [
    'value',
    'field',
    'module',
    'errors'
  ],

  watch: {
    value (newVal, oldVal) {
      if (newVal !== oldVal) {
        this.selected = newVal
      }
    },

    selected: {
      handler: function (newVal, oldVal) {
        this.$emit('input', newVal)
      },
      deep: true
    }
  },

  data () {
    return {
      selected: {
        min: null,
        max: null,
        step: null
      }
    }
  },

  mounted () {
    if (!isEmpty(this.value)) {
      this.selected = this.value
    }
  }
}
</script>
