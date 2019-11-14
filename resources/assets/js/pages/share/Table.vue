<template>
  <div id="">
    <table class="table user-list">
      <thead>
          <tr>
          <th><span>User</span></th>
          <th><span>Sum Price</span></th>
          <th>&nbsp;</th>
          </tr>
      </thead>
      <tbody>
          <spinner v-if="loading"></spinner>
          <tr v-else v-for="(elem,key) in data.data" :key="key">
              <td>{{elem.name}}</td>
              <td>{{elem.totalPrice}}</td>
          </tr>
      </tbody>
  </table>
  </div>
</template>
<script>
export default {
  name: "Table",
  props: ['data','loading'],
  data: () => ({

  })
}
</script>
<style lang="scss" scoped>
</style>
