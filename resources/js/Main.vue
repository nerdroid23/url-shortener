<template>
  <div class="flex flex-col min-h-screen">
    <app-header />

    <section class="flex-grow">
      <router-view />
    </section>

    <app-footer />
  </div>
</template>

<script>
import AppHeader from './layouts/Header';
import AppFooter from './layouts/Footer';


export default {
  name: "App",
  components: { AppFooter, AppHeader }
}
</script>
