<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerSellerDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_seller_data', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('supplier_country')->nullable();
            $table->string('unloading_port')->nullable();
            $table->string('mode')->nullable();
            $table->string('loading_country')->nullable();
            $table->string('loading_port')->nullable();
            $table->string('hs_02')->nullable();
            $table->string('business_category')->nullable();
            $table->string('hs_04')->nullable();
            $table->string('sub_category_i')->nullable();
            $table->string('hs_code_08')->nullable();
            $table->string('sub_category_ii')->nullable();
            $table->text('product_description')->nullable();
            $table->string('supplier_code')->nullable();
            $table->string('supplier_name')->nullable();
            $table->text('supplier_address')->nullable();
            $table->string('supplier_city')->nullable();
            $table->string('supplier_pin_code')->nullable();
            $table->string('supplier_state')->nullable();
            $table->string('country_code')->nullable();
            $table->string('supplier_phone')->nullable();
            $table->string('supplier_mobile')->nullable();
            $table->string('supplier_email_i')->nullable();
            $table->string('supplier_email_ii')->nullable();
            $table->string('supplier_website')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('show_contact_details')->nullable();
            $table->string('call_button')->nullable();
            $table->string('whatsapp_button')->nullable();
            $table->string('report_contact')->nullable();
            $table->string('save_to_favorite')->nullable();
            $table->string('edit_contact')->nullable();
            $table->timestamps(); // Created at & Updated at timestamps

            // Add any additional indexes or constraints if needed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seller_seller_data');
    }
}
