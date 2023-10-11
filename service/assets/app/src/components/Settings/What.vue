<template>
  <div class="card-holder">
    <div class="card p-4">
      <div class="card-body overflow-y-scroll">
        <div class="d-flex mb-4">
          <div>
            <img class="" src="/build/app/images/netto.png" height="150" width="150">
          </div>
          <div class="flex-grow-1">
            <h1 class="h1 mb-2 "><span class="text-danger">What</span> are you marketing?</h1>
            <h6 class="h6">A butcher? A residential home? A plumber? A gym?</h6>
            <div>Please try to keep it simple and go straight to the point. This will help me getting you the best results.</div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <form>
              <h5 class="h5">Describe your business or service in simple words</h5>
              <fieldset class="my-4">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" placeholder="Ex: a pub, an hairdresser, a butcher, a car dealer" id="what" name="what" v-model="generatorStore.requestData.what">
                  <label for="what">What are you marketing?</label>
                </div>
              </fieldset>
              <fieldset class="my-4">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="name" placeholder="Ex: Red Lion (optional)" name="name" v-model="generatorStore.requestData.name">
                  <label for="what">Do you have a name?</label>
                </div>
              </fieldset>
              <div class="row">
                <div class="col-6">
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
import { useGeneratorStore} from "../../stores/Generator"
import ButtonWithIcon from "../../atomic/molecules/ButtonWithIcon.vue"

export default {
  name: 'What',
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
      this.$router.push('/settings/where')
    },
  },
}
</script>