<?php

namespace App\Providers;

use App\Models\Website;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $data = Website::first();
            $hariini = $this->getDay();
            $view->with([
                'dataWebsite' => $data,
                'hariini' => $hariini,
            ]);
        });
    }

    protected function getDay()
    {
        $hari = Carbon::now()->locale('id')->isoFormat('dddd');
        $bulan = Carbon::now()->locale('id')->isoFormat('MMMM');
        return $hari . ', ' . Carbon::now()->day . ' ' . $bulan . ' ' . Carbon::now()->year;
    }

    protected function day($day)
    {
        $data = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu'
        ];
        return $data[$day];
    }
}
