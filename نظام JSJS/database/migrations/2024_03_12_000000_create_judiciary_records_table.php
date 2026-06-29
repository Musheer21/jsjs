<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('judiciary_records', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('national_id')->unique()->nullable();
            $table->string('status')->default('مسجل'); // مسجل، مطلوب، إلخ
            $table->timestamps();
        });

        // Insert some dummy data for matching
        DB::table('judiciary_records')->insert([
            ['full_name' => 'محمد علي صالح', 'national_id' => '1010101010', 'status' => 'مسجل'],
            ['full_name' => 'أحمد عبدالله حسين', 'national_id' => '2020202020', 'status' => 'مسجل'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('judiciary_records');
    }
};
