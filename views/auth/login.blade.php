@extends('layouts.auth')

@section('title')
  Login de usuario
@endsection

@section('content')
  @verbatim
    <main class="bg-gray-50" id="app">
      <div class="mx-auto md:h-screen flex flex-col justify-center items-center px-6 pt-8 pt:mt-0">

        <a href="#"
           class="text-2xl font-semibold flex justify-center items-center mb-8 lg:mb-10">
          <img src="https://demo.themesberg.com/windster/images/logo.svg" class="h-10 mr-4"
               alt="Windster Logo">
          <span class="self-center text-2xl font-bold whitespace-nowrap">Gasnatur</span>
        </a>

        <div class="bg-white shadow rounded-lg md:mt-0 w-full md:w-4/12 xl:p-0">
          <div class="p-6 sm:p-8 lg:p-16 space-y-8">
            <h2 class="text-center text-2xl lg:text-3xl font-bold text-gray-600">
              Login Usuario
            </h2>
            <form class="mt-8 space-y-6" action="#" v-on:submit.prevent="sendLogin">


              <div>
                <label for="email" class="text-sm font-medium text-gray-600 block mb-2">Nombre de Usuario</label>
                <input
                  type="usuario" name="usuario" id="usuario"
                  class="bg-gray-50 border border-gray-300
                   text-gray-900 sm:text-sm rounded-lg
                   outline-none focus:ring-2 focus:ring-green-500 focus:border-green-600 block w-full p-2.5"
                  v-model="login.username"
                  placeholder="mlinares" required>
              </div>


              <div>
                <label for="password" class="text-sm font-medium text-gray-900 block mb-2">Tu Contraseña</label>
                <input
                  type="password" name="password" id="password" placeholder="••••••••"
                  class="bg-gray-50 border border-gray-300
                   text-gray-900 sm:text-sm rounded-lg
                   outline-none focus:ring-2 focus:ring-green-500 focus:border-green-600 block w-full p-2.5"
                  v-model="login.password"
                  required>
              </div>

              <div class="flex items-start">
                <div class="flex items-center h-5">
                  <input
                    id="remember" aria-describedby="remember" name="remember" type="checkbox"
                    class="bg-gray-50 border-gray-300 focus:ring-3 focus:ring-green-200 h-4 w-4 rounded">
                </div>
                <div class="text-sm ml-3">
                  <label for="remember" class="font-medium text-gray-900">Recordarme</label>
                </div>
              </div>
              <button
                type="button"
                @click="sendLogin()"
                class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-200 font-medium rounded-lg text-base px-5 py-3 w-full text-center">
                <i class="fas fa-lock mr-2"></i>Entrar al Sistema
              </button>
            </form>
          </div>
        </div>
      </div>
    </main>
  @endverbatim
  <script>
    const {createApp, ref, computed, onMounted, reactive, watch, provide, inject} = Vue;
    createApp({
      setup() {
        const login = ref({
          username: '',
          password: ''
        })
        const sendLogin = () => {
          window.location.href = "zonas";
          //event.preventDefault();
          //debugger;
          //console.log(this.login);
           //axios.post('./apis/login', JSON.stringify(this.login)).then(res => {
           //  console.log(res.data)
        
            // window.location.href = "zonas";
            // console.log('Se envio los datos login');
           //})


        }
        return {login, sendLogin };
      }
    }).mount("#app");
  </script>
@endsection