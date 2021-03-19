{{-- <nav x-data="{ open: false }" class="py-4">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-jet-application-mark class="block h-9 w-auto" />
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>

                        @else
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        @endif
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>

                        <x-jet-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-jet-dropdown-link>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-jet-dropdown-link>
                        @endif

                        <div class="border-t border-gray-100"></div>

                        <!-- Team Management -->
                        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Team') }}
                            </div>

                            <!-- Team Settings -->
                            <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                {{ __('Team Settings') }}
                            </x-jet-dropdown-link>

                            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                    {{ __('Create New Team') }}
                                </x-jet-dropdown-link>
                            @endcan

                            <div class="border-t border-gray-100"></div>

                            <!-- Team Switcher -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Switch Teams') }}
                            </div>

                            @foreach (Auth::user()->allTeams() as $team)
                                <x-jet-switchable-team :team="$team" />
                            @endforeach

                            <div class="border-t border-gray-100"></div>
                        @endif

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                {{ __('Logout') }}
                            </x-jet-dropdown-link>
                        </form>
                    </x-slot>
                </x-jet-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-jet-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                </div>

                <div class="ml-3">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-jet-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-jet-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-jet-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-jet-responsive-nav-link>

                    <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                        {{ __('Create New Team') }}
                    </x-jet-responsive-nav-link>

                    <div class="border-t border-gray-200"></div>

                    <!-- Team Switcher -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @foreach (Auth::user()->allTeams() as $team)
                        <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</nav> --}}

