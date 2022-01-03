<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class MainPageController extends BaseController
{
    public function index()
    {
        $meetingModel = model('MeetingModel');
        // $saleModel = model('SaleModel');
        $meeting_posts = $meetingModel->findAll();
        echo view('product_list', [
            'meeting_posts' => $meeting_posts,
        ]);
    }
}