<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class SaleController extends BaseController
{
    protected $categoryModel;
    protected $saleModel;    
    protected $db;

    function __construct()
    {
        $this->db = db_connect();
        $this->categoryModel = model('CategoryModel');
        $this->saleModel = model('SaleModel');        
    }

    public function createForm()
    {        
        $categories = $this->categoryModel->where('category_type', 'sale')->findAll();
        
        return view('sale/createForm.php', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        // helper('form');
        $session = session();
        $validation = service('validation');
        $getPost = $this->request->getPost();
        $getPost['user_id'] = $session->get('user_id');
        $getPost['file_id'] = 1;
        
        $is_validate = $validation->run($getPost, 'sale');
        if (!$is_validate) {
            $categories = $this->categoryModel->where('category_type', 'sale')->findAll();
            $errors = $validation->getErrors();
            echo view('sale/createForm', [
                'errors' => $errors,
                'categories' => $categories,
            ]);
        }        

        $data = [
            'user_id' => $getPost['user_id'],
            'category_id' => $getPost['category_id'],
            'file_id' => $getPost['file_id'],
            'sale_title' => $getPost['sale_title'],
            'sale_description' => $getPost['sale_description'],
            'sale_state' => $getPost['sale_state'],
            'sale_price' => $getPost['sale_price'],
        ];

        $sale_id = $this->meetingModel->insert($data);
        // $meeting_id = $this->meetingModel->getInsertID();

        if (! $sale_id ) {
            echo "Error: can't insert";
            exit;
        }

        echo "Success: success insert";

        // return redirect()->to(base_url('/sale/'.$sale_id));        
    }

    public function showDetail($id = null)
    {   
        $sale_post = $this->saleModel->find($id);        

        echo view('sale/showDetail', [
            'sale_post' => $sale_post,            
        ]);
    }

    public function modifyForm($id = null)
    {
        $categories = $this->categoryModel->where('category_type', 'sale')->findAll();
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
            $categories = $this->categoryModel->where('category_type', 'sale')->findAll();
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
