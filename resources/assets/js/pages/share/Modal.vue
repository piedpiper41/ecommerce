<template>
  <b-modal
      :visible="this.$store.state.modal.show"
      @hide="this.modelclose"
      id="modal1"
        @ok="modelclose"
      :title="this.$store.state.modal.title"
      :header-bg-variant="this.$store.state.modal.headerBgVariant"
      :header-text-variant="this.$store.state.modal.headerTextVariant"
      :body-bg-variant="this.$store.state.modal.bodyBgVariant"
      :body-text-variant="this.$store.state.modal.bodyTextVariant"
      :footer-bg-variant="this.$store.state.modal.footerBgVariant"
      :footer-text-variant="this.$store.state.modal.footerTextVariant"
       hide-footer
    >
    {{this.$store.state.modal.msg}}
    </b-modal>
</template>

<script>
export default {
  name:'Modal',
  data(){
    return {
        show: false,
        title: '',
        msg:'',
        variants: ['primary', 'secondary', 'success', 'warning', 'danger', 'info', 'light', 'dark'],
        headerBgVariant: 'danger',
        headerTextVariant: 'light',
        bodyBgVariant: 'light',
        bodyTextVariant: 'dark',
        footerBgVariant: '',
        footerTextVariant: 'dark'
      }
  },
  methods: {
    modelclose: function() {
      this.$store.commit('Modalhidden',null);
    }
  },
}
</script>

<style lang="css" scoped>
</style>
