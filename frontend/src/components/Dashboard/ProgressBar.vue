<template>
  <div class="progress-bar">
    <span>0 XP</span>
    <div class="border">
      <span class="paint bg-green-600" :style="{ width: percentage + '%' }"></span>
      <span class="progress-value translate-x-[-20%]" :style="{ left: percentage + '%' }">{{ currentXp }} XP</span>
    </div>
    <span>{{ totalXp }} XP</span>
  </div>
</template>

<script>
export default {
  name: 'ProgressBar',
  props: {
    percentage: {
      type: Number,
      required: true
    },
    totalXp: {
      type: Number,
      required: true
    },
    currentXp: {
      type: Number,
      required: true
    }
  }
}
</script>

<style lang="scss" scoped>
.progress-bar {
  @apply flex flex-row justify-center items-center ml-[-1.8rem] mt-6 mb-10 font-medium text-zinc-900;

  .border {
    @apply w-[250px] h-[15px] mx-3 bg-zinc-300 rounded-[9999px] relative;

    .paint {
      @apply h-[15px] left-0 top-0 absolute rounded-[9999px];
    }

    .progress-value {
      @apply absolute bottom-[-1.5rem] ml-[-1rem] text-xs;
    }
  }

  @media (max-width: 680px) {
    @apply flex flex-row justify-center items-center font-medium w-full m-0 my-10;
  }
}
</style>