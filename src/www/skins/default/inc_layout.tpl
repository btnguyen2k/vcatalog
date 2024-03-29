[:include file='inc_functions.tpl':][:include file='fragment_html_header.tpl':]
<body >
    [:include file='fragment_page_header.tpl':]

    <div class="container-fluid">
            [:if isset($DISABLE_COLUMN_LEFT):]
                [:assign var="_MAIN_CONTENT_CLASS_" value="span12":]
            [:else:]
                [:assign var="_MAIN_CONTENT_CLASS_" value="span9":]
            [:/if:]
                       
            <div class="row-fluid">
    			<div class="span3">
                		[:if !isset($DISABLE_COLUMN_LEFT):]                
                    		[:include file='inc_column_left.tpl':]
            			[:/if:]
                </div>
        		<div class="span9">
        			[:if isset($CONTENT):][:include file=$CONTENT:][:/if:]
        		</div>    		
        	</div>  
    </div>

    
    [:include file='fragment_page_footer.tpl':]
    
    
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
