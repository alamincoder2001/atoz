<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item {{Request::is('admin.dashboard') ? 'selected':''}}">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link {{Request::is('admin.dashboard') ? 'active':''}}" href="{{route('admin.dashboard')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-earth"></i><span class="hide-menu"> Website Content </span></a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{route('admin.slider.index')}}" class="sidebar-link {{Request::is('admin.slider.index') ? 'active':''}}"><i class="fas fa-sliders-h"></i><span class="hide-menu"> Slider Entry</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{route('admin.banner.index')}}" class="sidebar-link {{Request::is('admin.banner.index') ? 'active':''}}"><i class="fas fa-sliders-h"></i><span class="hide-menu"> Banner Entry</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{route('admin.category.index')}}" class="sidebar-link {{Request::is('admin.category.index') ? 'active':''}}"><i class="fas fa-list-alt"></i><span class="hide-menu"> Category Entry</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{route('admin.partner.index')}}" class="sidebar-link {{Request::is('admin.partner.index') ? 'active':''}}"><i class="fas fa-handshake"></i><span class="hide-menu"> Partner Entry </span></a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{route('admin.blog.index')}}" class="sidebar-link {{Request::is('admin.blog.index') ? 'active':''}}"><i class="fas fa-handshake"></i><span class="hide-menu"> News & Events Entry</span></a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fab fa-product-hunt"></i><span class="hide-menu"> Service Module </span></a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{route('admin.service.index')}}" class="sidebar-link {{Request::is('admin.service.index') ? 'active':''}}"><i class="fab fa-product-hunt"></i><span class="hide-menu"> Service Entry </span></a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{route('admin.service.published')}}" class="sidebar-link {{Request::is('admin.service.published') ? 'active':''}}"><i class="fas fa-upload"></i><span class="hide-menu"> Service Published Entry </span></a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-settings-variant"></i><span class="hide-menu"> Administration </span></a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{route('admin.district.index')}}" class="sidebar-link {{Request::is('admin.district.index') ? 'active':''}}"><i class="fas fa-list"></i><span class="hide-menu"> District Entry </span></a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{route('admin.thana.index')}}" class="sidebar-link {{Request::is('admin.thana.index') ? 'active':''}}"><i class="fas fa-list"></i><span class="hide-menu"> Upazila Entry </span></a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{route('admin.customer.index')}}" class="sidebar-link {{Request::is('admin.customer.index') ? 'active':''}}"><i class="fas fa-user-circle"></i><span class="hide-menu"> Customer List</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{route('admin.technician.index')}}" class="sidebar-link {{Request::is('admin.technician.index') ? 'active':''}}"><i class="fas fa-wrench"></i><span class="hide-menu"> Technician List</span></a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-cart-plus"></i><span class="hide-menu"> Order Module </span></a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{route('admin.order.index')}}" class="sidebar-link {{Request::is('admin.order.index') ? 'active':''}}"><i class="fas fa-cart-plus"></i><span class="hide-menu"> Pending Order</span></a>
                            <a href="{{route('admin.order.proccessing')}}" class="sidebar-link {{Request::is('admin.order.proccessing') ? 'active':''}}"><i class="fas fa-cart-plus"></i><span class="hide-menu"> On Proccessing Order </span></a>
                            <a href="{{route('admin.order.delivery')}}" class="sidebar-link {{Request::is('admin.order.delivery') ? 'active':''}}"><i class="fas fa-cart-plus"></i><span class="hide-menu"> Delivered Order </span></a>
                            <a href="{{route('admin.order.canceled')}}" class="sidebar-link {{Request::is('admin.order.canceled') ? 'active':''}}"><i class="fas fa-cart-plus"></i><span class="hide-menu"> Canceled Order </span></a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-file"></i><span class="hide-menu"> Report </span></a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{route('admin.order.report')}}" class="sidebar-link {{Request::is('admin.order.report') ? 'active':''}}"><i class="fas fa-file"></i><span class="hide-menu"> Commission Report </span></a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item {{Request::is('admin.user.create') ? 'selected':''}}">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link {{Request::is('admin.user.create') ? 'active':''}}" href="{{route('admin.user.create')}}" aria-expanded="false"><i class="mdi mdi-account-plus"></i><span class="hide-menu">User Create</span></a>
                </li>

                <li class="sidebar-item {{Request::is('admin.setting') ? 'selected':''}}">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link {{Request::is('admin.setting') ? 'active':''}}" href="{{route('admin.setting')}}" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Settings</span></a>
                </li>                

                <li class="sidebar-item {{Request::is('admin.setting') ? 'selected':''}}">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('admin.logout')}}" aria-expanded="false"><i class="mdi mdi-logout-variant"></i><span class="hide-menu">Logout</span></a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>