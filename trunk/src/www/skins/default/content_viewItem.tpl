<!-- Middle column full box -->
    [:assign var="_cart" value=$MODEL.cart nocache:]
    [:assign var="_item" value=$MODEL.itemObj:]   
    [:assign var="_category" value=$_item->getCategory():]	
    <script type="text/javascript">
    //<![CDATA[
    function openImage(url) {
        window.open(url, '_blank', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,directories=no,location=no');
        return false;
    }
    //]]>
    </script>
 
 <div class="label nav-bar" style="vertical-align: middle;"  >
    	<a href="javascript:void(0)" onclick="redirect('[:$MODEL.urlHome:]')"><img src="img/home-white.png"  style="padding-bottom: 10px;height: 20px"></a> <span class="divider">&gt; </span>
    	
    	<a href="javascript:void(0)" style="color:white" onclick="redirect('[:$_category->getUrlView():]')">[:$_category->getTitle():]</a> <span class="divider">&gt; </span>
    	[:$_item->getTitle()|escape:'html':]
</div>
<br/>
 		[:if $_item->getUrlThumbnail()=='':]
            [:assign var="_urlThumbnail" value="img/img_general.jpg":]
        [:else:]
            [:assign var="_urlThumbnail" value=$_item->getUrlThumbnail():]
        [:/if:]
        [:if $_item->getUrlImage()=='':]
            [:assign var="_urlImage" value="img/img_general.jpg":]
        [:else:]
            [:assign var="_urlImage" value=$_item->getUrlImage():]
        [:/if:]
	<div class="row-fluid">
    	<div class="span9">    	
			<div class="container-fluid well grid-image" >
              	<div class="row-fluid">
                	<div class="span5" style="position: relative;" >  
                		<div class="label label-info" style="position: absolute; top: 5px;right: 5px;">[:if $_item->getCode()!='':][:$_item->getCode()|escape:'html':][:/if:]</div>
                		<a href="javascript:void(0)" class="thumbnail" > <img src="[:$_urlThumbnail:]" alt=""> </a>  
                	</div>
                	<div class="span7" ><span class="category-header" style="color:#08C"> [:$_item->getTitle()|escape:'html':] </span>
                		<br/>
                		<br/>
                		<form method="post" action="[:$smarty.server.SCRIPT_NAME:]/addToCart">
                			<small> 
                	 			<button class="btn btn-warning" type="button" onclick="this.form.submit(); return 0;"><img alt="" src="img/cart_add.png"> Add to cart</button>                	 		                              
                                <input type="hidden" name="item" value="[:$_item->getId():]" />
                                <br/>
                          		<a href="[:$_cart->getUrlView():]">[:$MODEL.language->getMessage('msg.inCart'):]: <strong>
                        			[:if $_cart->existInCart($_item):][:$_cart->getItem($_item)->getQuantity():][:else:]0[:/if:]</strong></a>
                    				|[:$MODEL.language->getMessage('msg.addToCart'):]:  
                                <input type="text" name="quantity" value="1" style="width: 20px"/>                                
                            </small>
                	 	</form>             		
                		<span class="category-header" style="color:#08C">[:$MODEL.language->getMessage('msg.item.price'):]:</span> <span class="lable-css" style="font-size: 16px">[:$_item->getPriceForDisplay():]</span>
                		<br/>
                		<span class="category-header" style="color:#08C">[:$MODEL.language->getMessage('msg.item.vendor'):]:</span> [:$_item->getVendor()|escape:'html':]
                		                      
                	</div>
               </div>
            </div>       
            <!-- Tabs product information -->
           	<div class="container-fluid well grid-image">
            	<div class="row-fluid">
                    <div class="span12" >  
                        <ul class="nav nav-tabs" id="product-infomation">                          	
                          	<li class="active"><a data-toggle="tab"  href="#information" >Information</a></li>
                          	<li><a data-toggle="tab" href="#comment"  >Comment</a></li>
                          	<li><a data-toggle="tab" href="#image">Images</a></li>
                        </ul> 
                        <div class="tab-content">                          	
                          	<div class="tab-pane active" id="information">
							[:$_item->getDescription():]
							</div>
                          	<div class="tab-pane" id="comment"> 
                          		<!-- Comment -->                          			                            		  
                            		<div class="scrollspy-comment well">
                                    	<table align="left" width="100%" cellpadding="0" cellspacing="0" border="0" style="width:96%">
                                      		<tbody>
                                          		<tr>
                                            		<td width="60" align="center" valign="top"><img src="http://static-hcm.24hstatic.com:8008/images/avatar3.jpg" width="40" height="40" alt="thumbnail"></td>
                                            		<td valign="middle" align="left">
                                            			<div class="bl-title">
                                            			<span class="comment_title">Tên người bình luận:</span> <span style="font-size:11px;color:#666;">Tiêu đề bình luận</span>    </div>                                                                 
                                            			<div class="clear"></div>
                                                        <div class="comment_desc">Nội dung bình luận sản phẩm. Nội dung bình luận sản phẩm. Nội dung bình luận sản phẩm. Nội dung bình luận sản phẩm. Nội dung bình luận sản phẩm. Nội dung bình luận sản phẩm. Nội dung bình luận sản phẩm. Nội dung bình luận sản phẩm. Nội dung bình luận sản phẩm. Nội dung bình luận sản phẩm.  </div>
                                                                  
                                                    </td>
                                            	</tr>
                                            	<tr>
                                            		<td colspan="2" height="10"></td>
                                            	</tr>
                                            	<tr>
                                            		<td width="60" align="center" valign="top"><img src="http://static-hcm.24hstatic.com:8008/images/avatar3.jpg" width="40" height="40" alt="thumbnail"></td>
                                            		<td valign="middle" align="left">
                                            			<div class="bl-title">
                                            			<span class="comment_title">Tên người bình luận:</span> <span style="font-size:11px;color:#666;">Tiêu đề bình luận</span>    </div>                                                                 
                                            			<div class="clear"></div>
                                                        <div class="comment_desc">Nội dung bình luận sản phẩm </div>
                                                                  
                                                    </td>
                                            	</tr>
                                            	<tr>
                                            		<td colspan="2" height="10"></td>
                                            	</tr>
                                            	<tr>
                                            		<td width="60" align="center" valign="top"><img src="http://static-hcm.24hstatic.com:8008/images/avatar3.jpg" width="40" height="40" alt="thumbnail"></td>
                                            		<td valign="middle" align="left">
                                            			<div class="bl-title">
                                            			<span class="comment_title">Tên người bình luận:</span> <span style="font-size:11px;color:#666;">Tiêu đề bình luận</span>    </div>                                                                 
                                            			<div class="clear"></div>
                                                        <div class="comment_desc">Nội dung bình luận sản phẩm </div>
                                                                  
                                                    </td>
                                            	</tr>
                                            	<tr>
                                            		<td colspan="2" height="10"></td>
                                            	</tr>
                                            	<tr>
                                            		<td width="60" align="center" valign="top"><img src="http://static-hcm.24hstatic.com:8008/images/avatar3.jpg" width="40" height="40" alt="thumbnail"></td>
                                            		<td valign="middle" align="left">
                                            			<div class="bl-title">
                                            			<span class="comment_title">Tên người bình luận:</span> <span style="font-size:11px;color:#666;">Tiêu đề bình luận</span>    </div>                                                                 
                                            			<div class="clear"></div>
                                                        <div class="comment_desc">Nội dung bình luận sản phẩm </div>
                                                                  
                                                    </td>
                                            	</tr>
                                            	<tr>
                                            		<td colspan="2" height="10"></td>
                                            	</tr>
                                            	<tr>
                                            		<td width="60" align="center" valign="top"><img src="http://static-hcm.24hstatic.com:8008/images/avatar3.jpg" width="40" height="40" alt="thumbnail"></td>
                                            		<td valign="middle" align="left">
                                            			<div class="bl-title">
                                            			<span class="comment_title">Tên người bình luận:</span> <span style="font-size:11px;color:#666;">Tiêu đề bình luận</span>    </div>                                                                 
                                            			<div class="clear"></div>
                                                        <div class="comment_desc">Nội dung bình luận sản phẩm </div>
                                                                  
                                                    </td>
                                            	</tr>
                                            	<tr>
                                            		<td colspan="2" height="10"></td>
                                            	</tr>
                                            	<tr>
                                            		<td width="60" align="center" valign="top"><img src="http://static-hcm.24hstatic.com:8008/images/avatar3.jpg" width="40" height="40" alt="thumbnail"></td>
                                            		<td valign="middle" align="left">
                                            			<div class="bl-title">
                                            			<span class="comment_title">Tên người bình luận:</span> <span style="font-size:11px;color:#666;">Tiêu đề bình luận</span>    </div>                                                                 
                                            			<div class="clear"></div>
                                                        <div class="comment_desc">Nội dung bình luận sản phẩm </div>
                                                                  
                                                    </td>
                                            	</tr>
                                            	<tr>
                                            		<td colspan="2" height="10"></td>
                                            	</tr>
                                            	<tr>
                                            		<td width="60" align="center" valign="top"><img src="http://static-hcm.24hstatic.com:8008/images/avatar3.jpg" width="40" height="40" alt="thumbnail"></td>
                                            		<td valign="middle" align="left">
                                            			<div class="bl-title">
                                            			<span class="comment_title">Tên người bình luận:</span> <span style="font-size:11px;color:#666;">Tiêu đề bình luận</span>    </div>                                                                 
                                            			<div class="clear"></div>
                                                        <div class="comment_desc">Nội dung bình luận sản phẩm </div>
                                                    </td>
                                            	</tr>
                                            	<tr>
                                            		<td colspan="2" height="10"></td>
                                            	</tr>
                                    		</tbody>
                                   		</table>                                           
                                  	</div>
                                          	 
                        			<input type="text" class="input" placeholder="Name" >
                        			<input type="text" class="input" placeholder="Title" style="width: 90%">  
								  	<textarea id="form_itemDesc" rows="6" style="width: 100%" name="productComment"></textarea>
								  	[:call name=tinymce elName='form_itemDesc':]
								<!-- /Comment -->
							</div>
                          	<div class="tab-pane" id="image">
                          	<!-- image carousel  -->
								 <div id="myCarousel" class="carousel slide">
                                    <div class="carousel-inner">
                                    	<div class="item active">
                                    		<img src="http://twitter.github.com/bootstrap/assets/img/bootstrap-mdo-sfmoma-01.jpg" alt="">
                                        </div>
                                      	<div class="item">
                                            <img src="http://twitter.github.com/bootstrap/assets/img/bootstrap-mdo-sfmoma-03.jpg" alt="">
                                        </div>
                                     	<div class="item">
                                        	<img src="http://twitter.github.com/bootstrap/assets/img/bootstrap-mdo-sfmoma-03.jpg" alt="">
                                        </div>
                                    </div>   
                                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
            						<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
                               	</div>                       	
                          	<!-- / image carousel  -->
                          		[:call name=carousel:]
                          	 </div>
                   		</div>
           			</div>
        		</div>
			</div>
			<!-- / Tabs product information -->			
		</div>
		<div class="span3 category-header well grid-image" style="color: #08C" >
		Sản phẩm cùng loại
		<br/>
		<br/>
			<ul id="scroller">
 	    		<li class="category-header"><a href="javascript:void(0)" >Product Name1 <img src="http://placehold.it/260x180" alt=""> </a></li>
        		<li class="category-header"><a href="javascript:void(0)" >Product Name2 <img src="http://placehold.it/260x180" alt=""> </a></li>
        		<li class="category-header"><a href="javascript:void(0)" >Product Name3 <img src="http://placehold.it/260x180" alt=""> </a></li>
        		<li class="category-header"><a href="javascript:void(0)" >Product Name4 <img src="http://placehold.it/260x180" alt=""> </a></li>
        		<li class="category-header"><a href="javascript:void(0)" >Product Name5 <img src="http://placehold.it/260x180" alt=""> </a></li>
        		<li class="category-header"><a href="javascript:void(0)" >Product Name6 <img src="http://placehold.it/260x180" alt=""> </a></li>
        		<li class="category-header"><a href="javascript:void(0)" >Product Name7 <img src="http://placehold.it/260x180" alt=""> </a></li>
        		<li class="category-header"><a href="javascript:void(0)" >Product Name8 <img src="http://placehold.it/260x180" alt=""> </a></li>
        		<li class="category-header"><a href="javascript:void(0)" >Product Name9 <img src="http://placehold.it/260x180" alt=""> </a></li>
        		<li class="category-header"><a href="javascript:void(0)" >Product Name10 <img src="http://placehold.it/260x180" alt=""> </a></li>
        		
        		
        	</ul>
			[:call name=scroller elId='scroller':]
		</div>
		
	</div>   
    
    
