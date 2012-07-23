 [:if isset($MODEL.newItems) && count($MODEL.newItems) gt 0:]
	<h1 class="label title-header">[:$MODEL.language->getMessage('msg.newItems'):]</h1>
	<br />
	[:call name="displayCategoryItemList" itemList=$MODEL.newItems
	cart=$MODEL.cart:] 
[:else:] 
	[:if isset($MODEL.categoryList) && count($MODEL.categoryList) gt 0:]
		<div class="label title-header" ><a href="javascript:void(0)" onclick="redirect('[:$MODEL.urlHome:]')"><img src="img/home-white.png"  style="padding-bottom: 10px;height: 20px"></a> <span class="divider">></span>
			[:$MODEL.language->getMessage('msg.categories'):]</div>
		<br />
		[:call name="displayCategoryList" categoryList=$MODEL.categoryList:]
	[:/if:] 
[:/if:]

<script>  
	$(function ()  
		{ $("[name='categories']").popover({placement:'top'});  
		}); 
</script>
