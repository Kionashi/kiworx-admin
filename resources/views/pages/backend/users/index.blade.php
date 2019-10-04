@extends('layouts.app')

@section('content')
   <!-- page content -->
   <div class="right_col" role="main">
        <div class="">
            <div class=" row page-title">
                <div class="title_left">
                    <h3>
                        Vendedores <small>Listar</small>
                    </h3>
                </div>

                <div class="title_right">
                    <div
                        class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <span class="input-group-btn"> <a type="button"
                                href="{{route('users/create')}}" class="btn btn-default btn-create"><i class="fa fa-plus"></i> Crear</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="x_content">
                @if ($users)
                    <!--  <p class="text-muted font-13 m-b-30">clients</p> -->
                    <table id="datatable-responsive"
                        class="table table-striped table-bordered dt-responsive nowrap"
                        cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr style="height:40px;">
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{route('users/details', $user->id)}}" title="Detalles" class="icon-table"><i class="fa fa-search"></i></a>
                                    <a href="{{route('users/edit', $user->id)}}" title="Editar" class="icon-table"><i class="fa fa-edit"></i></a>
                                    <a href="{{route('users/delete', $user->id)}}" title="Eliminar" class="icon-table"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No hay vendedores disponibles.</p>
                @endif
            </div>
        </div>
    </div> 
    <!-- /page content -->
@endsection
