<div class="top_nav">
	<div class="nav_menu">
		<nav>
			<div class="nav toggle">
				<a id="menu_toggle"><i class="fa fa-bars"></i></a>
			</div>

			<ul class="nav navbar-nav navbar-right">
				<li class="">
					<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<img src="{{ asset('images/male-user.png') }}" alt="">
						{{ session('admin.name') . ' ' . session('admin.lastname')}}
						<span class=" fa fa-angle-down"></span>
					</a>
					<ul class="dropdown-menu dropdown-usermenu pull-right">
						<li><a href="{{route('profile')}}"> Profile</a></li>
						<li><a href="{{route('help')}}">Help</a></li>
						<li><a href="{{route('logout')}}"><i class="fa fa-sign-out pull-right"></i>
								Log Out</a></li>
					</ul></li>
					<li role="presentation" class="dropdown"><a href="javascript:;"
						class="dropdown-toggle info-number" data-toggle="dropdown"
						aria-expanded="false"> <i class="fa fa-envelope-o"></i> @if(session('activeNotificationsCount') > 1) <span
						class="badge bg-green">{{session('activeNotificationsCount')}}</span> @endif
					</a>
					<ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
						@foreach(session('notifications') as $count => $notification)
							@if($count <= 6 )
								<li><a  class="@if($notification['status'] == 'ACTIVE')bold @endif" href="{{route('notifications/details',$notification['id'])}}"> <span class="image notification-icon"><i class="fa fa-@if($notification['type'] == 'HIRING')users @elseif($notification['type'] == 'CALENDAR')calendar @elseif($notification['type'] == 'GENERAL')exclamation @endif"></i></span> <span> <span>{{$notification['title']}}</span>
								</span> <span class="message notification-body truncate-text">{{$notification['content']}} </span>
								</a></li>
								
							@endif
						@endforeach
						
						<li>
							<div class="text-center">
							<a href="{{route('notifications')}}"> <strong>Ver todas las notificaciones</strong> <i
									class="fa fa-angle-right"></i>
								</a>
							</div>
						</li>
					</ul></li>
			</ul>
		</nav>
	</div>
</div>

