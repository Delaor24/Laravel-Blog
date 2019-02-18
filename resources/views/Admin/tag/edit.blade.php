@extends('layouts.backEnd.app')

@section("title","Tag create page")

@push('css')

@endpush

@section('content')
        <div class="container-fluid">
          

            <!-- Vertical Layout -->
           
            <!-- #END# Vertical Layout -->
            <!-- Vertical Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Edit Tag
                            </h2>
                           
                        </div>
                        <div class="body">
                            <form action="{{route('admin.tag.update',$tag->id)}}" method="POST">
                            	@csrf
                            	@method('PUT')
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="name" class="form-control" name="name" value="{{$tag->name}}">
                                        <label class="form-label">Tag Name</label>
                                    </div>
                                </div>

                                

                               
                               
                                <br>
                                <button class="btn btn-success" type="submit"  class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                                <a href="{{route('admin.tag.index')}}" class="btn btn-danger">BACK</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vertical Layout | With Floating Label -->
     
@endsection

@push('js')
  <!-- Custom Js -->
    <script src="{{asset("assets/backEnd/js/admin.js")}}"></script>

    <!-- Demo Js -->
    <script src="{{asset("assets/backEnd/js/demo.js")}}"></script>
@endpush