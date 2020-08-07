<template>
  <nav
    v-if="hasMoreThanOnePage"
    class="border-t border-gray-200 px-4 flex items-center justify-between sm:px-0"
  >
    <div class="w-0 flex-1 flex">
      <router-link
        v-if="prevPage.url"
        :to="prevPage.url"
        class="-mt-px border-t-2 border-transparent py-4 pl-4 pr-1 inline-flex items-center text-sm leading-5 font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-400 transition ease-in-out duration-150"
      >
        <svg
          class="mr-3 h-5 w-5 text-gray-400"
          viewBox="0 0 20 20"
          fill="currentColor"
        >
          <path
            fill-rule="evenodd"
            d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
            clip-rule="evenodd"
          />
        </svg>
        {{ prevPage.label }}
      </router-link>
    </div>

    <div class="hidden md:flex">
      <template v-for="(link, key) in links">
        <router-link
          v-if="isNotPrevOrNextPage(link.label)"
          :key="key"
          :to="{ name: 'dashboard', query:{ page: link.label } }"
          :class="{
            'border-indigo-500 text-indigo-600 focus:text-indigo-800 focus:border-indigo-700': link.active,
            'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:text-gray-700 focus:border-gray-400': !link.active
          }"
          class="-mt-px border-t-2 py-4 px-4 inline-flex items-center text-sm leading-5 font-medium focus:outline-none transition ease-in-out duration-150"
        >
          {{ link.label }}
        </router-link>
      </template>
    </div>

    <div class="w-0 flex-1 flex justify-end">
      <router-link
        v-if="nextPage.url"
        :to="nextPage.url"
        class="-mt-px border-t-2 border-transparent py-4 pr-4 pl-1 inline-flex items-center text-sm leading-5 font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-400 transition ease-in-out duration-150"
      >
        {{ nextPage.label }}
        <svg
          class="ml-3 h-5 w-5 text-gray-400"
          viewBox="0 0 20 20"
          fill="currentColor"
        >
          <path
            fill-rule="evenodd"
            d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
            clip-rule="evenodd"
          />
        </svg>
      </router-link>
    </div>
  </nav>
</template>

<script>
export default {
  name: "Pagination",
  props: {
    links: {
      type: Array,
      default() {
        return []
      }
    }
  },
  computed: {
    hasMoreThanOnePage() {
      return this.links.length > 3;
    },
    prevPage() {
      return this.links[0];
    },
    nextPage() {
      return this.links[this.links.length - 1];
    },
  },
  methods: {
    isNotPrevOrNextPage(label) {
      return typeof label !== 'string';
    }
  },
}
</script>
