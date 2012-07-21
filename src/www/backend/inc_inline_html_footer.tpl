[:if isset($MODEL.debug):]
    [:assign var="_debug" value=$MODEL.debug:]
    [:assign var="_debugMemoryUsage" value=round($_debug->getMemoryUsageKb()):]
    [:assign var="_debugMemoryPeakUsage" value=round($_debug->getMemoryPeakUsageKb()):]
    [:assign var="_debugMemoryLimit" value=round($_debug->getMemoryLimit()):]
    
    [:assign var="_debugHtml" value="":]
    [:assign var="_debugHtml" value="`$_debugHtml`<div id='debug'>":]
    [:assign var="_debugHtml" value="`$_debugHtml`<div>`$smarty.server.REQUEST_URI`</div>":]
    
    [:assign var="_debugHtml" value="`$_debugHtml`<table>":]
    [:assign var="_debugHtml" value="`$_debugHtml`<thead><tr><th colspan='3'>Memory Info</th></tr><tr><th>Usage</th><th>Peak</th><th>Limit</th></tr></thead>":]
    [:assign var="_debugHtml" value="`$_debugHtml`<tbody><tr><td align='right'>`$_debugMemoryUsage`K</td>":]
    [:assign var="_debugHtml" value="`$_debugHtml`<td align='right'>`$_debugMemoryPeakUsage`K</td>":]
    [:assign var="_debugHtml" value="`$_debugHtml`<td align='right'>`$_debugMemoryLimit`</td>":]
    [:assign var="_debugHtml" value="`$_debugHtml`</tr></tbody>":]
    [:assign var="_debugHtml" value="`$_debugHtml`</table>":]
    
    [:assign var="_debugHtml" value="`$_debugHtml`<table>":]
    [:assign var="_debugHtml" value="`$_debugHtml`<thead><tr><th colspan='4'>Cache Info</th></tr><tr><th>Name</th><th>Hits</th><th>Misses</th><th>Size</th></tr></thead>":]
    [:assign var="_debugHtml" value="`$_debugHtml`<tbody>":]
        [:foreach $_debug->getCacheInfo() as $cacheName=>$cache:]
            [:assign var="_cacheName" value=$cache->getName():]
            [:assign var="_cacheClass" value=get_class($cache):]
            [:assign var="_cacheHits" value=$cache->getNumHits():]
            [:assign var="_cacheMisses" value=$cache->getNumMisses():]
            [:assign var="_cacheHitsPercent" value=round($_cacheHits*100/($_cacheHits+$_cacheMisses), 2):]
            [:assign var="_cacheSize" value=$cache->getSize():]
            
            [:assign var="_debugHtml" value="`$_debugHtml`<tr>":]
            [:assign var="_debugHtml" value="`$_debugHtml`<td align='left'><strong>`$_cacheName`</strong><br /><em>`$_cacheClass`</em></td>":]
            [:assign var="_debugHtml" value="`$_debugHtml`<td align='right'>`$_cacheHits` <small>(`$_cacheHitsPercent`%)</small></td>":]
            [:assign var="_debugHtml" value="`$_debugHtml`<td align='right'>`$_cacheMisses`</td>":]
            [:assign var="_debugHtml" value="`$_debugHtml`<td align='right'>`$_cacheSize`</td>":]
            [:assign var="_debugHtml" value="`$_debugHtml`</tr>":]
        [:foreachelse:]
            [:assign var="_debugHtml" value="`$_debugHtml`<tr><td colspan='4'>No Data</td></tr>":]
        [:/foreach:]
    [:assign var="_debugHtml" value="`$_debugHtml`</tbody>":]
    [:assign var="_debugHtml" value="`$_debugHtml`</table>":]
    
    [:assign var="_debugHtml" value="`$_debugHtml`<table>":]
    [:assign var="_debugHtml" value="`$_debugHtml`<thead><tr><th colspan='3'>SQL Info</th></tr><tr><th>#</th><th>Query</th><th>Time</th></tr></thead>":]
    [:assign var="_debugHtml" value="`$_debugHtml`<tbody>":]
        [:assign var="_sqlTimeTotal" value=0:]
        [:foreach $_debug->getSqlLog() as $sqlLog:]
            [:assign var="_sqlTimeTotal" value=$_sqlTimeTotal+$sqlLog[1]:]
        
            [:assign var="_sqlLogIndex" value=$sqlLog@index+1:]
            [:assign var="_sqlLogSql" value=$sqlLog[0]:]
            [:assign var="_sqlLogTime" value=round($sqlLog[1],5):]

            [:assign var="_debugHtml" value="`$_debugHtml`<tr>":]
            [:assign var="_debugHtml" value="`$_debugHtml`<td align='right'>`$_sqlLogIndex`</td>":]
            [:assign var="_debugHtml" value="`$_debugHtml`<td align='left'>`$_sqlLogSql`</td>":]
            [:assign var="_debugHtml" value="`$_debugHtml`<td align='right'>`$_sqlLogTime`</td>":]
            [:assign var="_debugHtml" value="`$_debugHtml`</tr>":]
        [:foreachelse:]
            [:assign var="_debugHtml" value="`$_debugHtml`<tr><td colspan='3'>No Data</td></tr>":]
        [:/foreach:]
        [:assign var="_sqlTimeTotal" value=round($_sqlTimeTotal,5):]
        [:assign var="_debugHtml" value="`$_debugHtml`<tr><th colspan='2'>Total</th><th align='right'>`$_sqlTimeTotal`</th></tr>":]
    [:assign var="_debugHtml" value="`$_debugHtml`</tbody>":]
    [:assign var="_debugHtml" value="`$_debugHtml`</table>":]
    
    [:assign var="_debugHtml" value="`$_debugHtml`</div>":]
[:/if:]
<script type="text/javascript">
    var obj = window.parent.document.getElementById('debugInfo');
    obj.innerHTML = "[:$_debugHtml|escape:'javascript':]";
</script>
</html>