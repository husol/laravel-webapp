<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserArticle extends Model
{
    protected $table = 'user_article';

    public function getUsers() {
    	return $this->belongsTo('App\User', 'id_user', 'id');
    }
}
