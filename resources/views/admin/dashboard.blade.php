@extends('layouts.backend.app')

@section('title','Dashboard')

@push('css')

@endpush

@section('content')
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">All POST</div>
                            <div class="number count-to" data-from="0" data-to="{{ $posts->count() }}" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">favorite</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL FAVORITE</div>
                            <div class="number count-to" data-from="0" data-to="{{ Auth::user()->favourite_posts->count() }}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-red hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text">PENDING POSTS</div>
                            <div class="number count-to" data-from="0" data-to="{{ $pending_posts }}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">visibility</i>
                        </div>
                        <div class="content">
                            <div class="text">ALL VIEW</div>
                            <div class="number count-to" data-from="0" data-to="{{ $all_views}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">apps</i>
                        </div>
                        <div class="content">
                            <div class="text">All CATEGORIES</div>
                            <div class="number count-to" data-from="0" data-to="{{ $category_count}}" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                    <div class="info-box bg-blue hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">account_circle</i>
                        </div>
                        <div class="content">
                            <div class="text">ACTIVE USERS</div>
                            <div class="number count-to" data-from="0" data-to="{{ $active_users->count() }}" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                    <div class="info-box bg-light-green hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">person</i>
                        </div>
                        <div class="content">
                            <div class="text">ALL AUTHORS</div>
                            <div class="number count-to" data-from="0" data-to="{{ $active_users->count() }}" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                    <div class="info-box bg-purple hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">library_books</i>
                        </div>
                        <div class="content">
                            <div class="text">AUTHORS TODAY</div>
                            <div class="number count-to" data-from="0" data-to="{{ $new_authors_today }}" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>MOST POPULAR POST</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class=table>
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Title</th>
                                            <th>View Count</th>
                                            <th>Comments</th>
                                            <th>Favourite</th>
                                            <th>Pending</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($popular_posts as $key => $post)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ Str::limit($post->title,20) }}</td>
                                                <td>{{ $post->view_count }}</td>
                                                <td>{{ $post->comments_count }}</td>
                                                <td>{{ $post->favourite_to_users_count }}</td>
                                                <td>
                                                     @if($post->status == true)
                                                        <span class="btn btn-success">Published</span>
                                                        @else
                                                         <span class="btn btn-danger">pending</span>
                                                     @endif   
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary waves-effect"
                                                    target="_blank" href="{{ route('post.details',$post->slug) }}">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
                </div>
            </div>
            <!-- #END# Widgets -->

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>TOP 10 ACTIVE USERS</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Name</th>
                                        <th>Posts</th>
                                        <th>Comments</th>
                                        <th>Favourite</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($active_users as $key => $user)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->posts_count }}</td>
                                                <td>{{ $user->comments_count }}</td>
                                                <td>{{ $user->favourite_posts_count }}</td>
                                            </tr>
                                        @endforeach

                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
            </div>
        </div>
@endsection

@push('js')
    <!-- Jquery CountTo Plugin Js -->
    <script src="{{asset('assets/backend/plugins/jquery-countto/jquery.countTo.js')}}"></script>

    <!-- Morris Plugin Js -->
    <script src="{{asset('assets/backend/plugins/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/morrisjs/morris.js')}}"></script>

    <!-- ChartJs -->
    <script src="{{asset('assets/backend/plugins/chartjs/Chart.bundle.js')}}"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="{{asset('assets/backend/plugins/flot-charts/jquery.flot.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/flot-charts/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/flot-charts/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/flot-charts/jquery.flot.categories.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/flot-charts/jquery.flot.time.js')}}"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="{{asset('assets/backend/plugins/jquery-sparkline/jquery.sparkline.js')}}"></script>
    <script src="{{asset('assets/backend/js/pages/index.js')}}"></script>
@endpush

