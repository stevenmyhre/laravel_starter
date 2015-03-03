<?php
use App\PERS\Customer;
use App\PERS\Dealer;
use App\PERS\User;
use App\PERS\UserType;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder {
    public function run()
    {
        DB::transaction(function () {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('customer')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            $faker = Faker\Factory::create();
//            $customers = array();
//            for ($i = 0; $i < 15; $i++) {
//                $customers[] = Customer::create([
//                    'full_name'          => $faker->name,
//                    'prem_type'          => 'Residential',
//                    'dealer_id'          => (int)$faker->randomElement(Dealer::all(array('id'))->toArray()),
//                    'customer_plan_id'   => 1,
//                    'home_phone'         => $faker->optional()->numerify('##########'),
//                    'work_phone'         => $faker->optional($weight = 0.2)->numerify("##########"),
//                    'email'              => $faker->email,
//                    'email_secondary'    => $faker->optional($weight = 0.2)->email,
//                    'notes'              => $faker->optional($weight = 0.2)->text,
//                    'mobile_phone'       => $faker->numerify('##########'),
//                    'mobile_phone1_name' => $faker->name,
//                    'mobile_phone2'      => $faker->numerify('##########'),
//                    'mobile_phone2_name' => $faker->name,
//                ]);
//            }
//            $customers[0]->user_id = User::whereEmail('test@test.com')->first()->id;
//            $customers[0]->save();
        });
    }
}