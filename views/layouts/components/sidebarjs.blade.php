<script type="application/javascript">  
  const sidebar = createApp({
    data() {
      return {
        open: false,
      }
    },
    methods:{
      changeMenu: function(){
        this.open = !this.open;
      },
    }
  })
  sidebar.mount('#sidebar');
</script>