<template>
  <Loading v-if="isLoading" />
  <div class="min-h-screen *:text-[#222] md:*:text-base *:text-[14px] bg-[#e2e8f0]">
    <Navigation v-if="isAuthenticated" />
    <slot></slot>
  </div>
</template>

<script setup>
import { computed } from "vue";
import Loading from "@/Components/Loading";
import { useStore } from "vuex";
import { MODULE_STORE } from "@/const";
import Navigation from "@/Components/Navigation";

const store = useStore();

const isLoading = computed(() => {
  return store.state[MODULE_STORE.COMMON.NAME].isLoadingPage;
});

const isAuthenticated = computed(() => {
  return store.state[MODULE_STORE.AUTH.NAME].isAuthenticated;
});

</script>

<style lang="scss" scoped></style>
