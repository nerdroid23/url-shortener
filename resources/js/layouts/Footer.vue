<template>
  <footer class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-center items-center align-middle h-16">
        <p class="text-sm text-gray-500">
          Copyright &copy; <span v-text="currentYear" />
        </p>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  name: "Footer",
  computed: {
    currentYear() {
      return (new Date()).getFullYear();
    }
  },
}
</script>
