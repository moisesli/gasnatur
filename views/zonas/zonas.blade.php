@extends('layouts.dashboard')
@section('title','')
@section('vuejs')
  @include('zonas.zonasjs')
@endsection
@section('content')
  @verbatim

    <!-- Tools table -->
    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
      <div class="mb-1 w-full">
        <div class="mb-4">
          <nav class="flex mb-5" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
              <li class="inline-flex items-center">
                <a href="#" class="text-gray-700 hover:text-gray-900 inline-flex items-center">
                  <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20"
                       xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                  </svg>
                  Inicio
                </a>
              </li>
              <li>
                <div class="flex items-center">
                  <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                       xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                          clip-rule="evenodd"></path>
                  </svg>
                  <a href="#"
                     class="text-gray-700 hover:text-gray-900 ml-1 md:ml-2 text-sm font-medium">Configuracion</a>
                </div>
              </li>
              <li>
                <div class="flex items-center">
                  <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                       xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                          clip-rule="evenodd"></path>
                  </svg>
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
              <input type="text" name="email" id="products-search"
                     class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                     placeholder="Buscar Zonas">
            </div>
          </form>
          <div class="flex items-center sm:justify-end w-full">
            <div class="hidden md:flex pl-2 space-x-1">
              <a href="#"
                 class="text-gray-500 hover:text-gray-900 cursor-pointer p-1 hover:bg-gray-100 rounded inline-flex justify-center">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                        d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                        clip-rule="evenodd"></path>
                </svg>
              </a>
              <a href="#"
                 class="text-gray-500 hover:text-gray-900 cursor-pointer p-1 hover:bg-gray-100 rounded inline-flex justify-center">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
              </a>
              <a href="#"
                 class="text-gray-500 hover:text-gray-900 cursor-pointer p-1 hover:bg-gray-100 rounded inline-flex justify-center">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
              </a>
              <a href="#"
                 class="text-gray-500 hover:text-gray-900 cursor-pointer p-1 hover:bg-gray-100 rounded inline-flex justify-center">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                </svg>
              </a>
            </div>
            <button
              @click="newZona"
              type="button" data-modal-toggle="add-product-modal"
              class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium inline-flex items-center rounded-lg text-sm px-3 py-3 text-center sm:ml-auto">
              <i v-show="loading_newZona" class="fas fa-spinner fa-spin"></i>
              <i v-show="!loading_newZona" class="-ml-1 w-6 fa fa-plus"></i>
              Agregar Zona
            </button>
          </div>
        </div>
      </div>
    </div>


    <!-- Table Zonas -->
    <div class="flex flex-col">
      <div class="overflow-x-auto">
        <div class="align-middle inline-block min-w-full">
          <div class="shadow overflow-hidden">
            <div v-show="loading_zonas" class="grid justify-items-center fa-7x pt-24 pb-40 pr-28">
              <i class="fas fa-spinner fa-spin text-gray-700"></i>
            </div>
            <table v-show="!loading_zonas" class="table-fixed min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-100">
              <tr>
                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                  #id
                </th>
                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                  Nombre de la Zona
                </th>
                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                  Estado Zona
                </th>
                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                  Acciones
                </th>
              </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
              <tr class="hover:bg-gray-100" v-for="(zona, index) in zonas">
                <td class="p-4 w-4">
                  <div class="flex items-center">
                    {{ index + 1 }}
                  </div>
                </td>
                <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                  <div class="text-base font-semibold text-gray-900">{{ zona.nombre }}</div>
                </td>
                <td class="p-4 whitespace-nowrap text-base font-medium text-gray-900">{{ zona.estado }}</td>
                <td class="p-4 whitespace-nowrap space-x-2">
                  <!-- Button Edit -->
                  <button
                    @click="editZona(zona)"
                    type="button" data-modal-toggle="product-modal"
                    class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2 text-center">
                    <i v-show="!loading" class="mr-2 text-base fa fa-edit"></i>
                    <i v-show="loading" class="text-base fas fa-spinner fa-spin mr-2"></i>
                    Editar
                  </button>
                  <!-- Button Delete -->
                  <button
                    type="button" data-modal-toggle="delete-product-modal"
                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2 text-center">
                    <i v-show="!loading" class="mr-2 text-base fa fa-trash"></i>
                    <i v-show="loading" class="fas fa-spinner fa-spin mr-2"></i>
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

    <!-- Pagination Zonas -->
    <div
      class="bg-white sticky sm:flex items-center w-full sm:justify-between bottom-0 right-0 border-t border-gray-200 p-4">
      <div class="flex items-center mb-4 sm:mb-0">
        <a href="#"
           class="text-gray-500 hover:text-gray-900 cursor-pointer p-1 hover:bg-gray-100 rounded inline-flex justify-center">
          <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                  clip-rule="evenodd"></path>
          </svg>
        </a>
        <a href="#"
           class="text-gray-500 hover:text-gray-900 cursor-pointer p-1 hover:bg-gray-100 rounded inline-flex justify-center mr-2">
          <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                  clip-rule="evenodd"></path>
          </svg>
        </a>
        <span class="text-sm font-normal text-gray-500">Showing <span
            class="text-gray-900 font-semibold">1-20</span> of <span
            class="text-gray-900 font-semibold">2290</span></span>
      </div>
      <div class="flex items-center space-x-3">
        <a href="#"
           class="flex-1 text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium inline-flex items-center justify-center rounded-lg text-sm px-3 py-2 text-center">
          <svg class="-ml-1 mr-1 h-5 w-5">
            "="" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                  clip-rule="evenodd"></path>
          </svg>
          Previous
        </a>
        <a href="#"
           class="flex-1 text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium inline-flex items-center justify-center rounded-lg text-sm px-3 py-2 text-center">
          Next
          <svg class="-mr-1 ml-1 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                  clip-rule="evenodd"></path>
          </svg>
        </a>
      </div>
    </div>

    <!-- Modal -->
    <div v-bind:class="{ hidden: !modal }">
      <div
