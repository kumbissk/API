<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Vonage\Client\Credentials\Basic;
use \Exception;
use Illuminate\Http\Response;

class MessagerieServicesController extends Controller
{
    /**
     * Write code on Method
     * 
    */
    public function messaging(Request $request)
    {
        // return $request->all();
        try {
  
            $basic  = new \Vonage\Client\Credentials\Basic(getenv("NEXMO_KEY"), getenv("NEXMO_SECRET"));
            $client = new \Vonage\Client($basic);
  
            $receiverNumber = "221784326064";
            $message = $request->message;
            
            $message = $client->message()->send([
                'to' => $receiverNumber,
                'from' => 'Vonage APIs',
                'text' => $message
            ]);

            
            // return response()->json([
            //     'message' => 'Message sent successfully',
            //     'status' => 'success'
            // ], Response::HTTP_OK, [
            //     'Access-Control-Allow-Origin' => '*',
            // ]);


            // dd('SMS Sent Successfully.');
              
        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
    }
    
}
