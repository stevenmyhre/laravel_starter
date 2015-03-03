<?php

use App\PERS\User;
use App\PERS\UserType;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Insertconstants extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //disable foreign key check for this connection before running seeders
        DB::transaction(function () {
            DB::table('user_type')->insert(array(
                array('user_type_name' => 'Admin'),
                array('user_type_name' => 'Customer'),
                array('user_type_name' => 'Dealer')
            ));

            User::forceCreate(array(
                'name'         => 'Steven Myhre',
                'email'        => 'admin@stevenssite.com',
                'password'     => bcrypt('asdfasdf'),
                'user_type_id' => UserType::$admin
            ));
            User::forceCreate(array(
                'name'         => 'Mike Myhre',
                'email'        => 'mikem@aeisecure.com',
                'password'     => bcrypt('asdfasdf'),
                'user_type_id' => UserType::$admin
            ));
            User::forceCreate(array(
                'name'         => 'Travis Willi',
                'email'        => 'wilproft@gmail.com',
                'password'     => bcrypt('asdfasdf'),
                'user_type_id' => UserType::$admin
            ));
            User::forceCreate(array(
                'name'         => 'RMR User',
                'email'        => 'sales@mpath.us',
                'password'     => bcrypt('asdfasdf'),
                'user_type_id' => UserType::$dealer
            ));

            User::forceCreate(array(
                'name'         => 'Test User',
                'email'        => 'test@test.com',
                'password'     => bcrypt('asdfasdf'),
                'user_type_id' => UserType::$customer
            ));
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('user_type')->truncate();
        DB::table('user')->truncate();

        // supposed to only apply to a single connection and reset it's self
        // but I like to explicitly undo what I've done for clarity
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}
