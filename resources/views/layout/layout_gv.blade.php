<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="{{asset('img/favicon.ico')}}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>BKACAD BOOKS MANAGER</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet" />

    <!--  Light Bootstrap Dashboard core CSS    -->
    <link href="{{asset('css/light-bootstrap-dashboard.css')}}" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{asset('css/demo.css')}}" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="{{asset('css/pe-icon-7-stroke.css')}}" rel="stylesheet" />
	@stack('css')
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="orange" data-image="{{asset('img/do_an2-3.jpg')}}">
        <!--

            Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
            Tip 2: you can also add an image using data-image tag

        -->

        <div class="logo">
            <a href="http://www.creative-tim.com" class="simple-text logo-mini">
                MANAGER
            </a>

			<a href="http://www.creative-tim.com" class="simple-text logo-normal">
				BKACAD BOOKS 
			</a>
        </div>

    	<div class="sidebar-wrapper">
            <div class="user">
				<div class="info">
					<div class="photo">
						@php
							$anh = Session::get('anh');
						@endphp
	                    <img src="{{asset("uploads/image/$anh")}}" />
	                </div>

					<a data-toggle="collapse" href="#collapseExample" class="collapsed">
						<span>
							{{Session::get('ten_gv')}}
	                        <b class="caret"></b>
						</span>
                    </a>

					<div class="collapse" id="collapseExample">
						<ul class="nav">
							<li>
								<a href="{{ route('giao_vu.edit_profile') }}">
									<span class="sidebar-mini">EP</span>
									<span class="sidebar-normal">Edit Profile</span>
								</a>
							</li>

							<li>
								<a href="{{ route('giao_vu.update_password') }}">
									<span class="sidebar-mini">UP</span>
									<span class="sidebar-normal">Update password</span>
								</a>
							</li>
						</ul>
                    </div>
				</div>
            </div>

			<ul class="nav">
				<li class="active">
					<a href="{{ route('thong_ke.view_thong_ke') }}">
						<i class="pe-7s-graph"></i>
						<p>Statistics</p>
					</a>
				</li>
				<li>
					<a href="{{ route('giao_vu.view_all') }}">
                        <i class="pe-7s-users"></i>
                        <p>Admin
                        </p>
                    </a>
				</li>
				<li>
					<a data-toggle="collapse" href="#formsKhoa">
                        <i class="pe-7s-note2"></i>
                        <p>Course
                           <b class="caret"></b>
                        </p>
                    </a>
					<div class="collapse" id="formsKhoa">
						<ul class="nav">
							<li>
								<a href="{{ route('khoa.view_all') }}">
									<span class="sidebar-mini">List</span>
									<span class="sidebar-normal">Course</span>
								</a>
							</li>
							<li>
								<a href="{{ route('khoa.view_insert') }}">
									<span class="sidebar-mini">Add</span>
									<span class="sidebar-normal">Course</span>
								</a>
							</li>
						</ul>
					</div>
				</li>
				<li>
					<a data-toggle="collapse" href="#formsNganh">
                        <i class="pe-7s-graph"></i>
                        <p>Major
                           <b class="caret"></b>
                        </p>
                    </a>
					<div class="collapse" id="formsNganh">
						<ul class="nav">
							<li>
								<a href="{{ route('nganh.view_all') }}">
									<span class="sidebar-mini">List</span>
									<span class="sidebar-normal">Majors</span>
								</a>
							</li>
							<li>
								<a href="{{ route('nganh.view_insert') }}">
									<span class="sidebar-mini">Add</span>
									<span class="sidebar-normal">Major</span>
								</a>
							</li>
						</ul>
					</div>
				</li>
				<li>
					<a data-toggle="collapse" href="#formsLop">
                        <i class="pe-7s-diskette"></i>
                        <p>Class 
                           <b class="caret"></b>
                        </p>
                    </a>
					<div class="collapse" id="formsLop">
						<ul class="nav">
							<li>
								<a href="{{ route('lop.view_all') }}">
									<span class="sidebar-mini">List</span>
									<span class="sidebar-normal">Class</span>
								</a>
							</li>
							<li>
								<a href="{{ route('lop.view_insert') }}">
									<span class="sidebar-mini">Add</span>
									<span class="sidebar-normal">Class</span>
								</a>
							</li>
						</ul>
					</div>
				</li>
				<li>
					<a data-toggle="collapse" href="#formsSV">
                        <i class="pe-7s-study"></i>
                        <p>Student
                           <b class="caret"></b>
                        </p>
                    </a>
					<div class="collapse" id="formsSV">
						<ul class="nav">
							<li>
								<a href="{{ route('sinh_vien.view_all') }}">
									<span class="sidebar-mini">List</span>
									<span class="sidebar-normal">Students</span>
								</a>
							</li>
							<li>
								<a href="{{ route('sinh_vien.view_insert') }}">
									<span class="sidebar-mini">Add</span>
									<span class="sidebar-normal">Studentsn</span>
								</a>
							</li>
							<li>
								<a href="{{ route('sinh_vien.view_insert_excel') }}">
									<span class="sidebar-mini">Add</span>
									<span class="sidebar-normal">Students excel</span>
								</a>
							</li>
						</ul>
					</div>
				</li>
				<li>
					<a data-toggle="collapse" href="#formsMH">
                        <i class="pe-7s-news-paper"></i>
                        <p>Subject 
                           <b class="caret"></b>
                        </p>
                    </a>
					<div class="collapse" id="formsMH">
						<ul class="nav">
							<li>
								<a href="{{ route('mon.view_all') }}">
									<span class="sidebar-mini">List</span>
									<span class="sidebar-normal">Subjects</span>
								</a>
							</li>
							<li>
								<a href="{{ route('mon.view_insert') }}">
									<span class="sidebar-mini">Add</span>
									<span class="sidebar-normal">Subjects</span>
								</a>
							</li>
						</ul>
					</div>
				</li>
				<li>
					<a data-toggle="collapse" href="#formsSach">
                        <i class="pe-7s-bookmarks"></i>
                        <p>Book
                           <b class="caret"></b>
                        </p>
                    </a>
					<div class="collapse" id="formsSach">
						<ul class="nav">
							<li>
								<a href="{{ route('sach.view_all') }}">
									<span class="sidebar-mini">List</span>
									<span class="sidebar-normal">management</span>
								</a>
							</li>
							<li>
								<a href="{{ route('sach.view_insert') }}">
									<span class="sidebar-mini">Add</span>
									<span class="sidebar-normal">management</span>
								</a>
							</li>
						</ul>
					</div>
				</li>
				<li>
					<a href="{{ route('sach_ct.view_insert') }}">
                        <i class="pe-7s-server"></i>
                        <p>Book ditribution
                        </p>
                    </a>
				</li>
			</ul>
    	</div>
    </div>

    <div class="main-panel">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-minimize">
					<button id="minimizeSidebar" class="btn btn-warning btn-fill btn-round btn-icon">
						<i class="fa fa-ellipsis-v visible-on-sidebar-regular"></i>
						<i class="fa fa-navicon visible-on-sidebar-mini"></i>
					</button>
				</div>
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">BKACAD BOOKS MANAGER</a>
				</div>
				<div class="collapse navbar-collapse">

					<form class="navbar-form navbar-left navbar-search-form" role="search">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-search"></i></span>
							<input type="text" value="" class="form-control" placeholder="Search...">
						</div>
					</form>

					<ul class="nav navbar-nav navbar-right">
						<li>
							<a href="#">
								<i class="fa fa-line-chart"></i>
								<p>Stats</p>
							</a>
						</li>

						<!-- li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-gavel"></i>
								<p class="hidden-md hidden-lg">
									Actions
									<b class="caret"></b>
								</p>
							</a>
							<ul class="dropdown-menu">
								<li><a href="#">Create New Post</a></li>
								<li><a href="#">Manage Something</a></li>
								<li><a href="#">Do Nothing</a></li>
								<li><a href="#">Submit to live</a></li>
								<li class="divider"></li>
								<li><a href="#">Another Action</a></li>
							</ul>
						</li> -->

						<!-- <li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-bell-o"></i>
								<span class="notification">5</span>
								<p class="hidden-md hidden-lg">
									Notifications
									<b class="caret"></b>
								</p>
							</a>
							<ul class="dropdown-menu">
								<li><a href="#">Notification 1</a></li>
								<li><a href="#">Notification 2</a></li>
								<li><a href="#">Notification 3</a></li>
								<li><a href="#">Notification 4</a></li>
								<li><a href="#">Another notification</a></li>
							</ul>
						</li> -->

						<li class="dropdown dropdown-with-icons">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-list"></i>
								<p class="hidden-md hidden-lg">
									More
									<b class="caret"></b>
								</p>
							</a>
							<ul class="dropdown-menu dropdown-with-icons">
								{{-- <li>
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="fa fa-list"></i>
										<p class="hidden-md hidden-lg">
											More
											<b class="caret"></b>
										</p>
									</a>
									<a href="#">
										<i class="pe-7s-mail"></i> Messages
									</a>
								</li> --}}
								{{-- <li>
									<a href="#">
										<i class="pe-7s-help1"></i> Help Center
									</a>
								</li>
								<li>
									<a href="#">
										<i class="pe-7s-tools"></i> Settings
									</a>
								</li>
								<li class="divider"></li> --}}
								<li>
									<a href="{{ route('giao_vu.update_password') }}">
										<i class="pe-7s-lock"></i> Update password
									</a>
								</li>
								<li>
									<a href="{{ route('logout') }}" class="text-danger">
										<i class="pe-7s-close-circle"></i>
										Log out
									</a>
								</li>
							</ul>
						</li>

					</ul>
				</div>
			</div>
		</nav>

        <div class="main-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title"></h4>
                                <p class="category"></p>
                            </div>
                            <div class="content">
                            	@yield('content')
                                <!-- <div class="row">
                                    <div class="col-md-5">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="flag">
                                                                <img src="../assets/img/flags/US.png"
                                                            </div>
                                                        </td>
                                                        <td>USA</td>
                                                        <td class="text-right">
                                                            2.920
                                                        </td>
                                                        <td class="text-right">
                                                            53.23%
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="flag">
                                                                <img src="../assets/img/flags/DE.png"
                                                            </div>
                                                        </td>
                                                        <td>Germany</td>
                                                        <td class="text-right">
                                                            1.300
                                                        </td>
                                                        <td class="text-right">
                                                            20.43%
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="flag">
                                                                <img src="../assets/img/flags/AU.png"
                                                            </div>
                                                        </td>
                                                        <td>Australia</td>
                                                        <td class="text-right">
                                                            760
                                                        </td>
                                                        <td class="text-right">
                                                            10.35%
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="flag">
                                                                <img src="../assets/img/flags/GB.png"
                                                            </div>
                                                        </td>
                                                        <td>United Kingdom</td>
                                                        <td class="text-right">
                                                            690
                                                        </td>
                                                        <td class="text-right">
                                                            7.87%
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="flag">
                                                                <img src="../assets/img/flags/RO.png"
                                                            </div>
                                                        </td>
                                                        <td>Romania</td>
                                                        <td class="text-right">
                                                            600
                                                        </td>
                                                        <td class="text-right">
                                                            5.94%
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="flag">
                                                                <img src="../assets/img/flags/BR.png"
                                                            </div>
                                                        </td>
                                                        <td>Brasil</td>
                                                        <td class="text-right">
                                                            550
                                                        </td>
                                                        <td class="text-right">
                                                            4.34%
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-md-offset-1">
                                        <div id="worldMap" style="height: 300px;"></div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>



                {{-- <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Email Statistics</h4>
                                <p class="category">Last Campaign Performance</p>
                            </div>
                            <div class="content">
                                <div id="chartEmail" class="ct-chart "></div>
                            </div>
                            <div class="footer">
                                <div class="legend">
                                    <i class="fa fa-circle text-info"></i> Open
                                    <i class="fa fa-circle text-danger"></i> Bounce
                                    <i class="fa fa-circle text-warning"></i> Unsubscribe
                                </div>
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-clock-o"></i> Campaign sent 2 days ago
                                </div>
                            </div>

                        </div>
                    </div> --}}

                    {{-- <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Users Behavior</h4>
                                <p class="category">24 Hours performance</p>
                            </div>
                            <div class="content">
                                <div id="chartHours" class="ct-chart"></div>
                            </div>
                            <div class="footer">
                                <div class="legend">
                                    <i class="fa fa-circle text-info"></i> Open
                                    <i class="fa fa-circle text-danger"></i> Click
                                    <i class="fa fa-circle text-warning"></i> Click Second Time
                                </div>
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-history"></i> Updated 3 minutes ago
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>


{{-- 
                <div class="row">
                    <div class="col-md-6">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">2014 Sales</h4>
                                <p class="category">All products including Taxes</p>
                            </div>
                            <div class="content">
                                <div id="chartActivity" class="ct-chart"></div>
                            </div>
                            <div class="footer">
                                <div class="legend">
                                    <i class="fa fa-circle text-info"></i> Tesla Model S
                                    <i class="fa fa-circle text-danger"></i> BMW 5 Series
                                </div>
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-check"></i> Data information certified
                                </div>
                            </div>
                        </div>
                    </div> --}}
{{-- 
                    <div class="col-md-6">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Tasks</h4>
                                <p class="category">Backend development</p>
                            </div>
                            <div class="content">
                                <div class="table-full-width">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>
													<div class="checkbox">
						  							  	<input id="checkbox30" type="checkbox">
						  							  	<label for="checkbox30"></label>
						  						  	</div>
                                                </td>
                                                <td>Sign contract for "What are conference organizers afraid of?"</td>
                                                <td class="td-actions text-right">
                                                    <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
													<div class="checkbox">
						  							  	<input id="checkbox32" type="checkbox">
						  							  	<label for="checkbox32"></label>
						  						  	</div>
                                                </td>
                                                <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                                                <td class="td-actions text-right">
                                                    <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
													<div class="checkbox">
						  							  	<input id="checkbox33" type="checkbox">
						  							  	<label for="checkbox33"></label>
						  						  	</div>
                                                </td>
                                                <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
</td>
                                                <td class="td-actions text-right">
                                                    <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
													<div class="checkbox">
						  							  	<input id="checkbox35" type="checkbox" checked>
						  							  	<label for="checkbox35"></label>
						  						  	</div>
                                                </td>
                                                <td>Create 4 Invisible User Experiences you Never Knew About</td>
                                                <td class="td-actions text-right">
                                                    <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
													<div class="checkbox">
						  							  	<input id="checkbox38" type="checkbox">
						  							  	<label for="checkbox38"></label>
						  						  	</div>
                                                </td>
                                                <td>Read "Following makes Medium better"</td>
                                                <td class="td-actions text-right">
                                                    <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
													<div class="checkbox">
						  							  	<input id="checkbox40" type="checkbox" checked>
						  							  	<label for="checkbox40"></label>
						  						  	</div>
                                                </td>
                                                <td>Unfollow 5 enemies from twitter</td>
                                                <td class="td-actions text-right">
                                                    <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="footer">
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-history"></i> Updated 3 minutes ago
                                </div>
                            </div>

                        </div>
                    </div> --}}
                </div>



            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                               Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files  -->
    <script src="{{asset('js/jquery.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('js/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>

	<!--  Forms Validations Plugin -->
	<script src="{{asset('js/jquery.validate.min.js')}}"></script>

	<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
	<script src="{{asset('js/moment.min.js')}}"></script>

    <!--  Date Time Picker Plugin is included in this js file -->
    <script src="{{asset('js/bootstrap-datetimepicker.min.js')}}"></script>

	<!-- Sliders Plugin, full documentation here: https://refreshless.com/nouislider/ -->
	<script src="{{asset('js/nouislider.min.js')}}"></script>

    <!--  Select Picker Plugin -->
    <script src="{{asset('js/bootstrap-selectpicker.js')}}"></script>

	<!--  Checkbox, Radio, Switch and Tags Input Plugins -->
		<script src="{{asset('js/bootstrap-switch-tags.min.js')}}"></script>

	<!--  Charts Plugin -->
	<script src="{{asset('js/chartist.min.js')}}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{asset('js/bootstrap-notify.js')}}"></script>

    <!-- Sweet Alert 2 plugin -->
	<script src="{{asset('js/sweetalert2.js')}}"></script>

    <!-- Vector Map plugin -->
	<script src="{{asset('js/jquery-jvectormap.js')}}"></script>

    <!--  Google Maps Plugin    -->
    {{-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> --}}

	<!-- Wizard Plugin    -->
    <script src="{{asset('js/jquery.bootstrap.wizard.min.js')}}"></script>

	<!--  Bootstrap Table Plugin    -->
	<script src="{{asset('js/bootstrap-table.js')}}"></script>

	<!--  Plugin for DataTables.net  -->
	<script src="{{asset('js/jquery.datatables.js')}}"></script>

    <!--  Full Calendar Plugin    -->
    <script src="{{asset('js/fullcalendar.min.js')}}"></script>

    <!-- Light Bootstrap Dashboard Core javascript and methods -->
	<script src="{{asset('js/light-bootstrap-dashboard.js')}}"></script>

	<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
	{{-- <script src="{{asset('js/demo.js')}}"></script> --}}
	@stack('js')
</html>
