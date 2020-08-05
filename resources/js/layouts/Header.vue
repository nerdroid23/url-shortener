<template>
  <nav
    x-data="{ open: false }"
    class="bg-white shadow-sm"
  >
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        <div class="flex">
          <div class="flex-shrink-0 flex items-center">
            <img
              class="block lg:hidden h-8 w-auto"
              src="https://tailwindui.com/img/logos/workflow-mark-on-white.svg"
              alt="Workflow logo"
            >
            <img
              class="hidden lg:block h-8 w-auto"
              src="https://tailwindui.com/img/logos/workflow-logo-on-white.svg"
              alt="Workflow logo"
            >
          </div>
        </div>

        <div
          v-if="loggedIn"
          class="hidden sm:ml-6 sm:flex space-x-3"
        >
          <p class="inline-flex items-center px-1 pt-0.5 text-sm font-medium leading-5 text-gray-800">
            Hi, {{ user.name }}
          </p>

          <a
            href="#"
            class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
            @click.prevent="logout"
          >Logout</a>
        </div>
        <div
          v-else
          class="hidden sm:ml-6 sm:flex space-x-3"
        >
          <router-link
            :to="{ name: 'login' }"
            class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
          >
            Login
          </router-link>

          <router-link
            :to="{ name: 'register' }"
            class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
          >
            Register
          </router-link>
        </div>

        <div class="-mr-2 flex items-center sm:hidden">
          <button
            x-on:click="open = !open"
            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
          >
            <svg
              x-bind:class="{ 'hidden': open, 'block': !open }"
              class="block h-6 w-6"
              stroke="currentColor"
              fill="none"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"
              />
            </svg>

            <svg
              x-bind:class="{ 'block': open, 'hidden': !open }"
              class="hidden h-6 w-6"
              stroke="currentColor"
              fill="none"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12"
              />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <div
      x-bind:class="{ 'block': open, 'hidden': !open }"
      class="hidden sm:hidden"
    >
      <div class="pb-3 border-t border-gray-200">
        <div
          v-if="loggedIn"
          class="mt-3 space-y-1"
          role="menu"
          aria-orientation="vertical"
          aria-labelledby="user-menu"
        >
          <p class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 ">
            Hi, {{ user.name }}
          </p>

          <a
            href="#"
            class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-gray-800 focus:bg-gray-100 transition duration-150 ease-in-out"
            role="menuitem"
            @click.prevent="logout"
          >Logout</a>
        </div>
        <div
          v-else
          class="mt-3 space-y-1"
          role="menu"
          aria-orientation="vertical"
          aria-labelledby="user-menu"
        >
          <router-link
            :to="{ name: 'login' }"
            class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-gray-800 focus:bg-gray-100 transition duration-150 ease-in-out"
            role="menuitem"
          >
            Login
          </router-link>

          <router-link
            :to="{ name: 'register' }"
            class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-gray-800 focus:bg-gray-100 transition duration-150 ease-in-out"
            role="menuitem"
          >
            Register
          </router-link>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: "Header",
  data() {
    return {
      loggedIn: window.loggedIn,
      user: window.user,
    };
  },
  methods: {
    logout() {
      window.axios
        .post(this.route('logout').url())
        .then(() => (window.location = '/login'));
    }
  },
}
</script>
