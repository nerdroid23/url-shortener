<template>
  <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <img
        class="mx-auto h-12 w-auto"
        src="https://tailwindui.com/img/logos/workflow-mark-on-white.svg"
        alt="Workflow"
      >
      <h2
        class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900"
        v-text="title"
      />
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <slot />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "AuthLayout",
  props: ['title'],
}
</script>
