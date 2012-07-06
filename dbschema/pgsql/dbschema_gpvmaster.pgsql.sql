DROP TABLE IF EXISTS gpv_site_product;
DROP TABLE IF EXISTS gpv_product;
DROP TABLE IF EXISTS gpv_site;

CREATE TABLE gpv_site (
    sdomain                 VARCHAR(128)            NOT NULL,
    sref                    VARCHAR(128),
    stimestamp              INT                     NOT NULL DEFAULT 0,
    scustomer_id            VARCHAR(64),
    PRIMARY KEY (sdomain),
    FOREIGN KEY (sref) REFERENCES gpv_site(sdomain) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE INDEX gpv_site_sref ON gpv_site(sref);
CREATE INDEX gpv_site_stimestamp ON gpv_site(stimestamp);
CREATE INDEX gpv_site_scustomer_id ON gpv_site(scustomer_id);

CREATE TABLE gpv_product (
    pname                   VARCHAR(64)             NOT NULL,
    pactive                 SMALLINT                NOT NULL DEFAULT 1,
    pversion_1              SMALLINT                NOT NULL DEFAULT 0,
    pversion_2              SMALLINT                NOT NULL DEFAULT 0,
    pversion_3              SMALLINT                NOT NULL DEFAULT 0,
    pversion_4              SMALLINT                NOT NULL DEFAULT 0,
    pconfig                 TEXT,
    PRIMARY KEY (pname)
);
CREATE INDEX gpv_product_version ON gpv_product(pversion_1, pversion_2, pversion_3, pversion_4);
INSERT INTO gpv_product (pname, pversion_1, pversion_2, pversion_3, pversion_4, pconfig)
VALUES ('VCATALOG', 0, 6, 0, 0,
'{
  "LEVELS": {
    "0": {
      "CATALOG_CATEGORIES": 10,
      "CATALOG_ITEMS": 50,
      "CMS_PAGES": 10,
      "PAPERCLIP_FILES": 70,
      "PAPERCLIP_FILESIZE": 100000
    },
    "1": {
      "CATALOG_CATEGORIES": 100,
      "CATALOG_ITEMS": 1000,
      "CMS_PAGES": 100,
      "PAPERCLIP_FILES": 1200,
      "PAPERCLIP_FILESIZE": 120000
    },
    "2": {
      "CATALOG_CATEGORIES": 500,
      "CATALOG_ITEMS": 10000,
      "CMS_PAGES": 500,
      "PAPERCLIP_FILES": 11000,
      "PAPERCLIP_FILESIZE": 150000
    }
  }
}'
);

CREATE TABLE gpv_site_product (
    site_domain             VARCHAR(128)            NOT NULL,
        FOREIGN KEY (site_domain) REFERENCES gpv_site(sdomain) ON DELETE CASCADE ON UPDATE CASCADE,
    prod_name               VARCHAR(64)             NOT NULL,
        FOREIGN KEY (prod_name) REFERENCES gpv_product(pname) ON DELETE CASCADE ON UPDATE CASCADE,
    prod_level              INT                     NOT NULL DEFAULT 0,
    prod_timestamp          INT                     NOT NULL DEFAULT 0,
    prod_expiry             INT                     NOT NULL DEFAULT 0,
    prod_config             TEXT,
    PRIMARY KEY (site_domain, prod_name)
);
CREATE INDEX gpv_site_product_site_domain ON gpv_site_product(site_domain);
CREATE INDEX gpv_site_product_prod_name ON gpv_site_product(prod_name);
--INSERT INTO gpv_site_product (site_domain, prod_name, prod_level, prod_timestamp, prod_expiry, prod_config)
--VALUES ('localhost', 'VCATALOG', 0, UNIX_TIMESTAMP(), -1, '{"DB":{"TYPE":"MYSQL", "HOST":"127.0.0.1", "USER":"vcatalog_local", "PASSWORD":"vcatalog_local", "DATABASE":"vcatalog_local", "SETUP_SQLS":["SET NAMES ''utf8''"]}}');
