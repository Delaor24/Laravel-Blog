@extends('layouts.backEnd.app')
@section('title','Admin setting')

@section('content')
<div class="container-fluid">
	

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                TABS WITH ICON TITLE
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#update_profile" data-toggle="tab" aria-expanded="true">
                                        <i class="material-icons">face</i> UPDATE PROFILE
                                    </a>
                                </li>
                                <li role="presentation" class="">
                                    <a href="#change_password" data-toggle="tab" aria-expanded="false">
                                        <i class="material-icons">change_history</i> CHANGE PASSWORD
                                    </a>
                                </li>
                            
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="update_profile">
                                    <form class="form-horizontal" action="{{route('admin.profile.update')}}" method="POST" enctype="multipart/form-data">
                            	@csrf
                            	@method('PUT')

                            	<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Name</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="name" class="form-control" placeholder="Enter yur name" value="{{Auth::user()->name}}" name="name">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                           


                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Email Address</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="email" id="email_address_2" class="form-control" placeholder="Enter your email address" name="email" value="{{Auth::user()->email}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">About</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea rows="5" class="form-control" name="about">{{Auth::user()->about}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                   <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="image">Profile Image</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="file" id="image" class="form-control" name="img">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE PROFILE</button>
                                    </div>
                                </div>
                            </form>

                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="change_password">
                                    <form class="form-horizontal" action="{{route('admin.password.update')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Old Password</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" id="oldPassword" class="form-control" placeholder="Enter yur old password" name="old_password">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                    <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">New Password</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" id="newPassword" class="form-control" placeholder="Enter yur new password" name="password">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                    <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Confirm Password</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" id="conformPasswordon" class="form-control" placeholder="Enter yur new password again" name="password_confirmation">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                           
                                
                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">CHANGE PASSWORD</button>
                                    </div>
                                </div>
                            </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

             </div>
@endsection