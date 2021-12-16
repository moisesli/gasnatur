<script type="application/javascript">
  const { createApp } = Vue;  
  const app = createApp({
    data() {
      return {
        entity: 'personal',
        search: '',
        pagination: {
          inicio: null,
          fin: null,
          totalregistros: null,
          pagina: 1,
          pagina_anterior: null,
          pagina_posterior: null,
          palabra_buscada: ''
        },
        page: 1,
        search: '',        
        items: [],
        item: {
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
          estado: ''
        },
        loading: {                              
          items: false,
          store: false,
          edit: false,          
        },        
        modal: {
          show: false,
          method: 'new|edit'
        },
        message: {
          success: false,
          message: ''
        }        
      }
    },
    methods: {
      loadItems: function(pagina = 1, palabra_buscada = ''){  
        if( pagina != 0 ){
          this.loading.items = true;
          axios.get('./apis/' + this.entity + '/'+ pagina + '/' + palabra_buscada).then(res => {
            console.log(res.data)
            this.items = res.data.registros;
            this.pagination.inicio = res.data.inicio;
            this.pagination.fin = res.data.fin;
            this.pagination.totalregistros = res.data.totalregistros;
            this.pagination.pagina  = res.data.pagina;
            this.pagination.pagina_anterior = res.data.pagina_anterior;
            this.pagination.pagina_posterior = res.data.pagina_posterior;
            this.pagination.palabra_buscada = res.data.palabra_buscada;
            for( const index in this.items){
              this.items[index].loading = false;
            }
            this.loading.items = false;          
          })
        }
        
      },
      newItem: function(){
        this.modal.method = 'new'
        this.clearItem()
        this.openModal()
        console.log('newItem')
      },
      editItem: function(item){
        item.loading = true;        
        this.modal.method = 'edit';        
        axios.post('./apis/' + this.entity + '/' + item.id).then(res => {
          console.log(res.data)
          this.item.id = res.data.id,
          this.item.id_cargo = res.data.id_cargo;
          this.item.id_tipodoc = res.data.id_tipodoc;
          this.item.numero = res.data.numero;
          this.item.nombres = res.data.nombres;
          this.item.apellidos = res.data.apellidos;
          this.item.fecha_nacimiento = res.data.fecha_nacimiento;
          this.item.sexo = res.data.sexo;
          this.item.direccion = res.data.direccion;
          this.item.telefono = res.data.telefono;
          this.item.celular = res.data.celular;
          this.item.correo = res.data.correo;
          this.item.estado = res.data.estado;               
          item.loading = false;
          this.openModal();
        })
      },
      storeItem: function(){
        this.loading.store = true;
        if( this.modal.method == 'new'){   
          console.log('entro a new')
          axios.post('./apis/' + this.entity , JSON.stringify(this.item)).then(res => {
            this.message = res.data;
            console.log(this.message.message)
            if(this.message.success == true){              
              this.closeModal();
              this.loadItems();
            }            
            this.loading.store = false;
          })
        }else if( this.modal.method == 'edit' ){
          console.log('entro a edit')
          axios.put('./apis/' + this.entity + '/' + this.item.id, JSON.stringify(this.item)).then(res => {
            console.log(res.data)
            this.message = res.data;
            if(this.message.success == true){
              this.closeModal();
              this.loadItems();
            }
            this.loading.store = false;            
          })
        }
      },
      openModal:function(){
        this.modal.show = true;
      },
      closeModal: function(){
        this.modal.show = false;
      },
      clearItem: function(){     
        this.item.id = '',
        this.item.id_cargo = '';
        this.item.id_tipodoc = '';
        this.item.numero = '';
        this.item.nombres = '';
        this.item.apellidos = '';
        this.item.fecha_nacimiento = '';
        this.item.sexo = '';
        this.item.direccion = '';
        this.item.telefono = '';
        this.item.celular = '';
        this.item.correo = '';
        this.item.estado = '';      
      }
    },
    mounted(){
      this.loadItems();
    }
  });  
  app.mount('#app');
  
</script>