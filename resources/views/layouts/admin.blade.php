<x-template>
<x-sidebar/>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

<x-navbar/>

            <!-- Begin Page Content -->
            <div class="container-fluid">

                @yield('main-content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->
    </x-template>
