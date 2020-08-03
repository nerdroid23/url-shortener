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
                class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500"
                v-text="url.created_at"
              />

              <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                <div class="flex justify-between">
                  <a
                    href="#"
                    class="text-indigo-600 hover:text-indigo-900"
                    title="Edit"
                  >
                    <svg
                      class="h-5 w-5"
                      fill="none"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    ><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                  </a>

                  <a
                    href="#"
                    class="text-red-600 hover:text-red-900"
                    title="Delete"
                  >
                    <svg
                      class="h-5 w-5"
                      fill="none"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    ><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                  </a>
                </div>
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
}
</script>
