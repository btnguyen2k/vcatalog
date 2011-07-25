<?php
class Vcatalog_Bo_Catalog_BoItem extends Commons_Bo_BaseBo {

    const COL_ID = 'iid';
    const COL_ACTIVE = 'iactive';
    const COL_CATEGORY_ID = 'icategory_id';
    const COL_TITLE = 'ititle';
    const COL_DESCRIPTION = 'idesc';
    const COL_VENDOR = 'ivendor';
    const COL_TIMESTAMP = 'itimestamp';
    const COL_PRICE = 'iprice';
    const COL_OLD_PRICE = 'iold_price';
    const COL_STOCK = 'istock';
    const COL_IMAGE_ID = 'iimage_id';

    private $id, $active, $categoryId, $title, $description, $vendor;
    private $timestamp;
    private $price, $oldPrice, $stock;
    private $imageId;

    private $category;

    private $urlDelete = NULL;
    private $urlEdit = NULL;
    private $urlView = NULL;
    private $urlThumbnail = NULL;

    /**
     * @see Commons_Bo_BaseBo::getFieldMap()
     */
    protected function getFieldMap() {
        return Array(self::COL_ID => Array('id', self::TYPE_INT),
                self::COL_ACTIVE => Array('active', self::TYPE_BOOLEAN),
                self::COL_CATEGORY_ID => Array('categoryId', self::TYPE_INT),
                self::COL_TITLE => Array('title'),
                self::COL_DESCRIPTION => Array('description'),
                self::COL_VENDOR => Array('vendor'),
                self::COL_TIMESTAMP => Array('timestamp', self::TYPE_INT),
                self::COL_PRICE => Array('price', self::TYPE_DOUBLE),
                self::COL_OLD_PRICE => Array('oldPrice', self::TYPE_DOUBLE),
                self::COL_STOCK => Array('stock', self::TYPE_DOUBLE),
                self::COL_IMAGE_ID => Array('imageId'));
    }

    /**
     * Gets the URL to delete the item.
     *
     * @return string
     */
    public function getUrlDelete() {
        if ($this->urlDelete === NULL) {
            $this->urlDelete = $_SERVER['SCRIPT_NAME'] . '/admin/deleteItem/' . $this->id;
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
            $this->urlEdit = $_SERVER['SCRIPT_NAME'] . '/admin/editItem/' . $this->id;
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
     * Gets the URL to view the category's image as thumbnail.
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

    public function getImageId() {
        return $this->imageId;
    }

    public function setImageId($imageId) {
        $this->imageId = $imageId;
    }
}