<?php
namespace uccu\JoinSql\Traits;

use uccu\JoinSql\Sql\Table;

Trait ModelSet{


    protected function setTable(Table $table){

        $this->_var->table = $table;
        $this->_var->table = $table;
    }
    protected function setPrefix(string $prefix){

        $this->_var->prefix = $prefix;
    }




}