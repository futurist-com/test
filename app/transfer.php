<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Bill;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class transfer extends Model
{
    //
    public $timestamps = false;

    static public function getTransfer()
    {
        $user_id = Auth::id();
        $bill = User::find($user_id)->bill;
        $tarnsfer = DB::select("select transfers.id, transfers.summ, transfers.date_plan_executed, transfers.`status`, users.name  from transfers 
        join bills on transfers.id_bill_recipient=bills.id
        join users on bills.user_id=users.id
        where transfers.id_bill_sender=:idBill  and transfers.status=0
        order by transfers.id  desc", ['idBill'=>$bill->id]);
        return json_encode($tarnsfer);
    }
}
