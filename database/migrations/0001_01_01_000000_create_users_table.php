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
        Schema::create("plans",function(Blueprint $table){
            $table->bigIncrements("id");

            $table->string("name");
            $table->string("description")->nullable();
            $table->double("price",10);
            $table->integer("cicleEvaluationsAvailables");
            $table->integer("cicleEvaluationsUsersAvailables");

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create("companies",function(Blueprint $table){
            $table->bigIncrements("id");

            $table->foreignId('planId')->constrained('plans')->onDelete('cascade');

            $table->string("name");
            $table->string("direction");
            $table->string("phoneContact");
            $table->string("rfc")->unique();
            $table->integer("employees")->default(1);
            $table->enum("status",["active","inactive","suspended"])->default("suspended");

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create("companySettings",function(Blueprint $table){
            $table->bigIncrements("id");
            $table->foreignId('companyId')->constrained('companies')->onDelete('cascade');
            $table->string("key");
            $table->string("value");
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create("payments",function(Blueprint $table){
            $table->bigIncrements("id");

            $table->foreignId('companyId')->constrained('companies')->onDelete('cascade');
            $table->double("payment",10);
            $table->double("discount",10)->default(0.0);
            $table->double("fees",10)->default(0.0);
            $table->double("total",10);
            $table->enum("status",["onHold","payed","cancelled"])->default("onHold");
            $table->timestamp("nextDueDate");

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('roleId')->constrained('roles')->onDelete('cascade');
            $table->foreignId('companyId')->constrained('companies')->onDelete('cascade');

            $table->string('uuid')->unique();
            $table->string("firstName");
            $table->string("lastName");
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->timestamp('email_verified_at')->nullable();

            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create("quizzes",function(Blueprint $table){
            $table->bigIncrements("id");
            $table->string("name");
            $table->string("description")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create("quizSection",function(Blueprint $table){
            $table->bigIncrements("id");
            $table->foreignId('quizId')->constrained('quizzes')->onDelete('cascade');
            $table->string("name");
            $table->string("description")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create("quizSectionQuestion",function(Blueprint $table){
            $table->bigIncrements("id");
            $table->foreignId('quizSectionId')->constrained('quizSection')->onDelete('cascade');
            $table->enum("type",["yesOrNot","multiple","open"])->default("yesOrNot");
            $table->string("name");
            $table->string("description")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create("quizSectionQuestionOption",function(Blueprint $table){
            $table->bigIncrements("id");
            $table->foreignId('quizSectionQuestionId')->constrained('quizSectionQuestion')->onDelete('cascade');
            $table->string("name");
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create("cicleEvaluations",function(Blueprint $table){
            $table->bigIncrements("id");
            $table->foreignId('companyId')->constrained('companies')->onDelete('cascade');
            $table->string("name");
            $table->date("startDate");
            $table->date("endDate");
            $table->enum("status",["active","inactive"])->default("inactive");
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create("cicleEvaluationCompnayQuiz",function(Blueprint $table){
            $table->bigIncrements("id");
            $table->foreignId('cicleEvaluationId')->constrained('cicleEvaluations')->onDelete('cascade');
            $table->foreignId('companyId')->constrained('companies')->onDelete('cascade');
            $table->foreignId('quizId')->constrained('quizzes')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create("cicleEvaluationUser",function(Blueprint $table){
            $table->bigIncrements("id");
            $table->foreignId('cicleEvaluationId')->constrained('cicleEvaluations')->onDelete('cascade');
            $table->foreignId('userId')->constrained('users')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create("responses",function(Blueprint $table){
            $table->bigIncrements("id");
            $table->foreignId('userId')->constrained('users')->onDelete('cascade');
            $table->foreignId('cicleEvaluationId')->constrained('cicleEvaluations')->onDelete('cascade');
            $table->integer('quizId');
            $table->integer('quizSectionId');
            $table->integer('quizSectionQuestionId');
            $table->string("response");
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('settings',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('key');
            $table->string('value');
            $table->softDeletes();
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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('companies');
        Schema::dropIfExists('companySettings');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('users');
        Schema::dropIfExists('quizzes');
        Schema::dropIfExists('quizSection');
        Schema::dropIfExists('quizSectionQuestion');
        Schema::dropIfExists('quizSectionQuestionOption');
        Schema::dropIfExists('responses');
        Schema::dropIfExists('settings');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('cicleEvaluations');
        Schema::dropIfExists('cicleEvaluationCompanyQuiz');
        Schema::dropIfExists('cicleEvaluationUser');
        Schema::dropIfExists('sessions');
    }
};
