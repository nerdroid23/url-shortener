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
            @click="openCreatePanel"
          >
            New
          </button>
        </span>
      </div>
    </div>

    <div class="mt-10">
      <UrlsList :initialdata="urls" />
    </div>

    <Portal selector="#portal-target">
      <DeleteUrlModal />
      <CreateUrlPanel />
    </Portal>
  </BaseLayout>
</template>

<script>
import BaseLayout from '@/layouts/BaseLayout';
import UrlsList from '@/components/UrlsList';
import { Portal } from '@linusborg/vue-simple-portal';
import DeleteUrlModal from '@/components/DeleteUrlModal';
import CreateUrlPanel from '@/components/CreateUrlPanel';

export default {
  name: 'IndexPage',
  metaInfo: { title: 'Dashboard' },
  components: { CreateUrlPanel, BaseLayout, Portal, DeleteUrlModal, UrlsList },
  data() {
    return {
      urls: {},
    }
  },
  watch: {
    '$route.query.page'() {
      this.fetchUrls();
    }
  },
  mounted() {
    this.fetchUrls();
    EventBus.listen('deleted-url', () => this.fetchUrls());
    EventBus.listen('created-url', () => this.fetchUrls());
  },
  methods: {
    fetchUrls(page = 1) {
      const query = this.$route.query.page || null;
      page = query ? query : page;

      window.axios
        .get(this.route('urls.index', { page }).url())
        .then(({ data }) => {
          const currentPage = parseInt(page);

          if (!data.data.length && currentPage > 1) {
            this.$router.replace({ name: 'dashboard', query: { page: (currentPage - 1) } });
          }

          this.urls = data;
        });
    },
    openCreatePanel() {
      EventBus.fire('open-create-panel');
    },
  }
}
</script>
