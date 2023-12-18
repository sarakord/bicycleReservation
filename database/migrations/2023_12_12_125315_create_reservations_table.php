<?php

use App\Enums\ReservationStatusEnum;
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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('bicycle_id');
            $table->unsignedInteger('quantity');
            $table->timestamp('start')->comment('start reservation date');
            $table->timestamp('end')->comment('end reservation date');
            $table->tinyInteger('status')->default(ReservationStatusEnum::PENDING->value);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
            $table->foreign('bicycle_id')->references('id')->on('bicycles')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
