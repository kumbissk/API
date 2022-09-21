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
        $message = $request->message;
        $numero = $request->telephone;
  
        $basic  = new \Vonage\Client\Credentials\Basic("f4b58ac0", "XwXDPi9H00U6knfD");
        $client = new \Vonage\Client($basic);

        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS('221'.$numero, "test msg", $message)
        );
        
        $message = $response->current();
        
        if ($message->getStatus() == 0) {
            echo "The message was sent successfully\n";
        } else {
            echo "The message failed with status: " . $message->getStatus() . "\n";
        }

            
            // return response()->json([
            //     'message' => 'Message sent successfully',
            //     'status' => 'success'
            // ], Response::HTTP_OK, [
            //     'Access-Control-Allow-Origin' => '*',
            // ]);


            // dd('SMS Sent Successfully.');
              

    }
    
}
