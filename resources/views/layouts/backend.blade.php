<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>AdminLTE 3 | Advanced form elements</title>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('public/backend/plugins/fontawesome-free/css/all.min.css') }}">
<!-- daterange picker -->
<link rel="stylesheet" href="{{ asset('public/backend/plugins/daterangepicker/daterangepicker.css') }}">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ asset('public/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<!-- Bootstrap Color Picker -->
<link rel="stylesheet" href="{{ asset('public/backend/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('public/backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('public/backend/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<!-- Bootstrap4 Duallistbox -->
<link rel="stylesheet" href="{{ asset('public/backend/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
<!-- BS Stepper -->
<link rel="stylesheet" href="{{ asset('public/backend/plugins/bs-stepper/css/bs-stepper.min.css') }}">
<!-- dropzonejs -->
<link rel="stylesheet" href="{{ asset('public/backend/plugins/dropzone/min/dropzone.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('public/backend/dist/css/adminlte.min.css') }}">



<!-- jQuery -->
<script src="{{ asset('public/backend/plugins/jquery/jquery.min.js') }}"></script>
  
<script src="{{ asset('public/backend/custom/custom.js') }}"></script>


  <!-- start toast -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0- 
         alpha/css/bootstrap.css" rel="stylesheet">  
    <link rel="stylesheet" type="text/css" 
         href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> 
  <!-- end toast -->
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <style>
  
          .mandatory{ color: red; font-size: 12px }

            body {
                font-family: "Helvetica Neue", Arial, Helvetica, sans-serif;
            }

            a {
                color: #666;
            }

            #content {
                width: 65%;
                max-width: 690px;
                margin: 6% auto 0;
            }
            table {
              width: 100%;
              color: #555;
              font: 12px/15px "Helvetica Neue", Arial, Helvetica, sans-serif;
                overflow: hidden
                border: 1px solid #000;
                background: #fefefe;
                -moz-border-radius: 5px; /* FF1+ */
                -webkit-border-radius: 5px; /* Saf3-4 */
                border-radius: 5px;
                -moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
                -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
            }

            th, td {
                padding: 18px 28px 18px;
                text-align: center;
            }

            th {
                padding-top: 22px;
                text-shadow: 1px 1px 1px #fff;
                background: #95db95;
            }

            td {
                border-top: 1px solid #e0e0e0;
                border-right: 1px solid #e0e0e0;
            }

            tr.odd-row td {
                background: #f6f6f6;
            }

            td.first, th.first {
                text-align: left
            }

            td.last {
                border-right: none;
            }

            /*
            Background gradients are completely unnecessary but a neat effect.
            */

            td {
                background: -moz-linear-gradient(100% 25% 90deg, #fefefe, #f9f9f9);
                background: -webkit-gradient(linear, 0% 0%, 0% 25%, from(#f9f9f9), to(#fefefe));
            }

            tr.odd-row td {
                background: -moz-linear-gradient(100% 25% 90deg, #f6f6f6, #f1f1f1);
                background: -webkit-gradient(linear, 0% 0%, 0% 25%, from(#f1f1f1), to(#f6f6f6));
            }

            th {
                background: -moz-linear-gradient(100% 20% 90deg, #e8eaeb, #ededed);
                background: -webkit-gradient(linear, 0% 0%, 0% 20%, from(#b8e0b8), to(#95db95));
            }

            tr:first-child th.first {
                -moz-border-radius-topleft: 5px;
                -webkit-border-top-left-radius: 5px; /* Saf3-4 */
            }

            tr:first-child th.last {
                -moz-border-radius-topright: 5px;
                -webkit-border-top-right-radius: 5px; /* Saf3-4 */
            }

            tr:last-child td.first {
                -moz-border-radius-bottomleft: 5px;
                -webkit-border-bottom-left-radius: 5px; /* Saf3-4 */
            }

            tr:last-child td.last {
                -moz-border-radius-bottomright: 5px;
                -webkit-border-bottom-right-radius: 5px; /* Saf3-4 */
            }

          
          
            @media print {
              
              table {
              width: 100%;
              color: #555;
              font: 12px/15px "Helvetica Neue", Arial, Helvetica, sans-serif;
                overflow: hidden
                border: 1px solid #000;
                background: #fff;
                margin: 5% auto 0;
                -moz-border-radius: 5px; /* FF1+ */
                -webkit-border-radius: 5px; /* Saf3-4 */
                border-radius: 5px;
                -moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
                -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
            }

              .table td, .table th{
                padding: 0.5rem !important;
                border: 1px solid #000 !important;

              }

              .table-bordered td, .table-bordered th{
                border: 1px solid #000;
              }

              
              .main-footer{ display:none}
              .print-hide{ display:none}

            }


            .invalid-feedback{ display:block}

			.collapse{ display: block !important; font-size: 14px}

            .active {background : #529C52 !important; }
			
			.small-box{ height: 160px}
			
  </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
        
        <div id="myDiv">
            <div class="ajax-loader-img"></div>
        </div>

        <div class="wrapper">

          <!-- Preloader -->
          <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('public/backend/dist/img/logo.png')}}" alt="AdminLTELogo" height="60" width="60">
          </div>

          <!-- Navbar -->
          <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
              </li>
              <li class="nav-item d-none d-sm-inline-block">
                <a href="index3.html" class="nav-link">Home</a>
              </li>
              <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
              </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
              <!-- Navbar Search -->
              <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                  <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                  <form class="form-inline">
                    <div class="input-group input-group-sm">
                      <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                      <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                          <i class="fas fa-search"></i>
                        </button>
                        <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </li>

              <!-- Messages Dropdown Menu -->
              <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="far fa-comments"></i>
                  <span class="badge badge-danger navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"  style="max-height:400px;overflow-y: scroll;">
                  
                  
                  <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                      <img src="{{ asset('public/backend/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                      <div class="media-body">
                        <h3 class="dropdown-item-title">
                          Brad Diesel
                          <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                        </h3>
                        <p class="text-sm">Call me whenever you can...</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                      </div>
                    </div>
                    <!-- Message End -->
                  </a>
                  <div class="dropdown-divider"></div>


                  <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
              </li>
              <!-- Notifications Dropdown Menu -->
              <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="far fa-bell"></i>
                  <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <span class="dropdown-item dropdown-header">15 Notifications</span>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
              </li>


              <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="fa fa-power-off"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i>My Profile
                  </a>
                  <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item dropdown-footer"  href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fas fa-power-off mr-2"></i>Logout</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
              </li>

              <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                  <i class="fas fa-expand-arrows-alt"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                  <i class="fas fa-th-large"></i>
                </a>
              </li>
            </ul>
          </nav>
          <!-- /.navbar -->

          <!-- Main Sidebar Container -->
          <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="https://northbengaltech.com/" target="_blank" class="brand-link" style="background: #3C4D6E">
              <img src="{{ asset('public/backend/dist/img/logo.jpg')}}"  alt="Logo" class="" style="opacity: .8; width: 155px;margin-left:35px;opacity:0.9">
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
              
 

              <!-- Sidebar Menu -->
              <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
                       with font-awesome or any other icon font library -->
                  <li class="nav-item">
                    <a href="{{ url('home') }}" class="nav-link {{ request()->is('home*')  ? 'active' : '' }}">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>Dashboard</p>
                    </a>
                   
                  </li>

                  @can('role-list') 
                    <li class="nav-item">
                      <a href="{{ url('roles') }}" class="nav-link {{ request()->is('roles*')  ? 'active' : '' }}">
                        <i class="nav-icon fa fa-graduation-cap"></i>
                        <p>
                          Roles
                        </p>
                      </a>
                    </li>
                  @endcan

                 
                  @can('purchase-list') 
                  <li class="nav-item">
                    <a href="{{ url('pos') }}" class="nav-link {{ request()->is('pos*')  ? 'active' : '' }}">
                      <i class="nav-icon fa fa-user"></i>
                      <p>
                        POS
                      </p>
                    </a>
                  </li>
                  @endcan

                  @can('purchase-list') 
                  <li class="nav-item">
                    <a href="{{ url('purchases') }}" class="nav-link {{ request()->is('purchases*')  ? 'active' : '' }}">
                      <i class="nav-icon fa fa-user"></i>
                      <p>
                        Purchase
                      </p>
                    </a>
                  </li>
                  @endcan
                  

                  @can('user-list') 
                  <li class="nav-item">
                    <a href="{{ url('users') }}" class="nav-link {{ request()->is('users*')  ? 'active' : '' }}">
                      <i class="nav-icon fa fa-user"></i>
                      <p>
                        Users
                      </p>
                    </a>
                  </li>
                  @endcan


                  @can('product-list') 
                      <li class="nav-item">
                        <a href="{{ url('products') }}" class="nav-link {{ request()->is('products*')  ? 'active' : '' }}">
                          <i class="nav-icon fa fa-brush"></i>
                          <p>
                          Products
                          </p>
                        </a>
                      </li>
                  @endcan

                  @can('supplier-list') 
                      <li class="nav-item">
                        <a href="{{ url('suppliers') }}" class="nav-link {{ request()->is('suppliers*')  ? 'active' : '' }}">
                          <i class="nav-icon fa fa-brush"></i>
                          <p>
                            Supplier
                          </p>
                        </a>
                      </li>
                  @endcan


                  <li class="nav-item">
                    <a href="#" class="nav-link {{ ( request()->is('countries*') || request()->is('brands*') || request()->is('units*') || request()->is('sizes*') || request()->is('colors*') )  ? 'active' : '' }}">
                      <i class="nav-icon fas fa-wrench"></i>
                      <p>
                        Settings
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">

                    
                    @can('company-detail-list') 
                      <li class="nav-item">
                        <a href="{{ url('company-details') }}" class="nav-link {{ request()->is('company-details*')  ? 'active' : '' }}">
                          <i class="nav-icon fa fa-brush"></i>
                          <p>
                           Company Detail
                          </p>
                        </a>
                      </li>
                      @endcan 

                    @can('branch-list') 
                      <li class="nav-item">
                        <a href="{{ url('branches') }}" class="nav-link {{ request()->is('branches*')  ? 'active' : '' }}">
                          <i class="nav-icon fa fa-brush"></i>
                          <p>
                            Branch
                          </p>
                        </a>
                      </li>
                      @endcan 
                      
                    @can('product-category-list') 
                    <li class="nav-item">
                      <a href="{{ url('product-categories') }}" class="nav-link {{ request()->is('product-categories*')  ? 'active' : '' }}">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                          Product Category
                        </p>
                      </a>
                    </li>
                    @endcan

                    @can('country-list') 
                      <li class="nav-item">
                        <a href="{{ url('countries') }}" class="nav-link {{ request()->is('countries*')  ? 'active' : '' }}">
                          <i class="nav-icon fa fa-flag"></i>
                          <p>
                            Country
                          </p>
                        </a>
                      </li>
                      @endcan

                      @can('brand-list') 
                      <li class="nav-item">
                        <a href="{{ url('brands') }}" class="nav-link {{ request()->is('brands*')  ? 'active' : '' }}">
                          <i class="nav-icon fa fa-file"></i>
                          <p>
                            Brand
                          </p>
                        </a>
                      </li>
                      @endcan
                      

                      @can('unit-list') 
                      <li class="nav-item">
                        <a href="{{ url('units') }}" class="nav-link {{ request()->is('units*')  ? 'active' : '' }}">
                          <i class="nav-icon fa fa-balance-scale"></i>
                          <p>
                            Unit
                          </p>
                        </a>
                      </li>
                      @endcan

                      

                      

                      @can('size-list') 
                      <li class="nav-item">
                        <a href="{{ url('sizes') }}" class="nav-link {{ request()->is('sizes*')  ? 'active' : '' }}">
                          <i class="nav-icon fa fa-file"></i>
                          <p>
                            Size
                          </p>
                        </a>
                      </li>
                      @endcan


                      @can('color-list') 
                      <li class="nav-item">
                        <a href="{{ url('colors') }}" class="nav-link {{ request()->is('colors*')  ? 'active' : '' }}">
                          <i class="nav-icon fa fa-brush"></i>
                          <p>
                            Color
                          </p>
                        </a>
                      </li>
                      @endcan

                      
                      @can('customer-list') 
                      <li class="nav-item">
                        <a href="{{ url('customers') }}" class="nav-link {{ request()->is('customers*')  ? 'active' : '' }}">
                          <i class="nav-icon fa fa-brush"></i>
                          <p>
                            Customer
                          </p>
                        </a>
                      </li>
                      @endcan

                      &nbsp;&nbsp;

                    </ul>
                  </li>


                  
                  
                </ul>
              </nav>
              <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
          </aside>


              @yield('content')



            <footer class="main-footer">
                <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                  <b>Version</b> 3.1.0
                </div>
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
              <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
          </div>
          <!-- ./wrapper -->



        <!-- ./wrapper -->
<!-- Bootstrap 4 -->
<script src="{{ asset('public/backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('public/backend/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('public/backend/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('public/backend/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('public/backend/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('public/backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('public/backend/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('public/backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset('public/backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<!-- BS-Stepper -->
<script src="{{ asset('public/backend/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
<!-- dropzonejs -->
<script src="{{ asset('public/backend/plugins/dropzone/min/dropzone.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/backend/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('public/backend/dist/js/demo.js') }}"></script>
<!-- Page specific script -->
<script>
  //$("#product_top_cat_id").on("change", function () { debugger; });




  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End
</script>
</body>
</html>

<!-- start  active,inactive,delete Modal Center -->
<div class="modal fade" id="activeInactiveDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title  custom-modal-title" id="exampleModalLabel"></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                      
                    <div class="modal-body">
                       <p class="custom-modal-body"></p>
                       
                    </div>

                    {{-- {!! Form::open(array('method'=>'DELETE', 'id' => 'modal-form')) !!}
                    
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-success">Yes</button>
                    </div>
                    {!! Form::close() !!} --}}
                  </div>
                </div>
              </div>

        <!-- end  active,inactive,delete Modal Center -->


 <!-- start toast -->
 <script>

@if(Session::has('success'))

    toastr.options =
      {
        "closeButton" : true,
        "progressBar" : true
      }
    toastr.success("{{ session('success') }}");
    
@endif

@if(Session::has('error'))
    toastr.options =
    {
      "closeButton" : true,
      "progressBar" : true
    }
    toastr.error("{{ session('error') }}");
@endif


</script>
<!-- end toast -->
@if(request()->is('pos*'))
	<script type="text/javascript">
		$('[data-widget="pushmenu"]').PushMenu("collapse");
	</script>
@endif

<script type="text/javascript">
	
	$(".show-modal").click(function(){
			  
		  $("#activeInactiveDeleteModal").modal('show'); 

		  var valueId = $(this).attr('value-id');
		  var title = $(this).attr('value-title');
		  var message = $(this).attr('message');
		  var method = $(this).attr('method');
		  var action = $(this).attr('action');
		  
		  $(".custom-modal-title").html(title);
		  $('.custom-modal-body').html(message);
		  
		  $('#modal-form').attr('method', method);
		  var APP_URL = {!! json_encode(url('/')) !!}
		  $('#modal-form').attr('action', APP_URL +'/'+ action +'/'+ +valueId);   
	  });
</script>


@if( request()->is('home') )
      <script>
        

        var person = '';
        var token = '';
        var url = '';

          $(document).on('click', '.chat-select', function() {   

              person = $(this).attr('chat-select-id');
              
              $('.btn-msg-send').attr('btn-recevier-id', person);
              
              $('.direct-chat-messages').html('');

              //alert(person);
              token = "{{ csrf_token() }}";

              url = "{{url('get-indivisual-msg') }}/"+person;
              //alert(url);

              getChatDataByIndivisual( url, token);
             
          });

          window.setInterval(function(){
            
            getChatDataByIndivisual( url, token);

          }, 5000);


          // send message
          $(document).on('click', '.btn-msg-send', function() {   
            
            var url = "{{url('conversations') }}";
            var token = "{{ csrf_token() }}";
            var senderId = $('.btn-msg-send').attr('btn-recevier-id');
           

            $('.direct-chat-messages').html('');
            var urlGet = "{{url('get-indivisual-msg') }}/"+senderId;

            sendMessage( url, token, senderId, urlGet );
            

          });
    </script>
  @endif