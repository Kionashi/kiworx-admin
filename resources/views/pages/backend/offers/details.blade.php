@extends('layouts.app')
@section('section', $offer['job_title'])
@section('content')
<!-- page content -->
<div class="">
	<div class="clearfix"></div>

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

			<div class="x_title">
				<h2>
					<i class="fa fa-bars"></i> {{$offer['job_title']}}
				</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown" role="button" aria-expanded="false"><i
							class="fa fa-wrench"></i></a>
					</li>
					<li><a class="close-link"><i class="fa fa-close"></i></a></li>
				</ul>
				<div class="clearfix"></div>
			</div>
			
			<div class="x_content">
				<div class="" role="tabpanel" data-example-id="togglable-tabs">
					<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
						<li role="presentation" class="active"><a href="#tab_content1"
							id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Candidatos</a>
						</li>
						<li role="presentation" class=""><a href="#tab_content2"
							role="tab" id="profile-tab" data-toggle="tab"
							aria-expanded="false">Job</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div role="tabpanel" class="tab-pane fade active in"
							id="tab_content1" aria-labelledby="home-tab">
							<!-- top tiles -->
							<div class="row tile_count">
								@foreach($offer['phases'] as $interview)
								<a href="{{ route('offers/details', ['id' => $offer['id'], 'order' => $interview['order']]) }}">
								<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
									<span class="count_top"><i class="fa fa-user"></i> {{$interview['name']}}</span>
									<div class="count">{{count($interview['applyments'])}}</div>
									<span class="count_bottom">
										<a href="#" class="red">Rejected {{$interview['rejected']}}</a>
									</span>
								</div>
								</a>
								@endforeach
							</div>
							<!-- /top tiles -->
							
							<!-- applicant list -->
							@if (isset($applicants))
							<table id="datatable-buttons"
								class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Status</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach($applicants as $i => $applicant)
									<tr style="height: 40px;">
										<td><a href="{{route('users/details', $applicant['user']['id'])}}">{{ $applicant['user']['name'] }} {{ $applicant['user']['lastname'] }}</a></td>
										<td><a href="mailto:{{ $applicant['user']['email'] }}">{{ $applicant['user']['email'] }}</a></td>
										<td><a href="tel:{{ $applicant['user']['phone'] }}">{{ $applicant['user']['phone'] }}</a></td>
										<td>
											@if($applicant['status'] == 'PENDING')
												<button class="btn btn-warning btn-xs">Pending</button>
											@elseif($applicant['status'] == 'ACCEPTED')
												<button class="btn btn-success btn-xs">Accepted</button>
											@else
												<button class="btn btn-danger btn-xs">Rejected</button>
											@endif
										</td>
										<td>
											<form id="promoteForm-{{$i}}" action="{{ route('offers/promote') }}" method="post">
												@csrf
												<input type="hidden" name="applicantId" value="{{ $applicant['id'] }}">
												<input type="hidden" name="phase" value="{{ $currentPhase }}">
												<input type="hidden" name="offerId" value="{{ $offer['id'] }}">
												
											</form>
											<form id="rejectForm-{{$i}}" action="{{ route('offers/reject') }}" method="post">
												@csrf
												<input type="hidden" name="applicantId" value="{{ $applicant['id'] }}">
												<input type="hidden" name="phase" value="{{ $currentPhase }}">
												<input type="hidden" name="offerId" value="{{ $offer['id'] }}">
											</form>
											<a href="#" title="Details" class="icon-table"><i class="fa fa-search"></i></a>
											@if($applicant['status'] != 'ACCEPTED')
    											<span title="Accept" class="icon-table green" data-toggle="modal" data-target=".bs-accept-{{$i}}-modal-sm">
    												<i class="fa fas fa-check"></i>
    											</span>
											@endif
											@if($applicant['status'] == 'PENDING')
    											<span title="Reject" class="icon-table red" data-toggle="modal" data-target=".bs-reject-{{$i}}-modal-sm">
    												<i class="fa fas fa-times"></i>
    											</span>
											@endif
											<!-- CONFIRMATION ACCEPT MODAL -->
											<div class="modal fade bs-accept-{{$i}}-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
												<div class="modal-dialog modal-sm">
													<div class="modal-content">
														<div class="modal-body">
															<h4>Promote Candidate</h4>
															<p>Are you sure you want to promote this candidate to the next stage?</p>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
															<button type="button" class="btn btn-primary" onclick="$('#promoteForm-{{$i}}').submit();">Yes</button>
														</div>
													</div>
												</div>
											</div>
											
											<!-- CONFIRMATION REJECT MODAL -->
											<div class="modal fade bs-reject-{{$i}}-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
												<div class="modal-dialog modal-sm">
													<div class="modal-content">
														<div class="modal-body">
															<h4>Reject candidate</h4>
															<p>Are you sure you want to reject this candidate?</p>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
															<button type="button" class="btn btn-primary" onclick="$('#rejectForm-{{$i}}').submit();">Yes</button>
														</div>
													</div>
												</div>
											</div>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							@else
							<p>There are no applicants on this phase.</p>
							@endif
							<!-- /applicant list -->
						</div>
						<!-- OFFER DETAILS -->
						<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
							<form action="{{route('offers/store')}}"
            					class="form-horizontal form-label-left" method="post">
            					@csrf
            					<div class="form-group">
            						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="jobTitle">Position <span class="required">*</span></label>
            						<div class="col-md-6 col-sm-6 col-xs-12">
            							<input type="text" id="jobTitle" name="jobTitle" value="{{$offer['job_title']}}" disabled class="form-control col-md-7 col-xs-12">
            						</div>
            					</div>
            					<div class="form-group">
            						<label class="control-label col-md-3 col-sm-3 col-xs-12"
            							for="experience">Experience <span class="required">*</span>
            						</label>
            						<div class="col-md-6 col-sm-6 col-xs-12">
            							<input type="text" id="experience" name="experience" value="{{ \App\Enums\OfferExperience::getFriendlyName($offer['experience']) }}" disabled class="form-control col-md-7 col-xs-12">
            						</div>
            					</div>
            					<div class="form-group">
            						<label class="control-label col-md-3 col-sm-3 col-xs-12"
            							for="jobBrief">Job brief <span class="required">*</span>
            						</label>
            						<div class="col-md-6 col-sm-6 col-xs-12">
            							<textarea id="jobBrief" name="jobBrief" disabled class="form-control col-md-7 col-xs-12">{{$offer['job_brief']}}</textarea>
            						</div>
            					</div>
            					<div class="form-group">
            						<label class="control-label col-md-3 col-sm-3 col-xs-12"
            							for="salary">Salary text
            						</label>
            						<div class="col-md-6 col-sm-6 col-xs-12">
            							<input type="text" id="salary" name="salary" disabled value="{{$offer['salary']}}" class="form-control col-md-7 col-xs-12" />
            						</div>
            					</div>
            					<div class="form-group">
            						<label class="control-label col-md-3 col-sm-3 col-xs-12"
            							for="salaryMin">Salary min
            						</label>
            						<div class="col-md-6 col-sm-6 col-xs-12">
            							<input type="number" id="salaryMin" name="salaryMin" disabled value="{{$offer['salary_min']}}" class="form-control col-md-7 col-xs-12" />
            						</div>
            					</div>
            					<div class="form-group">
            						<label class="control-label col-md-3 col-sm-3 col-xs-12"
            							for="salaryMax">Salary max
            						</label>
            						<div class="col-md-6 col-sm-6 col-xs-12">
            							<input type="number" id="salaryMax" name="salaryMax" disabled value="{{$offer['salary_max']}}" class="form-control col-md-7 col-xs-12" />
            						</div>
            					</div>
            					<div class="form-group">
            						<label class="control-label col-md-3 col-sm-3 col-xs-12"
            							for="description">Description <span class="required">*</span>
            						</label>
            						<div class="col-md-6 col-sm-6 col-xs-12">
            							{!!$offer['description']!!}
            						</div>
            					</div>
            					<div class="form-group">
            						<label class="control-label col-md-3 col-sm-3 col-xs-12"
            							for="responsabilities">Responsabilities <span class="required">*</span>
            						</label>
            						<div class="col-md-6 col-sm-6 col-xs-12">
            							<div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor-one">
            								{!!$offer['responsibilities']!!}
            							</div>
            						</div>
            					</div>
            					<div class="form-group">
            						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="requirements">Requisitos <span class="required">*</span>
            						</label>
            						<div class="col-md-6 col-sm-6 col-xs-12">
            							{!!$offer['requirements']!!}
            						</div>
            					</div>
            					<div class="form-group">
            						<label class="control-label col-md-3 col-sm-3 col-xs-12"
            							for="contractType">Contract type  <span class="required">*</span>
            						</label>
            						<div class="col-md-6 col-sm-6 col-xs-12">
            							<input id="salaryMax" name="salaryMax" value="{{\App\Enums\OfferContractType::getFriendlyName($offer['contract_type'])}}" disabled class="form-control col-md-7 col-xs-12" />
            						</div>
            					</div>
            					
            					<div class="form-group">
            						
            						<label class="control-label col-md-3 col-sm-3 col-xs-12"
            							for="workingTime">Working days  <span class="required">*</span>
            						</label>
            						<div class="col-md-6 col-sm-6 col-xs-12">
            							<input type="text" id="experience" name="experience" value="{{ \App\Enums\OfferWorkingDays::getFriendlyName($offer['working_days']) }}" disabled class="form-control col-md-7 col-xs-12">
            						</div>
            					</div>
            					
            					<div class="form-group">
            						<label class="control-label col-md-3 col-sm-3 col-xs-12"
            							for="category">Category <span class="required">*</span>
            						</label>
            						<div class="col-md-6 col-sm-6 col-xs-12">
            							<input type="text" id="experience" name="experience" value="{{ \App\Enums\OfferCategory::getFriendlyName($offer['category']) }}" disabled class="form-control col-md-7 col-xs-12">
            						</div>
            					</div>
            					
            					<div class="form-group">
            						<label class="control-label col-md-3 col-sm-3 col-xs-12"
            							for="workingLanguage">Working language <span class="required">*</span>
            						</label>
            						<div class="col-md-6 col-sm-6 col-xs-12">
            							<input type="text" id="workingLanguage" name="workingLanguage" value="{{ \App\Enums\OfferWorkingLanguages::getFriendlyName($offer['working_language']) }}" disabled class="form-control col-md-7 col-xs-12">
            						</div>
            					</div>
            					
            					<div class="form-group">
            						<label class="control-label col-md-3 col-sm-3 col-xs-12"
            							for="companyId">Company <span class="required">*</span>
            						</label>
            						<div class="col-md-6 col-sm-6 col-xs-12">
            							<input class="form-control col-md-7 col-xs-12" value="{{ $offer['company']['name'] }}" disabled />
            						</div>
            					</div>
            					<div class="form-group">
            						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="location">Location</label>
            						<div class="col-md-6 col-sm-6 col-xs-12">
            							<input type="text" id="location" name="location" value="{{ $offer['location'] }}" class="form-control col-md-7 col-xs-12">
            						</div>
            					</div>
            					<div class="form-group">
            						<label class="control-label col-md-3 col-sm-3 col-xs-12">Hashtag</label>
            						<div class="col-md-6 col-sm-6 col-xs-12">
            							<p>
            								@foreach ($offer['hashtags'] as $hashtag)
        										{{$hashtag['name']}}
    										@endforeach
										</p>
            						</div>
            					</div>
            					<div class="ln_solid"></div>
            				</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection @section('extended-css')
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
<link
	href="{{asset('css/bootstrap-wysihtml5-0.0.2.css')}}"
	rel="stylesheet">
	
@endsection
@section('extended-scripts')
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
@endsection
