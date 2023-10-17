<?php

namespace App\Models;

use App\Events\TweetDeleting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Tweet extends Model
{
    use HasFactory;

    protected $table = 'tweets'; // Set the table name

    protected $primaryKey = 'TweetID'; // Set the primary key field

    protected $fillable = ['TweetText', 'TweetImage', 'UserID']; // Define the fields that can be mass-assigned

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID'); // Define the relationship with the User model
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($tweet) {
            Log::info('Event sent twitter.php');
            event(new TweetDeleting($tweet));
        });
    }
}