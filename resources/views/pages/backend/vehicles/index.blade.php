@extends('layouts.app')

@section('content')
   <!-- page content -->
   <div class="right_col" role="main">
        <div class="">
            <div class=" row page-title">
                <div class="title_left">
                    <h3>
                        Vehículos <small>Listar</small>
                    </h3>
                </div>

                <div class="title_right">
                    <div
                        class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <span class="input-group-btn"> <a type="button"
                                href="{{route('vehicles/create')}}" class="btn btn-default btn-create"><i class="fa fa-plus"></i> Crear</a>
                            </span>
                            <span class="input-group-btn"> <a type="button"
                                href="#" class="btn btn-default btn-create" id="import"><i style="color: green !important;" class="fa fa-file-excel"></i> Importar excel</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" row page-title">
                <div class="title_left" id="uploadZone">
                        
                </div>

                <div class="title_right">
                    <div
                        class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                           
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="x_content">
                @if ($vehicles)
                    <!--  <p class="text-muted font-13 m-b-30">clients</p> -->
                    <table id="datatable-responsive"
                        class="table table-striped table-bordered dt-responsive nowrap"
                        cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vehicles as $vehicle)
                            <tr style="height:40px;">
                                <td>{{ $vehicle->serial }}</td>
                                <td>
                                    <a href="{{route('vehicles/details', $vehicle->id)}}" title="Detalles" class="icon-table"><i class="fa fa-search"></i></a>
                                    <a href="{{route('vehicles/edit', $vehicle->id)}}" title="Editar" class="icon-table"><i class="fa fa-edit"></i></a>
                                    <a href="{{route('vehicles/delete', $vehicle->id)}}" title="Eliminar" class="icon-table"><i class="fa fa-trash"></i></a>
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
    @push('scripts')
    <script>
        
        $(document).ready(function() {    
            let importToggle = false;
                $('#import').on('click', function(e){
                    // alert('click');
                    if(importToggle == false){
                        $('#uploadZone').html(`<div class="">
                                <div id="spinner"></div>
                                    <input name="_token" value="{{ csrf_token() }}" id="perico" type="hidden">
                                    <input type="file" name="excel" id="excel">
                                    <button type="submit" id="pericoButton"class="btn btn-success">Enviar</button>
                            </div>`);
                            importToggle = true;
                    }else{
                        $('#uploadZone').html('');
                        importToggle = false;
                    }
                    $('#pericoButton').on('click', function(e){
                        // alert('perico');
                        //Añadimos la imagen de carga en el contenedor
                        $('#spinner').html('</p><div class="loading"><img src="/assets/img/ajax-loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');
                        let token = $('#perico').val();
                        let excel = document.querySelector('#excel');
                        let data = new FormData();
                        data.append('_token',token);
                        data.append('excel',excel.files[0]);
                        axios.post('/campaings/vehicles/import',data,{
                            headers: {
                            'Content-Type': 'multipart/form-data'
                            }
                        })
                        .then(response => {
                            if(response.data == 'NO FILE'){
                                $('#spinner').html(`<div class="alert alert-danger alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button> No se encontró el archivo
                                </div>`
                                );
                            }else{
                                $('#uploadZone').html(`<div class="alert alert-success alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button> <p>Migración completada exitosamente</p>
                                    <p>Campañas nuevas creadas: ${response.data.newCampaingsCount}</p> 
                                    <p>Vehiclos nuevos creados: ${response.data.newVehiclesCount}</p> 
                                </div>`
                                );
                            }
                            console.log('RESPONSE SUCCESS');
                            console.log(response);
                        })
                        .catch(error => {
                            console.log(error);
                        });
                    });  
                });
                // $('#uploadExcel').on('submit', function(e){
                //     e.preventDefault();
                //     alert('perico');
                //     //Añadimos la imagen de carga en el contenedor
                //     $('#spinner').html('<div class="loading"><img src="assets/img/ajax-loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');
                //     let token = $('#perico').val();
                //     let excel = document.querySelector('#excel');
                //     let data = new FormData();
                //     data.append('_token',token);
                //     data.append('excel',excel.files[0]);
                //     axios.post('/test-post',data,{
                //         headers: {
                //         'Content-Type': 'multipart/form-data'
                //         }
                //     })
                //     .then(response => {
                //         if(response.data == 'NO FILE'){
                //             $('#spinner').html(`<div class="alert alert-success alert-dismissible fade in" role="alert">
                //                 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                //                 </button> No se encontró el archivo
                //             </div>`
                //             );
                //         }else{
                //             $('#spinner').html(`<div class="alert alert-success alert-dismissible fade in" role="alert">
                //                 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                //                 </button> Migración completada exitosamente 
                //             </div>`
                //             );
                //         }
                //         console.log(response);
                //     })
                //     .catch(error => {
                //         console.log(error);
                //     });
                // });              
  
            });
        </script>
@endpush
@endsection
