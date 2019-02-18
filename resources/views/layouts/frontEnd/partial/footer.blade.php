 <footer>

        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-6">
                    <div class="footer-section">

                        <a class="logo" href="{{route('home')}}"><img src="{{asset('assets/blog_logo.jpg')}}" alt="Logo Image" width="30px" height="60px"></a>
                        <p class="copyright">Bona @ 2017. All rights reserved.</p>
                        <p class="copyright">Designed by <a href="https://colorlib.com" target="_blank">Md. Deloar Hossain</a></p>
                        <ul class="icons">
                            <li><a href="http://www.facebook.com/dhrimon1"><i class="ion-social-facebook-outline"></i></a></li>
                            <li><a href="https://www.linkedin.com/in/deloar1234/"><i class="ion-social-linkedin-outline"></i></a></li>
                            <li><a href="https://www.instagram.com/rimon24_h/"><i class="ion-social-instagram-outline"></i></a></li>
                            <li><a href="#"><i class="ion-social-vimeo-outline"></i></a></li>
                            <li><a href="#"><i class="ion-social-pinterest-outline"></i></a></li>
                        </ul>

                    </div><!-- footer-section -->
                </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-4 col-md-6">
                        <div class="footer-section">
                        <h4 class="title"><b>CATAGORIES</b></h4>
                        <ul>
                            @foreach($categories as $category)
                            <li><a href="{{ route('category.posts',$category->id) }}">{{ $category->name }}</a></li>
                        @endforeach
                        </ul>
                       
                    </div><!-- footer-section -->
                </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-4 col-md-6">
                    <div class="footer-section">

                        <h4 class="title"><b>SUBSCRIBE</b></h4>
                        <div class="input-area">
                            <form method="POST" action="{{route('subscriber.store')}}">
                                @csrf
                                <input class="email-input" type="email" placeholder="Enter your email" name="email">
                                <button class="submit-btn" type="submit"><i class="icon ion-ios-email-outline" ></i></button>
                            </form>
                        </div>

                    </div><!-- footer-section -->
                </div><!-- col-lg-4 col-md-6 -->

            </div><!-- row -->
        </div><!-- container -->
    </footer>