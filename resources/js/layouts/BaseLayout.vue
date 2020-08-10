<template>
  <div class="flex flex-col min-h-screen">
    <AppHeader />

    <section class="flex-grow">
      <ContentSection>
        <slot />
      </ContentSection>
    </section>

    <AppFooter />

    <Portal selector="#portal-target">
      <Notification />
    </Portal>
  </div>
</template>

<script>
import AppHeader from '@/layouts/Header';
import AppFooter from '@/layouts/Footer';
import ContentSection from '@/components/ContentSection';
import { Portal } from '@linusborg/vue-simple-portal';
import Notification from '@/components/Notification';

export default {
  name: "BaseLayout",
  components: { Notification, ContentSection, AppFooter, AppHeader, Portal }
}
</script>
