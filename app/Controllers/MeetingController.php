<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class MeetingController extends BaseController
{
    protected $categoryModel;
    protected $meetingModel;
    protected $commentModel;
    protected $db;

    function __construct()
    {
        $this->db = db_connect();
        $this->categoryModel = model('CategoryModel');
        $this->meetingModel = model('MeetingModel');
        $this->commentModel = model('CommentModel');
    }

    public function index()
    {
        $result = $this->commentModel->getsCommentAndUser(6);
        var_dump($result);
    }

    public function createForm()
    {        
        $categories = $this->categoryModel->where('category_type', 'meeting')->findAll();
        
        return view('meeting/createForm.php', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        // helper('form');
        $session = session();
        $validation = service('validation');
        $getPost = $this->request->getPost();
        $getPost['user_id'] = 1;        


        if (! $validation->run($getPost, 'meeting_create')) {
            $categories = $this->categoryModel->where('category_type', 'meeting')->findAll();
            $errors = $validation->getErrors();
            echo view('meeting/createForm', [
                'errors' => $errors,
                'categories' => $categories,
            ]);
        }

        $data = [
            'user_id' => $session->get('user_id'),
            'category_id' => $getPost['category_id'],
            'meeting_title' => $getPost['meeting_title'],
            'meeting_description' => $getPost['meeting_description'],
        ];

        $insertResult = $this->meetingModel->insert($data);
        $meeting_id = $this->meetingModel->getInsertID();

        if (! $insertResult ) {
            echo "성공";
        }

        return redirect()->to(base_url('/meeting/'.$meeting_id));        
    }

    public function showDetail($id = null)
    {   
        $meeting_post = $this->meetingModel->find($id);
        $meeting_comments = $this->commentModel->getsCommentAndUser($id);

        echo view('meeting/showDetail', [
            'meeting_post' => $meeting_post,
            'meeting_comments' => $meeting_comments,
        ]);
    }

    public function modifyForm($id = null)
    {
        $categories = $this->categoryModel->where('category_type', 'meeting')->findAll();
        $meeting_post = $this->meetingModel->find($id);
        echo view('meeting/modifyForm', [
            'meeting_post' => $meeting_post,
            'categories' => $categories,
        ]);
    }

    public function modify($id = null)
    {
        // helper('form');
        $session = session();
        $validation = service('validation');
        $getPost = $this->request->getPost();

        if (!$validation->run($getPost, 'meeting_create')) {
            $meeting_post = $this->meetingModel->find($id);
            $categories = $this->categoryModel->where('category_type', 'meeting')->findAll();
            $errors = $validation->getErrors();
            echo view('meeting/modifyForm', [
                'categories' => $categories,
                'errors' => $errors,
                'meeting_post' => $meeting_post
            ]);
        } 

        $data = [
            'user_id' => $session->get('user_id'),
            'category_id' => $getPost['category_id'],
            'meeting_title' => $getPost['meeting_title'],
            'meeting_description' => $getPost['meeting_description'],
        ];

        $updateResult = $this->meetingModel->update($id, $data);
        if ( $updateResult ) {
            return redirect()->to(base_url('meeting/'.$id));
        }        
    }

    public function delete($id = null)
    {   
        $data = [
            'is_delete' => 'y',
        ];
        $deleteResult = $this->meetingModel->update($id, $data);

        if (! $deleteResult ) {
            echo "삭제실패";
            exit;
        }

        return redirect()->to(base_url('/'));
    }
}
