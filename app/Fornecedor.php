<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{

   use SoftDeletes;

   protected $table = 'fornecedores';
   protected $fillable = ['nome', 'endereco', 'cnpj'];
   protected $guarded = ['id', 'created_at', 'update_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function produtos(){
        return $this->hasMany(Produto::class);
    }
}
