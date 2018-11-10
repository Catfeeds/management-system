<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLetterProofsTable extends Migration 
{
	public function up()
	{
		Schema::create('letter_proofs', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20)->index()->comment('姓名');
            $table->string('community_name', 100)->comment('社区名称');
            $table->string('present_address', 100)->index()->comment('居住地址');
            $table->string('residence_address', 100)->index()->comment('户籍地址');
            $table->string('use', 100)->comment('用处');
            $table->string('basis', 100)->comment('依据');
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('letter_proofs');
	}
}
