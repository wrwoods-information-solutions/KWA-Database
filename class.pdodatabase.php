<?php
/**
******************************************************
* @file class.pdodatabase.php
* @brief Use this class to connect easily to multiple databases types.
* @author W.R.(Ric)Woods
* @version 1.0
* @copyright 2016
* @date 8 September 2016
*******************************************************/

class DBMS{

	/** Variable array $database_types with all database supported. */
	private $database_types = array("sqlite2","sqlite3","sqlsrv","mssql","mysql","pg","ibm","dblib","odbc","oracle","ifmx","fbd");
	/** Variable $host, database server address. */
	private $host;
	/** Variable $database, database name. */
	private $database;
	/** Variable $user, database user. */
	private $user;
	/** Variable $password, database password. */
	private $password;
	/** Variable $port, database port only if really necessary. */
	private $port;
	/** Variable $database_type, important explicit type. */
	private $database_type;
	/** Variable $root_mbd, path to mdb file for MS Access databases. */
	private $root_mdb;

	/** Variable $sql, query string to execute. */
	private $sql;
	/** Variable $con, object connection to database. */
	private $con;
	/** Variable $err_msg, always empty if not have errors. */
	private $err_msg = "";

	/**
	* @brief Constructor, Initialize and connect to the database.
	* @param string $database_type the name of the database type.
	* @param string $host the host of the database.
	* @param string $database the name of the database.
	* @param string $user the name of the user for the database.
	* @param string $password the passord of the user for the database.
	* @param string $port the port of the database not necessary get default ports. */
	public function __construct($database_type,$host,$database,$user,$password,$port){
 		$this->database_type = strtolower($database_type);
 		$this->host = $host;
 		$this->database = $database;
  		$this->user = $user;
 		$this->password = $password;
		$this->port = $port;
                $this->Cnxn();
    	}

	/**
	* @brief Cnxn, connect to the database.
	* @return object $con the conecttion required by sql statements. */
	public function Cnxn(){
		if(in_array($this->database_type, $this->database_types)){
			try{
  				switch($this->database_type){
					case "mssql":
						$this->con = new PDO("mssql:host=".$this->host.";dbname=".$this->database, $this->user, $this->password);
						break;
  					case "sqlsrv":
						$this->con = new PDO("sqlsrv:server=".$this->host.";database=".$this->database, $this->user, $this->password);
						break;
					case "ibm": //default port = ?
						$this->con = new PDO("ibm:DRIVER={IBM DB2 ODBC DRIVER};DATABASE=".$this->database."; HOSTNAME=".$this->host.";PORT=".$this->port.";PROTOCOL=TCPIP;", $this->user, $this->password);
						break;
					case "dblib": //default port = 10060
						$this->con = new PDO("dblib:host=".$this->host.":".$this->port.";dbname=".$this->database,$this->user,$this->password);
						break;
 					case "odbc":
						$this->con = new PDO("odbc:Driver={Microsoft Access Driver (*.mdb,*.accdb)};Dbq=".$this->database.";Uid=".$this->user);
						break;
					case "oracle":
						$this->con = new PDO("OCI:dbname=".$this->database.";charset=UTF-8", $this->user, $this->password);
						break;
  					case "ifmx":
						$this->con = new PDO("informix:DSN=InformixDB", $this->user, $this->password);
						break;
 					case "fbd":
						$this->con = new PDO("firebird:dbname=".$this->host.":".$this->database, $this->user, $this->password);
						break;
 					case "mysql":
						$this->con = (is_numeric($this->port)) ? new PDO("mysql:host=".$this->host.";port=".$this->port.";dbname=".$this->database, $this->user, $this->password) : new PDO("mysql:host=".$this->host.";dbname=".$this->database, $this->user, $this->password);
 						break;
					case "sqlite2": //ej: "sqlite:/path/to/database.sdb"
						$this->con = new PDO("sqlite:".$this->host);
						break;
					case "sqlite3":
						$this->con = new PDO("sqlite::memory");
						break;
					case "pg":
						$this->con = (is_numeric($this->port)) ? new PDO("pgsql:dbname=".$this->database.";port=".$this->port.";host=".$this->host, $this->user, $this->password) : new PDO("pgsql:dbname=".$this->database.";host=".$this->host, $this->user, $this->password);
						break;
					default:
						$this->con = null;
						break;
				}

   				$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 				$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
//				$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
//				$this->con->setAttribute(PDO::SQLSRV_ATTR_DIRECT_QUERY = true);

 				return $this->con;
			}catch(PDOException $e){
				$this->err_msg = "Error: ". $e->getMessage();
				return false;
			}
		}else{
			$this->err_msg = "Error: Error establishing a database connection (error in params or database not supported).";
			return false;
		}
	}

