<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Validator;

use \App\Booking;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $user = \App\User::where('created_at', '>=', \Carbon\Carbon::today())->get();
        \View::share('notification_new_users', $user);

        /**
         * Check room availability
         *
         * @return true if pass
         */
        Validator::extend('room_available', function($attribute, $value, $parameters, $validator) {
           
            $dates   = explode(' - ', $value);
            
            $start = $this->change_date_format($dates[0]);
            $end = $this->change_date_format($dates[1]);

            // new booking clash in the middle of existing booking
            $scene1 = Booking::where([
                            ['start_date', '<=', $start],
                            ['end_date', '>=', $end]
                        ])
                        ->count();
            
            // old booking clash in the middle new booking
            $scene2 = Booking::where([
                            ['start_date', '>=', $start],
                            ['end_date', '<=', $end]
                        ])
                        ->count();
            
            // end date old booking in the middle of new booking
            $scene3 = Booking::where([
                            ['end_date', '>', $start],
                            ['end_date', '<', $end]
                        ])
                        ->count();
            
            // start date old booking in the middle of new booking
            $scene4 = Booking::where([
                            ['start_date', '>', $start],
                            ['start_date', '<', $end]
                        ])
                        ->count();          
            
            // if any event exist, means more than 0, return false
            if($scene1 + $scene2 + $scene3 + $scene4 > 0)
            {
                return false;
            }


           return true;
        });

        Validator::extend('duration', function($attribute, $value, $parameters, $validator) {
            
            $time = explode(" - ", $value);
            
            $start = $this->change_date_format($time[0]);
            $end = $this->change_date_format($time[1]);
            
            if(abs(strtotime($end) - strtotime($start)) == 0)
            {
                return false;   
            }
            return true;
        });
    }

    public function change_date_format($date)
    {
        $time = \DateTime::createFromFormat('d/m/Y H:i:s', $date);
        return $time->format('Y-m-d H:i:s');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
