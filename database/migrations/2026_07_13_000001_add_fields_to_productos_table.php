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
        Schema::table('productos', function (Blueprint $table) {
            $table->foreignId('categoria_id')->after('id')->constrained('categorias')->cascadeOnDelete();
            $table->string('nombreProducto')->after('categoria_id');
            $table->text('descripcion')->nullable()->after('nombreProducto');
            $table->decimal('precio', 10, 2)->after('descripcion');
            $table->unsignedInteger('stock')->default(0)->after('precio');
            $table->string('imagen')->nullable()->after('stock');
            $table->boolean('estado')->default(true)->after('imagen');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropForeign(['categoria_id']);
            $table->dropColumn([
                'categoria_id',
                'nombreProducto',
                'descripcion',
                'precio',
                'stock',
                'imagen',
                'estado',
            ]);
        });
    }
};
