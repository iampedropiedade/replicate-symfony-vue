<template>
  <div class="mb-2">
    You are creating marketing material for <strong>{{ generatorStore.requestData.what }}</strong>
    <span v-if="generatorStore.requestData.name"> called <strong>{{ generatorStore.requestData.name }}</strong>, </span>
    <span v-if="generatorStore.requestData.where"> <strong>{{ generatorStore.requestData.where }}</strong></span>.
    <br/>
    You want to use a <strong>{{ generatorStore.styles[generatorStore.requestData.how.style] }}</strong> language style.
    <br/>
    You want me to create:
    <strong v-if="generatorStore.requestData.selected.slogan">a slogan</strong>
    <span v-if="generatorStore.requestData.selected.slogan && generatorStore.requestData.selected.content">, </span>
    <strong v-if="generatorStore.requestData.selected.content">marketing content</strong>
    <span v-if="(generatorStore.requestData.selected.content || generatorStore.requestData.selected.slogan) && generatorStore.requestData.selected.image">, </span>
    <strong v-if="generatorStore.requestData.selected.image">an image</strong>.
    <span v-if="generatorStore.requestData.selected.slogan">
      <br/>
      The slogan should have a <strong>{{ generatorStore.sloganSize[generatorStore.requestData.how.sloganSize] }}</strong> size.
    </span>
    <span v-if="generatorStore.requestData.selected.image">
      <br/>
      The image should be <strong>{{ generatorStore.imageTypes[generatorStore.requestData.how.imageType] }}</strong>.
    </span>
  </div>
</template>
<script>
import {useGeneratorStore} from "../../stores/Generator"

export default {
  name: 'OptionsSummary',
  data() {
    return {
      generatorStore: useGeneratorStore(),
    }
  }
}
</script>