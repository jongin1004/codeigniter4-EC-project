<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ChatController extends BaseController
{
    public function index($id = null)
    {
        // session 선언
        $session = session();
        
        // user id
        $to_id = $id;
        $from_id = $session->get('user_id');        

        $chatModel = model('ChatModel');
        $chats = $chatModel->getChats($to_id, $from_id);        

        echo view('chat/chat', [
            'to_id' => $to_id,
            'chats' => $chats,
        ]);
    }
    
    public function saveChat()
    {
        // session / service/ model 선언
        $session = session();
        $validation = service('validation');
        $chatModel = model('ChatModel');

        // get data of the post method
        $getPost = $this->request->getPost();
        $getPost['from_id'] = $session->get('user_id');        

        $is_validate = $validation->run($getPost, 'chat');    
        if (!$is_validate) {
            $errors = $validation->getErrors();
            echo view('chat/chat', [
                'errors' => $errors
            ]);
        }

        $insertData = [
            'to_id' => $getPost['to_id'],
            'from_id' => $getPost['from_id'],
            'chat_message' => $getPost['chat_message'],
        ];

        $insert_id = $chatModel->insert($insertData);
        if (!$insert_id) {
            echo "error: can't insert";
        }

        $chat = $chatModel->find($insert_id);

        echo view('chat/chatList', [
            'chat' => $chat,
        ]);
    }
}
