<?php

namespace App\Http\Controllers;

use Infobip\ApiException;
use Infobip\Model\SmsAdvancedTextualRequest;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Configuration;
use Illuminate\Http\Request;
use Infobip\Api\SmsApi;

class SendSMSController extends Controller
{
    //

    public function loadPage(){
        return view('send-sms');
    }

    public function sendSMS(Request $request){
        $configuration = new Configuration(
            host: '1vmyjk.api.infobip.com',
            apiKey: '823be8c0f3501ed29fb963d1f05a4e06-974d2589-0679-42b9-814e-cd236e69f695'
        );

        $sendSmsApi = new SmsApi(config: $configuration);

        $message = new SmsTextualMessage(
            destinations: [
                new SmsDestination(to: $request->number)
            ],
            from: 'Uver',
            text: $request->message
        );

        $request = new SmsAdvancedTextualRequest(messages: [$message]);

        try {
            $smsResponse = $sendSmsApi->sendSmsMessage($request);
            return redirect('/send-sms')->with('success', 'SMS sent successfully');
        } catch (ApiException $apiException) {
            return redirect('/send-sms')->with('fail', $apiException->getMessage());
        }

        }
}
