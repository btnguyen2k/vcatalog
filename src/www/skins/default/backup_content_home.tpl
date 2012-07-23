 [:if isset($MODEL.newItems) && count($MODEL.newItems) gt 0:]
	<h1 class="label label-warning title-header">[:$MODEL.language->getMessage('msg.newItems'):]</h1>
	<br />
	[:call name="displayCategoryItemList" itemList=$MODEL.newItems
	cart=$MODEL.cart:] 
[:else:] 
	[:if isset($MODEL.categoryList) && count($MODEL.categoryList) gt 0:]
		<div class="label title-header" >[:$MODEL.language->getMessage('msg.categories'):]</div>
		<br />
		[:call name="displayCategoryList" categoryList=$MODEL.categoryList:]
	[:/if:] 
[:/if:]

<script>  
	$(function ()  
		{ $("[name='categories']").popover({placement:'top'});  
		}); 
</script>
