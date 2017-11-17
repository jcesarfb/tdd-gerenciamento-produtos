<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsuarioTest extends TestCase
{

    /** @test */
    public function usuario_admin_pode_desativar_acesso_de_outro_usuario()
    {
         $usuario = factory('App\Usuario')->create();
        $usuario->tipo = true;
        $usuario2 = factory('App\Usuario')->make();
        $this->assertDatabaseHas('usuarios', $usuario2->toArray());
        $usuario2->acesso = "false";
        $response = $this->actingAs($usuario)->put("/usuarios/" . $produto->id, $produto->toArray());
        $this->assertDatabaseHas('usuarios', $usuario2->toArray());
    }

    /** @test */
    public function usuario_admin_pode_inserir_novo_usuario()
    {
        $usuario = factory('App\Usuario')->create();
        $usuario->tipo = true;
        $usuario2 = factory('App\Usuario')->make();
        $this->actingAs($usuario)->post('/usuario', $usuario2->toArray());
        $this->assertDatabaseHas('usuarios', $usuario2->toArray());
    }


    /** @test */
    public function usuario_pode_visualizar_todos_os_fornecedores()
    {
        $usuario = factory('App\Usuario')->create();
        $fornecedores = factory('App\Fornecedor', 5)->create();
        $response = $this->actingAs($usuario)->get('/fornecedores');
        foreach($fornecedores as $fornecedor) {
            $response->assertSee($fornecedor->nome);
            $response->assertSee($fornecedor->endereco);
            $response->assertSee($fornecedor->cnpj);
        }
    }


    /** @test */
    public function usuario_pode_editar_um_fornecedor()
    {
       $fornecedor = factory('App\Fornecedor')->create();
        $usuario = factory('App\Usuario')->create();
        $this->assertDatabaseHas('fornecedores', $fornecedor->toArray());
        $fornecedor->nome = "nome";
        $response = $this->actingAs($usuario)->put("/fornecedores/" . $fornecedor->id, $fornecedor->toArray());
        $this->assertDatabaseHas('fornecedores', $fornecedor->toArray());
    }

    /** @test */
    public function testExcluirFornecedores()
    {
        $fornecedor = factory('App\Fornecedor')->create();
        $usuario = factory('App\Usuario')->create();

        $this->assertDatabaseHas('fornecedores', $fornecedor->toArray());
        $response = $this->actingAs($usuario)->delete('/fornecedores', $fornecedor->toArray());
        
        $response->assertStatus(200);
        $this->assertDatabaseMissing('fornecedores', $fornecedor->toArray());
    }

    /** @test */
    public function testInserirProdutos()
    {
        $usuario = factory('App\Usuario')->create();
        $produto = factory('App\Produto')->make();
        $this->actingAs($usuario)->post('/produto', $produto->toArray());
        $this->assertDatabaseHas('produtos', $produto->toArray());
    }

    /** @test */
    public function usuario_pode_visualizar_todos_os_produtos()
    {
        $usuario = factory('App\Usuario')->create();
        $produtos = factory('App\Produto', 5)->create();
        $response = $this->actingAs($usuario)->get('/produtos');
        foreach($produtos as $produto) {
            $response->assertSee($produto->nome);
            $response->assertSee($produto->descricao);
            $response->assertSee($produto->custo);
            $response->assertSee($produto->quantidade);
        }
    }


    /** @test */
     public function usuario_pode_editar_um_produto()
    {
       $produto = factory('App\Produto')->create();
        $usuario = factory('App\Usuario')->create();
        $this->assertDatabaseHas('produtos', $produto->toArray());
        $produto->nome = "nome";
        $response = $this->actingAs($usuario)->put("/produtos/" . $produto->id, $produto->toArray());
        $this->assertDatabaseHas('produtos', $produto->toArray());
    }

    /** @test */
    public function usuario_pode_visualizar_produtos_de_um_fornecedor()
    {
        $usuario = factory('App\Usuario')->create();
        $fornecedor = factory('App\Fornecedor')->create();
        $response = $this->actingAs($usuario)->get('/fornecedor/produtos');
        foreach($fornecedor->produtos as $produto) {
            $response->assertSee($produto->nome);
            $response->assertSee($produto->descricao);
            $response->assertSee($produto->custo);
            $response->assertSee($produto->quantidade);
        }
    }
}
