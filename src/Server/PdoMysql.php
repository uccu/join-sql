<?php
namespace uccu\JoinSql\Server;

use uccu\JoinSql\Base\Server;

use Exception;
use uccu\JoinSql\Traits;
use PDO;
use PDOStatement;

class PdoMysql implements Server {
    
	use Traits\InstanceTrait;

	
	public $database;

	private $_connection;
	private $_prefix;
	private $_config;
	private $_results;
	private $_effectsNumber = 0;

    # 初始化默认config
	function __construct($name = null){

		$this->_config = [
            'database'      =>  'test',
            'host'          =>  'localhost',
            'charset'       =>  'utf8mb4',
            'user'          =>  'root',
            'password'      =>  '',
            'timeout'       =>  5,
            'autoCommit'    =>  1,
            'errMode'       =>  PDO::ERRMODE_SILENT,
            'case'          =>  PDO::CASE_NATURAL,
            'prefix'        =>  ''
        ];



	}

    # 获取server类型
    public function serverName(){
        return 'PdoMysql';
    }

    # 获取prefix
    public function getPrefix(){

        return $this->_prefix ? $this->_prefix : '';
    }
	
    # 设置配置
    public function initConfig(array $array){

        $this->_config = array_merge($this->_config,$array);
        $this->_prefix = $this->_config['prefix'];
        $this->database = $this->_config['database'];
        return $this;
    }

	# 连接数据库
	public function connect(){

        $dbname     = $this->_config['database'];
        $host       = $this->_config['host'];
        $charset    = $this->_config['charset'];
        $user       = $this->_config['user'];
        $password   = $this->_config['password'];
        $timeout    = (int)$this->_config['timeout'];
        $autoCommit = $this->_config['autoCommit']?1:0;
        $errMode    = (int)$this->_config['errMode'];
        $case       = (int)$this->_config['case'];


		if(!$dbname)throw new Expection('Database Not Selected');
		
		

		$this->_connection = new PDO(
			"mysql:dbname=$dbname;host=$host;charset=$charset", $user, $password ,
			[
				PDO::ATTR_PERSISTENT 	=> 	true,
				PDO::ATTR_TIMEOUT 		=> 	$timeout,
				PDO::ATTR_AUTOCOMMIT 	=> 	$autoCommit,
				PDO::ATTR_ERRMODE 		=>	$errMode,
				PDO::ATTR_CASE 			=>	$case,
			]
		);

		if(!$this->_connection)throw new Expection('connect failed');


		return $this;

	}



	# 设置results
	private function setResults(PDOStatement $results){

		$this->_results = $results;
		return $this;
	}

	# 执行sql语句并返回PDOStatement的实例
	function query(String $sql){

		$result = $this->_connection->query($sql);

		if(!$result)throw new Exception('sql error');

		$this->setResults($result);
		return $this;
	}

	# 准备执行sql语句并返回PDOStatement的实例
	function prepare (String $sql){

		$this->serResults($this->_connection->prepare($sql));
		return $this;
	}

	# 执行sql、语句并返回影响的行数
	function exec(String $sql){

		$this->_effectsNumber = $this->_connection->exec($sql);
		return $this->_effectsNumber;
	}

	# 事务
	function start(){

		return $this->_connection->beginTransaction();
	}
	function commit(){

		return $this->_connection->commit();
	}
	function rollback(){

		return $this->_connection->rollBack();
	}
	function inTransaction(){

		return $this->_connection->inTransaction();
	}
	
	# 获取最后插入行的ID或序列值
	function insertId(string $name = NULL ){

		return $this->_connection->lastInsertId($name);
	}

	# 获取sql影响的行数
	function rows(){

		return $this->_effectsNumber = $this->_results->rowCount();
	}

	# 执行
	function execute(){

        if(!$this->_results)return false;
		return $this->_results->execute();
	}

    # 遍历数据，返回单条数据
    public function fetch(int $fetchType = SELF::FETCH_OBJECT){

        if(!$this->_results)return false;
        return $fetchType ? $this->_results->fetch(PDO::FETCH_ASSOC) : $this->_results->fetchObject();

    }

    # 返回所有数据
    function result(int $fetchType = SELF::FETCH_OBJECT){

        if(!$this->_results)return [];
        return $this->_results->fetchAll($fetchType ? PDO::FETCH_ASSOC : PDO::FETCH_CLASS);

    }


    

	# 关闭游标，使语句能再次被执行
	function freeResult(){
		if(!$this->_results)return false;
		return $this->_results->closeCursor();
	}

    function next(){
        if(!$this->_results)return false;
        return $this->_results->nextRowset();
    }



}