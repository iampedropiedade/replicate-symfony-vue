<template>
  <div>
    <h1 class="display-1"><strong>404</strong></h1>
    <hr>
    <p>Try again pretty please...</p>
  </div>
</template>
<script>
import {  } from '@fortawesome/vue-fontawesome'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { useSettingsStore } from '../../stores/Settings'

export default {
  name: 'Route',
  components: {
    FontAwesomeIcon,
  },
  data() {
    return {
      settingsStore: useSettingsStore(),
    }
  },
  methods: {
  },
}
</script>