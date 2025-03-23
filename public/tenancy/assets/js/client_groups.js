Vue.component("select-client-groups", VueSelect.VueSelect);
new Vue({
  el: "#client_groups",
  data: {
    id: null,
    client_groups: [],
    selected_client_groups: null,
  },
  methods: {
    chooseMe() {
      this.$refs.client_ref.value = this.selected_client_groups;
    },
  },

  mounted() {
    this.id = id;
    if (current_client_groups) {
      this.selected_client_groups = JSON.parse(current_client_groups);
      this.$refs.client_ref.value = this.selected_client_groups;
    }

    let api_url = "/get_client_groups_api";
    axios.get(api_url).then((response) => {
      console.log(response.data);
      this.client_groups = response.data;
    });
  },
});
