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

const buttonPlugins = 'emoticons preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media code codesample table charmap hr pagebreak nonbreaking anchor insertdatetime advlist lists wordcount textpattern autosave '

// Import Toolbar
const toolbar = 'fullscreen undo redo restoredraft | cut copy paste pastetext | forecolor backcolor bold italic underline strikethrough link anchor \ table image | alignleft aligncenter alignright alignjustify outdent indent | \ styleselect formatselect fontselect fontsizeselect | bullist numlist | blockquote subscript superscript removeformat | media charmap emoticons hr pagebreak insertdatetime print preview | code selectall searchreplace visualblocks | indent2em lineheight formatpainter axupimgs'


const init = reactive({
  fontsize_formats: "8px 10px 12px 14px 16px 18px 20px 22px 24px 28px 32px 36px 48px 56px 72px",
  statusbar: false,
  resize: false,
  cleanup: true,
//   plugins: 'autoresize',
//   autoresize_bottom_margin: 0,
  content_css: '',
//   selector: 'textarea#default-editor',
  plugins: buttonPlugins,
  toolbar: toolbar,
  paste_data_images: true,
  images_upload_handler: (blobInfo, success, failure) => {
  // Need to rewrite in setup and pass in url
  }
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
