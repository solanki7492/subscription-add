<?php

namespace App\Console\Commands;

use App\Mail\SendPost;
use App\Models\Post;
use App\Models\SubscriberMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send {postId?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a new publish post email to subscribe user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $posts = Post::select('posts.id', 'posts.title', 'posts.description', 's.email', 's.id as subscriber_id')
            ->join('subscribers as s', 's.website_id', '=', 'posts.website_id')
            ->where('status', 1)
            ->whereNull('sent_on')
            ->whereNotNull('s.email');

        $postId = $this->argument('postId');

        if (!empty($postId)) {
            $posts->where('posts.id', $postId);
        }

        $posts = $posts->get();

        if (!empty($posts) && count($posts)) {
            $updatePost = [];
            foreach ($posts as $post) {
                $mailSent = SubscriberMail::where(['post_id' => $post->id, 'subscriber_id' => $post->subscriber_id])->first();

                if (empty($mailSent)) {
                    Mail::to($post->email)->queue(new SendPost($post->toArray()));
                    // Mail::to($post->email)->send(new SendPost($post));
                    $updatePost[] = $post->id;
                }
            }

            $updatePost = array_unique($updatePost);
            if (!empty($updatePost)) {
                Post::whereIn('id', $updatePost)->update(['sent_on' => date('Y-m-d H:i:s')]);
            }
        }
    }
}
