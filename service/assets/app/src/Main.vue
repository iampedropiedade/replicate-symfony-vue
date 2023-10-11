<template>
  <loading :loading="false" />
  <router />
</template>

<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import Router from './views/Router/Main.vue';
import {useSettingsStore} from './stores/Settings';
import Loading from "./views/Elements/Loading.vue";

export default {
  components: {
    Loading,
    FontAwesomeIcon,
    Router
  },
  props: {
    route: {required: true, type: String},
    mercureUrl: {required: true, type: String},
  },
  data() {
    return {
      settingsStore: useSettingsStore(),
    }
  },
  methods: {
    init() {
      this.settingsStore.mercureUrl = this.mercureUrl;
      this.$router.push(this.route)
    },
  },
  created() {
    this.init()
  },
}
</script>
