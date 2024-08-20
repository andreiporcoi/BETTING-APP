<?php

namespace App\Http\Controllers;

use App\Models\AdminConfig;
use App\Models\Notifications as ModelsNotifications;
use App\Models\NotificationTokens;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{

    public function userNotifications()
    {
        try {
        $userEmail =  auth()->user()->email;
        $notifications=ModelsNotifications::where('email', $userEmail)->orWhere('email','all')->orderBy('created_at', 'desc')->get();

        return response()->json([
            'status' => true,
            'message' => $notifications,
        ], 200);
    } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => $th->getMessage()
        ], 500);
    }
    }

    public function sendNotification(Request $request)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $adminConfig = AdminConfig::where('title', 'serverKey')->first();
        $serverKey = $adminConfig->value;
        // $serverKey = env('SERVER_KEY');

            $data = [
                'to'=> "/topics/$request->topic",
                "notification" => [
                    "title" => $request->notificationTitle,
                    "body" => $request->notificationBody,
                ]
            ];



        $encodedData = json_encode($data);

        $headers = [
            'Authorization:key= ' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
        // FCM response


    // Define fields to remove
    $fieldsToRemove = ['topic'];

    // Remove specified fields from the request body
    $data = $request->except($fieldsToRemove);

        return ModelsNotifications::create($data);

    }

    public function destroy($id)
    {

    return ModelsNotifications::destroy($id);
    }
}