	/**
	* @brief properties, print connection properties. */
	public function properties(){
		echo "<span style='display:block;color:#267F00;background:#F4FFEF;border:2px solid #267F00;padding:2px 4px 2px 4px;margin-bottom:5px;'>";
		print_r("<b>DATABASE:</b>&nbsp;".$this->con->getAttribute(PDO::ATTR_DRIVER_NAME)."&nbsp;".$this->con->getAttribute(PDO::ATTR_SERVER_VERSION)."<br/>");
		print_r("<b>STATUS:</b>&nbsp;".$this->con->getAttribute(PDO::ATTR_CONNECTION_STATUS)."<br/>");
		print_r("<b>CLIENT:</b><br/>".$this->con->getAttribute(PDO::ATTR_CLIENT_VERSION)."<br/>");
		print_r("<b>INFORMATION:</b><br/>".$this->con->getAttribute(PDO::ATTR_SERVER_INFO));
		echo "</span>";
	}

	/**
	* @brief properties, print all drivers capables for the server. */
	public function drivers(){
		print_r(PDO::getAvailableDrivers()); 
	}

	/**
	* @brief transaction, execute the transactional operations.
	* @param string $type shortcut for trasaction to execute. i.e: B=begin, C=commit & R=rollback. */
	public function transaction($type){
		$this->err_msg = "";
		if($this->con!=null){
			try{
				if($type=="B")
					$this->con->beginTransaction();
				elseif($type=="C")
					$this->con->commit();
				elseif($type=="R")
					$this->con->rollBack();
				else{
					$this->err_msg = "Error: The passed param is wrong! just allow [B=begin, C=commit or R=rollback]";
					return false;
				}
			}catch(PDOException $e){
				$this->err_msg = "Error: ". $e->getMessage();
				return false;
			}
		}else{
			$this->err_msg = "Error: Connection to database lost.";
			return false;
		}
	}

	/**
	* @brief query, iterate over rows.
	* @param string $sql_statement query string to execute.
	* @return object $query contains result set. */
	public function query($sql_statement){
  		$this->err_msg = "";
		if($this->con!=null){
			try{
				$this->sql=$sql_statement;
   				return $this->con->query($this->sql);
			}catch(PDOException $e){
				$this->err_msg = "Error: ". $e->getMessage();
                                echo $this->err_msg;
                                return false;
			}
		}else{
			$this->err_msg = "Error: Connection to database lost.";
			return false;
		}
	}

	/**
	* @brief query_secure, prevent and avoid sql injections.
	* @param string $sql_statement query string to execute.
	* @param string $params are necessary for query execute.
	* @param string $fetch_rows true if you need the result set.
	* @param string $unnamed only if your params are annonymous.
	* @param string $delimiter you can specify another delimiter.
	* @return object $fetchAll contains result set. */
	public function query_secure($sql_statement, $params, $fetch_rows=false, $unnamed=false, $delimiter="|"){
		$this->err_msg = "";
		if(!isset($unnamed)) $unnamed = false;

                if(trim((string)$delimiter)==""){
			$this->err_msg = "Error: Delimiter are required.";
			return false;
		}
		if($this->con!=null){
			$obj = $this->con->prepare($sql_statement);
			if(!$unnamed){
				for($i=0;$i<count($params);$i++){
					$params_split = explode($delimiter,$params[$i]);
					(trim($params_split[2])=="INT") ? $obj->bindParam($params_split[0], $params_split[1], PDO::PARAM_INT) : $obj->bindParam($params_split[0], $params_split[1], PDO::PARAM_STR);
				}
				try{
					$obj->execute();
				}catch(PDOException $e){
					$this->err_msg = "Error: ". $e->getMessage();
					return false;
				}
			}else{
				try{
					$obj->execute($params);
				}catch(PDOException $e){
					$this->err_msg = "Error: ". $e->getMessage();
					return false;
				}
			}
			if($fetch_rows)
				return $obj->fetchAll();
			if(is_numeric($this->con->lastInsertId()))
				return $this->con->lastInsertId();
			return true;
		}else{
			$this->err_msg = "Error: Connection to database lost.";
			return false;
		}
	}

