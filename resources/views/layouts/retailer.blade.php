<!DOCTYPE html>
<html lang="en">

<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
   
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
    <div class="bg-primary">
    <nav class="navbar navbar-expand-lg navbar-light container">
        <a class="navbar-brand dashboard-logo text-white font-weight-700" href="{{ route('retailer.dashboard') }}"> <img src=" {{ asset('shop_retailer/img/dashboard.png') }}" alt=""> <span>Dashboard</span> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            </ul>
            <div ng-app="demoApp" class="ng-app">
            <div class="wrapper" ng-controller="demoController">
            <div class="nav-bar">
                <ul>
                    <li>
                        <div class="dropdowns-wrapper pb-0">
                        <div class="dropdown-container">
                            <div class="notifications dropdown dd-trigger" ng-click="showNotifications($event)">
                            <span class="count animated" id="notifications-count">5  </span>
                        <span class="text-white far fa-bell"></span>
                            </div>
                            <div class="dropdown-menu animated" id="notification-dropdown">
                            <div class="dropdown-header">
                                <span class="triangle"></span>
                                <span class="heading">Notifications</span>
                                <span class="count" id="dd-notifications-count">23</span>
                            </div>
                            <div class="dropdown-body">
                                <div class="notification new" ng-repeat="notification in newNotifications.slice().reverse() track by notification.timestamp">
                                <div class="notification-image-wrapper">
                                    <div class="notification-image">
                                        <img src="https://imagemoved.files.wordpress.com/2011/07/no-strings-attached-natalie-portman-19128381-850-1280.jpg" alt="" width="32">
                                    </div>
                                </div>
                                <div class="notification-text">
                                    <span class="highlight">Kashmala Ali</span> 
                                    
                                </div>
                                </div>
                                <div class="notification" ng-repeat="notification in readNotifications.slice().reverse() track by $index">
                                <div class="notification-image-wrapper">
                                    <div class="notification-image">
                                        <img src="https://imagemoved.files.wordpress.com/2011/07/no-strings-attached-natalie-portman-19128381-850-1280.jpg" alt="" width="32">
                                    </div>
                                </div>
                                <div class="notification-text">
                                    <span class="highlight">Azaz Mushtaq</span> 
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    
                        </div>
                    </li>
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 text-white small">
                                    Logged in as Admin 
                            </span>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="http://127.0.0.1:8000/profile">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>  Profile
                            </a>      
                            <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="http://127.0.0.1:8000/logout" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            <form id="logout-form" action="http://127.0.0.1:8000/logout" method="POST" class="d-none">
                                <input type="hidden" name="_token" value="aVz8kpVcDw9TMWqUKgPphNSmd4NurOxfZBfqXGcO">                
                            </form>
                        </div>
                    </li>
                    <li class="searchbox-wrapper">
                        <div class="search-box">
                        <span class="fa fa-search search-icon"></span>
                        <input type="text" placeholder="Ticket no." />
                        </div>
                    </li>
                </ul>  
            </div>
            </div>
        </div>
    </nav>
    </div>    
    
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebard_dashboard sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <!-- <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('retailer.dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i> </div>
                <div class="sidebar-brand-text mx-3">Mobile Shop <sup>Pos</sup></div>
            </a> -->

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePhones"
                    aria-expanded="true" aria-controls="collapsePhones">
                    <img src="{{ asset('shop_retailer/img/ticket.png') }}" alt="missing img">
                    <span>Tickets</span>
                </a>
                <div id="collapsePhones" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-1 collapse-inner rounded">
                        <h6 class="collapse-header">Item Components:</h6>
                        <a class="collapse-item text-white" href="{{ route('ticket.index') }}">Tickets</a>
                        <a class="collapse-item text-white" href="http://127.0.0.1:8000/tickets/new_tickets">New Tickets</a>
                    </div>
                </div>
            </li> -->

            <li class="nav-item">
                <a class="nav-link" href="{{ route('retailer.dashboard') }}">
                    <img src="{{ asset('shop_retailer/img/dashboard.png') }}" alt="missing img">
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('ticket.index') }}">
                    <img src="{{ asset('shop_retailer/img/ticket.png') }}" alt="missing img">
                    <span>Tickets</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://127.0.0.1:8000/tickets/new_tickets">
                    <img src="{{ asset('shop_retailer/img/newticket.png') }}" alt="missing img">    
                    <span>New Tickets</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link " href="{{ route('pos.index') }}" 
                    aria-expanded="true" aria-controls="collapseTickets">
                    <img src="{{ asset('shop_retailer/img/app.png') }}" alt="missing img">
                    <span>Appointments </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('retailer.pos_data') }}" 
                    aria-expanded="true" aria-controls="collapseTickets">
                    <img src="{{ asset('shop_retailer/img/pos.png') }}" alt="missing img">
                    <span>POS </span>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link " href="{{ route('retailer.buy_sell') }}" 
                    aria-expanded="true" aria-controls="collapseTickets">
                    <i class="fas fa-fw fa-cog"></i><span>Buy and Sell </span>
                </a>
            </li>
             -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#buysell"
                    aria-expanded="true" aria-controls="buysell">
                    <img src="{{ asset('shop_retailer/img/buy.png') }}" alt="missing img">
                    <span>Buy and Sell </span>
                </a>
                <div id="buysell" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-1 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Item Components:</h6> -->
                        <a class="collapse-item text-white" href="{{ route('retailer.buy_sell') }}">Buy and Sell </a>
                        <a class="collapse-item text-white" href="{{ route('retailer.buy_trade') }}">Buy and Trade </a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('retailer.notes') }}">
                    <img src="{{ asset('shop_retailer/img/notes.png') }}" alt="missing img">
                    <span>Notes</span>
                </a>
            </li> 
            <li class="nav-item">
                <a class="nav-link " href="{{ route('customers.index') }}" 
                aria-expanded="true" aria-controls="collapseTickets">
                <img src="{{ asset('shop_retailer/img/customer.png') }}" alt="missing img">
                <span>Customers</span>
            </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pos.index') }}">
                 <img src="{{ asset('shop_retailer/img/transaction.png') }}" alt="missing img">
                    <span>Transactions</span>
                </a>
            </li> 
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pos.index') }}">
                 <img src="{{ asset('shop_retailer/img/inventory.png') }}" alt="missing img">
                    <span>Invoices</span>
                </a>
            </li> 
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
            <li class="nav-item d-none">
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

            
            <li class="nav-item  d-none">
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
            <li class="nav-item d-none">
                <a class="nav-link " href="{{ route('qrcode.generate') }}" 
                aria-expanded="true" aria-controls="collapseTickets">
                <i class="fas fa-fw fa-cog"></i>
                <span>QrCode</span>
            </a>
            </li>

            <li class="nav-item d-none">
                <a class="nav-link " href="{{ route('device_issues') }}" 
                aria-expanded="true" aria-controls="collapseTickets">
                <i class="fas fa-fw fa-cog"></i>
                <span>Device Issues</span>
            </a>
            </li>

            
            <li class="nav-item d-none">
                <a class="nav-link " href="{{ route('subscriptionPlans.show') }}" 
                aria-expanded="true" aria-controls="collapseTickets">
                <i class="fas fa-fw fa-cog"></i>
                <span>Subscription Plans</span>
            </a>
            </li>
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
            <li class="nav-item d-none">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseItems"
                    aria-expanded="true" aria-controls="collapseItems">
                    <img src="{{ asset('shop_retailer/img/inventory.png') }}" alt="missing img">
                    <span>Inventory</span>
                </a>
                <div id="collapseItems" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Item </h6>
                        <a class="collapse-item" href="{{ route('items.index') }}">Items</a>
                        <a class="collapse-item" href="{{ route('categories.index') }}">Categories</a>
                        <a class="collapse-item" href="{{ route('manufacturers.index') }}">Manufacturers</a>

                    </div>
                </div>
         
            </li>
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
                    <div class="w-95">
                        @yield('content')
                    </div>

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
            <div class="bg-primary text-white p-3">
                <div class="w-90">
                    <div class="row">
                        <div class="text-left col-md-9">Techbuff.com</div>
                        <div class="text-right col-md-3">Send Feedback</div>
                    </div>
                </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.0-beta.1/angular.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.0-beta.1/angular-animate.js"></script>
