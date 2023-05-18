<!DOCTYPE html>
<html lang="en">
    
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

    @include('layouts.auth-script')
    <body class="main-body  app sidebar-mini">
        
        <!-- Loader -->
        <div id="global-loader">
            <img src="{{url('backend/img/loaders/loader-4.svg')}}" class="loader-img" alt="Loader">
        </div>
        <!-- /Loader -->

        <!-- main-sidebar opened -->
        <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
             @include('layouts.auth-sidebar')
        <!-- /main-sidebar -->
        <!-- main-content -->
        
        <div class="main-content">
             @include('layouts.auth-header')
            <div class="container-fluid">
                @include('layouts.breadcrumb')
                <div class="main-content-body">

            	{{ $slot }}
                
            </div>
            </div>
        </div>
       
        @include('layouts.auth-footer')
             
        
    </body>

</html>
