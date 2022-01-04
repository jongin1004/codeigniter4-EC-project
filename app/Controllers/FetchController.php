<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class FetchController extends BaseController
{
    public function index()
    {
        $offset = $this->request->getPost('offset');
        // var_dump($start);
        // exit;

        $meetingModel = model('MeetingModel');
        $meeting_posts = $meetingModel->orderby('meeting_id', 'desc')->findAll(4, $offset); // findall(가져올 숫자, offset);

        // var_dump($meeting_posts);

        echo view('meeting/meetingList', [
            'meeting_posts' => $meeting_posts
        ]);
    }
}
