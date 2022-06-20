<template>
  <router-view/>
</template>

<style lang="scss">
body,
input,
textarea,
button {
  @apply text-zinc-500;
}

@media (max-width: 950px) {
  html {
    font-size: 14px;
  }
}

@media (max-width: 450px) {
  html {
    font-size: 12px;
  }
}

@media (max-width: 300px) {
  html {
    font-size: 10px;
  }
}
</style>