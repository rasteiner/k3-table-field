<template>
	<input type="checkbox" :checked="value" @input="emit($event.target)">
</template>

<script>
export default {
	props: {
		value: [String, Boolean],
		definition: Object
  },
  methods: {
    emit(target) {
      this.$emit('input', {
        target: this,
        value: target.checked
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