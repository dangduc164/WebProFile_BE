<template>
  <div class="container mx-auto px-4">
    <div class="main-body py-5 md:py-10">
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
                        class="w-full px-2 md:px-4 skin-input rounded-md"
                        type="text"
                        name="position_application"
                        placeholder="Frontend develop"
                        v-model="dataProfile.infor.position_application"
                      />
                    </p>
                    <p class="text-gray-600 mb-1">
                      <Field
                        class="w-full px-2 md:px-4 skin-input rounded-md"
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
                  class="relative p-2 md:py-3 md:px-6 -mb-px border border-r-0 border-l-0 border-gray-300 no-underline flex justify-between items-center flex-wrap"
                >
                  <div class="flex items-center gap-2">
                    <h6 class="mb-0 flex items-center gap-2">
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
                    class="w-full px-2 md:px-4 skin-input rounded-md md:max-w-[calc(100%-130px)] max-w-[calc(100%-110px)]"
                    type="text"
                    name="github_url"
                    placeholder="github url"
                    v-model="dataProfile.link_social.github_url"
                  />
                </li>
                <li
                  class="relative p-2 md:py-3 md:px-6 -mb-px border border-r-0 border-l-0 border-gray-300 no-underline flex justify-between items-center flex-wrap"
                >
                  <div class="flex items-center gap-2">
                    <h6 class="mb-0 flex items-center gap-2">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 16 16"
                        id="facebook"
                      >
                        <path
                          fill="#1976D2"
                          d="M14 0H2C.897 0 0 .897 0 2v12c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2V2c0-1.103-.897-2-2-2z"
                        ></path>
                        <path
                          fill="#FAFAFA"
                          fill-rule="evenodd"
                          d="M13.5 8H11V6c0-.552.448-.5 1-.5h1V3h-2a3 3 0 0 0-3 3v2H6v2.5h2V16h3v-5.5h1.5l1-2.5z"
                          clip-rule="evenodd"
                        ></path>
                      </svg>
                      Facebook
                    </h6>
                  </div>

                  <Field
                    class="w-full px-2 md:px-4 skin-input rounded-md md:max-w-[calc(100%-130px)] max-w-[calc(100%-110px)]"
                    type="text"
                    name="facebook_url"
                    placeholder="facebook url"
                    v-model="dataProfile.link_social.facebook_url"
                  />
                </li>
                <li
                  class="relative p-2 md:py-3 md:px-6 -mb-px border border-r-0 border-l-0 border-gray-300 no-underline flex justify-between items-center flex-wrap"
                >
                  <div class="flex items-center gap-2">
                    <h6 class="mb-0 flex items-center gap-2">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 50 50"
                        fill="none"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M22.782 0.166016H27.199C33.2653 0.166016 36.8103 1.05701 39.9572 2.74421C43.1041 4.4314 45.5875 6.89585 47.2557 10.0428C48.9429 13.1897 49.8339 16.7347 49.8339 22.801V27.1991C49.8339 33.2654 48.9429 36.8104 47.2557 39.9573C45.5685 43.1042 43.1041 45.5877 39.9572 47.2559C36.8103 48.9431 33.2653 49.8341 27.199 49.8341H22.8009C16.7346 49.8341 13.1896 48.9431 10.0427 47.2559C6.89583 45.5687 4.41243 43.1042 2.7442 39.9573C1.057 36.8104 0.166016 33.2654 0.166016 27.1991V22.801C0.166016 16.7347 1.057 13.1897 2.7442 10.0428C4.43139 6.89585 6.89583 4.41245 10.0427 2.74421C13.1707 1.05701 16.7346 0.166016 22.782 0.166016Z"
                          fill="#0068FF"
                        />
                        <path
                          opacity="0.12"
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M49.8336 26.4736V27.1994C49.8336 33.2657 48.9427 36.8107 47.2555 39.9576C45.5683 43.1045 43.1038 45.5879 39.9569 47.2562C36.81 48.9434 33.265 49.8344 27.1987 49.8344H22.8007C17.8369 49.8344 14.5612 49.2378 11.8104 48.0966L7.27539 43.4267L49.8336 26.4736Z"
                          fill="#001A33"
                        />
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M7.779 43.5892C10.1019 43.846 13.0061 43.1836 15.0682 42.1825C24.0225 47.1318 38.0197 46.8954 46.4923 41.4732C46.8209 40.9803 47.1279 40.4677 47.4128 39.9363C49.1062 36.7779 50.0004 33.22 50.0004 27.1316V22.7175C50.0004 16.629 49.1062 13.0711 47.4128 9.91273C45.7385 6.75436 43.2461 4.28093 40.0877 2.58758C36.9293 0.894239 33.3714 0 27.283 0H22.8499C17.6644 0 14.2982 0.652754 11.4699 1.89893C11.3153 2.03737 11.1636 2.17818 11.0151 2.32135C2.71734 10.3203 2.08658 27.6593 9.12279 37.0782C9.13064 37.0921 9.13933 37.1061 9.14889 37.1203C10.2334 38.7185 9.18694 41.5154 7.55068 43.1516C7.28431 43.399 7.37944 43.5512 7.779 43.5892Z"
                          fill="white"
                        />
                        <path
                          d="M20.5632 17H10.8382V19.0853H17.5869L10.9329 27.3317C10.7244 27.635 10.5728 27.9194 10.5728 28.5639V29.0947H19.748C20.203 29.0947 20.5822 28.7156 20.5822 28.2606V27.1421H13.4922L19.748 19.2938C19.8428 19.1801 20.0134 18.9716 20.0893 18.8768L20.1272 18.8199C20.4874 18.2891 20.5632 17.8341 20.5632 17.2844V17Z"
                          fill="#0068FF"
                        />
                        <path
                          d="M32.9416 29.0947H34.3255V17H32.2402V28.3933C32.2402 28.7725 32.5435 29.0947 32.9416 29.0947Z"
                          fill="#0068FF"
                        />
                        <path
                          d="M25.814 19.6924C23.1979 19.6924 21.0747 21.8156 21.0747 24.4317C21.0747 27.0478 23.1979 29.171 25.814 29.171C28.4301 29.171 30.5533 27.0478 30.5533 24.4317C30.5723 21.8156 28.4491 19.6924 25.814 19.6924ZM25.814 27.2184C24.2785 27.2184 23.0273 25.9672 23.0273 24.4317C23.0273 22.8962 24.2785 21.645 25.814 21.645C27.3495 21.645 28.6007 22.8962 28.6007 24.4317C28.6007 25.9672 27.3685 27.2184 25.814 27.2184Z"
                          fill="#0068FF"
                        />
                        <path
                          d="M40.4867 19.6162C37.8516 19.6162 35.7095 21.7584 35.7095 24.3934C35.7095 27.0285 37.8516 29.1707 40.4867 29.1707C43.1217 29.1707 45.2639 27.0285 45.2639 24.3934C45.2639 21.7584 43.1217 19.6162 40.4867 19.6162ZM40.4867 27.2181C38.9322 27.2181 37.681 25.9669 37.681 24.4124C37.681 22.8579 38.9322 21.6067 40.4867 21.6067C42.0412 21.6067 43.2924 22.8579 43.2924 24.4124C43.2924 25.9669 42.0412 27.2181 40.4867 27.2181Z"
                          fill="#0068FF"
                        />
                        <path
                          d="M29.4562 29.0944H30.5747V19.957H28.6221V28.2793C28.6221 28.7153 29.0012 29.0944 29.4562 29.0944Z"
                          fill="#0068FF"
                        />
                      </svg>
                      Zalo
                    </h6>
                  </div>

                  <Field
                    class="w-full px-2 md:px-4 skin-input rounded-md md:max-w-[calc(100%-130px)] max-w-[calc(100%-110px)]"
                    type="text"
                    name="zalo_url"
                    placeholder="zalo url"
                    v-model="dataProfile.link_social.zalo_url"
                  />
                </li>
                <li
                  class="relative p-2 md:py-3 md:px-6 -mb-px border border-r-0 border-l-0 border-gray-300 no-underline flex justify-between items-center flex-wrap"
                >
                  <div class="flex items-center gap-2">
                    <h6 class="mb-0 flex items-center gap-2">
                      <svg
                        width="24"
                        height="24"
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                        aria-label="Instagram"
                        viewBox="0 0 512 512"
                      >
                        <rect id="b" width="512" height="512" rx="15%" />
                        <use fill="url(#a)" xlink:href="#b" />
                        <use fill="url(#c)" xlink:href="#b" />
                        <radialGradient id="a" cx=".4" cy="1" r="1">
                          <stop offset=".1" stop-color="#fd5" />
                          <stop offset=".5" stop-color="#ff543e" />
                          <stop offset="1" stop-color="#c837ab" />
                        </radialGradient>
                        <linearGradient id="c" x2=".2" y2="1">
                          <stop offset=".1" stop-color="#3771c8" />
                          <stop offset=".5" stop-color="#60f" stop-opacity="0" />
                        </linearGradient>
                        <g fill="none" stroke="#fff" stroke-width="30">
                          <rect width="308" height="308" x="102" y="102" rx="81" />
                          <circle cx="256" cy="256" r="72" />
                          <circle cx="347" cy="165" r="6" />
                        </g>
                      </svg>
                      Intagram
                    </h6>
                  </div>

                  <Field
                    class="w-full px-2 md:px-4 skin-input rounded-md md:max-w-[calc(100%-130px)] max-w-[calc(100%-110px)]"
                    type="text"
                    name="instagram_url"
                    placeholder="instagram url"
                    v-model="dataProfile.link_social.instagram_url"
                  />
                </li>
              </ul>
              <!-- <ul class="flex flex-col pl-0 mb-0 border rounded border-gray-300">
                <li
                  v-for="(item, index) in dataProfile?.list_link_social"
                  :key="index"
                  class="relative block py-3 px-6 -mb-px border border-r-0 border-l-0 border-gray-300 no-underline flex justify-between items-center flex-wrap"
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
              </ul> -->
            </div>
          </div>

          <div class="md:w-2/3 w-full pr-4 pl-4">
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
                  <div class="w-1/4 px-2 md:px-4">
                    <h6 class="mb-0">Full Name</h6>
                  </div>

                  <div class="w-3/4 text-gray-600">
                    <Field
                      class="w-full px-2 md:px-4 skin-input rounded-md"
                      type="text"
                      v-model="dataProfile.infor.full_name"
                      name="full_name"
                    />
                  </div>
                </div>
                <hr />
                <div class="flex flex-wrap items-center min-h-8">
                  <div class="w-1/4 px-2 md:px-4">
                    <h6 class="mb-0">BirthDay</h6>
                  </div>
                  <div class="w-3/4 text-gray-600 flex items-center gap-2">
                    <Field
                      class="w-full px-2 md:px-4 skin-input rounded-md"
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
                      class="w-full px-2 md:px-4 skin-input rounded-md"
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
                      class="w-full px-2 md:px-4 skin-input rounded-md"
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
                  </div>
                </div>
                <hr />
                <div class="flex flex-wrap items-center min-h-8">
                  <div class="w-1/4 px-2 md:px-4">
                    <h6 class="mb-0">Gender</h6>
                  </div>
                  <div class="w-3/4 text-gray-600">
                    <Field
                      class="w-full px-2 md:px-4 skin-input rounded-md md:max-w-[230px]"
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
                  <div class="w-1/4 px-2 md:px-4">
                    <h6 class="mb-0">Email</h6>
                  </div>
                  <div class="w-3/4 text-gray-600">
                    <Field
                      class="w-full px-2 md:px-4 skin-input rounded-md"
                      type="text"
                      v-model="dataProfile.infor.email"
                      name="email"
                    />
                  </div>
                </div>
                <hr />
                <div class="flex flex-wrap items-center min-h-8">
                  <div class="w-1/4 px-2 md:px-4">
                    <h6 class="mb-0">Phone</h6>
                  </div>
                  <div class="w-3/4 text-gray-600">
                    <Field
                      class="w-full px-2 md:px-4 skin-input rounded-md"
                      type="text"
                      v-model="dataProfile.infor.phone_number"
                      name="phone_number"
                    />
                  </div>
                </div>
                <hr />
                <div class="flex flex-wrap items-center min-h-8">
                  <div class="w-1/4 px-2 md:px-4">
                    <h6 class="mb-0">Address</h6>
                  </div>
                  <div class="w-3/4 text-gray-600 mt-2">
                    <Field
                      id="address"
                      class="w-full px-2 md:px-4 skin-input rounded-md"
                      type="text"
                      as="textarea"
                      v-model="dataProfile.infor.address"
                      name="address"
                      @keyup="handleResizeTextarea('address', dataProfile.infor.address)"
                      @keydown="
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
  link_social: {
    github_url: "",
    zalo_url: "",
    facebook_url: "",
    twitter_url: "",
    instagram_url: "",
  },
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
  content: [
    {
      title: "",
      description: "",
      order_number: 0,
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

// const handleAddLinkSocial = () => {
//   dataProfile.value.list_link_social.push({
//     icon: "",
//     label: "",
//     link_url: "",
//     order_number: dataProfile.value.list_link_social.length,
//   });
// };

// const handleRemoveLinkSocial = (index) => {
//   const updatedContent = dataProfile.value.list_link_social
//     .slice(0, index)
//     .concat(dataProfile.value.list_link_social.slice(index + 1));
//   dataProfile.value.list_link_social = updatedContent;
// };

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
    toast.error(error.message || "error");
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
      const newPathImg = dataProfile.value.infor.avatar_url.replace("public", "storage");
      dataProfile.value.infor.avatar_url = newPathImg;
    }
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
