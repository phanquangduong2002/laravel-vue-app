<template>
  <div class="pb-24 relative">
    <div class="text-sm breadcrumbs">
      <ul>
        <li>
          <router-link :to="{ name: 'admin' }" @click="store.onActiveMenu(0)"
            >Admin</router-link
          >
        </li>
        <li>
          <router-link
            :to="{ name: 'admin-users' }"
            @click="store.onActiveMenu(1)"
            >Tài khoản</router-link
          >
        </li>
        <li>Cập nhật tài khoản</li>
      </ul>
    </div>
    <form @submit.prevent="updateUser">
      <div class="grid grid-cols-3 gap-6 my-8">
        <div
          class="col-span-3 sm:col-span-1 flex flex-col items-center justify-start"
        >
          <div class="avatar relative">
            <div class="w-[200px] rounded-full">
              <img :src="avatarURL" />
            </div>
            <div class="absolute pt-4 bottom-0 -right-2">
              <label
                tabindex="0"
                role="button"
                for="avatar"
                class="px-4 py-1 bg-purple-400 rounded-md h-8"
              >
                <span class="text-white text-sm">Edit</span>
              </label>
              <input
                type="file"
                class="w-0 h-0"
                id="avatar"
                @change="onChangeFile"
              />
            </div>
          </div>
        </div>
        <div class="col-span-3 sm:col-span-2">
          <div class="grid grid-cols-4 gap-6 mb-6 items-center justify-center">
            <div class="col-span-4 sm:col-span-1 text-start sm:text-end">
              <span class="text-rose-600 mr-2">*</span>
              <span :class="{ 'text-rose-600': errors.status_id }"
                >Tình trạng:</span
              >
            </div>
            <div class="col-span-4 sm:col-span-3">
              <select
                v-model="status_id"
                class="select select-secondary h-9 min-h-[36px] w-full sm:max-w-[300px]"
              >
                <option
                  v-for="status in users_status"
                  :key="status.id"
                  :value="status.id"
                >
                  {{ status.name }}
                </option>
              </select>
            </div>
          </div>
          <div
            v-if="errors.status_id"
            class="grid grid-cols-4 gap-6 items-center justify-center"
          >
            <div class="col-span-4 sm:col-span-1"></div>
            <div class="col-span-4 sm:col-span-3">
              <p v-if="errors.status_id" class="mb-4 text-rose-600 text-sm">
                {{ errors.status_id[0] }}
              </p>
            </div>
          </div>
          <div class="grid grid-cols-4 gap-6 mb-6 items-center justify-center">
            <div class="col-span-4 sm:col-span-1 text-start sm:text-end">
              <span class="text-rose-600 mr-2">*</span>
              <span :class="{ 'text-rose-600': errors.username }"
                >Tên tài khoản:</span
              >
            </div>
            <div class="col-span-4 sm:col-span-3">
              <input
                type="text"
                placeholder="Tên tài khoản"
                v-model="username"
                class="input input-bordered input-secondary h-9 min-h-[36px] w-full sm:max-w-[300px]"
              />
            </div>
          </div>
          <div
            v-if="errors.username"
            class="grid grid-cols-4 gap-6 items-center justify-center"
          >
            <div class="col-span-4 sm:col-span-1"></div>
            <div class="col-span-4 sm:col-span-3">
              <p v-if="errors.username" class="mb-4 text-rose-600 text-sm">
                {{ errors.username[0] }}
              </p>
            </div>
          </div>
          <div class="grid grid-cols-4 gap-6 mb-6 items-center justify-center">
            <div class="col-span-4 sm:col-span-1 text-start sm:text-end">
              <span class="text-rose-600 mr-2">*</span>
              <span :class="{ 'text-rose-600': errors.name }">Họ tên:</span>
            </div>
            <div class="col-span-4 sm:col-span-3">
              <input
                type="text"
                placeholder="Họ tên"
                v-model="name"
                class="input input-bordered input-secondary h-9 min-h-[36px] w-full sm:max-w-[300px]"
              />
            </div>
          </div>
          <div
            v-if="errors.name"
            class="grid grid-cols-4 gap-6 items-center justify-center"
          >
            <div class="col-span-4 sm:col-span-1"></div>
            <div class="col-span-4 sm:col-span-3">
              <p v-if="errors.name" class="mb-4 text-rose-600 text-sm">
                {{ errors.name[0] }}
              </p>
            </div>
          </div>
          <div class="grid grid-cols-4 gap-6 mb-6 items-center justify-center">
            <div class="col-span-4 sm:col-span-1 text-start sm:text-end">
              <span class="text-rose-600 mr-2">*</span>
              <span :class="{ 'text-rose-600': errors.email }">Email:</span>
            </div>
            <div class="col-span-4 sm:col-span-3">
              <input
                type="text"
                placeholder="Email"
                v-model="email"
                class="input input-bordered input-secondary h-9 min-h-[36px] w-full sm:max-w-[300px]"
              />
            </div>
          </div>
          <div
            v-if="errors.email"
            class="grid grid-cols-4 gap-6 items-center justify-center"
          >
            <div class="col-span-4 sm:col-span-1"></div>
            <div class="col-span-4 sm:col-span-3">
              <p v-if="errors.email" class="mb-4 text-rose-600 text-sm">
                {{ errors.email[0] }}
              </p>
            </div>
          </div>
          <div class="grid grid-cols-4 gap-6 mb-6 items-center justify-center">
            <div class="col-span-4 sm:col-span-1 text-start sm:text-end">
              <span class="text-rose-600 mr-2">*</span>
              <span :class="{ 'text-rose-600': errors.department_id }"
                >Phòng ban:</span
              >
            </div>
            <div class="col-span-4 sm:col-span-3">
              <select
                v-model="department_id"
                class="select select-secondary h-9 min-h-[36px] w-full sm:max-w-[300px]"
              >
                <option
                  v-for="department in departments"
                  :key="department.id"
                  :value="department.id"
                >
                  {{ department.name }}
                </option>
              </select>
            </div>
          </div>
          <div
            v-if="errors.department_id"
            class="grid grid-cols-4 gap-6 items-center justify-center"
          >
            <div class="col-span-4 sm:col-span-1"></div>
            <div class="col-span-4 sm:col-span-3">
              <p v-if="errors.department_id" class="mb-4 text-rose-600 text-sm">
                {{ errors.department_id[0] }}
              </p>
            </div>
          </div>
          <div class="grid grid-cols-4 gap-6 mb-6 items-center justify-center">
            <div class="col-span-4 sm:col-span-1 text-start sm:text-end">
              <span class="text-rose-600 mr-2">*</span>
              <span :class="{ 'text-rose-600': errors.password }"
                >Mật khẩu:</span
              >
            </div>
            <div class="col-span-4 sm:col-span-3">
              <div class="relative sm:max-w-[300px]">
                <input
                  :type="typePassword ? 'password' : 'text'"
                  placeholder="Mật khẩu"
                  v-model="password"
                  class="input input-bordered input-secondary h-9 min-h-[36px] w-full"
                />
                <button
                  v-if="typePassword"
                  @click="onChangeTypePassword"
                  class="absolute top-1/2 -translate-y-1/2 right-4"
                >
                  <img src="../../../assets/icons/eye-close.svg" alt="Eye" />
                </button>
                <button
                  v-if="!typePassword"
                  @click="onChangeTypePassword"
                  class="absolute top-1/2 -translate-y-1/2 right-4"
                >
                  <img src="../../../assets/icons/eye-open.svg" alt="Eye" />
                </button>
              </div>
            </div>
          </div>
          <div
            v-if="errors.password"
            class="grid grid-cols-4 gap-6 items-center justify-center"
          >
            <div class="col-span-4 sm:col-span-1"></div>
            <div class="col-span-4 sm:col-span-3">
              <p v-if="errors.password" class="mb-4 text-rose-600 text-sm">
                {{ errors.password[0] }}
              </p>
            </div>
          </div>
          <div class="grid grid-cols-4 gap-6 mb-6 items-center justify-center">
            <div class="col-span-4 sm:col-span-1 text-start sm:text-end">
              <span class="text-rose-600 mr-2">*</span>
              <span :class="{ 'text-rose-600': errors.password }"
                >Xác nhận mật khẩu:</span
              >
            </div>
            <div class="col-span-4 sm:col-span-3">
              <div class="relative sm:max-w-[300px]">
                <input
                  :type="typeConfirmPassword ? 'password' : 'text'"
                  placeholder="Xác nhận mật khẩu"
                  v-model="password_confirmation"
                  class="input input-bordered input-secondary h-9 min-h-[36px] w-full"
                />
                <button
                  v-if="typeConfirmPassword"
                  @click="onChangeTypeConfirmPassword"
                  class="absolute top-1/2 -translate-y-1/2 right-4"
                >
                  <img src="../../../assets/icons/eye-close.svg" alt="Eye" />
                </button>
                <button
                  v-if="!typeConfirmPassword"
                  @click="onChangeTypeConfirmPassword"
                  class="absolute top-1/2 -translate-y-1/2 right-4"
                >
                  <img src="../../../assets/icons/eye-open.svg" alt="Eye" />
                </button>
              </div>
            </div>
          </div>
          <div
            v-if="errors.password"
            class="grid grid-cols-4 gap-6 items-center justify-center"
          >
            <div class="col-span-4 sm:col-span-1"></div>
            <div class="col-span-4 sm:col-span-3">
              <p v-if="errors.password" class="mb-4 text-rose-600 text-sm">
                {{ errors.password[0] }}
              </p>
            </div>
          </div>
          <div
            class="grid grid-cols-4 gap-4 sm:gap-6 mb-6 items-center justify-center"
          >
            <div class="col-span-4 sm:col-span-1 text-start sm:text-end">
              <span class="text-rose-600 mr-2">*</span>
              <span>Vai trò:</span>
            </div>
            <div class="col-span-4 sm:col-span-3">
              <label
                class="cursor-pointer label justify-start gap-6 sm:max-w-[300px]"
              >
                <input
                  type="checkbox"
                  checked="checked"
                  class="checkbox checkbox-secondary"
                />
                <span class="label-text">Admin</span>
              </label>
            </div>
          </div>
        </div>
      </div>
      <div class="flex gap-4 items-center justify-end mr-8">
        <button
          class="px-4 py-1 rounded border-[1px] border-purple-400 hover:bg-purple-400 text-white text-sm transition-all duration-200 ease-in-out"
        >
          <router-link :to="{ name: 'admin-users' }">Hủy</router-link>
        </button>
        <button
          type="submit"
          class="px-4 py-1 rounded bg-purple-400 hover:bg-purple-500 text-white text-sm transition-all duration-200 ease-in-out"
        >
          Lưu
        </button>
      </div>
    </form>
    <Transition :css="false" @leave="(_, done) => motions.div.leave(done)">
      <div
        role="alert"
        v-if="show"
        v-motion="'div'"
        :initial="initial"
        :enter="enter"
        :leave="initial"
        :delay="200"
        class="alert alert-success max-w-[300px] text-white fixed top-20 right-10"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="stroke-current shrink-0 h-6 w-6"
          fill="none"
          viewBox="0 0 24 24"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
          />
        </svg>
        <span>Cập nhật tài khoản thành công!</span>
      </div>
    </Transition>
  </div>
