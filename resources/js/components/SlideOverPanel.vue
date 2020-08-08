<template>
  <div class="fixed inset-0 overflow-hidden">
    <div class="absolute inset-0 overflow-hidden">
      <transition
        appear
        enter-active-class="ease-in-out duration-500"
        enter-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="ease-in-out duration-500"
        leave-class="opacity-100"
        leave-to-class="opacity-0"
      >
        <div
          v-if="visible"
          class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
        />
      </transition>

      <section class="absolute inset-y-0 pl-16 max-w-full right-0 flex">
        <transition
          appear
          enter-active-class="transform transition ease-in-out duration-500 sm:duration-700"
          enter-class="translate-x-full"
          enter-to-class="translate-x-0"
          leave-active-class="transform transition ease-in-out duration-500 sm:duration-700"
          leave-class="translate-x-0"
          leave-to-class="translate-x-full"
          @after-leave="$emit('closepanel')"
        >
          <div
            v-if="visible"
            class="w-screen max-w-md"
          >
            <div class="h-full divide-y divide-gray-200 flex flex-col bg-white shadow-xl">
              <div class="flex-1 h-0 overflow-y-auto">
                <header class="space-y-1 py-6 px-4 bg-indigo-700 sm:px-6">
                  <div class="flex items-center justify-between space-x-3">
                    <h2 class="text-lg leading-7 font-medium text-white">
                      New Url
                    </h2>
                    <div class="h-7 flex items-center">
                      <button
                        aria-label="Close panel"
                        class="text-indigo-200 hover:text-white transition ease-in-out duration-150"
                        @click="dismiss"
                      >
                        <Icon
                          name="close"
                          class="h-6 w-6"
                        />
                      </button>
                    </div>
                  </div>
                  <div>
                    <p class="text-sm leading-5 text-indigo-300">
                      Build and protect your brand using powerful, recognizable short links.
                    </p>
                  </div>
                </header>

                <div class="flex-1 flex flex-col justify-between">
                  <div class="px-4 divide-y divide-gray-200 sm:px-6">
                    <div class="space-y-6 pt-6 pb-5">
                      <div class="space-y-1">
                        <label
                          for="project_name"
                          class="block text-sm font-medium leading-5 text-gray-900"
                        >
                          Title
                        </label>
                        <div class="relative rounded-md shadow-sm">
                          <input
                            id="project_name"
                            class="form-input block w-full sm:text-sm sm:leading-5 transition ease-in-out duration-150"
                          >
                        </div>
                      </div>
                      <div class="space-y-1">
                        <label
                          for="description"
                          class="block text-sm font-medium leading-5 text-gray-900"
                        >
                          Website URL
                        </label>
                        <div class="relative rounded-md shadow-sm">
                          <input
                            id="description"
                            class="form-input block w-full sm:text-sm sm:leading-5 transition ease-in-out duration-150"
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!--<form
      @submit.prevent="store"
      @keydown="form.errors.clear($event.target.id)"
    >
      <div class="shadow sm:rounded-md sm:overflow-hidden">
        <div class="px-4 py-5 bg-white sm:p-6 space-y-6">
          <div class="grid grid-cols-3 gap-6">
            <div class="col-span-3 sm:col-span-2">
              <label
                for="title"
                class="block text-sm font-medium leading-5 text-gray-700"
              >Title</label>

              <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <icon
                    name="document-add"
                    class="h-5 w-5 text-gray-400"
                  />
                </div>

                <input
                  id="title"
                  v-model="form.title"
                  :class="{ 'border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red': form.errors.has('title') }"
                  class="form-input block w-full pl-10 sm:text-sm sm:leading-5"
                  placeholder="🔥 youtube video i saw today"
                  required
                >
              </div>

              <p
                v-if="form.errors.has('title')"
                class="mt-2 text-sm text-red-600"
                v-text="form.getError('title')"
              />
            </div>

            <div class="col-span-3 sm:col-span-2">
              <label
                for="original_url"
                class="block text-sm font-medium leading-5 text-gray-700"
              >Website URL</label>

              <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <icon
                    name="globe"
                    class="h-5 w-5 text-gray-400"
                  />
                </div>

                <input
                  id="original_url"
                  v-model="form.original_url"
                  :class="{ 'border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red': form.errors.has('original_url') }"
                  class="form-input block w-full pl-10 sm:text-sm sm:leading-5"
                  placeholder="http://example.com"
                  required
                >
              </div>

              <p
                v-if="form.errors.has('original_url')"
                class="mt-2 text-sm text-red-600"
                v-text="form.getError('original_url')"
              />
            </div>
          </div>
        </div>

        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
          <span
            v-if="success"
            class="animate-pulse text-green-500 mr-5"
          >Success!</span>

          <span class="inline-flex rounded-md shadow-sm">
            <button
              :disabled="form.processing"
              type="submit"
              class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out"
            >Shorten</button>
          </span>
        </div>
      </div>
    </form>-->

              <div class="flex-shrink-0 px-4 py-4 space-x-4 flex justify-end">
                <span class="inline-flex rounded-md shadow-sm">
                  <button
                    type="button"
                    class="py-2 px-4 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out"
                    @click="dismiss"
                  >
                    Cancel
                  </button>
                </span>
                <span class="inline-flex rounded-md shadow-sm">
                  <button
                    type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out"
                  >
                    Shorten
                  </button>
                </span>
              </div>
            </div>
          </div>
        </transition>
      </section>
    </div>
  </div>
</template>

<script>
import Icon from './Icon';
export default {
  name: "SlideOverPanel",
  components: { Icon },
  props: ['show'],
  data() {
    return {
      visible: this.show,
    };
  },
  methods: {
    dismiss() {
      this.visible = false;
    }
  },
}
</script>
