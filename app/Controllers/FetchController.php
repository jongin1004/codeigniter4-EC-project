<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class FetchController extends BaseController
{
    public function index()
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
}
