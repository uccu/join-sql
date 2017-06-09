<?php
namespace uccu\JoinSql\Traits;

use uccu\JoinSql\Sql\Table;

Trait ModelSet{

    protected $_table;

    protected function setTable(Table $table){
        
        $this->_table = $table;

    }


    /*protected*/ function setColumns(){

        $this->_fun->handle->query('SHOW FULL COLUMNS FROM '.$this->_table->name);
        $data = $this->_fun->handle->getData('Field');

        var_dump($data);
        return $this;
    }

    protected function setJoinField(string $field = null){

        

    }

}