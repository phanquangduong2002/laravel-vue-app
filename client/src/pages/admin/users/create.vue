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
              class="select select-secondary h-9 min-h-[36px] w-full sm:max-w-[300px]"
            >
              <option>Hoạt động</option>
              <option>Tạm khóa</option>
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
              class="select select-secondary h-9 min-h-[36px] w-full sm:max-w-[300px]"
            >
              <option>Quản trị</option>
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
            <label class="cursor-pointer label justify-start gap-6">
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
        class="px-4 py-1 rounded bg-purple-400 hover:bg-purple-500 text-white text-sm transition-all duration-200 ease-in-out"
      >
        Lưu
      </button>
    </div>
  </div>
</template>

<script>
import { defineComponent, ref } from 'vue';
import { useMenu } from '../../../store/useMenu.js';

export default defineComponent({
  setup() {
    const store = useMenu();

    const avatarURL = ref(
      'https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg'
    );

    const typePassword = ref(true);
    const typeConfirmPassword = ref(true);

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
      avatarURL,
      onChangeFile,
      typePassword,
      typeConfirmPassword,
      onChangeTypePassword,
      onChangeTypeConfirmPassword,
    };
  },
});
</script>
