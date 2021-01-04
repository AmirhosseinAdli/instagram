<?php

use App\Models\Mention;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentionablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentionables', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Mention::class)
                ->references('id')
                ->on('mentions')
                ->cascadeOnDelete();
            $table->integer('mentionable_id');
            $table->string('mentionable_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mentionables');
    }
}
