import axios from 'axios'
const ApiUrl = 'https://kobisi.autok2cdn.store';
const ApiService = {

    init(baseURL) {
        axios.defaults.baseURL = baseURL;
    },

    removeHeader() {
        axios.defaults.headers.common = {}
    },

    get(resource) {
        return axios.get(ApiUrl+resource)
    },

    post(resource, data,type) {
        return axios.post(ApiUrl+resource, data,type)
    },

    put(resource, data) {
        return axios.put(ApiUrl+resource, data)
    },

    delete(resource) {
        return axios.delete(ApiUrl+resource)
    },
    customRequest(data) {
        return axios(data)
    },
    HomeList(data){
      return ApiService.post('/home/list',data)
    },
    ProductsList(data){
      return ApiService.post('/products/list',data)
    },
    Buy(data){
      return ApiService.post('/sales/insert',data)
    },
    HomeTabsList(n,data){
      return ApiService.post('/home/list/'+n,data)
    }

}

export default ApiService
