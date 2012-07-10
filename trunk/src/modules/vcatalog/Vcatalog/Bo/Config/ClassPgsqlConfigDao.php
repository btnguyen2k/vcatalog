<?php
class Vcatalog_Bo_Config_PgsqlConfigDao extends Vcatalog_Bo_Config_BaseConfigDao implements
        Ddth_Dao_Pgsql_IPgsqlDao {

    protected function fetchResultAssoc($rs) {
        return pg_fetch_array($rs, NULL, PGSQL_ASSOC);
    }

    protected function fetchResultArr($rs) {
        return pg_fetch_array($rs, NULL, PGSQL_NUM);
    }
}