</template>

<script>
import { defineComponent, ref, reactive, toRefs } from 'vue';
import { useMotions } from '@vueuse/motion';
import { useRouter, useRoute } from 'vue-router';

import { useMenu } from '../../../store/useMenu.js';

export default defineComponent({
  setup() {
    const store = useMenu();

    const router = useRouter();
    const route = useRoute();

    const avatarURL = ref(
      'https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg'
    );

    const typePassword = ref(true);
    const typeConfirmPassword = ref(true);

    const users_status = ref([]);
    const departments = ref([]);

    const user = reactive({
      username: '',
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
      department_id: [],
      status_id: [],
    });

    const errors = ref([]);

    const motions = useMotions();

    const show = ref(false);

    const initial = {
      x: 100,
      opacity: 0,
      transition: {
        stiffness: 100,
      },
    };

    const enter = {
      x: 0,
      opacity: 1,
      transition: {
        stiffness: 100,
        ease: 'easeInOut',
      },
    };

    const getUserProfile = async () => {
      try {
        const res = await axios.get(
          `http://localhost:8000/api/users/${route.params.id}/edit`
        );

        user.username = res.data.user.username;
        user.name = res.data.user.name;
        user.email = res.data.user.email;
        user.department_id = res.data.user.department_id;
        user.status_id = res.data.user.status_id;

        users_status.value = res.data.users_status;
        departments.value = res.data.departments;
      } catch (error) {
        console.log(error);
      }
    };

    getUserProfile();

    const updateUser = async () => {
      try {
        const res = await axios.put(
          `http://localhost:8000/api/users/${route.params.id}/edit`,
          user
        );
        console.log(res);
      } catch (error) {
        errors.value = error.response.data.errors;
        console.log(errors);
      }
    };

    const onChangeFile = (event) => {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
          avatarURL.value = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    };

    const onChangeTypePassword = () => {
      typePassword.value = !typePassword.value;
    };

    const onChangeTypeConfirmPassword = () => {
      typeConfirmPassword.value = !typeConfirmPassword.value;
    };

    return {
      store,
      motions,
      show,
      initial,
      enter,
      avatarURL,
      ...toRefs(user),
      errors,
      updateUser,
      onChangeFile,
      typePassword,
      typeConfirmPassword,
      onChangeTypePassword,
      onChangeTypeConfirmPassword,
      users_status,
      departments,
    };
  },
});
</script>
