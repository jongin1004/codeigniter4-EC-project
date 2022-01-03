<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Controllers\BaseController;

class MeetingController extends BaseController
{
    protected $categoryModel;
    protected $db;

    function __construct()
    {
        $this->db = db_connect();
        $this->categoryModel = model('CategoryModel');
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
        $validation = service('validation');
        $getPost = $this->request->getPost();
        $getPost['user_id'] = 1;
        var_dump($getPost);

        if (! $validation->run($getPost, 'meeting_create')) {
            echo "실패";
            exit;
        }

        echo "성공";
        exit;
        
        var_dump($getPost);
    }
}
