<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Events\ConfirmSubscription;
use Illuminate\Validation\Rule;

class SubscriberController extends Controller
{
    public function userSubscribe(Request $request)
    {
        $inputs = $request->all();

        $validator = \Validator::make($inputs, [
                'email'      => [
                    'required',
                    'email',
                    Rule::unique('subscribers')->where(function ($query) use($inputs){
                        return $query->where('website_id', $inputs['website_id']);
                    })
                ],
                'website_id' => 'required',
            ],
            [
                "email.unique" => "The email has already been taken for this website."
            ]
        );

        if ($validator->fails()) {
            $response = [
                'status'  => 0,
                'errors'  => $validator->errors(),
                'message' => implode(",", $validator->messages()->all()),
            ];
        } else {
            $subscriber     = Subscriber::create($inputs);
            $response = [
                'status'  => 1,
                'data'    => [
                    'subscriber_id' => $subscriber->id,
                ],
                'message' => "Post Publish successfully",
            ];
        }
        return response()->json($response);
    }
}
