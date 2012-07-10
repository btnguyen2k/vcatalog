<?php
/*
 * Configurations for Ddth::Dao
 */
include_once 'dzit-config-dao-mysql.php';
include_once 'dzit-config-dao-pgsql.php';

global $DPHP_DAO_CONFIG_SITE;
$DPHP_DAO_CONFIG_SITE = &$DPHP_DAO_CONFIG_PGSQL_SITE;

global $DPHP_DAO_CONFIG;
$DPHP_DAO_CONFIG = &$DPHP_DAO_CONFIG_PGSQL;
