<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->integer('company_id')->unsigned();
						$table->foreign('company_id')
          	->references('id')->on('company')
						->onDelete('cascade');
						$table->integer('sub_category_id')->unsigned();
						$table->foreign('sub_category_id')
          	->references('id')->on('sub_category')
          	->onDelete('cascade');
						$table->string('name');
						$table->string('self_life');
						$table->integer('storage_type')->default(2);
						
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
