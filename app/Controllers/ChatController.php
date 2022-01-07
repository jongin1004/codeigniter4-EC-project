<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ChatController extends BaseController
{
    public function index($id = null)
    {
        echo view('chat/chat', [
            'to_id' => $id
        ]);
    }
    
    public function saveChat()
    {
        // session / service/ model 선언
        $session = session();
        $validation = service('validation');
        $chatModel = model('ChatModel');

        $getPost = $this->request->getPost();
        $getPost['from_id'] = $session->get('user_id');

        $is_validate = $validation->run($getPost, 'chat');
        if (!$is_validate) {
            $errors = $validation->getErrors();
            echo view('chat/chat', [
                'errors' => $errors
            ])
        }

        $insertData = [
            'to_id' => $getPost['to_id'],
            'from_id' => $getPost['from_id'],
            'chat_message' => $getPost['chat_message'],
        ];
        $chatModel = 
    }
}
