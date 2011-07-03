<!-- MIDDLE COLUMN -->
<div id="middle-column"
    [:if isset($DISABLE_COLUMN_LEFT) && isset($DISABLE_COLUMN_RIGHT):]
        style="width: 98%"
    [:elseif isset($DISABLE_COLUMN_RIGHT)||isset($DISABLE_COLUMN_LEFT):]
        style="width: 77.9%"
    [:/if:]
><!-- Middle column full box -->
    <div class="middle-column-box-green">
        <div class="middle-column-box-title-green">[:$MODEL.language->getMessage('msg.createItem'):]</div>
        <form method="post" action="[:$MODEL.form.action:]" name="[:$MODEL.form.name|escape:'html':]">
            [:printFormHeader form=$MODEL.form:]
            <label>[:$MODEL.language->getMessage('msg.item.category'):]:</label>
            <select name="categoryId">
                <option value="0"></option>
                [:foreach $MODEL.categoryTree as $cat:]
                    <option [:if $MODEL.form.categoryId==$cat->getId():]selected="selected"[:/if:] value="[:$cat->getId():]">[:$cat->getTitle()|escape:'html':]</option>
                    [:foreach $cat->getChildren() as $child:]
                        <option [:if $MODEL.form.categoryId==$child->getId():]selected="selected"[:/if:] value="[:$child->getId():]">&nbsp;&nbsp;+- [:$child->getTitle()|escape:'html':]</option>
                    [:/foreach:]
                [:/foreach:]
            </select>
            <br />
            <label>[:$MODEL.language->getMessage('msg.item.vendor'):]:</label>
            <input type="text" name="itemVendor" value="[:$MODEL.form.itemVendor|escape:'html':]" style="width: 50%" />
            <br/>
            <label>[:$MODEL.language->getMessage('msg.item.price'):]:</label>
            <input type="text" name="itemPrice" value="[:$MODEL.form.itemPrice|escape:'html':]" style="width: 50%" />
            <br/>
            <label>[:$MODEL.language->getMessage('msg.item.title'):]:</label>
            <input type="text" name="itemTitle" value="[:$MODEL.form.itemTitle|escape:'html':]" style="width: 98%" />
            <br/>
            <label>[:$MODEL.language->getMessage('msg.item.description'):]:</label>
            <textarea id="createItemDescription" rows="16" name="itemDescription" style="width: 98%">[:$MODEL.form.itemDescription|escape:'html':]</textarea>
            <br/>
            <input type="submit" value="[:$MODEL.language->getMessage('msg.save'):]" style="width: 64px" />
            <input type="button" onclick="javascript:location.href='[:$MODEL.form.actionCancel:]';"
                value="[:$MODEL.language->getMessage('msg.cancel'):]" style="width: 64px" />
        </form>
        [:tinymce elName='createItemDescription':]
    </div>
</div>