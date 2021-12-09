<script>
  const {createApp, ref, computed, onMounted, reactive, watch, provide, inject, onUpdated} = Vue;
  createApp({
    setup() {
      const moises = ref({
        apellido: 'linares'
      });

      const zonas = ref({});

      const montar  = () => {
        axios.get('./apis/zonas').then(res => {
          zonas.value = res.data;
          console.log(res.data);
        })
      }
      onMounted(montar)

      return { moises, montar, zonas }
    }
  }).mount("#app");
</script>