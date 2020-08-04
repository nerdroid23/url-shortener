<template>
  <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <img
        class="mx-auto h-12 w-auto"
        src="https://tailwindui.com/img/logos/workflow-mark-on-white.svg"
        alt="Workflow"
      >
      <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
        Create your account
      </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form class="space-y-6">
          <div>
            <label
              for="name"
              class="block text-sm font-medium leading-5 text-gray-700"
            >Full Name</label>

            <div class="mt-1 rounded-md shadow-sm">
              <input
                id="name"
                type="text"
                required
                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
              >
            </div>
          </div>

          <div>
            <label
              for="email"
              class="block text-sm font-medium leading-5 text-gray-700"
            >Email address</label>

            <div class="mt-1 rounded-md shadow-sm">
              <input
                id="email"
                type="email"
                required
                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
              >
            </div>
          </div>

          <div>
            <label
              for="password"
              class="block text-sm font-medium leading-5 text-gray-700"
            >Password</label>

            <div class="mt-1 rounded-md shadow-sm">
              <input
                id="password"
                type="password"
                required
                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
              >
            </div>
          </div>

          <div>
            <label
              for="passwordConfirmation"
              class="block text-sm font-medium leading-5 text-gray-700"
            >Confirm Password</label>

            <div class="mt-1 rounded-md shadow-sm">
              <input
                id="passwordConfirmation"
                type="password"
                required
                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
              >
            </div>
          </div>

          <div>
            <span class="block w-full rounded-md shadow-sm">
              <button
                type="submit"
                class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out"
              >Create account</button>
            </span>
          </div>
        </form>

        <div>
          <p class="mt-2 text-center text-sm leading-5 text-gray-600 max-w">
            <router-link
              :to="{ name: 'login' }"
              class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150"
            >
              Already have an account?
            </router-link>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "RegisterPage",
  metaInfo: { title: 'Create Your Account' },
}
</script>
