<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Google extends Model
{
    use HasFactory;
    protected $fillable = [
          'provider_user_id',  'provider',  'user'
    ];

    // protected $primaryKey = 'user_id';
 	protected $table = 'googles';
 	public function login(){
 		return $this->belongsTo('App\Models\Google', 'user');
 	}
}
