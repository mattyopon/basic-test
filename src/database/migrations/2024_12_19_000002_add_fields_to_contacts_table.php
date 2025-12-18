<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // このマイグレーションは不要になったため空にする
        // すべてのカラムはcreate_contacts_tableで定義済み
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // このマイグレーションは不要になったため空にする
    }
}

