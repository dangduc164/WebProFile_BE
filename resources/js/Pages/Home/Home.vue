<template>
  <Loading v-if="isLoading" />
  <div class="container mx-auto px-4">
    <div class="main-body pt-5 md:py-10">
      <Form
        v-slot="{ handleSubmit }"
        :initial-values="dataProfile"
        :validation-schema="schemaDataProfile"
        class="w-full"
      >
        <div class="flex flex-wrap gutters-sm mx-[-1rem]">
          <div class="w-full md:w-1/3 px-4 mb-3">
            <div
              class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300"
            >
              <div class="flex-auto md:p-6 p-2">
                <div class="flex flex-col items-center text-center">
                  <div
                    class="h-[150px] w-[150px] bg-slate-200 relative hover-avatar max-w-[150px] max-h-[150px] overflow-hidden rounded-full"
                  >
                    <img
                      :src="dataProfile?.infor?.avatar"
                      alt="avatar"
                      class="rounded-full w-[150px] h-[150px] object-cover max-w-[150px] max-h-[150px]"
                      width="{150}"
                    />
                    <label
                      for="img"
                      class="cursor-pointer absolute bg-slate-50 h-[30px] w-full bottom-0 flex items-center justify-center opacity-0 button-camera"
                    >
                      <i class="fa-solid fa-camera"></i>
                      <input
                        type="file"
                        accept="image/*"
                        id="img"
                        class="hidden"
                        @change="handleUploadImg($event)"
                      />
                    </label>
                  </div>
                  <div class="mt-3">
                    <h4>{{ dataProfile?.infor?.full_name }}</h4>
                    <p class="text-gray-600 mb-1">
                      {{ dataProfile?.infor?.position_application }}
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div
              class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 mt-3"
            >
              <ul class="flex flex-col pl-0 mb-0 border rounded border-gray-300">
                <li
                  v-for="(item, index) in dataProfile?.list_link_social"
                  :key="index"
                  class="relative block py-3 px-6 pl-2 -mb-px border border-r-0 border-l-0 border-gray-300 no-underline flex justify-between items-center flex-wrap"
                >
                  <div class="flex items-center gap-2">
                    <span
                      class="text-red-500 cursor-pointer"
                      v-if="index != dataProfile?.list_link_social.length - 1"
                      @click="handleRemoveLinkSocial(index)"
                    >
                      <i class="fa-solid fa-minus text-[14px]"></i>
                    </span>
                    <span
                      v-else
                      class="text-green-500 cursor-pointer"
                      @click="handleAddLinkSocial()"
                    >
                      <i class="fa-solid fa-plus text-[14px]"></i>
                    </span>

                    <h6 class="mb-0">
                      <span
                        class="inline-block align-middle mr-2"
                        v-html="item?.icon"
                      ></span>
                      {{ item?.label }}
                    </h6>
                  </div>
                  <router-link
                    to="{item?.link}"
                    class="text-sm text-gray-600 hover:text-[#5bc956]"
                    :target="item?.link && item?.link !== '' ? '_blank' : '_self'"
                  >
                    More
                  </router-link>
                </li>
              </ul>
            </div>
          </div>

          <div class="md:w-2/3 pr-4 pl-4">
            <div
              class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 mb-3"
            >
              <div class="flex-auto md:p-6 p-2">
                <div
                  class="flex items-center justify-between border-b-2 border-teal-500 pb-1"
                >
                  <h3 class="md:text-2xl text-[18px] text-teal-500 text-semibold">
                    <i class="fa-solid fa-id-card mr-2"></i>
                    Information
                  </h3>
                </div>
                <div class="flex flex-wrap items-center min-h-8 py-2">
                  <div class="sm:w-1/4 px-4">
                    <h6 class="mb-0">Full Name</h6>
                  </div>

                  <div class="sm:w-3/4 text-gray-600">
                    <Field
                      class="w-full px-4 skin-input rounded-md"
                      type="text"
                      v-model="dataProfile.infor.full_name"
                      name="full_name"
                    />
                  </div>
                </div>
                <hr />
                <div class="flex flex-wrap items-center min-h-8">
                  <div class="sm:w-1/4 px-4">
                    <h6 class="mb-0">BirthDay / Gender</h6>
                  </div>
                  <div class="sm:w-3/4 text-gray-600 flex items-center gap-2">
                    <Field
                      class="w-full px-4 skin-input rounded-md"
                      type="text"
                      as="select"
                      v-model="dataProfile.infor.day"
                      name="day"
                      :class="{ no_value: dataProfile.infor.day == '' }"
                    >
                      <option value="" hidden disabled selected>31</option>
                      <option
                        v-for="(item, index) in daysArray"
                        :key="index"
                        :value="item"
                        class="text-[#222]"
                      >
                        {{ item }}
                      </option>
                    </Field>
                    <Field
                      class="w-full px-4 skin-input rounded-md"
                      type="text"
                      as="select"
                      v-model="dataProfile.infor.month"
                      name="month"
                      @change="handleCheckDay"
                      :class="{ no_value: dataProfile.infor.month == '' }"
                    >
                      <option value="" hidden disabled selected>12</option>
                      <option
                        v-for="(item, index) in months"
                        :key="index"
                        :value="item"
                        class="text-[#222]"
                      >
                        {{ item }}
                      </option>
                    </Field>
                    <Field
                      class="w-full px-4 skin-input rounded-md"
                      type="text"
                      as="select"
                      v-model="dataProfile.infor.year"
                      name="year"
                      @change="handleCheckDay"
                      :class="{ no_value: dataProfile.infor.year == '' }"
                    >
                      <option value="" hidden disabled selected>1990</option>
                      <option
                        v-for="(item, index) in birthYears"
                        :key="index"
                        :value="item"
                        class="text-[#222]"
                      >
                        {{ item }}
                      </option>
                    </Field>
                    <Field
                      class="w-full px-4 skin-input rounded-md"
                      type="text"
                      as="select"
                      v-model="dataProfile.infor.gender"
                      name="gender"
                      :class="{ no_value: dataProfile.infor.gender == '' }"
                    >
                      <option value="" hidden disabled selected>Male</option>
                      <option
                        v-for="(item, index) in listGenders"
                        :key="index"
                        :value="item.value"
                        class="text-[#222]"
                      >
                        {{ item.label }}
                      </option>
                    </Field>
                  </div>
                </div>
                <hr />
                <div class="flex flex-wrap items-center min-h-8">
                  <div class="sm:w-1/4 px-4">
                    <h6 class="mb-0">Email</h6>
                  </div>
                  <div class="sm:w-3/4 text-gray-600">
                    <Field
                      class="w-full px-4 skin-input rounded-md"
                      type="text"
                      v-model="dataProfile.infor.email"
                      name="email"
                    />
                  </div>
                </div>
                <hr />
                <div class="flex flex-wrap items-center min-h-8">
                  <div class="sm:w-1/4 px-4">
                    <h6 class="mb-0">Phone</h6>
                  </div>
                  <div class="sm:w-3/4 text-gray-600">
                    <Field
                      class="w-full px-4 skin-input rounded-md"
                      type="text"
                      v-model="dataProfile.infor.phone_number"
                      name="phone_number"
                    />
                  </div>
                </div>
                <hr />
                <div class="flex flex-wrap items-center min-h-8">
                  <div class="sm:w-1/4 px-4">
                    <h6 class="mb-0">Address</h6>
                  </div>
                  <div class="sm:w-3/4 text-gray-600 mt-2">
                    <Field
                      id="address"
                      class="w-full px-4 skin-input rounded-md"
                      type="text"
                      as="textarea"
                      v-model="dataProfile.infor.address"
                      name="address"
                      @keypress.passive="
                        handleResizeTextarea('address', dataProfile.infor.address)
                      "
                    />
                  </div>
                </div>
                <hr />
              </div>
            </div>

            <draggable v-model="dataProfile.content" tag="div">
              <template #item="{ element: item, index: index }">
                <div
                  class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 mt-3"
                >
                  <div class="md:p-6 p-2 md:pr-2 flex items-center gap-1 md:gap-2">
                    <div class="flex-1">
                      <h3
                        class="md:text-2xl text-[18px] text-teal-500 text-semibold border-b-2 border-teal-500 mb-2 flex items-center"
                      >
                        <i class="fa-solid fa-briefcase mr-2"></i>
                        <Field
                          class="w-full rounded-md focus-visible:outline-none"
                          :name="`title-${index}`"
                          v-model="item.title"
                          maxlength="255"
                        />
                      </h3>
                      <Field
                        :id="`desc-${index}`"
                        class="w-full border border-gray-300 min-h-[150px] p-2 skin-input rounded-md resize-y h-auto js-resize-y-textarea"
                        type="text"
                        as="textarea"
                        :name="`desc-${index}`"
                        v-model="item.desc"
                        @keypress.passive="
                          handleResizeTextarea(`desc-${index}`, item.desc)
                        "
                      />
                    </div>
                    <div>
                      <button
                        class="c-btn c-btn-delete"
                        @click.prevent="handleRemoveRowContent(index)"
                      >
                        <i class="fa-solid fa-trash text-[10px]"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </template>
            </draggable>

            <div class="mt-2">
              <button class="c-btn c-btn-add" @click.prevent="handleAddRowContent">
                <i class="fa-solid fa-plus mr-1"></i>
                Add Content
              </button>
            </div>

            <div class="flex justify-center mt-2">
              <buton
                class="c-btn c-btn-save"
                @click.prevent="handleSubmit($event, handleSubmitForm)"
              >
                <i class="fa-solid fa-floppy-disk mr-1"></i>
                Save
              </buton>
            </div>
          </div>
        </div>
      </Form>
    </div>
  </div>
