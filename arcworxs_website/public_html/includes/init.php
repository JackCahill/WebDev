<?php
    function check_php_version() {
      if (version_compare(phpversion(), '7.0', '<')) {
        define(VERSION_MESSAGE, "PHP version 7.0 or higher is required");
        echo VERSION_MESSAGE;
        throw VERSION_MESSAGE;
      }
    }
    check_php_version();

    function openConn() {
    	$hostname="localhost";
    	$username="awfadmin";
    	$password="20pass_afwdb20%$";
    	$dbname="ArcworxsDB";
    	
    	$conn = new mysqli($hostname,$username, $password, $dbname) or die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
        
        return $conn;    
    
    }
    	
    function closeConn($conn) {
        $conn -> close();
    }

/*    
    
    function pdo_connect_mysql() {
        $host = 'localhost';
        $dbname = 'ArcworxsDB';
        $username = 'awfadmin';
        $password = '20pass_afwdb20%$';
        require_once 'pdoconfig.php';
         
        try {
            $PDOconn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            echo "Connected to $dbname at $host successfully.";
        } catch (PDOException $pe) {
            die("Could not connect to the database $dbname :" . $pe->getMessage());
        }
            
    }
    
*/
?>