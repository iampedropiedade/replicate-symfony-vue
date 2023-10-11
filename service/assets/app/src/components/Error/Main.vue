<template>
  <div class="card-holder">
    <div class="card p-4">
      <div class="card-body">
        <h1 class="h1">Oh no, something bad happened!</h1>
        <h6 class="h6">I've received the following error:</h6>
        <div class="my-4 text-danger">
          {{ settingsStore.errors }}
        </div>
        <div class="d-grid gap-2 mt-3">
          <button type="submit" class="btn btn-primary p-3 btn-lg" v-on:click.prevent="back()">Maybe go back and try again!</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { useSettingsStore } from "../../stores/Settings"

export default {
  name: 'Error',
  components: {
    FontAwesomeIcon
  },
  data() {
    return {
      settingsStore: useSettingsStore(),
    }
  },
  methods: {
    back() {
      this.settingsStore.errors = null
      this.$router.push('/')
    },
  },
}
</script>