<?php
class page
{
        protected $pageBody;

        public function get(){}

        public function post(){}

        public function __destruct()
        {
                echo $this->pageBody;
        }
}
