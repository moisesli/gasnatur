<script type="application/javascript">
  Vue.createApp({
    data() {
      return {
        moises: "moises",
        loading_personal: false,
        loadingPersonalEdit: false,
        personals: []
      }
    },
    methods: {
      loadPersonals: function () {
        axios.get('./apis/').then(res => {
          console.log(res.data)
        })
      },
      editPersonal: function($id) {

      }
    },
    mounted(){
      this.loadPersonals()
    }

  }).mount('#app')
</script>