<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
   	protected $table = 'Produtos';
   	protected $fillable = ['nome', 'descricao',	'custo', 'quantidade'];
    protected $guarded = ['id', 'created_at', 'update_at'];


   public function fornecedores(){
        return $this->belongsTo(Fornecedor::class);
    }
}
