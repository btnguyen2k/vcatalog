<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <base href="[:$MODEL.basehref:]" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="[:$MODEL.page.description|escape:'html':]" />
    <meta name="keywords" content="[:$MODEL.page.keywords|escape:'html':]" />
    <meta name="author" content="GPV.COM.VN/" />
    <title>[:$MODEL.page.title|escape:'html':]</title>
    [:if isset($MODEL.urlTransit):]
        <meta http-equiv="refresh" content="2; url=[:$MODEL.urlTransit:]" />
    [:/if:]    
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
