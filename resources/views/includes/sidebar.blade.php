<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="index.html"><img src="/assets/images/logo.svg" alt="logo" /></a>
        <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="/assets/images/logo-mini.svg" alt="logo" /></a>
    </div>
    <ul class="nav">
        <li class="nav-item profile">
            <div class="profile-desc">
                <div class="profile-pic">
                    <div class="count-indicator">
                        <img class="img-xs rounded-circle " src="/assets/images/faces/face15.jpg" alt="">
                        <span class="count bg-success"></span>
                    </div>
                    <div class="profile-name">
                        <h5 class="mb-0 font-weight-normal">Henry Klein</h5>
                        <span>Gold Member</span>
                    </div>
                </div>
                <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
                <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-settings text-primary"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-onepassword  text-info"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-calendar-today text-success"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                        </div>
                    </a>
                </div>
            </div>
        </li>

        <li class="nav-item menu-items {{active('admin.dashboard')}}">
            <a class="nav-link" href="{{route('admin.dashboard')}}">
                <span class="menu-icon">
                  <i class="mdi mdi-speedometer"></i>
                </span>
                <span class="menu-title">Dashboard</span>
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
        <li class="nav-item menu-items {{ active('category.user') }}">
            <a class="nav-link" href="{{route('category.index')}}">
                <span class="menu-icon">
                  <i class="mdi mdi-sitemap"></i>
                </span>
                <span class="menu-title">Quản lý danh mục</span>
            </a>
        </li>
        <li class="nav-item menu-items {{ active(['product.index', 'product.create', 'product.edit']) }}">
            <a class="nav-link" href="{{route('product.index')}}">
                <span class="menu-icon">
                  <i class="mdi mdi-table-large"></i>
                </span>
                <span class="menu-title">Quản lý sản phẩm</span>
            </a>
        </li>
        <li class="nav-item menu-items {{ active(['promotion.index']) }}">
            <a class="nav-link" href="{{route('promotion.index')}}">
                <span class="menu-icon">
                  <i class="mdi mdi-gift"></i>
                </span>
                <span class="menu-title">Chương trình khuyễn mãi</span>
            </a>
        </li>
        <li class="nav-item menu-items {{ active(['invoice.index']) }}">
            <a class="nav-link" href="{{route('invoice.index')}}">
                <span class="menu-icon">
                  <i class="mdi mdi-cart-plus"></i>
                </span>
                <span class="menu-title">Quản lý đặt hàng</span>
            </a>
        </li>

    </ul>
</nav>
