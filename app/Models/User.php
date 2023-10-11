<?php
namespace app\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Laravel\Sanctum\PersonalAccessToken;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'UserID';

    protected $fillable = [
        'Name',
        'UserTag',
        'Email',
        'Password',
        'DOB',
    ];

    protected $hidden = [
        'Password',
    ];

    /**
     * Get the personal access tokens for the user.
     */
    public function tokens(): MorphMany
    {
        return $this->morphMany(PersonalAccessToken::class, 'tokenable');
    }
}