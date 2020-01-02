@extends('layouts.backend.app')

@section('title', 'add new post')

@push('css')
    <style> .teal{ background:#009688; color:#fff;} </style>
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <a class="btn btn-danger" href="{{route('admin.post.index')}}"><i class="material-icons">arrow_back</i>Back</a>
            @if($post->is_approved == false)
                <button type="button" class="btn teal pull-right" onclick="approvePost({{$post->id}})">
                   <i class="material-icons">done</i>
                    <span>Approve</span>
                </button>
                <form id="approve-form-{{$post->id}}" action="{{route('admin.post.approve',$post->id)}}"
                      method="POST" style="display: none;">
                    @csrf
                    @method('PUT')
                </form>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.18.1/dist/sweetalert2.all.min.js"></script>

    <script type= "text/javascript">
        function approvePost(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You wanna approve this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, approve it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('approve-form-'+id).submit();

                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Post status remnin pending :)',
                        'info'
                    )
                }
            })
        }

    </script>
@endpush
