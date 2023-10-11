<template>
  <div class="card-holder">
    <div class="card p-4">
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            <div class="d-flex mb-5">
              <div>
                <img class="" src="/build/app/images/netto.png" height="150" width="150">
              </div>
              <div class="flex-grow-1">
                <h1 class="h1">Here's what I think</h1>
                <options-summary />
                <div>And these are my suggestions for your request...</div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-4" v-if="generatorStore.predictions['slogan']?.output">
          <div class="col-12 py-2">
            <div class="my-2 d-flex">
              <h1 class="h1 flex-grow-1">Slogan</h1>
              <div>
                <button type="button" class="btn btn-outline-dark btn-sm me-1" v-on:click.prevent="copy('generated-slogan')"><font-awesome-icon :icon="['fa', 'copy']" size="xs" class="fa-fw" /></button>
                <button type="button" class="btn btn-outline-dark btn-sm" v-on:click.prevent="retry('slogan')"><font-awesome-icon :icon="['fas', 'sync-alt']" size="xs" class="fa-fw" /></button>
              </div>
            </div>
            <div id="generated-slogan">
              <div v-for="(item) in generatorStore.predictions['slogan']?.output">
                <div v-if="item && item.includes('*')">
                  {{ item }}
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-4" v-if="generatorStore.predictions['content']?.output">
          <div class="col-12 py-2">
            <div class="my-2 d-flex">
              <h1 class="h1 flex-grow-1">
                Marketing content
              </h1>
              <div>
                <button type="button" class="btn btn-outline-dark btn-sm me-1" v-on:click.prevent="copy('generated-content')"><font-awesome-icon :icon="['fa', 'copy']" size="xs" class="fa-fw" /></button>
                <button type="button" class="btn btn-outline-dark btn-sm" v-on:click.prevent="retry('content')"><font-awesome-icon :icon="['fas', 'sync-alt']" size="xs" class="fa-fw" /></button>
              </div>
            </div>
            <div id="generated-content" v-for="(item) in generatorStore.predictions['content']?.output">{{ item }}</div>
          </div>
        </div>
        <div class="row mb-4" v-if="generatorStore.predictions['image']?.output">
          <div class="col-12 p-2" v-for="(item) in generatorStore.predictions['image']?.output">
            <div class="my-2 d-flex">
              <h1 class="h1 flex-grow-1">
                Image
              </h1>
              <div>
                <a :href="item" download class="btn btn-outline-dark btn-sm me-1"><font-awesome-icon :icon="['fas', 'file-download']" size="xs" class="fa-fw" /></a>
                <button type="button" class="btn btn-outline-dark btn-sm" v-on:click.prevent="retry('content')"><font-awesome-icon :icon="['fas', 'sync-alt']" size="xs" class="fa-fw" /></button>
              </div>
            </div>
            <div>
              <img :src="item" alt="generated" class="w-100" />
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 p-2">
            <button type="button" class="btn btn-success text-white p-3 w-100" v-on:click.prevent="restart()">Restart</button>
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
    restart() {
      this.$router.push('/settings/what')
    },
    retry(type) {
      this.generatorStore.regenerate(type)
    },
    copy(target) {
      let text = document.getElementById(target).innerText
      const copyContent = async () => {
        try {
          await navigator.clipboard.writeText(text)
        } catch (err) {
          console.error('Failed to copy: ', err)
        }
      }
    },
  },
}
</script>