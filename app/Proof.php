<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proof extends Model
{
    protected $table = 'proof';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'name', 'issue', 'source', 'file', 'id_article'
    ];
}
