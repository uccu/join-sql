<?php
namespace uccu\JoinSql\Traits;

use uccu\JoinSql\Sql;

Trait ModelAction{

    protected $_select;
    protected $_fields;
    protected $_conditions;
    
    public $lastSql;

    protected function handleGetActionIfNull(){

        !$this->_select && $this->_select = new Sql\Select();

    }
    
    public function get(){

        $this->handleActionIfNull();

        $sql = 'SELECT '.$this->_select . ' FROM '.$this->_table ;

        if(!$this->_query){

            $this->_conditions  && $sql .= ' '.$this->_conditions;
            $this->_group       && $sql .= ' '.$this->_group;
            $this->_order       && $sql .= ' '.$this->_order;
            $this->_limit       && $sql .= ' '.$this->_limit;
            $this->_offset      && $sql .= ' '.$this->_offset;

        }else $sql .= ' '.$this->_query;
        


        $this->lastSql = $sql;

        return new Sql\RowArray($this);
    }

    public function find(){
        
        $this->_limit = 1;
        $container = func_get_args();

        if(count($container)){

            if(!$this->primaryField)throw new Exception('主键不存在！');

            $field = new Sql\Field($this->primaryField,$this);

            $this->where = '';

            $this->where([$this->primary=>$id]);

        }

        return $this->get()->find(0);
    }
    public function save(){

        
    }
    public function remove(){

        
    }
    public function add(){

        
    }
    public function replace(){

        
    }

}