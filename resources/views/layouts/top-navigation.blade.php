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
						aria-expanded="false"> <i class="fa fa-envelope-o"></i> <span
						class="badge bg-green">6</span>
					</a>
					<ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
						@foreach(session('notifications') as $count => $notification)
							@if($count < 6 )
								<li><a href="#notification-{{$count}}"> <span class="image notification-icon"><i class="fa fa-@if($notification['type'] == 'HIRING')users @elseif($notification['type'] == 'CALENDAR')calendar @elseif($notification['type'] == 'GENERAL')exclamation @endif"></i></span> <span> <span>{{$notification['title']}}</span>
								</span> <span class="message notification-body" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{$notification['content']}}hasjhsahsa  sajh asjh ashj  hsja hA Y WYW WHYAS HSA A J  hs j ash sa asu asuw wh wha jas hsa as </span>
								</a></li>
							@endif
						@endforeach
						
						<li>
							<div class="text-center">
								<a> <strong>See All Alerts</strong> <i
									class="fa fa-angle-right"></i>
								</a>
							</div>
						</li>
					</ul></li>
			</ul>
		</nav>
	</div>
</div>