<?php

namespace App\Controllers;

use Exception;
use App\Controllers\BaseController;

class FetchController extends BaseController
{
    public function getMoreSale()
    {
        $offset = $this->request->getPost('offset');        
        $saleModel = model('SaleModel');
        $sale_posts = $saleModel->where('is_delete <>', 'y')
                                    ->orderby('sale_id', 'desc')
                                    ->findAll(3, $offset); // findall(가져올 숫자, offset);        

        echo view('sale/saleList', [
            'sale_posts' => $sale_posts
        ]);
    }

    public function getMoreMeeting()
    {
        $offset = $this->request->getPost('offset');        
        $meetingModel = model('MeetingModel');
        $meeting_posts = $meetingModel->where('is_delete <>', 'y')
                                    ->orderby('meeting_id', 'desc')
                                    ->findAll(3, $offset); // findall(가져올 숫자, offset);        

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

        $insertData = [
            'comment_description' => $getPost['comment_description'],
            'meeting_id'          => $getPost['meeting_id'],
            'user_id'             => $getPost['user_id'],
        ];                
                    
        $insert_id = $commentModel->insert($insertData);
        if (!$insert_id) {
            echo "실패";
            exit;
        }
            
        $comment = $commentModel->getCommentAndUser($insert_id);                     
        echo view('meeting/comment', [
            'comment' => $comment[0]
        ]);

        // try {
        //     if (!$is_validate) {
        //         $data['error'] = $validation->getErrors();
        //         throw new Exception(json_encode($data));
        //     }

        //     $data = [
        //         'comment_description' => $getPost['comment_description'],
        //         'meeting_id'          => $getPost['meeting_id'],
        //         'user_id'             => $getPost['user_id'],
        //     ];
                    
        //     $insert_id = $commentModel->insert($data);
        //     if (!$insert_id) {
        //         echo "실패";
        //         exit;
        //     }
            
        //     $comment = $commentModel->getCommentAndUser($insert_id);                     
        //     echo view('meeting/comment', [
        //         'comment' => $comment[0]
        //     ]);
        // }

        // //catch exception
        // catch(Exception $e) {
        //     // $response = [
        //     //     'state'   => 'sibal',
        //     //     'message' => $e->getResponse(),
        //     // ];    
        //     // echo $response;
        //     // exit;
        //     echo $e->getMessage();
        //     return;
        //     // return $this->response->setJSON(json_encode($response));
        // }    
    }
}
