<template>
  <div class="card-holder">
    <div class="card p-4">
      <div class="card-body overflow-y-scroll">
        <div class="d-flex mb-4">
          <div>
            <img class="" src="/build/app/images/netto.png" height="150" width="150">
          </div>
          <div class="flex-grow-1">
            <h1 class="h1 mb-2 ">Here's what I can do for you</h1>
            <options-summary />
            <div class="my-4">
              <h6 class="h6">Please check all options that you need</h6>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="slogan" v-model="generatorStore.requestData.selected.slogan">
                <label class="form-check-label" for="slogan">A slogan</label>
              </div>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="content" v-model="generatorStore.requestData.selected.content">
                <label class="form-check-label" for="content">Marketing content</label>
              </div>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="image" v-model="generatorStore.requestData.selected.image">
                <label class="form-check-label" for="image">An image</label>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <button-with-icon class="p-3" :action="previous" caption="Previous" :icon="{icon: ['fas', 'chevron-left'], class: 'fa-xl', position: 'start'}" />
          </div>
          <div class="col-6">
            <button-with-icon class="p-3" :action="generate" caption="Next" :icon="{icon: ['fas', 'chevron-right'], class: 'fa-xl', position: 'end'}" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import ButtonWithIcon from "../../atomic/molecules/ButtonWithIcon.vue"
import {useGeneratorStore} from "../../stores/Generator";
import OptionsSummary from "../Summary/Main.vue";

export default {
  name: 'Options',
  components: {
    OptionsSummary,
    FontAwesomeIcon,
    ButtonWithIcon
  },
  data() {
    return {
      generatorStore: useGeneratorStore(),
    }
  },
  methods: {
    generate() {
      this.$router.push('/generate')
    },
    previous() {
      this.$router.push('/settings/how')
    },
  },
}
</script>