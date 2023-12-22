<template>
  <div>
    <Header />
    <div class="grid grid-cols-4 gap-6">
      <div class="p-4 hidden md:block col-span-1">
        <SideBar />
      </div>
      <div class="p-4 col-span-4 md:col-span-3">
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>

<script>
import Header from '../components/Header.vue';
import SideBar from '../components/SideBar.vue';
export default {
  components: { Header, SideBar },
  setup() {},
};
</script>
