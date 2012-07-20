<!-- MIDDLE COLUMN -->
<!-- Middle column full box -->
    <div class="label title-header" ><img alt="" src="img/cart.png"> [:$MODEL.language->getMessage('msg.cart'):]</div>
<br />

<div class="row-fluid">	
	<div class="span12  well grid-image">
        <table class="table table-striped ">
        	<thead>  
            	<tr>
            		<th width="25px">No.</th>
            		<th >[:$MODEL.language->getMessage('msg.item'):]</th>
            		<th style="text-align: right;" width="100px">[:$MODEL.language->getMessage('msg.price'):]</th>            		
            		<th style="text-align: center;">[:$MODEL.language->getMessage('msg.quantity'):]</th>
            		<th width="100px" style="text-align: right;">[:$MODEL.language->getMessage('msg.total'):]</th>
            	</tr>
            </thead>
            <tbody>
            [:foreach $MODEL.cart->getItems() as $item:]            	
            	[:if $item->getUrlThumbnail()=='':]
                    [:assign var="_urlThumbnail" value="img/img_general.jpg":]
                [:else:]
                    [:assign var="_urlThumbnail" value=$item->getUrlThumbnail():]
                [:/if:]
            	<tr>            		
            		<td>[:$item@index+1:]</td>
            		<td>[:$item->getTitle()|escape:'html':]</td>            		
    				<td style="text-align: right;">[:$item->getPriceForDisplay():]</td>
            		<td style="text-align: center;">[:$item->getQuantity():] </td>
            		<td style="text-align: right;font-size: 16px">[:$item->getTotalForDisplay():]</td>
            	</tr>
            [:foreachelse:]
                <tr>
                    <td colspan="7">[:$MODEL.language->getMessage('msg.nodata'):]</td>
                </tr>
            [:/foreach:]
            </tbody>
            <tfoot>  
            	<tr>   
            		<th colspan="3">
            			<div class="btn-group ">
                          	<button class="btn btn-warning" onclick="redirect('[:$MODEL.cart->getUrlView():]')" >[:$MODEL.language->getMessage('msg.editCart'):]</button>
                        </div>
                    </th>         		
            		<th style="text-align: right;font-size: 16px">[:$MODEL.language->getMessage('msg.grandTotal'):] : </th>
            		<th style="text-align: right;font-size: 16px" >[:$MODEL.cart->getGrandTotalForDisplay():]</th>            		
            	</tr>
            </tfoot>
        </table>
    </div>
</div>
 <div class="label title-header" ><img alt="" src="img/check_out.png" height="30">[:$MODEL.language->getMessage('msg.checkout'):]</div>
 <br/>
<form method="post" action="[:$MODEL.form.action:]" name="[:$MODEL.form.name|escape:'html':]">
    [:printFormHeader form=$MODEL.form:]
    <label class="lable-css">[:$MODEL.language->getMessage('msg.order.name'):]:</label>
    <input type="text" name="orderName" value="[:$MODEL.form.orderName|escape:'html':]" style="width: 98%" />
    <br/>
    <label class="lable-css">[:$MODEL.language->getMessage('msg.order.email'):]:</label>
    <input type="text" name="orderEmail" value="[:$MODEL.form.orderEmail|escape:'html':]" style="width: 98%" />
    <br/>
    <label class="lable-css">[:$MODEL.language->getMessage('msg.order.phone'):]:</label>
    <input type="text" name="orderPhone" value="[:$MODEL.form.orderPhone|escape:'html':]" style="width: 98%" />
    <br/>
    <label style="display: inline;" class="lable-css">[:$MODEL.language->getMessage('msg.order.paymentMethod'):]:</label>
    <input [:if $MODEL.form.orderPaymentMethod==0:]checked="checked"[:/if:] type="radio" name="orderPaymentMethod" value="0" />
        [:$MODEL.language->getMessage('msg.order.paymentMethod.cash'):]
    <input [:if $MODEL.form.orderPaymentMethod==1:]checked="checked"[:/if:] type="radio" name="orderPaymentMethod" value="1" />
        [:$MODEL.language->getMessage('msg.order.paymentMethod.transfer'):]
    <br /><br />
    <label class="lable-css">[:$MODEL.language->getMessage('msg.order.otherInfo'):]:</label>
    <textarea rows="6" style="width: 98%" name="orderOtherInfo">[:$MODEL.form.orderOtherInfo|escape:'html':]</textarea>
    <input type="submit" class="btn btn-warning" value="[:$MODEL.language->getMessage('msg.checkout'):]" />
    <input type="button" class="btn btn-warning" onclick="javascript:location.href='[:$MODEL.form.actionCancel:]';"
        value="[:$MODEL.language->getMessage('msg.cancel'):]"  />
</form>
