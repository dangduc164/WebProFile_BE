<template>
  <div class="field-select">
    <div class="image-preview" v-if="imgUrl">
      <div class="box-img">
        <img class="preview" :src="imgUrl" />
        <div class="box-img-action">
          <i
            @click="handleDeletePhoto"
            class="fa fa-times-circle text-danger js-tooltip text-[#a94442] text-[24px] translate-y-px opacity-60 hover:opacity-100"
          ></i>
        </div>
      </div>
    </div>
    <div v-else class="hide-if-value">
      <div class="box-img">
        <span> 画像が選択されていません</span>
        <label for="img" data-name="add" class="button-img"> 画像を追加 </label>
      </div>
      <ErrorMessage class="text-[red] mt-1 block" :name="name" />
    </div>
    <Field :name="props.name" v-model="imgFile" v-slot="{ handleChange, handleBlur }">
      <input
        type="file"
        @change="handleChange"
        @blur="handleBlur"
        accept="image/*"
        id="img"
        style="display: none"
      />
    </Field>
  </div>
</template>

<script setup>
import { ref, defineProps, defineEmits, watch } from "vue";
import { Field, ErrorMessage } from "vee-validate";
const props = defineProps({
  modelValue: {
    type: [String, Object],
  },
  name: String,
});

const imgUrl = ref("");
const imgFile = ref();
const emit = defineEmits(["update:modelValue"]);
watch(
  props,
  (val) => {
    if (typeof val.modelValue == "string" && val.modelValue) {
      imgFile.value = val.modelValue;
    }
  },
  { deep: true, immediate: true }
);
watch(
  imgFile,
  (val) => {
    if (typeof val != "string" && val) {
      imgUrl.value = URL.createObjectURL(val);
      console.log("🚀 ~ file: PhotoForm.vue:54 ~ imgUrl.value:", imgUrl.value);
      emit("update:modelValue", val);
    } else {
      imgUrl.value = val;
    }
  },
  { immediate: true }
);
const handleDeletePhoto = () => {
  imgUrl.value = "";
  imgFile.value = null;
  emit("update:modelValue", "");
};
</script>

<style lang="scss" scoped>
.field-select {
  width: 100%;
  box-sizing: border-box;
  & .input {
    box-shadow: 0 0 0 transparent;
    border-radius: 4px;
    border: 1px solid #8c8f94;
    background-color: #fff;

    outline: none;

    border-color: #ccc;
    background: #f6f7f7;
    vertical-align: top;
    font-size: 20px;
    width: 100%;
    margin-top: 6px;
    padding: 3px 7px;
    font-size: 14px;
    &.select {
      cursor: pointer;
    }
    &:hover {
      background: #f0f0f1;
      border-color: #0a4b78;
      color: #0a4b78;
    }
    &.textarea {
      height: 70px;
    }
  }
}
.box-img {
  position: relative;
  display: flex;
  align-items: center;
  max-width: 345px;
  & span {
    font-size: 13px;
  }
  img {
    width: 100%;
  }
  &-action {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
    &:hover {
      color: red;
    }
  }
}
.button-img {
  padding: 3px 7px;
  box-shadow: 0 0 0 transparent;
  border-radius: 4px;
  border: 1px solid #8c8f94;
  background-color: #fff;

  outline: none;

  border-color: #ccc;
  background: #f6f7f7;
  vertical-align: top;
  font-size: 15px;
  margin-left: 5px;
  cursor: pointer;
  &:hover {
    background: #f0f0f1;
    border-color: #0a4b78;
    color: #0a4b78;
  }
}
input {
  outline: none;
}
</style>
