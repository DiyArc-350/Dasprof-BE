    <!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title> {{ $title }} | Admin Pages</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
       <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('/assets/admin/images/logo/favicon.ico') }}">
        
       @yield('styles') 

        <!-- Sweet Alert-->
        <link href="{{ asset('/assets/admin/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Css -->
        <link href="{{ asset('/assets/admin/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('/assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('/assets/admin/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

        <style>
            body::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5); /* Adjust the opacity and color as needed */
                z-index: 0; /* Ensure the overlay is on top of the background image */
            }
            body {
                /* Specify the background image URL */
                overflow-x: hidden;
    
                /* Set background size to cover the entire element */
                background-size: cover;
    
                /* Set background position to center */
                background-position: center;

                /* Set the background attachment to fixed */
                background-attachment: fixed;
    
                /* Set background repeat to no-repeat */
                background-repeat: no-repeat;
                /* Optionally, set a background color as a fallback */
                background-color: #51B307;
            }
        </style>
    </head>

    <body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

             @include('admin.partials.nav')

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                     <!-- yield content -->
                        @yield('content')
                </div>
                <!-- End Page-content -->

                
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © DHIYAH
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    PHP ARTISAN MIGRAIN
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->

        </div>
        

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        
        <!-- JAVASCRIPT -->
        
        <script src="{{ asset('/assets/admin/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('/assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('/assets/admin/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('/assets/admin/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('/assets/admin/libs/node-waves/waves.min.js') }}"></script>
        
       
        
        <!-- App js -->
        <script src="{{ asset('/assets/admin/js/pages/saas-dashboard.init.js') }}"></script>
        <script src="{{ asset('/assets/admin/js/app.js')}}"></script>
        @yield('extras')

        <!-- Datatable init js -->
        <script src="{{ asset('/assets/admin/js/pages/datatables.init.js') }}"></script>    
        <!-- Autodismiss alert -->
        <script type="text/javascript">
            let alert_list = document.querySelectorAll('.alert')
            alert_list.forEach(function(alert) {
                new bootstrap.Alert(alert);

                let alert_timeout = alert.getAttribute('data-timeout');
                setTimeout(() => {
                    bootstrap.Alert.getInstance(alert).close();
                }, +alert_timeout);
            });
        </script>
       
    </body>
</html>
