<template>
  <div class="max-w-[1280px] px-10 py-3 mx-auto navbar bg-base-100">
    <div class="flex-1">
      <router-link :to="{ name: 'admin' }" class="btn btn-ghost text-xl"
        >ManageUI</router-link
      >
    </div>
    <div class="flex-none gap-4">
      <div class="form-control hidden md:block">
        <input
          type="text"
          placeholder="Tìm kiếm"
          class="input input-bordered w-24 md:w-auto"
        />
      </div>
      <div class="dropdown dropdown-end">
        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
          <div class="w-10 rounded-full">
            <img
              alt="Tailwind CSS Navbar component"
              src="../assets/images/avatar.jpg"
            />
          </div>
        </div>
        <ul
          tabindex="0"
          class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52"
        >
          <li>
            <router-link
              :to="{ name: 'admin-users' }"
              class="justify-between"
              @click="store.onActiveMenu(1)"
            >
              Tài khoản
              <span class="badge">Mới</span>
            </router-link>
          </li>
          <li>
            <router-link
              :to="{ name: 'admin-roles' }"
              @click="store.onActiveMenu(2)"
              >Vai trò</router-link
            >
          </li>
          <li>
            <router-link
              :to="{ name: 'admin-settings' }"
              @click="store.onActiveMenu(3)"
              >Cài đặt</router-link
            >
          </li>
          <li>
            <router-link :to="{ name: 'admin' }" @click="store.onActiveMenu(0)"
              >Đăng xuất</router-link
            >
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import { useMenu } from '../store/useMenu.js';
export default {
  setup() {
    const store = useMenu();

    return {
      store,
    };
  },
};
</script>
