@extends('layouts.backend.app')

@section('title', 'Post')

@push('css')
    <style> .teal{ background:#009688; color:#fff; } </style>
    <!-- JQuery DataTable Css -->
    <link href="{{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
@endpush

@section('content')
        <div class="container-fluid">
            <div class="block-header">
                      <a class="btn teal" href="{{route('author.post.create')}}">
                       <i class="material-icons">add</i> ADD NEW POST</a>
            </div>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ALL POSTS
                                <span class="badge">{{ $posts->count() }}</span>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th><i class="material-icons">visibility</i></th>
                                        <th>Is Approved</th>
                                        <th>Status</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>SN</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th><i class="material-icons">visibility</i></th>
                                        <th>Is Approved</th>
                                        <th>Status</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($posts as $key => $post)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ Str::limit($post->title,10) }}</td>
                                            <td>{{ $post->user->name }}</td>
                                            <td>{{ $post->view_count}}</td>
                                            <td>
                                                @if( $post->is_approved == true)
                                                    <span class="btn btn-success waves-effect">Approved</span>
                                                    @else
                                                    <span class="btn btn-danger waves-effect">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if( $post->status == true)
                                                    <span class="btn btn-success waves-effect">Published</span>
                                                @else
                                                    <span class="btn btn-danger waves-effect">Pending</span>
                                                @endif
                                            </td>
                                            <td>{{ $post->created_at->toDatestring() }}</td>
                                            <td class="text-center">
                                                <a href="{{route('author.post.show',$post->id)}}"
                                                   class="btn btn-primary waves-effect"><i class="material-icons">visibility</i></a>
                                                <a href="{{route('author.post.edit',$post->id)}}"
                                                class="btn btn-success waves-effect"><i class="material-icons">edit</i></a>
                                                <button type="button" class="btn btn-danger waves-effect"
                                                onclick="deletePost({{$post->id}})">
                                                    <i class="material-icons">delete</i></button>
                                                <form id="delete-form-{{$post->id}}" action="{{route('author.post.destroy',$post->id)}}"
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
        function deletePost(id) {
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
