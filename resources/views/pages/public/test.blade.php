@extends('layouts.error.app')
@section('section', 'Test')
@section('content')

<div class="col-md-12 col-sm-12 ">
	<div class="x_panel">
		<div class="x_title">
			<h2>
				Form Wizards <small>Sessions</small>
			</h2>
			<ul class="nav navbar-right panel_toolbox ">
				<li>
					<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
				</li>
				<li><a class="close-link"><i class="fa fa-close"></i></a></li>
			</ul>
			<div class="clearfix"></div>
		</div>
		<div class="x_content question-label">
			<!-- Smart Wizard -->
			<p>This personality test gives you accurate, precise scores for the Big Five personality traits and takes just 10 minutes. See exactly how you score for Openness, Conscientiousness, Extraversion, Agreeableness, and Neuroticism, and understand how the Big Five personality factors apply to your life, work and relationships.</p>
			<p>The Big Five or Five Factor model is the most scientifically sound way of classifying personality differences and is the most widely used among research psychologists.</p>
			<p>To take the Big Five personality assessment, rate each statement according to how well it describes you. Base your ratings on how you really are, not how you would like to be.</p>
			<form id="questionForm" class="form-inline questions-form" method="post" action="{{route('test')}}">
				@csrf
    			<div id="wizard" class="form_wizard wizard_horizontal ">
    				<ul class="wizard_steps">
    					<li>
    						<a href="#step-1"> <span class="step_no">1</span> <span class="step_descr"> Step 1<br /></span></a>
    					</li>
    					<li>
    						<a href="#step-2"> <span class="step_no">2</span> <span class="step_descr"> Step 2<br /></span></a>
    					</li>
    					<li>
    						<a href="#step-3"> <span class="step_no">3</span> <span class="step_descr"> Step 3<br /></span></a>
    					</li>
    					<li>
        					<a href="#step-4"> <span class="step_no">4</span> <span class="step_descr"> Step 4<br /></span></a>
    					</li>
    				</ul>
    				<div id="step-1">
    					<div class="row questions-header">
    						<div class="col-md-7"></div>
							<div class="col-md-5 col-xs-12 headers">
								<span class="header-label first-header">INACCURATE</span> <span class="header-label mid-header">NEUTRAL</span> <span class="header-label last-header">ACCURATE</span>
							</div>
    					</div>
    					<div class="row questions">
    						@foreach($step1Questions as $i => $question)
    						<div class="question">
    							<div class="col-md-7 col-xs-12">
    								<label class="form-check-label question-label">{{$question['name']}}</label>
								</div>
    							<div class="col-md-5 col-xs-12 options">
    								<input class="form-check-input option" type="radio" name="answer{{$question['id']}}" required value="1">
    								<input class="form-check-input option" type="radio" name="answer{{$question['id']}}" value="2">
    								<input class="form-check-input option" type="radio" name="answer{{$question['id']}}" value="3">
    								<input class="form-check-input option" type="radio" name="answer{{$question['id']}}" value="4">
    								<input class="form-check-input option" type="radio" name="answer{{$question['id']}}" value="5">
								</div>
    						</div>
    						@endforeach
    					</div>
    				</div>
    				<div id="step-2">
    					<div class="row questions-header">
    						<div class="col-md-7"></div>
							<div class="col-md-5 col-xs-12 headers">
								<span class="header-label first-header">INACCURATE</span> <span class="header-label mid-header">NEUTRAL</span> <span class="header-label last-header">ACCURATE</span>
							</div>
    					</div>
    					<div class="row questions">
    						@foreach($step2Questions as $i => $question)
    						<div class="question">
    							<div class="col-md-7 col-xs-12">
    								<label class="form-check-label question-label">{{$question['name']}}</label>
								</div>
    							<div class="col-md-5 col-xs-12 options">
    								<input class="form-check-input option" type="radio" name="answer{{$question['id']}}" required value="1">
    								<input class="form-check-input option" type="radio" name="answer{{$question['id']}}" value="2">
    								<input class="form-check-input option" type="radio" name="answer{{$question['id']}}" value="3">
    								<input class="form-check-input option" type="radio" name="answer{{$question['id']}}" value="4">
    								<input class="form-check-input option" type="radio" name="answer{{$question['id']}}" value="5">
								</div>
    						</div>
    						@endforeach
    					</div>
    				</div>
    				<div id="step-3">
    					<div class="row questions-header">
    						<div class="col-md-7"></div>
							<div class="col-md-5 col-xs-12 headers">
								<span class="header-label first-header">INACCURATE</span> <span class="header-label mid-header">NEUTRAL</span> <span class="header-label last-header">ACCURATE</span>
							</div>
    					</div>
    					<div class="row questions">
    						@foreach($step3Questions as $i => $question)
    						<div class="question">
    							<div class="col-md-7 col-xs-12">
    								<label class="form-check-label question-label">{{$question['name']}}</label>
								</div>
    							<div class="col-md-5 col-xs-12 options">
    								<input class="form-check-input option" type="radio" name="answer{{$question['id']}}" required value="1">
    								<input class="form-check-input option" type="radio" name="answer{{$question['id']}}" value="2">
    								<input class="form-check-input option" type="radio" name="answer{{$question['id']}}" value="3">
    								<input class="form-check-input option" type="radio" name="answer{{$question['id']}}" value="4">
    								<input class="form-check-input option" type="radio" name="answer{{$question['id']}}" value="5">
								</div>
    						</div>
    						@endforeach
    					</div>
    				</div>
    				<div id="step-4">
    					<div class="row questions-header">
    						<div class="col-md-7"></div>
							<div class="col-md-5 col-xs-12 headers">
								<span class="header-label first-header">INACCURATE</span> <span class="header-label mid-header">NEUTRAL</span> <span class="header-label last-header">ACCURATE</span>
							</div>
    					</div>
    					<div class="row questions">
    						@foreach($step4Questions as $i => $question)
    						<div class="question">
    							<div class="col-md-7 col-xs-12">
    								<label class="form-check-label question-label">{{$question['name']}}</label>
								</div>
    							<div class="col-md-5 col-xs-12 options">
    								<input class="form-check-input option" type="radio" name="answer{{$question['id']}}" required value="1">
    								<input class="form-check-input option" type="radio" name="answer{{$question['id']}}" value="2">
    								<input class="form-check-input option" type="radio" name="answer{{$question['id']}}" value="3">
    								<input class="form-check-input option" type="radio" name="answer{{$question['id']}}" value="4">
    								<input class="form-check-input option" type="radio" name="answer{{$question['id']}}" value="5">
								</div>
    						</div>
    						@endforeach
    					</div>
    				</div>
    			</div>
    			<!-- End SmartWizard Content -->
			</form>
		</div>
	</div>
