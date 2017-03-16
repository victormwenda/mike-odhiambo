<?php

namespace app\database\crud;

use app\database\core\DatabaseUtils;
use app\database\core\InvalidColumnValueMatchException;
use app\database\core\NullabilityException;

/**
 * THIS SOURCE CODE WAS AUTOMATICALLY GENERATED ON Sat 11:29:49  18/03/2017
 *
 *
 * DATABASE CRUD GENERATOR IS AN OPEN SOURCE PROJECT. TO IMPROVE ON THIS PROJECT BY
 * ADDING MODULES, FIXING BUGS e.t.c GET THE SOURCE CODE FROM GIT (https://github.com/marviktintor/dbcrudgen/)
 *
 * DATABASE CRUD GENERATOR INFO:
 *
 * DEVELOPER : VICTOR MWENDA
 * VERSION : DEVELOPER PREVIEW 0.1
 * SUPPORTED LANGUAGES : PHP
 * DEVELOPER EMAIL : vmwenda.vm@gmail.com
 *
 */


/**
 *
 * Login
 *
 * Low level class for manipulating the data in the table login
 *
 * This source code is auto-generated
 *
 * @author Victor Mwenda
 * Email : vmwenda.vm@gmail.com
 * Phone : +254(0)718034449
 */
class Login
{

    private $databaseUtils;
    private $action;
    private $client;

    /**
     * Login constructor.
     * @param $databaseUtils DatabaseUtils
     * @param string $action the action to perform [delete, insert, query, update]
     * @param string $client the client sending the HTTP Request web , mobile
     */
    public function __construct($databaseUtils, $action = "", $client = "")
    {
        $this->init($databaseUtils);
    }

    //Initializes
    public function init($databaseUtils)
    {

        //Init
        $this->databaseUtils = $databaseUtils;

    }


    /**
     * private class variable $_userId
     */
    private $_userId;

    /**
     * returns the value of $userId
     *
     * @return object(int|string) userId
     */
    public function _getUserId()
    {
        return $this->_userId;
    }

    /**
     * sets the value of $_userId
     *
     * @param userId
     */
    public function _setUserId($userId)
    {
        $this->_userId = $userId;
    }

    /**
     * sets the value of $_userId
     *
     * @param userId
     * @return object ( this class)
     */
    public function setUserId($userId)
    {
        $this->_setUserId($userId);
        return $this;
    }


    /**
     * private class variable $_username
     */
    private $_username;

    /**
     * returns the value of $username
     *
     * @return object(int|string) username
     */
    public function _getUsername()
    {
        return $this->_username;
    }

    /**
     * sets the value of $_username
     *
     * @param username
     */
    public function _setUsername($username)
    {
        $this->_username = $username;
    }

    /**
     * sets the value of $_username
     *
     * @param username
     * @return object ( this class)
     */
    public function setUsername($username)
    {
        $this->_setUsername($username);
        return $this;
    }


    /**
     * private class variable $_password
     */
    private $_password;

    /**
     * returns the value of $password
     *
     * @return object(int|string) password
     */
    public function _getPassword()
    {
        return $this->_password;
    }

    /**
     * sets the value of $_password
     *
     * @param password
     */
    public function _setPassword($password)
    {
        $this->_password = $password;
    }

    /**
     * sets the value of $_password
     *
     * @param password
     * @return object ( this class)
     */
    public function setPassword($password)
    {
        $this->_setPassword($password);
        return $this;
    }


    /**
     * private class variable $_accessToken
     */
    private $_accessToken;

    /**
     * returns the value of $accessToken
     *
     * @return object(int|string) accessToken
     */
    public function _getAccessToken()
    {
        return $this->_accessToken;
    }

    /**
     * sets the value of $_accessToken
     *
     * @param accessToken
     */
    public function _setAccessToken($accessToken)
    {
        $this->_accessToken = $accessToken;
    }

    /**
     * sets the value of $_accessToken
     *
     * @param accessToken
     * @return object ( this class)
     */
    public function setAccessToken($accessToken)
    {
        $this->_setAccessToken($accessToken);
        return $this;
    }


