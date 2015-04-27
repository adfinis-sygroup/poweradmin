ALTER TABLE `zone_templ` ADD `global` SMALLINT NOT NULL default 0;

INSERT INTO perm_items (name, descr) VALUES (
    'zone_master_global',
    'User is allowed to add / edit global zone templates.'
);
