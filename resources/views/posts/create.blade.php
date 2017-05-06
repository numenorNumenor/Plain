@extends('master')

@section('title', '| Create')

@section('stylesheets')
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>

  <script>
    tinymce.init({
                selector: 'textarea',
                height: 500,
                menubar: false,
                theme: 'modern',
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
                ],
                toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
                image_advtab: true,
                templates: [
                    { title: 'Test template 1', content: 'Test 1' },
                    { title: 'Test template 2', content: 'Test 2' }
                ],
                content_css: [
                    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                    '//www.tinymce.com/css/codepen.min.css'
                ]
            });﻿
  </script>
@stop

@section('content')

  <div class="row">
  <div class="col-md-8 col-md-offset-2">
      <h1>Create Post</h1>

      {!! Form::open([ 'route' => 'posts.store', 'files' => true]) !!}
        <div class="form-group">
          {{ Form::label('title', 'Title :') }}
          {{ Form::text('title', null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
          {{ Form::label('featured_img', 'Img:') }}
          {{ Form::file('featured_img', null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
          {{ Form::label('body', 'Post :') }}
          {{ Form::textarea('body', null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
          {{ Form::submit('Create', array('class' => 'btn btn-sm btn-success')) }}
        </div>
      {!! Form::close() !!}
    </div>
  </div>

@stop
