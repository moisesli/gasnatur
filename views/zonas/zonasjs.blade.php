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
        this.loading.table = true
        axios.get('./apis/zonas').then(res => {
          this.items = res.data.registros
          for( const index in this.items){
            this.items[index].loading = false
          }
          this.loading.table = false
          console.log(this.items)
        })
      },
      newItem: function(){
        this.clearItem()
        this.openModal()
        console.log('newItem')
      },
      editItem: function(item){

      },
      storeItem: function(){

      },
      openModal:function(){
        this.modal.show = true;
      },
      closeModal: function(){
        this.modal.show = close;
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