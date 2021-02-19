<template>
  <q-layout view="lHh lpR lFf">
    <q-header class="bg-white text-grey-9" bordered height-hint="98">
      <q-toolbar>
        <q-btn dense flat round icon="menu" @click="left = !left" />
        <q-btn
          v-if="tabs.length"
          @click.stop="refreshPage"
          dense
          flat
          round
          icon="refresh"
        />
        <slot name="toolbar-left"></slot>

        <q-space />

        <slot name="toolbar-right"></slot>
      </q-toolbar>

      <page-tab
        :tabs="tabs"
        :activeTab="activeTab"
        @switch="toggleTab"
        @remove="removeTab"
      />
    </q-header>

    <q-drawer
      content-class="bg-grey-10 text-white"
      show-if-above
      v-model="left"
      side="left"
      behavior="desktop"
      :width="230"
      bordered
    >
      <q-toolbar class="text-center">
        <q-toolbar-title>{{ config.name }}</q-toolbar-title>
      </q-toolbar>
      <q-scroll-area style="height: calc(100% - 50px)" dark>
        <left-menu
          v-if="tree"
          :tree="tree"
          :activeMenu="activeTab"
          @nav="toggleTab"
        />
      </q-scroll-area>
    </q-drawer>

    <q-page-container :style="style">
      <div
        v-for="(tab, index) in tabs"
        :key="index"
        class="content"
        :class="{ show: activeTab && activeTab.id == tab.id }"
      >
        <iframe
          :ref="(el) => (pages[`page_${tab.id}`] = el)"
          frameborder="0"
          :src="tab.url"
          class="iframe"
        />
      </div>
    </q-page-container>
  </q-layout>
</template>

<script>
import { computed, defineComponent, reactive, ref } from "vue";
import { useQuasar } from "quasar";

import { useConfig } from "../../uses/useConfig";
import { useAdminMenu } from "../../uses/store/useAdminMenu";
import { usePageTab } from "../../uses/usePageTab";
import LeftMenu from "./LeftMenu";
import PageTab from "./PageTab";

export default defineComponent({
  components: {
    LeftMenu,
    PageTab,
  },
  setup() {
    const $q = useQuasar();

    const { config } = useConfig();

    const state = reactive({ left: false, height: $q.screen.height });

    const style = computed(() => ({ height: $q.screen.height + "px" }));

    const pages = ref([]);

    const refreshPage = () => {
      const key = `page_${activeTab.id}`;
      if (pages[key]) {
        const $el = pages[key][0];
        $el.contentWindow.location.reload(!0);
      }
    };

    const { tabs, activeTab, toggleTab, removeTab } = usePageTab();

    const { tree, loadMenu } = useAdminMenu();
    loadMenu();

    return {
      config,
      ...state,
      style,
      pages,
      refreshPage,
      tabs,
      activeTab,
      toggleTab,
      removeTab,
      tree,
      loadMenu,
    };
  },
  // data() {
  //   return {
  //     left: false,
  //     height: this.$q.screen.height,
  //   };
  // },
  // created() {
  //   this.loadTree();
  // },
  // computed: {
  //   ...mapState("menu", ["tree"]),
  //   ...mapGetters("menu", ["tabs", "activeTab"]),
  //   style() {
  //     return { height: this.$q.screen.height + "px" };
  //   },
  // },
  // methods: {
  //   ...mapActions("menu", ["loadTree", "toggleTab", "removeTab"]),
  //   refreshPage() {
  //     const key = `page_${this.activeTab.id}`;
  //     if (this.$refs[key]) {
  //       const $el = this.$refs[key][0];
  //       $el.contentWindow.location.reload(!0);
  //     }
  //   },
  // },
});
</script>

<style lang="scss" scoped>
.content {
  position: relative;
  height: 100%;
  width: 100%;
  display: none;

  &.show {
    display: block;
  }

  .iframe {
    position: absolute;
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
  }
}
</style>
