<?php
// Store session in redis 
ini_set('session.save_handler', 'redis');
ini_set('session.save_path', 'tcp://redis:6379');
session_start();
require __DIR__ .'/vendor/autoload.php';


// Test Mysql connection

// Must be same as mysql container name
$mysqlHost = 'database-d';
try {
	$dsn = 'mysql:host=database-d;port=3306;dbname=dk';
	$options = array(
		\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
		//PDO::NULL_EMPTY_STRING
		//PDO::ATTR_AUTOCOMMIT => FALSE
	);
	$dbh = new \PDO($dsn, 'root', 'password', $options);
	$dbh->exec("set names utf8");
} catch (PDOException $e) {
	exit('Connection failed: ' . $e->getMessage());
}

// Test redis connection

// Must be the same as redis name in docker-compose.yml
$client = new Predis\Client([
    'scheme' => 'tcp',
    'host'   => 'redis',
    'port'   => 6379,
]);

$visited = $client->get('visited') ?? 0;
$client->set('visited', ++$visited);


// Test redis session
if (!array_key_exists('visit', $_SESSION)) {
    $_SESSION['visit'] = 0;
}
$_SESSION['visit'] = ++$_SESSION['visit'];


if (!isset($_SESSION['username'])) {
	if ($_COOKIE['PHPSESSID']) {
		$session = $client->get('PHPREDIS_SESSION:' . $_COOKIE['PHPSESSID']);
	}
} else {
	$session = $_SESSION['username'];
}

//$_SESSION['username'] = 'Chrm';
?>
<h1>It works html</h1>
<h4>Todos</h4>
<ul>
	<li>Database connection:</li>
	<ol>
		<?php
		$data = $dbh->query("SELECT * FROM teams")->fetchAll();
		foreach ($data as $row) { ?>
			<li><?php echo $row['name']."<br />\n";?></li>
		<?php } ?>
	</ol>
	<li>Redis connection:</li>
		<ul>
			<li>Visited: <?php echo $visited ?></li>
			<li>Session: <?php var_dump($session); ?></li>
		</ul>
	<li>Connect to rabbitmq</li>
</ul>

<?php
echo phpinfo();
?>