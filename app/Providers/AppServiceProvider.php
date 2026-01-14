<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator; // <--- 1. Thêm dòng này ở trên cùng

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrap(); // <--- 2. Thêm dòng này vào trong hàm boot
    }
}