	/**
	* @brief query_first, fetch the first row.
	* @param string $sql_statement query string to execute.
	* @return object $fetch contains result set. */
	public function query_first($sql_statement){
		$this->err_msg = "";
		if($this->con!=null){
			try{
				$sttmnt = $this->con->prepare($sql_statement);
				$sttmnt->execute();
				return $sttmnt->fetch();
			}catch(PDOException $e){
				$this->err_msg = "Error: ". $e->getMessage();
				return false;
			}
		}else{
			$this->err_msg = "Error: Connection to database lost.";
			return false;
		}
	}

	/**
	* @brief query_single, select single table cell from first record.
	* @param string $sql_statement query string to execute.
	* @return object $fetchColumn contains result set. */
	public function query_single($sql_statement){
		$this->err_msg = "";
		if($this->con!=null){
			try{
				$sttmnt = $this->con->prepare($sql_statement);
				$sttmnt->execute();
 				return $sttmnt->fetchColumn();
			}catch(PDOException $e){
				$this->err_msg = "Error: ". $e->getMessage();
				return false;
			}
		}else{
			$this->err_msg = "Error: Connection to database lost.";
			return false;
		}
	}

	/**
	* @brief rowcount, total rows from latest query.
	* @return integer with the total rows. */
	public function rowcount(){
		$this->err_msg = "";
		if($this->con!=null){
			try{
				$stmnt_tmp = $this->stmntCount($this->sql);
				if($stmnt_tmp!=false && $stmnt_tmp!=""){
					return $this->query_single($stmnt_tmp);
				}else{
					$this->err_msg = "Error: A few data required.";
					return -1;
				}
			}catch(PDOException $e){
				$this->err_msg = "Error: ". $e->getMessage();
				return -1;
			}
		}else{
			$this->err_msg = "Error: Connection to database lost.";
			return false;
		}
	}

	/**
	* @brief fields, name fields as vector.
	* @param string $table must specify table name for extract fields.
	* @return array $field with all fields name of table. */
	public function fields($table){
		$this->err_msg = "";
		$this->sql="SELECT * FROM $table";
		if($this->con!=null){
			try{
				$q = $this->con->query($this->sql);
				$field = array();
				foreach($q->fetchAll(PDO::FETCH_ASSOC) as $key=>$val){
					$field[] = $key;
				}
				return $field;
			}catch(PDOException $e){
				$this->err_msg = "Error: ". $e->getMessage();
				return false;
			}
		}else{
			$this->err_msg = "Error: Connection to database lost.";
			return false;
		}
	}

	/**
	* @brief insert, insert and get newest created id.
	* @param string $table must specify table name for insert into.
	* @param string $data required for execute insert with data.
	* @return integer with the newest id (must be autonumeric). */
	public function insert($table, $data){
		$this->err_msg = "";
		if($this->con!=null){
			try{
				$txt_fields = "";
				$txt_values = "";
				$data_field = explode(",", $data);
				for($x=0;$x<count($data_field);$x++){
					list($field, $value) = explode("=", $data_field[$x]);
					$txt_fields.= ($x==0) ? $field : ",".$field;
					$txt_values.= ($x==0) ? $value : ",".$value;
				}
				$this->con->exec("INSERT INTO ".$table." (".$txt_fields.") VALUES(".$txt_values.");");
				return $this->con->lastgetLatestId();
			}catch(PDOException $e){
				$this->err_msg = "Error: ". $e->getMessage();
				return false;
			}
		}else{
			$this->err_msg = "Error: Connection to database lost.";
			return false;
		}
	}

	/**
	* @brief update, replace information in the table.
	* @param string $table must specify table name for update.
	* @param string $data required for execute update info.
	* @param string $condition only if is required for the statement. */
	public function update($table, $data, $condition=""){
		$this->err_msg = "";
		if($this->con!=null){
			try{
				return (trim($condition)!="") ? $this->con->exec("UPDATE ".$table." SET ".$data." WHERE ".$condition.";") : $this->con->exec("UPDATE ".$table." SET ".$data.";");
			}catch(PDOException $e){
				$this->err_msg = "Error: ". $e->getMessage();
				return false;
			}
		}else{
			$this->err_msg = "Error: Connection to database lost.";
			return false;
		}
	}

	/**
	* @brief delete, delete information in the table.
	* @param string $table must specify table name for delete rows.
	* @param string $condition only if is required for the statement. */
	public function delete($table, $condition=""){
		$this->err_msg = "";
		if($this->con!=null){
			try{
				return (trim($condition)!="") ? $this->con->exec("DELETE FROM ".$table." WHERE ".$condition.";") : $this->con->exec("DELETE FROM ".$table.";");
			}catch(PDOException $e){
				$this->err_msg = "Error: ". $e->getMessage();
				return false;
			}
		}else{
			$this->err_msg = "Error: Connection to database lost.";
			return false;
		}
	}

