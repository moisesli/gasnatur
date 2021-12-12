<script type="application/javascript">
  Vue.createApp({
    data() {
      return {
        moises: "moises",
        modal_estado: false,
        modal_tipo: '',
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
      openModal: function() {
        this.modal_estado = true;
      },      
      closeModal: function() {
        this.modal_estado = false;
      },
      newPersonal: function () {
        this.modal_tipo = 'new';
        this.personal.id = '';
        this.personal.id_cargo = '';       
        this.personal.id_tipodoc = '';
        this.personal.numero = '';
        this.personal.nombres = '';
        this.personal.apellidos = '';
        this.personal.fecha_nacimiento = '';
        this.personal.sexo = '';
        this.personal.direccion = '';
        this.personal.telefono = '';
        this.personal.celular = '';
        this.personal.correo = '';
        this.personal.estado = '';
        this.openModal();
      },
      editPersonal: function(personal) {
        this.modal_tipo = 'edit';
        this.loadingPersonalEdit = true;
        axios.post('./apis/personal/' + personal.id).then(res => {
          this.personal.id = res.data.id;
          this.personal.id_cargo = res.data.id_cargo;
          this.personal.id_tipodoc = res.data.id_tipodoc;
          this.personal.numero = res.data.numero;
          this.personal.nombres = res.data.nombres;
          this.personal.apellidos = res.data.apellidos;
          this.personal.fecha_nacimiento = res.data.fecha_nacimiento;
          this.personal.sexo = res.data.sexo;
          this.personal.direccion = res.data.direccion;
          this.personal.telefono = res.data.telefono;
          this.personal.celular = res.data.celular;
          this.personal.celular = res.data.celular;
          this.personal.correo = res.data.correo;
          this.personal.estado = res.data.estado;
          this.loadingPersonalEdit = false;
          this.openModal();
        })
      },
      store: function(){
        
      }
    },
    mounted(){
      this.loadPersonals()
    }

  }).mount('#app')
</script>