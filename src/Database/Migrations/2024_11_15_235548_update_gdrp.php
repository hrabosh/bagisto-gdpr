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
        Schema::table('gdpr', function (Blueprint $table) {
            $table->integer('locale_id')->unsigned()->after('id');
            $table->integer('channel_id')->unsigned()->after('id');
            $table->integer('agreement_cms_page_id')->unsigned()->after('agreement_label');
            $table->string('agreement_label_link_text')->after('agreement_label');

            $table->dropColumn('agreement_content');
            $table->unique(['channel_id', 'locale_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
