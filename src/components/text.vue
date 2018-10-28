<template>
	<input type="text" :value="value" @input="emit($event.target)">
</template>

<script>
export default {
	props: {
		value: String
  },
  methods: {
    emit(target) {
      this.$emit('input', {
        target: this,
        value: target.value
      })
    },
    getState() {
      return {
        ss: this.$el.selectionStart,
        se: this.$el.selectionEnd
      }
    },
    activateState(state) {
      this.$el.focus();
      this.$el.selectionStart = state.ss;
      this.$el.selectionEnd = state.se;
    }
  }
}
</script>