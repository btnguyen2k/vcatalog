<div class="well sidebar-nav" style="margin-right: 25px" >
    <ul class="nav nav-list">
        <li class="nav-header"><a href="[:$MODEL.urlHome:]">[:$LANGUAGE->getMessage('msg.home'):]</a></li>
        [:if isset($MODEL.categoryTree):]
            [:foreach $MODEL.categoryTree as $cat:]
                <li class="nav-header"><a title="[:$cat->getTitle()|escape:'html':]" href="[:$cat->getUrlView():]">[:$cat->getTitleForDisplay(25)|escape:'html':]</a></li>
                [:foreach $cat->getChildren() as $child:]
                    <li><a title="[:$child->getTitle()|escape:'html':]" href="[:$child->getUrlView():]">[:$child->getTitleForDisplay(30)|escape:'html':]</a></li>
                [:foreachelse:]
                    <li>[:$MODEL.language->getMessage('msg.nodata'):]</li>
                [:/foreach:]
            [:/foreach:]
        [:/if:]
    </ul>
</div><!--/.well -->
