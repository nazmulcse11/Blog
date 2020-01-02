@extends('layouts.backend.app')

@section('title', 'Settings')

@push('css')
    <style> .teal{ background:#009688; color:#fff; } </style>
@endpush

@section('content')
 <div class="container-fluid">
     <div class="row clearfix">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
             <div class="card">
                 <div class="header">
                     <h2>
                         SETTINGS
                     </h2>
                 </div>
                 <div class="body">
                     <!-- Nav tabs -->
                     <ul class="nav nav-tabs" role="tablist">
                         <li role="presentation" class="">
                             <a href="#profile_with_icon_title" data-toggle="tab" aria-expanded="false">
                                 <i class="material-icons">face</i> UPDATE PROFILE
                             </a>
                         </li>
                         <li role="presentation" class="">
                             <a href="#password_with_icon_title" data-toggle="tab" aria-expanded="false">
                                 <i class="material-icons">lock</i>CHANGE PASSWORD
                             </a>
                         </li>
                     </ul>

                     <!-- Tab panes -->
                     <div class="tab-content">
                         <div role="tabpanel" class="tab-pane fade active in" id="profile_with_icon_title">
                                     <form class="form-horizontal" method="POST" action="{{route('author.profile.update')}}"
                                     enctype="multipart/form-data">
                                         @csrf
                                         @method('PUT')
                                         <div class="row clearfix">
                                             <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                 <label for="name">Name</label>
                                             </div>
                                             <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                 <div class="form-group">
                                                     <div class="form-line">
                                                         <input type="text" name="name" value="{{Auth::user()->name}}" class="form-control" placeholder="Enter your name">
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="row clearfix">
                                             <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                 <label for="email">Email Address: </label>
                                             </div>
                                             <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                 <div class="form-group">
                                                     <div class="form-line">
                                                         <input type="email" name="email" value="{{Auth::user()->email}}" class="form-control" placeholder="Enter your name">
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="row clearfix">
                                             <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                 <label for="image">Profile Image: </label>
                                             </div>
                                             <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                 <div class="form-group">
                                                     <div class="form-line">
                                                         <input type="file" name="image"  class="form-control">
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="row clearfix">
                                             <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                 <label for="about">About</label>
                                             </div>
                                             <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                 <div class="form-group">
                                                     <div class="form-line">
                                                         <textarea name="about" rows="5" class="form-control" >{{Auth::user()->about}}</textarea>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="row clearfix">
                                             <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                                 <button type="submit" class="btn m-t-15 waves-effect teal">UPDATE</button>
                                             </div>
                                         </div>
                                     </form>
                         </div>
                         <div role="tabpanel" class="tab-pane fade" id="password_with_icon_title">
                             <form class="form-horizontal" method="POST" action="{{route('author.password.update')}}">
                                 @csrf
                                 @method('PUT')
                                 <div class="row clearfix">
                                     <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                         <label for="old_password">Old Password</label>
                                     </div>
                                     <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                         <div class="form-group">
                                             <div class="form-line">
                                                 <input type="password" name="old_password" class="form-control" placeholder="Enter your old password">
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="row clearfix">
                                     <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                         <label for="old_password">New Password</label>
                                     </div>
                                     <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                         <div class="form-group">
                                             <div class="form-line">
                                                 <input type="password" name="password" class="form-control" placeholder="Enter your new password">
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="row clearfix">
                                     <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                         <label for="password_confirm">Confirm Password</label>
                                     </div>
                                     <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                         <div class="form-group">
                                             <div class="form-line">
                                                 <input type="password" name="password_confirmation" class="form-control" placeholder="Enter your New password again">
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="row clearfix">
                                     <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                         <button type="submit" class="btn m-t-15 waves-effect teal">UPDATE</button>
                                     </div>
                                 </div>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
@endsection

@push('js')

@endpush
