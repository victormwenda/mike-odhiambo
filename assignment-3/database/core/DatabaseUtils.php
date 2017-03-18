<?php

namespace app\database\core;

use Exception;

/**
 * DatabaseException - Thrown whenever an Exception occurs
 */
class DatabaseException extends Exception
{
}

/**
 * NullabilityException - Thrown whenever a non null parameter is passed as null
 */
class NullabilityException extends DatabaseException
{
}

/**
 * NullabilityException - Thrown whenever table invalid number of table columns and records is passed
 */
class InvalidColumnValueMatchException extends DatabaseException
{
}

/**
 * NullabilityException - Thrown whenever table invalid pair number of table columns and records is passed
 */
class InvalidColumnValuePairMatchException extends DatabaseException
{
}

/**
 *
 *
 * Database Utilities  - Contains the various database utility functions
 *
 * This source code is auto-generated
 *
 * @author Victor Mwenda
 * Email : vmwenda.vm@gmail.com
 * Phone : +254(0)718034449
 */
class DatabaseUtils
{

    private $database_connection;

    private $database_handle;

    public function __construct($host = "localhost", $user = "root", $password = "", $database = "users")
    {

        $this->database_connection = new DatabaseConnection ($host, $user, $password, $database);

        $this->database_handle = $this->database_connection->open_database_connection();
    }

    public function __destruct()
    {
    }

    /**
     * Deletes a table from the database
     * @param $table
     * @param bool $printSQL
     * @throws NullabilityException
     */
    public function drop_table($table, $printSQL = false)
    {
        if (empty ($table)) {
            throw new NullabilityException ("The table name cannot be null");
        }

        $query = "drop table `" . $table . "`";

        if ($printSQL) {
            echo $query;
        }
        $this->database_handle->query($query);
    }

    /**
     * Checks whether a certain record exists in a relation.
     * It returns the number of occurrences of this record in the relation
     *
     * @param $table
     * @param array $columns
     * @param array $records
     * @param bool $printSQL
     * @return int numberOfOccurrences
     * @throws InvalidColumnValueMatchException
     * @throws NullabilityException
     */
    public function is_exists($table, Array $columns, Array $records, $printSQL = false)
    {
        if (empty ($table) || count($columns) == 0 || count($records) == 0) {
            if (empty ($table)) {
                throw new NullabilityException ("The table name cannot be null");
            }
            if ((count($columns) == 0)) {
                throw new NullabilityException ("The table columns cannot be none");
            }
            if ((count($records) == 0)) {
                throw new NullabilityException ("The column records cannot be none");
            }
        }

        $num_rows = 0;

        $query = "SELECT * FROM `" . $table . "` WHERE ";

        if (count($columns) == count($records)) {
            for ($x = 0; $x < count($columns); $x++) {
                $query .= " `" . $columns [$x] . "` = '" . $records [$x] . "' ";

                if ($x < (count($columns) - 1)) {
                    $query .= " AND ";
                }
            }


            if ($printSQL) {
                echo $query;
            }

            $rows = $this->database_handle->query($query); // Perform Query
            $num_rows = $rows->num_rows; /* Count the Number of rows */
            return $num_rows; // Return number of rows
        } else {

            $message = "Columns are more or rows are more";

            if (count($columns) > count($records)) {
                $message = "Column count(" . count($columns) . ") is greater than record count(" . count($records) . ") ";
            } else {
                $message = "Record count(" . count($records) . ") is greater than record column(" . count($columns) . ") ";
            }

            throw new InvalidColumnValueMatchException ('Invalid query,' . $message);
        }

    }

