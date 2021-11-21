<div id="app">
	<button @click="increment">increment</button>
	<p>{{count}}</p>
</div>
<?php

// CORS
//header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Methods: GET, POST');
//header("Access-Control-Allow-Headers: X-Requested-With");

$response = [ 
    "status" => "ok",
    "nombres" => "Abraham Moises",
    "apellidos" => "Linares Oscco",
    "correo" => "elnaufrago2009@gmail[.com",
    "empresa_ruc" => "10425162531",
    "empresa_razon" => "SURMOTRIZ S.R.L."
	];
?>

<script>
  const store = new Vuex.Store({
    state: {
      auth: 1,
      count: 0
    },
    mutations: {
      increment(state) {
        state.count++;
      }
    }
  });
  const app = Vue.createApp({
    methods: {
      increment() {
        this.$store.commit("increment");
      }
    },
    computed: {
      count() {
        return this.$store.state.count;
      }
    }
  });
  app.use(store);
  app.mount("#app");
</script>
