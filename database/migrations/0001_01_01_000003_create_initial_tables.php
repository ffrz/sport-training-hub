<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->text('value')->nullable()->default(null);
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('google_id')->nullable()->default(null);
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('role', \App\Models\User::roles());
            $table->string('password');
            $table->boolean('active')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        Schema::create('student_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('coaches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('gender', ['male', 'female']);
            $table->date('birth_date');
            $table->string('address');
            $table->string('phone');
            $table->boolean('active')->default(false);
            $table->timestamps();
        });

        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('gender', ['male', 'female']);
            $table->date('birth_date');
            $table->string('address');
            $table->string('phone');
            $table->boolean('active')->default(false);
            $table->date('registration_date')->nullable()->default(null);
            $table->date('last_attendance_date')->nullable()->default(null);
            $table->foreignId('group_id')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('student_groups')->onDelete('restrict');
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id');
            $table->decimal('amount', 8, 2);
            $table->date('due_date')->nullable(true)->default(null);
            $table->date('paid_date')->nullable(true)->default(null);
            $table->enum('status', ['paid', 'unpaid']);
            $table->text('notes')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
        Schema::dropIfExists('students');
        Schema::dropIfExists('coaches');
        Schema::dropIfExists('student_groups');
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('settings');
    }
};
