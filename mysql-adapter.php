<?php
require __DIR__ . '/lib/redbean/rb-mysql.php';

class MySqlAdapter
{
  private static $instance = null;
  private $_con;

  public function __construct ()
  {
    $hostname = 'localhost';
    $database = 'database name';
    $user_name = 'root';
    $password = 'root';
    R::setup( "mysql:host={$hostname};dbname={$database}", "{$user_name}", "{$password}" );
    $this->_con = R::getToolBox();
  }

  /**
   * Get Instance
   *
   * @return mixed
   */
  public static function get_instance()
  {
    if (self::$instance == null)
    {
      self::$instance = new MySqlAdapter ();
    }

    return self::$instance;
  }

  /**
   * Get Connection
   *
   * @return mixed
   */
  public function get_connection ()
  {
    return $this->_con;
  }

}