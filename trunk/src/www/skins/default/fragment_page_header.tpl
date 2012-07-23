<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="[:$MODEL.urlHome:]">vCatalog Logo</a>
            <div class="nav-collapse">            	 
                <ul class="nav">
                    [:foreach $MODEL.onMenuPages as $page:]
                        <li><a href="[:$page->getUrlView():]">[:$page->getTitle()|escape:'html':]</a></li>
                    [:/foreach:]
                </ul>
                
                <p class="navbar-text pull-right">                 		              	
                    [:if isset($USER):]
                        [:$LANGUAGE->getMessage('msg.welcome'):] <strong>[:$USER->getDisplayName()|escape:'html':]</strong>
                        |
                        [:$LANGUAGE->getMessage('msg.logout'):]
                    [:else:]
                        [:if isset($MODEL.urlLogin):]
                            <a href="[:$MODEL.urlLogin:]">[:$LANGUAGE->getMessage('msg.login'):]</a>
                            |
                        [:/if:]
                        [:if isset($MODEL.urlRegister):]
                            <a href="[:$MODEL.urlRegister:]">[:$LANGUAGE->getMessage('msg.register'):]</a>
                        [:/if:]
                    [:/if:]
                   
                </p>
              
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>
