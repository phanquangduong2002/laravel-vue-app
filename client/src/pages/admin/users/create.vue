<template>
  <div class="pb-24">
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
        <li>Tạo mới tài khoản</li>
      </ul>
    </div>
    <form @submit.prevent="createUser">
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
              <span>Tình trạng:</span>
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
          <div class="grid grid-cols-4 gap-6 mb-6 items-center justify-center">
            <div class="col-span-4 sm:col-span-1 text-start sm:text-end">
              <span class="text-rose-600 mr-2">*</span>
              <span>Tên tài khoản:</span>
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
          <div class="grid grid-cols-4 gap-6 mb-6 items-center justify-center">
            <div class="col-span-4 sm:col-span-1 text-start sm:text-end">
              <span class="text-rose-600 mr-2">*</span>
              <span>Họ tên:</span>
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
          <div class="grid grid-cols-4 gap-6 mb-6 items-center justify-center">
            <div class="col-span-4 sm:col-span-1 text-start sm:text-end">
              <span class="text-rose-600 mr-2">*</span>
              <span>Email:</span>
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
          <div class="grid grid-cols-4 gap-6 mb-6 items-center justify-center">
            <div class="col-span-4 sm:col-span-1 text-start sm:text-end">
              <span class="text-rose-600 mr-2">*</span>
              <span>Phòng ban:</span>
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
          <div class="grid grid-cols-4 gap-6 mb-6 items-center justify-center">
            <div class="col-span-4 sm:col-span-1 text-start sm:text-end">
              <span class="text-rose-600 mr-2">*</span>
              <span>Mật khẩu:</span>
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
          <div class="grid grid-cols-4 gap-6 mb-6 items-center justify-center">
            <div class="col-span-4 sm:col-span-1 text-start sm:text-end">
              <span class="text-rose-600 mr-2">*</span>
              <span>Xác nhận mật khẩu:</span>
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
  </div>
</template>

<script>
import { defineComponent, ref, reactive, toRefs } from 'vue';
import { useMenu } from '../../../store/useMenu.js';

export default defineComponent({
  setup() {
    const store = useMenu();

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

    const getUsersCreate = async () => {
      try {
        const res = await axios.get('http://localhost:8000/api/users/create');
        users_status.value = res.data.users_status;
        departments.value = res.data.departments;
      } catch (error) {
        console.log(error);
      }
    };

    getUsersCreate();

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

    const createUser = async () => {
      try {
        const res = await axios.post(
          'http://localhost:8000/api/users/create',
          user
        );
        console.log(res.data);
      } catch (error) {
        errors.value = error.response.data.errors;
        console.log(errors);
      }
    };

    return {
      store,
      avatarURL,
      ...toRefs(user),
      errors,
      onChangeFile,
      typePassword,
      typeConfirmPassword,
      onChangeTypePassword,
      onChangeTypeConfirmPassword,
      users_status,
      departments,
      createUser,
    };
  },
});
</script>
