@extends('layouts.backEnd.app')

@section("title","Post index page")

@push('css')
<link href="{{asset("assets/backEnd/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css")}}" rel="stylesheet">
a
@endpush

@section('content')
       <div class="container-fluid">
            <div class="block-header">
                <a href="{{route('author.post.create')}}" class="btn btn-success">
                	<i class="material-icons">add</i>
                	<span>Add New Post</span>
                </a>
            </div>
            <!-- Basic Examples -->
                     <!-- #END# Basic Examples -->
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                All Post <span class="badge bg-blue">{{$posts->count()}}</span>
                            </h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th> <i class="material-icons">visibility</i> </th>
                                            <th>Is Approved</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th> <i class="material-icons">visibility</i> </th>
                                            <th>Is Approved</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    	@foreach($posts as $key=>$post)
                                        <tr>
                                            <td>{{$key+1 }}</td>
                                            <td>{{ str_limit($post->title,10) }}</td>
                                            <td>{{$post->user->name}}</td>
                                            
                                            <td>{{$post->view_count}}</td>
                                            <td>
                                                @if($post->is_approved == true)
                                                   <span class="badge bg-blue">Approved</span>
                                                  @else
                                                    <span class="badge bg-pink">Pending</span>
                                                  @endif
                                                
                                            </td>
                                            <td>
                                                @if($post->status == true)
                                                   <span class="badge bg-blue">Publish</span>
                                                  @else
                                                    <span class="badge bg-pink">Pending</span>
                                                  @endif
                                                
                                            </td>
                                            <td>{{$post->created_at->toFormattedDateString()}}</td>
                                            <td>

                                                <a href="{{ route('author.post.show',$post->id) }}" class="btn btn-info waves-effect">
                                                    <i class="material-icons">visibility</i>
                                                </a>

                                            	<a class="btn btn-info waves-effect" href="{{route('author.post.edit',$post->id)}}">
                                            		<i class="material-icons">edit</i>
                                            	</a>

                                                <button class="btn btn-danger waves-effect" type="button" onclick="deleteCategory({{$post->id}})">
                                                    <i class="material-icons">delete</i>
                                                </button>

                                                <form id="delete-form-{{$post->id}}" action="{{route('author.post.destroy',$post->id)}}" method="POST" style="display: none;">
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
 <script src="{{asset("assets/backEnd/plugins/jquery-datatable/jquery.dataTables.js")}}"></script>
    <script src="{{asset("assets/backEnd/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js")}}"></script>
    <script src="{{asset("assets/backEnd/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js")}}"></script>
    <script src="{{asset("assets/backEnd/plugins/jquery-datatable/extensions/export/buttons.flash.min.js")}}"></script>
    <script src="{{asset("assets/backEnd/plugins/jquery-datatable/extensions/export/jszip.min.js")}}"></script>
    <script src="{{asset("assets/backEnd/plugins/jquery-datatable/extensions/export/pdfmake.min.js")}}"></script>
    <script src="{{asset("assets/backEnd/plugins/jquery-datatable/extensions/export/vfs_fonts.js")}}"></script>
    <script src="{{asset("assets/backEnd/plugins/jquery-datatable/extensions/export/buttons.html5.min.js")}}"></script>
    <script src="{{asset("assets/backEnd/plugins/jquery-datatable/extensions/export/buttons.print.min.js")}}"></script>

    <!-- Custom Js -->
    <script src="{{asset("assets/backEnd/js/author.js")}}"></script>
    <script src="{{asset("assets/backEnd/js/pages/tables/jquery-datatable.js")}}"></script>

    <!-- Demo Js -->
    <script src="{{asset("assets/backEnd/js/demo.js")}}"></script>


 <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        function deleteCategory(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush