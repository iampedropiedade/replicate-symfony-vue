<template>
  <div class="mb-3">
    <fieldset class="input-group">
      <div class="form-floating">
        <input :type="fieldType"
               class="form-control"
               :name="name"
               :id="id"
               :placeholder="placeholder"
               :value="modelValue"
               @input="$emit('update:modelValue', $event.target.value)"
        />
        <label for="id">{{ label }}</label>
      </div>
      <button class="btn btn-secondary" type="button" v-if="type === 'password'" v-on:click.prevent="togglePassword()">
        <font-awesome-icon :icon="['fas', 'fa-eye']" class="fa-fw" v-if="fieldType === 'password'" />
        <font-awesome-icon :icon="['fas', 'fa-eye-slash']" class="fa-fw" v-else />
      </button>
    </fieldset>
    <form-violations :violations="inputViolations()" />
  </div>
</template>
<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { v4 as uuid } from 'uuid'
import FormViolations from "./Violations.vue";

export default {
  name: 'FormInput',
  props: {
    modelValue: {required: true},
    name: {required: true, type: String},
    label: {required: true, type: String},
    type: {required: false, type: String, default: 'text'},
    placeholder: {required: false, type: String, default: 'text'},
    violations: {required: false},
  },
  components: {
    FormViolations,
    FontAwesomeIcon,
  },
  emits: ['update:modelValue'],
  data() {
    return {
      id: uuid(),
      fieldType: this.type
    }
  },
  methods: {
    inputViolations() {
      return this.violations?.filter((violation) => {
        return violation.propertyPath === this.name
      })
    },
    togglePassword() {
      this.fieldType = this.fieldType === 'text' ? 'password' : 'text'
    },
    init() {
      this.usersStore.get(this.$router.currentRoute._value.params)
    },
  },
}
</script>