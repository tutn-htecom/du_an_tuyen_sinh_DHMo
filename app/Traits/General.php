<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

trait General
{    
    function rand_str($strength = 16) {
        $input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
        return $random_string;
    }

    function sendmail($data) {               
        try {
            Mail::send('includes.mail', $data, function ($message) use ($data) {
                $message->to($data['to'])
                        ->subject($data['subject']);
            });
            return response()->json([
                "code" => 200,
                "message" => "Gửi mail đăng ký thành công"
            ]);
        } catch (\Exception $e) {
           Log::error($e->getMessage());
           return response()->json([
                "code" => 422,
                "message" => "Gửi mail đăng ký thất bại"
           ]);
        }
       
    }
    // Upload nhiều ảnh
    function upload_image($param, $url, $id)
    {             
        $image = $param['image'];
        $name = str_replace(' ', '_', $image -> getclientoriginalname());            
        $image->move(public_path($url), $name);   
        $data = [
            "title" => $param['title'],
            "leads_id"  => $id,
            "image_url" => $url . $name,
            "created_by"=> $id
        ];
        return $data;
    }
    // Upload nhiều ảnh
    function upload_images($params, $url, $id)
    {             
        $data = [];
        foreach($params['images'] as $image)
        {  
            $name = str_replace(' ', '_', $image -> getclientoriginalname());            
            $image->move(public_path($url), $name);                       
            $data[] = [
                "title" => "Hồ sơ và văn bằng",
                "leads_id" => $id,
                "image_url" => $url . $name,
                "created_by" => $id
            ];
        }
        return $data;
        
    }
}