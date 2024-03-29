<?php
abstract class Vcatalog_Bo_Cart_BaseCartDao extends Quack_Bo_BaseDao implements
        Vcatalog_Bo_Cart_ICartDao {

    /**
     *
     * @var Ddth_Commons_Logging_ILog
     */
    private $LOGGER;

    public function __construct() {
        $this->LOGGER = Ddth_Commons_Logging_LogFactory::getLog(__CLASS__);
        parent::__construct();
    }

    /**
     * (non-PHPdoc)
     *
     * @see Quack_Bo_BaseDao::getCacheName()
     */
    public function getCacheName() {
        return 'ICartDao';
    }

    protected function createCacheKeyCart($sessionId) {
        return 'CART_' . $sessionId;
    }

    /**
     * Invalidates the cache due to change.
     *
     * @param string $sessionId
     */
    protected function invalidateCache($sessionId = NULL) {
        if ($sessionId !== NULL) {
            $cacheKey = $this->createCacheKeyCart($sessionId);
            $this->deleteFromCache($cacheKey);
        }
    }

    /**
     *
     * @see Vcatalog_Bo_Cart_ICartDao::createCart()
     */
    public function createCart($sessionId, $userId = 0) {
        $sqlStm = $this->getStatement('sql.' . __FUNCTION__);
        $params = Array(Vcatalog_Bo_Cart_BoCart::COL_SESSION_ID => $sessionId,
                Vcatalog_Bo_Cart_BoCart::COL_USER_ID => (int)$userId);
        $this->execNonSelect($sqlStm, $params);
        $cacheKey = $this->createCacheKeyCart($sessionId);
        $this->invalidateCache($sessionId);
        $result = $this->getCart($sessionId);
        return $result;
    }

    /**
     * (non-PHPdoc)
     *
     * @see Vcatalog_Bo_Cart_ICartDao::cleanup()
     */
    public function cleanup() {
        $sqlStm = $this->getStatement('sql.' . __FUNCTION__);
        $result = $this->execNonSelect($sqlStm);
        $this->invalidateCache();
        return $result;
    }

    /**
     *
     * @see Vcatalog_Bo_Cart_ICartDao::getCart()
     */
    public function getCart($sessionId) {
        $cacheKey = $this->createCacheKeyCart($sessionId);
        $result = $this->getFromCache($cacheKey);
        if ($result === NULL) {
            $sqlStm = $this->getStatement('sql.' . __FUNCTION__);
            $params = Array(Vcatalog_Bo_Cart_BoCart::COL_SESSION_ID => $sessionId);
            $rows = $this->execSelect($sqlStm, $params);
            if ($rows !== NULL && count($rows) > 0) {
                $result = new Vcatalog_Bo_Cart_BoCart();
                $result->populate($rows[0]);
            } else {
                $result = NULL;
            }
            if ($result !== NULL) {
                $items = $this->getItemsInCart($result);
                foreach ($items as $item) {
                    $result->addItem($item);
                }
            }
        }
        return $this->returnCachedResult($result, $cacheKey);
    }

    /**
     *
     * @see Vcatalog_Bo_Cart_ICartDao::getItemsInCart()
     */
    public function getItemsInCart($cart) {
        $sqlStm = $this->getStatement('sql.' . __FUNCTION__);
        $result = Array();
        $params = Array(Vcatalog_Bo_Cart_BoCart::COL_SESSION_ID => $cart->getSessionId());
        $rows = $this->execSelect($sqlStm, $params);
        if ($rows !== NULL && count($rows) > 0) {
            foreach ($rows as $row) {
                $cartItem = new Vcatalog_Bo_Cart_BoCartItem();
                $cartItem->populate($row);
                $result[] = $cartItem;
            }
        }
        return $result;
    }

    /**
     *
     * @see Vcatalog_Bo_Cart_ICartDao::createCartItem()
     */
    public function createCartItem($cart, $itemId, $quantity, $price) {
        $sqlStm = $this->getStatement('sql.' . __FUNCTION__);
        $params = Array(Vcatalog_Bo_Cart_BoCartItem::COL_SESSION_ID => $cart->getSessionId(),
                Vcatalog_Bo_Cart_BoCartItem::COL_ITEM_ID => $itemId,
                Vcatalog_Bo_Cart_BoCartItem::COL_QUANTITY => $quantity,
                Vcatalog_Bo_Cart_BoCartItem::COL_PRICE => $price);
        $result = $this->execNonSelect($sqlStm, $params);
        $this->invalidateCache($cart->getSessionId());
        return $result;
    }

    /**
     *
     * @see Vcatalog_Bo_Cart_ICartDao::deleteCartItem()
     */
    public function deleteCartItem($cartItem) {
        $sqlStm = $this->getStatement('sql.' . __FUNCTION__);
        $params = Array(Vcatalog_Bo_Cart_BoCartItem::COL_SESSION_ID => $cartItem->getSessionId(),
                Vcatalog_Bo_Cart_BoCartItem::COL_ITEM_ID => $cartItem->getItemId());
        $result = $this->execNonSelect($sqlStm, $params);
        $this->invalidateCache($cartItem->getSessionId());
        return $result;
    }

    /**
     *
     * @see Vcatalog_Bo_Cart_ICartDao::updateCartItem()
     */
    public function updateCartItem($cartItem) {
        $sqlStm = $this->getStatement('sql.' . __FUNCTION__);
        $params = Array(Vcatalog_Bo_Cart_BoCartItem::COL_SESSION_ID => $cartItem->getSessionId(),
                Vcatalog_Bo_Cart_BoCartItem::COL_ITEM_ID => $cartItem->getItemId(),
                Vcatalog_Bo_Cart_BoCartItem::COL_QUANTITY => $cartItem->getQuantity(),
                Vcatalog_Bo_Cart_BoCartItem::COL_PRICE => $cartItem->getPrice());
        $result = $this->execNonSelect($sqlStm, $params);
        $this->invalidateCache($cartItem->getSessionId());
        return $result;
    }
}
