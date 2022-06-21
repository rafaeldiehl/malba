<template>
  <div id="dashboard">
    <nav-bar active="config"></nav-bar>
    <div class="container">
    </div>
  </div>  
</template>

<script>
import NavBar from '@/components/Dashboard/NavBar.vue';


export default {
  name: 'ConfigPageView',
  components: {
    NavBar
  }
}
</script>

<style lang="scss" scoped>
#dashboard {
  @apply bg-zinc-100 min-h-screen flex flex-col items-center;
}
</style>