<script>
    var app = angular.module('demoApp', ['ngAnimate']);

    app.controller('demoController', function($scope){
	var opendd;
	var storedNewNotifications;
	var storedReadNotifications;
	var storedawaitingNotifications;
	var init = function(){
		storedNewNotifications = JSON.parse(localStorage.getItem('newNotifications'));
		storedReadNotifications = JSON.parse(localStorage.getItem('readNotifications'));
		storedawaitingNotifications = JSON.parse(localStorage.getItem('awaitingNotifications'));
		if(storedNewNotifications == null){
			$scope.newNotifications = [
				{
					user: pollingData.users[1],
					action: pollingData.actions[0],
					target: pollingData.actionTargets[2],
					timestamp: new Date()
				}
			];
		}
		else{
			$scope.newNotifications = storedNewNotifications;
		}
		if(storedReadNotifications == null){
			$scope.readNotifications = [
				{
					user: pollingData.users[2],
					action: pollingData.actions[1],
					target: pollingData.actionTargets[0],
					timestamp: new Date()
				}
			];
		}
		else{
			$scope.readNotifications = storedReadNotifications;
		}
		if(storedawaitingNotifications == null)
			$scope.awaitingNotifications = 1;
		else{
			$scope.awaitingNotifications = storedawaitingNotifications;
			if($scope.awaitingNotifications == 0)
				angular.element('#notifications-count').hide();
		}
		$scope.showNotifications = function($event){
			var targetdd = angular.element($event.target).closest('.dropdown-container').find('.dropdown-menu');
			opendd = targetdd;
		    if(targetdd.hasClass('fadeInDown')){
		    	hidedd(targetdd);
		    }
		    else{
		    	targetdd.css('display', 'block').removeClass('fadeOutUp').addClass('fadeInDown')
		    									.on('animationend webkitAnimationEnd oanimationend MSAnimationEnd', function(){
	  												angular.element(this).show();
	  											});
          targetdd.find('.dropdown-body')[0].scrollTop = 0;
		    	$scope.awaitingNotifications = 0;
		      	angular.element('#notifications-count').removeClass('fadeIn').addClass('fadeOut');
		    }
		};

		//show notifications count if new notifications are received
		setInterval(function(){
			if($scope.awaitingNotifications > 0 && opendd == null && (angular.element('#notifications-count').css('opacity') == '0' || angular.element('#notifications-count').is(':hidden')))
    			angular.element('#notifications-count').removeClass('fadeOut').addClass('fadeIn').show();
		}, 400);
		dummyPolling();
	}

	//Hide dropdown function
	var hidedd = function(targetdd){
		targetdd.removeClass('fadeInDown').addClass('fadeOutUp')
										  .on('animationend webkitAnimationEnd oanimationend MSAnimationEnd', function(){
  												angular.element(this).hide();
  											});
    	opendd = null;
    	$scope.awaitingNotifications = 0;
    	angular.forEach($scope.newNotifications, function(notification){
    		$scope.readNotifications.push(notification);
    	});
    	$scope.newNotifications = [];
    	localStorage.setItem('readNotifications', JSON.stringify($scope.readNotifications));
    	localStorage.setItem('newNotifications', JSON.stringify($scope.newNotifications));
		localStorage.setItem('awaitingNotifications', JSON.stringify($scope.awaitingNotifications));
    	if($scope.awaitingNotifications > 0)
    		angular.element('#notifications-count').removeClass('fadeOut').addClass('fadeIn');
	}

	//New notification is created by selecting random user, action and targets from this object
	var pollingData = {
	    users : [
		    {
		        name: "Fauzan Khan",
		        imageUrl: "https://media.licdn.com/mpr/mpr/shrinknp_400_400/AAEAAQAAAAAAAANfAAAAJDE1MzNiYjM1LWVjYzUtNDcwZi1hMmExLTQ5ZDVjYzViMDkzYQ.jpg"
		    },
		    {
		        name: "Keanu Reeves",
		        imageUrl: "http://www.latimes.com/includes/projects/hollywood/portraits/keanu_reeves.jpg"
		    },
		    {
		        name: "Natalie Portman",
		        imageUrl: "https://imagemoved.files.wordpress.com/2011/07/no-strings-attached-natalie-portman-19128381-850-1280.jpg"
		    }
	    ],
	    actions: ["upvoted", "promoted", "shared"],
  	    actionTargets: ["your answer", "your post", "your question"]
	};

	//generates a random number between 0 and 2 to select random polling data
	var getRandomNumber = function(){
	    return Math.floor(Math.random() * 3);
	};

	//creates and returns a new notification
	var getNewNotification = function(){
		var userIndex = getRandomNumber();
		var actionIndex = getRandomNumber();
		var actionTargetIndex = getRandomNumber();
		var newNotification = {
			user: pollingData.users[userIndex],
			action: pollingData.actions[actionIndex],
			target: pollingData.actionTargets[actionTargetIndex],
			timestamp: new Date()
		}
		return newNotification;
	};

	//This function calls itslef after random interval
	var dummyPolling = function(){
		var randomInterval = 2*Math.round(Math.random() * (3000 - 500)) + 1000;
		setTimeout(function() {
			$scope.$apply(function(){
				$scope.newNotifications.push(getNewNotification());
				$scope.awaitingNotifications++;
				localStorage.setItem('newNotifications', JSON.stringify($scope.newNotifications));
				localStorage.setItem('awaitingNotifications', JSON.stringify($scope.awaitingNotifications));
			});
			console.log("dummy poll called after "+randomInterval+"ms");
            dummyPolling();  
    	}, randomInterval);
	}

	window.onclick = function(event){
		var clickedElement = angular.element(event.target);
		var clickedDdTrigger = clickedElement.closest('.dd-trigger').length;
		var clickedDdContainer = clickedElement.closest('.dropdown-menu').length;
		if(opendd != null && clickedDdTrigger == 0 && clickedDdContainer == 0){
			hidedd(opendd);
		}
	}
  
  window.onbeforeunload = function(e) {
	  if(opendd != null){
      console.log('closingdd');
      hidedd(opendd); 
    }
	};

	init();
  })
</script>
@stack('js')

</body>

</html>