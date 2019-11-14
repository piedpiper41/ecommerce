<template>
  <fragment>
    <b-col :md="col">
      <b-card
        :title="title"
        style="max-width: 20rem;"
        class="mb-2"
      >
        <b-card-text>
          {{desc}}
        </b-card-text>
      </b-card>
    </b-col>
  </fragment>
</template>
<script>
export default {
  name: "Card",
  props: ['title','desc','col'],
  data: () => ({

  })
}
</script>
<style lang="scss" scoped>
</style>
