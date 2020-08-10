<template>
  <div class="fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end">
    <transition
      appear
      enter-active-class="transform ease-out duration-300 transition"
      enter-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
      enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
      leave-active-class="transition ease-in duration-100"
      leave-class="opacity-100"
      leave-to-class="opacity-0"
      @after-leave="dismiss"
    >
      <div
        v-if="show"
        class="mt-13 max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto"
      >
        <div class="rounded-lg shadow-xs overflow-hidden">
          <div class="p-4">
            <div class="flex items-center">
              <div class="w-0 flex-1 flex justify-between">
                <p class="w-0 flex-1 text-sm leading-5 font-medium text-gray-900">
                  {{ message }}
                </p>
              </div>

              <div class="ml-4 flex-shrink-0 flex">
                <button
                  class="inline-flex text-gray-400 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150"
                  @click="dismiss"
                >
                  <Icon
                    name="close"
                    class="h-5 w-5"
                  />
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
import Icon from '@/components/Icon';

export default {
  name: "Notification",
  components: { Icon },
  data() {
    return {
      show: false,
      message: '',
      timeout: null
    };
  },
  created() {
    EventBus.listen('notify', (message) => {
      this.show = true;
      this.message = message;
      this.timeout = setTimeout(() => (this.show = false), 5000);
    });
  },
  methods: {
    dismiss() {
      this.show = false;
      clearTimeout(this.timeout);
    }
  },
}
</script>
