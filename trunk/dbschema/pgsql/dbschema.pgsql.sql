DROP TABLE IF EXISTS app_profile_detail CASCADE;
DROP TABLE IF EXISTS app_profile CASCADE;
DROP TABLE IF EXISTS app_log CASCADE;
DROP TABLE IF EXISTS http_session CASCADE;
DROP TABLE IF EXISTS vcatalog_tag CASCADE;
DROP TABLE IF EXISTS vcatalog_group CASCADE;
DROP TABLE IF EXISTS vcatalog_user CASCADE;
DROP TABLE IF EXISTS vcatalog_paperclip CASCADE;
DROP TABLE IF EXISTS vcatalog_order_history CASCADE;
DROP TABLE IF EXISTS vcatalog_cart_item CASCADE;
DROP TABLE IF EXISTS vcatalog_cart CASCADE;
DROP TABLE IF EXISTS vcatalog_item CASCADE;
DROP TABLE IF EXISTS vcatalog_category CASCADE;
DROP TABLE IF EXISTS vcatalog_app_config CASCADE;
DROP TABLE IF EXISTS vcatalog_page CASCADE;
DROP TABLE IF EXISTS vcatalog_textads CASCADE;

CREATE TABLE vcatalog_textads (
    aid                 SERIAL,
    atitle              VARCHAR(128),
    aurl                VARCHAR(255),
    aclicks             INT                 NOT NULL DEFAULT 0,
    atimestamp          TIMESTAMP           NOT NULL DEFAULT NOW(),
    PRIMARY KEY (aid)
);

CREATE TABLE vcatalog_page (
    pid                 VARCHAR(32)         NOT NULL,
    pattr               INT                 NOT NULL DEFAULT 0,
    pposition           INT                 NOT NULL DEFAULT 0,
    pcategory           VARCHAR(64)         NOT NULL DEFAULT '',
    ptitle              VARCHAR(128)        NOT NULL DEFAULT '',
    pcontent            TEXT,
    PRIMARY KEY (pid)
);
CREATE INDEX vcatalog_page_pattr ON vcatalog_page(pattr);
CREATE INDEX vcatalog_page_pposition ON vcatalog_page(pposition);
CREATE INDEX vcatalog_page_pcategory ON vcatalog_page(pcategory);

