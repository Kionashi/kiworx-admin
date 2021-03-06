@extends('layouts.app')

@section('content')
   <!-- page content -->
    <div class="right_col" role="main">
        <div class="page-title">
            <div class="title_left">
            <a href="{{route('campaings')}}"><h3>Campañas</a> <small>Crear</small></h3>
            </div>
        </div>
        <div class="clearfix"></div>
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button class="close" aria-label="Close" type="button" data-dismiss="alert"><span aria-hidden="true">×</span>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="x_content" style="display: block;">
            <form action="{{route('campaings/store')}}" class="form-horizontal form-label-left" method="post">
                @csrf
                <input type="hidden" name="user_id">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Código <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="code" name="code" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                @if($events)
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Eventos <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select multiple="multiple" class="form-control col-md-7 col-xs-12" id="events" name="events[]">
                                @foreach($events as $event)
                                    <option value='{{$event->id}}'>{{$event->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif
        
                <div class="ln_solid"></div>
                    <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" class="btn btn-success">Enviar</button>
                </div>
                </div>
            </form>
        </div> 	
    </div>
    
    <!-- /page content -->
    
@endsection
