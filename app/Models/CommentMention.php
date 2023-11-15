<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentMention extends Model
{
    use HasFactory;

    protected $table = 'comment_mentions';

    protected $primaryKey = 'MentionID';
    
    protected $fillable = ['CommentID', 'UserID', 'MentionedUserID'];

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'CommentID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function mentionedUser()
    {
        return $this->belongsTo(User::class, 'MentionedUserID');
    }
}