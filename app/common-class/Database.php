<?php
/**
 * Database.php
 *
 * Database connection class. This class is used for instantiate a singleton
 * object for database connection.
 *
 */
class Database
{
	/**
	 * This variable assure the existance of a unique Database object instance.
	 *
	 * @var Database
	 * @access private
	 * @static
	 */
	static private $database = FALSE;

	/**
	 * For PDO connection record.
	 *
	 * @var PDO
	 * @access private
	 */
	private $connection = FALSE;

	/**
	 * Schema of database.
	 *
	 * @var string
	 * @access private
	 */
/*
	private $array = array ('sgbd'		=> 'PostgreSQL',
	'host'		=> 'ec2-52-87-135-240.compute-1.amazonaws.com',
	'name'		=> 'd7p8j9jsirnvjj',
	'port'		=> '5432',
	'schema'	=> 'public',
	'user'		=> 'mqgmpaliwwyqeg',
	'password' 	=> 'acabc0b7b877afd0ea92e58f5547a661584efa989b640f4d31a44bf9547d491e');
*/	 

	private $array = array ('sgbd'		=> 'PostgreSQL',
									'host'		=> 'ec2-18-209-153-180.compute-1.amazonaws.com',
									'name'		=> 'da1lj12uim6lgd',
									'port'		=> '5432',
									'schema'	=> 'public',
									'user'		=> 'fphmkvpaqquraj',
									'password' 	=> '4eeeb851f0cace4a352af418a741a6d68f29b62a8737a38ddea54e1888f383b6');

	/**
	 * Class constructor.
	 * Designed for singleton.
	 *
	 * @access private
	 * @final
	 * @see singleton ()
	 */
	private final function __construct ()
	{
		/*$db = Instance::singleton ()->getDatabase ();

		foreach ($this->array as $key => $value)
			if (array_key_exists ($key, $db))
				$this->array [$key] = (string) $db [$key];

		*/

		switch ($this->sgbd)
		{
			case 'MySQL':
				$dsn = 'mysql:host='. $this->host .';dbname='. $this->name;
				break;

			case 'SQLServer':
				$dsn = 'mssql:host='. $this->host .'; dbname='. $this->name;
				break;

			case 'FireBird':
				$dsn = 'firebird:User='. $this->user .';Password='. $this->password .';Database='. $this->name .';DataSource='. $this->host .';Port='. (!$this->port ? '3050' : $this->port);
				break;

			case 'Sybase':
				$dsn = 'sybase:host='. $this->host .'; dbname='. $this->name;
				break;

			case 'PostgreSQL':
				$dsn = 'pgsql:'. (!in_array ($this->host, array ('localhost', '127.0.0.1', '::1')) || $this->password != '' || PHP_OS != 'Linux' ? 'host='. $this->host .' port='. (trim ($this->port) == '' ? '5432' : $this->port) : '') .' dbname='. $this->name .' user='. $this->user .' password='. $this->password;
				break;

			case 'ODBC':
				$dsn = 'odbc:DSN=SAMPLE;UID='. $this->user .';PWD='. $this->password;
				break;

			case 'SQLite':
				$dsn = 'sqlite:'. $this->name;
				break;

			case 'OCI':
				$dsn = 'oci:dbname=//'. $this->host .':'. (trim ($this->port) == '' ? '1521' : $this->port) .'/'. $this->name;
				break;

			default:
				throw new Exception ('You need set SGBD database configuration!');
		}

		$dbh = new PDO ($dsn, $this->user, $this->password);

		$dbh->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if (trim ($this->schema) != '')
			$dbh->exec ('SET search_path = '. $this->schema);

		$this->connection = $dbh;
	}

	/**
	 * Singleton function.
	 *
	 * @return Database
	 * @static
	 */
	static public function singleton ()
	{
		if (self::$database !== FALSE)
			return self::$database;

		//$class = __CLASS__;

		self::$database = new Database ();

		return self::$database;
	}

	/**
	 * Magic method for call PDO methods by Database object.
	 *
	 * @param string $function
	 * @param array $args
	 * @return mixed
	 */
	public function __call ($function, $args)
	{
		return call_user_func_array (array (&$this->connection, $function), $args);
	}

	/**
	 * Verify connection.
	 *
	 * @return boolean
	 */
	public function isConnected ()
	{
		return $this->connection !== FALSE;
	}

	public function __get ($key)
	{
		if (array_key_exists ($key, $this->array))
			return $this->array [$key];

		return '';
	}

	public function __set ($key, $value)
	{
		if (array_key_exists ($key, $this->array))
			$this->array [$key] = $value;
	}

	/**
	 * Get default schema.
	 *
	 * @return string
	 */
	public function getSchema ()
	{
		return $this->schema;
	}

	public function getName ()
	{
		return $this->name;
	}

	public function getDbms ()
	{
		return $this->sgbd;
	}

	public function getHost ()
	{
		return $this->host;
	}

	public function getPort ()
	{
		return $this->port;
	}

	public function getUser ()
	{
		return $this->user;
	}

}
?>
