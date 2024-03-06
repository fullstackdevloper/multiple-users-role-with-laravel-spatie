<div class="sidebar max-h-screen top-0 h-screen bg-gray-800 text-blue-100 w-64 fixed inset-y-0 left-0 transform transition duration-200 ease-in-out z-50"
    x-data="{ open: true }" x-on:togglesidebar.window=" open = !open" x-show="true"
    :class="open === true ? 'md:translate-x-0 md:sticky ' : '-translate-x-full'">

    <header class=" h-[64px] py-2 shadow-lg px-4 md:sticky top-0 bg-gray-800 z-40">
        <a href="{{ route('dashboard.index') }}" class="text-white flex items-center space-x-2 group hover:text-white">
            <div>
                <svg class="h-8 w-8 transition-transform duration-300 group-hover:-rotate-45 " fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>

            <div>
                <span class="text-2xl font-extrabold">Laravel</span>
                <span class="text-xs block">Resource Management</span>
            </div>
        </a>
    </header>
    <nav class="px-4 pt-4 scroller overflow-y-scroll max-h-[calc(100vh-64px)]" x-data="{ selected: 'Tasks' }">
        <ul class="flex flex-col space-y-2">

            <!-- ITEM -->
            <li class="text-sm text-gray-500 ">

                <x-dropdown-link href="{{ route('dashboard.index') }}" :active="request()->routeIs('dashboard.index')"
                    class="flex items-center w-full py-1 px-2 rounded relative text-white  hover:bg-gray-700 ">
                    <div class="pr-2">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>Dashboard </div>
                </x-dropdown-link>
            </li>

            <!-- Section Devider -->
            <div class="section border-b pt-4 mb-4 text-xs text-gray-600 border-gray-700 pb-1 pl-3">
                Management
            </div>
            @can(['users.list', 'roles.list', 'permission.list'])
                <!-- ITEM -->
                <li class="text-sm text-gray-500 ">

                    <x-dropdown-link href="{{ route('users.list') }}" :active="request()->routeIs('users.list')"
                        class="flex items-center w-full py-1 px-2 rounded relative text-white  hover:bg-gray-700 ">
                        <div class="pr-2">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div>Users </div>
                    </x-dropdown-link>
                </li>
                <li class="text-sm text-gray-500 ">

                    <x-dropdown-link href="{{ route('roles.list') }}" :active="request()->routeIs('roles.list')"
                        class="flex items-center w-full py-1 px-2 rounded relative text-white  hover:bg-gray-700 ">
                        <div class="pr-2">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div>Roles </div>
                    </x-dropdown-link>
                </li>
                <li class="text-sm text-gray-500 ">

                    <x-dropdown-link href="{{ route('permission.list') }}" :active="request()->routeIs('permission.list')"
                        class="flex items-center w-full py-1 px-2 rounded relative text-white  hover:bg-gray-700 ">
                        <div class="pr-2">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div>Permission </div>
                    </x-dropdown-link>
                </li>
                <li class="text-sm text-gray-500 ">

                    <x-dropdown-link href="{{ route('posts.list') }}" :active="request()->routeIs('posts.list')"
                        class="flex items-center w-full py-1 px-2 rounded relative text-white  hover:bg-gray-700 ">
                        <div class="pr-2">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div>Posts </div>
                    </x-dropdown-link>
                </li>
            @endcan

            {{-- <!-- ITEM -->
            <li class="text-sm text-gray-500 ">
                <a href="#"
                    class="flex items-center w-full py-1 px-2 rounded relative hover:text-white hover:bg-gray-700 ">
                    <div class="pr-2">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>Errors & Bugs </div>
                </a>
            </li>

            <!-- Section Devider -->
            <div class="section border-b pt-4 mb-4 text-xs text-gray-600 border-gray-700 pb-1 pl-3">
                Managment
            </div>

            <!-- List ITEM -->
            <li class="text-sm text-gray-500 ">
                <a href="#" @click.prevent="selected = (selected === 'Team' ? '':'Team')"
                    class="flex items-center w-full py-1 px-2 rounded relative hover:text-white hover:bg-gray-700">
                    <div class="pr-2">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>Team</div>
                    <div class="absolute right-1.5 transition-transform duration-300"
                        :class="{ 'rotate-180': (selected === 'Team') }">
                        <svg class=" h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </a>


                <div class="pl-4 pr-2 overflow-hidden transition-all transform translate duration-300 max-h-0 "
                    :style="(selected === 'Team') ? 'max-height: ' + $el.scrollHeight + 'px': ''">
                    <ul class="flex flex-col mt-2 pl-2 text-gray-500 border-l border-gray-700 space-y-1 text-xs">
                        <!-- Item -->
                        <li class="text-sm text-gray-500 ">
                            <a href="#"
                                class="flex items-center w-full py-1 px-2 rounded relative hover:text-white hover:bg-gray-700">
                                <div> Users List </div>
                            </a>
                        </li>
                        <!-- Item -->
                        <li class="text-sm text-gray-500 ">
                            <a href="#"
                                class="flex items-center w-full py-1 px-2 rounded relative hover:text-white hover:bg-gray-700">
                                <div> Create User </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- List ITEM -->
            <li class="text-sm text-gray-500 ">
                <a href="#" @click.prevent="selected = (selected === 'Projects' ? '':'Projects')"
                    class="flex items-center w-full py-1 px-2 rounded relative hover:text-white hover:bg-gray-700">
                    <div class="pr-2">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                        </svg>
                    </div>
                    <div>Projects</div>
                    <div class="absolute right-1.5 transition-transform duration-300"
                        :class="{ 'rotate-180': (selected === 'Projects') }">
                        <svg class=" h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </a>


                <div class="pl-4 pr-2 overflow-hidden transition-all transform translate duration-300 max-h-0 "
                    :style="(selected === 'Projects') ? 'max-height: ' + $el.scrollHeight + 'px': ''">
                    <ul class="flex flex-col mt-2 pl-2 text-gray-500 border-l border-gray-700 space-y-1 text-xs">
                        <!-- Item -->
                        <li class="text-sm text-gray-500 ">
                            <a href="#"
                                class="flex items-center w-full py-1 px-2 rounded relative hover:text-white hover:bg-gray-700">
                                <div>List </div>
                            </a>
                        </li>
                        <!-- Item -->
                        <li class="text-sm text-gray-500 ">
                            <a href="#"
                                class="flex items-center w-full py-1 px-2 rounded relative hover:text-white hover:bg-gray-700">
                                <div> Create Project </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <!-- List ITEM -->
            <li class="text-sm text-gray-500 ">
                <a href="#" @click.prevent="selected = (selected === 'Tasks' ? '':'Tasks')"
                    class="flex items-center w-full py-1 px-2 rounded relative hover:text-white hover:bg-gray-700">
                    <div class="pr-2">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <div>Tasks</div>
                    <div class="absolute right-1.5 transition-transform duration-300"
                        :class="{ 'rotate-180': (selected === 'Tasks') }">
                        <svg class=" h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </a>


                <div class="pl-4 pr-2 overflow-hidden transition-all transform translate duration-300 max-h-0 "
                    :style="(selected === 'Tasks') ? 'max-height: ' + $el.scrollHeight + 'px': ''">
                    <ul class="flex flex-col mt-2 pl-2 text-gray-500 border-l border-gray-700 space-y-1 text-xs">
                        <!-- Item -->
                        <li class="text-sm text-gray-500 ">
                            <a href="#"
                                class="flex items-center w-full py-1 px-2 rounded relative hover:text-white hover:bg-gray-700">
                                <div>List </div>
                            </a>
                        </li>
                        <!-- Item -->
                        <li class="text-sm text-gray-500 ">
                            <a href="#"
                                class="flex items-center w-full py-1 px-2 rounded relative hover:text-white hover:bg-gray-700">
                                <div> My tasks </div>
                            </a>
                        </li>
                        <li class="text-sm text-gray-500 ">
                            <a href="#"
                                class="flex items-center w-full py-1 px-2 rounded relative hover:text-white hover:bg-gray-700">
                                <div> Create Task </div>
                            </a>
                        </li>

                        <li class="text-sm text-gray-500 ">
                            <a href="#"
                                class="flex items-center w-full py-1 px-2 rounded relative hover:text-white hover:bg-gray-700">
                                <div> Active Task </div>
                            </a>
                        </li>
                        <li class="text-sm text-gray-500 ">
                            <a href="#"
                                class="flex items-center w-full py-1 px-2 rounded relative hover:text-white hover:bg-gray-700">
                                <div> In Progress </div>
                            </a>
                        </li>
                        <li class="text-sm text-gray-500 ">
                            <a href="#"
                                class="flex items-center w-full py-1 px-2 rounded relative hover:text-white hover:bg-gray-700">
                                <div> Closed Task </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> --}}

        </ul>
    </nav>
</div>
