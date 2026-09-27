<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_add_fees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('class_id');
            $table->decimal('total_amount', 15, 2);
            $table->decimal('paid_amount', 15, 2);
            $table->decimal('remaning_amount', 15, 2);
            $table->string('payment_type', 50);
            $table->string('ref_payement', 100)->unique();
            $table->text('observation')->nullable();
            $table->timestamps();

            $table->index('student_id');
            $table->index('class_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_add_fees');
    }
};