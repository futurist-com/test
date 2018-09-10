<?php

use Illuminate\Database\Seeder;

class UsersBillsTransfersTableSeeder extends Seeder
      
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = DB::table('users')->insertGetId([
            'name' => "Дармидонт Николаевич Корь",
            'email' => str_random(10) . '@gmail.com',
            'password' => bcrypt('secret'),
        ]);
        $idBills[] = DB::table('bills')->insertGetID([
            'user_id' => $id,
            'balance' => rand(1, 100000),
            'created_at' => Carbon::now(),
        ]);
        $id = DB::table('users')->insertGetId([
            'name' => "Виконт Андреевичвич Понт",
            'email' => str_random(10) . '@gmail.com',
            'password' => bcrypt('secret'),
        ]);
        $idBills[] = DB::table('bills')->insertGetID([
            'user_id' => $id,
            'balance' => rand(1, 100000),
            'created_at' => Carbon::now(),
        ]);
        $id = DB::table('users')->insertGetId([
            'name' => "Андрей Коропетович Мышанский",
            'email' => str_random(10) . '@gmail.com',
            'password' => bcrypt('secret'),
        ]);
        $idBills[] = DB::table('bills')->insertGetID([
            'user_id' => $id,
            'balance' => rand(1, 100000),
            'created_at' => Carbon::now(),
        ]);
        $id = DB::table('users')->insertGetId([
            'name' => "Эдуард Дормедондович Суровый",
            'email' => str_random(10) . '@gmail.com',
            'password' => bcrypt('secret'),
        ]);
        $idBills[] = DB::table('bills')->insertGetID([
            'user_id' => $id,
            'balance' => rand(1, 100000),
            'created_at' => Carbon::now(),
        ]);
        $id = DB::table('users')->insertGetId([
            'name' => "Василий Тимофеевич Конь",
            'email' => str_random(10) . '@gmail.com',
            'password' => bcrypt('secret'),
        ]);
        $idBills[] = DB::table('bills')->insertGetID([
            'user_id' => $id,
            'balance' => rand(1, 100000),
            'created_at' => Carbon::now(),
        ]);
        $id = DB::table('users')->insertGetId([
            'name' => "Иван Петрович Голомань",
            'email' => str_random(10) . '@gmail.com',
            'password' => bcrypt('secret'),
        ]);
        $idBills[] = DB::table('bills')->insertGetID([
            'user_id' => $id,
            'balance' => rand(1, 100000),
            'created_at' => Carbon::now(),
        ]);
        $id = DB::table('users')->insertGetId([
            'name' => "Дормедонт Иванович Тыц",
            'email' => str_random(10) . '@gmail.com',
            'password' => bcrypt('secret'),
        ]);
        $idBills[] = DB::table('bills')->insertGetID([
            'user_id' => $id,
            'balance' => rand(1, 100000),
            'created_at' => Carbon::now(),
        ]);
        $id = DB::table('users')->insertGetId([
            'name' => "Агрипина Матвеевна Ток",
            'email' => str_random(10) . '@gmail.com',
            'password' => bcrypt('secret'),
        ]);
        $idBills[] = DB::table('bills')->insertGetID([
            'user_id' => $id,
            'balance' => rand(1, 100000),
            'created_at' => Carbon::now(),
        ]);
        $id = DB::table('users')->insertGetId([
            'name' => "Василий Алибобаевич Кораблев",
            'email' => str_random(10) . '@gmail.com',
            'password' => bcrypt('secret'),
        ]);
        $idBills[] = DB::table('bills')->insertGetID([
            'user_id' => $id,
            'balance' => rand(1, 100000),
            'created_at' => Carbon::now(),
        ]);
        $id = DB::table('users')->insertGetId([
            'name' => "Вахрат Гарифудиннович Иванов",
            'email' => str_random(10) . '@gmail.com',
            'password' => bcrypt('secret'),
        ]);
        $idBills[] = DB::table('bills')->insertGetID([
            'user_id' => $id,
            'balance' => rand(1, 100000),
            'created_at' => Carbon::now(),
        ]);
        $id = DB::table('users')->insertGetId([
            'name' => "Константин Эдуардович Моль",
            'email' => str_random(10) . '@gmail.com',
            'password' => bcrypt('secret'),
        ]);
        $idBills[] = DB::table('bills')->insertGetID([
            'user_id' => $id,
            'balance' => rand(1, 100000),
            'created_at' => Carbon::now(),
        ]);




        foreach ($idBills as $idbill) {
            $idBillSender = $idbill;
            for ($i = 0; $i < 10; $i++) {
                $idBillRec=$idBills[array_rand($idBills)];
                if ($idBillRec!=$idBillSender)
                {
                     DB::table('transfers')->insert([
                    'id_bill_sender' => $idBillSender,
                    'id_bill_recipient' => $idBillRec,
                    'summ' => rand(1, 100000),
                    'status'=>1,
                    'date_executed'=>Carbon::now(),     
                    //'created_at' => Carbon::now(),
                  ]);
                }
                    
            }
        }
    }
}
