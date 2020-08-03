<template>
  <main class="py-10 flex-grow">
    <header>
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1
          class="text-3xl font-bold leading-tight text-gray-900"
          v-text="title"
        />
      </div>
    </header>
    <main>
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="px-4 py-8 sm:px-0">
          <slot />
        </div>
      </div>
    </main>
  </main>
</template>

<script>
export default {
  name: "ContentSection",
  props: { title: String },
}
</script>