    /**
     * Deletes the specified record(s) in a relation
     *
     * @param $table
     * @param array $columns
     * @param array $records
     * @param bool $printSQL
     * @return bool|int|\mysqli_result
     * @throws InvalidColumnValueMatchException
     * @throws NullabilityException
     */
    public function delete_record($table, Array $columns, Array $records, $printSQL = false)
    {
        if (empty ($table) || count($columns) == 0 || count($records) == 0) {
            if (empty ($table)) {
                throw new NullabilityException ("The table name cannot be null");
            }
            if ((count($columns) == 0)) {
                throw new NullabilityException ("The table columns cannot be none");
            }
            if ((count($records) == 0)) {
                throw new NullabilityException ("The column records cannot be none");
            }
        }

        $num_rows = 0;

        $query = "DELETE FROM `" . $table . "` WHERE ";

        if (count($columns) == count($records)) {
            for ($x = 0; $x < count($columns); $x++) {
                $query .= " `" . $columns [$x] . "` = '" . $records [$x] . "' ";
                if ($x < (count($columns) - 1)) {
                    $query .= " AND ";
                }
            }


            if ($printSQL) {
                echo $query;
            }

            $delete = $this->database_handle->query($query);
            return $delete; // Return number of deleted rows
        } else {
            $message = "";
            if (count($columns) > count($records)) {
                $message = "Column count(" . count($columns) . ") is greater than record count(" . count($records) . ") ";
            } else {
                $message = "Record count(" . count($records) . ") is greater than record column(" . count($columns) . ") ";
            }
            throw new InvalidColumnValueMatchException ('Invalid query,' . $message);
        }

    }

    /**
     * Deletes all records in a relation
     * @param $table
     * @param bool $printSQL
     * @return bool|\mysqli_result
     * @throws NullabilityException
     */
    public function delete_all_records($table, $printSQL = false)
    {
        if (empty ($table)) {
            throw new NullabilityException ("The table name cannot be null");
        }

        $query = 'TRUNCATE table `' . $table . '`;';

        if ($printSQL) {
            echo $query;
        }

        return $this->database_handle->query($query);
    }

    /**
     * Inserts records in a relation
     *
     * @param $table
     * @param array $columns
     * @param array $records
     * @param bool $printSQL
     * @return bool|\mysqli_result
     * @throws NullabilityException
     */
    public function insert_records($table, Array $columns, Array $records, $printSQL = false)
    {
        if (empty ($table) || count($columns) == 0 || count($records) == 0) {
            if (empty ($table)) {
                throw new NullabilityException ("The table name cannot be null");
            }
            if ((count($columns) == 0)) {
                throw new NullabilityException ("The table columns cannot be none");
            }
            if ((count($records) == 0)) {
                throw new NullabilityException ("The column records cannot be none");
            }
        }

        $query = " INSERT INTO `" . $table . "` (";

        for ($x = 0; $x < count($columns); $x++) {
            $query .= " `" . $columns [$x] . "` ";
            if (($x < count($columns) - 1)) {
                $query .= ",";
            }
        }

        $query .= ") VALUES (";

        for ($x = 0; $x < count($records); $x++) {
            $query .= " '" . $records [$x] . "' ";
            if (($x < count($records) - 1)) {
                $query .= ",";
            }
        }

        $query .= ");";
        if ($printSQL) {
            echo $query;
        }

        return $this->database_handle->query($query);
    }

    /**
     * Inserts records in a relation
     * The records are inserted in the relation columns in the order they are arranged in the array
     *
     * @param $table
     * @param array $records
     * @param bool $printSQL
     * @return bool|\mysqli_result
     * @throws NullabilityException
     */
    public function insert_raw_records($table, Array $records, $printSQL = false)
    {
        if (empty ($table) || count($records) == 0) {
            if (empty ($table)) {
                throw new NullabilityException ("The table name cannot be null");
            }

            if ((count($records) == 0)) {
                throw new NullabilityException ("The column records cannot be none");
            }
        }

        $query = " INSERT INTO `" . $table . "` VALUES  (";


        for ($x = 0; $x < count($records); $x++) {
            $query .= " '" . $records [$x] . "' ";
            if (($x < count($records) - 1)) {
                $query .= ",";
            }
        }

        $query .= ");";
        if ($printSQL) {
            echo $query;
        }

        return $this->database_handle->query($query);
    }

