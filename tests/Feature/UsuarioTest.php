<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsuarioTest extends TestCase
{

     /** @test */
    public function test_usuario_logado_cria_sessao()
    {
        $usuario = factory('App\Usuario')->create();

        $response = $this->actingAs($usuario)
                         ->get('/');
        $response->assertSuccessful();
    }

    /** @test */
    public function test_usuario_admin_pode_inserir_novo_usuario()
    {
        $usuario = factory('App\Usuario')->create();
        $usuario->admin = true;

        $usuario2 = factory('App\Usuario')->make();
        $this->actingAs($usuario)->post('/usuario', $usuario2->toArray());

        $this->assertDatabaseHas('users', $usuario2->toArray());
    }


    /** @test */
    public function test_usuario_comum_nao_pode_inserir_novo_usuario()
    {
        $usuario = factory('App\Usuario')->create();
        $usuario->admin = false;
        $usuario2 = factory('App\Usuario')->make();
        $this->actingAs($usuario)->post('/usuario', $usuario2->toArray());
        $this->assertDatabaseMissing('users', $usuario2->toArray());
    }


     /** @test */
    public function test_usuario_comum_nao_pode_ver_formulario_de_criar_novos_usuario()
    {
        $usuario =factory('App\Usuario')->create();
        $usuario->admin = false;
        $response = $this->actingAs($usuario)->get('/usuario')->assertRedirected('/');
    }

     /** @test */
    public function test_usuario_admin_pode_desativar_acesso_de_outro_usuario()
    {

        $usuario = factory('App\Usuario')->create();
        $usuario->admin = true;
        $usuario2 = factory('App\Usuario')->make();
        $this->assertDatabaseHas('usuarios', $usuario2->toArray());
        $usuario2->acesso = false;
        $response = $this->actingAs($usuario)->put("/usuarios/" . $usuario->id, $usuario->toArray());
        $this->assertDatabaseHas('users', $usuario2->toArray());
    }


    /** @test */
    public function test_usuario_logado_pode_criar_fornecedor()
    {
        $usuario = factory('App\Usuario')->create();
        $fornecedor = factory('App\Fornecedor')->make();
        $responde = $this->actingAs($usuario)->put('/fornecedor')->with($fornecedores);
                                
        $response->assertStatus(200);
        $this->assertDatabaseHas('fornecedores', $fornecedor->toArray());
    }

     /** @test */
    public function test_usuario_nao_logado_nao_pode_acessar_formulario_de_cadastro_de_fornecedores()
    {
    	$usuario = factory('App\Usuario')->create();
    	$usuario->acesso = false;
        $this->put('/fornecedor')->assertRedirect('/');
    }

    /** @test */
    public function test_usuario_logado_pode_visualizar_todos_os_fornecedores()
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
    public function test_usuario_logado_pode_buscar_fornecedores()
    {
        $fornecedor = factory('App\Fornecedor')->create();

        $usuario = factory('App\Usuario')->make();
        $response = $this->actingAs($usuario)->get('/fornecedores/search/'.$fornecedor->nome);

            $response->assertSee($fornecedor->nome);
            $response->assertSee($fornecedor->endereco);
            $response->assertSee($fornecedor->cnpj);
    }

     /** @test */
    public function test_usuario_logado_pode_editar_fornecedor()
    {
        $fornecedor = factory('App\Fornecedor')->create();
        $this->assertDatabaseHas('fornecedores', $fornecedor->toArray());
        $fornecedor->nome = "NovoNome";

        $usuario = factory('App\Usuario')->create();
        $response = $this->actingAs($usuario)->put("/fornecedor/" . $fornecedor->id, $fornecedor->toArray());
        $this->assertDatabaseHas('fornecedores', $fornecedor->toArray());
    }


    /** @test */
    public function test_usuario_logado_pode_excluir_fornecedor_soft_delet()
    {
        $fornecedor = factory('App\Fornecedor')->create();
        $usuario = factory('App\Usuario')->create();

        $this->assertDatabaseHas('fornecedores', $fornecedor->toArray());
        $response = $this->actingAs($usuario)->delete('/fornecedores', $fornecedor->toArray());
        
        $response->assertStatus(200);
        $this->assertSoftDeleted('fornecedores', $fornecedor->toArray());
    }


    /** @test */
    public function test_usuario_logado_nao_pode_excluir_fornecedor_se_tiver_produto_associado()
    {
        $fornecedor = factory('App\Fornecedor')->create();
        $this->assertDatabaseHas('fornecedores', $fornecedor->toArray());

        $produto = factory('App\Produto')->create();
        $produto->belongsTo($fornecedor);
        $this->assertDatabaseHas('produtos', $produto->toArray());

        $fornecedorId = DB::table('produtos')->select('fornecedor_id')->where('nome', '=', $produto->nome);
        $this->assertTrue($fornecedorId == $fornecedor->id);

        $usuario = factory('App\Usuario')->create();
        $this->actingAs($usuario)->delete('fornecedor/'.$fornecedor->id.'/');
        $assertDatabaseHas('fornecedores', $fornecedor->toArray());
    }


    /** @test */
    public function test_usuario_logado_pode_inserir_produto()
    {
        $usuario = factory('App\Usuario')->make();
        $produto = factory('App\Produto')->make();
        $this->actingAs($usuario)->post('/produto', $produto->toArray());
        $this->assertDatabaseHas('produtos', $produto->toArray());
    }


	/** @test */
    public function test_usuario_logado_pode_inserir_produto(){

		$usuario = factory('App\Usuario')->create();
        $fornecedor = factory('App\Produto')->make();
        $responde = $this->actingAs($usuario)->post('/produto')->with($produtos);
                                
        $response->assertStatus(200);
        $this->assertDatabaseHas('produtos', $produto->toArray());
    }

      /** @test */
    public function test_usuario_nao_logado_nao_pode_acessar_formulario_de_cadastro_de_produtos()
    {
        $this->visit('/produto')->assertRedirect('/login');
    }


    /** @test */
    public function test_usuario_logado_pode_efetuar_baixa_na_quantidade()
    {

        $produto = factory('App\produto')->create();
        $produto = DB::table('produtos')->select('*')->where('nome', '=', $produto->nome);
        $produto->quantidade = 0;


        $this->actingAs($usuario)->put('/produto/'.$produto->id.'/');
		$this->assertDatabaseHas('produtos', $produtos->toArray());
	} 
	

	/** @test */
    public function test_usuario_logado_nao_pode_colocar_quantidade_menor_que_zero()
    {

        $produto = factory('App\produto')->create();
        $produto = DB::table('produtos')->select('*')->where('nome', '=', $produto->nome);
        $produto->quantidade = -6;


        $this->actingAs($usuario)->put('/produto/'.$produto->id.'/');

        $produto->quantidade = 0;
		$this->assertDatabaseHas('produtos', $produtos->toArray());
	}


	/** @test */
    public function test_produto_esgotado_visto_separado_dos_que_estao_em_estoque()
    {
        $fornecedor = factory('App/fornecedor')->make()
        $produtos = factory('App/produto', 10)->make();
        $produtos[0]->quantidade = 0;
        $produtos[1]->quantidade = 1000;
        $produtos[2]->quantidade = 500;
        $produtos[3]->quantidade = 0;

        $DB::table('fornecedores')->insert($fornecedor);

        $usuario - factory('App\Usuario')->make();
        $response = $this->actingAs($usuario)->visit('fornecedor/'.$fornecedor->id.'/produtos');

        $response->assertSee('Produtos em estoque');
        $response->assertSee($produtos[1]->nome);
        $response->assertSee($produtos[2]->nome);


        $response->assertSee('Produtos esgotados');
        $response->assertSee($produtos[0]->nome);
        $response->assertSee($produtos[3]->nome);


    }

    /** @test */
    public function test_usuario_logado_pode_visualizar_todos_os_produtos()
    {
        $usuario = factory('App\Usuario')->make();
        $produtos = factory('App\Produto', 5)->make();

        $response = $this->actingAs($usuario)->get('/produtos');
        foreach($produtos as $produto) {
            $response->assertSee($produto->nome);
            $response->assertSee($produto->descricao);
            $response->assertSee($produto->fornecedor);
            $response->assertSee($produto->custo);
            $response->assertSee($produto->quantidade);
        }
    }

    /** @test */
    public function test_usuario_logado_pode_buscar_produto()
    {
        $produto = factory('App\Produto')->create();

        $usuario = factory('App\Usuario')->make();
        $response = $this->actingAs($usuario)->get('/produto/search/'.$produto->nome);

        $response->assertSee($produto->nome);
        $response->assertSee($produto->descricao);
        $response->assertSee($produto->fornecedor);
        $response->assertSee($produto->custo);
        $response->assertSee($produto->quantidade);
    }


    /** @test */
     public function test_usuario_logado_pode_editar_um_produto()
    {
        $produto = factory('App\Produto')->create();
        $this->assertDatabaseHas('produtos', $produto->toArray());
        $usuario = factory('App\Usuario')->create();

        $produto->nome = "nome";
        $response = $this->actingAs($usuario)->put("/produtos/" . $produto->id)->with($produto->toArray());
        $this->assertDatabaseHas('produtos', $produto->toArray());

    }

    /** @test */
    public function test_usuario_logado_pode_visualizar_produtos_de_um_fornecedor()
    {
        $fornecedor = factory('App\Fornecedor')->hasMany(factory('App\Produto',10))->create();
        $fornecedorTeste = DB::table('fornecedores')->select('*')->where('nome','=',$fornecedor->nome);


        $usuario = factory('App\Usuario')->create();
        $response = $this->actingAs($usuario)->get('/fornecedor/'.$fornecedorTeste->id.'/produtos');
        foreach($fornecedor->produtos as $produto) {
            $response->assertSee($produto->nome);
            $response->assertSee($produto->descricao);
            $response->assertSee($produto->fornecedor);
            $response->assertSee($produto->custo);
            $response->assertSee($produto->quantidade);
        }
    }


    /** @test */
    public function usuario_admin_pode_ver_dashboard_total_dos_produtos()
    {
        $usuario = factory('App\Usuario')->create();
        $usuario->admin = true;

        $response = $this->actingAs($usuario)->get('/produtos/total/');

        $produtos = DB::table('produtos')->select('*');
        $total = 0;
        foreach ($produtos->produto as $produto) {
            $response->assertSee($produto->nome);
            $response->assertSee($produto->quantidade * $produto->custo);
            $total += $produto->quantidade * $produto->custo;
        }
        $response->assertSee($total);

    }


    /** @test */
    public function usuario_comum_nao_pode_ver_dashboard_total_dos_produtos()
    {
        $usuario = factory('App\Usuario')->make();
        $usuario->admin = false;

        $response = $this->actingAs($usuario)->visit('produtos/total/');
        $response->assertRedirect('/');
    }
}
