<template>
  <div class="card-holder">
    <div style="z-index: 1002;">
      <h2 class="h2 text-light">I'm giving this a proper think...</h2>
      <h5 class="h5 text-light">... please bear with me for a moment!</h5>
    </div>
    <div class="vh-100" style="display: flex; align-items: center; justify-content: center; flex-flow: column wrap; box-sizing: border-box;z-index: 999; position: absolute; width: 100%; top: 0; left: 0;">
      <font-awesome-icon icon="fa-solid fa-circle-notch" class="fa-spin fa-8x text-light" style="z-index: 1001; position: absolute; width: 100%;"/>
      <img src="/build/app/images/netto.png" style="width: 48rem">
    </div>
  </div>
</template>
<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import {useGeneratorStore} from "../../stores/Generator"
import Loading from "../../views/Elements/Loading.vue";

export default {
  name: 'Thinking',
  components: {
    Loading,
    FontAwesomeIcon
  },
  data() {
    return {
      generatorStore: useGeneratorStore(),
    }
  },
  methods: {
  },
}
</script>