CREATE TABLE vcatalog_app_config (
    conf_key            VARCHAR(32)         NOT NULL,
    conf_value          TEXT,
    PRIMARY KEY (conf_key)
);
--INSERT INTO vcatalog_app_config (conf_key, conf_value)
--VALUES('site_name', 'vCatalog');
--INSERT INTO vcatalog_app_config (conf_key, conf_value)
--VALUES('site_title', 'Online Catalog Ecommerce System');
--INSERT INTO vcatalog_app_config (conf_key, conf_value)
--VALUES('site_slogan', 'Website slogan');
--INSERT INTO vcatalog_app_config (conf_key, conf_value)
--VALUES('site_keywords', 'catalog, ecommerce');
--INSERT INTO vcatalog_app_config (conf_key, conf_value)
--VALUES('site_description', 'Online Catalog Ecommerce System');
--INSERT INTO vcatalog_app_config (conf_key, conf_value)
--VALUES('site_copyright', '(C) 2011 by vCatalog/gpv.com.vn | All Rights Reserved');
--INSERT INTO vcatalog_app_config (conf_key, conf_value)
--VALUES('site_skin', 'default');
--INSERT INTO vcatalog_app_config (conf_key, conf_value)
--VALUES('use_smtp', '1');
--INSERT INTO vcatalog_app_config (conf_key, conf_value)
--VALUES('smtp_host', 'localhost');
--INSERT INTO vcatalog_app_config (conf_key, conf_value)
--VALUES('smtp_port', '25');
--INSERT INTO vcatalog_app_config (conf_key, conf_value)
--VALUES('smtp_ssl', '0');
--INSERT INTO vcatalog_app_config (conf_key, conf_value)
--VALUES('smtp_username', '');
--INSERT INTO vcatalog_app_config (conf_key, conf_value)
--VALUES('smtp_password', '');
--INSERT INTO vcatalog_app_config (conf_key, conf_value)
--VALUES('email_outgoing', 'your_outgoing_email@here.com');
--INSERT INTO vcatalog_app_config (conf_key, conf_value)
--VALUES('email_order_notification', 'your_email_to_receive_order_notification@here.com');
--INSERT INTO vcatalog_app_config (conf_key, conf_value)
--VALUES('email_on_subject', '{SITE_NAME} New order from {ORDER_NAME}');
--INSERT INTO vcatalog_app_config (conf_key, conf_value)
--VALUES('email_on_body',
--'<p>You have a new order from <b>{ORDER_NAME}</b> <i>(Email: {ORDER_EMAIL} / Phone: {ORDER_PHONE})</i></p>
--<p>Order details:</p>
--{ORDER_ITEMS}
--<p>Payment method: <b>{PAYMENT_METHOD}</b></p>
--<p>Additional information:</p>
--{ORDER_OTHER_INFO}');
--INSERT INTO vcatalog_app_config (conf_key, conf_value)
--VALUES('currency', 'VND');
--INSERT INTO vcatalog_app_config (conf_key, conf_value)
--VALUES('price_decimal_places', '0');
--INSERT INTO vcatalog_app_config (conf_key, conf_value)
--VALUES('quantity_decimal_places', '0');
--INSERT INTO vcatalog_app_config (conf_key, conf_value)
--VALUES('decimal_separator', ',');
--INSERT INTO vcatalog_app_config (conf_key, conf_value)
--VALUES('thousands_separator', '.');
--INSERT INTO vcatalog_app_config (conf_key, conf_value)
--VALUES('thumbnail_width', '260');
--INSERT INTO vcatalog_app_config (conf_key, conf_value)
--VALUES('thumbnail_heidth', '180');

CREATE TABLE app_log (
    logid               SERIAL,
    logTimestamp        INT,
    logLevel            VARCHAR(64),
    logClass            VARCHAR(96),
    logMessage          TEXT,
    logStacktrace       TEXT,
    PRIMARY KEY (logid)
);
CREATE INDEX app_log_logTimestamp ON app_log(logTimestamp);
CREATE INDEX app_log_logLevel ON app_log(logLevel);
CREATE INDEX app_log_logClass ON app_log(logClass);

CREATE TABLE app_profile (
    pid                 VARCHAR(16)         NOT NULL,
    purl                VARCHAR(64),
    ptimestamp          TIMESTAMP           NOT NULL DEFAULT NOW(),
    pduration           DOUBLE PRECISION    NOT NULL DEFAULT 0.0,
    pdetail             TEXT,
    PRIMARY KEY (pid)
);

CREATE TABLE app_profile_detail (
    pid                 VARCHAR(16)         NOT NULL,
        FOREIGN KEY (pid) REFERENCES app_profile(pid) ON DELETE CASCADE,
    pdid                VARCHAR(16)         NOT NULL,
    pdparent_id         VARCHAR(16),
    pdname              VARCHAR(64),
    pdduration          DOUBLE PRECISION    NOT NULL DEFAULT 0.0
);
CREATE INDEX app_profile_detail_id ON app_profile_detail(pid, pid);

CREATE TABLE http_session (
    session_id                  VARCHAR(32)             NOT NULL,
    session_timestamp           INT                     NOT NULL DEFAULT 0,
    session_data                TEXT,
    PRIMARY KEY(session_id)
);
CREATE INDEX http_session_session_timestamp ON http_session(session_timestamp);

CREATE TABLE vcatalog_group (
    gid             SERIAL,
    gname           VARCHAR(32),
    gdesc           VARCHAR(255),
    PRIMARY KEY (gid)
);
--INSERT INTO vcatalog_group (gname, gdesc)
--VALUES ('Administrator', 'Administrator has all permissions!');
--INSERT INTO vcatalog_group (gname, gdesc)
--VALUES ('Member', 'Normal member user');

CREATE TABLE vcatalog_user (
    uid             SERIAL,
    uusername       VARCHAR(32)             NOT NULL,
    uemail          VARCHAR(64)             NOT NULL,
    upassword       VARCHAR(64)             NOT NULL,
    ugroup_id       INT                     NOT NULL DEFAULT 0,
    utitle          VARCHAR(32),
    ufullname       VARCHAR(64),
    ulocation       VARCHAR(64),
    PRIMARY KEY (uid)
);
CREATE UNIQUE INDEX vcatalog_user_uusername ON vcatalog_user(uusername);
CREATE UNIQUE INDEX vcatalog_user_uemail ON vcatalog_user(uemail);
CREATE INDEX vcatalog_user_ugroup_id ON vcatalog_user(ugroup_id);

-- Administrator account, password is "password" (without quotes, of course!)
--INSERT INTO vcatalog_user (uusername, uemail, upassword, ugroup_id)
--VALUES ('admin', 'admin@localhost', '5f4dcc3b5aa765d61d8327deb882cf99', 1);

CREATE TABLE vcatalog_category (
    cid             SERIAL,
    cposition       INT                     NOT NULL DEFAULT 0,
    cparent_id      INT,
    ctitle          VARCHAR(64),
    cdesc           VARCHAR(255),
    cimage_id       VARCHAR(64),
    PRIMARY KEY (cid)
);
CREATE INDEX vcatalog_category_cposition ON vcatalog_category(cposition);
CREATE INDEX vcatalog_category_cimage_id ON vcatalog_category(cimage_id);

CREATE TABLE vcatalog_item (
    iid             SERIAL,
    iactive         INT                     NOT NULL DEFAULT 1,
    icategory_id    INT,
    ititle          VARCHAR(64)             NOT NULL,
    idesc           TEXT,
    ivendor         VARCHAR(64),
    icode           VARCHAR(32),
    itimestamp      INT                     NOT NULL,
    iprice          DECIMAL(10,2)           NOT NULL,
    iold_price      DECIMAL(10,2),
    istock          DECIMAL(10,2)           NOT NULL DEFAULT 0.00,
    iimage_id       VARCHAR(64),
    ihot_item       INT                     NOT NULL DEFAULT 0,
    inew_item       INT                     NOT NULL DEFAULT 0,
    PRIMARY KEY (iid)
);
CREATE INDEX vcatalog_item_iactive ON vcatalog_item(iactive);
CREATE INDEX vcatalog_item_icategory_id ON vcatalog_item(icategory_id);
CREATE INDEX vcatalog_item_ivendor ON vcatalog_item(ivendor);
CREATE INDEX vcatalog_item_icode ON vcatalog_item(icode);
CREATE INDEX vcatalog_item_itimestamp ON vcatalog_item(itimestamp);
CREATE INDEX vcatalog_item_iprice ON vcatalog_item(iprice);
CREATE INDEX vcatalog_item_istock ON vcatalog_item(istock);
CREATE INDEX vcatalog_item_iimage_id ON vcatalog_item(iimage_id);
CREATE INDEX vcatalog_item_ihot_item ON vcatalog_item(ihot_item);
CREATE INDEX vcatalog_item_inew_item ON vcatalog_item(inew_item);

CREATE TABLE vcatalog_tag (
    titem_id        INT                     NOT NULL,
        FOREIGN KEY (titem_id) REFERENCES vcatalog_item(iid) ON DELETE CASCADE,
    ttag            VARCHAR(32)             NOT NULL,
    ttype           INT                     NOT NULL DEFAULT 0,
    PRIMARY KEY (titem_id, ttag, ttype)
);
CREATE INDEX vcatalog_tag_ttag ON vcatalog_tag(ttag);
CREATE INDEX vcatalog_tag_ttype ON vcatalog_tag(ttype);

CREATE TABLE vcatalog_cart (
    csession_id         VARCHAR(32)             NOT NULL,
    cstatus             INT                     NOT NULL DEFAULT 0,
    cupdate_timestamp   INT                     NOT NULL DEFAULT 0,
    cuser_id            INT                     NOT NULL DEFAULT 0,
    PRIMARY KEY (csession_id)
);
CREATE INDEX vcatalog_cart_cstatus ON vcatalog_cart(cstatus);
CREATE INDEX vcatalog_cart_cupdate_timestamp ON vcatalog_cart(cupdate_timestamp);
CREATE INDEX vcatalog_cart_cupdate_cuser_id ON vcatalog_cart(cuser_id);

CREATE TABLE vcatalog_cart_item (
    csession_id         VARCHAR(32)             NOT NULL,
        FOREIGN KEY (csession_id) REFERENCES vcatalog_cart(csession_id) ON DELETE CASCADE,
    citem_id            INT                     NOT NULL,
    cquantity           DECIMAL(10,2)           NOT NULL,
    cprice              DECIMAL(10,2)           NOT NULL,
    PRIMARY KEY (csession_id, citem_id)
);

CREATE TABLE vcatalog_paperclip (
    pid             VARCHAR(64)             NOT NULL,
    pfilename       VARCHAR(64)             NOT NULL,
    pfilesize       BIGINT                  NOT NULL DEFAULT 0,
    pfilecontent    BYTEA,
    pimg_width      INT                     NOT NULL DEFAULT 0,
    pimg_height     INT                     NOT NULL DEFAULT 0,
    pthumbnail      BYTEA,
    pmimetype       VARCHAR(64)             NOT NULL DEFAULT '',
    ptimestamp      INT                     NOT NULL DEFAULT 0,
    pis_draft       INT                     NOT NULL DEFAULT 0,
    PRIMARY KEY (pid)
);
CREATE INDEX vcatalog_paperclip_ptimestamp ON vcatalog_paperclip(ptimestamp);
CREATE INDEX vcatalog_paperclip_pis_draft ON vcatalog_paperclip(pis_draft);
