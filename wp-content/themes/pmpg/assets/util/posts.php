<?php
    class Posts{
        private $per_pages_post;
        private $current_page;
        private $offset;
        private $type;
        private $posts;
        private $cat_ID;

        function __construct($per_pages_post, $offset, $type, $numPage, $cat_ID){
            $this -> per_pages_post = $per_pages_post;
            $this -> offset = $offset;
            $this -> type = $type;
            $this -> current_page = $numPage;
            $this -> cat_ID = $cat_ID;
        }
        function __destruct(){
            wp_reset_postdata();
        }

        public function get_posts(){
            $offset = $this -> offset + (($this->current_page-1) * $this -> per_pages_post);
            $query = (array(
                'post_type' => $this->type,
                'cat' => $this->cat_ID,
                'posts_per_page' => $this->per_pages_post,
                'offset'=>$offset
            ));

            $this->posts = new WP_Query($query);
        }

        public function get_num_posts(){
            return ($this->posts)->found_posts;
        }

        public function have_posts(){
            return ($this->posts)->have_posts();
        }

        public function the_post(){
            return ($this->posts)->the_post();
        }

        public function is_first_page(){
            if($this->current_page == 1)
                return true;
            return false;
        }

        public function get_num_pages(){
            return ceil($this->get_num_posts()/$this->per_pages_post);
        }

        public function pagination($mid){
            $num_pages = $this->get_num_pages();
            $arr = array();

            if($num_pages > $mid*2){
                if(($this->current_page-$mid) <= 1){
                    $sub = 1;
                }else{
                    $sub = ($this->current_page-$mid);
                }

                for($i = $sub; $i < $this->current_page; $i++){
                    array_push($arr, $i);
                }

                for($i = $this->current_page; $i <= ($this->current_page+$mid) && $i <= $num_pages; $i++){
                    array_push($arr, $i);
                }

            }else{
                for($i = 1; $i <= $num_pages; $i++){
                    array_push($arr, $i);
                }
            }

            return $arr;
        }

        public function get_current_page(){
            return $this->current_page;
        }

    }