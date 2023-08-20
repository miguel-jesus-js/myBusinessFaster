<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ECOMMERCE</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/iconfont/tabler-icons.min.css') }}">

</head>

<body>
    <div class="bg-gray-100">
        <header class="absolute inset-x-0 top-0 z-50">
            <nav class="bg-white flex items-center justify-between px-6 pt-4 lg:px-8" aria-label="Global">
                <div class="flex lg:flex-1">
                    <a href="#" class="-m-1.5 p-1.5">
                        <span class="sr-only">Your Company</span>
                        <img class="h-8 w-auto"
                            src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="">
                    </a>
                </div>
                <div class="flex lg:hidden">
                    <button type="button"
                        class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>
                <div class="hidden lg:flex lg:gap-x-12 lg:justify-end">
                    <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Productos</a>
                    <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Categorias</a>
                    <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Marcas</a>
                </div>
                <div class="hidden lg:flex lg:flex-1 mx-10">
                    <input type="search" class="border border-gray-300 rounded-l-md p-2 flex-1 w-20 ring-transparent focus:outline-none text-sm h-8" placeholder="Buscar...">
                    <button class="bg-gray-200 text-gray rounded-r-md p-2 hover:bg-gray-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm h-8 flex items-center justify-center"><i class="ti ti-search"></i></button>
                </div>
                <div class="hidden lg:flex lg:justify-end">
                    <a href="#" class="text-sm font-semibold leading-6 text-white bg-blue-400 p-1 rounded hover:bg-blue-600">Acceder </a>
                </div>
            </nav>
            <!-- Mobile menu, show/hide based on menu open state. -->
            <div class="lg:hidden" role="dialog" aria-modal="true">
                <!-- Background backdrop, show/hide based on slide-over state. -->
                <div class="fixed inset-0 z-50"></div>
                <div
                    class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                    <div class="flex items-center justify-between">
                        <a href="#" class="-m-1.5 p-1.5">
                            <span class="sr-only">Your Company</span>
                            <img class="h-8 w-auto"
                                src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="">
                        </a>
                        <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                            <span class="sr-only">Close menu</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="mt-6 flow-root">
                        <div class="-my-6 divide-y divide-gray-500/10">
                            <div class="space-y-2 py-6">
                                <a href="#"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Productos</a>
                                <a href="#"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Categorias</a>
                                <a href="#"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Marcas</a>
                            </div>
                            <div class="py-6">
                                <a href="#"
                                    class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 bg-blue-200 text-gray-900 hover:bg-gray-50">Acceder</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        
        <div class="mt-20 mx-auto py-9 md:py-12 px-4 md:px-6">
            <div class="flex items-strech justify-center flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-6 lg:space-x-8">
                <div class="flex flex-col md:flex-row items-strech justify-between bg-white dark:bg-gray-800 py-6 px-6 md:py-12 lg:px-12 md:w-8/12 lg:w-7/12 xl:w-8/12 2xl:w-9/12">
                    <div class="flex flex-col justify-center md:w-1/2">
                        <h1 class="text-3xl lg:text-4xl font-semibold text-gray-800 dark:text-white">Mejor trato</h1>
                        <p class="text-base lg:text-xl text-gray-800 dark:text-white mt-2">Ahorre hasta un <span class="font-bold">50%</span></p>
                    </div>
                    <div class="md:w-1/2 mt-8 md:mt-0 flex justify-center md:justify-end">
                        <img src="https://i.ibb.co/J2BtZdg/Rectangle-56-1.png" alt="" class="" />
                    </div>
                </div>
                <div class="md:w-4/12 lg:w-5/12 xl:w-4/12 2xl:w-3/12 bg-white dark:bg-gray-800 py-6 px-6 md:py-0 md:px-4 lg:px-6 flex flex-col justify-center relative">
                    <div class="flex flex-col justify-center">
                        <h1 class="text-3xl lg:text-4xl font-semibold text-gray-800 dark:text-white">Consola de juego</h1>
                        <p class="text-base lg:text-xl text-gray-800 dark:text-white">Ahorre hasta un <span class="font-bold">30%</span></p>
                    </div>
                    <div class="flex justify-end md:absolute md:bottom-4 md:right-4 lg:bottom-0 lg:right-0">
                        <img src="https://i.ibb.co/rGfP7mp/Rectangle-59-1.png" alt="" class="md:w-20 md:h-20 lg:w-full lg:h-full" />
                    </div>
                </div>
            </div>
        </div>

        <div class="">
            <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">Sugerencias</h2>
                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                    <div class="group relative bg-white p-4 rounded shadow-sm">
                        <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                            <img src="https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-01.jpg" alt="Front of men&#039;s Basic Tee in black." class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                        </div>
                        <div class="mt-4 flex justify-between">
                            <div>
                                <h3 class="text-sm text-gray-700">
                                    <a href="#">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    Playera negra
                                    </a>
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">Polo</p>
                            </div>
                            <p class="text-sm font-medium text-gray-900">$35</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  
    </div>

    <script>
        document.getElementById("mobile-menu-button").addEventListener("click", function () {
            var mainMenu = document.getElementById("mobile-menu");
            if (mainMenu.classList.contains("hidden")) {
                mainMenu.classList.remove("hidden");
            } else {
                mainMenu.classList.add("hidden");
            }
        });
    </script>

</body>

</html>
