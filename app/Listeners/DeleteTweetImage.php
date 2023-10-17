<?php

namespace App\Listeners;

use App\Models\Tweet;
use Illuminate\Support\Facades\File;
use App\Events\TweetDeleting;
use Illuminate\Support\Facades\Log;

class DeleteTweetImage
{
    public function handle(TweetDeleting $event)
    {
        $tweet = $event->tweet;

        if ($tweet->TweetImage) {
            $imagePath = public_path('storage/' . $tweet->TweetImage);

            if (File::exists($imagePath)) {
                File::delete($imagePath);
                Log::info('Image deleted: ' . $imagePath); // Log the image deletion
            } else {
                Log::info('Image not found: ' . $imagePath); // Log if the image was not found
            }
        }
    }
}