<?php
class Vcatalog_Controller_BenchmarkController extends Vcatalog_Controller_BaseFlowController {
    private $viewName = 'benchmark';

    /**
     *
     * @var Ddth_Commons_Logging_ILog
     */
    private $LOGGER;

    /**
     * Constructs a new Vcatalog_Controller_BaseFlowController object.
     */
    public function __construct() {
        $this->executionTimestamp = microtime(TRUE);
        $this->LOGGER = Ddth_Commons_Logging_LogFactory::getLog(__CLASS__);
    }

    /**
     *
     * @see Dzit_Controller_FlowController::execute()
     */
    public function execute($module, $action) {
        $userDao = $this->getDao(DAO_USER);
        Quack_Util_ProfileUtils::push('Benchmark:getUser');
        for ($i = 0; $i < 10; $i++) {
            Quack_Util_ProfileUtils::push('Benchmark:getUser(' . $i . ')');
            $user = $userDao->getUserById($i % 2);
            Quack_Util_ProfileUtils::pop();
        }
        Quack_Util_ProfileUtils::pop();
        print_r(Quack_Util_ProfileUtils::get());

        $configDao = $this->getDao(DAO_CONFIG);
        Quack_Util_ProfileUtils::push('Benchmark:getConfig');
        for ($i = 0; $i < 10; $i++) {
            Quack_Util_ProfileUtils::push('Benchmark:getConfig(' . $i . ')');
            if (rand(1, 10) < 5) {
                $config = $configDao->loadConfig(CONFIG_SITE_COPYRIGHT);
            } else {
                $config = $configDao->loadConfig("$i");
            }
            Quack_Util_ProfileUtils::pop();
        }
        Quack_Util_ProfileUtils::pop();
        print_r(Quack_Util_ProfileUtils::get());

        $catalogDao = $this->getDao(DAO_CATALOG);
        Quack_Util_ProfileUtils::push('Benchmark:getCategory');
        for ($i = 0; $i < 10; $i++) {
            $id = rand(0, 100);
            Quack_Util_ProfileUtils::push('Benchmark:getCategory(' . $id . ')');
            $category = $catalogDao->getCategoryById($id);
            Quack_Util_ProfileUtils::pop();
        }
        Quack_Util_ProfileUtils::pop();
        print_r(Quack_Util_ProfileUtils::get());

        $model = NULL;
        $view = $this->getViewName();
        $modelAndView = new Dzit_ModelAndView($view, $model);
        return $modelAndView;
    }
}
