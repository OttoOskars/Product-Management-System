<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mention extends Model
{
    use HasFactory;
    protected $table = 'mentions';

    protected $primaryKey = 'MentionID';
    
    protected $fillable = ['TweetID', 'UserID', 'MentionedUserID'];

    public function tweet(): BelongsTo
    {
        return $this->belongsTo(Tweet::class, 'TweetID');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function mentionedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'MentionedUserID');
    }
}
