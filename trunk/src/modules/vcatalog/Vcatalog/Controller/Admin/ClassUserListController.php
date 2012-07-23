<?php
class Vcatalog_Controller_Admin_UserListController extends Vcatalog_Controller_Admin_BaseFlowController {
    
    const VIEW_NAME = 'inline_user_list';
    
    /**
     * @see Vcatalog_Controller_BaseFlowController::getViewName()
     */
    protected function getViewName() {
        return self::VIEW_NAME;
    }
    
    /**
     * @see Vcatalog_Controller_Admin_BaseFlowController::buildModel_Custom()
     */
    protected function buildModel_Custom() {
        $model = parent::buildModel_Custom();
        if ($model === NULL) {
            $model = Array();
        }
        
        /**
         * @var Vcatalog_Bo_Catalog_IUserDao
         */
        $userDao = $this->getDao(DAO_USER);
        $userList = $userDao->getUsers();
        $model[MODEL_USER_LIST] = Vcatalog_Model_UserBEModel::createModelObj($userList);
        return $model;
    }
}