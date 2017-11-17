<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
   	protected $table = 'Produtos';
   	protected $fillable = ['nome', 
    					'descricao',
    					'custo',
    					'quantidade'];

   public function fornecedores(){
        return $this->belongsToMany(Fornecedor::class);
    }
}
