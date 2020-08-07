<template>
  <auth-layout title="Reset your password">
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

        <p
          v-else-if="form.successful"
          class="mt-2 text-sm text-green-400"
          v-text="message"
        />

        <p
          v-else
          id="email-description"
          class="mt-2 text-sm text-gray-500"
        >
          Enter the email address associated with your account and we'll send you a link to reset your password.
        </p>
      </div>

      <div>
        <span class="block w-full rounded-md shadow-sm">
          <button
            :disabled="form.processing"
            type="submit"
            class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out"
          >Send password reset link</button>
        </span>
      </div>
    </form>

    <div>
      <p class="mt-2 text-center text-sm leading-5 text-gray-600 max-w">
        <router-link
          :to="{ name: 'login' }"
          class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150"
        >
          Go back to log in.
        </router-link>
      </p>
    </div>
  </auth-layout>
</template>

<script>
import AuthLayout from '../../layouts/AuthLayout';
import Form from 'form-backend-validation';

export default {
  name: 'ForgotPassword',
  components: { AuthLayout },
  metaInfo: { title: 'Reset Password' },
  data() {
    return {
      form: new Form({ email: '' }),
      message: ''
    };
  },
  methods: {
    submit() {
      this.form
        .post(this.route('password.email').url())
        .then(response => this.message = response.message);
    }
  }
}
</script>
