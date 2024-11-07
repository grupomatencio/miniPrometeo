<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablaAcumulado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acumulado', function (Blueprint $table) {
            $table->id();
            $table -> integer('NumPlaca') -> default (0);
            $table -> tinyText('nombre') -> nullable() -> default (NULL);
            $table -> bigInteger('entradas') -> nullable() -> default (0);
            $table -> bigInteger('salidas') -> nullable() -> default (0);
            $table -> bigInteger('CEntradas') -> nullable() -> default (0);
            $table -> bigInteger('CSalidas') -> nullable() -> default (0);
            $table -> bigInteger('acumulado') -> nullable() -> default (0);
            $table -> bigInteger('CAcumulado') -> nullable() -> default (0);
            $table -> smallInteger('OrdenPago') -> nullable() -> default (0);
            $table -> integer('factor') -> nullable() -> default (0);
            $table -> bigInteger('PagoManual') -> nullable() -> default (0);
            $table -> bigInteger('HoraActual') -> nullable() -> default (NULL);
            $table -> tinyText('EstadoMaquina') -> nullable() -> default (NULL);
            $table -> tinyText('comentario') -> nullable() -> default (NULL);
            $table -> tinyText('TipoProtocolo') -> nullable() -> default (NULL);
            $table -> tinyText('version') -> nullable() -> default (NULL);
            $table -> integer('e1c') -> nullable() -> default (0);
            $table -> integer('e2c') -> nullable() -> default (0);
            $table -> integer('e5c') -> nullable() -> default (0);
            $table -> integer('e10c') -> nullable() -> default (0);
            $table -> integer('e20c') -> nullable() -> default (0);
            $table -> integer('e50c') -> nullable() -> default (0);
            $table -> integer('e1e') -> nullable() -> default (0);
            $table -> integer('e2e') -> nullable() -> default (0);
            $table -> integer('e5e') -> nullable() -> default (0);
            $table -> integer('e10e') -> nullable() -> default (0);
            $table -> integer('e20e') -> nullable() -> default (0);
            $table -> integer('e50e') -> nullable() -> default (0);
            $table -> integer('e100e') -> nullable() -> default (0);
            $table -> integer('e200e') -> nullable() -> default (0);
            $table -> integer('e500e') -> nullable() -> default (0);
            $table -> integer('s1c') -> nullable() -> default (0);
            $table -> integer('s2c') -> nullable() -> default (0);
            $table -> integer('s5c') -> nullable() -> default (0);
            $table -> integer('s10c') -> nullable() -> default (0);
            $table -> integer('s20c') -> nullable() -> default (0);
            $table -> integer('s50c') -> nullable() -> default (0);
            $table -> integer('s1e') -> nullable() -> default (0);
            $table -> integer('s2e') -> nullable() -> default (0);
            $table -> integer('s5e') -> nullable() -> default (0);
            $table -> integer('s10e') -> nullable() -> default (0);
            $table -> integer('s20e') -> nullable() -> default (0);
            $table -> integer('s50e') -> nullable() -> default (0);
            $table -> integer('s100e') -> nullable() -> default (0);
            $table -> integer('s200e') -> nullable() -> default (0);
            $table -> integer('s500e') -> nullable() -> default (0);
            $table -> integer('c10c') -> nullable() -> default (0);
            $table -> integer('c20c') -> nullable() -> default (0);
            $table -> integer('c50c') -> nullable() -> default (0);
            $table -> integer('c1e') -> nullable() -> default (0);
            $table -> integer('c2e') -> nullable() -> default (0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acumulado');
    }
}
