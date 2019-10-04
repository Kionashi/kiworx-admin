@extends('layouts.app')

@section('content')
   <!-- page content -->
   <div class="right_col" role="main">
        <div class="">
            <div id="spinner"></div>
            <form id="uploadExcel" action="{{route('test-post')}}" method="POST" enctype="multipart/form-data">
                <input name="_token" value="{{ csrf_token() }}" id="perico" type="hidden">
                <input type="file" name="excel" id="excel">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div> 
    
    <!-- /page content -->
    @push('scripts')
        <script>
            $(document).ready(function() {    
                    $('#uploadExcel').on('submit', function(e){
                        e.preventDefault();
                        
                        //Añadimos la imagen de carga en el contenedor
                        $('#spinner').html('<div class="loading"><img src="assets/img/ajax-loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');
                        let token = $('#perico').val();
                        let excel = document.querySelector('#excel');
                        let data = new FormData();
                        data.append('_token',token);
                        data.append('excel',excel.files[0]);
                        axios.post('/test-post',data,{
                            headers: {
                            'Content-Type': 'multipart/form-data'
                            }
                        })
                        .then(response => {
                            if(response.data == 'NO FILE'){
                                $('#spinner').html(`<div class="alert alert-success alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button> No se encontró el archivo
                                </div>`
                                );
                            }else{
                                $('#spinner').html(`<div class="alert alert-success alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button> Migración completada exitosamente 
                                </div>`
                                );
                            }
                            console.log(response);
                        })
                        .catch(error => {
                            console.log(error);
                        });
                    });              
                });
            </script>
    @endpush
@endsection