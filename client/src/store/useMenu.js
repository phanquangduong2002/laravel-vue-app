import { defineStore } from 'pinia';

export const useMenu = defineStore('menuId', {
  state: () => ({
    activeMenu: 1,
  }),
  actions: {
    onActiveMenu(data) {
      this.activeMenu = data;
    },
  },
});
