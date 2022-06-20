<template>
  <div class="form-button">
    <button type="submit" :disabled="buttonDisabled">
      <slot />
    </button>
  </div>
</template>

<script>
export default {
  name: 'FormButton',
  props: {
    buttonDisabled: {
      type: Boolean,
      default: false
    }
  }
}
</script>

<style lang="scss" scoped>
.form-button {
  button {
    @apply bg-sky-500 w-full text-center p-4 rounded-lg text-xl text-white my-4 transition;

    &:hover:not(:disabled) {
      @apply bg-sky-600;
    }

    &:disabled {
      @apply opacity-50;
    }
  }
}
</style>