    /**
     * Inserts a large number of records in a relation
     *
     * @param $table
     * @param array $columns
     * @param array $records
     * @param bool $printSQL
     * @return bool|\mysqli_result
     * @throws InvalidColumnValuePairMatchException
     * @throws NullabilityException
     */
    public function bulk_insert_records($table, Array $columns, Array $records, $printSQL = false)
    {
        if (empty ($table) || count($columns) == 0 || count($records) == 0) {
            if (empty ($table)) {
                throw new NullabilityException ("The table name cannot be null");
            }
            if ((count($columns) == 0)) {
                throw new NullabilityException ("The table columns cannot be none");
            }
            if ((count($records) == 0)) {
                throw new NullabilityException ("The column records cannot be none");
            }
        }

        $query = " INSERT INTO `" . $table . "` (";

        for ($x = 0; $x < count($columns); $x++) {
            $query .= " `" . $columns [$x] . "` ";
            if (($x < count($columns) - 1)) {
                $query .= ",";
            }
        }
        $record_count = count($records);
        $column_count = count($columns);

        $valueset = $record_count / $column_count;

        if ($record_count % $column_count == 0) {
        } else {
            throw new InvalidColumnValuePairMatchException ("The number of columns and record count does not match");
        }
        $query .= ") VALUES ";

        for ($i = 0; $i < $valueset; $i++) {
            $query .= "(";
            $record_set = (($i + 1) * $column_count);
            for ($x = ($i * $column_count); $x < $record_set; $x++) {

                $query .= " '" . $records [$x] . "' ";
                if (($x < ($record_set - 1))) {
                    $query .= ",";
                }
            }
            if (($i < $valueset - 1)) {
                $query .= "),";
            } else {
                $query .= ")";
            }
        }


        if ($printSQL) {
            echo $query;
        }
        return $this->database_handle->query($query);
    }

    /**
     * Updates the specified record(s) in a relation
     *
     * @param $table
     * @param array $columns
     * @param array $records
     * @param array $where_columns
     * @param array $where_records
     * @param bool $printSQL
     * @return bool|\mysqli_result
     * @throws NullabilityException
     */
    public function update_record($table, Array $columns, Array $records, Array $where_columns, Array $where_records, $printSQL = false)
    {
        if (empty ($table) || count($columns) == 0 || count($records) == 0 || count($where_columns) == 0 || count($where_records) == 0) {
            if (empty ($table)) {
                throw new NullabilityException ("The table name cannot be null");
            }
            if ((count($columns) == 0)) {
                throw new NullabilityException ("The table columns cannot be none");
            }
            if ((count($records) == 0)) {
                throw new NullabilityException ("The column records cannot be none");
            }
        }

        $query = " UPDATE `" . $table . "` SET ";

        for ($x = 0; $x < count($columns); $x++) {
            $query .= " `" . $columns [$x] . "` = '" . $records [$x] . "' ";
            if ($x < (count($columns) - 1)) {
                $query .= ",";
            }
        }

        if (count($where_columns) > 0 && count($where_records) > 0) {
            $query .= " WHERE ";

            for ($x = 0; $x < count($where_columns); $x++) {
                $query .= " `" . $where_columns [$x] . "` = '" . $where_records [$x] . "' ";
                if ($x < (count($where_columns) - 1)) {
                    $query .= " AND ";
                }
            }
        }


        if ($printSQL) {
            echo $query;
        }

        return $this->database_handle->query($query);
    }

    /**
     * Performs a query on a table and returns an associative array of the query results
     *
     * @param $table
     * @param array $columns
     * @param array $records
     * @param string $extraSQL
     * @param bool $printSQL
     * @return array associative
     * @throws InvalidColumnValueMatchException
     * @throws NullabilityException
     */
    public function query($table, Array $columns, Array $records, $extraSQL = "", $printSQL = false)
    {
        return $this->fetch_assoc(false, $table, $columns, $records, $extraSQL, $printSQL);
    }

