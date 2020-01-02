@extends('layouts.backend.app')

@section('title', 'update category')

@push('css')

@endpush

@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            UPDATE CATEGORY
                        </h2>
                    </div>
                    <div class="body">
                        <form action="{{route('admin.category.update',$category->id)}}" method="POST"
                        enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" value="{{$category->name}}" id="name" name="name"  class="form-control">
                                    <label class="form-label">Category Name</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="file"  id="image" name="image"  class="form-control">
                                </div>
                            </div>
                            <br>
                            <a class="btn btn-danger m-t-15 waves-effect" href="{{route('admin.category.index')}}">Back</a>
                            <button type="submit" class="btn btn-success m-t-15 waves-effect">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->
    </div>
@endsection

@push('js')

@endpush
