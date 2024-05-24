<template>
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
                      :src="dataProfile?.infor?.avatar_url"
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
                      <Field
                        class="w-full px-4 skin-input rounded-md"
                        type="text"
                        name="position_application"
                        placeholder="Frontend develop"
                        v-model="dataProfile.infor.position_application"
                      />
                    </p>
                    <p class="text-gray-600 mb-1">
                      <Field
                        class="w-full px-4 skin-input rounded-md"
                        type="text"
                        name="work_experience"
                        placeholder="Frontend develop"
                        v-model="dataProfile.infor.work_experience"
                      />
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
                  class="relative block py-3 px-6 pl-2 -mb-px border border-r-0 border-l-0 border-gray-300 no-underline flex justify-between items-center flex-wrap"
                >
                  <div class="flex items-center gap-2">
                    <!-- <span
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
                    </span> -->

                    <h6 class="mb-0 flex items-center gap-1">
                      <!-- <span class="inline-block align-middle mr-2">
                      </span> -->
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          width="20"
                          height="20"
                          id="github"
                        >
                          <path
                            fill-rule="evenodd"
                            d="M10 0c5.523 0 10 4.59 10 10.253 0 4.529-2.862 8.371-6.833 9.728-.507.101-.687-.219-.687-.492 0-.338.012-1.442.012-2.814 0-.956-.32-1.58-.679-1.898 2.227-.254 4.567-1.121 4.567-5.059 0-1.12-.388-2.034-1.03-2.752.104-.259.447-1.302-.098-2.714 0 0-.838-.275-2.747 1.051A9.396 9.396 0 0 0 10 4.958a9.375 9.375 0 0 0-2.503.345C5.586 3.977 4.746 4.252 4.746 4.252c-.543 1.412-.2 2.455-.097 2.714-.639.718-1.03 1.632-1.03 2.752 0 3.928 2.335 4.808 4.556 5.067-.286.256-.545.708-.635 1.371-.57.262-2.018.715-2.91-.852 0 0-.529-.985-1.533-1.057 0 0-.975-.013-.068.623 0 0 .655.315 1.11 1.5 0 0 .587 1.83 3.369 1.21.005.857.014 1.665.014 1.909 0 .271-.184.588-.683.493C2.865 18.627 0 14.783 0 10.253 0 4.59 4.478 0 10 0"
                          ></path>
                        </svg>
                      Github
                    </h6>
                  </div>

                  <Field
                    class="w-full px-4 skin-input rounded-md max-w-[calc(100%-100px)]"
                    type="text"
                    name="github"
                    placeholder="github"
                    v-model="dataProfile.infor.github"
                  />
                </li>
              </ul>
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
                        :checked="dataProfile.infor.day === item"
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
                        :checked="dataProfile.infor.month === item"
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
                        :checked="dataProfile.infor.year === item"
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
                        :checked="dataProfile.infor.gender === item.value"
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

            <draggable
              v-model="dataProfile.content"
              tag="div"
              @change="handleUpdateIndex(dataProfile.content)"
            >
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
                        v-model="item.description"
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
import { ref, inject, computed, watch } from "vue";
import { Field, Form } from "vee-validate";
import draggable from "vuedraggable";
import moment from "moment/moment";
import { useStore } from "vuex";
import { MODULE_STORE } from "@/const";
import { useRoute } from "vue-router";

import { uploadAvatarApi, createOrUpdateApi, getInforApi } from "@/api";

const store = useStore();
const route = useRoute();

const toast = inject("$toast");
const typeImage = ref("");
const dateFormatList = ["DD/MM/YYYY", "DD/MM/YY"];

const user_id = ref(route?.query?.user_id);
watch(route, (val) => {
  if (val?.query?.user_id) user_id.value = val?.query?.user_id;
});

const listGenders = ref([
  {
    value: "0",
    label: "Male",
  },
  {
    value: "1",
    label: "Female",
  },
  {
    value: "2",
    label: "Other",
  },
]);

