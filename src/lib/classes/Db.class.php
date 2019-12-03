<?php

/**
 * Database connector and queries for app
 *
 * @param $connectionType {String} default is NULL
 *     pass in 'write' to create a connection with write privileges
 *
 * @author Scott Haefner <shaefner@usgs.gov>
 */
class Db {
  private static $db;
  private $_pdo;

  public function __construct($connectionType=NULL) {
    if ($connectionType === 'write') {
      $this->_pdo = [
        'db' => $GLOBALS['CONFIG']['DB_WRITE_DSN'],
        'user' => $GLOBALS['CONFIG']['DB_WRITE_USER'],
        'pass' => $GLOBALS['CONFIG']['DB_WRITE_PASS']
      ];
    } else {
      $this->_pdo = [
        'db' => $GLOBALS['CONFIG']['DB_DSN'],
        'user' => $GLOBALS['CONFIG']['DB_USER'],
        'pass' => $GLOBALS['CONFIG']['DB_PASS']
      ];
    }
    try {
      $this->db = new PDO($this->_pdo['db'], $this->_pdo['user'], $this->_pdo['pass']);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      print '<p class="alert error">ERROR 1: ' . $e->getMessage() . '</p>';
    }
  }

  /**
   * Perform db query
   *
   * @param $sql {String}
   *     SQL query
   * @param $params {Array} default is NULL
   *     key-value substitution params for SQL query
   *
   * @return $stmt {Object} - PDOStatement object
   */
  private function _execQuery ($sql, $params=NULL) {
    try {
      $stmt = $this->db->prepare($sql);

      // bind sql params
      if (is_array($params)) {
        foreach ($params as $key => $value) {
          $type = $this->_getType($value);
          $stmt->bindValue($key, $value, $type);
        }
      }
      $stmt->execute();

      return $stmt;
    } catch(Exception $e) {
      print '<p class="alert error">ERROR 2: ' . $e->getMessage() . '</p>';
    }
  }

  /**
   * Get data type for a sql parameter (PDO::PARAM_* constant)
   *
   * @param $var {?}
   *     variable to identify type of
   *
   * @return $type {Integer}
   */
  private function _getType ($var) {
    $varType = gettype($var);
    $pdoTypes = array(
      'boolean' => PDO::PARAM_BOOL,
      'integer' => PDO::PARAM_INT,
      'NULL' => PDO::PARAM_NULL,
      'string' => PDO::PARAM_STR
    );

    $type = $pdoTypes['string']; // default
    if (isset($pdoTypes[$varType])) {
      $type = $pdoTypes[$varType];
    }

    return $type;
  }

  /**
   * Query db to get details for a given seismic station
   *
   * @param $id {Integer}
   *
   * @return {Function}
   */
  public function queryStation ($id) {
    $params = [
      'id' => $id
    ];
    $sql = "SELECT * FROM seismic_stations
      WHERE `id` = :id AND `heli-nca` = 'TRUE'
      ORDER BY `site`, `type`, `network` ASC";

    return $this->_execQuery($sql, $params);
  }

  /**
   * Query db to get a list of seismic stations
   *
   * @param $filter {String} default is NULL
   *
   * @return {Function}
   */
  public function queryStations ($filter=NULL) {
    if (!$filter) {
      $filter = 'nca'; // default value
    }
    // Can't get this to work as a PDO param, so strip non-word chars for security
    $filter = preg_replace('/[^\w]/', '', $filter);
    $column = "heli-$filter";

    $sql = "SELECT * FROM seismic_stations
      WHERE `$column` = 'TRUE'
      ORDER BY `site`, `type`, `network` ASC";

    return $this->_execQuery($sql, $params);
  }
}
