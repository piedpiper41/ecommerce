import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import customer from './customer';

export default new Vuex.Store({
    modules: {
        customer
    },
});
