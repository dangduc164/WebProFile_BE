<template>
  <div class="c-nav p-3 bg-white">
    <div class="flex items-center justify-end">
      <div class="avatar flex items-center gap-2 cursor-pointer" @click="handleShowNavItem">
        <img class="rounded-full w-8 h-8" src="https://i.pravatar.cc/300" alt="" />
        <i class="fa-solid fa-caret-down"></i>
      </div>
      <div class="c-nav_item" v-if="isShowNavItem">
        <button class="c-btn c-btn-logout" @click="handleLogout">Logout</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { inject, ref } from "vue";
import { TYPE_USER, ROUTER_PATH } from "@/const";
import { useRouter } from "vue-router";
import { useStore } from "vuex";
import { MODULE_STORE } from "@/const";
import { removeToken } from "@/utils/authToken";

import { logoutApi } from "@/api";

const store = useStore();

const toast = inject("$toast");
const router = useRouter();
const isShowNavItem = ref(false);

const handleShowNavItem = () => {
  isShowNavItem.value == true
    ? (isShowNavItem.value = false)
    : (isShowNavItem.value = true);
};
const handleLogout = async () => {
  try {
    // await logoutApi();
    removeToken(TYPE_USER.ADMIN);
    localStorage.removeItem("user_id");
    store.state[MODULE_STORE.AUTH.NAME].isAuthenticated = false;
    window.location.reload();
  } catch (error) {
    console.log("error: ", error);
  }
};
</script>

<style lang="scss" scoped>
@import './Navigation.scss';
</style>
