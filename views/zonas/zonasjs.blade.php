<script type="application/javascript">
  const { createApp } = Vue;
  
  const app = createApp({
    data() {
      return {
        loading_new: false
      }
    }
  });
  app.use(VueFormulate);
  app.mount('#app');
  
</script>