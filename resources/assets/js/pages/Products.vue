<template>
  <fragment>
    <b-row>
      <b-card
        :title="elem.Title"
        img-src="https://picsum.photos/600/300/?image=25"
        img-alt="Image"
        img-top
        tag="article"
        style="max-width: 20rem;"
        class="m-2"
        v-for="elem in fields" :key="elem.key"
      >
        <b-card-text v-html="elem.Content"></b-card-text>

        <b-button v-if="inArray(buylist,elem.ID)" variant="succes">Satın Alındı</b-button>
        <b-button v-else variant="primary" v-on:click="Buy(''+elem.ID+'')">Buy</b-button>
      </b-card>
    </b-row>
  </fragment>
</template>
<script>
import ApiService from '../_services/api.service'
export default {
  name: "",
  data() {
    return {
      fields: {},
      buylist:[],
      msg: false
    }
  },
  created() {
    ApiService.ProductsList().then(response =>{
      this.fields = response.data;
    }).catch(err => {
      this.errors = err.response.data;
    });
  },
  methods: {
    inArray(arr,search){
      if(arr.length > 0){
        var view_c = arr.filter(function(elems){
            if(parseInt(elems) == parseInt(search)){
              return true;
            }
        });
        if(view_c.length > 0){
          return true;
        }else{
          return false;
        }
      }else{
        return false;
      }
    },
    Buy(id) {
      ApiService.Buy({user_id:1,products_id:id}).then(response =>{
        this.buylist.push(id);
      }).catch(err => {
        this.errors = err.response.data;
      });
    }
  }
}
</script>
<style lang="scss" scoped>
</style>
