<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class CommentController extends BaseController
{
    public function index()
    {
        
    }

    public function save()
    {
        // session / model /service 선언
        $session = session();
        $validation = service('validation');
        $commentModel = model('CommentModel');

        // get data in POST 
        $getPost = $this->request->getPost();
        $getPost['user_id'] = $session->get('user_id');

        // validation
        $is_validate = $validation->run($getPost, 'comment');
        if (!$is_validate) {
            $errors = $validation->getErrors();
            echo view('meeting/showDetail', [
                'errors' => $errors,
            ]);
            return;
        }
        
        $data = [
            'user_id'             => $getPost['user_id'],
            'meeting_id'          => $getPost['meeting_id'],
            'comment_description' => $getPost['comment_description'],
        ];

        $insertResult = $commentModel->insert($data);
        $insert_id = $commentModel->getInsertID();
        $comment = $commentModel->find($inser_id);
        if (!$insertResult) {
            echo "insert 실패";
        }

        echo view('meeting/comment', [
            'comment' => $comment,
        ]);
    }
}
