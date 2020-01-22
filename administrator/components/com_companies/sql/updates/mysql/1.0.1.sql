alter table `s7vi9_mkv_companies`
    add fulltext (title, title_full, title_en);

create index `s7vi9_prj_user_action_log_itemID_action_section_index`
    on `s7vi9_prj_user_action_log` (itemID, action, section);

create table `s7vi9_mkv_companies_parents`
(
    id int unsigned auto_increment,
    companyID int unsigned not null,
    parentID int unsigned not null,
    constraint `s7vi9_mkv_companies_parents_pk`
        primary key (id),
    constraint `s7vi9_mkv_companies_parents_s7vi9_mkv_companies_id_id_fk`
        foreign key (companyID, parentID) references `s7vi9_mkv_companies` (id, id)
            on update cascade on delete cascade
)
    comment 'Родительские компании';

create index `s7vi9_mkv_companies_parents_companyID_index`
    on `s7vi9_mkv_companies_parents` (companyID);

create unique index `s7vi9_mkv_companies_parents_companyID_parentID_uindex`
    on `s7vi9_mkv_companies_parents` (companyID, parentID);

create index `s7vi9_mkv_companies_parents_parentID_index`
    on `s7vi9_mkv_companies_parents` (parentID);

