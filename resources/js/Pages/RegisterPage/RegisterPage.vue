<template>
  <div class="py-16">
    <div
      class="flex bg-white rounded-lg shadow-lg overflow-hidden mx-auto max-w-sm lg:max-w-4xl"
    >
      <div class="w-full p-8">
        <h2 class="text-2xl font-semibold text-gray-700 text-center">Đăng ký</h2>
        <p class="text-xl text-gray-600 text-center">Welcome back!</p>
        <Form
          v-slot="{ handleSubmit }"
          :initial-values="datafrom"
          :validation-schema="schema"
        >
          <div class="mt-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <Field
              class="bg-white text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full skin-input"
              type="email"
              name="email"
              v-model="datafrom.email"
            />
            <ErrorMessage class="text-red-500" name="email" />
          </div>
          <div class="mt-4">
            <div class="flex justify-between">
              <label class="block text-gray-700 text-sm font-bold mb-2">Mật khẩu</label>
            </div>
            <div class="relative">
              <Field
                class="bg-white text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 pr-10 block w-full skin-input"
                v-model="datafrom.password"
                :type="typePassword"
                name="password"
              />
              <span
                class="absolute inset-y-0 right-0 pr-3 flex items-center z-10 cusor-pointer"
                @click="handleShowPassword"
              >
                <i
                  v-if="typePassword === 'password'"
                  class="fa-solid fa-eye-slash cusor-pointer"
                ></i>
                <i v-else class="fa-solid fa-eye cusor-pointer"></i>
              </span>
            </div>
            <ErrorMessage class="text-red-500" name="password" />
          </div>
          <div class="mt-4">
            <div class="flex justify-between">
              <label class="block text-gray-700 text-sm font-bold mb-2"
                >Nhập lại mật khẩu</label
              >
            </div>
            <div class="relative">
              <Field
                class="bg-white text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 pr-10 block w-full skin-input"
                v-model="datafrom.confirm_password"
                :type="typePassword"
                name="confirm_password"
              />
              <span
                class="absolute inset-y-0 right-0 pr-3 flex items-center z-10 cusor-pointer"
                @click="handleShowPassword"
              >
                <i
                  v-if="typePassword === 'password'"
                  class="fa-solid fa-eye-slash cusor-pointer"
                ></i>
                <i v-else class="fa-solid fa-eye cusor-pointer"></i>
              </span>
            </div>
            <ErrorMessage class="text-red-500" name="confirm_password" />
          </div>

          <div class="mt-8">
            <button
              class="bg-gray-700 text-white font-bold py-2 px-4 w-full rounded hover:bg-gray-600"
              @click="handleSubmit($event, handleRegister)"
            >
              Đăng ký
            </button>
          </div>
        </Form>
        <div class="mt-4 flex items-center justify-between">
          <span class="border-b w-1/5 md:w-1/4"></span>
          <router-link
            to="/register"
            class="text-xs text-gray-500 uppercase skin-text-link"
          >
            Đã có tài khoản
          </router-link>
          <span class="border-b w-1/5 md:w-1/4"></span>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { computed, ref, inject } from "vue";
import { Form, Field, ErrorMessage } from "vee-validate";
import { setToken, removeToken, getToken } from "@/utils/authToken";
import { TYPE_USER, ROUTER_PATH, MODULE_STORE } from "@/const";
import { useStore } from "vuex";
import { useRouter } from "vue-router";
import { loginApi, registerApi } from "@/api";
import * as Yup from "yup";

const toast = inject("$toast");
const store = useStore();
const router = useRouter();
const typePassword = ref("password");
const datafrom = ref({
  email: "",
  password: "",
  confirm_password: "",
});

const regexEmail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
const regexPassword = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;

const schema = Yup.object().shape({
  email: Yup.string()
    .trim()
    .matches(regexEmail, "Email không hợp lệ")
    .required("Email không được để trống"),
  password: Yup.string()
    .trim()
    .matches(regexPassword, "Mật khẩu tối theo 8 ký tự và bao gồm chữ hoa chữ thường")
    .min(8, "Mật khẩu tối theo 8 kiểu")
    .required("Mật khẩu không được để trống"),
  confirm_password: Yup.string()
    .oneOf([Yup.ref("password")], "Mật khẩu không trùng nhau")
    .required("Mật khẩu không được để trống"),
});

const handleShowPassword = () => {
  typePassword.value === "password"
    ? (typePassword.value = "text")
    : (typePassword.value = "password");
};
const handleRegister = async () => {
  try {
    store.state[MODULE_STORE.COMMON.NAME].isLoadingPage = true;
    const res = await registerApi(datafrom.value);
    if (res.user) {
      toast.success("Đăng ký thành công");
      handleLogin(datafrom.value);
    }
  } catch (error) {
    toast.error(error.message || "error");
  } finally {
    store.state[MODULE_STORE.COMMON.NAME].isLoadingPage = false;
  }
};

const handleLogin = async (data) => {
  try {
    const res = await loginApi(data);
    if (res) {
      const { access_token, expires_in } = res;
      if (getToken(TYPE_USER.USER)) removeToken(TYPE_USER.USER);
      setToken(access_token, expires_in, TYPE_USER.ADMIN);
      store.state[MODULE_STORE.AUTH.NAME].isAuthenticated = true;
      router.push({ path: ROUTER_PATH.ADMIN, query: { user_id: res?.user?.id } });
      toast.success("Đăng nhập thành công");
    }
  } catch (error) {
    toast.error(error.message || "error");
  }
};
</script>

<style lang="scss" scoped></style>
