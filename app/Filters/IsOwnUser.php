<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class IsOwnUser implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */

    //  Before working on update/delete, 
    //  check the current user is the same as the author of the article.
    public function before(RequestInterface $request, $arguments = null)
    {
        // session / model 선언
        $session = session();
  
        // user_id  
        $current_user_id = $session->get('user_id');

        // url parser
        $url_parser = explode('/', uri_string());
        $post_category = $url_parser[0];
        $post_id = $url_parser[1];

         // verify logined
        if (!$session->get('is_login')) {
            echo "<script> alert('Loginしたあと利用してください。');window.location.assign('".base_url('login?URL='.current_url())."');</script>";
        }        
        
        // branch out according to the category of the post 
        if ($post_category === 'meeting') {
            $meetingModel = model('MeetingModel');
            $post_user_id = $meetingModel->find($post_id)['user_id'];
            
        } else { // sale Post일 경우
            $saleModel = model('SaleModel');
            $post_user_id = $saleModel->find($post_id)['user_id'];                        
        }        

        // Check if this post is the current user's.
        if (!($post_user_id === $current_user_id)) {
            echo "<script> alert('作成者だけが利用できる機能です。');window.location.assign('".previous_url()."');</script>";
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
