<template>
  <div class="flex flex-col min-h-screen">
    <AppHeader />

    <section class="flex-grow">
      <ContentSection>
        <slot />
      </ContentSection>
    </section>

    <AppFooter />
  </div>
</template>

<script>
import AppHeader from '@/layouts/Header';
import AppFooter from '@/layouts/Footer';
import ContentSection from '@/components/ContentSection';

export default {
  name: "BaseLayout",
  components: { ContentSection, AppFooter, AppHeader }
}
</script>
