@extends('layouts.backend.app')

@section('title', 'post details')

@push('css')
    <style> .teal{ background:#009688; color:#fff;} </style>
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <a class="btn btn-danger" href="{{route('author.post.index')}}"><i class="material-icons">arrow_back</i>Back</a>
            @if($post->is_approved == false)
                <button type="button" class="btn teal pull-right">
                   <i class="material-icons">done</i>
                    <span>Approve</span>
                </button>
               @else
                <button type="button" class="btn teal pull-right" disabled>
                    <i class="material-icons">done</i>
                    <span>Approved</span>
                </button>
            @endif
        <br>
        <br>
        <div class="row clearfix">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-green">
                        <a href="">Post By <strong>{{$post->user->name}}</strong> </a>
                            <span>on {{$post->created_at->toDatestring()}}</span>
                    </div>
                    <div class="body">
                        {!! $post->body !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-light-green">
                        <h2>
                            Categories
                        </h2>
                    </div>
                    <div class="body">
                        @foreach($post->categories as $category)
                            <span class="label teal">{{$category->name}}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card">
                    <div class="header bg-cyan">
                        <h2>
                            Tags
                        </h2>
                    </div>
                    <div class="body">
                        @foreach($post->tags as $tag)
                            <span class="label teal">{{$tag->name}}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card">
                    <div class="header bg-purple">
                        <h2>
                            Featured Image
                        </h2>
                    </div>
                    <div class="body">
                        <img class="img-responsive thumbnail" src="{{url('storage/post/'.$post->image)}}" alt="Post Image">
                    </div>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->
    </div>
@endsection

@push('js')
@endpush
