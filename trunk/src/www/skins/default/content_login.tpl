
<div class="label nav-bar" style="vertical-align: middle;"  >
	<a href="javascript:void(0)" onclick="redirect('[:$MODEL.urlHome:]')"><img src="img/home-white.png"  style="padding-bottom: 10px;height: 20px"></a> <span class="divider">&gt; </span>    	
	[:$MODEL.language->getMessage('msg.login'):]
</div>
<br/>
 <div class="row-fluid">
	<div class="span12 well grid-image">
		<div class="row-fluid" style="background: url('img/icon_lock1.png') no-repeat;">	
			<div class="span1"></div>
			<div class="span11">				
                <form class="form-horizontal" method="post" action="[:$MODEL.form.action:]" name="[:$MODEL.form.name|escape:'html':]">
            		[:printFormHeader form=$MODEL.form:]
                    <fieldset>
                      	<div class="control-group">
                        	<label class="control-label" for="loginName" style="font-weight: bold;">[:$MODEL.language->getMessage('msg.username'):]:</label>
                        	<div class="controls">
                          		<input type="text" placeholder="[:$MODEL.language->getMessage('msg.loginName'):]..." name="username" class="input-xlarge" id="loginName">                  
                        	</div>
                      	</div>              	
                      	<div class="control-group">
                        	<label class="control-label" for="password" style="font-weight: bold;">[:$MODEL.language->getMessage('msg.password'):]:</label>
                        	<div class="controls">
                          		<input type="password" placeholder="[:$MODEL.language->getMessage('msg.password'):]..." class="input-xlarge" id="password">                  
                        	</div>
                      	</div>
                      	<div class="control-group">
                        	<label class="control-label" ></label>
                        	<div class="controls">
                          		<button type="submit" class="btn" >[:$MODEL.language->getMessage('msg.login'):]</button>
                            	<button class="btn" type="button" onclick="redirect('[:$MODEL.urlHome:]')">[:$MODEL.language->getMessage('msg.cancel'):]</button>                  
                        	</div>
                      	</div>                	
                    </fieldset>
                  </form>
			</div>
			
		</div>
	</div>
</div>
