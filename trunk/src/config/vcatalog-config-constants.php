<?php
define('WORD_SPLIT_PATTERN', '/[\s,\."\';:]+/');

define('CONFIG_SITE_COPYRIGHT', 'site_copyright');
define('CONFIG_SITE_DESCRIPTION', 'site_description');
define('CONFIG_SITE_KEYWORDS', 'site_keywords');
define('CONFIG_SITE_NAME', 'site_name');
define('CONFIG_SITE_SLOGAN', 'site_slogan');
define('CONFIG_SITE_TITLE', 'site_title');

define('CONFIG_USE_SMTP', 'use_smtp');
define('CONFIG_SMTP_HOST', 'smtp_host');
define('CONFIG_SMTP_PORT', 'smtp_port');
define('CONFIG_SMTP_SSL', 'smtp_ssl');
define('CONFIG_SMTP_USERNAME', 'smtp_username');
define('CONFIG_SMTP_PASSWORD', 'smtp_password');
define('CONFIG_EMAIL_OUTGOING', 'email_outgoing');
define('CONFIG_EMAIL_ORDER_NOTIFICATION', 'email_order_notification');
define('CONFIG_EMAIL_ON_SUBJECT', 'email_on_subject');
define('CONFIG_EMAIL_ON_BODY', 'email_on_body');

define('CONFIG_CURRENCY', 'currency');
define('CONFIG_PRICE_DECIMAL_PLACES', 'price_decimal_places');
define('CONFIG_QUANTITY_DECIMAL_PLACES', 'quantity_decimal_places');
define('CONFIG_DECIMAL_SEPARATOR', 'decimal_separator');
define('CONFIG_THOUSANDS_SEPARATOR', 'thousands_separator');

define('MAX_UPLOAD_FILESIZE', 300000);
define('ALLOWED_UPLOAD_FILE_TYPES', '*.gif,*.jpg;.*.png');

define('THUMBNAIL_WIDTH', 150);
define('THUMBNAIL_HEIGHT', 150);

define('FORM_ERROR_MESSAGES', 'errorMessages');
define('FORM_INFO_MESSAGES', 'infoMessages');

define('MODEL_APP_VERSION', 'APP_VERSION');

define('MODEL_REQUEST_MODULE', 'reqModule');
define('MODEL_REQUEST_ACTION', 'reqAction');

define('MODEL_CATEGORY_TREE', 'categoryTree');
define('MODEL_CATEGORY_LIST', 'categoryList');
define('MODEL_CART', 'cart');
define('MODEL_PAGE_LIST', 'pageList');
define('MODEL_ITEM_LIST', 'itemList');
define('MODEL_HOT_ITEMS', 'hotItems');
define('MODEL_ONMENU_PAGES', 'onMenuPages');
define('MODEL_INFO_MESSAGES', 'infoMessages');
define('MODEL_ERROR_MESSAGES', 'errorMessages');
define('MODEL_TRANSIT_MESSAGE', 'transitMessage');
define('MODEL_URL_TRANSIT', 'urlTransit');
define('MODEL_DEBUG', 'debug');

define('SESSION_ITEM_SORTING', 'ITEM_SORTING');
define('SESSION_LAST_ACCESS_URL', 'LAST_ACCESS_URL');
define('SESSION_USER_ID', 'USER_ID');
define('SESSION_LANGUAGE_NAME', 'LANGUAGE_NAME');

define('DEFAULT_ITEM_SORTING', 'timedesc');
define('ITEM_SORTING_TIMEDESC', 'timedesc');
define('ITEM_SORTING_TIMEASC', 'timeasc');
define('ITEM_SORTING_PRICEDESC', 'pricedesc');
define('ITEM_SORTING_PRICEASC', 'priceasc');
define('ITEM_SORTING_TITLE', 'title');

define('USER_GROUP_ADMIN', 1);

define('DAO_CATALOG', 'dao.catalog');
define('DAO_CART', 'dao.cart');
define('DAO_CONFIG', 'dao.config');
define('DAO_PAGE', 'dao.page');
define('DAO_PAPERCLIP', 'dao.paperclip');
define('DAO_SESSION', 'dao.session');
define('DAO_USER', 'dao.user');