    /**
     * Performs a database query and returns the value of user_id
     * based on the value of $user_id,$username,$password,$access_token passed to the function
     *
     * @param $user_id ,$username,$password,$access_token
     * @return object (user_id)| null
     */
    public function getUserId($user_id, $username, $password, $access_token)
    {
        $columns = array('user_id', 'username', 'password', 'access_token');
        $records = array($user_id, $username, $password, $access_token);
        $user_id_ = $this->query_from_login($columns, $records);
        return sizeof($user_id_) > 0 ? $user_id_ [0] ['user_id'] : null;
    }


    /**
     * Performs a database query and returns the value of username
     * based on the value of $user_id passed to the function
     *
     * @param $user_id
     * @return object (username)| null
     */
    public function getUsername($user_id)
    {
        $columns = array('user_id');
        $records = array($user_id);
        $username_ = $this->query_from_login($columns, $records);
        return sizeof($username_) > 0 ? $username_ [0] ['username'] : null;
    }


    /**
     * Performs a database query and returns the value of password
     * based on the value of $user_id passed to the function
     *
     * @param $user_id
     * @return object (password)| null
     */
    public function getPassword($user_id)
    {
        $columns = array('user_id');
        $records = array($user_id);
        $password_ = $this->query_from_login($columns, $records);
        return sizeof($password_) > 0 ? $password_ [0] ['password'] : null;
    }


    /**
     * Performs a database query and returns the value of access_token
     * based on the value of $user_id passed to the function
     *
     * @param $user_id
     * @return object (access_token)| null
     */
    public function getAccessToken($user_id)
    {
        $columns = array('user_id');
        $records = array($user_id);
        $access_token_ = $this->query_from_login($columns, $records);
        return sizeof($access_token_) > 0 ? $access_token_ [0] ['access_token'] : null;
    }


    /**
     * Inserts data into the table[login] in the order below
     * array ('user_id','username','password','access_token')
     * is mapped into
     * array ($user_id,$username,$password,$access_token)
     * @return int 1 if data was inserted,0 otherwise
     * if redundancy check is true, it inserts if the record if it never existed else.
     * if the record exists, it returns the number of times the record exists on the relation
     */
    public function insert_prepared_records($user_id, $username, $password, $access_token, $redundancy_check = false, $printSQL = false)
    {
        $columns = array('user_id', 'username', 'password', 'access_token');
        $records = array($user_id, $username, $password, $access_token);
        return $this->insert_records_to_login($columns, $records, $redundancy_check, $printSQL);
    }

    /**
     * Delete data from the table[login] in the order below
     * array ('user_id','username','password','access_token')
     * is mapped into
     * array ($user_id,$username,$password,$access_token)
     * @return int number of deleted rows
     */
    public function delete_prepared_records($user_id, $username, $password, $access_token, $printSQL = false)
    {
        $columns = array('user_id', 'username', 'password', 'access_token');
        $records = array($user_id, $username, $password, $access_token);
        return $this->delete_record_from_login($columns, $records, $printSQL);
    }


    /**
     * Returns the table name. This is the owner of these crud functions.
     * The various crud functions directly affect this table
     * @return string table name -> 'login'
     */
    public static function get_table()
    {
        return 'login';
    }

    /**
     * This action represents the intended database transaction
     *
     * @return string the set action.
     */
    private function get_action()
    {
        return $this->action;
    }

    /**
     * Returns the client doing transactions
     *
     * @return string the client
     */
    private function get_client()
    {
        return $this->client;
    }

    /**
     * Used  to calculate the number of times a record exists in the table login
     * It returns the number of times a record exists exists in the table login
     * @param array $columns
     * @param array $records
     * @param bool $printSQL
     * @return mixed
     */
    public function is_exists(Array $columns, Array $records, $printSQL = false)
    {
        return $this->get_database_utils()->is_exists($this->get_table(), $columns, $records, $printSQL);
    }

    /**
     * Inserts data into the table login
     * if redundancy check is true, it inserts if the record if it never existed else.
     * if the record exists, it returns the number of times the record exists on the relation
     *
     * @param array $columns
     * @param array $records
     * @param bool $redundancy_check
     * @param bool $printSQL
     * @return mixed
     */
    public function insert_records_to_login(Array $columns, Array $records, $redundancy_check = false, $printSQL = false)
    {
        return $this->insert_records($this->get_table(), $columns, $records, $redundancy_check, $printSQL);
    }

