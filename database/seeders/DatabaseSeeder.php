<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Factories\ChannelFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {   
        $user1 = \App\User::factory()->create([
            'email' => "join@doe.com"
        ]);

        $user2 = \App\User::factory()->create([
            'email' => "jane@doe.com"
        ]);

        $channel1 = \App\Chanel::factory()->create([
            'user_id' => $user1->id
        ]);

        $channel2 = \App\Chanel::factory()->create([
            'user_id' => $user2->id
        ]);

        $channel1->subscriptions()->create([
            'user_id' => $user2->id
        ]);

        $channel2->subscriptions()->create([
            'user_id' => $user1->id
        ]);

        \App\Subscription::factory(100)->create([
             'chanel_id' => $channel1->id
        ]);

        \App\Subscription::factory(100)->create([
            'chanel_id' => $channel2->id
       ]);

       $video = \App\Video::factory()->create([
           'chanel_id' => $channel1->id
       ]);

       \App\Comment::factory(50)->create([
           'video_id' => $video->id
       ]);

       
        $comment = \App\Comment::first();

        \App\Comment::factory(50)->create([
            'video_id' => $video->id,
            'comment_id' => $comment->id
        ]);
    }

}
