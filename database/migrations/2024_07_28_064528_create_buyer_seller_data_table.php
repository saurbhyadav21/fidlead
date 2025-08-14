<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('buyer_seller_data', function (Blueprint $table) {
            $table->id();
            $table->string('data_type');
            $table->string('buyer_country');
            $table->string('delivery_port');
            $table->string('origin_country');
            $table->string('origin_port');
            $table->string('hs_02');
            $table->string('business_category');
            $table->string('hs_04');
            $table->string('sub_category_i');
            $table->string('hs_code_08');
            $table->string('sub_category_ii');
            $table->text('product_description');
            $table->string('buyer_name');
            $table->text('buyer_address');
            $table->string('buyer_city');
            $table->string('pin_code');
            $table->string('buyer_state');
            $table->string('buyer_phone');
            $table->string('buyer_mobile_ii')->nullable();
            $table->string('buyer_email_i');
            $table->string('buyer_email_ii')->nullable();
            $table->string('website')->nullable();
            $table->string('contact_person');
            $table->string('show_contact_details')->default(false);
            $table->string('call_button')->default(false);
            $table->string('whatsapp_button')->default(false);
            $table->text('remarks')->nullable();
            $table->string('save_to_favorite')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buyer_seller_data');
    }
};
