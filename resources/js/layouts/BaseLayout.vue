<template>
  <div class="flex flex-col min-h-screen">
    <app-header />

    <section class="flex-grow">
      <slot />
    </section>

    <app-footer />
  </div>
</template>

<script>
import AppHeader from './Header';
import AppFooter from './Footer';

export default {
  name: "BaseLayout",
  components: { AppFooter, AppHeader }
}
</script>
