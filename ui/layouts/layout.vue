<template>
  <div id="app" class="app h-screen">
    <nav class="flex items-center justify-between flex-wrap bg-blue-700 py-2 lg:sticky top-0 z-50">
      <div class="container mx-auto flex flex-wrap">
        <div class="flex items-center flex-shrink-0 text-white mr-6 h-12">
          <a :href="$route('home')">
            <img class="flex items-center h-12" src="/img/AdaptCMSLogoPNG_2.png" alt="AdaptCMS" />
          </a>
        </div>
        <div class="block my-auto ml-auto lg:hidden">
          <button id="toggle-menu" class="flex items-center px-3 py-2 border rounded text-white border-white hover:text-white hover:border-white">
            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <title>Menu</title>
              <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
            </svg>
          </button>
        </div>

        <div id="menu" class="w-full block flex-grow flex-wrap lg:flex lg:items-center lg:text-right lg:w-auto hidden">
          <ul class="text-sm lg:flex-grow lg:pr-5">
            <li class="block mt-6 lg:inline-block lg:mt-0 text-teal-200 hover:text-white lg:mr-6">
              <a :href="$route('home')" class="font-semibold lg:font-normal">
                Home
              </a>
            </li>

            <li
              v-for="module in modules"
              :key="`module-${module.slug}`"
              class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white lg:mr-6"
            >
              <a :href="$route('modules.custom.index', { module: module.route_key })">
                {{ module.name }}
              </a>
            </li>

            <li
              v-for="page in customPages"
              :key="`page-${page.slug}`"
              class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white lg:mr-6"
            >
              <a :href="$route(`pages.show.${page.slug}`)" class="font-semibold lg:font-normal">
                {{ page.name }}
              </a>
            </li>

            <li
              v-if="!user"
              class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white"
            >
              <a :href="$route('login')" class="font-semibold lg:font-normal">
                Login
              </a>
            </li>
          </ul>

          <div v-if="user">
            <a
              :href="$route('logout')"
              class="inline-block text-sm px-4 py-2 leading-none border rounded-full text-black bg-white border-white hover:border-transparent hover:text-white hover:bg-black mt-4 lg:mt-0"
            >
              Logout
            </a>
          </div>

          <div v-else>
            <a
              :href="$route('register')"
              class="inline-block text-sm px-4 py-2 leading-none border rounded-full text-black bg-white border-white hover:border-transparent hover:text-white hover:bg-black mt-4 lg:mt-0"
            >
              Register
            </a>
          </div>
        </div>
      </div>
    </nav>

    <div class="content h-auto py-6 px-64">
      <template v-if="flashMessage">
        <div
          class="w-64 fixed right-0 top-0 p-4 text-sm shadow text-white bg-green-500 border border-green-700 text-green-100 rounded mr-4 mt-4 z-50 text-sm text-center"
        >
          {{ flashMessage }}
        </div>
      </template>

      <slot />
    </div>

    <div class="top-divider w-full"></div>

    <footer class="bg-black pt-8 pb-12 w-full bottom-0">
      <div class="container mx-auto">
        <div class="w-full h-auto text-center pt-5">
          <p class="mb-5 text-xs text-gray-100">
            <a href="#">Privacy Policy</a> | <a href="#">Terms and Conditions</a>
          </p>
          <p class="text-xs text-gray-100">
            &copy; Copyright 2020 <a class="underline" href="https://www.adaptcms.com" target="_blank">AdaptCMS</a>.
            All Rights Reserved.
          </p>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
import { get } from 'lodash'

export default {
  props: {
    title: String
  },

  watch: {
    flashMessage (newVal, oldVal) {
      if (newVal && (newVal !== oldVal)) {
        setTimeout(() => {
          this.$set(this.$page, 'flash', {
            message: null
          })
        }, 2500)
      }
    }
  },

  computed: {
    user () {
      return get(this.$page, 'auth.user', null)
    },

    flashMessage () {
      return get(this.$page, 'flash.message', null)
    },

    pages () {
      return get(this.$page, 'pages', null)
    },

    customPages () {
      return this.pages.filter(page => page.slug !== 'home')
    }
  },

  data () {
    return {
      errors: {},
      notification: {
        enabled: false,
        type: 'success',
        message: null
      }
    }
  },

  methods: {
    //
  }
}
</script>
