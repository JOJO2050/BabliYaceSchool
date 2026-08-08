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

        Schema::create('assign_class_subject_teacher', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('teacher_id');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_delete')->default(0);
            $table->unsignedBigInteger('created_by');
            $table->unique(
                [
                    'class_id',
                    'subject_id',
                    'teacher_id'
                ],
                'class_subject_teacher_unique'
            );
            $table->timestamps();

            // Relation avec la table des classes
            $table->foreign('class_id')
                ->references('id')
                ->on('class')
                ->onDelete('cascade');

            // Relation avec la table des matières
            $table->foreign('subject_id')
                ->references('id')
                ->on('subject')
                ->onDelete('cascade');

            // Relation avec les utilisateurs (professeurs)
            $table->foreign('teacher_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_class_subject_teacher');
    }
};
