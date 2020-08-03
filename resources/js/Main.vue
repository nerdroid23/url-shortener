<template>
  <div class="flex flex-col min-h-screen">
    <app-header />

    <section class="flex-grow">
      <index-page />
    </section>

    <app-footer />
  </div>
</template>

<script>
import AppHeader from './layouts/Header';
import AppFooter from './layouts/Footer';
import IndexPage from './pages/Index';

export default {
  name: "App",
  components: { IndexPage, AppFooter, AppHeader }
}
</script>
