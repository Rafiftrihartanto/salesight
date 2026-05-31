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
        Schema::create('status_toko', function (Blueprint $table) {

            $table->id();

            $table->string('shopping_mall');

            $table->integer('year_awal');
            $table->integer('year_akhir');

            $table->decimal('sales_awal', 18, 2);
            $table->decimal('sales_akhir', 18, 2);

            $table->decimal('growth_percent', 10, 2);

            $table->enum(
                'status_toko',
                ['Naik', 'Turun', 'Stagnan', 'Data Awal']
            );

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_toko');
    }
};
