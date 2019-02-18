@extends('layouts.frontEnd.app')
@section('title','Posts')
@push('css')
<link href="{{asset('assets/frontEnd/posts/styles.css')}}" rel="stylesheet">

	<link href="{{asset('assets/frontEnd/posts/responsive.css')}}" rel="stylesheet">
 


 <style type="text/css">
 	
 	.slider {
    height: 300px;
    width: 100%;
    background-image: url({{asset('assets/frontEnd/images/slider-1.jpg')}});
    background-size: cover;
}

 </style>
@endpush
@section('content')
<div class="slider display-table center-text">
		<h1 class="title display-table-cell"><b>ALL POST</b></h1>
	</div><!-- slider -->



	<section class="blog-area section">
		<div class="container">

			<div class="row">
              @foreach($posts as $post)
				<div class="col-lg-4 col-md-6">
					<div class="card h-100">
						<div class="single-post post-style-1">

							<div class="blog-image"><img src="{{Storage::disk('public')->url('post/'.$post->image)}}" alt="Blog Image"></div>

							<a class="avatar" href="#"><img src="{{Storage::disk('public')->url('profiles_images/'.$post->user->image)}}" alt="Profile Image"></a>

							<div class="blog-info">

								<h4 class="title"><a href="{{route('single.post',$post->slug)}}"><b>{{$post->title}}</b></a></h4>

								<ul class="post-footer">
									 <li>
                                        @guest
                                        <a href="javascript:void(0);" onclick="toastr.info('To add favarite list you neet toh login first','info',{
                                            closeButton: true,
                                            progressBar: true,
                                        })">
                                        <i class="ion-heart"></i>
                                        {{$post->favarite_to_users->count()}}
                                    </a>

                                            @else
                                             <a class="{{ !Auth::user()->favarite_posts->where('pivot.post_id',$post->id)->count()  == 0 ? 'favorite_posts' : ''}}" href="javascript:void(0);" onclick="document.getElementById('favarite-form-{{$post->id}}').submit()">
                                        <i class="ion-heart"></i>
                                        {{$post->favarite_to_users->count()}}
                                    </a>
                                    <form id="favarite-form-{{$post->id}}" method="POST" action="{{route('post.favarite',$post->id)}}" style="display: none;">
                                        @csrf

                                    </form>

                                        @endguest

                                        
                                    </li>
									<li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
									<li><a href="#"><i class="ion-eye"></i>{{$post->view_count}}</a></li>
								</ul>

							</div><!-- blog-info -->
						</div><!-- single-post -->
					</div><!-- card -->
				</div><!-- col-lg-4 col-md-6 -->
        @endforeach

        

			</div><!-- row -->

			{{ $posts->links() }}

		</div><!-- container -->
	</section><!-- section -->


	

@endsection