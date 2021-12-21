<script type="application/javascript">
  const { createApp } = Vue;  
  const app = createApp({
    data() {
      return {          
        name: 'Personal',
        entity: 'personal',
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
          estado: '',
        },
        items: [],
        empresas: [],
        concesionarias: [],        
        zonas: [],
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
        loading: {                              
          items: false,
          store: false,
          delete: false,
          edit: false,          
        },        
        modal: {
          show: false,
          action: 'new|edit|delete'
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
              this.items[index].loadingDelete = false;
            }
            this.loading.items = false;          
          })
        }        
      },
      loadForeignKey: function(){        
        axios.get('/apis/empresas').then(res => {
          this.empresas = res.data.registros;     
          console.log(this.empresas)
        })        
        axios.get('/apis/concesionarias').then(res => {
          this.concesionarias = res.data.registros;
          console.log(this.concesionarias)
        })
        axios.get('/apis/zonas').then(res => {
          this.zonas = res.data.registros
          console.log(this.zonas)
        })
      },
      newItem: function(){
        this.modal.action = 'new'
        this.clearItem()
        this.openModal()        
      },
      editItem: function(item, action = ''){
        if( action == 'edit' ){          
          item.loading = true;
        } else {
          item.loadingDelete = true;
        }        
        this.modal.action = action;
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
          if( action == 'edit' ){
            item.loading = false;            
          } else {
            item.loadingDelete = false;
          }    
          
          this.openModal();
        })
      },
      storeItem: function(){
        this.loading.store = true;
        if( this.modal.action == 'new'){   
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
        }else if( this.modal.action == 'edit' ){
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
        }else if( this.modal.action == 'delete'){
          axios.delete('./apis/' + this.entity + '/' + this.item.id, JSON.stringify(this.item)).then(res => {
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
      openModalDelete: function(){
        console.log('Salio modal delete')
        this.modalDelete.show = true;
      },
      closeModalDelete: function(){
        this.modalDelete.show = false;
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
      this.loadForeignKey();
      this.loadItems();
    }
  });  
  app.mount('#app');
  
</script>