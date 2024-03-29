<?php
class Vcatalog_Bo_Catalog_BoItem extends Quack_Bo_BaseBo {

    const COL_ID = 'item_id';
    const COL_ACTIVE = 'item_active';
    const COL_CATEGORY_ID = 'item_category_id';
    const COL_TITLE = 'item_title';
    const COL_DESCRIPTION = 'item_description';
    const COL_VENDOR = 'item_vendor';
    const COL_CODE = 'item_code';
    const COL_TIMESTAMP = 'item_timestamp';
    const COL_PRICE = 'item_price';
    const COL_OLD_PRICE = 'item_old_price';
    const COL_STOCK = 'item_stock';
    const COL_IMAGE_ID = 'item_image_id';
    const COL_HOT_ITEM = 'item_hot_item';
    const COL_NEW_ITEM = 'item_new_item';

    private $id, $active, $categoryId, $title, $description, $vendor, $code;
    private $timestamp;
    private $price, $oldPrice, $stock;
    private $imageId;
    private $hotItem, $newItem;

    private $category;

    private $urlDelete = NULL;
    private $urlEdit = NULL;
    private $urlView = NULL;
    private $urlThumbnail = NULL;
    private $urlImage = NULL;

    /**
     *
     * @see Quack_Bo_BaseBo::getFieldMap()
     */
    protected function getFieldMap() {
        return Array(self::COL_ID => Array('id', self::TYPE_INT),
                self::COL_ACTIVE => Array('active', self::TYPE_BOOLEAN),
                self::COL_CATEGORY_ID => Array('categoryId', self::TYPE_INT),
                self::COL_TITLE => Array('title'),
                self::COL_DESCRIPTION => Array('description'),
                self::COL_VENDOR => Array('vendor'),
                self::COL_CODE => Array('code'),
                self::COL_TIMESTAMP => Array('timestamp', self::TYPE_INT),
                self::COL_PRICE => Array('price', self::TYPE_DOUBLE),
                self::COL_OLD_PRICE => Array('oldPrice', self::TYPE_DOUBLE),
                self::COL_STOCK => Array('stock', self::TYPE_DOUBLE),
                self::COL_IMAGE_ID => Array('imageId'),
                self::COL_HOT_ITEM => Array('hotItem', self::TYPE_BOOLEAN),
                self::COL_NEW_ITEM => Array('newItem', self::TYPE_BOOLEAN));
    }

    /**
     * Gets the URL to delete the item.
     *
     * @return string
     */
    public function getUrlDelete() {
        if ($this->urlDelete === NULL) {
            $this->urlDelete = $_SERVER['SCRIPT_NAME'] . '/deleteItem/' . $this->id;
        }
        return $this->urlDelete;
    }

    /**
     * Gets the URL to edit the item.
     *
     * @return string
     */
    public function getUrlEdit() {
        if ($this->urlEdit === NULL) {
            $this->urlEdit = $_SERVER['SCRIPT_NAME'] . '/editItem/' . $this->id;
        }
        return $this->urlEdit;
    }

    /**
     * Gets the URL to view the item.
     *
     * @return string
     */
    public function getUrlView() {
        if ($this->urlView === NULL) {
            $this->urlView = $_SERVER['SCRIPT_NAME'] . '/item/' . $this->id;
        }
        return $this->urlView;
    }

    /**
     * Gets the URL to view the item's image as thumbnail.
     *
     * @return string
     */
    public function getUrlThumbnail() {
        if ($this->urlThumbnail === NULL) {
            $this->urlThumbnail = Paperclip_Utils::createUrlThumbnail($this->imageId);
            if ($this->urlThumbnail === NULL) {
                $this->urlThumbnail = '';
            }
        }
        return $this->urlThumbnail;
    }

    /**
     * Gets the URL to view the item's image.
     *
     * @return string
     */
    public function getUrlImage() {
        if ($this->urlImage === NULL) {
            $this->urlImage = Paperclip_Utils::createUrlView($this->imageId);
            if ($this->urlImage === NULL) {
                $this->urlImage = '';
            }
        }
        return $this->urlImage;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getActive() {
        return $this->active;
    }

    public function isActive() {
        return $this->active;
    }

    public function setActive($active) {
        $this->active = $active;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    public function getCategoryId() {
        return $this->categoryId;
    }

    public function setCategoryId($categoryId) {
        $this->categoryId = $categoryId;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getCode() {
        return $this->code;
    }

    public function setCode($code) {
        $this->code = $code;
    }

    public function getVendor() {
        return $this->vendor;
    }

    public function setVendor($vendor) {
        $this->vendor = $vendor;
    }

    public function getTimestamp() {
        return $this->timestamp;
    }

    public function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }

    /**
     * Gets price value for displaying purpose.
     *
     * @return double
     */
    public function getPriceForDisplay() {
        return Vcatalog_Utils::formatPrice($this->price);
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getOldPrice() {
        return $this->oldPrice;
    }

    public function setOldPrice($oldPrice) {
        $this->oldPrice = $oldPrice;
    }

    public function getStock() {
        return $this->stock;
    }

    public function setStock($stock) {
        $this->stock = $stock;
    }

    public function getImageWidth() {
        return Paperclip_Utils::getImageWidth($this->imageId);
    }

    public function getImageHeight() {
        return Paperclip_Utils::getImageHeight($this->imageId);
    }

    public function getImageId() {
        return $this->imageId;
    }

    public function setImageId($imageId) {
        $this->imageId = $imageId;
    }

    public function getHotItem() {
        return $this->hotItem;
    }

    public function isHotItem() {
        return $this->hotItem;
    }

    public function setHotItem($hotItem) {
        $this->hotItem = $hotItem;
    }

    public function getNewItem() {
        return $this->newItem;
    }

    public function isNewItem() {
        return $this->newItem;
    }

    public function setNewItem($newItem) {
        $this->newItem = $newItem;
    }
}