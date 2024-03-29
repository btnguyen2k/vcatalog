<?php
class Vcatalog_ProfiledDispatcher extends Dzit_DefaultDispatcher {

    /**
     *
     * @var Ddth_Commons_Logging_ILog
     */
    private $LOGGER;

    public function __construct() {
        $this->LOGGER = Ddth_Commons_Logging_LogFactory::getLog(__CLASS__);
        parent::__construct();
    }

    /**
     * (non-PHPdoc)
     *
     * @see Dzit_DefaultDispatcher::renderModelAndView()
     */
    protected function renderModelAndView($mav, $module, $action) {
        if (defined('PROFILING')) {
            Quack_Util_ProfileUtils::push("RENDER_$module.$action");
        }
        $result = parent::renderModelAndView($mav, $module, $action);
        if (defined('PROFILING')) {
            Quack_Util_ProfileUtils::pop();
        }
        return $result;
    }

    /**
     * (non-PHPdoc)
     *
     * @see Dzit_DefaultDispatcher::executeAction()
     */
    protected function executeAction($actionHandler, $module, $action) {
        if (defined('PROFILING')) {
            Quack_Util_ProfileUtils::push("EXECUTE_$module.$action");
        }
        $result = parent::executeAction($actionHandler, $module, $action);
        if (defined('PROFILING')) {
            Quack_Util_ProfileUtils::pop();
        }
        return $result;
    }

    /**
     * (non-PHPdoc)
     *
     * @see Dzit_DefaultDispatcher::dispatch()
     */
    public function dispatch() {
        if (defined('PROFILING')) {
            Quack_Util_ProfileUtils::push('ROOT');
        }
        $result = parent::dispatch();
        if (defined('PROFILING')) {
            Quack_Util_ProfileUtils::pop();
            try {
                $writeProfiling = TRUE;
                if (PROFILING_THRESHOLD > 0.0) {
                    $entryList = Quack_Util_ProfileUtils::get();
                    $duration = 0.0;
                    foreach ($entryList as $entry) {
                        $duration += $entry[Quack_Util_ProfileUtils::KEY_DURATION];
                    }
                    if ($duration < PROFILING_THRESHOLD) {
                        $writeProfiling = FALSE;
                    }
                }
                if ($writeProfiling) {
                    $profileDao = Ddth_Dao_BaseDaoFactory::getInstance()->getDao(DAO_PROFILE);
                    $profileDao->writeProfilingData();
                }
            } catch (Exception $e) {
                $this->LOGGER->error($e->getMessage(), $e);
            }
        }
        return $result;
    }
}