<?php

namespace App\Listeners;

use App\Events\CreateSlug;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Str;

class UpdateSlug
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CreateSlug  $event
     * @return void
     */
    public function handle(CreateSlug $event)
    {
         $post = $event->post;
        if ($post->name) {
          $slug = Str::slug($post->name);  
        }
        else
        {
            $slug = Str::slug($post->title);
        }
        
        $post->slug = $slug;
        $post->save();
    }
}
