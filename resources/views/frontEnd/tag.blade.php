@extends('layouts.frontEnd.app')
@section('title','Category')

@push('css')
    <link href="{{ asset('assets/frontEnd/css/category/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontEnd/css/category/responsive.css') }}" rel="stylesheet">
    <style>
      
        }
        .favarite_posts{
            color: red;
        }
    </style>
@endpush

@section('content')
    <div class="slider display-table center-text">
        <h1 class="title display-table-cell"><b>{{ $tag->name }}</b></h1>
    </div><!-- slider -->

    <section class="blog-area section">
        <div class="container">

            <div class="row">
                @if($posts->count() > 0)
                    @foreach($posts as $post)
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100">
                                <div class="single-post post-style-1">

                                    <div class="blog-image"><img src="{{ Storage::disk('public')->url('post/'.$post->image) }}" alt="{{ $post->title }}"></div>

                                    <a class="avatar" href=""><img src="{{ Storage::disk('public')->url('profiles_images/'.$post->user->image) }}" alt="Profile Image"></a>

                                    <div class="blog-info">

                                        <h4 class="title"><a href="{{ route('single.post',$post->slug) }}"><b>{{ $post->title }}</b></a></h4>

                                        <ul class="post-footer">

                                            <li>
                                                @guest
                                                    <a href="javascript:void(0);" onclick="toastr.info('To add favorite list. You need to login first.','Info',{
                                                        closeButton: true,
                                                        progressBar: true,
                                                    })"><i class="ion-heart"></i>{{$post->favarite_to_users->count()}}</a>
                                                @else
                                                    <a href="javascript:void(0);" onclick="document.getElementById('favarite-form-{{ $post->id }}').submit();"
                                                       class="{{ !Auth::user()->favarite_posts->where('pivot.post_id',$post->id)->count()  == 0 ? 'favarite_posts' : ''}}"><i class="ion-heart"></i>{{$post->favarite_to_users->count()}}</a>

                                                    <form id="favarite-form-{{ $post->id }}" method="POST" action="{{ route('post.favarite',$post->id) }}" style="display: none;">
                                                        @csrf
                                                    </form>
                                                @endguest

                                            </li>
                                            <li><a href="#"><i class="ion-chatbubble"></i></a></li>
                                            <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                                        </ul>

                                    </div><!-- blog-info -->
                                </div><!-- single-post -->
                            </div><!-- card -->
                        </div><!-- col-lg-4 col-md-6 -->
                    @endforeach
              @else
               <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="single-post post-style-1">
                                <div class="blog-info">
                                    <h4 class="title">
                                        <strong>Sorry, No post found :(</strong>
                                    </h4>
                                </div><!-- blog-info -->
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-lg-4 col-md-6 -->
              @endif

            </div><!-- row -->
{{$posts->links()}}
           

        </div><!-- container -->
    </section><!-- section -->
	

@endsection