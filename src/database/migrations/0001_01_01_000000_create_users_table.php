<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $table = 'user';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // ユーザーID、主キー
            $table->string('name'); // ユーザー名
            $table->string('email')->unique(); // メールアドレス
            $table->string('password'); // パスワードハッシュ
            $table->rememberToken(); // ログイン状態を保持するトークン
            $table->timestamps(); // 作成日時と更新日時
            $table->timestamp('email_verified_at')->nullable(); // メールアドレス確認日時
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
