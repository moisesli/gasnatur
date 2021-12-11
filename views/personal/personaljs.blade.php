<script type="application/javascript">
  Vue.createApp({
    data() {
      return {
        moises: "moises",
        modal_estado: false,        
        loading_personals: false,
        loadingPersonalEdit: false,
        personal: {
          id: '',
          id_cargo: '',
          id_tipodoc: '',
          numero: '',
          nombres: '',
          apellidos: '',
          fecha_nacimiento: '',
          sexo: '',
          direccion: '',
          telefono: '',
          celular: '',
          correo: '',
          estado: ' '
        },
        personals: []
      }
    },
    methods: {
      loadPersonals: function () {
        this.loading_personals = true
        axios.get('./apis/personal').then(res => {
          this.personals = res.data
          this.loading_personals = false
          console.log(res.data)
        })
      },
      openModal: function () {
        this.modal_estado = true;
      },      
      closeMoldal: function () {
        this.modal_estado = false;
      },
      newPersonal: function () {
        
      },
      editPersonal: function($id) {
      }
    },
    mounted(){
      this.loadPersonals()
    }

  }).mount('#app')
</script>