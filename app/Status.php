<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user', 'content', 'id_parent'
    ];

    /**
     * Get the phone record associated with the user.
     */
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'id_user');
    }
}
