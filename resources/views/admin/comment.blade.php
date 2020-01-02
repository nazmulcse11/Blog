@extends('layouts.backend.app')

@section('title', 'Comments')

@push('css')
    <style> .teal{ background:#009688; color:#fff; } </style>
    <!-- JQuery DataTable Css -->
    <link href="{{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
@endpush

@section('content')
        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ALL COMMENTS
                                <span class="badge">{{ $comments->count() }}</span>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th class="text-center">Comment Info</th>
                                        <th class="text-center">Post Info</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>SN</th>
                                        <th class="text-center">Comment Info</th>
                                        <th class="text-center">Post Info</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($comments as $key => $comment)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="">
                                                            <img class="media-object" src="{{url('storage/profile/'.
                                                            $comment->user->image)}}" alt="" width="100" height="100">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h4 class="media-heading">{{$comment->user->name}}
                                                         <small>on {{$comment->created_at->toDateString()}}
                                                         </small></h4>
                                                        <p>{{$comment->comment}}</p>
                                                        <a href="{{route('post.details',$comment->post->slug)}}">Post Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="">
                                                            <img class="media-object" src="{{url('storage/post/'.
                                                            $comment->post->image)}}" alt="" width="100" height="100">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h4 class="media-heading">{{$comment->post->user->name}}
                                                            <small>on {{$comment->post->created_at->toDateString()}}
                                                            </small></h4>
                                                        <p>{{Str::limit($comment->post->title,30)}}</p>
                                                        <a href="{{route('post.details',$comment->post->slug)}}">Post Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger waves-effect"
                                                        onclick="deleteComment({{$comment->id}})">
                                                    <i class="material-icons">delete</i></button>
                                                <form id="delete-form-{{$comment->id}}" action="{{route('admin.comment.destroy',$comment->id)}}"
                                                      method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
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
            <!-- #END# Exportable Table -->
        </div>
@endsection

@push('js')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>

    <!-- Custom Js -->
    <script src="{{asset('assets/backend/js/pages/tables/jquery-datatable.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.18.1/dist/sweetalert2.all.min.js"></script>

    <script type= "text/javascript">
        function deleteComment(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();

                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }

    </script>

@endpush
