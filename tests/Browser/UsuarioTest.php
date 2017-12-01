<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Chrome;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UsuarioTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
   /** @test */
    public function test_usuario_admin_pode_inserir_novo_usuario_atraves_de_formulario()
    {

        $usuario = factory('App\Usuario')->make();
        $response = $this->visit('/usuario')
            ->type('nome', $usuario->nome)
            ->type('email', $usuario->email)
            ->type('senha', $usuario->senha)
            ->radio('administrador', $usuario->admin)
            ->press('Registrar')
            ->see('Usuario inserido com sucesso');
        $response->assertSuccessful();
    }


     /** @test */
    public function test_usuario_admin_pode_desativar_acesso_de_outro_usuario()
    {

        $usuario2 = factory('App\Usuario')->create();
        $usuario2->id = 100;
        $this->assertDatabaseHas('usuarios', $usuario2->toArray());


        $usuario = factory('App\Usuario')->create();
        $usuario->admin = true;
        $response = $this->actingAs($usuario)->visit('/usuario/100')
                                    ->uncheck('acesso')
                                    ->press('Atualizar');
        $response->assertSuccessful();
        
    }


    /** @test */
    public function test_usuario_logado_pode_criar_fornecedor()
    {
        $usuario = factory('App\Usuario')->make();
        $fornecedor = factory('App\Fornecedor')->make();
        $responde = $this->actingAs($usuario)->visit('/fornecedor')
                                    ->type('nome', $fornecedor->nome)
                                    ->type('endereco', $fornecedor->endereco)
                                    ->type('cnpj',$fornecedor->cnpj)
                                    ->press('Cadastrar Fornecedor');
        $response->assertStatus(200);
        $response->assertRedirected('/');
        $this->assertDatabaseHas('fornecedores', $fornecedor->toArray());
    }

     /** @test */
    public function test_usuario_logado_pode_inserir_produto_atraves_do_formulario()
    {

        $fornecedor = factory('App/Fornecedor')->create();

        $produto = factory('App/Produto')->make();
        $produto->belongsTo($fornecedor);

        $usuario = factory('App/Usuario')->make();
        $this->actingAs($usuario)->visit('/produto')
                                 ->type('nome', $produto->nome)
                                 ->type('descricao', $produto->descricao)
                                 ->select($produto->fornecedor)
                                 ->type('custo', $produto->custo)
                                 ->type('quantidade', $produto->quantidade)
                                 ->press('Criar Produto');

        $this->assertDatabaseHas('produtos', $produto->toArray());
    }

    /** @test */
    public function test_usuario_logado_pode_efetuar_baixa_na_quantidade()
    {

        $produto = factory('App\produto')->create();
        $produto = DB::table('produtos')->select('*')->where('nome', '=', $produto->nome);

        $usuario = factory('App\Usuario')->make();
        $this->actingAs($usuario)->visit('/produto/'.$produto->id.'/')
                                ->type('quantidade', 0)
                                ->press('editar');
        
        $produtos->quantidade = 0;

        $this->assertDatabaseHas('produtos', $produtos->toArray());
    }

    /** @test */
    public function test_usuario_logado_nao_pode_colocar_quantidade_menor_que_zero()
    {

        $produto = factory('App\produto')->create();
        $produto = DB::table('produtos')->select('*')->where('nome', '=', $produto->nome);

        $usuario = factory('App\Usuario')->make();
        $this->actingAs($usuario)->visit('/produto/'.$produto->id.'/')
                                ->type('quantidade', -2)
                                ->press('editar');
        
        $produtos->quantidade = 0;
        
        $this->assertDatabaseHas('produtos', $produtos->toArray());
    }

}