    /**
     * Inserts records in a relation
     * The records are inserted in the relation columns in the order they are arranged in the array
     *
     * @param $records
     * @param bool $printSQL
     * @return bool|mysqli_result
     * @throws NullabilityException
     */
    public function insert_raw($records, $printSQL = false)
    {
        return $this->get_database_utils()->insert_raw_records($this->get_table(), $records, $printSQL);
    }

    /**
     * Deletes all the records that meets the passed criteria from the table login
     * @param array $columns
     * @param array $records
     * @param bool $printSQL
     * @return number of deleted rows
     */
    public function delete_record_from_login(Array $columns, Array $records, $printSQL = false)
    {
        return $this->delete_record($this->get_table(), $columns, $records, $printSQL);
    }

    /**
     * Updates all the records that meets the passed criteria from the table login
     *
     * @param array $columns
     * @param array $records
     * @param array $where_columns
     * @param array $where_records
     * @param bool $printSQL
     * @return number of updated rows
     */
    public function update_record_in_login(Array $columns, Array $records, Array $where_columns, Array $where_records, $printSQL = false)
    {
        return $this->update_record($this->get_table(), $columns, $records, $where_columns, $where_records, $printSQL);
    }

    /**
     * Gets an Associative array of the records in the table 'login' that meets the passed criteria
     *
     * @param $distinct
     * @param array $columns
     * @param array $records
     * @param string $extraSQL
     * @param bool $printSQL
     * @return array|mixed associative
     */
    public function fetch_assoc_in_login($distinct, Array $columns, Array $records, $extraSQL = "", $printSQL = false)
    {
        return $this->fetch_assoc($distinct, $this->get_table(), $columns, $records, $extraSQL, $printSQL);
    }

    /**
     * Gets an Associative array of the records in the table login that meets the passed criteria
     *
     * @param array $columns
     * @param array $records
     * @param string $extraSQL
     * @param bool $printSQL
     * @return array|mixed associative
     */
    public function query_from_login(Array $columns, Array $records, $extraSQL = "", $printSQL = false)
    {
        return $this->query($this->get_table(), $columns, $records, $extraSQL, $printSQL);
    }

    /**
     * Gets an Associative array of the records in the table login that meets the passed distinct criteria
     *
     * @param array $columns
     * @param array $records
     * @param string $extraSQL
     * @param bool $printSQL
     * @return array|mixed associative
     */
    public function query_distinct_from_login(Array $columns, Array $records, $extraSQL = "", $printSQL = false)
    {
        return $this->query_distinct($this->get_table(), $columns, $records, $extraSQL, $printSQL);
    }

    /**
     * Performs a search in the table login that meets the passed criteria
     *
     * @param array $columns
     * @param array $records
     * @param string $extraSQL
     * @param bool $printSQL
     * @return array|mixed associative
     */
    public function search_in_login(Array $columns, Array $records, $extraSQL = "", $printSQL = false)
    {
        return $this->search($this->get_table(), $columns, $records, $extraSQL, $printSQL);
    }

    /**
     * Get Database Utils
     *
     * @return DatabaseUtils $this->databaseUtils
     */
    public function get_database_utils()
    {
        return $this->databaseUtils;
    }


    /**
     * Deletes all the records that meets the passed criteria from the table [login]
     *
     * @param $table
     * @param array $columns
     * @param array $records
     * @param bool $printSQL
     * @return bool|int|\mysqli_result number of deleted rows
     * @throws InvalidColumnValueMatchException
     * @throws NullabilityException
     */
    private function delete_record($table, Array $columns, Array $records, $printSQL = false)
    {
        return $this->get_database_utils()->delete_record($table, $columns, $records, $printSQL);
    }


    /**
     * Inserts data into the table login
     *
     * if redundancy check is true, it inserts if the record if it never existed else.
     * if the record exists, it returns the number of times the record exists on the relation
     * @param $table
     * @param array $columns
     * @param array $records
     * @param bool $redundancy_check
     * @param bool $printSQL
     * @return bool|mixed|\mysqli_result the number of times the record exists
     * @throws NullabilityException
     */
    private function insert_records($table, Array $columns, Array $records, $redundancy_check = false, $printSQL = false)
    {
        if ($redundancy_check) {
            if ($this->is_exists($columns, $records) == 0) {
                return $this->get_database_utils()->insert_records($table, $columns, $records, $printSQL);
            } else return $this->is_exists($columns, $records);
        } else {
            return $this->get_database_utils()->insert_records($table, $columns, $records, $printSQL);
        }

    }

