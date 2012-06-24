<div class="[:$_MAIN_CONTENT_CLASS_:]">
    <h1><a href="[:$MODEL.urlHome:]">[:$MODEL.language->getMessage('msg.home'):]</a> | [:$MODEL.categoryObj->getTitle()|escape:'html':]</h1>
    <hr />
    [:if count($MODEL.categoryObj->getChildren()) gt 0:]
        [:call name="displayCategoryList" categoryList=$MODEL.categoryObj->getChildren():]
    [:else:]
        [:if count($MODEL.itemList) eq 0:]
            [:$MODEL.language->getMessage('msg.nodata'):]
        [:else:]
            [:call name="displayCategoryItemList" itemList=$MODEL.itemList cart=$MODEL.cart:]
        [:/if:]
    [:/if:]
</div>
