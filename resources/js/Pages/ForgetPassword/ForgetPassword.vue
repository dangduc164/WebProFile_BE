<template>
  <div class="py-16">
    <div
      class="flex bg-white rounded-lg shadow-lg overflow-hidden mx-auto max-w-sm lg:max-w-4xl"
    >
      <div
        class="hidden lg:block lg:w-1/2 bg-cover"
        style="
          background-image: url('https://images.unsplash.com/photo-1546514714-df0ccc50d7bf?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=667&q=80');
        "
      ></div>
      <div class="w-full p-8 lg:w-1/2">
        <h2 class="text-2xl font-semibold text-gray-700 text-center">Brand</h2>
        <p class="text-xl text-gray-600 text-center">Welcome back!</p>
        <div class="mt-4 flex items-center justify-between">
          <span class="border-b w-1/5 lg:w-1/4"></span>
          <router-link
            to="/login"
            class="text-xs text-center text-gray-500 uppercase skin-text-link"
          >
            or login with email
          </router-link>
          <span class="border-b w-1/5 lg:w-1/4"></span>
        </div>
        <Form v-slot="{ handleSubmit }">
          <div class="mt-4">
            <label class="block text-gray-700 text-sm font-bold mb-2"
              >Email Address</label
            >
            <Field
              class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none"
              type="email"
              name="email"
              v-model="userLogin.email"
            />
          </div>
          <div class="mt-8">
            <button
              class="bg-gray-700 text-white font-bold py-2 px-4 w-full rounded hover:bg-gray-600"
              @click="handleSubmit($event, handleLogin)"
            >
              Submit
            </button>
          </div>
        </Form>
        <div class="mt-4 flex items-center justify-between">
          <span class="border-b w-1/5 md:w-1/4"></span>
          <router-link
            to="/register"
            class="text-xs text-gray-500 uppercase skin-text-link"
          >
            or sign up
          </router-link>
          <span class="border-b w-1/5 md:w-1/4"></span>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { ref, inject } from "vue";
import { Field, Form } from "vee-validate";


const toast = inject("$toast");

const isLoading = ref(false);
const userLogin = ref({
  email: "",
});

const handleLogin = async () => {
  try {
    isLoading.value = true;
    console.log("🚀 ~ file: LoginPage.vue:handleLogin ~ userLogin:", userLogin.value);

  } catch (error) {
    console.log(error);
    toast.error(error.message);
  } finally {
    isLoading.value = false;
  }
};
</script>

<style lang="scss" scoped></style>
