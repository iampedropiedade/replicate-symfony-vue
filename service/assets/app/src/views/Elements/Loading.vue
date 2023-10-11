<template>
  <div v-if="loading" class="vh-100"  style="display: flex; align-items: center; justify-content: center; flex-flow: column wrap; box-sizing: border-box;z-index: 999; position: absolute; width: 100%; top: 0; left: 0;">
    <font-awesome-icon icon="fa-solid fa-circle-notch" class="fa-spin fa-8x text-light" />
  </div>
</template>
<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

export default {
  name: 'Loading',
  props: {
    loading: {required: true, type: Boolean},
  },
  components: {
    FontAwesomeIcon,
  },
}
</script>