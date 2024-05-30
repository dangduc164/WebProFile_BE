<template>
  <div class="mt-4">
    <label class="block text-gray-700 text-sm font-bold mb-2">
      {{ label }}
      <span v-if="isRequired" class="text-red-500">*</span>
    </label>
    <slot></slot>
  </div>
</template>

<script>
export default {
  name: "LayoutInput",
  props: {
    label: {
      type: String,
      default: "",
    },
    isRequired: {
      type: Boolean,
      default: false,
    },
  },
  setup() {},
};
</script>

<style lang="scss" scoped></style>
