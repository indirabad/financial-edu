<?php
namespace App\Library;

class Mailchimp
{
    public static function subscribe($email, $form = null, $name = null, $address = null, $listId = null)
    {
        $data = [
            'email_address' => $email,
            'status'        => 'subscribed'
        ];

        if(!empty($name)) {
            $nameParts = explode(" ", $name);

            $lastName = null;
            if(count($nameParts) > 1) {
                $lastName = array_pop($nameParts);
            }

            $data['merge_fields'] = [
                'FNAME' => implode(" ", $nameParts)
            ];

            if(!empty($lastName)) {
                $data['merge_fields']['LNAME'] = $lastName;
            }
        }

        if(!empty($form)) {
            $data['tags'] = [$form];
        }

        $response = self::listRequest('members', $data, $listId);

        if(empty($response) || ($response->status != 'subscribed' && $response->title != 'Member Exists')) {
            throw new \Exception(json_encode($response));
        }

        return $response;
    }

    public static function uploadFile($name, $base64EncodedFile)
    {
        $data = [
            'name'      => $name,
            'file_data' => $base64EncodedFile
        ];

        $response = self::request('file-manager/files', $data);

        if(empty($response) || !empty($response->status)) {
            throw new \Exception(json_encode($response));
        }

        return $response;
    }

    private static function listRequest($apiMethod, $data = [], $listId = null, $method = 'POST')
    {
        $apiMethod = 'lists/' . $listId . (!empty($apiMethod) ? '/' . $apiMethod : '');

        return self::request($apiMethod, $data, $method);
    }

    private static function request($apiMethod, $data = [], $method = 'POST')
    {
        $response = null;

        $apiKey = get_option('mailchimp_api_key');

        $usX = explode("-", $apiKey);
        $usX = array_pop($usX);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://' . $usX . '.api.mailchimp.com/3.0/' . $apiMethod);
        curl_setopt($ch, CURLOPT_POST, $method == 'POST' ? 1 : 0);
        curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if(!empty($data)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response);
    }
}
