<div id="quick-actions"
    @class([
    'mx-2 bg-white shadow-sm rounded-xl px-2 py-2 border mt-5', 
    'expend-footer' => true
    ])>
    <div class="flex min-w-0 flex-row items-center gap-x-1 break-words">
        <div class="w-75">
            <a href="{{ route('filament.admin.resources.quick-actions.quick-action-setting') }}" class="inline-block w-full px-2 py-2 mb-0 font-bold text-white text-center text-black uppercase transition-all ease-in bg-white border-0 border-white rounded-lg shadow-soft-md bg-150 leading-pro text-xs hover:shadow-soft-2xl hover:scale-102" style="background: #334d76;">
                <div class="flex flex-row justify-center items-center gap-x-1">
                    <div>
                        <x-dynamic-component :component="'heroicon-o-cog'" class="fi-sidebar-item-icon h-4 w-4 text-white dark:text-gray-500" />
                    </div>
                    <div>
                        {{ __('Manage') }}
                    </div>
                </div>
            </a>
        </div>
        <div class="w-25">
            <button wire:click="$dispatch('maximized')" id="maximized-sidebar-menu" class="flex flex-row justify-center items-center inline-block w-full px-2 py-2 mb-0 font-bold text-white text-center text-black uppercase transition-all ease-in bg-white border-0 border-white rounded-lg shadow-soft-md bg-150 leading-pro text-xs hover:shadow-soft-2xl hover:scale-102" style="background-color: #2980b9;">
                <x-dynamic-component :component="'heroicon-o-arrow-top-right-on-square'" class="fi-sidebar-item-icon h-4 w-4 text-white dark:text-gray-500" />
            </button>
        </div>
        <div class="w-25">
            <button id="close-sidebar" class="flex flex-row justify-center items-center inline-block w-full px-2 py-2 mb-0 font-bold text-white text-center text-black uppercase transition-all ease-in bg-white border-0 border-white rounded-lg shadow-soft-md bg-150 leading-pro text-xs hover:shadow-soft-2xl hover:scale-102" style="background-color: #e74c3c;">
                <x-dynamic-component :component="'heroicon-o-x-mark'" class="fi-sidebar-item-icon h-4 w-4 text-white dark:text-gray-500" />
            </button>
        </div>
    </div>
    <style>
    .expend-footer {
        position: fixed;
        right: 15px;
        bottom: 15px;
    }
    </style>
</div>

<!-- JavaScript for right-click, search, and sidebar toggle -->
<script>
    document.addEventListener('livewire:init', () => {
        var isSidebarMenuOpened = localStorage.getItem("isSidebarMenuOpened");
        var isMaximized = localStorage.getItem("isMaximized");
        
        const quickActions = document.getElementById('quick-actions');
        
        quickActions.style.display = isMaximized === 'true' ? 'none' : 'block';

        const sidebarMenu = document.getElementById('sidebar-menu');
        
        const closeSidebarBtn = document.getElementById('close-sidebar');

        closeSidebarBtn.addEventListener('click', function() {
            localStorage.removeItem("isSidebarMenuOpened");
            localStorage.removeItem("isMaximized");
            localStorage.removeItem("posX");
            localStorage.removeItem("posY");
            sidebarMenu.style.display = 'none';
            removeBodyStyles();
        });
        
        const maximizedSidebarMenu = document.getElementById('maximized-sidebar-menu');

        maximizedSidebarMenu.addEventListener('click', function() {
            localStorage.setItem('isMaximized',!isMaximized);
            //sidebarMenu.style.display = !isMaximized === 'false' ? 'none' : 'block';
            quickActions.style.display = 'none';
        });

        Livewire.on('minimized', () => {
            // Retrieve current maximized state from localStorage, defaulting to false if not set
            const minimized = localStorage.getItem("isMaximized") !== 'true'; // Convert to boolean

            // Show or hide the sidebar menu based on the new state
            quickActions.style.display = minimized ? 'block' : 'none';
        });
    });
</script>