ALTER TABLE zone_templ ADD global number(1) DEFAULT 0 NOT NULL;

INSERT INTO perm_items VALUES (
    62,
    'zone_master_global',
    'User is allowed to add / edit global zone templates.'
);
