@extends('layouts.backend.app')

@section('title', 'add new post')

@push('css')
    <style> .teal{ background:#009688; color:#fff;} </style>
    <!-- Multi Select Css -->
    <link href="{{asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <form action="{{route('author.post.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="row clearfix">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            ADD NEW POST
                        </h2>
                    </div>
                    <div class="body">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="title" name="title"  class="form-control">
                                    <label class="form-label">Title</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="image">Featured Image</label>
                                    <input type="file" id="image" name="image"  class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="publish" name="status" value="1" class="filled-in">
                                <label for="publish">Publish</label>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Tag and Category
                        </h2>
                    </div>
                    <div class="body">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label for="category">Select Category</label>
                                    <select name="category[]" id="category" class="
                                    show-tick form-control" data-live-search="true" multiple>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label for="tag">Select Tag</label>
                                    <select name="tag[]" id="tag" class="
                                        show-tick form-control" data-live-search="true" multiple>
                                        @foreach($tags as $tag)
                                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <a class="btn btn-danger m-t-15 waves-effect" href="{{route('author.post.index')}}">
                                <i class="material-icons">arrow_back</i>Back</a>
                            <button type="submit" class="btn teal m-t-15 waves-effect">
                                <i class="material-icons">arrow_upward</i>Save</button>
                    </div>
                </div>
            </div>
        </div>
            <!-- TinyMCE -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                BODY
                            </h2>
                        </div>
                        <div class="body">
                            <textarea id="tinymce" name="body">
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# TinyMCE -->
    </form>
        <!-- Vertical Layout | With Floating Label -->
    </div>
@endsection

@push('js')
    <!-- Select Plugin Js -->
    <script src="{{asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
    <!-- TinyMCE -->
    <script src="{{asset('assets/backend/plugins/tinymce/tinymce.js')}}"></script>

    <!-- Custom Js -->
    <script>
        //TinyMCE
        $(function () {
        tinymce.init({
            selector: "textarea#tinymce",
            theme: "modern",
            height: 300,
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools'
            ],
            toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons',
            image_advtab: true
        });
        tinymce.suffix = ".min";
        tinyMCE.baseURL = '{{asset('assets/backend/plugins/tinymce')}}';
        });
    </script>
@endpush
