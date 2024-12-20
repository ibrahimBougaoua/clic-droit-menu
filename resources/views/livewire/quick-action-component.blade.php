<nav id="sidebar-menu" class="fi-sidebar-nav bg-white shadow-sm rounded-lg flex-grow flex flex-col gap-y-7 overflow-y-auto overflow-x-hidden px-2 py-2 hidden border z-50" style="max-width: 250px; width: 250px;">
    @if($setting && $setting->header_status)
        <div class="mx-2 bg-white">
            <div class="flex min-w-0 flex-col items-center break-words rounded-lg shadow mb-2" style="background-color: {{ $setting->header_back_color }};">
                <div class="relative z-20 flex-auto w-full p-2 text-left">
                    <div class="transition-all duration-200 ease-nav-brand text-white">
                        <h6 class="mb-0" style="text-align: center;margin-bottom: 10px;">{{ $setting->header_label }}</h6>
                        <a href="{{ $setting->header_url }}" class="inline-block w-full px-8 py-2 mb-0 font-bold text-center text-black uppercase transition-all ease-in bg-white border-0 border-white rounded-lg shadow-soft-md bg-150 leading-pro text-xs hover:shadow-soft-2xl hover:scale-102" style="background: {{ $setting->header_btn_color }};">
                            <div class="flex flex-row justify-center items-center gap-x-3">
                                <div>
                                    <x-dynamic-component :component="$setting->header_icon" class="fi-sidebar-item-icon h-5 w-5 text-white dark:text-gray-500" />
                                </div>
                                <div>
                                    {{ $setting->header_label }}
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($setting && $setting->search_status)
        <div class="mb-2">
            <input type="search" id="menu-search" placeholder="Search..." class="w-full px-2 py-1 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-600">
        </div>
    @endif
    
    <hr class="w-full mb-2" />
    <ul class="fi-sidebar-nav-groups flex flex-col gap-y-7" id="menu-list">
        @foreach($menus as $key => $menu)
            @if(count($menu->children)==0)
                <li x-data="{ label: '{{ $menu->label }}' }" data-group-label="{{ $menu->label }}" class="menu-item fi-sidebar-group flex flex-col gap-y-1">
                    <ul class="fi-sidebar-group-items flex flex-col gap-y-1">
                        <li class="fi-sidebar-item">
                            <a
                                href="/{{ $menu->url }}"
                                x-on:click="window.matchMedia(`(max-width: 1024px)`).matches &amp;&amp; $store.sidebar.close()"
                                class="fi-sidebar-item-button relative flex items-center justify-center gap-x-3 rounded-lg px-2 py-2 outline-none transition duration-75 hover:bg-gray-100 focus-visible:bg-gray-100 dark:hover:bg-white/5 dark:focus-visible:bg-white/5"
                            >
                                <x-dynamic-component :component="$menu->icon" class="fi-sidebar-item-icon h-6 w-6 text-gray-400 dark:text-gray-500" />
                                <span class="search-menu fi-sidebar-item-label flex-1 truncate text-sm font-medium text-gray-700 dark:text-gray-200">
                                    {{ $menu->label }}
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
            @else
                <li x-data="{ label: '{{ $menu->label }}', key : {{ $key }} }" data-group-label="{{ $key }}" class="menu-item fi-sidebar-group flex flex-col gap-y-1">
                    <div x-on:click="$store.sidebar.toggleCollapsedGroup(key)" class="fi-sidebar-group-button flex items-center gap-x-3 px-2 py-2 cursor-pointer">
                        <span class="search-menu fi-sidebar-group-label flex-1 text-sm font-medium leading-6 text-gray-500 dark:text-gray-400">
                            {{ $menu->label }}
                        </span>
                        <button class="fi-icon-btn relative flex items-center justify-center rounded-lg outline-none transition duration-75 focus-visible:ring-2 -m-2 h-9 w-9 text-gray-400 hover:text-gray-500 focus-visible:ring-primary-600 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:ring-primary-500 fi-color-gray fi-sidebar-group-collapse-button"
                            type="button"
                            x-bind:aria-expanded="! $store.sidebar.groupIsCollapsed(key)"
                            x-on:click.stop="$store.sidebar.toggleCollapsedGroup(key)"
                            x-bind:class="{ '-rotate-180': $store.sidebar.groupIsCollapsed(key) }"
                            aria-expanded="true">
                            <x-dynamic-component :component="$menu->icon" class="fi-sidebar-item-icon h-6 w-6 text-gray-400 dark:text-gray-500" />
                        </button>
                    </div>
                    <ul x-show="! $store.sidebar.groupIsCollapsed(key)" x-collapse.duration.200ms="" class="fi-sidebar-group-items flex flex-col gap-y-1">
                        @foreach($menu->children as $submenu)
                            <li class="submenu-item fi-sidebar-item">
                                <a href="{{ $submenu->url }}"
                                x-on:click="window.matchMedia(`(max-width: 1024px)`).matches && $store.sidebar.close()"
                                class="fi-sidebar-item-button relative flex items-center justify-center gap-x-3 rounded-lg px-2 py-2 outline-none transition duration-75 hover:bg-gray-100 focus-visible:bg-gray-100 dark:hover:bg-white/5 dark:focus-visible:bg-white/5">
                                    <x-dynamic-component :component="$submenu->icon" class="fi-sidebar-item-icon h-6 w-6 text-gray-400 dark:text-gray-500" />
                                    <span class="search-menu fi-sidebar-item-label flex-1 truncate text-sm font-medium text-gray-700 dark:text-gray-200">
                                        {{ $submenu->label }}
                                    </span>
                                    <span>
                                        <span
                                            style="--c-50: var(--success-50); --c-400: var(--success-400); --c-600: var(--success-600);"
                                            class="fi-badge flex items-center justify-center gap-x-1 rounded-md text-xs font-medium ring-1 ring-inset px-2 min-w-[theme(spacing.6)] py-1 fi-color-custom bg-custom-50 text-custom-600 ring-custom-600/10 dark:bg-custom-400/10 dark:text-custom-400 dark:ring-custom-400/30 fi-color-success"
                                        >
                                            <span class="grid">
                                                <span class="truncate">
                                                    9
                                                </span>
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
        @endforeach
    </ul>

    @if($setting)
        <div class="mx-2 bg-white no-found" style="display: none;">
            <div class="flex min-w-0 flex-col items-center break-words rounded-lg shadow mb-2" style="background-color: #334d76;">
                <div class="mb-7.5 h-full w-full rounded-2xl bg-cover bg-center" style="background-image: url('../assets/img/curved-images/white-curved.jpeg')"></div>
                <div class="relative z-20 flex-auto w-full p-4 text-left">
                    <div class="transition-all duration-200 ease-nav-brand text-white">
                        <h6 class="mb-0" style="text-align: center;margin-bottom: 10px;">{{ __('No data found') }}</h6>
                        <a href="{{ route('filament.admin.resources.quick-actions.create') }}" class="inline-block w-full px-8 py-2 mb-0 font-bold text-center text-black uppercase transition-all ease-in bg-white border-0 border-white rounded-lg shadow-soft-md bg-150 leading-pro text-xs hover:shadow-soft-2xl hover:scale-102" style="background: #19a5a1;">
                            {{ __('New Quick Action') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($setting && $setting->footer_status)
        <hr class="w-full my-2" />
        <div class="mx-2">
            <div class="flex min-w-0 flex-row items-center gap-x-1 break-words">
                <div class="w-75">
                    <a href="{{ route('filament.admin.resources.quick-actions.quick-action-setting') }}" class="inline-block w-full px-2 py-2 mb-0 font-bold text-white text-center text-black uppercase transition-all ease-in bg-white border-0 border-white rounded-lg shadow-soft-md bg-150 leading-pro text-xs hover:shadow-soft-2xl hover:scale-102" style="background: {{ $setting->footer_btn_color }};">
                        <div class="flex flex-row justify-center items-center gap-x-1">
                            <div>
                                <x-dynamic-component :component="$setting->footer_icon" class="fi-sidebar-item-icon h-4 w-4 text-white dark:text-gray-500" />
                            </div>
                            <div>
                                {{ $setting->footer_label }}
                            </div>
                        </div>
                    </a>
                </div>
                <div class="w-25">
                    <button id="move-sidebar-menu" class="flex flex-row justify-center items-center inline-block w-full px-2 py-2 mb-0 font-bold text-white text-center text-black uppercase transition-all ease-in bg-white border-0 border-white rounded-lg shadow-soft-md bg-150 leading-pro text-xs hover:shadow-soft-2xl hover:scale-102" style="background-color: #16a085;">
                        <x-dynamic-component :component="'heroicon-o-arrows-pointing-out'" class="fi-sidebar-item-icon h-4 w-4 text-white dark:text-gray-500" />
                    </button>
                </div>
                <div class="w-25">
                    <button wire:click="$dispatch('minimized')" id="minimized-sidebar-menu" class="flex flex-row justify-center items-center inline-block w-full px-2 py-2 mb-0 font-bold text-white text-center text-black uppercase transition-all ease-in bg-white border-0 border-white rounded-lg shadow-soft-md bg-150 leading-pro text-xs hover:shadow-soft-2xl hover:scale-102" style="background-color: #2980b9;">
                        <x-dynamic-component :component="'heroicon-o-arrow-top-right-on-square'" class="fi-sidebar-item-icon h-4 w-4 text-white dark:text-gray-500" />
                    </button>
                </div>
                <div class="w-25">
                    <button id="close-sidebar" class="flex flex-row justify-center items-center inline-block w-full px-2 py-2 mb-0 font-bold text-white text-center text-black uppercase transition-all ease-in bg-white border-0 border-white rounded-lg shadow-soft-md bg-150 leading-pro text-xs hover:shadow-soft-2xl hover:scale-102" style="background-color: #e74c3c;">
                        <x-dynamic-component :component="'heroicon-o-x-mark'" class="fi-sidebar-item-icon h-4 w-4 text-white dark:text-gray-500" />
                    </button>
                </div>
            </div>
        </div>
    @endif
</nav>

<script>
    document.addEventListener('livewire:init', () => {
        var isSidebarMenuOpened = localStorage.getItem("isSidebarMenuOpened");

        var isMaximized = localStorage.getItem("isMaximized");

        if (isMaximized === null) {
            isMaximized = true;
            localStorage.setItem("isMaximized", true);
        } else {
            isMaximized = (isMaximized === 'true');
        }

        const sidebarMenu = document.getElementById('sidebar-menu');
        const searchInput = document.getElementById('menu-search');
        const menuItems = document.querySelectorAll('.menu-item');
        const submenuItems = document.querySelectorAll('.submenu-item');
        
        console.log(isSidebarMenuOpened);
        
        if(isSidebarMenuOpened && isMaximized)
        {
            var localStoragePosX = localStorage.getItem("posX");
            var localStoragePosY = localStorage.getItem("posY");

            displaySidebarMenu(false,localStoragePosX,localStoragePosY);
            console.log(isSidebarMenuOpened);
        }

        searchInput.addEventListener('input', function () {
            const searchTerm = searchInput.value.toLowerCase();
            const noFound = document.querySelector('.no-found');
            let globalMatchFound = false;

            menuItems.forEach(item => {
                const label = item.querySelector('.search-menu')?.textContent.toLowerCase() || '';
                let matchFound = false;

                if (label.includes(searchTerm)) {
                    item.style.display = 'block';
                    matchFound = true;
                    globalMatchFound = true;
                } else {
                    item.style.display = 'none';
                }

                const submenus = item.querySelectorAll('.fi-sidebar-group-items .fi-sidebar-item');
                submenus.forEach(submenu => {
                    const submenuLabel = submenu.querySelector('.search-menu')?.textContent.toLowerCase() || '';
                    if (submenuLabel.includes(searchTerm)) {
                        submenu.style.display = 'block';
                        item.style.display = 'block';
                        matchFound = true;
                        globalMatchFound = true;
                    } else {
                        submenu.style.display = 'none';
                    }
                });

                if (!matchFound) {
                    item.style.display = 'none';
                }
            });

            noFound.style.display = globalMatchFound ? 'none' : 'block';
        });

        document.addEventListener('keydown', function (e) {
            if (e.ctrlKey && e.shiftKey) {
                sidebarMenu.style.display = sidebarMenu.style.display === 'block' ? 'none' : 'block';
            }
        });

        document.querySelector('.fi-layout').addEventListener('contextmenu', function (e) {
            //if(!isSidebarMenuOpened)
            //{
                e.preventDefault();

                localStorage.setItem("isSidebarMenuOpened", true);
                localStorage.setItem('isMaximized',true);

                //applyBodyStyles();
                displaySidebarMenu(e);
            //}
        });

        function displaySidebarMenu(e,localStoragePosX = 0,localStoragePosY = 0)
        {
            const sidebarWidth = sidebarMenu.offsetWidth;
            const sidebarHeight = sidebarMenu.offsetHeight;
            const windowWidth = window.innerWidth;
            const windowHeight = window.innerHeight;

            let posX = e ? e.pageX : localStoragePosX;
            let posY = e ? e.pageY : localStoragePosY;

            localStorage.setItem("posX", posX);
            localStorage.setItem("posY", posY);

            if(e)
            {
                if (posX + sidebarWidth > windowWidth) {
                    posX = windowWidth - sidebarWidth - 10;
                }
                if (posY + sidebarHeight > windowHeight) {
                    posY = windowHeight - sidebarHeight - 10;
                }
            }

            sidebarMenu.style.display = 'block';
            sidebarMenu.style.position = 'fixed';
            sidebarMenu.style.left = `${posX}px`;
            sidebarMenu.style.top = `${posY}px`;
        }

        sidebarMenu.addEventListener('click', function (e) {
            e.stopPropagation();
        });

        function applyBodyStyles() {
            document.body.style.backgroundColor = '#334d76';
            document.body.style.opacity = '0.5';
            document.body.style.position = 'fixed';
            document.body.style.top = '0';
            document.body.style.left = '0';
            document.body.style.right = '0';
            document.body.style.bottom = '0';
        }

        function removeBodyStyles() {
            document.body.style.backgroundColor = '';
            document.body.style.opacity = '';
            document.body.style.position = '';
            document.body.style.top = '';
            document.body.style.left = '';
            document.body.style.right = '';
            document.body.style.bottom = '';
        }

        window.onload = addListeners();

        function addListeners(){
            document.getElementById('move-sidebar-menu').addEventListener('mousedown', mouseDown, false);
            window.addEventListener('mouseup', mouseUp, false);
        }

        function mouseUp()
        {
            window.removeEventListener('mousemove', divMove, true);
        }

        function mouseDown(e){
            window.addEventListener('mousemove', divMove, true);
        }

        function divMove(e){
            var div = document.getElementById('sidebar-menu');
            div.style.position = 'absolute';
            div.style.top = e.clientY + 'px';
            div.style.left = e.clientX + 'px';
            localStorage.setItem("posX", e.clientX);
            localStorage.setItem("posY", e.clientY);
        }
        
        const closeSidebarBtn = document.getElementById('close-sidebar');

        closeSidebarBtn.addEventListener('click', function() {
            localStorage.removeItem("isSidebarMenuOpened");
            localStorage.removeItem("isMaximized");
            localStorage.removeItem("posX");
            localStorage.removeItem("posY");
            sidebarMenu.style.display = 'none';
            removeBodyStyles();
        });
        
        const minimizedSidebarMenu = document.getElementById('minimized-sidebar-menu');

        minimizedSidebarMenu.addEventListener('click', function() {
            localStorage.setItem('isMaximized',false);
            sidebarMenu.style.display =  'none';
        });

        Livewire.on('maximized', () => {
            const maximized = localStorage.getItem("isMaximized") === 'true';
            const newMaximizedState = !maximized;
            localStorage.setItem('isMaximized', newMaximizedState);
            sidebarMenu.style.display = newMaximizedState ? 'block' : 'none';
        });
    });
</script>