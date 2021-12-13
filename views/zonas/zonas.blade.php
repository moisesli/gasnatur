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
              <input type="text" name="email" id="products-search"
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
                type="button" data-modal-toggle="add-product-modal"
                class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium inline-flex items-center rounded-lg text-sm px-3 py-3 text-center sm:ml-auto">
              <i v-show="loading_new" class="fas fa-spinner fa-spin"></i>
              <i v-show="!loading_new" class="-ml-1 w-6 fa fa-plus"></i>
              Agregar Zona
            </button>
          </div>
        </div>
      </div>
    </div>

  @endverbatim
@endsection



