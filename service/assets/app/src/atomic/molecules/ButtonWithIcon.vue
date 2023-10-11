<template>
  <button :type="type" :class="classes" v-on:click.prevent="action()">
    <font-awesome-icon :icon="icon.icon" :class="icon.class" v-if="icon?.position === 'start'" />
    <span class="flex-grow-1">{{ caption }}</span>
    <font-awesome-icon :icon="icon.icon" :class="icon.class" v-if="icon?.position === 'end'" />
  </button>
</template>
<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

export default {
  name: 'AppButton',
  props: {
    action: {required: false},
    caption: {required: false, type: String, default: 'Click me'},
    classes: {required: false, type: String, default: 'btn btn-primary w-100 d-flex'},
    type: {required: false, type: String, default: 'button'},
    icon: {required: false, type: Object, default: {
        icon: [],
        class: '',
        position: 'end'
      }
    },
  },
  components: {
    FontAwesomeIcon,
  },
}
</script>