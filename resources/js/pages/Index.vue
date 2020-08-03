<template>
  <content-section title="Shorten Your URLs!">
    <div class="md:grid md:grid-cols-3 md:gap-6">
      <div class="md:col-span-1">
        <div class="px-4 sm:px-0">
          <h3 class="text-lg font-medium leading-6 text-gray-900">
            Create Click-Worthy Links
          </h3>
          <p class="mt-1 text-sm leading-5 text-gray-600">
            Build and protect your brand using powerful, recognizable short links.
          </p>
        </div>
      </div>
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form @submit.prevent="submit">
          <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="px-4 py-5 bg-white sm:p-6 space-y-6">
              <div class="grid grid-cols-3 gap-6">
                <div class="col-span-3 sm:col-span-2">
                  <label
                    for="original_url"
                    class="block text-sm font-medium leading-5 text-gray-700"
                  >Website URL</label>

                  <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                      <svg
                        class="h-5 w-5 text-gray-400"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                      ><path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>

                    <input
                      id="original_url"
                      class="form-input block w-full pl-10 sm:text-sm sm:leading-5"
                      placeholder="http://example.com"
                    >
                  </div>
                </div>
              </div>
            </div>

            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
              <span class="inline-flex rounded-md shadow-sm">
                <button
                  type="submit"
                  class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out"
                >Shorten</button>
              </span>
            </div>
          </div>
        </form>
      </div>
    </div>
  </content-section>
</template>

<script>
import ContentSection from '../components/ContentSection';

export default {
  name: "IndexPage",
  metaInfo: { title: 'Dashboard' },
  components: { ContentSection },
  methods: {
    submit() {
      console.log('submitted')
    }
  }
}
</script>
