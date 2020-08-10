<template>
  <transition
    leave-active-class="ease-in-out duration-500"
    leave-class="opacity-100"
    leave-to-class="opacity-0"
  >
    <div
      v-if="overlayVisible"
      class="fixed inset-0 overflow-hidden"
    >
      <div class="absolute inset-0 overflow-hidden">
        <transition
          appear
          enter-active-class="ease-in-out duration-500"
          enter-class="opacity-0"
          enter-to-class="opacity-100"
        >
          <div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
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
            @before-leave="overlayVisible = false"
          >
            <div
              v-if="panelVisible"
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

                  <form
                    @submit.prevent="submit"
                    @keydown="form.errors.clear($event.target.id)"
                  >
                    <div class="flex-1 flex flex-col justify-between">
                      <div class="px-4 divide-y divide-gray-200 sm:px-6">
                        <div class="space-y-6 pt-6 pb-5">
                          <div class="space-y-1">
                            <label
                              for="title"
                              class="block text-sm font-medium leading-5 text-gray-900"
                            >
                              Title
                            </label>

                            <div class="relative rounded-md shadow-sm">
                              <input
                                id="title"
                                v-model="form.title"
                                :class="{ 'border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red': form.errors.has('title') }"
                                class="form-input block w-full sm:text-sm sm:leading-5 transition ease-in-out duration-150"
                              >
                            </div>

                            <p
                              v-if="form.errors.has('title')"
                              class="mt-2 text-sm text-red-600"
                              v-text="form.getError('title')"
                            />
                          </div>
                          <div class="space-y-1">
                            <label
                              for="original_url"
                              class="block text-sm font-medium leading-5 text-gray-900"
                            >
                              Website URL
                            </label>

                            <div class="relative rounded-md shadow-sm">
                              <input
                                id="original_url"
                                v-model="form.original_url"
                                :class="{ 'border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red': form.errors.has('original_url') }"
                                class="form-input block w-full sm:text-sm sm:leading-5 transition ease-in-out duration-150"
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
                    </div>
                  </form>
                </div>

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
                      :disabled="form.processing"
                      type="submit"
                      class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out"
                      @click="submit"
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
  </transition>
</template>

<script>
import Icon from '@/components/Icon';
import Form from 'form-backend-validation';

export default {
  name: "CreateUrlPanel",
  components: { Icon },
  data() {
    return {
      panelVisible: false,
      overlayVisible: false,
      form: new Form({
        original_url: '',
        title: '',
      }),
    };
  },
  mounted() {
    EventBus.listen('open-create-panel', () => (this.overlayVisible = this.panelVisible = true));
  },
  methods: {
    dismiss() {
      this.panelVisible = false;
      this.form.clear();
    },
    submit() {
      this.form
        .post(this.route('urls.store').url())
        .then(() => {
          this.dismiss();
          EventBus.fire('created-url');
          EventBus.fire('notify', 'URL created successfully!');
        });
    }
  },
}
</script>
