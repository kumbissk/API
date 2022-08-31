<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Vonage\Client\Credentials\Basic;
use \Exception;


class ServicesMessagerieController extends Controller{


    /**
     * Write code on Method
     *
     * @return response()
    */
    public function index(Request $request)
    {
        try {
  
            $basic  = new \Vonage\Client\Credentials\Basic(getenv("NEXMO_KEY"), getenv("NEXMO_SECRET"));
            $client = new \Vonage\Client($basic);
  
            $receiverNumber = "91846XXXXX";
            $message = "This is testing from ItSolutionStuff.com";
  
            $message = $client->message()->send([
                'to' => $receiverNumber,
                'from' => 'Vonage APIs',
                'text' => $message
            ]);
  
            dd('SMS Sent Successfully.');
              
        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
    }

    // public function sendSMS($numero, $message){
    //     $credentials = new Basic('api-key', 'api-secret');
    //     $client = new \Vonage\Client($credentials);
    //     $message = new \Vonage\Message\Text($message);
    //     $message->setTo($numero);
    //     $message->setFrom('');
    //     $client->send($message);
    // }
    // $basic  = new Basic("f4b58ac0", "XwXDPi9H00U6knfD");
    // $client = new Client($basic);

    // function messaging()
    // {
    //     $response = $client->sms()->send(
    //         new \Vonage\SMS\Message\SMS("221784326064", BRAND_NAME, 'A text message sent using the Nexmo SMS API')
    //     );
        
    //     $message = $response->current();
        
    //     if ($message->getStatus() == 0) {
    //         echo "The message was sent successfully\n";
    //     } else {
    //         echo "The message failed with status: " . $message->getStatus() . "\n";
    //     }
    // }
}
