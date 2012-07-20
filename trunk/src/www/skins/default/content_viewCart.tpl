<!-- MIDDLE COLUMN -->

<div class="label title-header" ><img alt="" src="img/cart.png"> [:$MODEL.language->getMessage('msg.cart'):]</div>
<br />

<div class="row-fluid">	
	<div class="span12  well grid-image">
        <table class="table table-striped ">
        	<thead>  
            	<tr>
            		<th width="25px"><input type="checkbox" class="checkbox"> </th>
            		<th width="25px">No.</th>
            		<th >[:$MODEL.language->getMessage('msg.item'):]</th>
            		<th style="width: 10%">image</th>
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
            		<td><input type="checkbox" class="checkbox"> </td>
            		<td>[:$item@index+1:]</td>
            		<td>[:$item->getTitle()|escape:'html':]</td>
            		<td>
            			<div class="span6" >  
                    		<img src="[:$_urlThumbnail:]" alt="">
                    	</div>
    				</td>
    				<td style="text-align: right;">[:$item->getPriceForDisplay():]</td>
            		<td style="text-align: center;"><input type="text" class="input-mini" value="[:$item->getQuantity():]"> </td>
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
            		<th colspan="5">
            			<div class="btn-group ">
                          	<button class="btn btn-warning" >[:$MODEL.language->getMessage('msg.delete'):]</button>
                          	<button class="btn btn-warning" onclick="redirect('[:$MODEL.cart->getUrlCheckout():]')">[:$MODEL.language->getMessage('msg.checkout'):]</button>
                          	<button class="btn btn-warning" onclick="redirect('[:$smarty.server.SCRIPT_NAME:]')">[:$MODEL.language->getMessage('msg.continueShopping'):]</button>
                        </div>
                    </th>
            		<th style="text-align: right;font-size: 16px">[:$MODEL.language->getMessage('msg.grandTotal'):] : </th>
            		<th style="text-align: right;font-size: 16px" >[:$MODEL.cart->getGrandTotalForDisplay():]</th>
            		
            	</tr>
            </tfoot>
        </table>
    </div>
</div>
   
