Vue.component('select-clients', VueSelect.VueSelect)
new Vue({
  el: '#clients',
  data: {
    id: null,
     clients:[],
     selected_clients: null
  },
    methods: {
        chooseMe() {
            this.$refs.client_ref.value =  this.selected_clients;
        },
   },

    mounted(){
         this.id = id;
         if(current_clients) {
            this.selected_clients = JSON.parse(current_clients);
            this.$refs.client_ref.value =  this.selected_clients;
         }

         let api_url = '/get_clients_api';
         axios.get(api_url).then(response => {
            console.log(response.data);
            this.clients = response.data;
        })
    }
})