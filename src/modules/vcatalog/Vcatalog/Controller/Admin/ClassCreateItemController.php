<?php
class Vcatalog_Controller_Admin_CreateItemController extends Vcatalog_Controller_Admin_BaseFlowController {
    const VIEW_NAME = 'inline_create_item';
    const VIEW_NAME_AFTER_POST = 'info';

    const FORM_FIELD_CATEGORY_ID = 'categoryId';
    const FORM_FIELD_TITLE = 'itemTitle';
    const FORM_FIELD_DESCRIPTION = 'itemDescription';
    const FORM_FIELD_VENDOR = 'itemVendor';
    const FORM_FIELD_CODE = 'itemCode';
    const FORM_FIELD_PRICE = 'itemPrice';
    const FORM_FIELD_IMAGE = 'itemImage';
    const FORM_FIELD_HOT = 'itemHot';
    const FORM_FIELD_NEW = 'itemNew';
    const FORM_FIELD_IMAGE_ID = 'itemImageId';
    const FORM_FIELD_URL_IMAGE = 'urlItemImage';
    const FORM_FIELD_REMOVE_IMAGE = 'removeImage';

    private $sessionKey;

    public function __construct() {
        parent::__construct();
        $this->sessionKey = __CLASS__ . '_fileId';
    }

    /**
     *
     * @see Vcatalog_Controller_BaseFlowController::getViewName()
     */
    protected function getViewName() {
        return self::VIEW_NAME;
    }

    /**
     *
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
     *
     * @see Vcatalog_Controller_Admin_BaseFlowController::buildModel_Custom()
     */
    protected function buildModel_Custom() {
        $model = parent::buildModel_Custom();
        if ($model == NULL) {
            $model = Array();
        }
        /**
         *
         * @var Vcatalog_Bo_Catalog_ICatalogDao
         */
        $catalogDao = $this->getDao(DAO_CATALOG);
        $catTree = $catalogDao->getCategoryTree();
        $model[MODEL_CATEGORY_TREE] = $catTree;
        return $model;
    }

    /**
     *
     * @see Vcatalog_Controller_BaseFlowController::buildModel_Form()
     */
    protected function buildModel_Form() {
        $form = Array('action' => $_SERVER['REQUEST_URI'],
                'actionCancel' => $this->getUrlItemManagement(),
                'name' => 'frmCreateItem');
        $form[self::FORM_FIELD_IMAGE_ID] = md5(rand());
        $this->populateForm($form, Array(self::FORM_FIELD_CATEGORY_ID,
                self::FORM_FIELD_DESCRIPTION,
                self::FORM_FIELD_PRICE,
                self::FORM_FIELD_TITLE,
                self::FORM_FIELD_VENDOR,
                self::FORM_FIELD_CODE,
                self::FORM_FIELD_IMAGE_ID,
                self::FORM_FIELD_HOT,
                self::FORM_FIELD_NEW));
        $paperclipId = isset($_SESSION[$this->sessionKey]) ? $_SESSION[$this->sessionKey] : NULL;
        if ($paperclipId !== NULL) {
            $form[self::FORM_FIELD_URL_IMAGE] = Paperclip_Utils::createUrlThumbnail($paperclipId);
        }
        if ($this->hasError()) {
            $form['errorMessages'] = $this->getErrorMessages();
        }
        return $form;
    }

