<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';
    //protected $namespaceNhanvien = 'App\Http\Controllers\Nhanvien';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapThanhvienRoutes();

        $this->mapNguyenlieuRoutes();

        $this->mapBanRoutes();

        $this->mapBaivietRoutes();

        $this->mapDailyRoutes();

        $this->mapGopyRoutes();

        $this->mapKhuyenmaiRoutes();

        $this->mapLoaiRoutes();

        $this->mapNhapRoutes();
        $this->mapCongthucRoutes();

        $this->mapKhachhangRoutes();

        $this->mapHoadonRoutes();
        $this->mapOrderRoutes();
        $this->mapThucdonRoutes();
        $this->mapDonhangRoutes();
        $this->mapPhacheRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            //  ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

    
    /**
     * Define the "nv" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapThanhvienRoutes()
    {
        Route::prefix('thanhvien')
             ->namespace($this->namespace)
             ->group(base_path('routes/thanhvien-route.php'));
    }
     protected function mapNguyenlieuRoutes()
    {
        Route::prefix('nguyenlieu')
             ->namespace($this->namespace)
             ->group(base_path('routes/nguyenlieu-route.php'));
    }
    protected function mapBanRoutes()
    {
        Route::prefix('ban')
             ->namespace($this->namespace)
             ->group(base_path('routes/ban-route.php'));
    }
    protected function mapBaivietRoutes()
    {
        Route::prefix('baiviet')
             ->namespace($this->namespace)
             ->group(base_path('routes/baiviet-route.php'));
    }
    protected function mapDailyRoutes()
    {
        Route::prefix('daily')
             ->namespace($this->namespace)
             ->group(base_path('routes/daily-route.php'));
    }
    protected function mapGopyRoutes()
    {
        Route::prefix('gopy')
             ->namespace($this->namespace)
             ->group(base_path('routes/gopy-route.php'));
    }
    protected function mapKhuyenmaiRoutes()
    {
        Route::prefix('khuyenmai')
             ->namespace($this->namespace)
             ->group(base_path('routes/khuyenmai-route.php'));
    }
    protected function mapLoaiRoutes()
    {
        Route::prefix('loai')
             ->namespace($this->namespace)
             ->group(base_path('routes/loai-route.php'));
    }
    protected function mapThucdonRoutes()
    {
        Route::prefix('thucdon')
             ->namespace($this->namespace)
             ->group(base_path('routes/thucdon-route.php'));
    }
    protected function mapNhapRoutes()
    {
        Route::prefix('nhap')
             ->namespace($this->namespace)
             ->group(base_path('routes/nhap-route.php'));
    }
    protected function mapCongthucRoutes()
    {
        Route::prefix('congthuc')
             ->namespace($this->namespace)
             ->group(base_path('routes/congthuc-route.php'));
    }
    protected function mapKhachhangRoutes()
    {
        Route::prefix('khachhang')
             ->namespace($this->namespace)
             ->group(base_path('routes/khachhang-route.php'));
    }
    protected function mapHoadonRoutes()
    {
        Route::prefix('hoadon')
             ->namespace($this->namespace)
             ->group(base_path('routes/hoadon-route.php'));
    }
    protected function mapOrderRoutes()
    {
        Route::prefix('hoadon')
             ->namespace($this->namespace)
             ->group(base_path('routes/order-route.php'));
    }
    protected function mapPhacheRoutes()
    {
        Route::prefix('phache')
             ->namespace($this->namespace)
             ->group(base_path('routes/phache-route.php'));
    }
    protected function mapDonhangRoutes()
    {
        Route::prefix('donhang')
             ->namespace($this->namespace)
             ->group(base_path('routes/donhang-route.php'));
    }
}
