<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bills', function (Blueprint $table) {
        
            $table->string('transaction_id', 50)->after('details');
            $table->boolean('paid')->default(0)->after('details');
            //$table->string('reference_pol', 50)->after('details');
            //$table->string('reference_sale', 50)->after('details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bills', function (Blueprint $table) {
           // $table->dropColumn('reference_sale');
            $table->dropColumn('transaction_id');
            $table->dropColumn('paid');
            //$table->dropColumn('reference_pol');

        });
    }
};
