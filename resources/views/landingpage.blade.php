@extends('layouts.main')

@section('title', 'MyAppLietuva')

@section('content')
    <!-- MAIN CONTENT DIV -->
    <div class="px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60 lg:mt-24 md:mt-14">
        <div class="text-center mt-10">
            <h1 class="text-3xl lg:text-5xl font-bold text-primary-light font-sans leading-7">Rasti profesionalią pagalbą - dabar lengva</h1>
            <p class="mt-10 text-lg text-primary-light font-sans">Susisiekite tiesiogiai su patikimais paslaugų teikėjais visiems namų poreikiams, nuo žolės
        pjovimo iki dažymo ir dar daugiau.</p>
        </div>
    <div>

    <!-- Search Bar -->
        <form class="flex items-center max-w-lg mx-auto mt-10">
            <label for="voice-search" class="sr-only">Search</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7a2 2 0 0 1 2-2h5l2 2h7a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7Z"/>
                    </svg>
                </div>
                <input type="text" id="voice-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-primary-verylight focus:border-primary-light block w-full ps-10 p-2.5  ml-2" placeholder="Ieskoti paslaugos..." required />
                <button type="button" class="absolute inset-y-0 end-0 flex items-center pe-3">
                    <svg class="w-5 h-6 text-primary dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </button>
            </div>
{{--            <button type="submit" class="inline-flex items-center py-2.5 px-3 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">--}}
{{--                <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">--}}
{{--                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>--}}
{{--                </svg>Search--}}
{{--            </button>--}}
        </form>

        <!-- Skiriamoji juosta -->
        <div class="flex justify-center items-center space-x-2 mx-auto max-w-md my-8 mt-12">
            <hr class="w-16 h-1 bg-primary-light border-0 rounded md:my-12 opacity-50">
            <hr class="w-16 h-1 bg-primary-light border-0 rounded md:my-12 opacity-50">
            <hr class="w-16 h-1 bg-primary-light border-0 rounded md:my-12 opacity-50">
        </div>

        <!-- Populiarios kategorijos -->
        <div class="px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 2xl:px-60">
            <div class="text-center mt-10">
                <h1 class="text-3xl lg:text-4xl font-bold text-primary-light font-sans leading-7">Populiarios Kategorijos</h1>
            </div>
        </div>

        <!-- Kategoriju Sarasas -->
        <section class="py-8 antialiased md:py-12">
            <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                <div class="mb-4 flex items-center justify-between gap-4 md:mb-8">
                    <h2 class="text-xl font-semibold text-primary-dark sm:text-2xl"></h2>

                    <a href="#" title="" class="flex items-center text-base font-medium text-primary-700 hover:underline dark:text-primary-500">
                        Visos Kategorijos
                        <svg class="ms-1 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                        </svg>
                    </a>
                </div>

                <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    <a href="#" class="flex items-center justify-between rounded-lg border border-gray-200 bg-primary-backgroundlight px-4 py-2 hover:bg-primary-backgrounddark mb-2">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor"
                                 class="h-6 w-6 text-gray-900 mr-2">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900">Namų priežiūra ir valymas</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor"
                             class="h-4 w-4 text-gray-500">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <a href="#" class="flex items-center justify-between rounded-lg border border-gray-200 bg-primary-backgroundlight px-4 py-2 hover:bg-primary-backgrounddark mb-2">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor"
                                 class="h-6 w-6 text-gray-900 mr-2">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900">Kūrybos ir medijos paslaugos</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor"
                             class="h-4 w-4 text-gray-500">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <a href="#" class="flex items-center justify-between rounded-lg border border-gray-200 bg-primary-backgroundlight px-4 py-2 hover:bg-primary-backgrounddark mb-2">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor"
                                 class="h-6 w-6 text-gray-900 mr-2">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900">Meistrų ir remonto paslaugos</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor"
                             class="h-4 w-4 text-gray-500">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <a href="#" class="flex items-center justify-between rounded-lg border border-gray-200 bg-primary-backgroundlight px-4 py-2 hover:bg-primary-backgrounddark mb-2">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor"
                                 class="h-6 w-6 text-gray-900 mr-2">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900">Perkraustymas ir transportas</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor"
                             class="h-4 w-4 text-gray-500">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <a href="#" class="flex items-center justify-between rounded-lg border border-gray-200 bg-primary-backgroundlight px-4 py-2 hover:bg-primary-backgrounddark md:mt-8 mb-2">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor"
                                 class="h-6 w-6 text-gray-900 mr-2">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900">Namų priežiūra ir valymas</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor"
                             class="h-4 w-4 text-gray-500">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <a href="#" class="flex items-center justify-between rounded-lg border border-gray-200 bg-primary-backgroundlight px-4 py-2 hover:bg-primary-backgrounddark md:mt-8 mb-2">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor"
                                 class="h-6 w-6 text-gray-900 mr-2">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900">Kūrybos ir medijos paslaugos</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor"
                             class="h-4 w-4 text-gray-500">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <a href="#" class="flex items-center justify-between rounded-lg border border-gray-200 bg-primary-backgroundlight px-4 py-2 hover:bg-primary-backgrounddark md:mt-8 mb-2">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor"
                                 class="h-6 w-6 text-gray-900 mr-2">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900">Meistrų ir remonto paslaugos</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor"
                             class="h-4 w-4 text-gray-500">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <a href="#" class="flex items-center justify-between rounded-lg border border-gray-200 bg-primary-backgroundlight px-4 py-2 hover:bg-primary-backgrounddark md:mt-8 mb-2">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor"
                                 class="h-6 w-6 text-gray-900 mr-2">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900">Perkraustymas ir transportas</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor"
                             class="h-4 w-4 text-gray-500">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        <!-- Skiriamoji juosta -->
        <div class="flex justify-center items-center space-x-2 mx-auto max-w-md ">
            <hr class="w-16 h-1 bg-primary-light border-0 rounded md:my-12 opacity-50">
            <hr class="w-16 h-1 bg-primary-light border-0 rounded md:my-12 opacity-50">
            <hr class="w-16 h-1 bg-primary-light border-0 rounded md:my-12 opacity-50">
        </div>

@endsection

@extends('layouts.navbar')
