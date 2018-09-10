<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\User;
use App\Bill;
use Validator;
use Illuminate\Support\Facades\Auth;
Use App\Transfer;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Validator::extend('summaform', function ($attribute, $value, $parameters, $validator) {
            $user_id = Auth::id();
            $bill = User::find($user_id)->bill;
            if ($bill->balance < $value) {
                return false;
            } else {
                return true;
            }
        });
        Validator::extend('summatransferform', function ($attribute, $value, $parameters, $validator) {
            $user_id = Auth::id();
            $bill=User::find($user_id)->bill;
            $transfer= Transfer::where('status', 0)->
                    where('id_bill_sender',$bill->id)->
                    sum('summ');
            $balance=$bill->balance;
            $summTransfer=$transfer+$value;
            
            if ($balance<$summTransfer)
            {
                return FALSE;
            }
            return true;   
        });
        Validator::extend('userform', function ($attribute, $value, $parameters, $validator) {
            $user_id = Auth::id();
            $user = User::where('id', '<>', $user_id)->get();
            return $user->contains($value);
        });
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