</div>
@endsection
@section('extended-css')
<style>
    input[type='radio']:after {
        width: 15px;
        height: 15px;
        border-radius: 15px;
        top: -2px;
        left: -1px;
        position: relative;
        background-color: #d1d3d1;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid white;
    }

    input[type='radio']:checked:after {
        width: 15px;
        height: 15px;
        border-radius: 15px;
        top: -2px;
        left: -1px;
        position: relative;
        background-color: #6B42CF;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid white;
    }
    input[type='radio'] {
        transform: scale(2);
    }
    .questions-header {
        background-color: #6B42CF;
        color:#FFF;
        height: 40px;
    }
    .questions-form {
        margin: 0 auto;
        width: 60%;
    }
    .options {
        margin-top: 0.5em;
    }
    .option {
    	margin: 0 1.3em !important;
    }
    .questions {
        margin-top: 1em;
    }
    .question {
        height: 40px; 
        border-bottom: 1px solid #CCC;
    }
    .question-label {
        margin-top:0.3em;
        font-size: 15px;
        font-weight: normal;
        letter-spacing: 0.04em;
        line-height: 26px;
    }
    .header-label{
        margin: 0 0.5em;
    }
    .headers {
        padding: 0.5em;
    }
    @media (max-width: 600px) {
        .questions-form {
            width: 100%;
        }
        .question {
            border: 0;
        }
        .options {
            border-bottom: 1px solid #CCC;
        }
        .option {
        	margin: 0 1.0em !important;
        }
        .mid-header {
            display: none;
        }
        .headers {
            margin: 0.5em 0 0 1em;
        }
        .wizard_steps {
            padding: 0;
        }
    }
</style>
@endsection
@section('extended-scripts')
<!-- jQuery Smart Wizard -->
<script src="{{ asset('gentelella/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js') }}"></script>

<script type="text/javascript">
$(document).ready(function() {
		
	if( typeof ($.fn.smartWizard) === 'undefined'){ return; }
	console.log('init_SmartWizard');
	
	// Smart Wizard         
    $('#wizard').smartWizard({
        onLeaveStep:leaveAStepCallback,
        onFinish:onFinishCallback
    });

    function leaveAStepCallback(obj, context){
        console.log("Leaving step " + context.fromStep + " to go to step " + context.toStep);
        return validateSteps(context.fromStep); // return false to stay on step and true to continue navigation 
    }

    function onFinishCallback(objs, context){
        if(validateAllSteps()){
            $('form').submit();
        }
    }

    // Your Step validation logic
    function validateSteps(stepnumber){
        var isStepValid = true;
        // validate step 1
        if(stepnumber == 1){
            // Your step validation logic
            // set isStepValid = false if has errors
        }
        return isStepValid;
    }
    function validateAllSteps(){
        var isStepValid = true;
        // all step validation logic
        cosole.log($('[name="answer"]'));
        return isStepValid;
    }
	
	$('.buttonNext').addClass('btn btn-success');
	$('.buttonPrevious').addClass('btn btn-primary');
	$('.buttonFinish').addClass('btn btn-default');
// 	$('.buttonFinish').click(function(){
// 		cosole.log($('[name="ElementNameHere"]'));
		
// 		$('#questionForm').submit();
// 	});
	
});
</script>
@endsection
