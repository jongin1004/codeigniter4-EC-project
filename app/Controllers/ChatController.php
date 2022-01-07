<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ChatController extends BaseController
{
    public function index($id = null)
    {
        // session /model 선언
        $session = session();
        $chatModel = model('ChatModel');        

        // user id
        $to_id = $id;
        $from_id = $session->get('user_id');        
                
        $chats = $chatModel->getChats($to_id, $from_id);
        $chatTarget = $chatModel->getChatTarget($from_id);
                
        echo view('chat/chat', [
            'to_id' => $to_id,
            'chats' => $chats,
            'chatTarget' => $chatTarget,
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

        $chat = $chatModel->getChat($insert_id);

        // var_dump($chat);
        // exit;
        echo view('chat/chatList', [
            'chat' => $chat[0],
        ]);
    }
}
