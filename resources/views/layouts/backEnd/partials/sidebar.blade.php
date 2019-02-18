<aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">

                  <img src="{{Storage::disk('public')->url('profiles_images/'.Auth::user()->image)}}" width="48" height="48" alt="User" />

                


                   
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</div>
                    <div class="email">{{Auth::user()->email}}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            
                            <li>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                      <i class="material-icons">input</i> Sign Out
                                       
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>

                    <!--Admin sitebar login-->
                    @if(Request::is("admin*"))


                    
                        <li class="{{Request::is("admin/dashboard") ? "active" : ""}}">
                            <a href="{{route('admin.dashboard')}}">
                                <i class="material-icons">dashboard</i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                          <li class="{{Request::is("admin/tag*") ? "active" : ""}}">
                                <a href="{{route('admin.tag.index')}}">
                                    <i class="material-icons">label</i>
                                    <span>Tag</span>
                                </a>
                           </li>

                           <li class="{{Request::is("admin/category*") ? "active" : ""}}">
                                <a href="{{route('admin.category.index')}}">
                                    <i class="material-icons">apps</i>
                                    <span>Category</span>
                                </a>
                           </li>

                           <li class="{{Request::is("admin/post*") ? "active" : ""}}">
                                <a href="{{route('admin.post.index')}}">
                                    <i class="material-icons">library_books</i>
                                    <span>Posts</span>
                                </a>
                           </li>

                           <li class="{{Request::is("admin/pending/post*") ? "active" : ""}}">
                                <a href="{{route('admin.post.pending')}}">
                                    <i class="material-icons">library_books</i>
                                    <span>Pending Posts</span>
                                </a>
                           </li>

                           <li class="{{Request::is("admin/favarite-list*") ? "active" : ""}}">
                                <a href="{{route('admin.favarite.post')}}">
                                    <i class="material-icons">favorite</i>
                                    <span>Favorites Post</span>
                                </a>
                           </li>

                            
                            <li class="{{Request::is("admin/subscribers*") ? "active" : ""}}">
                                <a href="{{route('admin.subscriber.index')}}">
                                    <i class="material-icons">subscriptions</i>
                                    <span>All Subscrber</span>
                                </a>
                           </li>

                               <li class="{{Request::is("admin/seeting*") ? "active" : ""}}">
                                <a href="{{route('admin.seeting.index')}}">
                                    <i class="material-icons">settings</i>
                                    <span>Setting</span>
                                </a>
                           </li>

                         
 

                        <li class="header">System</li>

                        <li class="{{Request::is("admin/dashboard")}}">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                      <i class="material-icons">input</i>
                                                      <span>Logout</span>
                                       
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                        </li>

                      @endif


                      <!--Author sitebar login-->


                      @if(Request::is("author*"))


                    
                        <li class="{{Request::is("author/dashboard") ? "active" : ""}}">
                            <a href="{{route('author.dashboard')}}">
                                <i class="material-icons">dashboard</i>
                                <span>Dashboard</span>
                            </a>
                        </li>



                        <li class="{{Request::is("author/post*") ? "active" : ""}}">
                                <a href="{{route('author.post.index')}}">
                                    <i class="material-icons">library_books</i>
                                    <span>Posts</span>
                                </a>
                           </li>

                           <li class="{{Request::is("author/favarite-list*") ? "active" : ""}}">
                                <a href="{{route('author.favarite.post')}}">
                                    <i class="material-icons">favorite</i>
                                    <span>Favorites Post</span>
                                </a>
                           </li>



                        <li class="header">System</li>

                        <li class="{{Request::is("author/seeting*") ? "active" : ""}}">
                                <a href="{{route('author.seeting.index')}}">
                                    <i class="material-icons">settings</i>
                                    <span>Setting</span>
                                </a>
                           </li>

                        <li class="{{Request::is("author/dashboard")}}">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                      <i class="material-icons">input</i>
                                                      <span>Logout</span>
                                       
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                        </li>

                      @endif
            
                </ul>
            </div>
            <!-- #Menu -->
            
        </aside>