<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLetterProofsTable extends Migration 
{
	public function up()
	{
		Schema::create('letter_proofs', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20)->index()->comment('֤��������');
            $table->string('community_name', 100);
            $table->string('present_address', 100)->index()->comment('��ס��ַ');
            $table->string('residence_address', 100)->index()->comment('������ַ');
            $table->string('use', 100)->comment('��;');
            $table->string('basis', 100)->comment('����');
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('letter_proofs');
	}
}
