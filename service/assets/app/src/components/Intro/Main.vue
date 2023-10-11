<template>
  <div class="card-holder">
    <div class="card p-4">
      <div class="card-body overflow-y-scroll">
        <div class="row">
          <div class="col-12">
            <div class="d-flex">
              <div>
                <img class="" src="/build/app/images/netto.png" height="300" width="300" alt="Netto">
              </div>
              <div class="flex-grow-1">
                <div>
                  <h1 class="display-2"><span class="text-danger">ネット</span><sup><small>*</small></sup></h1>
                  <div><sup><small>* Netto</small></sup></div>
                  <h4 class="h4">Need some marketing inspiration?</h4>
                  <h6 class="h6 mb-4">Hi, my name is <span class="text-danger"><strong>Netto</strong></span> and I might be able to help you find a slogan, some marketing content and even imagery!</h6>
                  <div class="mb-4">Don't let my modest appearance deceive you, under the hood I'm using some advanced AI models like Llama 2 and Stability AI!</div>
                  <button type="submit" class="btn btn-primary p-4 btn-lg btn-block w-100" v-on:click.prevent="next()">Let's get started!</button>
                </div>
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
import {useGeneratorStore} from "../../stores/Generator"

export default {
  name: 'Intro',
  components: {
    FontAwesomeIcon
  },
  data() {
    return {
      generatorStore: useGeneratorStore(),
    }
  },
  methods: {
    next() {
      this.$router.push('/settings/what')
    },
  },
}
</script>