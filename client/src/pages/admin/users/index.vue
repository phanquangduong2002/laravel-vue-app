<template>
  <div>
    <div class="flex items-center justify-between mb-8">
      <div class="text-sm breadcrumbs">
        <ul>
          <li>
            <router-link :to="{ name: 'admin' }" @click="store.onActiveMenu(0)"
              >Admin</router-link
            >
          </li>
          <li>Tài khoản</li>
        </ul>
      </div>
      <router-link :to="{ name: 'admin-users-create' }" class="inline-block">
        <button class="px-4 py-0 bg-purple-400 hover:bg-purple-500 rounded-md">
          <img src="../../../assets/icons/add.svg" alt="Thêm" /></button
      ></router-link>
    </div>
    <div class="overflow-x-auto">
      <table class="table">
        <!-- head -->
        <thead>
          <tr>
            <th>STT</th>
            <th>Avatar</th>
            <th>Tài khoản</th>
            <th>Họ tên</th>
            <th>Phòng ban</th>
            <th>Vai trò</th>
            <th>Tình trạng</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id" class="hover">
            <td>{{ user.id }}</td>
            <td>
              <div class="flex items-center gap-3">
                <div class="avatar">
                  <div class="mask rounded-full w-12 h-12">
                    <img
                      src="../../../assets/images/avatar.jpg"
                      alt="Avatar Tailwind CSS Component"
                    />
                  </div>
                </div>
              </div>
            </td>
            <td>{{ user.name }}</td>
            <td>{{ user.username }}</td>
            <td>{{ user.department }}</td>
            <td></td>
            <td
              :class="
                user.status_id === 1 ? 'text-emerald-400' : 'text-rose-500'
              "
            >
              {{ user.status }}
            </td>
            <th>
              <button class="btn btn-ghost btn-xs">Chỉnh sửa</button>
            </th>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import { defineComponent, ref } from 'vue';
import { useMenu } from '../../../store/useMenu.js';
export default defineComponent({
  setup() {
    const store = useMenu();
    const users = ref([]);

    const getUsers = async () => {
      try {
        const res = await axios.get('http://localhost:8000/api/users');
        users.value = res.data.data;
      } catch (error) {
        console.log(error);
      }
    };

    getUsers();

    return {
      users,
      store,
    };
  },
});
</script>