    /**
     * Updates all the records that meets the passed criteria from the table login
     * @param $table
     * @param array $columns
     * @param array $records
     * @param array $where_columns
     * @param array $where_records
     * @param bool $printSQL
     * @return bool|\mysqli_result number of updated rows
     * @throws NullabilityException
     */
    private function update_record($table, Array $columns, Array $records, Array $where_columns, Array $where_records, $printSQL = false)
    {
        return $this->get_database_utils()->update_record($table, $columns, $records, $where_columns, $where_records, $printSQL);
    }

    /**
     * Gets an Associative array of the records in the table login that meets the passed criteria
     * associative array of the records that are found after performing the query
     * @param $distinct
     * @param $table
     * @param array $columns
     * @param array $records
     * @param string $extraSQL
     * @param bool $printSQL
     * @return array|null
     * @throws InvalidColumnValueMatchException
     * @throws NullabilityException
     */
    private function fetch_assoc($distinct, $table, Array $columns, Array $records, $extraSQL = "", $printSQL = false)
    {
        return $this->get_database_utils()->fetch_assoc($distinct, $table, $columns, $records, $extraSQL, $printSQL);
    }

    /**
     * Gets an Associative array of the records in the table login  that meets the passed criteria
     *
     * @param $table
     * @param array $columns
     * @param array $records
     * @param string $extraSQL
     * @param bool $printSQL
     * @return array
     */
    private function query($table, Array $columns, Array $records, $extraSQL = "", $printSQL = false)
    {
        return $this->get_database_utils()->query($table, $columns, $records, $extraSQL, $printSQL);
    }

    /**
     * Gets an Associative array of the records in the table login that meets the distinct passed criteria
     * @param $table
     * @param array $columns
     * @param array $records
     * @param string $extraSQL
     * @param bool $printSQL
     * @return array
     */
    private function query_distinct($table, Array $columns, Array $records, $extraSQL = "", $printSQL = false)
    {
        return $this->get_database_utils()->query_distinct($table, $columns, $records, $extraSQL, $printSQL);
    }

    /**
     * Performs a search and returns an associative array of the records in the table login  that meets the passed criteria
     *
     * @param $table
     * @param array $columns
     * @param array $records
     * @param string $extraSQL
     * @param bool $printSQL
     * @return array|null
     * @throws InvalidColumnValueMatchException
     * @throws NullabilityException
     */
    private function search($table, Array $columns, Array $records, $extraSQL = "", $printSQL = false)
    {
        return $this->get_database_utils()->search($table, $columns, $records, $extraSQL, $printSQL);
    }

    /**
     * Prepare an OR query
     * @param array|null $columns
     * @param array|null $options
     * @param string $extraSQL
     * @param bool $printSQL
     * @return array
     */
    public function prepareQueryOR($columns = null, $options = null, $extraSQL = "", $printSQL = false)
    {
        return $this->get_database_utils()->prepareQueryOR($this->get_table(), $columns, $options, $extraSQL, $printSQL);
    }

    /**
     * Prepare an AND query
     * @param array|null $columns
     * @param array|null $options
     * @param string $extraSQL
     * @param bool $printSQL
     * @return array
     */
    public function prepareQueryAND(Array $columns = null, Array $options = null, $extraSQL = "", $printSQL = false)
    {
        return $this->get_database_utils()->prepareQueryAND($this->get_table(), $columns, $options, $extraSQL, $printSQL);
    }

    /**
     * Prepare an OR search
     * @param array|null $columns
     * @param array|null $options
     * @param string $extraSQL
     * @param bool $printSQL
     * @return array
     */
    public function prepareSearchOR($columns = null, $options = null, $extraSQL = "", $printSQL = false)
    {
        return $this->get_database_utils()->prepareSearchOR($this->get_table(), $columns, $options, $extraSQL, $printSQL);
    }

    /**
     * Prepare an AND search
     * @param array|null $columns
     * @param array|null $options
     * @param string $extraSQL
     * @param bool $printSQL
     * @return array
     */
    public function prepareSearchAND(Array $columns = null, Array $options = null, $extraSQL = "", $printSQL = false)
    {
        return $this->get_database_utils()->prepareSearchAND($this->get_table(), $columns, $options, $extraSQL, $printSQL);
    }

}

?>
