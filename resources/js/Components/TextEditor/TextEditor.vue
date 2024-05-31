<script setup>
import { defineProps, watch, reactive } from "vue";
import Editor from "@tinymce/tinymce-vue";

const props = defineProps({
  content: String,
});
watch(props, () => {
  if (props.content) {
    tinymce.activeEditor.setContent(props.content);
  }
});

const init = reactive({
  fontsize_formats: "8p 10px 12px 14px 16px 18px 20px 22px 24px 28px 32px 36px 48px 56px 72px",
  statusbar: false,
  plugins: 'autoresize',
  autoresize_bottom_margin: 0,
  content_css: ''
});
</script>

<template>
  <Editor
    class="w-full"
    api-key="msgbvadimyfv3dewreh1spjjzrfeb38t6eqkfhraq7v7s7ct"
    v-model="props.content"
    :init="init"
  />
</template>
