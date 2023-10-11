<template>
  <div class="card-holder">
    <div class="card p-4">
      <div class="card-body overflow-y-scroll">
        <div class="d-flex mb-4">
          <div>
            <img class="" src="/build/app/images/netto.png" height="150" width="150">
          </div>
          <div class="flex-grow-1">
            <h1 class="h1 mb-2 "><span class="text-danger">Where</span> is your service available?</h1>
            <h6 class="h6"><strong>{{ text.upperFirst(generatorStore.requestData.what) }}</strong> in Derby? In Berkshire? In the Southwest? In Wales?</h6>
            <div>This information is not mandatory but if you have it might us produce more targeted results.</div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <form>
              <h5 class="h5">In what city, county, region or country is your service available?</h5>
              <fieldset class="my-4">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="where" name="where" placeholder="Ex: London" v-model="generatorStore.requestData.where">
                  <label for="where">Where is your service available? (optional)</label>
                </div>
              </fieldset>
              <div class="row">
                <div class="col-6">
                  <button-with-icon class="p-3" :action="previous" caption="Previous" :icon="{icon: ['fas', 'chevron-left'], class: 'fa-xl', position: 'start'}" />
                </div>
                <div class="col-6">
                  <button-with-icon class="p-3" :action="next" caption="Next" :icon="{icon: ['fas', 'chevron-right'], class: 'fa-xl', position: 'end'}" />
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import {useGeneratorStore} from "../../stores/Generator"
import ButtonWithIcon from "../../atomic/molecules/ButtonWithIcon.vue"
import { Text } from "../../classes/Text"

export default {
  name: 'Where',
  components: {
    ButtonWithIcon,
    FontAwesomeIcon,
    Text
  },
  data() {
    return {
      generatorStore: useGeneratorStore(),
      text: Text
    }
  },
  methods: {
    next() {
      this.$router.push('/settings/how')
    },
    previous() {
      this.$router.push('/settings/what')
    },
  },
}
</script>