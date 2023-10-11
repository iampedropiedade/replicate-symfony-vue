<template>
  <div class="col bg-light p-3 border-top footer-save-wrapper bottom-0 start-0 position-fixed w-100" :style="getStyle()">
    <button data-trigger="save" data-action="forms#disable" type="submit" class="btn btn-primary px-3 float-end" v-on:click.prevent="buttonAction" :disabled="buttonDisabled">
      <font-awesome-icon :icon="buttonIcon"  v-if="!buttonDisabled" />
      <font-awesome-icon icon="fa-solid fa-circle-notch" class="fa-spin text-light" v-if="buttonDisabled" />
      <span class="ps-2">{{ buttonTitle }}</span>
    </button>
  </div>
</template>
<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

export default {
  name: 'FormActions',
  props: {
    buttonTitle: {required: false, type: String, default: 'Update'},
    buttonIcon: {required: false, type: String, default: 'fa-solid fa-check'},
    buttonAction: {required: true},
    buttonDisabled: {required: false, type: Boolean, default: false},
  },
  data() {
    return {
    }
  },
  components: {
    FontAwesomeIcon,
  },
  methods: {
    getStyle() {
      let symfonyToolbar = document.querySelector('.sf-toolbar')
      let sidenavWidth = this.$refs.sidenav?.$el.clientWidth !== undefined ? this.$refs.sidenav?.$el.clientWidth : 0
      return 'z-index: 1000; padding-left: ' + sidenavWidth + 'px !important; bottom: ' + symfonyToolbar?.offsetHeight + 'px !important;'
    },
  },
}
</script>