<?php
class Vcatalog_Controller_Admin_HomeController extends Vcatalog_Controller_Admin_BaseFlowController {

    const VIEW_NAME = 'home';

    /**
     * @see Vcatalog_Controller_BaseFlowController::getViewName()
     */
    protected function getViewName() {
        return self::VIEW_NAME;
    }
}
