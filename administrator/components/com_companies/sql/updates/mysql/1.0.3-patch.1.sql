alter table `#__mkv_companies_army_history`
    add is_report boolean null default null comment 'Участвует с докладом, а не своё мероприятие' after is_ndp,
    modify square_value double(6,2) null default null;
