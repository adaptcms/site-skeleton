<template>
  <div>
    <h1 class="font-semibold text-3xl text-gray-700">
      {{ page.name }}
    </h1>

    <p>
      This is home!
    </p>
  </div>
</template>

<script>
import Layout from '@/Adaptcms/Site/ui/layouts/layout'

export default {
  layout: (h, page) => h(Layout, [ page ]),

  props: [
    'page'
  ]
}
</script>
