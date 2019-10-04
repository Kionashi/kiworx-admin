@extends('layouts.app')

@section('content')
   <!-- page content -->
    <div class="right_col" role="main">
        <div class="page-title">
            <div class="title_left">
            <a href="{{ route('vehicles') }}"><h3>Vehículos</a> <small>Detalles</small></h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="x_content" style="display: block;">
            <form action="#" class="form-horizontal form-label-left" method="post">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Serial</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="name" name="serial" disabled value="{{$vehicle->serial}}" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                @if($vehicle->campaings->count() > 0)
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Campañas</label>
                        </div>
                        @foreach($vehicle->campaings as $campaing)
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <input type="text" id="code" name="code" disabled value="{{$campaing->name}}" class="bottom-1 form-control col-md-7 col-xs-12">
                            </div>
                        @endforeach
                    </div>
                @endif
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a href="{{route('vehicles')}}" class="btn btn-primary">Volver</a>
                    </div>
                </div>
            </form>
        </div> 	
    </div>
    <!-- /page content -->
@endsection
