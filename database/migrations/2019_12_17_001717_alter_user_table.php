<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AlterUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = <<<SQL
ALTER TABLE `users` 
DROP COLUMN `access_token_expired`,
DROP COLUMN `access_token`,
CHANGE COLUMN `created_at` `created_at` DATETIME NULL DEFAULT NULL ,
CHANGE COLUMN `updated_at` `updated_at` DATETIME NULL DEFAULT NULL ,
DROP INDEX `users_access_token_unique` ;
SQL;
        DB::statement($sql);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
