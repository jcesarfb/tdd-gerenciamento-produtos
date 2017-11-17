<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
   protected $table = 'Fornecedores';
   protected $fillable = ['nome', 
    					'endereco',
    					'cnpj'];

    public function produtos(){
        return $this->hasMany(Produto::class);
    }
}
