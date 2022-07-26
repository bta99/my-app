<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionUser extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'token', 'refresh_token', 'token_expried', 'refresh_token_expried', 'user_id',
    // ];
    protected $table = 'session_user';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\models\user', 'user_id', 'id');
    }
}
