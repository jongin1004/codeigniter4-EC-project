<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class IsSaled implements FilterInterface
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
    // 選択した商品が既に販売されたかどおかを確認し、フィルタリング
    public function before(RequestInterface $request, $arguments = null)
    {
        $saleModel = model('SaleModel');

        // url parser
        $url_parser = explode('/', uri_string());        
        $post_id = $url_parser[1];
        
        $sale_post = $saleModel->find($post_id);    
        if (!$sale_post) {
            echo "<script> alert('存在しない商品です。');window.location.assign('".previous_url()."');</script>";
            
        }        

        if ($sale_post['is_saled'] === 'y') {
            echo "<script> alert('既に販売された商品です。');window.location.assign('".previous_url()."');</script>";            
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
