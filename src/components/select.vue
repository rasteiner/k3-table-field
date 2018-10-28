<template>
	<select :ref="element" :value="value" @input="emit($event.target)">
		<option v-for="(value, key) in definition.options" :value="key" :key="key">{{value}}</option>
	</select>
</template>

<script>
export default {
	props: {
		value: String,
		definition: Object
  },
  methods: {
    emit(target) {
      this.$emit('input', {
        target: this,
        value: target.value
      })
    },
    getState() {
      return false
    },
    activateState(state) {
      this.$el.focus();
    }
  }
}
</script>