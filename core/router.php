<?php
class router
{
        public function __construct()
        {
                $page_request = 'pageDepartments';

                if (isset($_REQUEST['page']))
                {
                        $page_request = $_REQUEST['page'];
                }

                $page = new $page_request;

                if($_SERVER['REQUEST_METHOD'] == 'GET')
                {
                        $page->get();
                } else {
                        $page->post();
                }
        }
}
