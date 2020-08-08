<template>
  <BaseLayout>
    <div class="md:flex md:items-center md:justify-between">
      <div class="flex-1 min-w-0">
        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
          Create Click-Worthy Links
        </h2>
      </div>
      <div class="mt-4 flex md:mt-0 md:ml-4">
        <span class="ml-3 shadow-sm rounded-md">
          <button
            type="button"
            class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:shadow-outline-indigo focus:border-indigo-700 active:bg-indigo-700 transition duration-150 ease-in-out"
            @click="togglePanel"
          >
            New
          </button>
        </span>
      </div>
    </div>

    <div class="mt-10">
      <UrlsList
        :urls="urls.data"
        @delete="confirmDelete"
      >
        <template v-slot:pagination>
          <Pagination :links="urls.links" />
        </template>
      </UrlsList>
    </div>

    <Portal selector="#portal-target">
      <Modal
        v-if="showModal"
        :show="showModal"
        title="Delete URL"
        body="Are you sure you want to delete this URL? This action cannot be undone."
        confirm-button="Yes"
        cancel-button="Cancel"
        @confirm="destroy"
        @cancel="toggleModal"
      />

      <SlideOverPanel
        v-if="showPanel"
        :show="showPanel"
        @closepanel="togglePanel"
      />
    </Portal>
  </BaseLayout>
</template>

<script>
import UrlsList from '@/components/UrlsList';
import Modal from '@/components/Modal';
import { Portal } from '@linusborg/vue-simple-portal';
import BaseLayout from '@/layouts/BaseLayout';
import Form from 'form-backend-validation';
import Pagination from '../components/Pagination';
import SlideOverPanel from '../components/SlideOverPanel';


export default {
  name: 'IndexPage',
  metaInfo: { title: 'Dashboard' },
  components: { SlideOverPanel, Pagination, BaseLayout, Portal, Modal, UrlsList },
  data() {
    return {
      form: new Form({
        original_url: '',
        title: '',
      }),
      urls: [],
      success: null,
      showModal: false,
      showPanel: false,
      urlToDelete: {},
    }
  },
  watch: {
    '$route.query.page'() {
      this.fetchUrls();
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
        .then(() => {
          this.urls.data = this.urls.data.filter(url => url.id !== this.urlToDelete.id);
        })
        .finally(() => (this.urlToDelete = {}));

      this.toggleModal();
    },
    fetchUrls(page = 1) {
      const query = this.$route.query.page || null;
      page = query ? query : page;

      window.axios
        .get(this.route('urls.index', { page }).url())
        .then(response => (this.urls = response.data));
    },
    flashSuccess() {
      this.success = this.form.successful;
      setTimeout(() => this.success = !this.success, 3000);
    },
    store() {
      if (this.form.processing || this.form.original_url === '') {
        return;
      }

      this.form
        .post(this.route('urls.store').url())
        .then((data) => {
          data['visits'] = 0;

          this.urls.data.unshift(data);
          this.flashSuccess();
        });
    },
    toggleModal() {
      this.showModal = !this.showModal;
    },
    togglePanel() {
      this.showPanel = !this.showPanel;
    },
  }
}
</script>
