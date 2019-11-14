
<script>
import Header from './pages/static/Header'
import Footer from './pages/static/Footer'
import Sidebar from './pages/static/Sidebar'
import Page_error from './pages/Page_error'
import Modal from './pages/share/Modal'
import ApiService from './_services/api.service.js'
export default {

  name: 'App',

  components: {
    'app-modal': Modal,
    'app-header-menu': Header,
    'app-footer': Footer,
    'app-pageerror': Page_error,
    'app-sidebar':Sidebar,
  },
  data() {
    return {
      user: false,
      loading: false,
      initiated: false
    }
  },
  mounted(){
    /*if (localStorage.UserDatass) {
      this.$store.commit('AddUserData', JSON.parse(localStorage.UserData));
      this.$store.commit('AddUserLogin', true);
    }else{
      this.init();
    }
    this.$store.commit('AddLoading', false);
    this.$store.commit('AddInitiated', true);*/
  },
  methods:{
    init() {
      this.loading = true;
      ApiService.auth_init().then(response =>{
        localStorage.setItem('UserData', JSON.stringify(response.data));
        this.$store.commit('AddUserData', response.data);
        this.$store.commit('AddUserLogin', true);
        this.loading = false;
        this.initiated = true;
      });
    }
  },
}
</script>


<template>
  <div id="app">
    <app-header-menu :app="this"></app-header-menu>
    <div id="wrapper">
      <app-sidebar></app-sidebar>
      <div id="content-wrapper">
        <div class="container-fluid">
          <spinner v-if="this.$store.state.customer.loading"></spinner>
          <div v-else if="initlated">
            <app-pageerror v-if="this.$store.state.customer.page_error">></app-pageerror>
            <router-view v-else/>
          </div>
          <div class="clear"></div><br>
        </div>
      </div>
      <app-footer :app="this"></app-footer>
    </div>
  </div>
</template>
