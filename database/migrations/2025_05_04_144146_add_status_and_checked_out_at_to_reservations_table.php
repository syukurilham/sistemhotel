<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusAndCheckedOutAtToReservationsTable extends Migration
{
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Menambahkan kolom status (enum)
            $table->enum('status', ['active', 'checked_out'])->default('active');
            // Menambahkan kolom checked_out_at untuk menyimpan waktu check-out
            $table->timestamp('checked_out_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Menghapus kolom yang ditambahkan jika rollback dilakukan
            $table->dropColumn(['status', 'checked_out_at']);
        });
    }
}
