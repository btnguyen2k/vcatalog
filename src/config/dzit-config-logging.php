<?php
/*
 * Configurations for Ddth::Commons::Logging
 */

global $DPHP_COMMONS_LOGGING_CONFIG_SIMPLE;
$DPHP_COMMONS_LOGGING_CONFIG_SIMPLE = Array(
        'ddth.commons.logging.Logger' => 'Ddth_Commons_Logging_SimpleLog',
        'logger.setting.default' => 'WARN');

global $DPHP_COMMONS_LOGGING_CONFIG_MYSQL;
$DPHP_COMMONS_LOGGING_CONFIG_MYSQL = Array(
        'ddth.commons.logging.Logger' => 'Vcatalog_Logging_MysqlLog',
        'logger.setting.default' => 'WARN',
        'logger.setting.mysql.host' => '127.0.0.1',
        'logger.setting.mysql.username' => 'vcatalog',
        'logger.setting.mysql.password' => 'vcatalog',
        'logger.setting.mysql.dbname' => 'vcatalog',
        'logger.setting.mysql.table_name' => 'app_log');

global $DPHP_COMMONS_LOGGING_CONFIG_PGSQL;
$DPHP_COMMONS_LOGGING_CONFIG_PGSQL = Array(
        'ddth.commons.logging.Logger' => 'Vcatalog_Logging_PgsqlLog',
        'logger.setting.default' => 'WARN',
        'logger.setting.pgsql.host' => '127.0.0.1',
        'logger.setting.pgsql.username' => 'vcatalog',
        'logger.setting.pgsql.password' => 'vcatalog',
        'logger.setting.pgsql.dbname' => 'vcatalog',
        'logger.setting.pgsql.table_name' => 'app_log');

global $DPHP_COMMONS_LOGGING_CONFIG;
if (IN_DEV_ENV) {
    $DPHP_COMMONS_LOGGING_CONFIG = &$DPHP_COMMONS_LOGGING_CONFIG_SIMPLE;
} else {
    $dbType = getenv('VCATALOG_DBTYPE');
    if ($dbType !== FALSE) {
        if (strtoupper($dbType) == 'MYSQL') {
            $DPHP_COMMONS_LOGGING_CONFIG = &$DPHP_COMMONS_LOGGING_CONFIG_MYSQL;
        } elseif (strtoupper($dbType) == 'PGSQL' || strtoupper($dbType) == 'POSTGRES' || strtoupper($dbType) == 'POSTGRESQL') {
            $DPHP_COMMONS_LOGGING_CONFIG = &$DPHP_COMMONS_LOGGING_CONFIG_PGSQL;
        }
    } else {
        $DPHP_COMMONS_LOGGING_CONFIG = &$DPHP_COMMONS_LOGGING_CONFIG_MYSQL;
    }
}
