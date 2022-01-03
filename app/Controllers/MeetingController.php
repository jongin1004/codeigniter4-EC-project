<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class MeetingController extends BaseController
{
    protected $categoryModel;
    protected $meetingModel;
    protected $db;

    function __construct()
    {
        $this->db = db_connect();
        $this->categoryModel = model('CategoryModel');
        $this->meetingModel = model('MeetingModel');
    }

    public function index()
    {
        
    }

    public function createForm()
    {        
        $categories = $this->categoryModel->findAll();
        
        return view('meeting/createForm.php', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        helper('form');
        $validation = service('validation');
        $getPost = $this->request->getPost();
        $getPost['user_id'] = 1;        


        if (! $validation->run($getPost, 'meeting_create')) {
            $categories = $this->categoryModel->findAll();
            $errors = $validation->getErrors();
            echo view('meeting/createForm', [
                'errors' => $errors,
                'categories' => $categories,
            ]);
        }

        $data = [
            'user_id' => 1,
            'category_id' => $getPost['category_id'],
            'meeting_title' => $getPost['meeting_title'],
            'meeting_description' => $getPost['meeting_description'],
        ];

        if ($this->meetingModel->insert($data)) {
            echo "성공";
        } else {
            echo "실패";
        }
        
        // var_dump($getPost);
    }

    public function showDetail($id)
    {   
        $meeting_post = $this->meetingModel->find($id);

        echo view('meeting/showDetail', [
            'meeting_post' => $meeting_post
        ]);
    }

    public function modifyForm($id)
    {
        $categories = $this->categoryModel->findAll();
        $meeting_post = $this->meetingModel->find($id);
        echo view('meeting/modifyForm', [
            'meeting_post' => $meeting_post,
            'categories' => $categories,
        ]);
    }
}
