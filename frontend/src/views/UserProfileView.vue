<template>
  <div id="dashboard">
    <nav-bar></nav-bar>
    <div class="container">
    </div>
  </div>  
</template>

<script>
import NavBar from '@/components/Dashboard/NavBar.vue';


export default {
  name: 'UserProfileView',
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