    /**
     *
     * @see Dzit_Controller_FlowController::performFormSubmission()
     */
    protected function performFormSubmission() {
        /**
         *
         * @var Ddth_Mls_ILanguage
         */
        $lang = $this->getLanguage();

        /**
         *
         * @var Vcatalog_Bo_Catalog_ICatalogDao
         */
        $catalogDao = $this->getDao(DAO_CATALOG);

        $categoryId = isset($_POST[self::FORM_FIELD_CATEGORY_ID]) ? (int)$_POST[self::FORM_FIELD_CATEGORY_ID] : 0;
        $title = isset($_POST[self::FORM_FIELD_TITLE]) ? trim($_POST[self::FORM_FIELD_TITLE]) : '';
        $description = isset($_POST[self::FORM_FIELD_DESCRIPTION]) ? trim($_POST[self::FORM_FIELD_DESCRIPTION]) : '';
        $vendor = isset($_POST[self::FORM_FIELD_VENDOR]) ? trim($_POST[self::FORM_FIELD_VENDOR]) : '';
        $code = isset($_POST[self::FORM_FIELD_CODE]) ? trim($_POST[self::FORM_FIELD_CODE]) : '';
        $price = isset($_POST[self::FORM_FIELD_PRICE]) ? (double)$_POST[self::FORM_FIELD_PRICE] : 0.0;
        $hotItem = isset($_POST[self::FORM_FIELD_HOT]) ? (boolean)$_POST[self::FORM_FIELD_HOT] : FALSE;
        $newItem = isset($_POST[self::FORM_FIELD_NEW]) ? (boolean)$_POST[self::FORM_FIELD_NEW] : FALSE;

        if ($categoryId < 1) {
            $categoryId = 0;
        } else {
            $cat = $catalogDao->getCategoryById($categoryId);
            if ($cat === NULL) {
                $this->addErrorMessage($lang->getMessage('error.categoryNotFound', $categoryId));
            }
        }

        if ($title == '') {
            $this->addErrorMessage($lang->getMessage('error.emptyItemTitle'));
        }

        // take care of the uploaded file
        $removeImage = isset($_POST[self::FORM_FIELD_REMOVE_IMAGE]) ? TRUE : FALSE;
        $paperclipId = isset($_SESSION[$this->sessionKey]) ? $_SESSION[$this->sessionKey] : NULL;
        $paperclipItem = $this->processUploadFile(self::FORM_FIELD_IMAGE, MAX_UPLOAD_FILESIZE, ALLOWED_UPLOAD_FILE_TYPES, $paperclipId);
        if ($paperclipItem !== NULL) {
            $_SESSION[$this->sessionKey] = $paperclipItem->getId();
        } else {
            $paperclipItem = $paperclipId !== NULL ? $this->getDao(DAO_PAPERCLIP)->getAttachment($paperclipId) : NULL;
            if ($removeImage && $paperclipItem !== NULL) {
                $paperclipDao = $this->getDao(DAO_PAPERCLIP);
                $paperclipDao->deleteAttachment($paperclipItem);
                unset($_SESSION[$this->sessionKey]);
            }
        }

        if ($this->hasError()) {
            return FALSE;
        }

        $timestamp = time();
        $oldPrice = 0.0;
        $stock = 0.0;

        $data = Array(Vcatalog_Bo_Catalog_BoItem::COL_ACTIVE => 1,
                Vcatalog_Bo_Catalog_BoItem::COL_CATEGORY_ID => $categoryId,
                Vcatalog_Bo_Catalog_BoItem::COL_CODE => $code,
                Vcatalog_Bo_Catalog_BoItem::COL_DESCRIPTION => $description,
                Vcatalog_Bo_Catalog_BoItem::COL_HOT_ITEM => $hotItem,
                Vcatalog_Bo_Catalog_BoItem::COL_IMAGE_ID => $paperclipItem !== NULL ? $paperclipItem->getId() : NULL,
                Vcatalog_Bo_Catalog_BoItem::COL_NEW_ITEM => $newItem,
                Vcatalog_Bo_Catalog_BoItem::COL_OLD_PRICE => $oldPrice,
                Vcatalog_Bo_Catalog_BoItem::COL_PRICE => $price,
                Vcatalog_Bo_Catalog_BoItem::COL_STOCK => $stock,
                Vcatalog_Bo_Catalog_BoItem::COL_TIMESTAMP => $timestamp,
                Vcatalog_Bo_Catalog_BoItem::COL_TITLE => $title,
                Vcatalog_Bo_Catalog_BoItem::COL_VENDOR => $vendor);
        $item = new Vcatalog_Bo_Catalog_BoItem();
        $item->populate($data);
        //$catalogDao->createItem($categoryId, $title, $description, $vendor, $timestamp, $price, $oldPrice, $stock, $paperclipItem !== NULL ? $paperclipItem->getId() : NULL, $hotItem, $newItem);
        $catalogDao->createItem($item);

        // clean-up
        unset($_SESSION[$this->sessionKey]);
        if ($paperclipItem !== NULL) {
            $paperclipItem->setIsDraft(FALSE);
            $paperclipDao = $this->getDao(DAO_PAPERCLIP);
            $paperclipDao->updateAttachment($paperclipItem);
        }

        return TRUE;
    }
}
