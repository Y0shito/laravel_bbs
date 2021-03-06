<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('introduction', 200)->nullable()->after('created_at');
            $table->string('url', 2000)->nullable()->after('introduction');
            $table->integer('total_bookmarked')->default(0)->after('url');
            $table->integer('followings')->default(0)->after('total_bookmarked');
            $table->integer('followers')->default(0)->after('followings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['introduction', 'url', 'total_bookmarked', 'followings', 'followers']);
        });
    }
}
