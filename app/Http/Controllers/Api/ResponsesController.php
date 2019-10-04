<?php

namespace App\Http\Controllers\Api;
use App\FromRequest;
use App\Vehicle;
use App\Workshop;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResponsesController extends Controller
{
    public function sendEmail(Request $request){
        
        $userId = (int)$request->userId;
        $campaingId = (int)$request->campaingId;
        $serial = $request->serial;
        $userName = $request->name;
        $userEmail = $request->email;
        $phone = $request->phone;
        $model = $request->model;
        $year = $request->year;
        $date = $request->date;
        $workshopId = (int)$request->workshopId;
        $workshop = Workshop::findOrFail($workshopId);
        $vehicle = Vehicle::where('serial',$serial)->first();

        $client = new Client([
            'base_uri' => 'https://api.sendgrid.com/v3/mail/send',
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer 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',
                'Content-Type' => 'application/json'
            ]
        ]);
        $to = $userEmail;
        $data = json_encode(
            [
                'from' => [
                    'email' => 'contacto@toyota.com',
                    'name' => 'Contacto Toyota',
                ],
                'personalizations' => [
                    array(
                        "to" => array([
                            'email' => $to
                        ]),
                        'dynamic_template_data' => [
                            'name' => $userName,
                            'userEmail' => $userEmail,
                            'phone' => $phone,
                            'model' => $model,
                            'year' => $year,
                            'date' => $date,
                            'workshopName' => $workshop->name,
                        ]
                    )
                ],
                'template_id' => 'd-cec4083f6d144bc28c149b5b26931ae1',
            ]
        );
        $to = $workshop->email;
        $dataWorkshop = json_encode(
            [
                'from' => [
                    'email' => 'contacto@toyota.com',
                    'name' => 'Contacto Toyota',
                ],
                'personalizations' => [
                    array(
                        "to" => array([
                            'email' => $to
                        ]),
                        'dynamic_template_data' => [
                            'name' => $userName,
                            'userEmail' => $userEmail,
                            'phone' => $phone,
                            'model' => $model,
                            'year' => $year,
                            'date' => $date,
                            'workshopName' => $workshop->name,
                        ]
                    )
                ],
                'template_id' => 'd-cec4083f6d144bc28c149b5b26931ae1',
            ]
        );
        $response = $client->post(
            'https://api.sendgrid.com/v3/mail/send',
            ['body' => $data]
        );
        $response = $client->post(
            'https://api.sendgrid.com/v3/mail/send',
            ['body' => $dataWorkshop]
        );

        $fromResponse = new FromRequest();
        $fromResponse->name = $userName;
        $fromResponse->email = $userEmail;
        $fromResponse->phone = $phone;
        $fromResponse->model = $model;
        $fromResponse->year = $year;
        $fromResponse->date = $date;
        $fromResponse->workshop_id = $workshop->id;
        $fromResponse->user_id = $userId;
        $fromResponse->campaing_id = $campaingId;
        $fromResponse->vehicle_id = $vehicle->id;
        $fromResponse->save();

        return response(['message' => 'Success', 'data' =>'Sending email...']);
    }

    public function hola(Request $request){
        return response(['message' => 'Success', 'data' =>'Sending email...']);
    }
}