{{--begin::Aside--}}
<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">

    {{--begin::Brand--}}
    <div class="brand flex-column-auto" id="kt_brand">

        <!--begin::Logo-->
        <a href="#" class="brand-logo">
            <img alt="Logo" class="w-65px" src="assets/media/logos/logo-letter-9.png" />
        </a>
        <!--end::Logo-->

    </div>
    <!--end::Brand-->

    <!--begin::Aside Menu-->
    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">

        <!--begin::Menu Container-->
        <div id="kt_aside_menu" class="aside-menu my-4 aside-menu-dropdown" data-menu-vertical="1" data-menu-dropdown="1" data-menu-scroll="0" data-menu-dropdown-timeout="500">

            <!--begin::Menu Nav-->
            <ul class="menu-nav">
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{{ route('dashboard') }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M3.95709826,8.41510662 L11.47855,3.81866389 C11.7986624,3.62303967 12.2013376,3.62303967 12.52145,3.81866389 L20.0429,8.41510557 C20.6374094,8.77841684 21,9.42493654 21,10.1216692 L21,19.0000642 C21,20.1046337 20.1045695,21.0000642 19,21.0000642 L4.99998155,21.0000673 C3.89541205,21.0000673 2.99998155,20.1046368 2.99998155,19.0000673 L2.99999828,10.1216672 C2.99999935,9.42493561 3.36258984,8.77841732 3.95709826,8.41510662 Z M10,13 C9.44771525,13 9,13.4477153 9,14 L9,17 C9,17.5522847 9.44771525,18 10,18 L14,18 C14.5522847,18 15,17.5522847 15,17 L15,14 C15,13.4477153 14.5522847,13 14,13 L10,13 Z" fill="#000000"/>
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">{{ __('Dashboard') }}</span>
                    </a>
                </li>
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M5.94290508,4 L18.0570949,4 C18.5865712,4 19.0242774,4.41271535 19.0553693,4.94127798 L19.8754445,18.882556 C19.940307,19.9852194 19.0990032,20.9316862 17.9963398,20.9965487 C17.957234,20.9988491 17.9180691,21 17.8788957,21 L6.12110428,21 C5.01653478,21 4.12110428,20.1045695 4.12110428,19 C4.12110428,18.9608266 4.12225519,18.9216617 4.12455553,18.882556 L4.94463071,4.94127798 C4.97572263,4.41271535 5.41342877,4 5.94290508,4 Z" fill="#000000" opacity="0.3"/>
                                    <path d="M7,7 L9,7 C9,8.65685425 10.3431458,10 12,10 C13.6568542,10 15,8.65685425 15,7 L17,7 C17,9.76142375 14.7614237,12 12,12 C9.23857625,12 7,9.76142375 7,7 Z" fill="#000000"/>
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">{{ __('Achat') }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">{{ __('Achat') }}</span>
                                </span>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('create-demande-achat') }}" class="menu-link">
                                    <i class="fa fa-file-invoice-dollar"></i>
                                    <span class="menu-text">{{ __('Demande Achat') }}</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('create-bon-commande') }}" class="menu-link">
                                    <i class="fa fa-clipboard-list"></i>
                                    <span class="menu-text">{{ __('Bon de commande') }}</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('create-bon-achat') }}" class="menu-link">
                                    <i class="fa fa-receipt"></i>
                                    <span class="menu-text">{{ __('Bon réception') }}</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('create-reglement-fournisseur') }}" class="menu-link">
                                    <i class="fa fa-clipboard-check"></i>
                                    <span class="menu-text">{{ __('Règlement') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M18.1446364,11.84388 L17.4471627,16.0287218 C17.4463569,16.0335568 17.4455155,16.0383857 17.4446387,16.0432083 C17.345843,16.5865846 16.8252597,16.9469884 16.2818833,16.8481927 L4.91303792,14.7811299 C4.53842737,14.7130189 4.23500006,14.4380834 4.13039941,14.0719812 L2.30560137,7.68518803 C2.28007524,7.59584656 2.26712532,7.50338343 2.26712532,7.4104669 C2.26712532,6.85818215 2.71484057,6.4104669 3.26712532,6.4104669 L16.9929851,6.4104669 L17.606173,3.78251876 C17.7307772,3.24850086 18.2068633,2.87071314 18.7552257,2.87071314 L20.8200821,2.87071314 C21.4717328,2.87071314 22,3.39898039 22,4.05063106 C22,4.70228173 21.4717328,5.23054898 20.8200821,5.23054898 L19.6915238,5.23054898 L18.1446364,11.84388 Z" fill="#000000" opacity="0.3"/>
                                    <path d="M6.5,21 C5.67157288,21 5,20.3284271 5,19.5 C5,18.6715729 5.67157288,18 6.5,18 C7.32842712,18 8,18.6715729 8,19.5 C8,20.3284271 7.32842712,21 6.5,21 Z M15.5,21 C14.6715729,21 14,20.3284271 14,19.5 C14,18.6715729 14.6715729,18 15.5,18 C16.3284271,18 17,18.6715729 17,19.5 C17,20.3284271 16.3284271,21 15.5,21 Z" fill="#000000"/>
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">{{ __('Vente') }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">{{ __('Vente') }}</span>
                                </span>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('create-devis') }}" class="menu-link">
                                    <i class="fa fa-money-check"></i>
                                    <span class="menu-text">{{ __('Devis') }}</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('create-bon-commande-vente') }}" class="menu-link">
                                    <i class="fa fa-clipboard-list"></i>
                                    <span class="menu-text">{{ __('Bon de commande') }}</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('create-bon-livraison') }}" class="menu-link">
                                    <i class="fa fa-truck-loading"></i>
                                    <span class="menu-text">{{ __('Bon de livraison') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M4.00246329,12.2004927 L13,14 L13,4.06189375 C16.9463116,4.55399184 20,7.92038235 20,12 C20,16.418278 16.418278,20 12,20 C7.64874861,20 4.10886412,16.5261253 4.00246329,12.2004927 Z" fill="#000000" opacity="0.3"/>
                                    <path d="M3.0603968,10.0120794 C3.54712466,6.05992157 6.91622084,3 11,3 L11,11.6 L3.0603968,10.0120794 Z" fill="#000000"/>
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">{{ __('Etats') }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">{{ __('Etats') }}</span>
                                </span>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('stock') }}" class="menu-link">
                                    <i class="fa fa-chart-line"></i>
                                    <span class="menu-text">{{ __('Etat du stock') }}</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('journal-achat') }}" class="menu-link">
                                    <i class="fa fa-university"></i>
                                    <span class="menu-text">{{ __("Journal d'achat") }}</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('journal-caisse') }}" class="menu-link">
                                    <i class="fa fa-cash-register"></i>
                                    <span class="menu-text">{{ __('Journal de caisse') }}</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('journal-banque') }}" class="menu-link">
                                    <i class="fa fa-university"></i>
                                    <span class="menu-text">{{ __('Journal de banque') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                    <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                    <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">{{ __('Ressource Humaine') }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">{{ __('Ressource Humaine') }}</span>
                                </span>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('employes') }}" class="menu-link">
                                    <i class="fa fa-id-card"></i>
                                    <span class="menu-text">{{ __('Employés') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <rect fill="#000000" opacity="0.3" x="7" y="4" width="10" height="4"/>
                                    <path d="M7,2 L17,2 C18.1045695,2 19,2.8954305 19,4 L19,20 C19,21.1045695 18.1045695,22 17,22 L7,22 C5.8954305,22 5,21.1045695 5,20 L5,4 C5,2.8954305 5.8954305,2 7,2 Z M8,12 C8.55228475,12 9,11.5522847 9,11 C9,10.4477153 8.55228475,10 8,10 C7.44771525,10 7,10.4477153 7,11 C7,11.5522847 7.44771525,12 8,12 Z M8,16 C8.55228475,16 9,15.5522847 9,15 C9,14.4477153 8.55228475,14 8,14 C7.44771525,14 7,14.4477153 7,15 C7,15.5522847 7.44771525,16 8,16 Z M12,12 C12.5522847,12 13,11.5522847 13,11 C13,10.4477153 12.5522847,10 12,10 C11.4477153,10 11,10.4477153 11,11 C11,11.5522847 11.4477153,12 12,12 Z M12,16 C12.5522847,16 13,15.5522847 13,15 C13,14.4477153 12.5522847,14 12,14 C11.4477153,14 11,14.4477153 11,15 C11,15.5522847 11.4477153,16 12,16 Z M16,12 C16.5522847,12 17,11.5522847 17,11 C17,10.4477153 16.5522847,10 16,10 C15.4477153,10 15,10.4477153 15,11 C15,11.5522847 15.4477153,12 16,12 Z M16,16 C16.5522847,16 17,15.5522847 17,15 C17,14.4477153 16.5522847,14 16,14 C15.4477153,14 15,14.4477153 15,15 C15,15.5522847 15.4477153,16 16,16 Z M16,20 C16.5522847,20 17,19.5522847 17,19 C17,18.4477153 16.5522847,18 16,18 C15.4477153,18 15,18.4477153 15,19 C15,19.5522847 15.4477153,20 16,20 Z M8,18 C7.44771525,18 7,18.4477153 7,19 C7,19.5522847 7.44771525,20 8,20 L12,20 C12.5522847,20 13,19.5522847 13,19 C13,18.4477153 12.5522847,18 12,18 L8,18 Z M7,4 L7,8 L17,8 L17,4 L7,4 Z" fill="#000000"/>
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">{{ __('Compta/Finance') }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">{{ __('Compta/Finance') }}</span>
                                </span>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('create-charge') }}" class="menu-link">
                                    <i class="fa fa-money-bill-wave"></i>
                                    <span class="menu-text">{{ __('Charges') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect opacity="0.200000003" x="0" y="0" width="24" height="24"/>
                                    <path d="M4.5,7 L9.5,7 C10.3284271,7 11,7.67157288 11,8.5 C11,9.32842712 10.3284271,10 9.5,10 L4.5,10 C3.67157288,10 3,9.32842712 3,8.5 C3,7.67157288 3.67157288,7 4.5,7 Z M13.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L13.5,18 C12.6715729,18 12,17.3284271 12,16.5 C12,15.6715729 12.6715729,15 13.5,15 Z" fill="#000000" opacity="0.3"/>
                                    <path d="M17,11 C15.3431458,11 14,9.65685425 14,8 C14,6.34314575 15.3431458,5 17,5 C18.6568542,5 20,6.34314575 20,8 C20,9.65685425 18.6568542,11 17,11 Z M6,19 C4.34314575,19 3,17.6568542 3,16 C3,14.3431458 4.34314575,13 6,13 C7.65685425,13 9,14.3431458 9,16 C9,17.6568542 7.65685425,19 6,19 Z" fill="#000000"/>
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">{{ __('Parametrage') }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">{{ __('Parametrage') }}</span>
                                </span>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('create-site') }}" class="menu-link">
                                    <i class="fa fa-building"></i>
                                    <span class="menu-text">{{ __('Site') }}</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('create-depot') }}" class="menu-link">
                                    <i class="fa fa-warehouse"></i>
                                    <span class="menu-text">{{ __('Dépôt') }}</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('create-famille') }}" class="menu-link">
                                    <i class="fa fa-boxes"></i>
                                    <span class="menu-text">{{ __('Familles') }}</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('create-sous-famille') }}" class="menu-link">
                                    <i class="fa fa-boxes"></i>
                                    <span class="menu-text">{{ __('Sous-familles') }}</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('create-unite') }}" class="menu-link">
                                    <i class="fa fa-vector-square"></i>
                                    <span class="menu-text">{{ __('Unité') }}</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('create-article') }}" class="menu-link">
                                    <i class="fa fa-box-open"></i>
                                    <span class="menu-text">{{ __('Articles') }}</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('create-compte-comptable') }}" class="menu-link">
                                    <i class="fa fa-calculator"></i>
                                    <span class="menu-text">{{ __('Compte comptable') }}</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('create-compte') }}" class="menu-link">
                                    <i class="fa fa-university"></i>
                                    <span class="menu-text">{{ __('Compte bancaire') }}</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('create-caisse') }}" class="menu-link">
                                    <i class="fa fa-cash-register"></i>
                                    <span class="menu-text">{{ __('Caisse') }}</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('create-mode-paiement') }}" class="menu-link">
                                    <i class="fa fa-money-check-alt"></i>
                                    <span class="menu-text">{{ __('Mode Paiement') }}</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('create-fournisseur') }}" class="menu-link">
                                    <i class="fa fa-user-tie"></i>
                                    <span class="menu-text">{{ __('Fournisseurs') }}</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('create-client') }}" class="menu-link">
                                    <i class="fa fa-user"></i>
                                    <span class="menu-text">{{ __('Client') }}</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('create-commerciale') }}" class="menu-link">
                                    <i class="fa fa-coins"></i>
                                    <span class="menu-text">{{ __('Commercial') }}</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('create-production-parametre-fixe') }}" class="menu-link">
                                    <i class="fa fa-cogs"></i>
                                    <span class="menu-text">{{ __('Paramétres Production') }}</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('create-production-opération') }}" class="menu-link">
                                    <i class="fa fa-recycle"></i>
                                    <span class="menu-text">{{ __('Opération Production') }}</span>
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                </li>
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000" />
                                    <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                        </span>
                        <span class="menu-text">{{ __('Paramétrage Utilisateurs') }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">{{ __('Paramétrage Utilisateurs') }}</span>
                                </span>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('create-roles') }}" class="menu-link">
                                    <i class="fa fa-user-circle"></i>
                                    <span class="menu-text">{{ __('Profils') }}</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('create-permissions') }}" class="menu-link">
                                    <i class="fa fa-shield-alt"></i>
                                    <span class="menu-text">{{ __('Autorisations') }}</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{ route('create-users') }}" class="menu-link">
                                    <i class="fa fa-users"></i>
                                    <span class="menu-text">{{ __('Utilisateurs') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            <!--end::Menu Nav-->

        </div>
        <!--end::Menu Container-->

    </div>
    <!--end::Aside Menu-->

</div>
<!--end::Aside-->

{{-- <nav class="nav-bar" x-data="{tabid:1,open:false,open2:false}">
    <ul class="nav-items">
        <li class="nav-item" @click="tabid=1">
            <span :class="tabid==1?'text-indigo-500 bg-white active':'text-gray-700 bg-indigo-200'">
                <i class="fa fa-home"></i> Dashboard
            </span>
        </li>
        <li class="nav-item dropdown" @click="tabid=2">
            <span :class="tabid==2 && open==!false?'text-indigo-500 bg-white active':'text-gray-700 bg-indigo-200'" @click="open=!open">
                <i class="fa fa-cog"></i> {{ __('Parametrage') }}
            </span>

            <div class="dropdown-overlay" x-show="open" @click="open=false"></div>

            <div class="dropdown-list" x-show="open" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                <div class="py-1">
                    <a href="{{ route('create-site') }}" class="dropdown-item" role="menuitem">
                        <i class="fa fa-building"></i> {{ __('Site') }}
                    </a>
                    <a href="{{ route('create-depot') }}" class="dropdown-item" role="menuitem">
                        <i class="fa fa-warehouse"></i> {{ __('Dépôt') }}
                    </a>
                </div>
                <div class="py-1">
                    <a href="{{ route('create-famille') }}" class="dropdown-item" role="menuitem">
                        <i class="fa fa-boxes"></i> {{ __('Familles') }}
                    </a>
                    <a href="{{ route('create-sous-famille') }}" class="dropdown-item" role="menuitem">
                        <i class="fa fa-boxes"></i> {{ __('Sous-familles') }}
                    </a>
                    <a href="{{ route('create-unite') }}" class="dropdown-item" role="menuitem">
                        <i class="fa fa-vector-square"></i> {{ __('Unité') }}
                    </a>
                    <a href="{{ route('create-article') }}" class="dropdown-item" role="menuitem">
                        <i class="fa fa-box-open"></i> {{ __('Articles') }}
                    </a>
                </div>
                <div class="py-1">
                    <a href="{{ route('create-compte-comptable') }}" class="dropdown-item" role="menuitem">
                        <i class="fa fa-calculator"></i> {{ __('Compte comptable') }}
                    </a>
                    <a href="{{ route('create-compte') }}" class="dropdown-item" role="menuitem">
                        <i class="fa fa-university"></i> {{ __('Compte bancaire') }}
                    </a>
                    <a href="{{ route('create-caisse') }}" class="dropdown-item" role="menuitem">
                        <i class="fas fa-cash-register"></i> {{ __('Caisse') }}
                    </a>
                    <a href="{{ route('create-mode-paiement') }}" class="dropdown-item" role="menuitem">
                        <i class="fa fa-money-check-alt"></i> {{ __('Mode Paiement') }}
                    </a>
                </div>
                <div class="py-1">
                    <a href="{{ route('create-fournisseur') }}" class="dropdown-item" role="menuitem">
                        <i class="fa fa-user-tie"></i> {{ __('Fournisseurs') }}
                    </a>
                    <a href="{{ route('create-client') }}" class="dropdown-item" role="menuitem">
                        <i class="fa fa-user"></i> {{ __('Client') }}
                    </a>
                    <a href="{{ route('create-commerciale') }}" class="dropdown-item" role="menuitem">
                        <i class="fa fa-coins"></i> {{ __('Commercial') }}
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item dropdown" @click="tabid=3">
            <span :class="tabid==3 && open2==!false?'text-indigo-500 bg-white active':'text-gray-700 bg-indigo-200'" @click="open2=!open">
                <i class="fa fa-user-cog"></i> {{ __('Paramétrage Utilisateurs') }}
            </span>

            <div class="dropdown-overlay" x-show="open2" @click="open2=false"></div>

            <div class="dropdown-list" x-show="open2" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                <div class="py-1">
                    <a href="{{ route('create-roles') }}" class="dropdown-item" role="menuitem">
                        <i class="fa fa-user-circle"></i> {{ __('Profils') }}
                    </a>
                    <a href="{{ route('create-permissions') }}" class="dropdown-item" role="menuitem">
                        <i class="fa fa-shield-alt"></i> {{ __('Autorisations') }}
                    </a>
                    <a href="{{ route('create-users') }}" class="dropdown-item" role="menuitem">
                        <i class="fa fa-users"></i> {{ __('Utilisateurs') }}
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item" @click="tabid=4">
            <span :class="tabid==3?'text-indigo-500 bg-white':'text-gray-700 bg-indigo-200'">
                <i class="fa fa-cash-register"></i> Compta / Finance
            </span>
        </li>
        <li class="nav-item" @click="tabid=5">
            <span :class="tabid==4?'text-indigo-500 bg-white':'text-gray-700 bg-indigo-200'">
                <i class="fa fa-shopping-bag"></i> Achat
            </span>
        </li>
        <li class="nav-item" @click="tabid=6">
            <span :class="tabid==5?'text-indigo-500 bg-white':'text-gray-700 bg-indigo-200'">
                <i class="fa fa-chart-pie"></i> Etats
            </span>
        </li>
        <li class="nav-item" @click="tabid=7">
            <span :class="tabid==6?'text-indigo-500 bg-white':'text-gray-700 bg-indigo-200'">
                <i class="fa fa-shopping-cart"></i> Vente
            </span>
        </li>

    </ul>

    <div class="tabs">
        <div class="block" x-show="tabid==1">
            <ul class="tab-list">
                <li class="tab-item">
                    <a href="#">
                        <i class="fa fa-home"></i> Dashboard
                    </a>
                </li>
            </ul>
        </div>
        <div class="block" x-show="tabid==2">
        </div>
        <div class="block" x-show="tabid==3">
        </div>
        <div class="block" x-show="tabid==4">
            <ul class="tab-list">
                <li class="tab-item">
                    <a href="{{ route('create-charge') }}">
                        <i class="fa fa-money-bill-wave"></i> {{ __('Charges') }}
                    </a>
                </li>
            </ul>
        </div>
        <div class="block" x-show="tabid==5">
            <ul class="tab-list">
                <li class="tab-item">
                    <a href="{{ route('create-demande-achat') }}">
                        <i class="fa fa-file-invoice-dollar"></i> {{ __('Demande Achat') }}
                    </a>
                </li>
                <li class="tab-item">
                    <a href="{{ route('create-bon-commande') }}">
                        <i class="fa fa-clipboard-list"></i> {{ __('Bon de commande') }}
                    </a>
                </li>
                <li class="tab-item">
                    <a href="{{ route('create-bon-achat') }}">
                        <i class="fa fa-receipt"></i> {{ __('Bon réception') }}
                    </a>
                </li>
                <li class="tab-item">
                    <a href="{{ route('create-reglement-fournisseur') }}">
                        <i class="fa fa-clipboard-check"></i> {{ __('Règlement') }}
                    </a>
                </li>
            </ul>
        </div>
        <div class="block" x-show="tabid==6">
            <ul class="tab-list">
                <li class="tab-item">
                    <a href="{{ route('stock') }}">
                        <i class="fa fa-chart-line"></i> {{ __('Etat du stock') }}
                    </a>
                </li>
            </ul>
        </div>
        <div class="block" x-show="tabid==7">
            <ul class="tab-list">
                <li class="tab-item">
                    <a href="{{ route('create-devis') }}">
                        <i class="fa fa-money-check"></i> {{ __('Devis') }}
                    </a>
                </li>
                <li class="tab-item">
                    <a href="{{ route('create-bon-livraison') }}">
                        <i class="fa fa-truck-loading"></i> {{ __('Bon de livraison') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav> --}}
