@extends('layouts.navadmin')
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
       $('#id_radio1').click(function () {
          $('#div2').hide('fast');
          $('#div1').show('fast');
   });
   $('#id_radio2').click(function () {
         $('#div1').hide('fast');
         $('#div2').show('fast');
    });
  });
</script>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Agregar video al Playlist</div>
                <div class="panel-body">
                  {!! Form::open(['route' => 'videoplaylist.store', 'method' => 'POST' , 'files' => true]) !!}
                  {{csrf_field()}}
                      <div class="form-group">
                        {!! Form::label('name', 'Nombre del Video') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre del Video', 'required'])!!}
                      </div>
                      <div class="form-group">
                        {!! Form::label('', 'Selecione la forma de subir el Video') !!}
                          <input id="id_radio1" type="radio" name="name_radio1" value="value_radio1" checked />URL
                          <input id="id_radio2" type="radio" name="name_radio1" value="value_radio2" />Video de PC
                        <div align="center" style="padding:25px;width: 300px;">
                          <div id="div1">{!! Form::text('url', null, ['class' => 'form-control', 'placeholder' => 'URL Video'])!!}</div>
                          <div id="div2">{!! Form::file('video') !!}</div>
                        </div>
                      </div>
                      <br>

                      <div class="form-group">
                        {!! Form::submit('Guardar Video', ['class' => 'btn btn-primary']) !!}
                      </div>
                  {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