    /**
     * Performs a query and returns an associative array of the query
     *
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
    public function fetch_assoc($distinct, $table, Array $columns, Array $records, $extraSQL = "", $printSQL = false)
    {
        if (empty ($table) || count($columns) == 0 || count($records) == 0) {
            if (empty ($table)) {
                throw new NullabilityException ("The table name cannot be null");
            }
        }

        $query = "";

        if ((count($columns) == 0) && (count($records) == 0)) {
            if ($distinct) {
                $query = "SELECT DISTINCT * FROM `" . $table . "`";
            } else {
                $query = "SELECT * FROM `" . $table . "`";
            }

        } else {
            if ($distinct) {
                $query = "SELECT DISTINCT * FROM `" . $table . "` WHERE ";
            } else {
                $query = "SELECT * FROM `" . $table . "` WHERE ";
            }

        }

        if (count($columns) == count($records)) {
            for ($x = 0; $x < count($columns); $x++) {
                $query .= " `" . $columns [$x] . "` = '" . $records [$x] . "' ";

                if ($x < (count($columns) - 1)) {
                    $query .= " AND ";
                }
            }

            if ((count($columns) == 0) && (count($records) == 0)) {

                if ($extraSQL != "") {
                    $query .= $extraSQL . ";";
                }
            } else {
                if ($extraSQL != "") {
                    $query .= $extraSQL . ";";
                }
            }

            if ($printSQL) {
                echo $query;
            }

            $results = array();

            $exec = $this->database_handle->query($query); // Perform Query
            while ($assoc = $exec->fetch_assoc()) {
                $results [count($results)] = $assoc; // Return rows
            }

            return $results;
        } else {
            $message = "Columns are more or rows are more";
            if (count($columns) > count($records)) {
                $message = "Column count(" . count($columns) . ") is greater than record count(" . count($records) . ") ";
            } else {
                $message = "Record count(" . count($records) . ") is greater than record column(" . count($columns) . ") ";
            }
            throw new InvalidColumnValueMatchException ('Invalid query,' . $message);
        }
    }

    /**
     * Returns an associative array of the distinct query
     * @param $table
     * @param array $columns
     * @param array $records
     * @param string $extraSQL
     * @param bool $printSQL
     * @return array associative
     * @throws InvalidColumnValueMatchException
     * @throws NullabilityException
     */
    public function query_distinct($table, Array $columns, Array $records, $extraSQL = "", $printSQL = false)
    {
        return $this->fetch_assoc(true, $table, $columns, $records, $extraSQL, $printSQL);
    }

    /**
     * Returns an associative array of the query
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
    public function search($table, Array $columns, Array $records, $extraSQL = "", $printSQL = false)
    {
        if (empty ($table) || count($columns) == 0 || count($records) == 0) {
            if (empty ($table)) {
                throw new NullabilityException ("The table name cannot be null");
            }
        }

        $query = "";

        if ((count($columns) == 0) && (count($records) == 0)) {
            $query = "SELECT * FROM `" . $table . "`";
        } else {
            $query = "SELECT * FROM `" . $table . "` WHERE ";
        }

        if (count($columns) == count($records)) {
            for ($x = 0; $x < count($columns); $x++) {
                $query .= " `" . $columns [$x] . "` LIKE '%" . $records [$x] . "%' ";

                if ($x < (count($columns) - 1)) {
                    $query .= " OR ";
                }
            }

            if ((count($columns) == 0) && (count($records) == 0)) {

                if ($extraSQL != "") {
                    $query .= $extraSQL . ";";
                }
            } else {
                if ($extraSQL != "") {
                    $query .= $extraSQL . ";";
                }
            }

            if ($printSQL) {
                echo $query;
            }

            $results = array();
            $exec = $this->database_handle->query($query); // Perform Query
            while ($assoc = $exec->fetch_assoc()) {
                $results [count($results)] = $assoc; // Return rows
            }

            return $results;
        } else {
            $message = "Columns are more or rows are more";
            if (count($columns) > count($records)) {
                $message = "Column count(" . count($columns) . ") is greater than record count(" . count($records) . ") ";
            } else {
                $message = "Record count(" . count($records) . ") is greater than record column(" . count($columns) . ") ";
            }
            throw new InvalidColumnValueMatchException ('Invalid query,' . $message);
        }
    }

    /**
     * Resets the auto increment value of the table
     * @param $table
     * @param bool $printSQL
     * @throws NullabilityException
     */
    public function resetAutoIncrement($table, $printSQL = false)
    {
        if (empty ($table)) {
            throw new NullabilityException ("The table name cannot be null");
        }
        $query = 'alter table `' . $table . '` set auto_increment = 1';
        if ($printSQL) {
            echo $query;
        }
        $this->database_handle->query($query);
    }

