<div class="[:$_MAIN_CONTENT_CLASS_:]">
    <div class="container-fluid">
        [:if isset($MODEL.newItems) && count($MODEL.newItems) gt 0:]
            <h1>[:$MODEL.language->getMessage('msg.newItems'):]</h1>
            <hr/>
            [:call name="displayCategoryItemList" itemList=$MODEL.newItems cart=$MODEL.cart:]
        [:else:]
            [:if isset($MODEL.categoryList) && count($MODEL.categoryList) gt 0:]
                <h1>[:$MODEL.language->getMessage('msg.categories'):]</h1>
                <hr/>
                [:call name="displayCategoryList" categoryList=$MODEL.categoryList:]
            [:/if:]
        [:/if:]
    </div>
</div>
