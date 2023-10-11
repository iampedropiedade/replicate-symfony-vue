<template>
  <div class="card-holder">
    <div class="card p-4">
      <div class="card-body overflow-y-scroll">
        <div class="row">
          <div class="col-12">
            <div class="d-flex mb-5">
              <div>
                <img class="" src="/build/app/images/netto.png" height="150" width="150">
              </div>
              <div class="flex-grow-1">
                <h1 class="h1">Final bits and bobs</h1>
                <options-summary />
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <form>
              <div v-if="generatorStore.requestData.selected.slogan">
                <div class="row mb-4">
                  <h4>Slogan</h4>
                  <label for="how">What's your preference for a slogan size?</label>
                </div>
                <fieldset class="mb-4">
                  <div class="row">
                    <div class="col col-6">Shorter</div>
                    <div class="col col-6 text-end">Longer</div>
                  </div>
                  <input type="range" class="form-range" min="15" max="45" step="5" id="how-size" v-model="generatorStore.requestData.how.sloganSize">
                </fieldset>
              </div>
              <div v-if="generatorStore.requestData.selected.image">
                <div class="row mb-4">
                  <h4>Image</h4>
                  <label for="how">What's your preference for the type of image?</label>
                </div>
                <fieldset class="mb-4">
                  <div class="row">
                    <div class="col col-6">Illustration</div>
                    <div class="col col-6 text-end">Real image</div>
                  </div>
                  <input type="range" class="form-range" min="0" max="1" step="1" id="image-type" v-model="generatorStore.requestData.how.imageType">
                </fieldset>
              </div>
            </form>
            <div class="row">
              <div class="col-6">
                <button-with-icon class="p-3" :action="previous" caption="Previous" :icon="{icon: ['fas', 'chevron-left'], class: 'fa-xl', position: 'start'}" />
              </div>
              <div class="col-6">
                <button type="submit" class="btn btn-success text-white p-3 w-100" v-on:click.prevent="generate()">Let's do this!</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import  {useGeneratorStore } from "../../stores/Generator"
import ButtonWithIcon from "../../atomic/molecules/ButtonWithIcon.vue";
import OptionsSummary from "../Summary/Main.vue"

export default {
  name: 'Results',
  components: {
    ButtonWithIcon,
    FontAwesomeIcon,
    OptionsSummary
  },
  data() {
    return {
      generatorStore: useGeneratorStore(),
    }
  },
  methods: {
    generate() {
      this.generatorStore.generate()
      this.$router.push('/generate/start')
    },
    previous() {
      this.$router.push('/settings/options')
    },
  },
}
</script>