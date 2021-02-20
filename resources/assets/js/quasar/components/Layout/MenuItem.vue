<template>
  <div class="menu-item-wrapper">
    <template v-for="menu in data">
      <q-expansion-item
        :key="menu.id"
        v-if="menu.children.length > 0"
        :icon="menu.icon_class"
        :label="menu.title"
        expand-separator
      >
        <menu-item
          :data="menu.children"
          :activeMenu="activeMenu"
          @nav="handleNav"
        />
      </q-expansion-item>

      <q-item
        v-else
        :key="menu.id"
        clickable
        v-ripple
        :active="isActive(menu)"
        active-class="bg-secondary text-orange"
        @click="handleNav(menu)"
      >
        <q-item-section avatar>
          <q-icon :name="menu.icon_class" />
        </q-item-section>

        <q-item-section>{{ menu.title }}</q-item-section>
      </q-item>
    </template>
  </div>
</template>

<script>
export default {
  components: {
    MenuItem: () => import("./MenuItem.vue"),
  },
  props: {
    data: {
      type: Array,
      required: true,
    },
    activeMenu: {
      type: Object,
      default: {},
    },
  },

  methods: {
    handleNav(menu) {
      this.$emit("nav", menu);
    },
    isActive(menu) {
      return this.activeMenu.id == menu.id;
    },
  },
};
</script>

<style lang="scss">
.menu-item-wrapper {
  .q-item__section--avatar {
    color: #768393;
    min-width: 36px;
    padding-left: 0px;
  }
  .q-item__section--avatar .q-icon {
    font-size: 18px;
  }

  .q-item__section--avatar + .q-item__section--main {
    color: #768393;
    font-size: 16px;
  }
  .q-item:hover {
    .q-item__section--avatar,
    .q-item__section--avatar + .q-item__section--main {
      color: #fff;
    }
  }
  .menu-item-wrapper > .q-item {
    padding-left: 30px;
  }
}
</style>
