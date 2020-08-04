<template>
  <div class="flex flex-col min-h-screen">
    <app-header />

    <section class="flex-grow">
      <content-section>
        <slot />
      </content-section>
    </section>

    <app-footer />
  </div>
</template>

<script>
import AppHeader from './Header';
import AppFooter from './Footer';
import ContentSection from '../components/ContentSection';

export default {
  name: "BaseLayout",
  components: { ContentSection, AppFooter, AppHeader }
}
</script>
