Vue.component('v-select', VueSelect.VueSelect)
new Vue({
     el: '#app1',
     data: {
          options: [],
          stateOptions: [],
          currency: '',
          country_id: '',
          country: '',
          selected_country: null,
          state: '',
          selected_state: null
     },
     methods: {
          onSearch(search, loading) {
               if (search.length) {
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
               this.$refs.country_ref.value = this.selected_country;
               this.selected_state = null;
               axios
                    .get(state_api_url, {
                         params: {
                              country_id: this.selected_country
                         }
                    })
                    .then(response => {
                         this.stateOptions = response.data;
                    })
          },
          onSearchState(search, loading) {
               if (search.length) {
                    loading(true);
                    this.searchMeState(search, loading);
               }

          },
          searchMeState(search, loading) {
               this.stateOptions = [];
               axios
                    .get(state_api_url, {
                         params: {
                              country_id: this.selected_country
                         }
                    })
                    .then(response => {
                         this.stateOptions = response.data;
                         loading(false);
                    })

          },
          chooseMeState() {
               this.$refs.state_ref.value = this.selected_state;
          },

     },
     /*
     Initialize user's country and state for profile update.
      */
     mounted() {
          if (country_id) {
               this.selected_country = country_name;
               this.$refs.country_ref.value = country_id;
          }
          if (state_id) {
               this.selected_state = state_state;
               this.$refs.state_ref.value = state_id;
          }
          this.options = [];
          axios
               .get(country_api_url)
               .then(response => {
                    this.options = response.data;
               })
     }
})