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
        // helper(['form', 'url']);
        $session = session();
        $avatarModel = model('Avatar');

        // var_dump($this->request->getPost('image'));
        // exit;
        // $builder = $this->db->table('avatar');


        $imageData = $this->request->getPost('image');
        $image_array_1 = explode(";", $imageData);
        $image_array_2 = explode(",", $image_array_1[1]);
        $imageData = base64_decode($image_array_2[1]);

        $imageName = time() . '.png';

        file_put_contents($imageName, $imageData);

        $image_file = addslashes(file_get_contents($imageName));

        $data = [
            'user_id' => $session->get('user_id'),
            'avatar_title' => $image_file,
        ];

        $avatarModel->insert($data);
        // $save = $builder->insert(['title' =>  $image_file]);

        $response = [
            'success' => true,            
            'msg' => "Crop Image has been uploaded successfully in codeigniter"
        ];
    

        return $this->response->setJSON($response);
        
    }
}
