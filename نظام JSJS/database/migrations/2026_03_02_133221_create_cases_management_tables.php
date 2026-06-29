<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Cases Table
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->string('case_number')->unique();
            $table->string('case_type'); // فسخ للكراهة، فسخ للهجر، إلخ
            $table->text('facts')->nullable(); // الأسباب والوقائع
            $table->json('legal_reasons')->nullable(); // مادة 50، 54 إلخ
            $table->string('status')->default('جديدة');
            $table->timestamps();
        });

        // 2. Parties Table (Plaintiff and Defendant)
        Schema::create('parties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['مدعي', 'مدعى عليه']);
            $table->string('full_name');
            $table->string('occupation')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
        });

        // 3. Marriage Details
        Schema::create('marriage_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id')->constrained()->onDelete('cascade');
            $table->date('contract_date')->nullable();
            $table->string('document_number')->nullable();
            $table->string('authority')->nullable();
            $table->decimal('dowry', 15, 2)->nullable();
            $table->decimal('deferred_dowry', 15, 2)->nullable();
            $table->timestamps();
        });

        // 4. Children Table
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->integer('age');
            $table->string('gender');
            $table->timestamps();
        });

        // 5. Financial Claims
        Schema::create('financial_claims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id')->constrained()->onDelete('cascade');
            $table->decimal('prev_maintenance', 15, 2)->nullable();
            $table->decimal('future_maintenance', 15, 2)->nullable();
            $table->decimal('gold_grams', 10, 2)->nullable();
            $table->decimal('lawyer_fees', 15, 2)->nullable();
            $table->timestamps();
        });

        // 6. Attachments
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id')->constrained()->onDelete('cascade');
            $table->string('file_path');
            $table->string('file_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
        Schema::dropIfExists('financial_claims');
        Schema::dropIfExists('children');
        Schema::dropIfExists('marriage_details');
        Schema::dropIfExists('parties');
        Schema::dropIfExists('cases');
    }
};
