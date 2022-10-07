<?php

return [
    'roles' => [
        'admin' => 'Admin',
        'staff' => 'Nhân sự',
        'financial' => 'Tài chính',
        'user' => 'Khách hàng'
    ],

    /*
     * Admin mặc định khi chạy seed
     * Quản trị toàn hệ thông
     */
    'admin' => [
        'phone' => '0123456',
        'pass' => '123456'
    ],

    'statusInvoice' => [
        'pending' => 'Đang xử lý',
        'transport' => 'Đang vận chuyển',
        'paid' => 'Hoàn thành',
    ]
];
