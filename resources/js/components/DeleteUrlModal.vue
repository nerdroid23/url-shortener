<template>
  <transition
    leave-active-class="ease-in duration-200"
    leave-class="opacity-100"
    leave-to-class="opacity-0"
    @after-leave="dismiss"
  >
    <div
      v-if="visible"
      class="fixed bottom-0 inset-x-0 px-4 pb-4 sm:inset-0 sm:flex sm:items-center sm:justify-center"
    >
      <transition
        appear
        enter-active-class="ease-out duration-300"
        enter-class="opacity-0"
        enter-to-class="opacity-100"
      >
        <div class="fixed inset-0 transition-opacity">
          <div class="absolute inset-0 bg-gray-500 opacity-75" />
        </div>
      </transition>

      <transition
        appear
        enter-active-class="ease-out duration-300"
        enter-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        enter-to-class="opacity-100 translate-y-0 sm:scale-100"
        leave-active-class="ease-in duration-200"
        leave-class="opacity-100 translate-y-0 sm:scale-100"
        leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
      >
        <div
          class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full"
          role="dialog"
          aria-modal="true"
          aria-labelledby="modal-headline"
        >
          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
              <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                <Icon
                  name="dangerous"
                  class="h-6 w-6 text-red-600"
                />
              </div>
              <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3
                  id="modal-headline"
                  class="text-lg leading-6 font-medium text-gray-900"
                >
                  Delete URL
                </h3>

                <div class="mt-2">
                  <p class="text-sm leading-5 text-gray-500">
                    Are you sure you want to delete this URL? This action cannot be undone.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
              <button
                type="button"
                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                @click="destroy"
              >Yes</button>
            </span>

            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
              <button
                type="button"
                class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                @click="dismiss"
              >Cancel</button>
            </span>
          </div>
        </div>
      </transition>
    </div>
  </transition>
</template>

<script>
import Icon from '@/components/Icon';

export default {
  name: "DeleteUrlModal",
  components: { Icon },
  data() {
    return {
      visible: false,
      urlToDelete: {},
    }
  },
  mounted() {
    EventBus.listen('delete-url', (url) => {
      this.visible = true;
      this.urlToDelete = url;
    });
  },
  methods: {
    dismiss() {
      this.visible = false;
      this.$nextTick(() => {
        this.urlToDelete = {};
      });
    },
    destroy() {
      axios
        .delete(this.route('urls.destroy', this.urlToDelete.shortened_url).url())
        .then(() => {
          this.dismiss();
          EventBus.fire('deleted-url', this.urlToDelete);
          EventBus.fire('notify', 'URL deleted successfully!');
        });
    },
  },
}
</script>
