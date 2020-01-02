@extends('layouts.frontend.app')

@section('title', 'Posts')

@push('css')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/posts/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/posts/responsive.css')}}">
    <style>
        .favourite_post{
            color:blue;
        }
    </style>
@endpush

@section('content')
    <div class="slider display-table center-text">
        <h1 class="title display-table-cell"><b>ALL POSTS</b></h1>
    </div><!-- slider -->

    <section class="blog-area section">
        <div class="container">

            <div class="row">
                @foreach($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="single-post post-style-1">

                                <div class="blog-image"><img src="{{url('storage/post/',$post->image)}}" alt="Blog Image"></div>

                                <a class="avatar" href="{{ route('author.profile',$post->user->username)}}"><img src="{{url('storage/profile/'.$post->user->image)}}" alt="Profile Image"></a>

                                <div class="blog-info">

                                    <h4 class="title"><a href="{{route('post.details',$post->slug)}}"><b>{{$post->title}}</b></a></h4>

                                    <ul class="post-footer">
                                        <li>
                                            @guest
                                                <a href="#" onclick="toastr.info('To add favourite list need to login first',
                                            'info',{
                                                closeButton:true,
                                                progressBar:true,
                                            })"><i class="ion-heart"></i>
                                                    {{$post->favourite_to_users->count()}}
                                                </a>

                                            @else
                                                <a href="#" onclick="document
                                                    .getElementById('favourite-form-{{$post->id}}').submit();"
                                                   class="{{!Auth::user()->favourite_posts->where
                                                 ('pivot.post_id',$post->id)->count()==0 ?'favourite_post':''}}">
                                                    <i class="ion-heart"></i>
                                                    {{$post->favourite_to_users->count()}}
                                                </a>
                                                <form id="favourite-form-{{$post->id}}"
                                                      action="{{route('post.favourite',$post->id)}}"
                                                      method="POST" style="display:none;">
                                                    @csrf
                                                </form>
                                            @endguest
                                        </li>
                                        <li><a href="#"><i class="ion-chatbubble"></i>{{$post->comments->count()}}</a></li>
                                        <li><a href="#"><i class="ion-eye"></i>{{$post->view_count}}</a></li>
                                    </ul>

                                </div><!-- blog-info -->
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-lg-4 col-md-6 -->
                @endforeach

            </div><!-- row -->

{{--            <a class="load-more-btn" href="#"><b>LOAD MORE</b></a>--}}
            {{$posts->links()}}

        </div><!-- container -->
    </section><!-- section -->
@endsection

@push('js')

@endpush
