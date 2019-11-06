@extends('layouts.app') @section('content')
<div class="">
	<div class="clearfix"></div>

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>
					Alerts <small>List</small>
				</h2>
			
				<div class="clearfix"></div>
			</div>
            <div class="x_content">
                @if ($notifications)
                   
                    <table id="datatable-buttons"
					class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Content</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notifications as $notification)
                            <tr style="height:40px;" class="truncate-text @if($notification['status'] == 'ACTIVE')bold @endif">
                                <td>{{ $notification['title'] }}</td>
                                <td>{{\App\Enums\NotificationType::getFriendlyName($notification['type'])}}</td>
                                <td>{{ $notification['content'] }} </td>
                                <td>
                                    <a href="{{route('notifications/details', $notification['id'])}}" title="Details" class="icon-table"><i class="fa fa-search"></i></a>
                                    {{-- <i id="{{$notification['id']}}" title="Marcar como leído" class="icon-table eye"><i class="fa fa-eye"></i></i> --}}
                                    <a href="{{route('notifications/delete', $notification['id'])}}" title="Delete" class="icon-table"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>There are no alerts available.</p>
                @endif
            </div>
        </div>
    </div> 
</div>
    <!-- /page content -->
@endsection
@section('extended-css')
<!-- Datatables -->
<link
	href="{{asset('gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}"
	rel="stylesheet">
<link
	href="{{asset('gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}"
	rel="stylesheet">
<link
	href="{{asset('gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}"
	rel="stylesheet">
<link
	href="{{asset('gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}"
	rel="stylesheet">
<link
	href="{{asset('gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}"
	rel="stylesheet">
@endsection @section('extended-scripts')
<!-- Datatables -->
<script
	src="{{ asset('gentelella/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script
	src="{{ asset('gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script
	src="{{ asset('gentelella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script
	src="{{ asset('gentelella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
<script
	src="{{ asset('gentelella/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
<script
	src="{{ asset('gentelella/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script
	src="{{ asset('gentelella/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script
	src="{{ asset('gentelella/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
<script
	src="{{ asset('gentelella/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
<script
	src="{{ asset('gentelella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script
	src="{{ asset('gentelella/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
<script
	src="{{ asset('gentelella/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
<script src="{{ asset('gentelella/vendors/jszip/dist/jszip.min.js') }}"></script>
<script
	src="{{ asset('gentelella/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
<script
    src="{{ asset('gentelella/vendors/pdfmake/build/vfs_fonts.js') }}"></script>
    <script>
    //     $( document ).ready(function() {
    //         $('.eye').click(function(){
    //             let config = {
    //         'headers': { 
    //             'X-CSRFToken' : 'toooken',
    //             }
    //     };
    //     axios.post('/policies/store',JSON.stringify(data),config).then(response => {
    //         console.log(response.data.policy_id);
    //         $('#policy_id').val(response.data.policy_id);
    //         $('#policy_create_form').submit();
            
            
    //     }).catch(e => {
    //         console.log(e);
    //     });
    //         });
    // });
    </script>
@endsection