</template>

<script setup>
import { ref, inject, computed } from "vue";
import { Field, Form } from "vee-validate";
import draggable from "vuedraggable";
import moment from "moment/moment";
import Loading from "@/Components/Loading";
import { uploadAvatarApi } from "@/api";

const toast = inject("$toast");
const typeImage = ref("");
const dateFormatList = ["DD/MM/YYYY", "DD/MM/YY"];
const isLoading = ref(false);

const listGenders = ref([
  {
    value: "male",
    label: "Male",
  },
  {
    value: "female",
    label: "Female",
  },
  {
    value: "other",
    label: "Other",
  },
]);

const dataProfile = ref({
  list_link_social: [
    {
      icon: `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" id="github"><path fill-rule="evenodd" d="M10 0c5.523 0 10 4.59 10 10.253 0 4.529-2.862 8.371-6.833 9.728-.507.101-.687-.219-.687-.492 0-.338.012-1.442.012-2.814 0-.956-.32-1.58-.679-1.898 2.227-.254 4.567-1.121 4.567-5.059 0-1.12-.388-2.034-1.03-2.752.104-.259.447-1.302-.098-2.714 0 0-.838-.275-2.747 1.051A9.396 9.396 0 0 0 10 4.958a9.375 9.375 0 0 0-2.503.345C5.586 3.977 4.746 4.252 4.746 4.252c-.543 1.412-.2 2.455-.097 2.714-.639.718-1.03 1.632-1.03 2.752 0 3.928 2.335 4.808 4.556 5.067-.286.256-.545.708-.635 1.371-.57.262-2.018.715-2.91-.852 0 0-.529-.985-1.533-1.057 0 0-.975-.013-.068.623 0 0 .655.315 1.11 1.5 0 0 .587 1.83 3.369 1.21.005.857.014 1.665.014 1.909 0 .271-.184.588-.683.493C2.865 18.627 0 14.783 0 10.253 0 4.59 4.478 0 10 0"></path></svg>`,
      label: "Github",
      link: "https://github.com/dangduc164",
    },
    {
      icon: `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 28.87 28.87" id="twitter"><g><g><rect width="28.87" height="28.87" fill="#00c7ff" rx="6.48" ry="6.48"></rect><path fill="#fff" fill-rule="evenodd" d="M11.74 18.11a3.29 3.29 0 0 1-3.05-2.28 3.26 3.26 0 0 0 1.41 0A3.28 3.28 0 0 1 8 14.26a3.18 3.18 0 0 1-.48-1.75 3.24 3.24 0 0 0 1.46.4 3.3 3.3 0 0 1-1.35-2A3.25 3.25 0 0 1 8 8.54 9.39 9.39 0 0 0 14.76 12c0-.13 0-.24-.05-.36a3.28 3.28 0 0 1 5.58-2.74.17.17 0 0 0 .17.05 6.6 6.6 0 0 0 1.91-.73A3.36 3.36 0 0 1 21 10a6.3 6.3 0 0 0 1.83-.49l-.33.49a6.44 6.44 0 0 1-1.19 1.13.11.11 0 0 0-.05.1 9.09 9.09 0 0 1-.06 1.46 9.66 9.66 0 0 1-.85 2.92 9.44 9.44 0 0 1-1.77 2.59 8.77 8.77 0 0 1-4.51 2.51 9.79 9.79 0 0 1-1.83.22A9.27 9.27 0 0 1 7 19.52l-.08-.05a6.64 6.64 0 0 0 3.26-.47 6.53 6.53 0 0 0 1.56-.89z"></path></g></g></svg>`,
      label: "Twitter",
      link: "https://twitter.com/uc_ang4740",
    },
    {
      icon: `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 102 102" id="instagram"><defs><radialGradient id="a" cx="6.601" cy="99.766" r="129.502" gradientUnits="userSpaceOnUse"><stop offset=".09" stop-color="#fa8f21"/><stop offset=".78" stop-color="#d82d7e"/></radialGradient><radialGradient id="b" cx="70.652" cy="96.49" r="113.963" gradientUnits="userSpaceOnUse"><stop offset=".64" stop-color="#8c3aaa" stop-opacity="0"/><stop offset="1" stop-color="#8c3aaa"/></radialGradient></defs><path fill="url(#a)" d="M25.865,101.639A34.341,34.341,0,0,1,14.312,99.5a19.329,19.329,0,0,1-7.154-4.653A19.181,19.181,0,0,1,2.5,87.694,34.341,34.341,0,0,1,.364,76.142C.061,69.584,0,67.617,0,51s.067-18.577.361-25.14A34.534,34.534,0,0,1,2.5,14.312,19.4,19.4,0,0,1,7.154,7.154,19.206,19.206,0,0,1,14.309,2.5,34.341,34.341,0,0,1,25.862.361C32.422.061,34.392,0,51,0s18.577.067,25.14.361A34.534,34.534,0,0,1,87.691,2.5a19.254,19.254,0,0,1,7.154,4.653A19.267,19.267,0,0,1,99.5,14.309a34.341,34.341,0,0,1,2.14,11.553c.3,6.563.361,8.528.361,25.14s-.061,18.577-.361,25.14A34.5,34.5,0,0,1,99.5,87.694,20.6,20.6,0,0,1,87.691,99.5a34.342,34.342,0,0,1-11.553,2.14c-6.557.3-8.528.361-25.14.361s-18.577-.058-25.134-.361"/><path fill="url(#b)" d="M25.865,101.639A34.341,34.341,0,0,1,14.312,99.5a19.329,19.329,0,0,1-7.154-4.653A19.181,19.181,0,0,1,2.5,87.694,34.341,34.341,0,0,1,.364,76.142C.061,69.584,0,67.617,0,51s.067-18.577.361-25.14A34.534,34.534,0,0,1,2.5,14.312,19.4,19.4,0,0,1,7.154,7.154,19.206,19.206,0,0,1,14.309,2.5,34.341,34.341,0,0,1,25.862.361C32.422.061,34.392,0,51,0s18.577.067,25.14.361A34.534,34.534,0,0,1,87.691,2.5a19.254,19.254,0,0,1,7.154,4.653A19.267,19.267,0,0,1,99.5,14.309a34.341,34.341,0,0,1,2.14,11.553c.3,6.563.361,8.528.361,25.14s-.061,18.577-.361,25.14A34.5,34.5,0,0,1,99.5,87.694,20.6,20.6,0,0,1,87.691,99.5a34.342,34.342,0,0,1-11.553,2.14c-6.557.3-8.528.361-25.14.361s-18.577-.058-25.134-.361"/><path fill="#fff" d="M461.114,477.413a12.631,12.631,0,1,1,12.629,12.632,12.631,12.631,0,0,1-12.629-12.632m-6.829,0a19.458,19.458,0,1,0,19.458-19.458,19.457,19.457,0,0,0-19.458,19.458m35.139-20.229a4.547,4.547,0,1,0,4.549-4.545h0a4.549,4.549,0,0,0-4.547,4.545m-30.99,51.074a20.943,20.943,0,0,1-7.037-1.3,12.547,12.547,0,0,1-7.193-7.19,20.923,20.923,0,0,1-1.3-7.037c-.184-3.994-.22-5.194-.22-15.313s.04-11.316.22-15.314a21.082,21.082,0,0,1,1.3-7.037,12.54,12.54,0,0,1,7.193-7.193,20.924,20.924,0,0,1,7.037-1.3c3.994-.184,5.194-.22,15.309-.22s11.316.039,15.314.221a21.082,21.082,0,0,1,7.037,1.3,12.541,12.541,0,0,1,7.193,7.193,20.926,20.926,0,0,1,1.3,7.037c.184,4,.22,5.194.22,15.314s-.037,11.316-.22,15.314a21.023,21.023,0,0,1-1.3,7.037,12.547,12.547,0,0,1-7.193,7.19,20.925,20.925,0,0,1-7.037,1.3c-3.994.184-5.194.22-15.314.22s-11.316-.037-15.309-.22m-.314-68.509a27.786,27.786,0,0,0-9.2,1.76,19.373,19.373,0,0,0-11.083,11.083,27.794,27.794,0,0,0-1.76,9.2c-.187,4.04-.229,5.332-.229,15.623s.043,11.582.229,15.623a27.793,27.793,0,0,0,1.76,9.2,19.374,19.374,0,0,0,11.083,11.083,27.813,27.813,0,0,0,9.2,1.76c4.042.184,5.332.229,15.623.229s11.582-.043,15.623-.229a27.8,27.8,0,0,0,9.2-1.76,19.374,19.374,0,0,0,11.083-11.083,27.716,27.716,0,0,0,1.76-9.2c.184-4.043.226-5.332.226-15.623s-.043-11.582-.226-15.623a27.786,27.786,0,0,0-1.76-9.2,19.379,19.379,0,0,0-11.08-11.083,27.748,27.748,0,0,0-9.2-1.76c-4.041-.185-5.332-.229-15.621-.229s-11.583.043-15.626.229" transform="translate(-422.637 -426.196)"/></svg>`,
      label: "Instagram",
      link: "https://www.instagram.com/ducden164/",
    },
    {
      icon: `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16" id="facebook"><path fill="#1976D2" d="M14 0H2C.897 0 0 .897 0 2v12c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2V2c0-1.103-.897-2-2-2z"></path><path fill="#FAFAFA" fill-rule="evenodd" d="M13.5 8H11V6c0-.552.448-.5 1-.5h1V3h-2a3 3 0 0 0-3 3v2H6v2.5h2V16h3v-5.5h1.5l1-2.5z" clip-rule="evenodd"></path></svg>`,
      label: "Facebook",
      link: "https://www.facebook.com/ducden.164",
    },
  ],
  infor: {
    full_name: "Nguyen Dang Duc",
    gender: "",
    day: "",
    month: "",
    year: "",
    birthday_inder: "",
    email: "ducden164@gmail.com",
    address: "Phuc Cau village, Thuy Huong commune, Chuong My district, Hanoi city",
    phone_number: "0967771606",
    avatar: "",
    position_application: "Fullstack Developer",
    work_experience: "",
  },

  content: [
    {
      title: "1",
      desc: `- In the short term: Efforts in the shortest time to meet job requirements. Become an official employee of the company. \n
- Learn and absorb new technological knowledge. \n
- In the long term: Become a professional programmer and stay with the company for a long time. Promote and become a Leader.
`,
      order_number: "",
    },
    {
      title: "2",
      desc: `- In the short term: Efforts in the shortest time to meet job requirements. Become an official employee of the company. \n
- Learn and absorb new technological knowledge. \n
- In the long term: Become a professional programmer and stay with the company for a long time. Promote and become a Leader.
`,
      order_number: "",
    },
  ],
});
const handleAddRowContent = () => {
  dataProfile.value.content.push({
    title: "",
    desc: "",
    order_number: "",
  });
  window.scrollTo({ left: 0, top: document.body.scrollHeight, behavior: "smooth" });
};

