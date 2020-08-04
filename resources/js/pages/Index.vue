<template>
  <base-layout>
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
        <form
          @submit.prevent="store"
          @keydown="form.errors.clear($event.target.id)"
        >
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
                  type="submit"
                  class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out"
                >Shorten</button>
              </span>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div
      v-if="urls.length"
      class="mt-10"
    >
      <urls-list
        :urls="urls"
        @delete="confirmDelete"
      />
    </div>

    <portal selector="#portal-target">
      <modal
        v-if="showModal"
        :show="showModal"
        title="Delete URL"
        body="Are you sure you want to delete this URL? This action cannot be undone."
        confirm-button="Yes"
        cancel-button="Cancel"
        @cancel="toggleModal"
        @confirm="destroy"
      />
    </portal>
  </base-layout>
</template>

<script>
import UrlsList from '../components/UrlsList';
import Modal from '../components/Modal';
import { Portal } from '@linusborg/vue-simple-portal';
import BaseLayout from '../layouts/BaseLayout';
import Form from 'form-backend-validation';
import Icon from '../components/Icon';

export default {
  name: "IndexPage",
  metaInfo: { title: 'Dashboard' },
  components: { Icon, BaseLayout, Portal, Modal, UrlsList },
  data() {
    return {
      form: new Form({ original_url: '' }),
      urls: [],
      success: null,
      showModal: false,
      urlToDelete: {},
    }
  },
  mounted() {
    this.fetchUrls();
  },
  methods: {
    confirmDelete(item) {
      this.toggleModal();
      this.urlToDelete = item;
    },
    destroy() {
      this.form
        .delete(this.route('urls.destroy', this.urlToDelete.shortened_url).url())
        .then(() => this.urls = this.urls.filter(url => url.id !== this.urlToDelete.id))
        .finally(() => this.urlToDelete = {});

      this.toggleModal();
    },
    fetchUrls() {
      window.axios
        .get(this.route('urls.index').url())
        .then(response => this.urls = response.data);
    },
    flashSuccess() {
      this.success = this.form.successful;
      setTimeout(() => this.success = !this.success, 3000);
    },
    reset() {
      this.form.reset();
      this.form.errors.clear();
    },
    store() {
      if (this.form.processing || this.form.original_url === '') {
        return;
      }

      this.form
        .post(this.route('urls.store').url())
        .then((data) => {
          this.reset();
          this.urls.unshift(data);
          this.flashSuccess();
        });
    },
    toggleModal() {
      this.showModal = !this.showModal;
    },
  }
}
</script>
