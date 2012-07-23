	<div class="label nav-bar" style="vertical-align: middle;"  >
    	<a href="javascript:void(0)" onclick="redirect('[:$MODEL.urlHome:]')"><img src="img/home-white.png"  style="padding-bottom: 10px;height: 20px"></a> <span class="divider">&gt; </span>    	
    	Registry Administrator
    </div>
    <br/>
 <div class="row-fluid">
	<div class="span12 well grid-image">
        <form class="form-horizontal">
            <fieldset>
              	<div class="control-group">
                	<label class="control-label" for="loginName" style="font-weight: bold;">Login Name :</label>
                	<div class="controls">
                  		<input type="text" class="input-xlarge" placeholder="Login Name..." id="loginName">                  
                	</div>
              	</div>
              	 <div class="control-group">
                <label class="control-label" for="userGroup" style="font-weight: bold;">Select list :</label>
                <div class="controls">
                  <select id="userGroup">
                    <option>Administrator</option>
                    <option>Member</option>
                  </select>
                </div>
              </div>
              	<div class="control-group">
                	<label class="control-label" for="password" style="font-weight: bold;">Password :</label>
                	<div class="controls">
                  		<input type="password" class="input-xlarge" placeholder="Password..." id="password">                  
                	</div>
              	</div>
              	<div class="control-group">
                	<label class="control-label" for="confirm" style="font-weight: bold;">Password Confirm :</label>
                	<div class="controls">
                  		<input type="password" class="input-xlarge" placeholder="Password Confirm..." id="confirm">                  
                	</div>
              	</div>
              	<div class="control-group">
                	<label class="control-label" for="email" style="font-weight: bold;">Email :</label>
                	<div class="controls">
                  		<input type="text" class="input-xlarge" placeholder="Email..." id="email">                  
                	</div>
              	</div>
              	<div class="control-group">
                	<label class="control-label" for="fullName" style="font-weight: bold;">Full Name :</label>
                	<div class="controls">
                  		<input type="text" class="input-xlarge" placeholder="Full name..." id="fullName">                  
                	</div>
              	</div> 
              	<div class="control-group">
                	<label class="control-label" ></label>
                	<div class="controls">
                  		<button type="submit" class="btn">Submit</button>
                    	<button class="btn">Cancel</button>                  
                	</div>
              	</div>              	             	
                
            </fieldset>
          </form>
	</div>
</div>
