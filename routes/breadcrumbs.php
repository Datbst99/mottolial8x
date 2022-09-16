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
    $trail->push('Quản lý user', route('admin.user'));
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
