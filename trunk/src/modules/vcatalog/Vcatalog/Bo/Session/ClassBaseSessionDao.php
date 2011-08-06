<?php
abstract class Vcatalog_Bo_Session_BaseSessionDao extends Commons_Bo_BaseDao implements
        Vcatalog_Bo_Session_ISessionDao {

    /**
     * @var Ddth_Commons_Logging_ILog
     */
    private $LOGGER;

    public function __construct() {
        $this->LOGGER = Ddth_Commons_Logging_LogFactory::getLog(__CLASS__);
        parent::__construct();
    }

    /**
     * @see Vcatalog_Bo_Session_ISessionDao::deleteExpiredSessions()
     */
    public function deleteExpiredSessions($expiry) {
        return;
        if ($this->LOGGER->isDebugEnabled()) {
            $msg = '[' . __CLASS__ . '::' . __FUNCTION__ . "]Expiry: {$expiry}";
            $this->LOGGER->debug($msg);
        }
        $msg = '[' . __CLASS__ . '::' . __FUNCTION__ . "]Expiry: {$expiry}";
        print_r($msg);
        return;
        $sqlStm = $this->getStatement('sql.' . __FUNCTION__);
        $sqlConn = $this->getConnection();

        $params = Array('expiry' => $expiry);
        $rs = $sqlStm->execute($sqlConn->getConn(), $params);

        $this->closeConnection();
    }

    /**
     * @see Vcatalog_Bo_Session_ISessionDao::deleteSessionData()
     */
    public function deleteSessionData($id) {
        if ($this->LOGGER->isDebugEnabled()) {
            $msg = '[' . __CLASS__ . '::' . __FUNCTION__ . "]Session Id: {$id}";
            $this->LOGGER->debug($msg);
        }
        $sqlStm = $this->getStatement('sql.' . __FUNCTION__);
        $sqlConn = $this->getConnection();

        $params = Array('id' => $id);
        $rs = $sqlStm->execute($sqlConn->getConn(), $params);

        $this->closeConnection();
    }

    /**
     * @see Vcatalog_Bo_Session_ISessionDao::readSessionData()
     */
    public function readSessionData($id) {
        if ($this->LOGGER->isDebugEnabled()) {
            $msg = '[' . __CLASS__ . '::' . __FUNCTION__ . "]Session Id: {$id}";
            $this->LOGGER->debug($msg);
        }
        $sqlStm = $this->getStatement('sql.' . __FUNCTION__);
        $sqlConn = $this->getConnection();

        $params = Array('id' => $id);
        $rs = $sqlStm->execute($sqlConn->getConn(), $params);
        $result = $this->fetchResultAssoc($rs);

        $this->closeConnection();
        return $result !== FALSE ? $result['data'] : NULL;
    }

    /**
     * @see Vcatalog_Bo_Session_ISessionDao::writeSessionData()
     */
    public function writeSessionData($id, $data) {
        if ($this->LOGGER->isDebugEnabled()) {
            $msg = '[' . __CLASS__ . '::' . __FUNCTION__ . "]Session Id: {$id}/Data: {$data}";
            $this->LOGGER->debug($msg);
        }
        $oldData = $this->readSessionData($id);
        if ($oldData === NULL) {
            $sqlStm = $this->getStatement('sql.createSession');
        } else {
            $sqlStm = $this->getStatement('sql.updateSession');
        }
        $sqlConn = $this->getConnection();

        $params = Array('id' => $id, 'data' => $data, 'timestamp' => time());
        $sqlStm->execute($sqlConn->getConn(), $params);
        $this->closeConnection();
    }
}