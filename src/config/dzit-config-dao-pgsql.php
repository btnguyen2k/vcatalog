<?php
/*
 * PgSQL configurations for Ddth::Dao
 */

// For PgSQL
global $DPHP_DAO_CONFIG_PGSQL_SITE;
$DPHP_DAO_CONFIG_PGSQL_SITE = Array('dphp-dao.factoryClass' => 'Ddth_Dao_Pgsql_BasePgsqlDaoFactory',
        'dphp-dao.pgsql.host' => '127.0.0.1',
        'dphp-dao.pgsql.username' => 'gpv',
        'dphp-dao.pgsql.password' => 'gpvm@st3r',
        'dphp-dao.pgsql.database' => 'gpv',
        // 'dphp-dao.pgsql.connectionString' => "host=127.0.0.1 port=5432
        // dbname=gpv user=gpv password=gpvm@st3r
        // options='--client_encoding=UTF8'",
        'dao._' => 'Quack_Bo_ConnectionHolderDao',
        DAO_SITE => Array('class' => 'Quack_Bo_Site_PgsqlSiteDao',
                Ddth_Dao_AbstractSqlStatementDao::CONF_SQL_BASE_STM_FILE => 'Base/sql_site.base.properties'));

// For PgSQL
global $DPHP_DAO_CONFIG_PGSQL;
$DPHP_DAO_CONFIG_PGSQL = Array('dphp-dao.factoryClass' => 'Ddth_Dao_Pgsql_BasePgsqlDaoFactory',
        'dphp-dao.pgsql.host' => '127.0.0.1',
        'dphp-dao.pgsql.username' => 'vcatalog',
        'dphp-dao.pgsql.password' => 'vcatalog',
        'dphp-dao.pgsql.database' => 'vcatalog',
        // 'dphp-dao.pgsql.connectionString' => "host=127.0.0.1 port=5432
        // dbname=vcatalog user=vcatalog password=vcatalog
        // options='--client_encoding=UTF8'",
        'dao._' => 'Quack_Bo_ConnectionHolderDao',
        DAO_SESSION => Array('class' => 'Quack_Bo_SessionS_PgsqlSessionDao',
                Ddth_Dao_AbstractSqlStatementDao::CONF_SQL_BASE_STM_FILE => 'Base/sql_session.base.properties'),
        DAO_USER => Array('class' => 'Vcatalog_Bo_User_PgsqlUserDao',
                Ddth_Dao_AbstractSqlStatementDao::CONF_SQL_BASE_STM_FILE => 'Base/sql_user.base.properties'),
        DAO_CATALOG => Array('class' => 'Vcatalog_Bo_Catalog_PgsqlCatalogDao',
                Ddth_Dao_AbstractSqlStatementDao::CONF_SQL_BASE_STM_FILE => 'Base/sql_catalog.base.properties'),
        DAO_CART => Array('class' => 'Vcatalog_Bo_Cart_PgsqlCartDao',
                Ddth_Dao_AbstractSqlStatementDao::CONF_SQL_STM_FILE => 'PgSql/sql_cart.pgsql.properties',
                Ddth_Dao_AbstractSqlStatementDao::CONF_SQL_BASE_STM_FILE => 'Base/sql_cart.base.properties'),
        DAO_PAGE => Array('class' => 'Quack_Bo_Page_PgsqlPageDao',
                Ddth_Dao_AbstractSqlStatementDao::CONF_SQL_BASE_STM_FILE => 'Base/sql_page.base.properties'),
        DAO_TEXTADS => Array('class' => 'Vcatalog_Bo_TextAds_PgsqlAdsDao',
                Ddth_Dao_AbstractSqlStatementDao::CONF_SQL_BASE_STM_FILE => 'Base/sql_textads.base.properties'),
        DAO_PROFILE => Array('class' => 'Quack_Bo_Profile_PgsqlProfileDao',
                Ddth_Dao_AbstractSqlStatementDao::CONF_SQL_BASE_STM_FILE => 'Base/sql_profile.base.properties'),
        DAO_CONFIG => Array('class' => 'Quack_Bo_AppConfig_PgsqlAppConfigDao',
                Ddth_Dao_AbstractSqlStatementDao::CONF_SQL_BASE_STM_FILE => 'Base/sql_config.base.properties'),
        DAO_PAPERCLIP => Array('class' => 'Paperclip_Bo_PgsqlPaperclipDao',
                Ddth_Dao_AbstractSqlStatementDao::CONF_SQL_BASE_STM_FILE => 'Base/sql_paperclip.base.properties'));
