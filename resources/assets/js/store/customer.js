export default {
    state: {
        active_el: false,
        loading: true,
        initiated: false,
        page_error:false,
    },
    mutations: {
      AddLoading: function (state,data) {
           return state.loading = data;
      },
      AddInitiated: function (state,data) {
           return state.initiated = data;
      },
      AddActive_el: function (state,data) {
           return state.active_el = data;
      },
      page_error: function (state,data) {
            state.initiated=true;
            state.loading=false;
            state.page_error = data;
      },
    },
  }
