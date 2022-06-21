<x-template>
    <x-sidebar />
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
             @yield('main-content')
        </div>
    </div>
</x-template>