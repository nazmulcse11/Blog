@extends('layouts.frontend.app')

@section('title')
{{$post->title}}
@endsection

@push('css')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/single-post/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/single-post/responsive.css')}}">
    <style>
        .header-bg{
            width:100%;
            height:400px;
            background-image:url({{url('storage/post/',$post->image)}});
            background-size:cover;
        }
        .favourite_post{
            color:blue;
        }
    </style>
@endpush

@section('content')
    <div class="slider">
        <div class="header-bg">

        </div>
    </div><!-- slider -->

    <section class="post-area section">
        <div class="container">

            <div class="row">

                <div class="col-lg-8 col-md-12 no-right-padding">

                    <div class="main-post">

                        <div class="blog-post-inner">

                            <div class="post-info">

                                <div class="left-area">
                                    <a class="avatar" href="{{ route('author.profile',$post->user->username)}}"><img src="{{url('storage/profile/'.$post->user->image)}}" alt="Profile Image"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="#"><b>Post By {{$post->user->name}}</b></a>
                                    <h6 class="date">on {{$post->created_at->toDatestring()}}</h6>
                                </div>

                            </div><!-- post-info -->

                            <h3 class="title"><a href="#"><b>{{$post->title}}</b></a></h3>

                            <div class="post-image"><img src="{{url('storage/post/'.$post->image)}}" alt="Blog Image"></div>
                            <p class="para">{!! $post->body !!}</p>

                            <ul class="tags">
                                @foreach($post->tags as $tag)
                                    <li><a href="{{route('tag.posts',$tag->slug)}}">{{$tag->name}}</a></li>
                                @endforeach

                            </ul>
                        </div><!-- blog-post-inner -->

                        <div class="post-icons-area">
                            <ul class="post-icons">
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

                            <ul class="icons">
                                <li>SHARE : </li>
                                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
                            </ul>
                        </div>

                    </div><!-- main-post -->
                </div><!-- col-lg-8 col-md-12 -->

                <div class="col-lg-4 col-md-12 no-left-padding">

                    <div class="single-post info-area">

                        <div class="sidebar-area about-area">
                            <h4 class="title"><b>ABOUT AUTHOR</b></h4>
                            <p><strong>Author Name:</strong> {{$post->user->name}}</p>
                            <p><strong>Post at:</strong> {{$post->created_at->toDatestring()}}</p>
                            <p><strong>Author Details:</strong> {{$post->user->about}}</p>
                        </div>

                        <div class="tag-area">

                            <h4 class="title"><b>CATEGORIES</b></h4>
                            <ul>
                                @foreach($post->categories as $category)
                                    <li><a href="{{route('category.posts',$category->slug)}}">{{$category->name}}</a></li>
                                @endforeach

                            </ul>

                        </div><!-- subscribe-area -->

                    </div><!-- info-area -->

                </div><!-- col-lg-4 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section><!-- post-area -->


    <section class="recomended-area section">
        <div class="container">
            <div class="row">
                @foreach($randomPosts as $randomPost)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="single-post post-style-1">

                                <div class="blog-image"><img src="{{url('storage/post/'.$randomPost->image)}}" alt="Blog Image"></div>

                                <a class="avatar" href="#"><img src="{{url('storage/profile/'.$randomPost->user->image)}}" alt="Profile Image"></a>

                                <div class="blog-info">

                                    <h4 class="title"><a href="#"><b>{{$randomPost->title}}</b></a></h4>

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
                    </div><!-- col-md-6 col-sm-12 -->
                @endforeach



            </div><!-- row -->

        </div><!-- container -->
    </section>

    <section class="comment-section">
        <div class="container">
            <h4><b>POST COMMENT</b></h4>
            <div class="row">

                <div class="col-lg-8 col-md-12">
                    <div class="comment-form">
                        @guest
                        <p>For a Comment you need to login first
                            <a href="{{route('login')}}">Login</a>
                        </p>
                        @else
                        <form method="post"action="{{route('comment.store',$post->id)}}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
									<textarea name="comment" rows="2" class="text-area-messge form-control"
                                              placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
                                </div><!-- col-sm-12 -->
                                <div class="col-sm-12">
                                    <button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
                                </div><!-- col-sm-12 -->

                            </div><!-- row -->
                        </form>
                        @endguest
                    </div><!-- comment-form -->

                    <h4><b>COMMENTS({{$post->comments->count()}})</b></h4>
                    @if($post->comments->count() > 0)
                    <div class="commnets-area">
                        @foreach($post->comments as $comment)
                        <div class="comment">
                            <div class="post-info">

                                <div class="left-area">
                                    <a class="avatar" href="#"><img src="{{url('storage/profile/'.$comment->user->image)}}" alt="Profile Image"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="#"><b>{{$comment->user->name}}</b></a>
                                    <h6 class="date">on {{$comment->created_at->toDatestring()}}</h6>
                                </div>
                            </div><!-- post-info -->

                            <p>{{$comment->comment}}</p>

                        </div>
                        @endforeach
                    </div><!-- commnets-area -->
                    @else
                    <a class="more-comment-btn" href="#"><b>No Comment Found For This Post</b></a>
                    @endif

                </div><!-- col-lg-8 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section>
@endsection

@push('js')

@endpush