	/**
	* @brief execute, this method is special for execute store procedures.
	* @param string $sp_query is the sp to execute. */
	public function execute($sp_query){
		$this->err_msg = "";
		if($this->con!=null){
			try{
				$this->con->exec($sp_query);
				return true;
			}catch(PDOException $e){
				$this->err_msg = "Error: ". $e->getMessage();
				return false;
			}
		}else{
			$this->err_msg = "Error: Connection to database lost.";
			return false;
		}
	}

	/**
	* @brief getLatestId, for retrieve the newest id in the table.
	* @param string $table must specify table name for this operation.
	* @param string $field is the field name that you need. 
	* @return integer with the latest id inserted. */
	public function getLatestId($table, $field){
		$this->err_msg = "";
		$sql_statement = "";
		$dbtype = $this->database_type;

		if($dbtype=="sqlsrv" || $dbtype=="mssql" || $dbtype=="ibm" || $dbtype=="dblib" || $dbtype=="odbc"){
			$sql_statement = "SELECT TOP 1 ".$field." FROM ".$table." ORDER BY ".$field." DESC;";
		}elseif($dbtype=="oracle"){
			$sql_statement = "SELECT ".$field." FROM ".$table." WHERE ROWNUM<=1 ORDER BY ".$field." DESC;";
		}elseif($dbtype=="ifmx" || $dbtype=="fbd"){
			$sql_statement = "SELECT FIRST 1 ".$field." FROM ".$table." ORDER BY ".$field." DESC;";
		}elseif($dbtype=="mysql" || $dbtype=="sqlite2" || $dbtype=="sqlite3"){
			$sql_statement = "SELECT ".$field." FROM ".$table." ORDER BY ".$field." DESC LIMIT 1;";
		}elseif($dbtype=="pg"){
			$sql_statement = "SELECT ".$field." FROM ".$table." ORDER BY ".$field." DESC LIMIT 1 OFFSET 0;";
		}

		if($this->con!=null){
			try{
				return $this->query_single($sql_statement);
			}catch(PDOException $e){
				$this->err_msg = "Error: ". $e->getMessage();
				return false;
			}
		}else{
			$this->err_msg = "Error: Connection to database lost.";
			return false;
		}
	}

	/**
	* @brief ShowTables, for retrieve all tables in the database.
	* @param string $database must specify database for get tables.
	* @return object with the result set with table names in the database. */
	public function ShowTables($database){
		$this->err_msg = "";
		$complete = "";
		$sql_statement = "";
		$dbtype = $this->database_type;

		if($dbtype=="sqlsrv" || $dbtype=="mssql" || $dbtype=="ibm" || $dbtype=="dblib" || $dbtype=="odbc" || $dbtype=="sqlite2" || $dbtype=="sqlite3"){
			$sql_statement = "SELECT name FROM sysobjects WHERE xtype='U';";
		}elseif($dbtype=="oracle"){
			//If the query statement fail, try with uncomment the next line:
			//$sql_statement = "SELECT table_name FROM tabs;";
			$sql_statement = "SELECT table_name FROM cat;";
		}elseif($dbtype=="ifmx" || $dbtype=="fbd"){
			$sql_statement = 'SELECT RDB$RELATION_NAME FROM RDB$RELATIONS WHERE RDB$SYSTEM_FLAG = 0 AND RDB$VIEW_BLR IS NULL ORDER BY RDB$RELATION_NAME;';
		}elseif($dbtype=="mysql"){
			if($database!="") $complete=" FROM $database";
			$sql_statement = "SHOW tables ".$complete.";";
		}elseif($dbtype=="pg"){
			$sql_statement = "SELECT relname AS name FROM pg_stat_user_tables ORDER BY relname;";
		}

		if($this->con!=null){
			try{
				$this->sql=$sql_statement;
				return $this->con->query($this->sql);
			}catch(PDOException $e){
				$this->err_msg = "Error: ". $e->getMessage();
				return false;
			}
		}else{
			$this->err_msg = "Error: Connection to database lost.";
			return false;
		}
	}

