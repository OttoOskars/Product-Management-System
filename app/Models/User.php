<?php
namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;
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
        'ProfilePicture',
        'Description',
        'Banner',

        'password_reset_token', // Add this field
        'password_reset_expires_at', // Add this field
    ];

    protected $hidden = [
        'Password',
    ];

    public function tweets()
    {
        return $this->hasMany(Tweet::class, 'UserID');
    }
    public function retweets()
    {
        return $this->hasMany(Retweet::class, 'UserID');
    }
    public function likes()
    {
        return $this->hasMany(Like::class, 'UserID');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'UserID');
    }
    public function tokens(): MorphMany
    {
        return $this->morphMany(PersonalAccessToken::class, 'tokenable');
    }

    ////////////////////////////////////////////////////////////
    public function createPasswordResetToken()
    {
        $this->password_reset_token = Str::random(60);
        $this->password_reset_expires_at = now()->addHours(2);
        $this->save();
    }

    public function resetPassword($newPassword)
    {
        $this->password = bcrypt($newPassword);
        $this->password_reset_token = null;
        $this->password_reset_expires_at = null;
        $this->save();
    }

    public function isPasswordResetTokenValid()
    {
        return $this->password_reset_expires_at > now();
    }
}