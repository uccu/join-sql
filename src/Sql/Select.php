<?php
namespace uccu\JoinSql\Sql;

use uccu\JoinSql\Traits;

class Select {

    private $_string = '*';

    function __construct($fields = null){

        

    }


    function __toString(){

        return $this->_string;

    }

}