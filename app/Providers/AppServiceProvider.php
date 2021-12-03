<?php

namespace App\Providers;

use App\Charts\ChartStatic;
use App\Models\Notifications;
use ConsoleTVs\Charts\Registrar as Charts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

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
    public function boot(Charts $charts)
    {
        $charts->register([
            ChartStatic::class
        ]);
        DB::statement("SET lc_time_names = 'fr_FR'");

        View::composer('*', function($view)
            {
                if(Auth::user())
                    $view->with('notify', Notifications::where('recipient', Auth::user()->id)->get());
                else
                return redirect('login');
            });

    }
}