const dataProfile = ref({
  infor: {
    full_name: "Nguyen Dang Duc",
    gender: "0",
    day: "16",
    month: "04",
    year: "2001",
    birthday_inder: "",
    email: "ducden164@gmail.com",
    address: "Phuc Cau village, Thuy Huong commune, Chuong My district, Hanoi city",
    phone_number: "0967771606",
    position_application: "Fullstack Developer",
    work_experience: "2 year",
    active: 0,
    type: "admin",
  },
  list_link_social: [
    {
      icon: `Github`,
      title: "Github",
      link_url: "https://github.com/dangduc164",
      order_number: 0,
    },
    {
      icon: `Twitter`,
      title: "Twitter",
      link_url: "https://twitter.com/uc_ang4740",
      order_number: 1,
    },
    {
      icon: `Instagram`,
      title: "Instagram",
      link_url: "https://www.instagram.com/ducden164/",
      order_number: 2,
    },
    {
      icon: `Facebook`,
      titles: "Facebook",
      link_url: "https://www.facebook.com/ducden.164",
      order_number: 3,
    },
  ],
  content: [
    {
      title: "1",
      description: `- In the short term: Efforts in the shortest time to meet job requirements. Become an official employee of the company. \n
- Learn and absorb new technological knowledge. \n
- In the long term: Become a professional programmer and stay with the company for a long time. Promote and become a Leader.
`,
      order_number: 0,
    },
    {
      title: "2",
      description: `- In the short term: Efforts in the shortest time to meet job requirements. Become an official employee of the company. \n
- Learn and absorb new technological knowledge. \n
- In the long term: Become a professional programmer and stay with the company for a long time. Promote and become a Leader.
`,
      order_number: 1,
    },
  ],
});
const handleAddRowContent = () => {
  dataProfile.value.content.push({
    title: "",
    description: "",
    order_number: dataProfile.value.content.length,
  });
  window.scrollTo({ left: 0, top: document.body.scrollHeight, behavior: "smooth" });
};

const handleRemoveRowContent = (index) => {
  const updatedContent = dataProfile.value.content
    .slice(0, index)
    .concat(dataProfile.value.content.slice(index + 1));
  dataProfile.value.content = updatedContent;
};

const handleUpdateIndex = (data) => {
  if (data) {
    data.forEach((item, index) => {
      item.order_number = index;
    });
    dataProfile.value.content = data;
  }
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
  const img = document.querySelector("img[alt='avatar']");
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
  formData.append("user_id", user_id.value);

  try {
    store.state[MODULE_STORE.COMMON.NAME].isLoadingPage = true;
    const res = await uploadAvatarApi(formData);
    toast.success("upload avatar success");
  } catch (errors) {
    const error = errors.message || t("common.has_error");
    toast.error(error);
  } finally {
    store.state[MODULE_STORE.COMMON.NAME].isLoadingPage = false;
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
    link_url: "",
    order_number: dataProfile.value.list_link_social.length,
  });
};

const handleRemoveLinkSocial = (index) => {
  const updatedContent = dataProfile.value.list_link_social
    .slice(0, index)
    .concat(dataProfile.value.list_link_social.slice(index + 1));
  dataProfile.value.list_link_social = updatedContent;
};

const handleSubmitForm = async () => {
  try {
    store.state[MODULE_STORE.COMMON.NAME].isLoadingPage = true;
    dataProfile.value.infor.birthday_inder =
      dataProfile.value.infor.day +
      dataProfile.value.infor.month +
      dataProfile.value.infor.year;
    await createOrUpdateApi(user_id.value, dataProfile.value);
    await handleGetInfor(user_id.value);
    toast.success("success");
  } catch (error) {
    toast.error(error.message);
  } finally {
    store.state[MODULE_STORE.COMMON.NAME].isLoadingPage = false;
  }
};

const handleGetInfor = async (id) => {
  try {
    store.state[MODULE_STORE.COMMON.NAME].isLoadingPage = true;

    const res = await getInforApi(id);
    if (res) {
      dataProfile.value = res;
    }
    console.log(dataProfile.value);
  } catch (error) {
    toast.error(error.message);
  } finally {
    store.state[MODULE_STORE.COMMON.NAME].isLoadingPage = false;
  }
};

watch(
  route,
  async () => {
    if (route.query.user_id) {
      await handleGetInfor(route.query.user_id);
    }
  },
  {
    immediate: true,
    deep: true,
  }
);
</script>

<style lang="scss" scoped>
.no_value {
  color: #ccc;
}
</style>
