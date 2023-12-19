<!DOCTYPE html>
<html lang="en">

<head>

 @include('retailer.partials.head')
 <style>
    .alert {
    margin-bottom: 20px;
    padding: 15px;
    border: 1px solid transparent;
    border-radius: 4px;
}

.alert-success {
    color: #3c763d;
    background-color: #dff0d8;
    border-color: #d6e9c6;
}

.alert-danger {
    color: #a94442;
    background-color: #f2dede;
    border-color: #ebccd1;
}
.error-message {
    color: red;
}
 </style>
@stack('styles')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('retailer.dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Mobile Shop  
                    <sup>Pos</sup>
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('retailer.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ route('retailer.customers') }}">
                    <i> </i>
                    <span>Customers</span>
                </a>
            </li> --}}
            {{-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCustomer"
                    aria-expanded="true" aria-controls="collapseCustomer">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Customers</span>
                </a>
                <div id="collapseCustomer" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Customer Components:</h6>
                        <a class="collapse-item" href="{{ route('customer.create') }}">Add Customer</a>
                        <a class="collapse-item" href="{{ route("customers.index") }}">Customers</a>
                    </div>
                </div>
            </li> --}}

            <li class="nav-item">
                <a class="nav-link " href="{{ route('customers.index') }}" 
                aria-expanded="true" aria-controls="collapseTickets">
                <i class="fas fa-fw fa-cog"></i>
                <span>Customers</span>
            </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ route('retailer.walkin') }}">
                    <i> </i>
                    <span>WalkIn Customer</span>
                </a>
            </li> --}}
            {{-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseWalkIn"
                    aria-expanded="true" aria-controls="collapseWalkIn">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>WalkIn Customers</span>
                </a>
                <div id="collapseWalkIn" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">WalkIn Customer Components:</h6>
                        <a class="collapse-item" href="{{ route('walkInByRetailer.create') }}">WalkIn Customer</a>
                        {{-- <a class="collapse-item" href="#">WalkIn Customers</a> --}}
                    {{-- </div>
                </div>
            </li>  --}}
            <li class="nav-item">
                <a class="nav-link " href="{{ route('walkInByRetailer.create') }}" 
                aria-expanded="true" aria-controls="collapseTickets">
                <i class="fas fa-fw fa-cog"></i>
                <span>WalkIn Service detail </span>
            </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ route('retailer.items') }}">
                    <i> </i>
                    <span>Items</span>
                </a>
            </li> --}}

            
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePhones"
                    aria-expanded="true" aria-controls="collapsePhones">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Phones</span>
                </a>
                <div id="collapsePhones" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Item Components:</h6>
                        <a class="collapse-item" href="{{ route('phone_buy.create') }}">Phone Buy</a>
                        <a class="collapse-item" href="{{ route('retailer.phones') }}">Phone Sell</a>
                    </div>
                </div>
            </li>

            
            <li class="nav-item">
                <a class="nav-link " href="{{ url('/categories') }}" 
                aria-expanded="true" aria-controls="collapseTickets">
                <i class="fas fa-fw fa-cog"></i>
                <span>Categories</span>
            </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseItems"
                    aria-expanded="true" aria-controls="collapseItems">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Items</span>
                </a>
                <div id="collapseItems" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Item Components:</h6>
                        <a class="collapse-item" href="{{ route('item.create') }}">Add Item</a>
                        <a class="collapse-item" href="{{ route('items.index') }}">Items</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTickets"
                    aria-expanded="true" aria-controls="collapseTickets">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Tickets</span>
                </a>
                <div id="collapseTickets" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ticket Components:</h6>
                        {{-- <a class="collapse-item" href="#"></a> --}}
                        <a class="collapse-item" href="{{ route('ticket.index') }}">Tickets</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('qrcode.generate') }}" 
                aria-expanded="true" aria-controls="collapseTickets">
                <i class="fas fa-fw fa-cog"></i>
                <span>QrCode</span>
            </a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="{{ route('device_issues') }}" 
                aria-expanded="true" aria-controls="collapseTickets">
                <i class="fas fa-fw fa-cog"></i>
                <span>Device Issues</span>
            </a>
            </li>

            
            <li class="nav-item">
                <a class="nav-link " href="{{ route('subscriptionPlans.show') }}" 
                aria-expanded="true" aria-controls="collapseTickets">
                <i class="fas fa-fw fa-cog"></i>
                <span>Subscription Plans</span>
            </a>
            </li>

            <!-- Divider -->
            {{-- <hr class="sidebar-divider"> --}}

            <!-- Heading -->
            {{-- <div class="sidebar-heading">
                Interface
            </div> --}}

            <!-- Nav Item - Pages Collapse Menu -->
            {{-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Components</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                </div>
            </li> --}}

            <!-- Nav Item - Utilities Collapse Menu -->
            {{-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li> --}}

            <!-- Divider -->
            {{-- <hr class="sidebar-divider"> --}}

            <!-- Heading -->
            {{-- <div class="sidebar-heading">
                Addons
            </div> --}}

            <!-- Nav Item - Pages Collapse Menu -->
            {{-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li> --}}

            <!-- Nav Item - Charts -->
            {{-- <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li> --}}

            <!-- Nav Item - Tables -->
            {{-- <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li> --}}

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
            @include('retailer.partials.nav')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('retailer.partials.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

  @include('retailer.partials.scripts')
  <script>
       function readURL(input, previewId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById(previewId).src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
        // if (cameraPreview.srcObject) {
        //     cameraPreview.srcObject.getTracks().forEach(track => track.stop());
        // }
    
  </script>
  <script>
  document.addEventListener("DOMContentLoaded", function() {
        
        var countryCodeInput = document.getElementById('countryCode');

            Inputmask(countryCode + ' 9999 999999').mask(document.getElementById('mobilePhone'));

            Inputmask({
                mask: '+999',
                placeholder: '',
                definitions: {
                    '9': {
                        validator: '[0-9]',
                        cardinality: 1
                    }
                }
            }).mask(countryCodeInput);

         

            // Attach an event listener to update the mask when the country code changes
            countryCodeInput.addEventListener('input', function() {
                Inputmask(' 9999 999999').mask(document.getElementById(
                    'mobilePhone'));
            });

              
    })
  </script>
  <script>
    setInterval(function () {
        fetch('/refresh-csrf')
            .then(response => response.json())
            .then(data => {
                document.querySelector('meta[name="csrf-token"]').setAttribute('content', data.csrf_token);
            });
    }, 1800000); // Refresh every 30 minutes (adjust as needed)
</script>
@stack('js')
</body>

</html>