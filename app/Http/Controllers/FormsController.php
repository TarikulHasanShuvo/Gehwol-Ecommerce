<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FormsController extends Controller
{
    public function subscribeToNewsletter(Request $request) {

        $validated = $request->validate([
            'email' => 'required|email',
        ]);
        
        return response()->json(array(
            'success' => true,
        ), 200);
    }
    public function contactUs(Request $request) {

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'privacy' => 'required',
        ]);
        
        return response()->json(array(
            'success' => true,
        ), 200);
    }
    public function review(Request $request) {

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'privacy' => 'required',
        ]);
        
        return response()->json(array(
            'success' => true,
        ), 200);
    }

    public function payment(Request $request) {

        $validated = $request->validate([
            'card_type' => 'required',
            'card_number' => 'required',
            'holders_name' => 'required',
            'card_date' => 'required',
            'card_cvc' => 'required',
        ]);
        
        return response()->json(array(
            'success' => true,
        ), 200);
    }
    public function register_for_event(Request $request) {

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        
        return response()->json(array(
            'success' => true,
        ), 200);
    }

    public function add_address(Request $request) {

        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);
        
        return response()->json(array(
            'success' => true,
        ), 200);
    }
    
}
