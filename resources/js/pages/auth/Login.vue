<template>
  <auth-layout title="Sign in Your Account">
    <form
      class="space-y-6"
      @submit.prevent="submit"
      @keydown="form.errors.clear($event.target.id)"
    >
      <div>
        <label
          for="email"
          class="block text-sm font-medium leading-5 text-gray-700"
        >Email address</label>

        <div class="mt-1 rounded-md shadow-sm">
          <input
            id="email"
            v-model="form.email"
            type="email"
            required
            :class="{ 'border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red': form.errors.has('email') }"
            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
          >
        </div>

        <p
          v-if="form.errors.has('email')"
          class="mt-2 text-sm text-red-600"
          v-text="form.getError('email')"
        />
      </div>

      <div>
        <label
          for="password"
          class="block text-sm font-medium leading-5 text-gray-700"
        >Password</label>

        <div class="mt-1 rounded-md shadow-sm">
          <input
            id="password"
            v-model="form.password"
            type="password"
            required
            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
          >
        </div>
      </div>

      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <input
            id="remember_me"
            v-model="form.remember"
            type="checkbox"
            class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"
          >

          <label
            for="remember_me"
            class="ml-2 block text-sm leading-5 text-gray-900"
          >Remember me</label>
        </div>

        <div class="text-sm leading-5">
          <router-link
            :to="{ name: 'forgot-password' }"
            class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150"
          >
            Forgot your password?
          </router-link>
        </div>
      </div>

      <div>
        <span class="block w-full rounded-md shadow-sm">
          <button
            :disabled="form.processing"
            type="submit"
            class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out"
          >Sign in</button>
        </span>
      </div>
    </form>

    <div>
      <p class="mt-2 text-center text-sm leading-5 text-gray-600 max-w">
        <router-link
          :to="{ name: 'register' }"
          class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150"
        >
          Haven't signed up yet?
        </router-link>
      </p>
    </div>
  </auth-layout>
</template>

<script>
import Form from 'form-backend-validation';
import AuthLayout from '../../layouts/AuthLayout';

export default {
  name: 'LoginPage',
  components: { AuthLayout },
  metaInfo: { title: 'Sign in' },
  data() {
    return {
      form: new Form({
        email: '',
        password: '',
        remember: '',
      })
    }
  },
  methods: {
    submit() {
      this.form
        .post(this.route('login').url())
        .then(() => (window.location = '/'));
    },
  },
}
</script>
