<template>
  <auth-layout title="Reset Password">
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
            :class="{ 'border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red': form.errors.has('password') }"
            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
          >
        </div>

        <p
          v-if="form.errors.has('password')"
          class="mt-2 text-sm text-red-600"
          v-text="form.getError('password')"
        />
      </div>

      <div>
        <label
          for="password"
          class="block text-sm font-medium leading-5 text-gray-700"
        >Confirm Password</label>

        <div class="mt-1 rounded-md shadow-sm">
          <input
            id="password"
            v-model="form.password_confirmation"
            type="password"
            required
            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
          >
        </div>
      </div>

      <p
        v-if="form.successful"
        class="text-sm text-green-400 text-center"
        v-text="message"
      />

      <div>
        <span class="block w-full rounded-md shadow-sm">
          <button
            :disabled="form.processing"
            type="submit"
            class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out"
          >Reset password</button>
        </span>
      </div>
    </form>
  </auth-layout>
</template>

<script>
import AuthLayout from '../../layouts/AuthLayout';
import Form from 'form-backend-validation';

export default {
  name: 'ResetPassword',
  components: { AuthLayout },
  data() {
    return {
      form: new Form({
        email: '',
        token: '',
        password: '',
        password_confirmation: '',
      }),
      message: '',
    };
  },
  mounted() {
    this.form
      .populate({
        email: this.$route.query.email,
        token: this.$route.query.token,
      });
  },
  methods: {
    submit() {
      this.form
        .post(this.route('password.update').url())
        .then(response => {
          this.message = `${response.message} You will be shortly redirected.`;
          setTimeout(() => (window.location = '/'), 7000);
        })
    }
  },
}
</script>
