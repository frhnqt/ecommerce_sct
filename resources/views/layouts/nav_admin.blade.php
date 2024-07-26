<nav class="main-sidebar ps-menu">
<div class="sidebar-header">
        <div class="logo">
            <img src="{{ asset('resources/template_admin/img/sct.png') }}" alt="Logo" class="sidebar-logo">
        </div>
        <div class="close-sidebar action-toggle">
            <i class="fa-solid fa-times"></i>
        </div>
    </div>
    <div class="sidebar-content">
        <ul>
            <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ url('/admin/dashboard') }}" class="link">
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="menu-category">
                <span class="text-uppercase">Data Master</span>
            </li>

            <li class="{{ request()->is('dataadmin', 'admin',) ? 'active' : '' }}">
                <a href="#" class="main-menu has-dropdown">
                    <i class="fa-solid fa-users"></i>
                    <span>Admin</span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ request()->is('dataadmin') ? 'active' : '' }}">
                        <a href="{{ url('/dataadmin') }}" class="link">
                            <span>Data Admin</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin.add') ? 'active' : '' }}">
                        <a href="{{ url('/admin/add') }}" class="link">
                            <span>Add Admin</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{ request()->is('datacustomer', 'customer', 'customer/*') ? 'active' : '' }}">
                <a href="#" class="main-menu has-dropdown">
                    <i class="fa-solid fa-users"></i>
                    <span>Customer</span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ request()->is('datacustomer') ? 'active' : '' }}">
                        <a href="{{ url('/datacustomer') }}" class="link">
                            <span>Data Customer</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('customer/add') ? 'active' : '' }}">
                        <a href="{{ url('/customer/add') }}" class="link">
                            <span>Add Customer</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{ request()->is('dataproduct', 'product/add', 'product/*') ? 'active' : '' }}">
                <a href="#" class="main-menu has-dropdown">
                    <i class="fa-solid fa-laptop-code"></i>
                    <span>Product</span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ request()->is('dataproduct') ? 'active' : '' }}">
                        <a href="{{ url('/dataproduct') }}" class="link">
                            <span>Data Product</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('product/add') ? 'active' : '' }}">
                        <a href="{{ url('/product/add') }}" class="link">
                            <span>Add Product</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{ request()->is('datamerk', 'merk/add', 'merk/*') ? 'active' : '' }}">
                <a href="#" class="main-menu has-dropdown">
                    <i class="fa-solid fa-money-check"></i>
                    <span>Merk</span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ request()->is('datamerk') ? 'active' : '' }}">
                        <a href="{{ url('/datamerk') }}" class="link">
                            <span>Data Merk</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('merk/add') ? 'active' : '' }}">
                        <a href="{{ url('/merk/add') }}" class="link">
                            <span>Add Merk</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{ request()->is('datacategory', 'category/add') ? 'active' : '' }}">
                <a href="#" class="main-menu has-dropdown">
                    <i class="fa-solid fa-tag"></i>
                    <span>Category</span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ request()->is('datacategory') ? 'active' : '' }}">
                        <a href="{{ url('/datacategory') }}" class="link">
                            <span>Data Category</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('category/add') ? 'active' : '' }}">
                        <a href="{{ url('/category/add') }}" class="link">
                            <span>Add Category</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-category">
                <span class="text-uppercase">Data Order</span>
            </li>
            <li>
                <a href="#" class="main-menu has-dropdown">
                    <i class="fa-solid fa-list-check"></i>
                    <span>Order</span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ request()->is('orders.datapesananmasuk') ? 'active' : '' }}">
                        <a href="{{ url('datapesanan') }}" class="link">
                            <span>Incoming Order</span>
                        </a>
                    </li>
                    
                    <li class="{{ request()->is('orders.datapesananmasuk') ? 'active' : '' }}">
                        <a href="{{ url('datapesanandikonfirmasi') }}" class="link">
                            <span>Confirmed Order</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('orders.datapesananmasuk') ? 'active' : '' }}">
                        <a href="{{ url('datapesanandikemas') }}" class="link">
                            <span>Packed Order</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('orders.datapesananmasuk') ? 'active' : '' }}">
                        <a href="{{ url('datapesanandikirim') }}" class="link">
                            <span>Sent Order</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('orders.datapesananmasuk') ? 'active' : '' }}">
                        <a href="{{ url('datapesananselesai') }}" class="link">
                            <span>Completed Order</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- <li>
                <a href="#" class="main-menu has-dropdown">
                    <i class="fa-solid fa-angles-left"></i>
                    <span>Return</span>
                </a>
                <ul class="sub-menu ">
                    <li><a href="pages-blank.html" class="link"><span>Return History</span></a></li>
                    <li><a href="pages-blank.html" class="link"><span>Add Return</span></a></li>
                </ul>
            </li> -->

            <!-- <li>
                <a href="fullcalendar.html" class="link">
                    <i class="fa-solid fa-comments"></i>
                    <span>Review</span>
                </a>
            </li> -->

            <li class="menu-category">
                <span class="text-uppercase">Extra</span>
            </li>

            <li class="{{ request()->routeIs('datareport') ? 'active' : '' }}">
                <a href="{{ route('datareport') }}" class="link">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Reports</span>
                </a>
            </li>

            <!-- <li
                class="{{ request()->is('datametodepembayaran', 'metodepembayaran/add', 'metodepembayaran/*') ? 'active' : '' }}">
                <a href="#" class="main-menu has-dropdown">
                    <i class="fa-solid fa-wallet"></i>
                    <span>Payment</span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ request()->is('datametodepembayaran') ? 'active' : '' }}">
                        <a href="{{ url('/datametodepembayaran') }}" class="link">
                            <span>Payment Method</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('metodepembayaran/add') ? 'active' : '' }}">
                        <a href="{{ url('/metodepembayaran/add') }}" class="link">
                            <span>Add Method</span>
                        </a>
                    </li>
                </ul>
            </li> -->

        </ul>
    </div>
</nav>