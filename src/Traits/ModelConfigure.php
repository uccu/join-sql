<?php
namespace uccu\JoinSql\Traits;

use uccu\JoinSql\Sql;

Trait ModelConfigure{

    protected $_select;
    protected $_fields;
    protected $_conditions;
    protected $_limit;
    protected $_offset;
    protected $_group;
    protected $_order;


    public function select(){

        $container = func_get_args();

        foreach($container as $k=>$field){
            
            @list($field,$fas) = explode('>',$field);

            $select[] = Sql\Handle::quoteField($field);


        }

        $this->_select = implode(', ' ,$select);

        return $this;
    }

    public function group($field = null){

        if(!$field)return $this;

        $field = Sql\Handle::quoteField($field);
        $this->_group = $field;
        return $this;
    }

    public function order($fiel = null,$desc = null){

        $container = func_get_args();

        $count = count($container);
        if(!$count)return $this;

        is_string($desc) && $desc = strtoupper($isDesc);

        if($desc === 'RAW'){

            $this->_order = $fiel;return $this;

        }elseif(in_array($desc,['DESC','ASC']) || is_numeric($desc) || is_bool($desc)){

                $desc && $desc !== 'ASC' && $container[0] .= ' DESC';
                unset($container[1]);
            
        }


        $orders = [];

        foreach($container as $k=>$field){
            
            @list($field,$desc) = explode(' ',$field);

            $field = Sql\Handle::quoteField($field);

            $orders[] = $field.' '. (strtoupper($desc) !=='DESC' ? 'ASC' : 'DESC');

        }

        $this->_order = implode(', ' ,$orders);

        return $this;
        
    }

    public function set(){


    }

    public function where(){


        
    }


   
    # OFFSET与LIMIT
    public function offset(int $offset = null){

        if(!$offset)return $this;
        $offset<0 && $offset = 0;
        $this->_offset = $offset;
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