ALTER TABLE `zone_templ` ADD `global` TINYINT(1) NOT NULL DEFAULT 0;

INSERT INTO perm_items VALUES (
    62,
    'zone_master_global',
    'User is allowed to add / edit global zone templates.'
);
