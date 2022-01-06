<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class MainPageController extends BaseController
{
    public function index()
    {
        $meetingModel = model('MeetingModel');
        $saleModel = model('SaleModel');
        $meeting_posts = $meetingModel->where('is_delete <>', 'y')
                                    ->orderBy('meeting_id', 'desc')
                                    ->findAll(3, 0);

        $sale_posts = $saleModel->where('is_delete <>', 'y')
                                    ->orderBy('sale_id', 'desc')
                                    ->findAll(3, 0);    
                                    
        echo view('product_list', [
            'meeting_posts' => $meeting_posts,
            'sale_posts'    => $sale_posts,
        ]);
    }
}
