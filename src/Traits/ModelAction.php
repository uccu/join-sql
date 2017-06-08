<?php
namespace uccu\JoinSql\Traits;

use uccu\JoinSql\Sql;

Trait ModelAction{

    
    
    public $lastSql;

    protected function handleGetActionIfNull(){

        !$this->_select && $this->_select = new Sql\Select();

    }

    
    public function query(){

        
    }
    
    public function get(){

        $this->handleGetActionIfNull();

        $sql = 'SELECT ' . $this->_select . ' FROM '.$this->_table ;


        $this->_conditions  && $sql .= ' WHERE '.$this->_conditions;
        $this->_group       && $sql .= ' GROUP BY '.$this->_group;
        $this->_order       && $sql .= ' ORDER BY '.$this->_order;
        $this->_limit       && $sql .= ' LIMIT '.$this->_limit;
        $this->_offset      && $sql .= ' OFFSET '.$this->_offset;


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

        return $this->get()->index(0);
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