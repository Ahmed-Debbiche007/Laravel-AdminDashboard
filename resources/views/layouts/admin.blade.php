<x-template>
    <x-sidebar />
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <x-navbar />
            <div class="container-fluid">

                @yield('main-content')

            </div>
        </div>
    </div>
</x-template>