@extends('layouts.app')

@section('content')
   <!-- page content -->
   <div class="right_col" role="main">
        <div class="">
            <div class=" row page-title">
                <div class="title_left">
                    <h3>
                        Notificaciones  <small>Listar</small>
                    </h3>
                </div>

                <div class="title_right">
                    
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="x_content">
                @if ($notifications)
                    <!--  <p class="text-muted font-13 m-b-30">clients</p> -->
                    <table id="datatable-responsive"
                        class="table table-striped table-bordered dt-responsive nowrap"
                        cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notifications as $notification)
                            <tr style="height:40px;">
                                <td>{{ $notification->name }}</td>
                                <td>
                                    <a href="{{route('notifications/details', $notification->id)}}" title="Detalles" class="icon-table"><i class="fa fa-search"></i></a>
                                    <!-- <a href="{{route('notifications/edit', $notification->id)}}" title="Editar" class="icon-table"><i class="fa fa-edit"></i></a> -->
                                    <a href="{{route('notifications/delete', $notification->id)}}" title="Eliminar" class="icon-table"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No hay notificaciones disponibles.</p>
                @endif
            </div>
        </div>
    </div> 
    <!-- /page content -->
@endsection
