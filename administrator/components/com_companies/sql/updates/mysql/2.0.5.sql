alter table `#__mkv_companies_contacts`
    add main bool not null default 0 comment 'Основное контактное лицо' after companyID,
    add index `#__mkv_companies_contacts_main_index` (main);

