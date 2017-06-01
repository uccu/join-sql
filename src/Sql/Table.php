<?php
namespace uccu\JoinSql\Sql;


class Table {

    public $database;

    function __construct(string $tableName,Database $database){

        $this->database = $database;
        $this->prefix = $database->defaultPrefix;

        $this->sqlName = Handle::quoteField($this->prefix.$tableName);
        $this->name = $this->prefix.$tableName;


    }

    function setDatabase(Database $database){

        $this->database = $database;
        $this->prefix = $database->defaultPrefix;
        $this->sqlName = Handle::quoteField($this->prefix.$tableName);
        $this->name = $this->prefix.$tableName;

    }
    
    











}