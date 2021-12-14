@extends('layouts.dashboard')
@section('title','')
@section('vuejs')
  @include('zonas.zonasjs')
@endsection
@section('content')
  @verbatim

    <!-- Tools Bread Crunds and Search -->  
    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">  
      <div class="mb-1 w-full">
        <div class="mb-4">
          <nav class="flex mb-5" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
              <li class="inline-flex items-center">
                <a href="#" class="text-gray-700 hover:text-gray-900 inline-flex items-center">
                <i class="fas fa-home mr-2.5"></i>
                  Inicio
                </a>
              </li>
              <li>
                <div class="flex items-center">
                <i class="fas fa-chevron-right text-gray-400 ml-2 mr-2 text-sm"></i>
                  <a href="#"
                     class="text-gray-700 hover:text-gray-900 ml-1 md:ml-2 text-sm font-medium">Configuracion</a>
                </div>
              </li>
              <li>
                <div class="flex items-center">
                  <i class="fas fa-chevron-right text-gray-400 ml-2 mr-2 text-sm"></i>
                  <span class="text-gray-400 ml-1 md:ml-2 text-sm font-medium" aria-current="page">
                      Zonas
                    </span>
                </div>
              </li>
            </ol>
          </nav>
          <h1 class="text-xl sm:text-2xl font-semibold text-gray-900">
            Lista de Zonas
          </h1>
        </div>
        <div class="block sm:flex items-center md:divide-x md:divide-gray-100">

          <form class="sm:pr-3 mb-4 sm:mb-0" action="#" method="GET">
            <label for="products-search" class="sr-only">Search</label>
            <div class="mt-1 relative sm:w-64 xl:w-96">
              <input 
                type="text" name="email" id="products-search"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                placeholder="Buscar Zonas">
            </div>
          </form>
          <div class="flex items-center sm:justify-end w-full">
            <div class="hidden md:flex pl-2 space-x-1">
              <a href="#" class="text-gray-500 hover:text-gray-900 cursor-pointer p-1 hover:bg-gray-100 rounded inline-flex justify-center">
                <i class="fas fa-cog text-xl mr-2"></i>                
              </a>
              <a href="#" class="text-gray-500 hover:text-gray-900 cursor-pointer p-1 hover:bg-gray-100 rounded inline-flex justify-center">
              <i class="fas fa-trash-alt text-xl mr-2"></i>                
              </a>
              <a href="#" class="text-gray-500 hover:text-gray-900 cursor-pointer p-1 hover:bg-gray-100 rounded inline-flex justify-center">
                 <i class="fas fa-question-circle text-xl mr-2"></i>
              </a>
              <a href="#" class="text-gray-500 hover:text-gray-900 cursor-pointer p-1 hover:bg-gray-100 rounded inline-flex justify-center">
                 <i class="fas fa-ellipsis-v text-lg"></i>
              </a>
            </div>
            <button 
              @click="newItem()"               
              type="button" data-modal-toggle="add-product-modal"
              class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium inline-flex items-center rounded-lg text-sm px-3 py-3 text-center sm:ml-auto">              
              <i class="-ml-1 w-6 fa fa-plus"></i>
              Agregar Nuevo
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Table -->
    <div class="flex flex-col">
      <div class="overflow-x-auto">
        <div class="align-middle inline-block min-w-full">
          <div class="shadow overflow-hidden">
            <div v-show="loading.items" class="grid justify-items-center fa-7x pt-24 pb-40 pr-28">
              <i class="fas fa-spinner fa-spin text-gray-700"></i>
            </div>
            <table v-show="!loading.items" class="table-fixed min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-100">
              <tr>
                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                  #id
                </th>
                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                  Nombre
                </th>
                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                  Estado
                </th>                
                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                  Acciones
                </th>
              </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr class="hover:bg-gray-100" v-for="(item, index) in items">
                  <td class="p-4 w-4">
                    <div class="flex items-center">
                      {{ index + 1 }}
                    </div>
                  </td>
                  <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                    <div class="text-base font-semibold text-gray-900">
                      {{ item.nombre }}
                    <div>                  
                  </td>
                  <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                    <div class="text-base font-semibold text-gray-900">
                      {{ item.estado }}
                    <div>
                  </td>                
                  <td class="p-4 whitespace-nowrap space-x-2">
                    <!-- Button Edit -->
                    <button
                      @click="editItem(item)"
                      type="button" data-modal-toggle="product-modal"
                      class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2 text-center">
                      <i v-show="!loading.edit" class="mr-2 text-base fa fa-edit"></i>
                      <i v-show="loading.edit" class="text-base fas fa-spinner fa-spin mr-2"></i>
                      Editar
                    </button>
                    <!-- Button Delete -->
                    <button
                      type="button" data-modal-toggle="delete-product-modal"
                      class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2 text-center">
                      <i v-show="!loading.edit" class="mr-2 text-base fa fa-trash"></i>
                      <i v-show="loading.edit" class="fas fa-spinner fa-spin mr-2"></i>
                      Borrar
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div v-bind:class="{ hidden: !modal.show }">
      <div 
        class="overflow-x-hidden overflow-y-auto fixed top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center h-modal sm:h-full flex"
        id="user-modal" aria-modal="true" role="dialog">
        <div class="relative w-full max-w-2xl px-4 h-full md:h-auto">

          <div class="bg-white rounded-lg shadow relative">

            <div class="flex items-start justify-between p-5 border-b rounded-t">
              <h3 class="text-xl font-semibold">
                <i class="fas fa-edit text-gray-600 mr-2"></i>
                <span v-if="modal_tipo=='new'">Nuevo Personal</span>
                <span v-else>Editar Personal</span>   
              </h3>
              <button
                @click="closeModal()"
                type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                data-modal-toggle="user-modal">
                <i class="fas fa-times fa-lg p-1 text-gray-400"></i>
              </button>
            </div>

            <div class="p-6 space-y-6">
              <!-- Message -->
              <span v-show="!message.success">{{ message.message }}</span>              
              <!-- End Message -->
              <form action="#">                

                <div class="flex flex-col md:flex-row">
                  <div class="w-1/2 bg-gray-300">a</div>
                  <div class="w-1/2">b</div>
                </div>
                <div class="grid grid-cols-6 gap-6">
                  <div class="col-span-6 sm:col-span-3">
                    <label for="nombre" class="text-sm font-medium text-gray-900 block mb-2">Nombres</label>
                    <input
                      v-model="item.nombre"
                      type="text" name="nombres" id="nombres"
                      class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-base rounded-lg outline-none focus:ring-2 focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2"
                      placeholder="" required="">
                  </div>
                  <div class="col-span-6 sm:col-span-3">
                    <label for="last-name" class="text-sm font-medium text-gray-900 block mb-2">Apellidos</label>
                    <input
                      v-model="item.estado"
                      type="text" name="apellidos" id="apellidos"
                      class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-base rounded-lg outline-none focus:ring-2 focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2"
                      placeholder="Activo" required="">
                  </div>                  
                </div>
              </form>
            </div>

            <div class="items-center p-6 border-t border-gray-200 bg-gray-50 rounded-b">              
              <button
                @click="store(item)"
                class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3">
                <i v-show="loadingStore" class="fas fa-sync fa-spin fa-spin text-base mr-2"></i>
                <i v-show="!loadingStore" class="fas fa-save mr-2 text-base"></i>Guardar
              </button>              
              <button
                @click="closeModal()"
                class="text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                <i class="fas fa-times-circle mr-2 text-base"></i>Cancelar
              </button>
            </div>

          </div>
        </div>
      </div>
      <div class="bg-gray-900 bg-opacity-50 fixed inset-0 z-40"></div>
    </div>

  @endverbatim
@endsection



