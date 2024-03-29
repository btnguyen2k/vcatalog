[:include file="inc_html_header.tpl":]
<body class="[:$DOJO_THEME:]" onload="initFrame();">
    <style type="text/css">
    .vcatalogIconSiteSettings {
        background-image: url('icon/iconSiteSettings.png'); width: 16px; height: 16px;
    }
    .vcatalogIconEmailSettings {
        background-image: url('icon/iconEmailSettings.png'); width: 16px; height: 16px;
    }
    .vcatalogIconCatalogSettings {
        background-image: url('icon/iconCatalogSettings.png'); width: 16px; height: 16px;
    }
    .vcatalogIconPageList {
        background-image: url('icon/iconPageList.png'); width: 16px; height: 16px;
    }
    .vcatalogIconPageAdd {
        background-image: url('icon/iconPageAdd.png'); width: 16px; height: 16px;
    }
    .vcatalogIconCategoryList {
        background-image: url('icon/iconCategoryList.png'); width: 16px; height: 16px;
    }
    .vcatalogIconCategoryAdd {
        background-image: url('icon/iconCategoryAdd.png'); width: 16px; height: 16px;
    }
    .vcatalogIconItemList {
        background-image: url('icon/iconItemList.png'); width: 16px; height: 16px;
    }
    .vcatalogIconItemAdd {
        background-image: url('icon/iconItemAdd.png'); width: 16px; height: 16px;
    }
    .vcatalogIconAdsList {
        background-image: url('icon/iconAdsList.png'); width: 16px; height: 16px;
    }
    .vcatalogIconAdsAdd {
        background-image: url('icon/iconAdsAdd.png'); width: 16px; height: 16px;
    }
	.vcatalogIconUserAdd {
        background-image: url('icon/iconUserAdd.png'); width: 16px; height: 16px;
    }
	.vcatalogIconUserList {
        background-image: url('icon/iconUserList.png'); width: 16px; height: 16px;
    }
    </style>
    <script type="text/javascript">
    function loadUrl(url) {
        window.frameMainContent.location.href = url;
    }
    function refreshFrame() {
        window.frameMainContent.location.reload(true);
    }
    function goBack() {
        history.go(-1);
    }
    function goForward() {
        history.go(1);
    }
    function initFrame() {
        if (URL_PARAMS.url != undefined) {
            window.frameMainContent.location.href = URL_PARAMS.url;
        }        
    }
    </script>
    <div dojoType="dijit.layout.BorderContainer" design="sidebar" gutters="true" id="main">
        <div dojoType="dijit.MenuBar" id="mainMenu" region="top">
            <div dojoType="dijit.MenuBarItem" onclick="window.location.href='[:$MODEL.urlHome:]/../../';"
                ><img src="icon/iconHome.png"
            /></div>
            <div dojoType="dijit.MenuBarItem" onclick="window.location.href='[:$MODEL.urlHome:]';">
                <strong>[:$MODEL.APP_NAME:]</strong>
            </div>
            |
             <!-- MENU: Site Management -->
            <div dojoType="dijit.PopupMenuBarItem">
                <span>[:$MODEL.language->getMessage('msg.userManagement'):]</span>
                <div dojoType="dijit.Menu">
                    <div dojoType="dijit.MenuItem" iconClass='vcatalogIconUserList' onclick="loadUrl('[:$MODEL.urlUserManagement:]');">[:$MODEL.language->getMessage('msg.userList'):]</div>
                    <div dojoType="dijit.MenuItem" iconClass='vcatalogIconUserAdd' onclick="loadUrl('[:$MODEL.urlCreateUser:]');">[:$MODEL.language->getMessage('msg.createUser'):]</div>
                </div>
            </div>
            <!-- MENU: Site Management -->
            <div dojoType="dijit.PopupMenuBarItem">
                <span>[:$MODEL.language->getMessage('msg.settings'):]</span>
                <div dojoType="dijit.Menu">
                    <div dojoType="dijit.MenuItem" iconClass='vcatalogIconSiteSettings' onclick="loadUrl('[:$MODEL.urlSiteSettings:]');">[:$MODEL.language->getMessage('msg.siteSettings'):]</div>
                    <div dojoType="dijit.MenuItem" iconClass='vcatalogIconEmailSettings' onclick="loadUrl('[:$MODEL.urlEmailSettings:]');">[:$MODEL.language->getMessage('msg.emailSettings'):]</div>
                    <div dojoType="dijit.MenuItem" iconClass='vcatalogIconCatalogSettings' onclick="loadUrl('[:$MODEL.urlCatalogSettings:]');">[:$MODEL.language->getMessage('msg.catalogSettings'):]</div>
                </div>
            </div>
            <!-- MENU: Catalog Management -->
            <div dojoType="dijit.PopupMenuBarItem">
                <span>[:$MODEL.language->getMessage('msg.catalogManagement'):]</span>
                <div dojoType="dijit.Menu">
                    <div dojoType="dijit.MenuItem" iconClass='vcatalogIconCategoryList' onclick="loadUrl('[:$MODEL.urlCategoryManagement:]');">[:$MODEL.language->getMessage('msg.categoryList'):]</div>
                    <div dojoType="dijit.MenuItem" iconClass='vcatalogIconCategoryAdd' onclick="loadUrl('[:$MODEL.urlCreateCategory:]');">[:$MODEL.language->getMessage('msg.createCategory'):]</div>
                    <div dojoType="dijit.MenuItem" iconClass='vcatalogIconItemList' onclick="loadUrl('[:$MODEL.urlItemManagement:]');">[:$MODEL.language->getMessage('msg.itemList'):]</div>
					<div dojoType="dijit.MenuItem" iconClass='vcatalogIconItemAdd' onclick="loadUrl('[:$MODEL.urlCreateItem:]');">[:$MODEL.language->getMessage('msg.createItem'):]</div>
                </div>
            </div>
			<!-- MENU: Page Management -->
            <div dojoType="dijit.PopupMenuBarItem">
                <span>[:$MODEL.language->getMessage('msg.pageManagement'):]</span>
                <div dojoType="dijit.Menu">
					<div dojoType="dijit.MenuItem" iconClass='vcatalogIconPageList' onclick="loadUrl('[:$MODEL.urlPageManagement:]');">[:$MODEL.language->getMessage('msg.pageList'):]</div>
                    <div dojoType="dijit.MenuItem" iconClass='vcatalogIconPageAdd' onclick="loadUrl('[:$MODEL.urlCreatePage:]');">[:$MODEL.language->getMessage('msg.createPage'):]</div>
                </div>
            </div>
            <!-- MENU: Ads Management -->
            <div dojoType="dijit.PopupMenuBarItem">
                <span>[:$MODEL.language->getMessage('msg.adsManagement'):]</span>
                <div dojoType="dijit.Menu">
                    <div dojoType="dijit.MenuItem" iconClass='vcatalogIconAdsList' onclick="loadUrl('[:$MODEL.urlAdsManagement:]');">[:$MODEL.language->getMessage('msg.adsList'):]</div>
                    <div dojoType="dijit.MenuItem" iconClass='vcatalogIconAdsAdd' onclick="loadUrl('[:$MODEL.urlCreateAds:]');">[:$MODEL.language->getMessage('msg.createAds'):]</div>
                </div>
            </div>
            |
            <div dojoType="dijit.MenuBarItem" onclick="window.location.href='[:$MODEL.urlLogout:]';">
                [:$LANG->getMessage('msg.logout'):]
            </div>
            |
            <div dojoType="dijit.MenuBarItem" onclick="refreshFrame();">
                <img border="0" alt="" src="img/refresh.png" title="Refresh Page"/>
            </div>
            <div dojoType="dijit.MenuBarItem" onclick="goBack();">
                <img border="0" alt="" src="img/arrow_left.png" title="Go Back" />
            </div>
            <div dojoType="dijit.MenuBarItem" onclick="goForward();">
                <img border="0" alt="" src="img/arrow_right.png" title="Go Forward"/>
            </div>
            |
            <div style="margin-top: 8px; margin-right: 8px; float: right;">
                [:$MODEL.language->getMessage('msg.welcome'):] <strong><a href="[:$USER->getUrlProfile():]" onclick="loadUrl('[:$USER->getUrlProfile():]');">[:$USER->getDisplayName()|escape:'html':]</a></strong>
            </div>
        </div>
        <div dojoType="dijit.layout.ContentPane" splitter="false" region="bottom" minSize="0" style="text-align: center;">
            [:$MODEL.APP_NAME:] [:$MODEL.APP_VERSION:] | <span id="siteCopyright">[:$MODEL.page.copyright:]</span>
        </div>
        [:if isset($MODEL.debug):]
            <div dojoType="dijit.layout.TabContainer" region="center" tabStrip="true" style="width: 100%; height: 100%; padding: 8px 10px 10px 8px">
                <div dojoType="dijit.layout.ContentPane" id="mainContent" style="width: 100%; height: 100%; padding: 8px 10px 10px 8px" title="[:$MODEL.language->getMessage('msg.adminCp'):]">
                    <iframe name="frameMainContent" style="width: 100%; height: 100%; border: 0px solid #009010" src="[:$MODEL.urlDashboard:]"></iframe>
                </div>
                <div dojoType="dijit.layout.ContentPane" id="debugInfo" style="width: 100%; height: 100%; padding: 8px 10px 10px 8px" title="Debug Info">
                </div>
            </div>
        [:else:]
            <div dojoType="dijit.layout.ContentPane" id="mainContent" region="center" tabStrip="true" style="width: 100%; height: 100%; padding: 8px 10px 10px 8px">
                <iframe name="frameMainContent" style="width: 100%; height: 100%; border: 0px solid #009010" src="[:$MODEL.urlDashboard:]"></iframe>
            </div>
        [:/if:]       
    </div>
</body>
[:include file="inc_html_footer.tpl":]
