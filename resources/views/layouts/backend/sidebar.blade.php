<aside class="left-sidebar" data-sidebarbg="skin5">
    @php
    $access = App\Models\AdminAccess::where('admin_id', Auth::guard('admin')->user()->id)
    ->pluck('permissions')
    ->toArray();
    $admin = Auth::guard('admin')->user();
    @endphp
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                @if(in_array("Dashboard", $access) || $admin->role == 'SuperAdmin')
                <li class="sidebar-item {{Request::is('admin.dashboard') ? 'selected':''}}">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link {{Request::is('admin.dashboard') ? 'active':''}}" href="{{route('admin.dashboard')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a>
                </li>
                @endif
                @if(in_array("sliderEntry", $access) || in_array("bannerEntry", $access) || in_array("categoryEntry", $access) || in_array("partnerEntry", $access) || in_array("newsandeventEntry", $access) || in_array("serviceEntry", $access) || $admin->role == 'SuperAdmin')
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-earth"></i><span class="hide-menu"> Website Content </span></a>
                    <ul aria-expanded="false" class="collapse first-level">
                        @if(in_array("sliderEntry", $access) || $admin->role == 'SuperAdmin')
                        <li class="sidebar-item">
                            <a href="{{route('admin.slider.index')}}" class="sidebar-link {{Request::is('admin.slider.index') ? 'active':''}}"><i class="fas fa-sliders-h"></i><span class="hide-menu"> Slider Entry</span></a>
                        </li>
                        @endif
                        @if(in_array("bannerEntry", $access) || $admin->role == 'SuperAdmin')
                        <li class="sidebar-item">
                            <a href="{{route('admin.banner.index')}}" class="sidebar-link {{Request::is('admin.banner.index') ? 'active':''}}"><i class="fas fa-sliders-h"></i><span class="hide-menu"> Banner Entry</span></a>
                        </li>
                        @endif
                        @if(in_array("categoryEntry", $access) || $admin->role == 'SuperAdmin')
                        <li class="sidebar-item">
                            <a href="{{route('admin.category.index')}}" class="sidebar-link {{Request::is('admin.category.index') ? 'active':''}}"><i class="fas fa-list-alt"></i><span class="hide-menu"> Category Entry</span></a>
                        </li>
                        @endif

                        @if(in_array("partnerEntry", $access) || $admin->role == 'SuperAdmin')
                            <li class="sidebar-item">
                                <a href="{{route('admin.partner.index')}}" class="sidebar-link {{Request::is('admin.partner.index') ? 'active':''}}"><i class="fas fa-handshake"></i><span class="hide-menu"> Partner Entry </span></a>
                            </li>
                        @endif

                        @if(in_array("newsandeventEntry", $access) || $admin->role == 'SuperAdmin')
                            <li class="sidebar-item">
                                <a href="{{route('admin.blog.index')}}" class="sidebar-link {{Request::is('admin.blog.index') ? 'active':''}}"><i class="fas fa-handshake"></i><span class="hide-menu"> News & Events Entry</span></a>
                            </li>
                        @endif

                        @if(in_array("serviceEntry", $access) || $admin->role == 'SuperAdmin')
                            <li class="sidebar-item">
                                <a href="{{route('admin.service.index')}}" class="sidebar-link {{Request::is('admin.service.index') ? 'active':''}}"><i class="fas fa-briefcase"></i><span class="hide-menu"> Service Entry </span></a>
                            </li>
                        @endif

                        @if(in_array("howtoOrder", $access) || $admin->role == 'SuperAdmin')
                            <li class="sidebar-item">
                                <a href="{{route('admin.howto.order')}}" class="sidebar-link {{Request::is('admin.howto.order') ? 'active':''}}">
                                    <i class="fas fa-list"></i><span class="hide-menu"> How To Order </span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                @endif
                @if(in_array("districtEntry", $access) || in_array("thanaEntry", $access) || in_array("customerList", $access) || $admin->role == 'SuperAdmin')
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-settings-variant"></i><span class="hide-menu"> Administration </span></a>
                        <ul aria-expanded="false" class="collapse first-level">
                            @if(in_array("districtEntry", $access) || $admin->role == 'SuperAdmin')
                            <li class="sidebar-item">
                                <a href="{{route('admin.district.index')}}" class="sidebar-link {{Request::is('admin.district.index') ? 'active':''}}"><i class="fas fa-list"></i><span class="hide-menu"> District Entry </span></a>
                            </li>
                            @endif
                            @if(in_array("thanaEntry", $access) || $admin->role == 'SuperAdmin')
                            <li class="sidebar-item">
                                <a href="{{route('admin.thana.index')}}" class="sidebar-link {{Request::is('admin.thana.index') ? 'active':''}}"><i class="fas fa-list"></i><span class="hide-menu"> Upazila Entry </span></a>
                            </li>
                            @endif
                            @if(in_array("customerList", $access) || $admin->role == 'SuperAdmin')
                            <li class="sidebar-item">
                                <a href="{{route('admin.customer.index')}}" class="sidebar-link {{Request::is('admin.customer.index') ? 'active':''}}"><i class="fas fa-user-circle"></i><span class="hide-menu"> Customer List</span></a>
                            </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if(in_array("orderList", $access) || in_array("orderAssign", $access) || in_array("orderComplete", $access) || in_array("orderCancel", $access) || in_array("assignWorkerService", $access) || $admin->role == 'SuperAdmin')
                    <li class="sidebar-item {{Request::is('admin.order.index') || Request::is('admin.order.delivery') || Request::is('admin.order.canceled') ? 'selected':''}}">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-cart-plus"></i><span class="hide-menu"> Order Module </span></a>
                        <ul aria-expanded="false" class="collapse first-level">

                            @if(in_array("orderAssign", $access) || $admin->role == 'SuperAdmin')
                                <li class="sidebar-item {{Request::is('admin.order.assign') ? 'active':''}}">
                                    <a href="{{route('admin.order.assign')}}" class="sidebar-link {{Request::is('admin.order.assign') ? 'active':''}}">
                                        <i class="fas fa-dolly-flatbed"></i>
                                        <span class="hide-menu"> Assign Order </span>
                                    </a>
                                </li>
                            @endif

                            @if(in_array("orderList", $access) || $admin->role == 'SuperAdmin')
                                <li class="sidebar-item {{Request::is('admin.order.index') ? 'active':''}}">
                                    <a href="{{route('admin.order.index')}}" class="sidebar-link {{Request::is('admin.order.index') ? 'active':''}}"><i class="fas fa-cart-plus"></i><span class="hide-menu"> Order List </span></a>
                                </li>
                            @endif

                            @if(in_array("orderComplete", $access) || $admin->role == 'SuperAdmin')
                                <li class="sidebar-item {{Request::is('admin.order.delivery') ? 'active':''}}">
                                    <a href="{{route('admin.order.delivery')}}" class="sidebar-link {{Request::is('admin.order.delivery') ? 'active':''}}"><i class="fas fa-cart-plus"></i><span class="hide-menu"> Completed Order </span></a>
                                </li>
                            @endif

                            @if(in_array("orderCancel", $access) || $admin->role == 'SuperAdmin')
                                <li class="sidebar-item {{Request::is('admin.order.canceled') ? 'active':''}}">
                                    <a href="{{route('admin.order.canceled')}}" class="sidebar-link {{Request::is('admin.order.canceled') ? 'active':''}}"><i class="fas fa-cart-plus"></i><span class="hide-menu"> Canceled Order </span></a>
                                </li>
                            @endif

                            @if(in_array("assignWorkerService", $access) || $admin->role == 'SuperAdmin')
                                <li class="sidebar-item {{Request::is('admin.worker.assignservice') ? 'selected':''}}">
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link {{Request::is('admin.worker.assignservice') ? 'active':''}}" href="{{route('admin.worker.assignservice')}}" aria-expanded="false"><i class="fas fa-briefcase"></i><span class="hide-menu">Assign Worker List</span></a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if(in_array("reportShow", $access) || in_array("paymentShow", $access) || $admin->role == 'SuperAdmin')
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-file"></i><span class="hide-menu"> Report </span></a>
                        <ul aria-expanded="false" class="collapse first-level">
                            @if(in_array("reportShow", $access) || $admin->role == 'SuperAdmin')
                            <li class="sidebar-item">
                                <a href="{{route('admin.order.report')}}" class="sidebar-link {{Request::is('admin.order.report') ? 'active':''}}"><i class="fas fa-file"></i><span class="hide-menu"> Commission Report </span></a>
                            </li>
                            @endif
                            @if(in_array("paymentShow", $access) || $admin->role == 'SuperAdmin')
                            <li class="sidebar-item">
                                <a href="{{route('admin.commission.list')}}" class="sidebar-link {{Request::is('admin.commission.list') ? 'active':''}}"><i class="fas fa-file"></i><span class="hide-menu"> Commission Payment List </span></a>
                            </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if(in_array("userEntry", $access) || $admin->role == 'SuperAdmin')
                    <li class="sidebar-item {{Request::is('admin.payment.collection') ? 'selected':''}}" title="Worker Payment Collection">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{Request::is('admin.payment.collection') ? 'active':''}}" href="{{route('admin.payment.collection')}}" aria-expanded="false">
                            <i class="mdi mdi-currency-usd" style="font-size: 23px;"></i>
                            <span class="hide-menu">Payment Collection</span>
                        </a>
                    </li>
                @endif

                @if(in_array("userEntry", $access) || $admin->role == 'SuperAdmin')
                    <li class="sidebar-item {{Request::is('admin.worker.commission') ? 'selected':''}}" title="Worker Commission List">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{Request::is('admin.worker.commission') ? 'active':''}}" href="{{route('admin.worker.commission')}}" aria-expanded="false">
                            <i class="mdi mdi-currency-usd" style="font-size: 23px;"></i>
                            <span class="hide-menu">Worker Commission</span>
                        </a>
                    </li>
                @endif

                @if(in_array("workerEntry", $access) || $admin->role == 'SuperAdmin')

                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="fas fa-wrench"></i>
                            <span class="hide-menu"> Worker </span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item">
                                <a href="{{route('admin.worker.list')}}" class="sidebar-link {{Request::is('admin.worker.list') ? 'active':''}}">
                                    <i class="fas fa-list"></i><span class="hide-menu">Worker List</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{route('admin.worker.pending.list')}}" class="sidebar-link {{Request::is('admin.worker.pending.list') ? 'active':''}}">
                                    <i class="fas fa-list"></i><span class="hide-menu">Pending Worker</span>
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <a href="{{route('admin.worker.create')}}" class="sidebar-link {{Request::is('admin.worker.create') ? 'active':''}}">
                                    <i class="fas fa-plus"></i><span class="hide-menu">Worker Create</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- <li class="sidebar-item {{Request::is('admin.worker.create') ? 'selected':''}}">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{Request::is('admin.worker.create') ? 'active':''}}" href="{{route('admin.worker.create')}}" aria-expanded="false">
                            <i class="fas fa-wrench"></i><span class="hide-menu">Worker Create</span>
                        </a>
                    </li> --}}
                @endif

                @if(in_array("areaManagerEntry", $access) || $admin->role == 'SuperAdmin')

                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-account-multiple-plus"></i>
                            <span class="hide-menu"> Area Manager </span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item">
                                <a href="{{route('admin.manager.list')}}" class="sidebar-link {{Request::is('admin.manager.list') ? 'active':''}}">
                                    <i class="fas fa-list"></i><span class="hide-menu">Area Manager List</span>
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <a href="{{route('admin.manager.create')}}" class="sidebar-link {{Request::is('admin.manager.create') ? 'active':''}}">
                                    <i class="fas fa-plus"></i>
                                    <span class="hide-menu">Area Manager Create</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(in_array("userEntry", $access) || $admin->role == 'SuperAdmin')
                    <li class="sidebar-item {{Request::is('admin.user.create') ? 'selected':''}}">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link {{Request::is('admin.user.create') ? 'active':''}}" href="{{route('admin.user.create')}}" aria-expanded="false"><i class="mdi mdi-account-plus"></i><span class="hide-menu">User Create</span></a>
                    </li>
                @endif

                @if(in_array("settingUpdate", $access) || $admin->role == 'SuperAdmin')
                <li class="sidebar-item {{Request::is('admin.setting') ? 'selected':''}}">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link {{Request::is('admin.setting') ? 'active':''}}" href="{{route('admin.setting')}}" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Settings</span></a>
                </li>
                @endif
                <li class="sidebar-item {{Request::is('admin.logout') ? 'selected':''}}">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('admin.logout')}}" aria-expanded="false"><i class="mdi mdi-logout-variant"></i><span class="hide-menu">Logout</span></a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
