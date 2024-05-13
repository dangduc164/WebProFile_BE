<script>
import Layout from "../Layout";

export default {
  name: "App",
  components: {
    Layout,
  },
};
</script>

<style scoped></style>

<template>
  <main>
    <Layout>
      <router-view />
    </Layout>
  </main>
</template>
