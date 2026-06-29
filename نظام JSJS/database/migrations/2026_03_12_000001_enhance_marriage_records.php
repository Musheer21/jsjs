<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('marriage_details', function (Blueprint $table) {
            $table->string('guardian')->nullable();
            $table->string('place')->nullable();
            $table->string('consummation_status')->nullable();
        });

        Schema::create('witnesses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('identity_phone')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('witnesses');
        Schema::table('marriage_details', function (Blueprint $table) {
            $table->dropColumn(['guardian', 'place', 'consummation_status']);
        });
    }
};
