<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Controller;
use App\Models\GiftCertificate;
use Illuminate\Http\Request;

class GiftsController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkGiftCardBalance(Request $request)
    {
        $gift = GiftCertificate::paid()->where('gift_card_code', $request->gift_card_code)->first();
        return response()->json([
            'data' => $gift,
            'success'=> true,
        ],200);
    }

}
