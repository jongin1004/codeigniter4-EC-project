<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class FetchController extends BaseController
{
    public function getMore()
    {
        $offset = $this->request->getPost('offset');        
        $meetingModel = model('MeetingModel');
        $meeting_posts = $meetingModel->where('is_delete <>', 'y')
                                    ->orderby('meeting_id', 'desc')
                                    ->findAll(4, $offset); // findall(가져올 숫자, offset);        

        echo view('meeting/meetingList', [
            'meeting_posts' => $meeting_posts
        ]);
    }

    public function saveComment()
    {
        $session = session();
        $commentModel = model('CommentModel');
        $validation = service('validation');

        $getPost = $this->request->getPost();
        $getPost['user_id'] = $session->get('user_id');

        $is_validate = $validation->run($getPost, 'comment');
        if (!$is_validate) {
            $data['error'] = $validation->getErrors();
            echo view('meeting/showDetail', [
                'errors' => json_encode($data)
            ]);
            exit;
        }

        // try {
        //     if (!$is_validate) {
        //         $data['error'] = $validation->getErrors();
        //         throw new Exception(json_encode($data));
        //     }

            // $data = [
            //     'comment' => $getPost['comment_description'],
            //     'blog_id' => $getPost['meeting_id'],
            //     'user_id' => $getPost['user_id'],
            // ];

        //     // if ($model->insert($data)) {
        //     //     $data['data'] = $model->gets($data['blog_id']);
        //     // };

        //     // echo view('comment', ['comments' => $data['data']]);
        //     // return;            
        //     // $this->_sendEmail($data['blog_id']);
        // }

        // //catch exception
        // catch(Exception $e) {
        //     echo $e->getMessage();
        //     return;
        // }


        $data = [
            'comment_description' => $getPost['comment_description'],
            'meeting_id' => (int) $getPost['meeting_id'],
            'user_id' => (int) $getPost['user_id'],
        ];
                
        $insert_id = $commentModel->insert($data);
        if (!$insert_id) {
            echo "실패";
            exit;
        }
        
        $comment = $commentModel->getCommentAndUser($insert_id);                     
        echo view('meeting/comment', [
            'comment' => $comment[0]
        ]);
    }
}
