<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bill;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Transfer;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Validator;
use Illuminate\Validation\Rule;

class TransferController extends Controller {

    public function __construct(){
        
    }
    /** 
     * get  transfer list not supported
     * @return json transfer list
    */
    public function getTransfer() {
        
        if (!Auth::check()) {
            return response()->json(null, 401);
         }
        return $transfer = Transfer::getTransfer();
    }

    /**
     * record  transfer, validation input
     * 
     * @return json status oeration
     */
    public function posttransfer(Request $request) {
        
        
        //dd($request->all());
        $messages = [
            'summ.required' => 'Поле сумма не должно быть пустое',
            'summ.numeric' => 'Поле сумма должно быть числовое, если  с копейками набирейте через .',
            'summ.min' => 'Нельзя переводить  меньше или равно 0.01 копеек',
            'summ.summaform' => 'у вас не достаточно средств',
            'user_id.required' => "введите номер  кому хотите перевести средства",
            'user_id.userform' => "Нет такого пользователя в нашей базе даных",
            'user_id.integer' => "Поле Пользователя можно вводит только целые числа - номер",
            'summ.summatransferform'=>"Сумма запланированных переводов  больше чем на вашем счету"
        ];
        Validator::make($request->all(), [
            'summ' => 'required|numeric|min:0.01|summaform|summatransferform',
            'user_id' => 'required|integer|userform',
        ], $messages
        )->validate();
        $user_id = Auth::id();
        $transfer= new Transfer;
        $transfer->id_bill_sender=$user_id;
        $bill=User::find($request->user_id)->bill;
        if ($bill){
            $idBill=$bill->id;
        }
        else{
            $newBill=new Bill;
            $newBill->balance=0;
            $newBill->user_id=$request->user_id;
            $newBill->save();
            $idBill=$newBill->id;
        }
        $transfer->id_bill_recipient=$idBill;
        $billSender=User::find($user_id)->bill;
        $transfer->id_bill_sender=$billSender->id;
        $transfer->summ=$request->summ;
        $transfer->status=0;
        $transfer->save();
        return 201;
        
    }
    /**
     * supported transfer 
     * 
     *  @return json transfer list before suppotted transfer
     */
    public function confirmtransfer($id) {
        $transfer = Transfer::findOrFail($id);
        $billSender=Bill::findOrfail($transfer->id_bill_sender);
        if($billSender->balance<$transfer->summ)
        {
            return response()->json(null, 400);
        }
        $billRecipient=Bill::findOrfail($transfer->id_bill_recipient);
        $billSender->balance=$billSender->balance - $transfer->summ;
        $billSender->save();
        $billRecipient->balance=$billRecipient->balance + $transfer->summ;
        $billRecipient->save();
        $transfer->status = 1;
        $transfer->date_executed = Carbon::now();
        $transfer->save();


        return Transfer::getTransfer();
    }
    /**
     * delete transfer 
     * 
     *  @return json transfer list before suppotted transfer
     */
    public function deltransfer($id) {
        $transfer = Transfer::findOrFail($id);
        $transfer->delete();
        //return true;
        return Transfer::getTransfer();
    }

}
