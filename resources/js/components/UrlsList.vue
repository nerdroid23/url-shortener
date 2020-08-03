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
                Status
              </th>
              <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                # Of Visits
              </th>
              <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Shortened On
              </th>
              <th class="px-6 py-3 bg-gray-50" />
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(url, index) in urls"
              :key="url.id"
              :class="{ 'bg-white': index % 2 === 0, 'bg-gray-50': index % 2 === 1 }"
            >
              <td
                class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900"
                v-text="url.original_url"
              />

              <td
                class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500"
                v-text="url.shortened_url"
              />

              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                  Active
                </span>
              </td>

              <td
                class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center"
                v-text="url.visits"
              />

              <td
                class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500"
                v-text="formatDate(url.created_at)"
              />

              <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                <a
                  href="#"
                  class="text-indigo-600 hover:text-indigo-900"
                >Edit</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "UrlsList",
  props: {
    urls: {
      type: Array,
      default() {
        return []
      }
    }
  },
  methods: {
    formatDate(date) {
      const options = { year: 'numeric', month: 'long', day: 'numeric' };
      return (new Date(date)).toLocaleDateString('en-US', options);
    }
  },
}
</script>
