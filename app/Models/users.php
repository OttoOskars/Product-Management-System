<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class users extends Model
{
    use Notifiable;
    
    // The table associated with the model.
    protected $table = 'users';

    // The primary key for the model.
    protected $primaryKey = 'UserID';

    // The attributes that are mass assignable.
    protected $fillable = [
        'Name', 'UserTag', 'Email', 'Password', 'DOB',
    ];

    // The attributes that should be hidden for arrays.
    protected $hidden = [
        'Password',
    ];

}
