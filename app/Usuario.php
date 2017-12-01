<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'users';
    protected $fillable = ['nome', 'email',	'senha', 'admin', 'acesso'];
    protected $guarded = ['id', 'created_at', 'update_at'];

}
