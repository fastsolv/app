Vue.component('v-select', VueSelect.VueSelect)
        new Vue({
          el: '#app1',
          data: {
             options: [ ],
             currency: '',
             country_id:'',
             country: '',
             selected_country: null,
          },
            methods: {
                onSearch(search, loading) {
                    if(search.length) {
                        loading(true);
                        this.searchMe(search, loading);
                    }
                },
                searchMe(search, loading) {
                    axios
                        .get(country_api_url)
                        .then(response => {
                            this.options = response.data;
                            loading(false);
                        })

                },
                chooseMe() {
                    this.$refs.country_ref.value =  this.selected_country;
                },

           },
            /*
            Initialize user's country and state for profile update.
             */
            mounted(){
                if(country_id) {
                    this.selected_country = country_name;
                    this.$refs.country_ref.value =  country_id;
                }
                this.options = [];
                axios
                    .get(country_api_url)
                    .then(response => {
                        this.options = response.data;
                    })
            }
        })
