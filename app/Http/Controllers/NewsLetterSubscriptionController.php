<?php

namespace App\Http\Controllers;


use App\Http\Requests\SubscriptionStoreRequest;
use App\Models\NewsLetterSubscription;
use Illuminate\Http\Request;

class NewsLetterSubscriptionController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function adminIndex()
    {
        return view('backend.admin.subscription.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSubscriptions(Request $request)
    {
        $subscription = NewsLetterSubscription::latest()->paginate(5);
        return response()->json($subscription);
    }


    /**
     * @param SubscriptionStoreRequest $request
     * @return mixed
     */
    public function store(SubscriptionStoreRequest $request)
    {
        $result = NewsLetterSubscription::create($request->all());
        return $result;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $subscription = NewsLetterSubscription::find($request->id);
        $subscription->update($request->all());
        return response()->json($subscription);
    }
}
