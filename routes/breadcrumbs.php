<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail){
    $trail->push('Dashboard', route('admin.dashboard'));
});

Breadcrumbs::for('admin.user', function (BreadcrumbTrail $trail){
    $trail->parent('admin.dashboard');
    $trail->push('Quản lý khách hàng', route('admin.user'));
});
Breadcrumbs::for('admin.user.update', function (BreadcrumbTrail $trail){
    $trail->parent('admin.user');
    $trail->push('Cập nhật thông tin khách hàng');
});
Breadcrumbs::for('admin.category', function (BreadcrumbTrail $trail){
    $trail->parent('admin.dashboard');
    $trail->push('Quản lý danh mục', route('category.index'));
});

Breadcrumbs::for('admin.product', function (BreadcrumbTrail $trail){
    $trail->parent('admin.dashboard');
    $trail->push('Quản lý sản phẩm', route('product.index'));
});

Breadcrumbs::for('admin.product.add', function (BreadcrumbTrail $trail){
    $trail->parent('admin.product');
    $trail->push('Thêm sản phẩm');
});

Breadcrumbs::for('admin.product.edit', function (BreadcrumbTrail $trail){
    $trail->parent('admin.product');
    $trail->push('Cập nhật sản phẩm');
});

Breadcrumbs::for('admin.invoice', function (BreadcrumbTrail $trail){
    $trail->parent('admin.dashboard');
    $trail->push('Quản lý đơn hàng', route('invoice.index'));
});

Breadcrumbs::for('admin.invoice.create', function (BreadcrumbTrail $trail){
    $trail->parent('admin.invoice');
    $trail->push('Tạo đơn hàng', route('invoice.create'));
});

Breadcrumbs::for('admin.promotion', function (BreadcrumbTrail $trail){
    $trail->parent('admin.dashboard');
    $trail->push('Chương trình khuyễn mãi', route('promotion.index'));
});
