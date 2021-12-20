<aside class="fixed hidden z-20 h-full top-0 left-0 pt-16 flex lg:flex -shrink-0 flex-col w-64 transition-width duration-75" id="sidebar">
  <div class="relative flex-1 flex flex-col min-h-0 border-r border-gray-200 bg-white pt-0">
    <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
      <div class="flex-1 px-3 bg-white divide-y space-y-1">

        <!-- Menu Desktop -->
        <ul class="space-y-2 pb-2">
          <!-- Item -->
          <li class="pt-2">
            <a href="./concesionarias" class="text-base text-gray-500 font-medium rounded-lg flex items-center p-2 hover:bg-gray-100 group">
              <i class="fab fa-affiliatetheme ml-1 w-6 text-lg text-gray-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75"></i>
              <span class="ml-3">Concecionarias</span>
            </a>
          </li>
          <!-- Item -->
          <li>
            <!-- Drop Down -->
            <div>
              <button @click="changeMenu()" class="w-full flex justify-between text-base text-gray-600 font-medium rounded-lg hover:bg-gray-100 group transition duration-75 flex items-center p-2">
                <span class="flex items-center">
                  <i class="fas fa-adjust ml-1 flex-shrink-0 group-hover:text-gray-900 transition duration-75"></i>
                  <span class="mx-4">Configuracion</span>
                </span>

                <span>
                  <i v-show="!open" class="fas fa-angle-right"></i>
                  <i v-show="open" class="fas fa-angle-down"></i>
                </span>
              </button>

              <div v-show="open" class="ml-8">
                <a class="p-2 block text-base text-gray-600 hover:bg-blue-500 hover:text-white" href="#">Manage
                  Accounts</a>
                <a class="p-2 block text-base text-gray-600 hover:bg-blue-500 hover:text-white" href="#">Manage
                  Tickets</a>
              </div>
            </div>
            <!-- End Drop Down -->
          </li>
          <li>
            <a href="./proyectos" class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group">
              <svg class="w-6 h-6 text-gray-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                </path>
              </svg>
              <span class="ml-3 flex-1 whitespace-nowrap">Proyectos</span>
              <span class="bg-gray-200 text-gray-800 ml-3 text-sm font-medium inline-flex items-center justify-center px-2 rounded-full">2
                new</span>
            </a>
          </li>
          <!-- Item -->
          <li>
            <a href="./empresas" class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group ">
              <svg class="w-6 h-6 text-gray-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z">
                </path>
                <path d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z">
                </path>
              </svg>
              <span class="ml-3 flex-1 whitespace-nowrap">Empresas</span>
              <span class="bg-gray-200 text-gray-800 ml-3 text-sm font-medium inline-flex items-center justify-center px-2 rounded-full">Pro</span>
            </a>
          </li>
          <!-- Item -->
          <li>
            <a href="./mallas" class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group ">
              <svg class="w-6 h-6 text-gray-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd">
                </path>
              </svg>
              <span class="ml-3 flex-1 whitespace-nowrap">Mallas</span>
            </a>
          </li>
          <!-- Item -->
          <li>
            <a href="./manzanas" class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group ">
              <svg class="w-6 h-6 text-gray-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                  clip-rule="evenodd"></path>
              </svg>
              <span class="ml-3 flex-1 whitespace-nowrap">Manzanas</span>
            </a>
          </li>
          <!-- Item -->
          <li>
            <a href="./zonas" class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group">
              <i class="fab fa-accusoft text-lg text-gray-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75"></i>
              <span class="ml-3 flex-1 whitespace-nowrap">Zonas</span>
            </a>
          </li>
          <li>
            <a href="https://demo.themesberg.com/windster/authentication/sign-up/" class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group ">
              <svg class="w-6 h-6 text-gray-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M5 4a3 3 0 00-3 3v6a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H5zm-1 9v-1h5v2H5a1 1 0 01-1-1zm7 1h4a1 1 0 001-1v-1h-5v2zm0-4h5V8h-5v2zM9 8H4v2h5V8z"
                  clip-rule="evenodd">
                </path>
              </svg>
              <span class="ml-3 flex-1 whitespace-nowrap">Contratos</span>
            </a>
          </li>
        </ul>
        <div class="space-y-2 pt-2">
          <a href="https://demo.themesberg.com/windster/pricing/" class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 group transition duration-75 flex items-center p-2">
            <svg class="w-5 h-5 text-gray-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="gem" role="img"
              xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
              <path fill="currentColor"
                d="M378.7 32H133.3L256 182.7L378.7 32zM512 192l-107.4-141.3L289.6 192H512zM107.4 50.67L0 192h222.4L107.4 50.67zM244.3 474.9C247.3 478.2 251.6 480 256 480s8.653-1.828 11.67-5.062L510.6 224H1.365L244.3 474.9z">
              </path>
            </svg>
            <span class="ml-4">Distritos</span>
          </a>

          <a href="./cargos" class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 group transition duration-75 flex items-center p-2">
            <svg class="w-6 h-6 text-gray-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
              <path fill-rule="evenodd"
                d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                clip-rule="evenodd"></path>
            </svg>
            <span class="ml-3">Cargos</span>
          </a>
          <a href="./planes_financiamientos" class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 group transition duration-75 flex items-center p-2">
            <i class="fab fa-black-tie w-6 text-lg text-gray-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75"></i>
            <span class="ml-3">Planes Financiamiento</span>
          </a>
          <a href="./estrato_social" class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 group transition duration-75 flex items-center p-2">
            <i class="fab fa-black-tie w-6 text-lg text-gray-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75"></i>
            <span class="ml-3">Estrato Social</span>
          </a>
          <a href="./personal" class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 group transition duration-75 flex items-center p-2">
            <i class="far fa-address-book w-6 text-lg text-gray-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75"></i>
            <span class="ml-3">Personal</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</aside>