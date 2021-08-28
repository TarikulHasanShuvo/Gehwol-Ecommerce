<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="/"><img src="{{ asset('/img/svg/logo.svg') }}" alt="Logo" width="100%" height="80px" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item {{ (request()->is('admin/dashboard')) ? 'active' : '' }} ">
                    <a href="{{ route('admin.dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-speedometer"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item {{ (request()->is('admin/category')) ? 'active' : ''}} ">
                    <a href="{{ route('admin.category') }}" class='sidebar-link'>
                        <i class="bi bi-ui-checks-grid"></i>
                        <span>Category</span>
                    </a>
                </li>

                <li class="sidebar-item {{ (request()->is('admin/product*')) ? 'active' : ''}}">
                    <a href="{{ route('admin.product') }}" class='sidebar-link'>
                        <i class="bi bi-cart-plus-fill"></i>
                        <span>Product</span>
                    </a>
                </li>

                <li class="sidebar-item {{ (request()->is('admin/order*')) ? 'active' : ''}}">
                    <a href="{{ route('admin.order') }}" class='sidebar-link'>
                        <i class="bi bi-bag-plus"></i>
                        <span>Order</span>
                    </a>
                </li>

                <li class="sidebar-item {{ (request()->is('admin/contact*')) ? 'active' : ''}}">
                    <a href="{{ route('admin.contact') }}" class='sidebar-link'>
                        <i class="bi bi-telephone-inbound"></i>
                        <span>Contact</span>
                    </a>
                </li>
                <li class="sidebar-item {{ (request()->is('admin/blog*')) ? 'active' : ''}}">
                    <a href="{{ route('admin.blog') }}" class='sidebar-link'>
                        <i class="bi bi-pencil-square"></i>
                        <span>Blog</span>
                    </a>
                </li>

                <li class="sidebar-item {{ (request()->is('admin/gift-certificate*')) ? 'active' : ''}}">
                    <a href="{{ route('admin.gift-certificate') }}" class='sidebar-link'>
                        <i class="bi bi-gift"></i>
                        <span>Gift Certificate</span>
                    </a>
                </li>

                <li class="sidebar-item {{ (request()->is('admin/wholesale*')) ? 'active' : ''}}">
                    <a href="{{ route('admin.wholesale') }}" class='sidebar-link'>
                        <i class="bi bi-truck"></i>
                        <span>Wholesale</span>
                    </a>
                </li>

                <li class="sidebar-item {{ (request()->is('admin/subscription*')) ? 'active' : ''}}">
                    <a href="{{ route('admin.subscription') }}" class='sidebar-link'>
                        <i class="bi bi-check2-square"></i>
                        <span>Subscriptions</span>
                    </a>
                </li>

                <li class="sidebar-item {{ (request()->is('admin/event*')) ? 'active' : ''}}">
                    <a href="{{ route('admin.event') }}" class='sidebar-link'>
                        <i class="bi bi-check2-square"></i>
                        <span>Events</span>
                    </a>
                </li>

                {{--<li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Components</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="component-alert.html">Alert</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-badge.html">Badge</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-breadcrumb.html">Breadcrumb</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-button.html">Button</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-card.html">Card</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-carousel.html">Carousel</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-dropdown.html">Dropdown</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-list-group.html">List Group</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-modal.html">Modal</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-navs.html">Navs</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-pagination.html">Pagination</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-progress.html">Progress</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-spinner.html">Spinner</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-tooltip.html">Tooltip</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-collection-fill"></i>
                        <span>Extra Components</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="extra-component-avatar.html">Avatar</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="extra-component-sweetalert.html">Sweet Alert</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="extra-component-toastify.html">Toastify</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="extra-component-rating.html">Rating</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="extra-component-divider.html">Divider</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Layouts</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="layout-default.html">Default Layout</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="layout-vertical-1-column.html">1 Column</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="layout-vertical-navbar.html">Vertical with Navbar</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="layout-horizontal.html">Horizontal Menu</a>
                        </li>
                    </ul>
                </li>--}}

                <li class="sidebar-item">
                    <form method="POST" class="btn d-grid btn-danger"  action="{{ route('admin.logout') }}">
                        @csrf
                        <a :href="route('admin.logout')"
                                               onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                            {{ __('Log out') }}
                        </a>
                    </form>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
