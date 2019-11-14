<template>
  <fragment>
    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item" v-for="menu in menus">
        <router-link class="nav-link" :to="{ name: menu.rname }" v-bind:key="menu.rname" v-bind:data="menu">
          <i  v-bind:class="menu.clss"></i>
          {{menu.name}}
        </router-link>
      </li>
    </ul>
  </fragment>
</template>
<script>
export default {
  name: "sidebar",
  data() {
    return {
      menus : [
        {name:'Dashboard',rname:'Home',clss:'fas fa-fw fa-tachometer-alt'},
        {name:'Products',rname:'Products',clss:'fas fa-fw fa-tachometer-alt'},
      ]
    }
  },
}
</script>
<style lang="scss" scoped>
</style>
