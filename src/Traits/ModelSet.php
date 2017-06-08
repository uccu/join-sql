<?php
namespace uccu\JoinSql\Traits;

use uccu\JoinSql\Sql\Table;

Trait ModelSet{


    protected function setTable(Table $table){

        $this->_table = $table;

    }


    protected function setColumns(){

        $this->_fun->handle->query('SHOW FULL COLUMNS FROM '.$this->_table->name);
        $this->_fun->handle->getData();


        return $this;
    }



}