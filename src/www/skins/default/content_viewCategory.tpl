	<ul class="breadcrumb">
      	<li>
        	<a href="javascript:void(0)" onclick="redirect('[:$MODEL.urlHome:]')">[:$MODEL.language->getMessage('msg.home'):]</a></a> <span class="divider">/</span>
      	</li>      	
      	<li class="active">[:$MODEL.categoryObj->getTitle()|escape:'html':]</li>
    </ul> 
    [:if count($MODEL.categoryObj->getChildren()) gt 0:]
        [:call name="displayCategoryList" categoryList=$MODEL.categoryObj->getChildren():]
    [:else:]
        [:if count($MODEL.itemList) eq 0:]
            [:$MODEL.language->getMessage('msg.nodata'):]
        [:else:]
            [:call name="displayCategoryItemList" itemList=$MODEL.itemList cart=$MODEL.cart:]
        [:/if:]
    [:/if:]