const handleRemoveRowContent = (index) => {
  const updatedContent = dataProfile.value.content
    .slice(0, index)
    .concat(dataProfile.value.content.slice(index + 1));
  dataProfile.value.content = updatedContent;
};

const handleResizeTextarea = (element, value) => {
  const el = document.getElementById(element);
  el.style.height = "auto";
  el.style.height = `${el.scrollHeight + 2}px`;
};

const handleUploadImg = async (e) => {
  const image = e.target.files[0];
  if (!image || !image.type.match("image/*")) {
    console.error("Please select a valid image file.");
    return;
  }
  const img = document.querySelector("img");
  if (image.name) {
    console.log("Original file name:", image.name);
  } else {
    const fileName = image.path.split("\\").pop() || image.path.split("/").pop();
    console.log("Extracted file name:", fileName);
  }
  if (img.src) {
    URL.revokeObjectURL(img.src);
  }
  img.onload = () => {};
  img.src = URL.createObjectURL(image);
  typeImage.value = image.type.split("/")[1];
  const urlParts = img.src.split("/");
  const namefile = urlParts[urlParts.length - 1];
  const namefileFull = namefile + "." + typeImage.value;

  const formData = new FormData();
  formData.append("file", image);
  formData.append("type", "image");
  try {
    isLoading.value = true;
    const res = await uploadAvatarApi(formData);
  } catch (errors) {
    const error = errors.message || t("common.has_error");
    toast.error(error);
  } finally {
    isLoading.value = false;
    toast.success("upload avatar success");
  }
};

