<div class="well sidebar-nav grid-image" >
	<form class="form-search" >
      <input type="text" class="input-medium search-query" />
      <button type="submit" class="btn">Search</button>
    </form>   
    <ul class="nav nav-list">
        <li class="nav-header" style="padding: 0"><a style="font-size: 18px" href="[:$MODEL.urlHome:]"><img src="img/home.png"> [:$LANGUAGE->getMessage('msg.home'):]</a></li>
        [:if isset($MODEL.categoryTree):]
            [:foreach $MODEL.categoryTree as $cat:]
                <li class="nav-header"><a title="[:$cat->getTitle()|escape:'html':]" href="[:$cat->getUrlView():]">[:$cat->getTitleForDisplay(25)|escape:'html':]</a></li>
                [:foreach $cat->getChildren() as $child:]
                    <li style="padding-left: 10px"><a title="[:$child->getTitle()|escape:'html':]" href="[:$child->getUrlView():]">[:$child->getTitleForDisplay(30)|escape:'html':]</a></li>
                [:foreachelse:]
                    <li style="padding-left: 10px">[:$MODEL.language->getMessage('msg.nodata'):]</li>
                [:/foreach:]
            [:/foreach:]
        [:/if:]
    </ul>
</div><!--/.well -->
