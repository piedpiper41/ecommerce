<template>
  <fragment>
    <!-- Image and text -->
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
      <router-link class="navbar-brand mr-1" :to="{ name: 'Home', params: {}}">
        Bootstrap
      </router-link>
    </nav>
  </fragment>
</template>
<script>
  export default {
    name:'Header',
  }
</script>
