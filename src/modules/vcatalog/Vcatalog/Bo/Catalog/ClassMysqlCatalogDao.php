<?php
class Vcatalog_Bo_Catalog_MysqlCatalogDao extends Vcatalog_Bo_Catalog_BaseCatalogDao implements
        Ddth_Dao_Mysql_IMysqlDao {

    protected function fetchResultAssoc($rs) {
        return mysql_fetch_array($rs, MYSQL_ASSOC);
    }

    protected function fetchResultArr($rs) {
        return mysql_fetch_array($rs, MYSQL_NUM);
    }
}
