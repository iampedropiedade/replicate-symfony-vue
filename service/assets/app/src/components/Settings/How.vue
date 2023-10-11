<template>
  <div class="card-holder">
    <div class="card p-4">
      <div class="card-body overflow-y-scroll">
        <div class="d-flex mb-4">
          <div>
            <img class="" src="/build/app/images/netto.png" height="150" width="150">
          </div>
          <div class="flex-grow-1">
            <h1 class="h1 mb-2 "><span class="text-danger">How </span> would you like this?</h1>
            <h6 class="h6">Formal, relaxed, neutral...</h6>
            <div>I will try and match your marketing material to your style.</div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <form>
              <h5 class="h5">What's your style?</h5>
              <fieldset class="mb-4">
                <div class="row">
                  <div class="col col-6">Formal</div>
                  <div class="col col-6 text-end">Relaxed</div>
                </div>
                <input type="range" class="form-range" min="0" max="4" step="1" id="how-style" v-model="generatorStore.requestData.how.style">
              </fieldset>
            </form>
            <div class="row">
              <div class="col-6">
                <button-with-icon class="p-3" :action="previous" caption="Previous" :icon="{icon: ['fas', 'chevron-left'], class: 'fa-xl', position: 'start'}" />
              </div>
              <div class="col-6">
                <button-with-icon class="p-3" :action="next" caption="Next" :icon="{icon: ['fas', 'chevron-right'], class: 'fa-xl', position: 'end'}" />
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
import { useGeneratorStore} from "../../stores/Generator"
import ButtonWithIcon from "../../atomic/molecules/ButtonWithIcon.vue"

export default {
  name: 'How',
  components: {
    FontAwesomeIcon,
    ButtonWithIcon
  },
  data() {
    return {
      generatorStore: useGeneratorStore(),
    }
  },
  methods: {
    next() {
      this.$router.push('/settings/options')
    },
    previous() {
      this.$router.push('/settings/where')
    },
  },
}
</script>