<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFornecedorProdutoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedor_Produto', function (Blueprint $table) {
            $table->integer('produto_id')->unsigned();
            $table->integer('fornecedor_id')->unsigned();
            $table->foreign('produto_id')
                ->references('id')->on('produtos')
                ->onDelete('cascade');
            $table->foreign('fornecedor_id')
                ->references('id')->on('fornecedores')
                ->onDelete('cascade');
        });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fornecedor_Produto');
    }
}
