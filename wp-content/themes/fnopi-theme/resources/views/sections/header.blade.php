<header id="fnopi-banner" class="banner sticky z-40 top-[-180px] md:top-[-140px] bg-fnopi-background">
    
    <div class="px-6 lg:px-[60px] 2xl:px-[120px] bg-fnopi-background relative z-40" id="sticky-not-scroll">
        <div class="flex flex-col md:flex-row items-center gap-6 justify-center py-[35px] md:py-[50px] md:pb-0">
            <div class="relative md:hidden">
                <button id="header-mobile-nav-btn" class="hamburger hamburger--collapse mb-0" type="button" aria-label="Open the menu">
                    <span class="hamburger-box">
                        <span class="hamburger-inner mb-0"></span>
                    </span>
                </button>
            </div>
            <a href="{{home_url()}}/">
                <img src="{{asset('/images/main-logo.svg')}}" alt="{{$siteName}}">
            </a>
        </div>

        <div class="hidden md:flex overflow-hidden alignwide border-y border-y-fnopi-gray mx-auto mt-[25px] pt-[15px] pb-[15px]  justify-between items-center">
            <div id="logo-scroll">
                <a href="{{home_url()}}/">
                    <img class="w-[150px] h-auto" src="{{asset('/images/main-logo-min.svg')}}" alt="{{$siteName}}">
                </a>
            </div>
            {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => '', 'echo' => false]) !!}
            <div class="w-[150px] hidden xl:block"></div>
            {{-- <button type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="31.595" height="31.603" viewBox="0 0 31.595 31.603"><path d="M35.724,33.808l-8.787-8.87a12.523,12.523,0,1,0-1.9,1.925l8.73,8.812a1.352,1.352,0,0,0,1.909.049A1.361,1.361,0,0,0,35.724,33.808ZM17.1,26.971a9.888,9.888,0,1,1,6.994-2.9A9.827,9.827,0,0,1,17.1,26.971Z" transform="translate(-4.5 -4.493)" fill="#b3c8cd"/></svg>
            </button> --}}
        </div>
    </div>

    <div class="bg-fnopi-background py-4 px-6 border-b border-b-fnopi-gray md:hidden" id="mobile-sticky">
        <div class="flex justify-between items-center">
            <a href="{{home_url()}}/">
                <img class="w-[150px] h-auto" src="{{asset('/images/main-logo-min.svg')}}" alt="{{$siteName}}">
            </a>
            <button id="header-mobile-nav-btn-sticky" class="hamburger hamburger--collapse mb-0" type="button" aria-label="Open the menu">
                <span class="hamburger-box">
                    <span class="hamburger-inner mb-0"></span>
                </span>
            </button>
        </div>
    </div>

    <div id="mobile-drawer">
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'mobile-nav', 'echo' => false]) !!}
    </div>
</header>
