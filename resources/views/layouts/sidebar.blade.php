<div class="navbar nav_title" style="border: 0;">
	<a href="{{route('home')}}" class="site_title"><i class="fa fa-paw"></i>
		<span>{{env('APP_NAME')}}</span></a>
</div>

<div class="clearfix"></div>

<!-- menu profile quick info -->
<div class="profile clearfix">
	<div class="profile_pic">
		<img src="{{ asset('images/male-user.png') }}" alt="profile-image" class="img-circle profile_img">
	</div>
	<div class="profile_info">
		<span>Welcome,</span>
		<h2>{{ session('admin.name') . ' ' . session('admin.lastname')}}</h2>
	</div>
</div>
<!-- /menu profile quick info -->

<br />

<!-- sidebar menu -->
<div id="sidebar-menu"
	class="main_menu_side hidden-print main_menu">
	<div class="menu_section">
		<h3>General</h3>
		<ul class="nav side-menu">
			<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Dashboard</a></li>
			@if(session('admin.isSuperAdmin'))
			<li><a><i class="fa fa-edit"></i> Super administrador <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="{{route('admin-users')}}">Usuarios administradores</a></li>
					<li><a href="{{route('users')}}">Candidatos</a></li>
				</ul>
			</li>
			@endif
			
			<li>
				<a href="{{route('companies')}}"><i class="fa fa-desktop"></i> Startup</a>
			</li>
			
			<li>
				<a href="{{route('offers')}}"><i class="fa fa-table"></i> Ofertas</a>
			</li>
			
			<li>
				<a href="{{route('candidates')}}"><i class="fa fa-group"></i> Candidates Database</a>
			</li>
		</ul>
	</div>
	
</div>
<!-- /sidebar menu -->

<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small">
	<a data-toggle="tooltip" data-placement="top" title="Settings"> <span
		class="glyphicon glyphicon-cog" aria-hidden="true"></span>
	</a> <a data-toggle="tooltip" data-placement="top"
		title="FullScreen"> <span class="glyphicon glyphicon-fullscreen"
		aria-hidden="true"></span>
	</a> <a data-toggle="tooltip" data-placement="top" title="Lock"> <span
		class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
	</a> <a data-toggle="tooltip" data-placement="top" title="Logout"
		href="{{route('logout')}}"> <span class="glyphicon glyphicon-off"
		aria-hidden="true"></span>
	</a>
</div>
<!-- /menu footer buttons -->
