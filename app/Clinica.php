<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Clinica extends Model
{
	use Searchable;

    protected $table = 'clinicas';

    public function user()
    {
    	return $this->belongsTo(User::class, 'clinica_id');
    }

    public function associateUser($user)
    {
    	$this->user()->save($user);
    }
}
