<?php
class Vcatalog_Controller_Admin_CatalogSettingsController extends Vcatalog_Controller_Admin_BaseFlowController {
    
    const VIEW_NAME = 'inline_catalog_settings';
    const VIEW_NAME_AFTER_POST = 'inline_catalog_settings';
    
    const FORM_FIELD_CURRENCY = 'currency';
    const FORM_FIELD_PRICE_DECIMAL_PLACES = 'priceDecimalPlaces';
    const FORM_FIELD_QUANTITY_DECIMAL_PLACES = 'quantityDecimalPlaces';
    const FORM_FIELD_DECIMAL_SEPARATOR = 'decimalSeparator';
    const FORM_FIELD_THOUSANDS_SEPARATOR = 'thousandsSeparator';
    const FORM_FIELD_PRICE_EXAMPLE = 'priceExample';
    const FORM_FIELD_QUANTITY_EXAMPLE = 'quantityExample';
    const FORM_FIELD_THUMBNAIL_WIDTH = 'thumbnailWidth';
    const FORM_FIELD_THUMBNAIL_HEIGHT = 'thumbnailHeight';
    
    /**
     * @see Vcatalog_Controller_BaseFlowController::getViewName()
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
        return new Dzit_ModelAndView($viewName, $model);
    }
    
    /**
     * @see Vcatalog_Controller_BaseFlowController::buildModel_Form()
     */
    protected function buildModel_Form() {
        $form = Array('action' => $_SERVER['REQUEST_URI'], 'name' => 'frmCatalogSettings');
        $form[self::FORM_FIELD_CURRENCY] = $this->getAppConfig(CONFIG_CURRENCY);
        $form[self::FORM_FIELD_PRICE_DECIMAL_PLACES] = $this->getAppConfig(CONFIG_PRICE_DECIMAL_PLACES);
        $form[self::FORM_FIELD_QUANTITY_DECIMAL_PLACES] = $this->getAppConfig(CONFIG_QUANTITY_DECIMAL_PLACES);
        $form[self::FORM_FIELD_DECIMAL_SEPARATOR] = $this->getAppConfig(CONFIG_DECIMAL_SEPARATOR);
        $form[self::FORM_FIELD_THOUSANDS_SEPARATOR] = $this->getAppConfig(CONFIG_THOUSANDS_SEPARATOR);
        $form[self::FORM_FIELD_THUMBNAIL_WIDTH] = $this->getAppConfig(CONFIG_THUMBNAIL_WIDTH);
        $form[self::FORM_FIELD_THUMBNAIL_HEIGHT] = $this->getAppConfig(CONFIG_THUMBNAIL_HEIGHT);
        
        $currency = $form[self::FORM_FIELD_CURRENCY];
        $priceDecimalPlaces = $form[self::FORM_FIELD_PRICE_DECIMAL_PLACES];
        $quantityDecimalPlaces = $form[self::FORM_FIELD_QUANTITY_DECIMAL_PLACES];
        $decimalSeparator = $form[self::FORM_FIELD_DECIMAL_SEPARATOR];
        $thousandsSeparator = $form[self::FORM_FIELD_THOUSANDS_SEPARATOR];
        $priceExample = number_format(123456.123, $priceDecimalPlaces, $decimalSeparator, $thousandsSeparator) . $currency;
        $quantityExample = number_format(1234.12, $quantityDecimalPlaces, $decimalSeparator, $thousandsSeparator);
        $form[self::FORM_FIELD_PRICE_EXAMPLE] = $priceExample;
        $form[self::FORM_FIELD_QUANTITY_EXAMPLE] = $quantityExample;
        
        if ($this->isPostRequest()) {
            $lang = $this->getLanguage();
            $form[FORM_INFO_MESSAGES] = Array($lang->getMessage('msg.catalogSettings.done'));
        }
        return $form;
    }
    
    /**
     * @see Dzit_Controller_FlowController::performFormSubmission()
     */
    protected function performFormSubmission() {
        $dao = $this->getDao(DAO_CONFIG);
        
        $currency = isset($_POST[self::FORM_FIELD_CURRENCY]) ? $_POST[self::FORM_FIELD_CURRENCY] : '';
        $priceDecimalPlaces = isset($_POST[self::FORM_FIELD_PRICE_DECIMAL_PLACES]) ? (int)$_POST[self::FORM_FIELD_PRICE_DECIMAL_PLACES] : 0;
        $quantityDecimalPlaces = isset($_POST[self::FORM_FIELD_QUANTITY_DECIMAL_PLACES]) ? (int)$_POST[self::FORM_FIELD_QUANTITY_DECIMAL_PLACES] : 0;
        $decimalSeparator = isset($_POST[self::FORM_FIELD_DECIMAL_SEPARATOR]) ? $_POST[self::FORM_FIELD_DECIMAL_SEPARATOR] : '';
        $thousandsSeparator = isset($_POST[self::FORM_FIELD_THOUSANDS_SEPARATOR]) ? $_POST[self::FORM_FIELD_THOUSANDS_SEPARATOR] : '';
        $thumbnailWidth = isset($_POST[self::FORM_FIELD_THUMBNAIL_WIDTH]) ? $_POST[self::FORM_FIELD_THUMBNAIL_WIDTH] : '';
        $thumbnailHeight = isset($_POST[self::FORM_FIELD_THUMBNAIL_HEIGHT]) ? $_POST[self::FORM_FIELD_THUMBNAIL_HEIGHT] : '';
        
        if ($priceDecimalPlaces < 0) {
            $priceDecimalPlaces = 0;
        }
        if ($quantityDecimalPlaces < 0) {
            $quantityDecimalPlaces = 0;
        }
        if (strlen($decimalSeparator) > 1) {
            $decimalSeparator = $decimalSeparator[0];
        }
        if (strlen($thousandsSeparator) > 1) {
            $thousandsSeparator = $thousandsSeparator[0];
        }
        if ($thumbnailWidth < THUMBNAIL_WIDTH) {
            $thumbnailWidth = THUMBNAIL_WIDTH;
        }
        if ($thumbnailHeight < THUMBNAIL_HEIGHT) {
            $thumbnailHeight = THUMBNAIL_HEIGHT;
        }
        
        $dao->saveConfig(new Quack_Bo_AppConfig_BoAppConfig(CONFIG_CURRENCY, $currency));
        $dao->saveConfig(new Quack_Bo_AppConfig_BoAppConfig(CONFIG_PRICE_DECIMAL_PLACES, $priceDecimalPlaces));
        $dao->saveConfig(new Quack_Bo_AppConfig_BoAppConfig(CONFIG_QUANTITY_DECIMAL_PLACES, $quantityDecimalPlaces));
        $dao->saveConfig(new Quack_Bo_AppConfig_BoAppConfig(CONFIG_DECIMAL_SEPARATOR, $decimalSeparator));
        $dao->saveConfig(new Quack_Bo_AppConfig_BoAppConfig(CONFIG_THOUSANDS_SEPARATOR, $thousandsSeparator));
        $dao->saveConfig(new Quack_Bo_AppConfig_BoAppConfig(CONFIG_THUMBNAIL_WIDTH, $thumbnailWidth));
        $dao->saveConfig(new Quack_Bo_AppConfig_BoAppConfig(CONFIG_THUMBNAIL_HEIGHT, $thumbnailHeight));
        
        return FALSE;
    }
}
