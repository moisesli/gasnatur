const {createApp, ref, computed, onMounted, reactive, watch, provide, inject} = Vue;
createApp({
  setup() {
    const zonas = ref({});
    const loadZonas = () => {
      axios.get('/api/zonas').then(res => {
        zonas.value = res.data;
        console.log(zonas.value);
      })
    }
    onMounted(loadZonas());

    return {loadZonas};
  }
}).mount("#app");