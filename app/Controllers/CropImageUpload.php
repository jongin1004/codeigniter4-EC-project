<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class CropImageUpload extends BaseController
{
    public function index()
    {    
        return view('crop-image-upload-form');
    }
 
    public function store()
    {  
        // session / model 선언부
        $session = session();
        $avatarModel = model('Avatar');        

        // parse data of image
        $imageData = $this->request->getPost('image');
        $image_array_1 = explode(";", $imageData);
        $image_array_2 = explode(",", $image_array_1[1]);
        $imageData = base64_decode($image_array_2[1]);

        // image -> public/images위치에 저장
        $imageName = time() . '.png';
        file_put_contents('images/'.$imageName, $imageData);
        // db에 저장하기 위해서 image 이름을 가져옴 
        $image_file = addslashes(file_get_contents('images/'.$imageName));

        // insert to db
        $data = [
            'user_id' => $session->get('user_id'),
            'avatar_title' => $imageName,
        ];
        $avatarModel->insert($data);        

        $response = [
            'success' => true,            
            'msg' => "Crop Image has been uploaded successfully in codeigniter"
        ];
    

        return $this->response->setJSON($response);        
    }
}