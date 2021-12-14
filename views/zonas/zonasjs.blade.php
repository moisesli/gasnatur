<script type="application/javascript">
  const { createApp } = Vue;  
  const app = createApp({
    data() {
      return {
        items: [],
        item: {
          id: '',
          nombre: '',
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
      loadItems: function(){
        this.loading.items = true;
        axios.get('./apis/zonas').then(res => {
          this.items = res.data.registros
          for( const index in this.items){
            this.items[index].loading = false;
          }
          this.loading.items = false;
          console.log(this.items)
        })
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
        axios.post('./apis/zonas/' + item.id).then(res => {
          console.log(res.data)
          this.item.id = res.data.id;
          this.item.nombre = res.data.nombre;
          this.item.estado = res.data.estado;          
          item.loading = false;
          this.openModal();
        })
      },
      storeItem: function(){
        this.loading.store = true;
        if( this.modal.method == 'new'){   
          console.log('entro a new')
          axios.post('./apis/zonas', JSON.stringify(this.item)).then(res => {
            this.message = res.data;
            console.log(this.message.message)
            if(this.message.success == true){
              this.closeModal();
            }            
            this.loading.store = false;
          })
        }else if( this.modal.method == 'edit' ){
          console.log('entro a edit')
          axios.put('./apis/zonas/' + this.item.id, JSON.stringify(this.item)).then(res => {
            console.log(res.data)
            this.message = res.data;
            if(this.message.success == true){
              this.closeModal();
            }            
            this.loadItems();
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
        this.item.id = ''
        this.item.nombre = ''
        this.item.estado = ''
      }
    },
    mounted(){
      this.loadItems();
    }
  });  
  app.mount('#app');
  
</script>