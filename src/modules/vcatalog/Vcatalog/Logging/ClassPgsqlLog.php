<?php
/**
 * This class extends the {@link Ddth_Commons_Logging_AbstractLog} and utilizes PgSQL to store logs.
 *
 * @package     Vcatalog
 * @subpackage  Logging
 * @author      Thanh Ba Nguyen <btnguyen2k@gmail.com>
 * @since       Class available since v0.1
 */
class Vcatalog_Logging_PgsqlLog extends Ddth_Commons_Logging_AbstractLog {

    const SETTING_PGSQL_HOST = 'pgsql.host';
    const SETTING_PGSQL_PORT = 'pgsql.port';
    const SETTING_PGSQL_USERNAME = 'pgsql.username';
    const SETTING_PGSQL_PASSWORD = 'pgsql.password';
    const SETTING_PGSQL_DBNAME = 'pgsql.dbname';
    const SETTING_TABLE_NAME = 'pgsql.table_name';

    private $pgsqlHost, $pgsqlPort, $pgsqlUsername, $pgsqlPassword, $pgsqlDbName;
    private $tableName;

    /**
     * Initializes this logger.
     *
     * @param Array $config
     */
    public function init($config) {
        parent::init($config);
        $this->pgsqlHost = isset($config[self::SETTING_PGSQL_HOST]) ? $config[self::SETTING_PGSQL_HOST] : 'localhost';
        $this->pgsqlPort = isset($config[self::SETTING_PGSQL_PORT]) ? $config[self::SETTING_PGSQL_PORT] : 5432;
        $this->pgsqlUsername = isset($config[self::SETTING_PGSQL_USERNAME]) ? $config[self::SETTING_PGSQL_USERNAME] : '';
        $this->pgsqlPassword = isset($config[self::SETTING_PGSQL_PASSWORD]) ? $config[self::SETTING_PGSQL_PASSWORD] : '';
        $this->pgsqlDbName = isset($config[self::SETTING_PGSQL_DBNAME]) ? $config[self::SETTING_PGSQL_DBNAME] : NULL;
        $this->tableName = isset($config[self::SETTING_TABLE_NAME]) ? $config[self::SETTING_TABLE_NAME] : NULL;

        if ($this->pgsqlDbName === NULL || $this->pgsqlDbName === '') {
            $msg = 'Please specify a PgSQL database!';
            throw new Exception($msg);
        }
        if ($this->tableName === NULL || $this->tableName === '') {
            $msg = 'Please specify a PgSQL table!';
            throw new Exception($msg);
        }
    }

    /**
     * Writes a log entry.
     *
     * @param string $logLevel
     * @param string $logMsg
     * @param Exception $e
     */
    protected function writeLog($logLevel, $logMsg, $e) {
        $connStr = "host={$this->pgsqlHost} port={$this->pgsqlHost} dbname={$this->pgsqlDbName} user={$this->pgsqlUsername} password={$this->pgsqlPassword} options='--client_encoding=UTF8'";
        $conn = @pg_connect($connStr, PGSQL_CONNECT_FORCE_NEW);
        if ($conn === FALSE || $conn === NULL) {
            $msg = "Can not connect to PgSQL server {$this->pgsqlHost}!";
            throw new Exception($msg);
        }
        $stacktrace = $e !== NULL ? $e->getTraceAsString() : NULL;
        $className = $e !== NULL ? $e->getFile() : '';
        $sql = "INSERT INTO {$this->tableName} (logTimestamp, logLevel, logClass, logMessage, logStacktrace)";
        $sql .= "VALUES (";
        $sql .= time() . ",";
        $sql .= "'" . pg_escape_string($conn, $logLevel) . "',";
        $sql .= "'" . pg_escape_string($conn, $className) . "',";
        $sql .= "'" . pg_escape_string($conn, $logMsg) . "',";
        $sql .= "'" . pg_escape_string($conn, $stacktrace) . "')";
        pg_query($conn, $sql);
        pg_close($conn);
    }

    /**
     * Logs a message with debug log level.
     *
     * @param
     *            string
     * @param
     *            Exception
     */
    public function debug($message, $e = NULL) {
        if (!$this->isDebugEnabled()) {
            return;
        }
        $this->writeLog('DEBUG', $message, $e);
    }

    /**
     * Logs a message with error log level.
     *
     * @param
     *            string
     * @param
     *            Exception
     */
    public function error($message, $e = NULL) {
        if (!$this->isErrorEnabled()) {
            return;
        }
        $this->writeLog('ERROR', $message, $e);
    }

    /**
     * Logs a message with fatal log level.
     *
     * @param
     *            string
     * @param
     *            Exception
     */
    public function fatal($message, $e = NULL) {
        if (!$this->isFatalEnabled()) {
            return;
        }
        $this->writeLog('FATAL', $message, $e);
    }

    /**
     * Logs a message with info log level.
     *
     * @param
     *            string
     * @param
     *            Exception
     */
    public function info($message, $e = NULL) {
        if (!$this->isInfoEnabled()) {
            return;
        }
        $this->writeLog('INFO', $message, $e);
    }

    /**
     * Logs a message with trace log level.
     *
     * @param
     *            string
     * @param
     *            Exception
     */
    public function trace($message, $e = NULL) {
        if (!$this->isTraceEnabled()) {
            return;
        }
        $this->writeLog('TRACE', $message, $e);
    }

    /**
     * Logs a message with warn log level.
     *
     * @param
     *            string
     * @param
     *            Exception
     */
    public function warn($message, $e = NULL) {
        if (!$this->isWarnEnabled()) {
            return;
        }
        $this->writeLog('WARN', $message, $e);
    }
}