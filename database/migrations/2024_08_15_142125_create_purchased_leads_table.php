<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasedLeadsTable extends Migration
{
    public function up()
    {
        Schema::create('purchased_leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users');
            $table->integer('lead_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('purchased_leads');
    }
}
