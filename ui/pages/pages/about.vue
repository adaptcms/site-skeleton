<template>
  <div>
    <h1 class="font-semibold text-3xl text-gray-700">
      {{ page.name }}
    </h1>

    <!-- Put page contents here -->
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