const months = computed(() => {
  const monthNumbers = Array.from({ length: 12 }, (_, index) => index + 1);

  const formattedMonths = monthNumbers.map((monthNumber) => {
    return monthNumber < 10 ? `0${monthNumber}` : monthNumber.toString();
  });

  return formattedMonths;
});

const currentYear = new Date().getFullYear();
const generateYears = (startYear, endYear) => {
  let years = [];
  for (let year = startYear; year <= endYear; year++) {
    years.push(year);
  }
  return years;
};
const birthYears = ref(generateYears(1923, currentYear));

const isLeapYear = (year) => {
  if (year % 4 !== 0) return false;
  if (year % 100 === 0 && year % 400 !== 0) return false;
  return true;
};

const isFebruary = (month) => {
  return month === 2;
};

const getLeapYearsWithFebruary29 = computed(() => {
  const years = [];
  const startDate = 1923;

  for (let year = startDate; year <= currentYear; year++) {
    if (isLeapYear(year) && isFebruary(2)) {
      years.push(year);
    }
  }
  return years;
});

const listdaysArray = computed(() => {
  let daysInMonth = 31;
  return Array.from({ length: daysInMonth }, (_, index) => {
    const day = index + 1;
    return day < 10 ? "0" + day : day.toString();
  });
});
const daysArray = ref(listdaysArray.value);

