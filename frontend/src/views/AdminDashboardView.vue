<template>
  <div id="dashboard">
    <nav-bar active="home"></nav-bar>
    <div class="container"></div>
  </div>
</template>

<script>
import NavBar from '@/components/Dashboard/NavBar.vue';

/*import store from "@/store";*/

export default {
  name: 'AdminDashboardView',
  components: {
    NavBar
  },
}
</script>

<style lang="scss" scoped>
#dashboard {
  @apply bg-zinc-100 min-h-screen flex flex-col justify-center items-center;
}

.container {
  @apply max-w-[1000px] mt-32 flex flex-row gap-6 mb-10;
}
</style>