<<<<<<< HEAD
        class="bg-white sticky sm:flex items-center w-full sm:justify-between bottom-0 right-0 border-t border-gray-200 p-4">
        <div class="flex items-center mb-4 sm:mb-0">
          <a href="#"
             class="text-gray-500 hover:text-gray-900 cursor-pointer p-1 hover:bg-gray-100 rounded inline-flex justify-center">
            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                    clip-rule="evenodd"></path>
            </svg>
          </a>
          <a href="#"
             class="text-gray-500 hover:text-gray-900 cursor-pointer p-1 hover:bg-gray-100 rounded inline-flex justify-center mr-2">
            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                    clip-rule="evenodd"></path>
            </svg>
          </a>


          <span class="text-sm font-normal text-gray-500">Showing 
            

          <span class="text-gray-900 font-semibold">1-20</span> of 


          <span class="text-gray-900 font-semibold">2290</span>
        
        
          </span>



        </div>
        <div class="flex items-center space-x-3">
          <a href="#"
             class="flex-1 text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-200 font-medium inline-flex items-center justify-center rounded-lg text-sm px-3 py-2 text-center">
            <svg class="-ml-1 mr-1 h-5 w-5">
              "="" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                    clip-rule="evenodd"></path>
            </svg>
            Previous
          </a>
          <a href="#"
             class="flex-1 text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-200 font-medium inline-flex items-center justify-center rounded-lg text-sm px-3 py-2 text-center">
            Next
            <svg class="-mr-1 ml-1 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                    clip-rule="evenodd"></path>
            </svg>
          </a>
=======
        class="overflow-x-hidden overflow-y-auto fixed top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center h-modal sm:h-full flex"
        id="user-modal" aria-modal="true" role="dialog">
        <div class="relative w-full max-w-xl px-4 h-full md:h-auto">

          <div class="bg-white rounded-lg shadow relative">

            <div class="flex items-start justify-between p-5 border-b rounded-t">
              <h3 class="text-xl font-semibold">
                <i class="fas fa-edit text-gray-600 mr-2"></i>Nuevo Zona
              </h3>
              <button
                @click="closeModal"
                type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                data-modal-toggle="user-modal">
                <i class="fas fa-times fa-lg p-1 text-gray-400"></i>
              </button>
            </div>

            <div class="p-6 space-y-6">
              <form action="#">
                <div class="grid grid-cols-6 gap-6">
                  <div class="col-span-6 sm:col-span-3">
                    <label for="nombre" class="text-sm font-medium text-gray-900 block mb-2">Nombre de Zona</label>
                    <input
                      v-model="zona.nombre"
                      type="text" name="nombre" id="nombre"
                      class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-base rounded-lg outline-none focus:ring-2 focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2"
                      placeholder="Lima Norte" required="">
                  </div>
                  <div class="col-span-6 sm:col-span-3">
                    <label for="last-name" class="text-sm font-medium text-gray-900 block mb-2">Estado de Zona</label>
                    <input
                      v-model="zona.estado"
                      type="text" name="last-name" id="last-name"
                      class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-base rounded-lg outline-none focus:ring-2 focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2"
                      placeholder="Activo" required="">
                  </div>
                </div>
              </form>
            </div>

            <div class="items-center p-6 border-t border-gray-200 bg-gray-50 rounded-b">
              <button
                @click="createOrUpdate"
                type="submit"
                class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3">
                <i class="fas fa-save mr-2 text-base"></i>Guardar Datos
              </button>
              <button
                @click="closeModal"
                class="text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                <i class="fas fa-times-circle mr-2 text-base"></i>Cancelar
              </button>
            </div>

          </div>
>>>>>>> 057422678b1123d58b98a43abfed8468a195e871
        </div>
      </div>
      <div class="bg-gray-900 bg-opacity-50 fixed inset-0 z-40"></div>
    </div>

  @endverbatim
@endsection



