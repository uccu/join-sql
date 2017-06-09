<?php
namespace uccu\JoinSql\Sql;

use ArrayAccess;

class RowArray implements ArrayAccess{

    private $_rows = [];

    function __toString(){

        return json_encode($this->_rows);
    }

    function offsetExists ($offset){

        return isset($this->_rows[$offset]);
    }
    function offsetGet ($offset) {

        return $this->_rows[$offset];
    }

    function offsetSet ($offset, $value) {
        
        return $this->_rows[$offset] = $value;
    }

    function offsetUnset ($offset) {

        unset($this->_rows[$offset]);
    }


    function index($num = null){

        return $this->offsetExists($num) ? $this->_rows[$offset] : false;

    }







}