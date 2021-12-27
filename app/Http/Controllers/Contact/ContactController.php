<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\Review;

class ContactController extends Controller
{
    public function index(Request $request) {
        $reviews = Review::where('enabled', true)->get();

        return view('contact')
            ->with(['reviews' => $reviews]);
    }

    public function contact(Request $request) {
       
        $data = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email',
            'phone' => 'max:25',
            'message' => 'required|max:500',
            'reviews'=>'requirmax:500'
        ], [
            'name.*' => 'Enter a valid name',
            'email.*' => 'Enter a valid email',
            // 'phone' => 'Enter a valid phone',
            // 'message' => 'Enter a valid message',
        ]);
       
        try {
            // run your code here
            $result = Mail::to(env('MAIL_FROM_ADDRESS'))->send(new Contact($data));
            return redirect(route('contact'))->with([
                'message' => 'Thank you for contacting us.'    
            ]);
          
        }
        catch (\Exception $exception) {
            Log::debug('Failed to send mail');
            Log::debug($data);
            Log::debug($exception->getMessage());
            return redirect(route('contact'))->with([
                'message' => 'Thank you for contacting us. (E)'
            ]);
           
        }
        
    }
}
