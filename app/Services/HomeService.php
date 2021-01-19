<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;


class HomeService
{
    public function __construct()
    {
        $this->http_client = new \GuzzleHttp\Client();
    }

    public function fileUpload($request)
    {
        $file = $request->file('file');
        $md5Name = md5_file($file->getRealPath());
        $extension = $file->extension();
        $file = $file->storeAs('/files/csv', 'file.csv'  ,'public');
        $res = false;
        if($file){
            $file = \Storage::disk('public')->path('files/csv/file.csv');
            $data =  array_map('str_getcsv', file($file));
            $res = $this->sendToApi($data);
        }
        return $res;
     }

     public function sendToApi($data){
     	$url = env("AWS_API_URL");
     	$postData = ['data'=>$data];
     	//echo $postData;die;
     	//$response = $this->http_client->request('POST', $url, $postData);
     	$response = $this->http_client->request('POST', $url, [
     		'headers' => ['Content-Type' => 'application/json','api_key' => env('AWS_API_SECRET')],'json' => $postData]);
        $statusCode = $response->getStatusCode();
        $content = (string) $response->getBody();
        $content = str_replace("\"", "", $content);
        $parsedData = [];
        if ($statusCode == 200) {
          return $content;
        }
        return "<h3>No Data Found</h3>";
         
     }

    
}