    /**
     * Does a raw delete
     * @param $query
     * @return bool|\mysqli_result
     */
    public function rawDelete($query)
    {
        return $this->rawSQL($query);
    }

    /**
     * Performs a raw SQL
     * @param $query
     * @return bool|\mysqli_result
     */
    public function rawSQL($query)
    {
        return $this->database_handle->query($query); // Perform Raw SQL Query
    }

    /**
     * Does a raw insert
     * @param $query
     * @return bool|\mysqli_result
     */
    public function rawInsert($query)
    {
        return $this->rawSQL($query);
    }

    /**
     * Does a raw update
     * @param $query
     * @return bool|\mysqli_result
     */
    public function rawUpdate($query)
    {
        return $this->rawSQL($query);
    }

    /**
     * Renames a database table
     *
     * @param $oldname
     * @param $newname
     * @param bool $printSQL
     * @return bool|\mysqli_result
     * @throws NullabilityException
     */
    public function renameTable($oldname, $newname, $printSQL = false)
    {
        if (empty ($oldname) || empty ($newname)) {
            throw new NullabilityException ("The table name cannot be null");
        }

        $query = 'RENAME TABLE `' . $oldname . '` TO `' . $newname . '`;';

        if ($printSQL) {
            echo $query;
        }

        return $this->database_handle->query($query);
    }

    /**
     * Get this database connection
     * @return \app\database\core\DatabaseConnection
     */
    public function get_connection()
    {
        return $this->database_connection->getConnection();
    }

    /**
     * Optimize all the tables in a database
     * @param null $database
     */
    public function optimizeDatabaseTables($database = null)
    {
        $tables = $this->getDatabaseTables($database);

        foreach ($tables as $table) {
            $this->rawSQL("OPTIMIZE TABLE " . $table);
        }
    }

    /**
     * Get the list of all tables in the database
     * @param null $database
     * @return array
     */
    public function getDatabaseTables($database = null)
    {
        $tableNames = array();

        $query = "SHOW TABLES ";

        if ($database != null) {
            $query .= " IN " . $database;
        } else {
            $database = $this->database_connection->get_database_name();
        }
        $tables = $this->rawQuery($query);

        foreach ($tables as $table) {
            $tableNames[count($tableNames)] = $table["Tables_in_" . $database];
        }

        return $tableNames;
    }

    /**
     * Performs a raw sql query
     * @param $query
     * @return array
     * @throws NullabilityException
     */
    public function rawQuery($query)
    {
        if (empty ($query)) {
            throw new NullabilityException ("The query name cannot be null");
        }

        $results = array();

        $exec = $this->rawSQL($query);

        while ($assoc = $exec->fetch_assoc()) {
            $results [count($results)] = $assoc; // Return rows
        }

        return $results;
    }

    /**
     * Prepare an OR search
     * @param $table
     * @param array|null $columns
     * @param array|null $options
     * @param string $extraSQL
     * @param bool $printSQL
     * @return array
     */
    public function prepareSearchOR($table, $columns = null, $options = null, $extraSQL = "", $printSQL = false)
    {
        return $this->prepareSearch($table, $columns, $options, " OR ", $extraSQL, $printSQL);
    }