	/**
	* @brief ShowDBS, for retrieve all databases in the server.
	* @return object with the result set with all databases in your server. */
	public function ShowDBS(){
		$this->err_msg = "";
		$sql_statement = "";
		$dbtype = $this->database_type;

		if($dbtype=="sqlsrv" || $dbtype=="mssql" || $dbtype=="ibm" || $dbtype=="dblib" || $dbtype=="odbc" || $dbtype=="sqlite2" || $dbtype=="sqlite3"){
			$sql_statement = "SELECT name FROM sys.Databases;";
		}elseif($dbtype=="oracle"){
			//If the query statement fail, try with uncomment the next line:
			//$sql_statement = "SELECT * FROM user_tablespaces";
			$sql_statement = 'SELECT * FROM v$database;';
		}elseif($dbtype=="ifmx" || $dbtype=="fbd"){
			$sql_statement = "";
		}elseif($dbtype=="mysql"){
			$sql_statement = "SHOW DATABASES;";
		}elseif($dbtype=="pg"){
			$sql_statement = "SELECT datname AS name FROM pg_database;";
		}

		if($this->con!=null){
			try{
				$this->sql=$sql_statement;
				return $this->con->query($this->sql);
			}catch(PDOException $e){
				$this->err_msg = "Error: ". $e->getMessage();
				return false;
			}
		}else{
			$this->err_msg = "Error: Connection to database lost.";
			return false;
		}
	}

	/**
	* @brief getError, print the latest error ocurred in the connection. */
	public function getError(){
		return trim($this->err_msg)!="" ? $this->err_msg : "";
	}

	/**
	* @brief disconnect, ends your connection, never forget this method for server performance. */
	public function disconnect(){
		$this->err_msg = "";
		if($this->con){
			$this->con = null;
			return true;
		}else{
			$this->err_msg = "Error: Connection to database lost.";
			return false;
		}
	}

	/**
	* @brief stmntCount, build a query string with count structure. Is used by rowcount method
	* @param string sql_statement is a string with your query. IMPORTANT: sql_statement not works if contains: group by, having...
	* @return string is the new query with count(*) structure. */
	private function stmntCount($sql_statement){
		if(trim($sql_statement)!=""){
			$sql_statement = trim($sql_statement);
			$query_split = explode(" ",$sql_statement);
			$query_flag = false;
			$query_final = "";

			for($x=0;$x<count($query_split);$x++){
				//Checking "SELECT"
				if($x==0 && strtoupper(trim($query_split[$x]))=="SELECT")
					$query_final = "SELECT count(*) ";
				if($x==0 && strtoupper(trim($query_split[$x]))!="SELECT")
					return false;

				//Checking "FROM"
				if(strtoupper(trim($query_split[$x]))=="FROM"){
					$query_final .= "FROM ";
					$query_flag = true;
					continue;
				}

				//Checking "ORDER"
				if(strtoupper(trim($query_split[$x]))=="ORDER" || strtoupper(trim($query_split[$x]))=="GROUP"){
					break;
				}

				//Building the query
				if(trim($query_split[$x])!="" && $query_flag)
					$query_final .= " " . trim($query_split[$x]) . " ";
			}
			return trim($query_final);
		}
		return false;
	}
	/**
	 * Select
	 *
	 * @param mixed $fields Array or string of fields to retrieve
	 * @param string $table Table to retrieve from
	 * @param string $where Where condition
	 * @param string $orderby Order by clause
	 * @param string $limit Limit condition
	 * @return array Array of rows
	 */
	public function select($fields, $table, $where = false, $orderby = false, $limit = false)
	{
		if (is_array($fields))
			$fields = "`" . implode($fields, "`, `") . "`";

		$orderby = ($orderby) ? " ORDER BY " . $orderby : '';
		$where = ($where) ? " WHERE " . $where : '';
		$limit = ($limit) ? " LIMIT " . $limit : '';

		$this->results = $this->query("SELECT " . $fields . " FROM " . $table . $where . $orderby . $limit);


                if ($this->results)
		{
                    foreach ($this->results as $row)
                    {
                        $rows[] = $row;
                    }
                    return $rows;
		} else
                    return false;
	}

	/**
	 * Selects one row
	 *
	 * @param mixed $fields Array or string of fields to retrieve
	 * @param string $table Table to retrieve from
	 * @param string $where Where condition
	 * @param string $orderby Order by clause
	 * @return array Row values
	 */
	public function selectOne($fields, $table, $where = false, $orderby = false)
	{
		$result = $this->select($fields, $table, $where, $orderby, '1');

		return $result[0];
	}
	
	/**
	 * Selects one value from one row
	 *
	 * @param mixed $field Name of field to retrieve
	 * @param string $table Table to retrieve from
	 * @param string $where Where condition
	 * @param string $orderby Order by clause
	 * @return array Field value
	 */
	public function selectOneValue($field, $table, $where = false, $orderby = false)
	{
		$result = $this->selectOne($field, $table, $where, $orderby);

		return $result[$field];
	}

}
?>