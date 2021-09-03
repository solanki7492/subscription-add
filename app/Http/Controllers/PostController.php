<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function publishPost(Request $request)
    {
        $inputs = $request->all();

        $validator = \Validator::make($inputs, [
            'title'      => 'required',
            'website_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'status'  => 0,
                'errors'  => $validator->errors(),
                'message' => implode(",", $validator->messages()->all()),
            ];
        } else {
            $inputs['status'] = 1;

            $post     = Post::create($inputs);
            $response = [
                'status'  => 1,
                'data'    => [
                    'post_id' => $post->id,
                ],
                'message' => "Post Publish successfully",
            ];
        }
        return response()->json($response);
    }
}
