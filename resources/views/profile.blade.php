@extends('layouts.frontend.app')

@section('title')

 {{$author->name}}

@endsection

@push('css')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/profile/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/profile/responsive.css')}}">
    <style>
        .favourite_post{
            color:blue;
        }
    </style>
@endpush

@section('content')
 <div class="slider display-table center-text">
		<h1 class="title display-table-cell"><b>{{$posts->count()}} Posts For {{$author->name}}</b></h1>
	</div><!-- slider -->

	<section class="blog-area section">
		<div class="container">

			<div class="row">

				<div class="col-lg-8 col-md-12">
					<div class="row">
						@if($posts->count() > 0)
							@foreach($posts as $post)
					                <div class="col-sm-12 col-md-6">
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
		                @else
		                    <div class="col-sm-12 col-md-12">
					                    <div class="card h-100">
					                        <div class="single-post post-style-1">
					                            <div class="blog-info">
					                                <h4 class="title">Sorry; No Posts Found For This Author ):</h4>
					                            </div><!-- blog-info -->
					                        </div><!-- single-post -->
					                    </div><!-- card -->
					                </div><!-- col-lg-4 col-md-6 -->
		                @endif    

					</div><!-- row -->

					<a class="load-more-btn" href="#"><b>LOAD MORE</b></a>

				</div><!-- col-lg-8 col-md-12 -->

				<div class="col-lg-4 col-md-12 ">

					<div class="single-post info-area ">

						<div class="about-area">
							<h4 class="title"><b>ABOUT AUTHOR</b></h4>
							<p><strong>Name: </strong>{{ $author->name }}</p>
							<p><strong>Details: </strong>{{ $author->about }}</p>
							<p><strong>Author Since: </strong>{{ $author->created_at->toDateString() }}</p>
							<p><strong>Total Posts: </strong> {{ $author->posts()->approved()->published()->count()}}</p>
						</div>

					</div><!-- info-area -->

				</div><!-- col-lg-4 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section><!-- section -->
@endsection

@push('js')

@endpush
