<template>
  <div class="flex flex-col">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
      <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
          <thead>
            <tr>
              <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Original URL
              </th>

              <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Shortened URL
              </th>

              <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                # of Visits
              </th>

              <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Shortened On
              </th>
              <th class="px-11 py-3 bg-gray-50 text-center" />
            </tr>
          </thead>
          <tbody>
            <tr v-if="urls.length === 0">
              <td
                class="text-center text-gray-500 border-t py-3"
                colspan="5"
              >
                You haven't shortened any URLs yet.
              </td>
            </tr>
            <tr
              v-for="(url, index) in urls"
              :key="url.id"
              :class="{ 'bg-white': index % 2 === 0, 'bg-gray-50': index % 2 === 1 }"
            >
              <td
                class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900"
                v-text="url.original_url"
              />

              <td class="flex px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium">
                <a
                  :href="url.redirect_path"
                  target="_blank"
                  class="flex"
                >
                  <span class="mr-3 text-gray-500 hover:text-gray-900">
                    <icon
                      name="external-link"
                      class="h-5 w-5"
                    />
                  </span>
                </a>

                <span
                  class="text-green-500 hover:text-green-900 cursor-pointer js-copy-to-clipboard"
                  v-text="url.shortened_url"
                />

                <span class="hidden">{{ url.redirect_path }}</span>
              </td>

              <td
                class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500"
                v-text="url.visits"
              />

              <td
                class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500"
                v-text="url.created_at"
              />

              <td class="px-6 py-4 whitespace-no-wrap">
                <div class="flex space-x-3 md:space-x-6">
                  <a
                    href="#"
                    class="text-indigo-600 hover:text-indigo-900"
                    title="Edit"
                  >
                    <icon
                      name="pencil-alt"
                      class="h-5 w-5"
                    />
                  </a>

                  <a
                    href="#"
                    class="text-red-600 hover:text-red-900"
                    title="Delete"
                    @click.prevent="$emit('delete', url)"
                  >
                    <icon
                      name="trash"
                      class="h-5 w-5"
                    />
                  </a>
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <slot name="pagination" />
      </div>
    </div>
  </div>
</template>

<script>
import Icon from './Icon';
import ClipboardJS from 'clipboard';

export default {
  name: "UrlsList",
  components: { Icon },
  props: {
    urls: {
      type: Array,
      default() {
        return [];
      }
    }
  },
  data() {
    return {
      clipboard: null,
      copied: false
    };
  },
  mounted() {
    this.clipboard = new ClipboardJS('.js-copy-to-clipboard', {
      text: function(trigger) {
        return trigger.nextElementSibling.innerHTML;
      }
    });
  },
  beforeDestroy() {
    this.clipboard.destroy();
  },
}
</script>
