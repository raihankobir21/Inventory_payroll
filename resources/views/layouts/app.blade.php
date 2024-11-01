<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel 8 User Roles and Permissions Tutorial') }}</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>


    <!-- Scripts -->
        <!-- start toast -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-
         alpha/css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css"
            href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <!-- end toast -->


    <!-- Fonts -->

    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Styles -->

    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">

    <style>
        .toast-success{ background: #38c172}
        .toast-error{ background: red}
		.invalid-feedback{display:block !important}
		.highlight{color: #828200; font-size: 12px }
    </style>

</head>

<body>

    <div id="app">

        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">

            <div class="container">

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

                    <span class="navbar-toggler-icon"></span>

                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto"></ul>

                    <!-- Right Side Of Navbar -->

                    <ul class="navbar-nav ml-auto">

                        <!-- Authentication Links -->

                        @guest

                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>

                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>

                        @else


							<li class="nav-item dropdown">
								<div class="dropdown">
									<button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
									Reports <span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="{{route('today-attendance-reports')}}">Today Attendance</a></li>
										<li><a class="dropdown-item" href="{{route('date-wise-attendance-reports')}}">Date Wise Attendance</a></li>
										<li><a class="dropdown-item" href="{{route('employee_expenses.today')}}">Today Expenses</a></li>
										<li><a class="dropdown-item" href="{{route('employee_expenses.datewise')}}">Date Wise Expenses</a></li>
                                        {{-- <li><a class="dropdown-item" href="{{ route('reports.monthly_salary') }}">Monthly Salary Report</a></li> --}}
                                        <li><a class="dropdown-item" href="{{ route('reports.monthlysalary') }}">Monthly Salary Report</a></li>
									</ul>
								</div>
                            </li>
                            <li class="nav-item dropdown">
								<div class="dropdown">
									<button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
									Account <span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<li><a class="nav-link" href="{{ url('company-remain-balance') }}"> Current Balance</a></li>


									</ul>
								</div>
                            </li>
                            <li class="nav-item dropdown">
								<div class="dropdown">
									<button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
									Income <span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<li><a class="nav-link" href="{{ route('capitals.index') }}"> Capital</a></li>
										 <li><a class="nav-link" href="{{ route('incomes.index') }}">Advance/Income</a></li>

									</ul>
								</div>
                            </li>

							 <li class="nav-item dropdown">
								<div class="dropdown">
									<button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
									Expense <span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<li><a class="nav-link" href="{{ route('employee-advance-payments.index') }}"> Advance Payment</a></li>

										{{--<li><a class="nav-link" href="{{ url('employee-salary-advance-payments') }}"> Advance Salary</a></li>--}}

										<li><a class="nav-link" href="{{ route('employee_expenses.index') }}">Employee Expense</a></li>

										<li><a class="nav-link" href="{{ url('salary') }}"> Salary</a></li>

									</ul>
								</div>
                            </li>

                            <li class="nav-item dropdown">
								<div class="dropdown">
									<button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
									Attendance <span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="{{route('attendances.index')}}">In</a></li>
										<li><a class="dropdown-item" href="{{route('exits.index')}}">Exit</a></li>
									</ul>
								</div>
                            </li>




                            <li class="nav-item dropdown">
								<div class="dropdown">
									<button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
									Setting <span class="caret"></span>
									</button>

                                    <ul class="dropdown-menu">
                                        <li><a class="nav-link" href="{{ route('roles.index') }}"> Role</a></li>
                                        <li><a class="nav-link" href="{{ route('users.index') }}"> Employees</a></li>


                                        <li><a class="nav-link" href="{{ route('salary-categories.index') }}">Salary Category</a></li>
                                        <li><a class="nav-link" href="{{ route('banks.index') }}">Banks</a></li>
                                        <li><a class="nav-link" href="{{ route('companies.index') }}">Companies</a></li>
                                        <li><a class="nav-link" href="{{ route('projects.index') }}">Projects</a></li>
                                        <li><a class="nav-link" href="{{ route('off-days.index') }}">Off Days</a></li>
                                        <li><a class="nav-link" href="{{ route('leave-days.index') }}">Leave Days</a></li>


                                    </ul>

								</div>
                            </li>




                            <li class="nav-item dropdown">
                            <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                {{--<li><a class="dropdown-item" href="#">Another action</a></li>--}}
                                <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"

                                onclick="event.preventDefault();

                                document.getElementById('logout-form').submit();">

                                {{ __('Logout') }}

                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

                                @csrf

                                </form>
                                </li>
                            </ul>
                            </div>
                            </li>

                        @endguest

                    </ul>

                </div>

            </div>

        </nav>


        <main class="py-4">

            <div class="container">

            @yield('content')

            </div>

        </main>

    </div>


</body>

</html>

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

