<?php
interface Vcatalog_Bo_Catalog_ICatalogDao extends Ddth_Dao_IDao {

    /**
     * Counts number of current categories.
     *
     * @return int
     */
    public function countNumCategories();

    /**
     * Creates a new category.
     *
     * @param Vcatalog_Bo_Catalog_BoCategory $category
     */
    public function createCategory($category);

    /**
     * Deletes a category.
     *
     * @param Vcatalog_Bo_Catalog_BoCategory $category
     */
    public function deleteCategory($category);

    /**
     * Gets a category by id.
     *
     * @param int $id
     * @return Vcatalog_Bo_Catalog_BoCategory
     */
    public function getCategoryById($id);

    /**
     * Gets all children of a category.
     *
     * @param Vcatalog_Bo_Catalog_BoCategory $category
     * @return Array() index array of Vcatalog_Bo_Catalog_BoCategory
     */
    public function getCategoryChildren($category);

    /**
     * Gets all categories as a tree.
     *
     * @return Array
     */
    public function getCategoryTree();

    /**
     * Updates a category.
     *
     * @param Vcatalog_Bo_Catalog_BoCategory $category
     */
    public function updateCategory($category);

    /**
     * Counts number of current items.
     *
     * @param mixed $featuredItemsOnly
     * @return int
     */
    public function countNumItems($featuredItems = FEATURED_ITEM_NONE);

    /**
     * Counts number of current items within a category.
     *
     * @param Vcatalog_Bo_Catalog_BoCategory $cat
     * @param mixed $featuredItemsOnly
     * @return int
     */
    public function countNumItemsForCategory($cat, $featuredItems = FEATURED_ITEM_NONE);

    /**
     * Creates a new item.
     *
     * @param Vcatalog_Bo_Catalog_BoItem $item
     */
    public function createItem($item);

    /**
     * Deletes an existing items.
     *
     * @param Vcatalog_Bo_Catalog_BoItem $item
     */
    public function deleteItem($item);

    /**
     * Gets all available items as a list.
     *
     * @param int $pageNum
     * @param int $pageSize
     * @param mixed $featuredItemsOnly
     * @return Array
     */
    public function getAllItems($pageNum = 1, $pageSize = DEFAULT_PAGE_SIZE, $itemSorting = DEFAULT_ITEM_SORTING, $featuredItems = FEATURED_ITEM_NONE);

    /**
     * Gets an item by id.
     *
     * @param int $id
     * @return Vcatalog_Bo_Catalog_BoItem
     */
    public function getItemById($id);

    /**
     * Gets all items within a category as a list.
     *
     * @param Vcatalog_Bo_Catalog_BoCategory $cat
     * @param int $pageNum
     * @param int $pageSize
     * @param string $itemSorting
     * @param mixed $featuredItemsOnly
     * @param Vcatalog_Bo_Catalog_BoCategory $cat
     */
    public function getItemsForCategory($cat, $pageNum = 1, $pageSize = DEFAULT_PAGE_SIZE, $itemSorting = DEFAULT_ITEM_SORTING, $featuredItems = FEATURED_ITEM_NONE);

    /**
     * Searches for items.
     *
     * @param string $searchQuery
     * @param int $searchType
     *            0 = search in title, 1 = search in description/content, 2 =
     *            search in both
     * @param Vcatalog_Bo_Catalog_BoCategory $cat
     * @param int $pageNum
     * @param int $pageSize
     * @return Array
     */
    public function searchItems($searchQuery, $searchType = 2, $cat = NULL, $pageNum = 1, $pageSize = 10);

    /**
     * Counts items that match a search query.
     *
     * @param string $searchQuery
     * @param int $searchType
     *            0 = search in title, 1 = search in description/content, 2 =
     *            search in both
     * @param Vcatalog_Bo_Catalog_BoCategory $cat
     */
    public function countSearchItems($searchQuery, $searchType, $cat = NULL);

    /**
     * Updates an existing item.
     *
     * @param Vcatalog_Bo_Catalog_BoItem $item
     */
    public function updateItem($item);
}
