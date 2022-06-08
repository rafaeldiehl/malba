<template>
  <div class="form-button">
    <button type="submit">
      <slot />
    </button>
  </div>
</template>

<script>
export default {
  name: 'FormButton'
}
</script>

<style lang="scss" scoped>
.form-button {
  button {
    @apply bg-sky-500 w-full text-center p-4 rounded-lg text-xl text-white my-4;
  }
}
</style>