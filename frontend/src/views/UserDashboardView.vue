<template>
  <div id="dashboard">
    <nav-bar active="home"></nav-bar>
  </div>  
</template>

<script>
import NavBar from '@/components/Dashboard/NavBar.vue';

export default {
  name: 'UserDashboardView',
  components: {
    NavBar
  }
}
</script>

<style lang="scss" scoped>
#dashboard {
  @apply bg-zinc-100 min-h-screen;
}
</style>