    /**
     * Prepare search
     *
     * @param $table
     * @param array|null $columns
     * @param array|null $options
     * @param string $delimiter
     * @param string $extraSQL
     * @param bool $printSQL
     * @return array
     */
    public function prepareSearch($table, Array $columns = null, Array $options = null, $delimiter = " LIKE ", $extraSQL = "", $printSQL = false)
    {
        $query = "SELECT ";
        if ($columns != null) {
            if (count($columns) > 0) {
                for ($i = 0; $i < count($columns); $i++) {
                    $query .= $columns[$i];
                    if ($i < count($columns) - 1) {
                        $query .= ",";
                    }
                }
            }
        } else {
            $query .= " * ";
        }

        $query .= " FROM `$table`";

        if ($options != null) {
            if (count($options) > 0) {
                $query .= " WHERE ";
                $options_size = count($options);
                $options_index = 0;
                foreach ($options as $key => $value) {
                    $query .= "`$key` LIKE '%$value%'";

                    if ($options_index < $options_size - 1) {
                        $query .= " $delimiter ";
                    }

                    $options_index++;
                }
            }
        }
        $query .= " " . $extraSQL;

        if ($printSQL) {
            echo $query;
        }

        return $this->rawQuery($query);
    }

    /**
     * Prepare an AND search
     * @param $table
     * @param array|null $columns
     * @param array|null $options
     * @param string $extraSQL
     * @param bool $printSQL
     * @return array
     */
    public function prepareSearchAND($table, Array $columns = null, Array $options = null, $extraSQL = "", $printSQL = false)
    {
        return $this->prepareSearch($table, $columns, $options, " AND ", $extraSQL, $printSQL);
    }

    /**
     * Prepare an OR query
     * @param $table
     * @param array|null $columns
     * @param array|null $options
     * @param string $extraSQL
     * @param bool $printSQL
     * @return array
     */
    public function prepareQueryOR($table, $columns = null, $options = null, $extraSQL = "", $printSQL = false)
    {
        return $this->prepareQuery($table, $columns, $options, " OR ", $extraSQL, $printSQL);
    }

    /**
     * Prepare query
     *
     * @param $table
     * @param array|null $columns
     * @param array|null $options
     * @param string $delimiter
     * @param string $extraSQL
     * @param bool $printSQL
     * @return array
     */
    public function prepareQuery($table, Array $columns = null, Array $options = null, $delimiter = " LIKE ", $extraSQL = "", $printSQL = false)
    {
        $query = "SELECT ";
        if ($columns != null) {
            if (count($columns) > 0) {
                for ($i = 0; $i < count($columns); $i++) {
                    $query .= $columns[$i];
                    if ($i < count($columns) - 1) {
                        $query .= ",";
                    }
                }
            }
        } else {
            $query .= " * ";
        }

        $query .= " FROM `$table`";

        if ($options != null) {
            if (count($options) > 0) {
                $query .= " WHERE ";
                $options_size = count($options);
                $options_index = 0;
                foreach ($options as $key => $value) {
                    $query .= "`$key`='$value'";

                    if ($options_index < $options_size - 1) {
                        $query .= " $delimiter ";
                    }

                    $options_index++;
                }
            }
        }
        $query .= " " . $extraSQL;

        if ($printSQL) {
            echo $query;
        }

        return $this->rawQuery($query);
    }

    /**
     * Prepare an AND query
     * @param $table
     * @param array|null $columns
     * @param array|null $options
     * @param string $extraSQL
     * @param bool $printSQL
     * @return array
     */
    public function prepareQueryAND($table, Array $columns = null, Array $options = null, $extraSQL = "", $printSQL = false)
    {
        return $this->prepareQuery($table, $columns, $options, " AND ", $extraSQL, $printSQL);
    }

}

?>
