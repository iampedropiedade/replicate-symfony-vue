<template>
  <div class="my-1">
    <div v-for="(item, index) in violations" :id="'violation' + id + index" class="text-danger">
      {{ item.title }}
    </div>
  </div>
</template>
<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { v4 as uuid } from 'uuid'

export default {
  name: 'FormViolations',
  props: {
    violations: {required: false, type: Array},
  },
  components: {
    FontAwesomeIcon,
  },
  data() {
    return {
      id: uuid()
    }
  },
  methods: {
    displayViolations() {
      return this.violations?.filter((violation) => {
        return violation.propertyPath === this.name
      })
    },
    init() {
      this.usersStore.get(this.$router.currentRoute._value.params)
    },
  },
}
</script>