   <div class="label nav-bar" style="vertical-align: middle;"  >
    	<a href="javascript:void(0)" onclick="redirect('[:$MODEL.urlHome:]')"><img src="img/home-white.png"  style="padding-bottom: 10px;height: 20px"></a> <span class="divider">></span>
    	[:$MODEL.categoryObj->getTitle()|escape:'html':]
    </div>
    <br/>
    [:if count($MODEL.categoryObj->getChildren()) gt 0:]    	
        [:call name="displayCategoryList" categoryList=$MODEL.categoryObj->getChildren():]
    [:else:]
        [:if count($MODEL.itemList) eq 0:]
            [:$MODEL.language->getMessage('msg.nodata'):]
        [:else:]
            [:call name="displayCategoryItemList" itemList=$MODEL.itemList cart=$MODEL.cart:]
        [:/if:]
    [:/if:]

