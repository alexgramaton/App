<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->bigIncrements('id');
						$table->string('business_name');
						$table->longText('logo_url');
						$table->string('description');
						$table->longText('products_image_url');
						$table->string('website_url');
						$table->string('company_phone');
						$table->string('company_email');
						$table->string('video_url')->nullable();
						$table->integer('private_label');
						$table->string('distinction_1')->nullable();
						$table->string('distinction_2')->nullable();
						$table->string('distinction_3')->nullable();
						$table->string('distinction_4')->nullable();
						$table->string('distinction_5')->nullable();
						$table->string('production_capacity')->nullable();
						$table->string('main_markets')->nullable();
						$table->string('main_sales_channels')->nullable();
						$table->string('products_description')->nullable();
						$table->string('contact_first_name')->nullable();
						$table->string('contact_last_name')->nullable();
						$table->string('contact_role')->nullable();
						$table->string('contact_email')->nullable();
						$table->string('contact_phone')->nullable();
						$table->integer('status')->default(0);
						$table->boolean('isDraft')->default(TRUE);
						$table->integer('user_id');
						$table->foreign('user_id')
          ->references('id')->on('users')
          ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company');
    }
}
