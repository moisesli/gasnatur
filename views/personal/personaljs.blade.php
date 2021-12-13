<script type="application/javascript">  
  Vue.createApp({
    data() {
      return {
        moises: "moises",
        modal_estado: false,
        modal_tipo: '',               //  default: '', new, edit
        loading_personals: false,
        loadingPersonalEdit: false, 
        loadingStore: false,
        message: {
          success: false,
          message: ''
        },
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
          this.personals = res.data.registros
          // Agregar idenfiticador                  
          for( const per in this.personals){
            this.personals[per].gasnatur_estado = false;
            // console.log(this.personals[per])
          }
          this.loading_personals = false
          //console.log(res.data)
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
        this.personal.id_cargo = '1';        
        this.personal.id_tipodoc = '1';
        this.personal.numero = '4569863';
        this.personal.nombres = 'Abraham Moises';
        this.personal.apellidos = 'Linares Oscco';
        this.personal.fecha_nacimiento = '2021-12-12';
        this.personal.sexo = 'M';
        this.personal.direccion = 'Cm 40 LT 15 Mz 213 Ciudad';
        this.personal.telefono = '952631806';
        this.personal.celular = '952631806';
        this.personal.correo = 'correo@gmail.com';
        this.personal.estado = 'ACTIVO';
        this.openModal();
      },
      editPersonal: function(personal) {
        personal.gasnatur_estado = true;
        this.message = [];
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
          personal.gasnatur_estado = false;
          this.openModal();
        })
      },
      store: function(){
        this.loadingStore = true;
        if( this.modal_tipo == 'new'){          
          axios.post('./apis/personal', JSON.stringify(this.personal)).then(res => {
            this.message = res.data;
            console.log(this.message.message)
            if(this.message.success == true){
              this.closeModal();
            }            
            this.loadingStore = false;
          })
        }else if( this.modal_tipo == 'edit' ){          
          axios.put('./apis/personal/' + this.personal.id, JSON.stringify(this.personal)).then(res => {
            this.message = res.data;
            if(this.message.success == true){
              this.closeModal();
            }
            console.log(res.data)            
            this.loadingStore = false;
          })
        }      
      }
    },
    mounted(){
      this.loadPersonals()
    }

  }).mount('#app')
</script>