const handleCheckDay = () => {
  const monthsWith31Days = ["01", "03", "05", "07", "08", "10", "12"];
  const year = dataProfile.value.infor.year;
  const month = dataProfile.value.infor.month;
  let daysInMonth = 30;
  month == "02"
    ? getLeapYearsWithFebruary29.value.includes(year) && month == "02"
      ? (daysInMonth = 29)
      : (daysInMonth = 28)
    : monthsWith31Days.includes(month)
    ? (daysInMonth = 31)
    : (daysInMonth = 30);

  const listdaysArray = computed(() => {
    return Array.from({ length: daysInMonth }, (_, index) => {
      const day = index + 1;
      return day < 10 ? "0" + day : day.toString();
    });
  });
  daysArray.value = listdaysArray.value;
};

const handleAddLinkSocial = () => {
  dataProfile.value.list_link_social.push({
    icon: "",
    label: "",
    link: "",
  });
};

const handleRemoveLinkSocial = (index) => {
  const updatedContent = dataProfile.value.list_link_social
    .slice(0, index)
    .concat(dataProfile.value.list_link_social.slice(index + 1));
  dataProfile.value.list_link_social = updatedContent;
};

const handleSubmitForm = () => {
  try {
    const img = document.querySelector("img[alt='avatar']");
    const urlParts = img.src.split("/");
    const namefile = urlParts[urlParts.length - 1];
    dataProfile.value.infor.avatar = namefile + "." + typeImage.value;

    dataProfile.value.infor.birthday_inder =
      dataProfile.value.infor.day +
      dataProfile.value.infor.month +
      dataProfile.value.infor.year;

    console.log("submit form", dataProfile.value);
  } catch (error) {
    toast.success("error");
  } finally {
    toast.success("success");
  }
};
</script>

<style lang="scss" scoped>
.no_value {
  color: #ccc;
}
</style>
