<template>
  <loading :loading="false" />
  <div class="align-items-stretch flex-grow-1" :style="style">
    <div class="py-4 px-5">
      <router-view  v-slot="{ Component, route }">
        <transition :name="route.meta.transition || 'fade'" mode="out-in">
          <component :is="Component" />
        </transition>
      </router-view>
    </div>
  </div>
</template>
<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { useSettingsStore } from "../../stores/Settings";
import Loading from "../Elements/Loading.vue";

export default {
  name: 'Router',
  components: {
    Loading,
    FontAwesomeIcon,
  },
  props: {
    style: {required: false, type: String, default: ''},
  },
  data() {
    return {
      settingsStore: useSettingsStore()
    }
  },
}
</script>