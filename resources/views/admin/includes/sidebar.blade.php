<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
        </div>
        <div class="pull-left info">
            <p>Alexander Pierce</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search..."/>
            <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
            </span>
        </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        </li>
        @can('table-access')
            <li class="treeview">
                <a href="#">
                    <i class="fas fa-table"></i> <span>@lang('sidebar.table-mgmt.title')</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('table.create')}}"><i class="fa fa-circle-o"></i> @lang('sidebar.table-mgmt.new_table')</a></li>
                    <li><a href="{{route('table.index')}}"><i class="fa fa-circle-o"></i> @lang('sidebar.table-mgmt.all_table')</a></li>
                </ul>
            </li>
        @endcan
        @can('user-access')
            <li class="treeview">
                <a href="#">
                    <i class="fas fa-user"></i> <span>@lang('sidebar.user-mgmt.title')</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="#">
                            <i class="fa fa-circle-o"></i> @lang('sidebar.user-mgmt.emp.title') 
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{route('employee.create')}}">
                                    <i class="fa fa-circle-o"></i> @lang('sidebar.user-mgmt.emp.add-emp')
                                </a>
                            </li>
                            <li><a href="{{route('employee.index')}}"><i class="fa fa-circle-o"></i> @lang('sidebar.user-mgmt.emp.all-emp')</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('role.index')}}">
                            <i class="fa fa-circle-o"></i> @lang('sidebar.user-mgmt.role')
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-circle-o"></i> @lang('sidebar.user-mgmt.permission') 
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{route('permission.index')}}">
                                    <i class="fa fa-circle-o"></i> @lang('sidebar.user-mgmt.permission')
                                </a>
                                </li>
                            <li>
                                <a href="{{route('p_component.index')}}">
                                    <i class="fa fa-circle-o"></i> @lang('sidebar.user-mgmt.permission_component')
                                </a>
                            </li>
                        </ul>
                        
                    </li>
                </ul>
            </li>
        @endcan
        @can('category-access')
            <li class="treeview">
                <a href="#">
                    <i class="fas fa-copyright"></i> <span>@lang('sidebar.cat-mng.title')</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    @can('category-view')
                        <li>
                            <a href="{{route('category.index')}}">
                                <i class="fa fa-circle-o"></i> @lang('sidebar.cat-mng.catg-list')
                            </a>
                        </li>
                    @endcan
                    @can('category-add', Model::class)
                        <li>
                            <a href="{{route('category.create')}}">
                                <i class="fa fa-circle-o"></i> @lang('sidebar.cat-mng.add-catg')
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('product-access')
            <li class="treeview">
                <a href="#">
                <i class="fas fa-file-powerpoint"></i> <span>@lang('sidebar.product-mgmt.title')</span>
                <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('product.index')}}"><i class="fa fa-circle-o"></i>@lang('sidebar.product-mgmt.product-list')</a></li>
                    
                    <li><a href="{{route('product.create')}}"><i class="fa fa-circle-o"></i>@lang('sidebar.product-mgmt.add-product')</a></li>
                </ul>
            </li>
        @endcan
        <li class="treeview">
            <a href="#">
                <i class="fas fa-file-powerpoint"></i> <span>Order Management</span>
                <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('order.index')}}"><i class="fa fa-circle-o"></i>All Orders</a></li>
                    
                    <li><a href="{{route('order.create')}}"><i class="fa fa-circle-o"></i>New Order</a></li>
                </ul>
        </li>
            <li class="treeview">
                <a href="#">
                <i class="fas fa-user-circle" style="margin-right: 6px;"></i> <span>Manage Profile</span>
                <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <!-- <li><a href="{{route('profileHeader.index')}}"><i class="fa fa-circle-o"></i>Header</a></li> -->
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i> Header <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('profileHeader.index')}}"><i class="fa fa-circle-o"></i>List Header Content</a></li>
                            <li><a href="{{route('profileHeader.create')}}"><i class="fa fa-circle-o"></i>Add Header Content</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i>Footer<i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('footerFind.index')}}"><i class="fa fa-circle-o"></i>List Footer Content</a></li>
                            <li><a href="{{route('footerFind.create')}}"><i class="fa fa-circle-o"></i>Add footer content</a></li>
                        </ul>
                    </li>
                    
                </ul>
            </li>
            <li class="treeview">
                <a href="{{route('message.index')}}">
                    <i class="fas fa-envelope" style="margin-right: 7px;"></i><span>View Messages</span>
                </a>
            </li>
            <!-- <li class="treeview">
                <a href="#">
                <i class="fab fa-hotjar" style="margin-right: 7px;"></i></i> <span>Manage Chef</span>
                <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> List Chefs</a></li>
                    
                    <li><a href="#"><i class="fa fa-circle-o"></i> Add New Chef</a></li>
                </ul>
            </li> -->
      <!--   <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> -->
    </ul>
    </section>
    <!-- /.sidebar -->
</aside>