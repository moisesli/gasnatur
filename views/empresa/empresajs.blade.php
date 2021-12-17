<script type="application/javascript">
  const { createApp } = Vue;  
  const app = createApp({
    data() {
      return {
        entity: 'empresa',
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
          id_ubigeo: '',
          ruc: '',
          razon_social: '',
          nombre_comercial: '',
          direccion: '',
          anexo: '',
          telefono: '',
          celular: '',
          correo: '',
          web: '',
          logo: '',
          estado: '',
        },
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
          this.item.id_ubigeo = res.data.id_ubigeo;
          this.item.ruc = res.data.ruc;
          this.item.razon_social = res.data.razon_social;
          this.item.nombre_comercial = res.data.nombre_comercial;
          this.item.direccion = res.data.direccion;
          this.item.anexo = res.data.anexo;
          this.item.telefono = res.data.telefono;
          this.item.celular = res.data.celular;
          this.item.correo = res.data.correo;
          this.item.web = res.data.web;
          this.item.logo = res.data.logo;
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
        this.item.id_ubigeo = '';
        this.item.ruc = '';
        this.item.razon_social = '';
        this.item.nombre_comercial = '';
        this.item.direccion = '';
        this.item.anexo = '';
        this.item.telefono = '';
        this.item.celular = '';
        this.item.correo = '';
        this.item.web = '';
        this.item.logo = '';
        this.item.estado = '';
      }
    },
    mounted(){
      this.loadItems();
    }
  });  
  app.mount('#app');
  
</script>