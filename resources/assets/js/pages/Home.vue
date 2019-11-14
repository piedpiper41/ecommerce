<template>
  <fragment>
    <div class="col-md-12">
      <div class="row">
        <card
          v-if="fields.Product_Total"
          :title="'Total Products'"
          :desc="fields.Product_Total.total"
          :col="'3'"

        ></card>
        <card
          v-if="fields.Today_Sales"
          :title="'Today buy'"
          :desc="fields.Today_Sales.total"
          :col="'3'"
        ></card>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <b-card
          border-variant="primary"
          header="Top 10 best selling"
          header-bg-variant="primary"
          header-text-variant="white"
          align="center"
        >
          <b-row>
            <b-card
              :title="elem.Title"
              img-src="https://picsum.photos/600/300/?image=25"
              img-alt="Image"
              img-top
              tag="article"
              style="max-width: 20rem;"
              class="m-2"
              v-for="elem in fields.data" :key="elem.key"
            >
              <b-card-text v-html="elem.Content"></b-card-text>

              <b-button v-if="inArray(buylist,elem.ID)" variant="succes">Satın Alındı</b-button>
              <b-button v-else variant="primary" v-on:click="Buy(''+elem.ID+'')">Buy</b-button>
            </b-card>
          </b-row>
        </b-card>
      </div>
    <div class="col-md-6">
      <b-card no-body>
        <b-tabs  v-model="tabIndex" card>
          <b-tab title="Day" :title-link-class="linkClass(0)" v-on:click="tabsList(0)">
            <App-Table v-if="tabIndex == 0" :data="tabData" :loading="loading"></App-Table>
          </b-tab>
          <b-tab title="Week" :title-link-class="linkClass(1)" v-on:click="tabsList(1)">
            <App-Table v-if="tabIndex == 1" :data="tabData" :loading="loading">></App-Table>
          </b-tab>
          <b-tab title="Month" :title-link-class="linkClass(2)" v-on:click="tabsList(2)">
            <App-Table v-if="tabIndex == 2" :data="tabData" :loading="loading">></App-Table>
          </b-tab>
        </b-tabs>
      </b-card>
    </div>
  </div>
  </fragment>
</template>
<script>
import ApiService from '../_services/api.service'
import Card from './share/Card'
import Table from './share/Table'
export default {
  name: "Home",
  data() {
    return {
      fields: {},
      buylist:[],
      msg: false,
      tabIndex: 0,
      tabData:{}
    }
  },
  components: {
    'card':Card,
    'App-Table':Table
  },
  created() {
    this.datas();
    this.tabsList(0);
  },
  methods: {
    linkClass(idx) {
      if (this.tabIndex === idx) {
        return ['bg-primary', 'text-light']
      } else {
        return ['bg-light', 'text-info']
      }
    },
    datas(){
      ApiService.HomeList().then(response =>{
        this.fields = response.data;
      }).catch(err => {
        this.errors = err.response.data;
      });
    },
    tabsList(idx){
      this.loading=true;
      ApiService.HomeTabsList(idx).then(response =>{
        this.tabData = response.data;
        this.loading=false;
      }).catch(err => {
        this.errors = err.response.data;
      });
    },
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
        this.datas();
      }).catch(err => {
        this.errors = err.response.data;
      });
    }
  }
}
</script>
<style lang="scss" scoped>
</style>
