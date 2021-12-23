<script type="application/javascript">  
  const sidebar = createApp({
    data() {
      return {
        uno: false,
        dos: false
      }
    },
    methods:{
      changeMenu1: function(){
        this.uno = !this.uno;
      },
      changeMenu2: function(){
        this.dos = !this.dos;
      }
    }
  })
  sidebar.mount('#sidebar');
</script>