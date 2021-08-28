<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GiftCertificateStoreRequest;
use App\Models\GiftCertificate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GiftCertificateController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('site.gift_purchase');
    }

    /**
     * @param GiftCertificateStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(GiftCertificateStoreRequest $request)
    {
        $gift_certificate = new GiftCertificate();
        $gift_certificate->fill($request->all());
        $gift_certificate->user_id = auth()->user()->id;
        $gift_certificate->save();
        return redirect()->back();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function adminIndex()
    {
        return view('backend.admin.gift-certificate.index');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGiftCertificates()
    {
        $giftCertificates = GiftCertificate::latest()->paginate(2);
        return response()->json($giftCertificates);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateGiftCertificate(Request $request, $id)
    {
        $gift_certificate =  GiftCertificate::find($id);
        $gift_certificate->fill($request->all());
        $gift_certificate->update();
        return response()->json($gift_certificate);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteGiftCertificate($id)
    {
        $gift_certificate =  GiftCertificate::find($id);
        $gift_certificate->delete();
        return response()->json('Success');
    }
}
