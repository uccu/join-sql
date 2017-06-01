<?php
namespace uccu\JoinSql\Sql;

use uccu\JoinSql\Base;
use uccu\JoinSql\Traits;
class Model extends Base\Model {

    use Traits\InstanceTrait;

    private $_var;

    function __construct($tableName = null){

        if(!$tableName)$tableName = $this->_table;

        $this->_var = new stdClass;
        $this->_fun = new stdClass;

        $this->_fun->handle = Handle::getSingleInstance();

        $database = Database::getMutiInstance(
            $this->_fun->handle->defaultDatabase,
            $this->_fun->handle->defaultPrefix
        );

        $table = Table::getMutiInstance($tableName,$database);

        $this->seTtable($table);

    }
    










}