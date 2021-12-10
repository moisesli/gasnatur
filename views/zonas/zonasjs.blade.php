<script type="application/javascript">
  const {createApp, ref, computed, onMounted, reactive, watch, provide, inject, onUpdated} = Vue;
  createApp({
    setup() {

      // Constantes
      /**********************/
      const modal   = ref(false);   // modal
      const zonas   = ref();      // zonas json
      const loading = ref(false);   // loading button
      const loading_zonas = ref(false)
      const loading_newZona = ref(false);
      const zona    = reactive({
        id: '',
        nombre: '',
        estado: ''
      })

      const loadZonas  = () => {
        loading_zonas.value = true
        axios.get('./apis/zonas').then(res => {
          zonas.value = res.data;
          loading_zonas.value = false
        })
      }

      // Funciones
      /**********************/
      const closeModal = () => {
        modal.value = false
      }
      const openModal = () => {
        modal.value = true
      }
      const editZona = (zone) => {
        zona.id = zone.id
        zona.nombre = zone.nombre
        zona.estado = zone.estado
        openModal()
        console.log(zona.value)
      }
      const newZona = () => {
        loading_newZona.value = true;
        delete zona.id;
        zona.nombre = '';
        zona.estado = '';
        openModal();
        loading_newZona.value = false
      }

      const createOrUpdate = () => {

        axios.post('/apis/zonas', JSON.stringify(zona)).then(res => {
          console.log(res.data)
        })
        closeModal();
        console.log(JSON.stringify(zona))
      }

      onMounted(loadZonas)

      return {
        loadZonas,
        zonas,
        zona,
        modal,
        editZona,
        newZona,
        closeModal,
        openModal,
        loading,
        loading_newZona,
        loading_zonas,
        createOrUpdate
      }
    }
  }).mount("#app");
</script>