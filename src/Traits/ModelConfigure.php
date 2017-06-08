<?php
namespace uccu\JoinSql\Traits;

Trait ModelConfigure{

    public function select(){


    }

    public function group(){

    }

    public function set(){


    }

    public function where(){


        
    }

   

    public function offset(int $offset = null){

        if(!$offset)return $this;
        $offset<0 && $offset = 0;
        $this->_limit = $offset;
        return $this;

    }
    public function limit(int $limit = null){

        if(!$limit)return $this;
        $limit<1 && $limit = 1;
        $this->_limit = $limit;
        return $this;

    }
    public function page(int $page = 1,int $count = null){
        
        $count = $this->limit($count)->_limit;

        if($count){

            $page<1 && $page = 1;
            $offset = ( $page - 1 ) * $count;
            $this->offset($offset);
        }

        return $this;

    }
}