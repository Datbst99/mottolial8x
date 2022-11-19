<nav class="sidebar sidebar-offcanvas" id="sidebar" style="position: relative">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top border-bottom">
        <a class="sidebar-brand brand-logo" href=""><img src="/assets/images/logo_motto.png" alt="logo" /></a>
        <a class="sidebar-brand brand-logo-mini" href=""><img src="/assets/images/logo_motto.png" alt="logo" /></a>
    </div>
    <ul class="nav mt-3" style="position: fixed">
{{--        <li class="nav-item profile">--}}
{{--            <div class="profile-desc">--}}
{{--                <div class="profile-pic">--}}
{{--                    <div class="count-indicator">--}}
{{--                        <img class="img-xs rounded-circle " src="/assets/images/faces/face15.jpg" alt="">--}}
{{--                        <span class="count bg-success"></span>--}}
{{--                    </div>--}}
{{--                    <div class="profile-name">--}}
{{--                        <h5 class="mb-0 font-weight-normal">{{auth()->user()->name}}</h5>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </li>--}}

        <li class="nav-item menu-items {{active('admin.dashboard')}}">
            <a class="nav-link" href="{{route('admin.dashboard')}}">
                <span class="menu-icon">
                  <i class="mdi mdi-speedometer"></i>
                </span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item menu-items {{ active(['invoice.index']) }}">
            <a class="nav-link" data-toggle="collapse" href="#ui-order" aria-expanded="{{ active(['invoice.index'], 'true', 'false')}}" aria-controls="ui-order">
              <span class="menu-icon">
                <i class="mdi mdi-cart-plus"></i>
              </span>
                <span class="menu-title">Quản lý đơn hàng</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse show" id="ui-order">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('invoice.index')}}">Tất cả</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('invoice.create')}}">Thêm đơn hàng</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item menu-items {{ active(['product.index', 'product.create', 'product.edit']) }}">
            <a class="nav-link" data-toggle="collapse" href="#ui-product" aria-expanded="{{ active(['product.index', 'product.create', 'product.edit'], 'true', 'false')}}" aria-controls="ui-product">
              <span class="menu-icon">
                <i class="mdi mdi-table-large"></i>
              </span>
                <span class="menu-title">Quản lý sản phẩm</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse show" id="ui-product">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('product.index')}}">Tất cả</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('product.create')}}">Thêm sản phẩm</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item menu-items {{ active('category.user') }}">
            <a class="nav-link" href="{{route('category.index')}}">
                <span class="menu-icon">
                  <i class="mdi mdi-sitemap"></i>
                </span>
                <span class="menu-title">Quản lý danh mục</span>
            </a>
        </li>

        <li class="nav-item menu-items {{ active(['promotion.index']) }}">
            <a class="nav-link"  href="{{route('promotion.index')}}">
              <span class="menu-icon">
                <i class="mdi mdi-wallet-giftcard"></i>
              </span>
                <span class="menu-title">Khuyến mại</span>
            </a>
        </li>

        <li class="nav-item menu-items {{ active('admin.user') }}">
            <a class="nav-link" href="{{route('admin.user')}}">
                <span class="menu-icon">
                  <i class="mdi mdi-account-multiple"></i>
                </span>
                <span class="menu-title">Quản lý khách hàng</span>
            </a>
        </li>
        <li class="nav-item menu-items {{ active('admin.order') }}">
            <a class="nav-link" href="{{route('admin.order')}}">
                <span class="menu-icon">
                <i class="mdi mdi-cart-plus"></i>
              </span>
                <span class="menu-title">Đơn đặt hàng landing</span>
            </a>
        </li>
    </ul>
</nav>
