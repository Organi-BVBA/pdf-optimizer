<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebhooksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('webhooks', function (Blueprint $table) {
            $table->id();
            $table->efficientUuid('uuid')->index();

            $table->foreignIdFor(User::class);

            $table->unsignedTinyInteger('type');
            $table->unsignedTinyInteger('status');

            $table->string('ext')->nullable();
            $table->string('url')->nullable();

            $table->unsignedInteger('original_size')->nullable();
            $table->unsignedInteger('optimized_size')->nullable();

            $table->boolean('wait')->default(false);
            $table->string('webhook')->nullable();
            $table->unsignedSmallInteger('response')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('webhooks');
    }
}
