<?php
class Vcatalog_Controller_Admin_CreateUserController extends Vcatalog_Controller_Admin_BaseFlowController {
    const VIEW_NAME = 'inline_create_user';
    
    const VIEW_NAME_AFTER_POST = 'info';
    
    const FORM_FIELD_USERNAME = 'username';
    const FORM_FIELD_TITLE = 'title';
    const FORM_FIELD_FULLNAME = 'fullname';
    const FORM_FIELD_LOCATION = 'location';
    const FORM_FIELD_EMAIL = 'email';
    const FORM_FIELD_PASSWORD = 'password';
    const FORM_FIELD_GROUP_ID = 'groupId';
    const FORM_FIELD_CONFIRMED_PASSWORD = 'confirmedPassword';
    
    /**
     * @see Vcatalog_Controller_Admin_BaseFlowController::getViewName()
     */
    protected function getViewName() {
        return self::VIEW_NAME;
    }
    
    /**
     * @see Dzit_Controller_FlowController::getModelAndView_FormSubmissionSuccessful()
     */
    protected function getModelAndView_FormSubmissionSuccessful() {
        $viewName = self::VIEW_NAME_AFTER_POST;
        $model = $this->buildModel();
        if ($model == NULL) {
            $model = Array();
        }
        
        $lang = $this->getLanguage();
        $urlTransit = $this->getUrlUserManagement();
        $model[MODEL_URL_TRANSIT] = $urlTransit;
        $model[MODEL_INFO_MESSAGES] = Array(
                $lang->getMessage('msg.register.done', htmlspecialchars($_POST[self::FORM_FIELD_EMAIL])));
        /*
        if (isset($_SESSION[SESSION_LAST_ACCESS_URL])) {
            $urlTransit = $_SESSION[SESSION_LAST_ACCESS_URL];
        } else {
            $urlTransit = $_SERVER['SCRIPT_NAME'];
        }
        if (strpos($urlTransit, '?') === FALSE) {
            $urlTransit .= '?' . rand();
        } else {
            $urlTransit .= '&' . rand();
        }
        $model[MODEL_URL_TRANSIT] = $urlTransit;
        $model[MODEL_TRANSIT_MESSAGE] = $lang->getMessage('msg.transit', $urlTransit);
        */
        
        return new Dzit_ModelAndView($viewName, $model);
    }
    
    /**
     * @see Vcatalog_Controller_Admin_BaseFlowController::buildModel_Form()
     */
    protected function buildModel_Form() {
        $form = Array('action' => $_SERVER['REQUEST_URI'], 
                'actionCancel' => $this->getUrlUserManagement(), 
                'name' => 'frmCreateUser');
        $this->populateForm($form, Array(
                self::FORM_FIELD_TITLE, 
                self::FORM_FIELD_FULLNAME, 
                self::FORM_FIELD_LOCATION, 
                self::FORM_FIELD_EMAIL, 
                self::FORM_FIELD_GROUP_ID, 
                self::FORM_FIELD_USERNAME, 
                self::FORM_FIELD_PASSWORD, 
                self::FORM_FIELD_CONFIRMED_PASSWORD));
        if ($this->hasError()) {
            $form['errorMessages'] = $this->getErrorMessages();
        }
        return $form;
    }
    
    /**
     * @see Dzit_Controller_FlowController::performFormSubmission()
     */
    protected function performFormSubmission() {
        $userDao = $this->getDao(DAO_USER);
        $title = isset($_POST[self::FORM_FIELD_TITLE]) ? trim($_POST[self::FORM_FIELD_TITLE]) : '';
        $fullname = isset($_POST[self::FORM_FIELD_FULLNAME]) ? trim($_POST[self::FORM_FIELD_FULLNAME]) : '';
        $location = isset($_POST[self::FORM_FIELD_LOCATION]) ? trim($_POST[self::FORM_FIELD_LOCATION]) : '';
        $groupId = isset($_POST[self::FORM_FIELD_GROUP_ID]) ? trim($_POST[self::FORM_FIELD_GROUP_ID]) : 2;
        $email = isset($_POST[self::FORM_FIELD_EMAIL]) ? trim($_POST[self::FORM_FIELD_EMAIL]) : '';
        $username = isset($_POST[self::FORM_FIELD_USERNAME]) ? trim($_POST[self::FORM_FIELD_USERNAME]) : '';
        $password = isset($_POST[self::FORM_FIELD_PASSWORD]) ? trim($_POST[self::FORM_FIELD_PASSWORD]) : '';
        $confirmedPassword = isset($_POST[self::FORM_FIELD_CONFIRMED_PASSWORD]) ? trim($_POST[self::FORM_FIELD_CONFIRMED_PASSWORD]) : '';
        
        $lang = $this->getLanguage();
        if ($email === '') {
            $this->addErrorMessage($lang->getMessage('error.invalidEmail', $email));
        
        } else {
            $user = $userDao->getUserByEmail($email);
            if ($user !== NULL) {
                $this->addErrorMessage($lang->getMessage('error.emailExists', htmlspecialchars($email)));
            }
        }
        if ($username === '') {
            $this->addErrorMessage($lang->getMessage('error.invalidUsername', $username));
        } else {
            $user = $userDao->getUserByUsername($username);
            if ($user !== NULL) {
                $this->addErrorMessage($lang->getMessage('error.usernameExists', htmlspecialchars($username)));
            }
        }
        if ($password === '') {
            $this->addErrorMessage($lang->getMessage('error.emptyPassword'));
        } else if ($password !== $confirmedPassword) {
            $this->addErrorMessage($lang->getMessage('error.passwordsMismatch'));
        }
        
        //Set Object
        $user = new Vcatalog_Bo_User_BoUser();
        $user->setEmail($email);
        $user->setFullname($fullname);
        $user->setGroupId($groupId);
        $user->setLocation($location);
        $user->setPassword(md5($password));
        $user->setTitle($title);
        $user->setUsername($username);
        
        //Check Error
        if ($this->hasError()) {
            return FALSE;
        }
        
        //Execute create
        $userDao->createUser($user);
        return TRUE;
    }
    
   
}
