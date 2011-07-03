<?php
class Vcatalog_Controller_Admin_CreateItemController extends Vcatalog_Controller_Admin_BaseFlowController {
    const VIEW_NAME = 'admin_createItem';
    const VIEW_NAME_AFTER_POST = 'info';

    const FORM_FIELD_CATEGORY_ID = 'categoryId';
    const FORM_FIELD_TITLE = 'itemTitle';
    const FORM_FIELD_DESCRIPTION = 'itemDescription';
    const FORM_FIELD_VENDOR = 'itemVendor';
    const FORM_FIELD_PRICE = 'itemPrice';

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

        $lang = $this->getLanguage();
        $model[MODEL_INFO_MESSAGES] = Array($lang->getMessage('msg.createItem.done'));
        $urlTransit = $this->getUrlItemManagement();
        $model[MODEL_URL_TRANSIT] = $urlTransit;
        $model[MODEL_TRANSIT_MESSAGE] = $lang->getMessage('msg.transit', $urlTransit);

        return new Dzit_ModelAndView($viewName, $model);
    }

    /**
     * @see Vcatalog_Controller_Admin_BaseFlowController::buildModel_Custom()
     */
    protected function buildModel_Custom() {
        $model = parent::buildModel_Custom();
        if ($model == NULL) {
            $model = Array();
        }
        /**
         * @var Vcatalog_Bo_Catalog_ICatalogDao
         */
        $catalogDao = $this->getDao(DAO_CATALOG);
        $catTree = $catalogDao->getCategoryTree();
        $model[MODEL_CATEGORY_TREE] = $catTree;
        return $model;
    }

    /**
     * @see Vcatalog_Controller_BaseFlowController::buildModel_Form()
     */
    protected function buildModel_Form() {
        $form = Array('action' => $_SERVER['REQUEST_URI'],
                'actionCancel' => $this->getUrlItemManagement(),
                'name' => 'frmCreateItem');
        $this->populateForm($form, Array(self::FORM_FIELD_CATEGORY_ID,
                self::FORM_FIELD_DESCRIPTION,
                self::FORM_FIELD_PRICE,
                self::FORM_FIELD_TITLE,
                self::FORM_FIELD_VENDOR));
        if ($this->hasError()) {
            $form['errorMessages'] = $this->getErrorMessages();
        }
        return $form;
    }

    /**
     * @see Dzit_Controller_FlowController::performFormSubmission()
     */
    protected function performFormSubmission() {
        /**
         * @var Ddth_Mls_ILanguage
         */
        $lang = $this->getLanguage();

        /**
         * @var Vcatalog_Bo_Catalog_ICatalogDao
         */
        $catalogDao = $this->getDao(DAO_CATALOG);

        $categoryId = isset($_POST[self::FORM_FIELD_CATEGORY_ID]) ? (int)$_POST[self::FORM_FIELD_CATEGORY_ID] : 0;
        $title = isset($_POST[self::FORM_FIELD_TITLE]) ? trim($_POST[self::FORM_FIELD_TITLE]) : '';
        $description = isset($_POST[self::FORM_FIELD_DESCRIPTION]) ? trim($_POST[self::FORM_FIELD_DESCRIPTION]) : '';
        $vendor = isset($_POST[self::FORM_FIELD_VENDOR]) ? trim($_POST[self::FORM_FIELD_VENDOR]) : '';
        $price = isset($_POST[self::FORM_FIELD_PRICE]) ? (double)$_POST[self::FORM_FIELD_PRICE] : 0.0;

        if ($categoryId < 1) {
            $categoryId = NULL;
        } else {
            $cat = $catalogDao->getCategoryById($categoryId);
            if ($cat == NULL) {
                $this->addErrorMessage($lang->getMessage('error.categoryNotFound', $categoryId));
            }
        }

        if ($title == '') {
            $this->addErrorMessage($lang->getMessage('error.emptyItemTitle'));
        }

        if ($this->hasError()) {
            return FALSE;
        }

        $timestamp = time();
        $oldPrice = 0.0;
        $stock = 0.0;

        $catalogDao->createItem($categoryId, $title, $description, $vendor, $timestamp, $price, $oldPrice, $stock);

        return TRUE;
    }
}
