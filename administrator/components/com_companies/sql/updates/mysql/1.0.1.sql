alter table `s7vi9_mkv_companies`
    add fulltext (title, title_full, title_en);

create index `s7vi9_prj_user_action_log_itemID_action_section_index`
    on `s7vi9_prj_user_action_log` (itemID, action, section);

create table `s7vi9_mkv_companies_parents`
(
    id        int unsigned auto_increment,
    companyID int unsigned not null,
    parentID  int unsigned not null,
    constraint `s7vi9_mkv_companies_parents_pk`
        primary key (id),
    constraint `s7vi9_mkv_companies_parents_s7vi9_mkv_companies_id_id_fk`
        foreign key (companyID, parentID) references `s7vi9_mkv_companies` (id, id)
            on update cascade on delete cascade
) character set utf8
  collate utf8_general_ci
    comment 'Родительские компании';

create index `s7vi9_mkv_companies_parents_companyID_index`
    on `s7vi9_mkv_companies_parents` (companyID);

create unique index `s7vi9_mkv_companies_parents_companyID_uindex`
    on `s7vi9_mkv_companies_parents` (companyID);

create or replace view `s7vi9_grph_cities_all` as
select c.id, c.name as city, c.region_id, r.name as region, r.country_id, cntr.name as country
from `s7vi9_grph_cities` c
         left join `s7vi9_grph_regions` r on c.region_id = r.id
         left join `s7vi9_grph_countries` cntr on r.country_id = cntr.id;

alter table `s7vi9_mkv_companies`
    add published tinyint default 1 not null;

create index `s7vi9_mkv_companies_published_index`
    on `s7vi9_mkv_companies` (published);

drop table if exists `s7vi9_mkv_activities`;
create table `s7vi9_mkv_activities` (
                                      id int unsigned not null auto_increment primary key,
                                      title varchar(255) not null default '' comment 'Название вида деятельности',
                                      for_contractor boolean not null default 0 comment 'Используется для подрадчиков',
                                      for_ndp boolean not null default 0 comment 'Используется для НДП'
) character set utf8 collate utf8_general_ci;

create index `s7vi9_mkv_activities_title_index` on `s7vi9_mkv_activities` (title);
create index `s7vi9_mkv_activities_for_contractor_index` on `s7vi9_mkv_activities` (for_contractor);
create index `s7vi9_mkv_activities_for_ndp_index` on `s7vi9_mkv_activities` (for_ndp);

drop table if exists `s7vi9_mkv_companies_activities`;
create table `s7vi9_mkv_companies_activities`
(
    id         int unsigned not null auto_increment primary key,
    companyID  int unsigned not null,
    activityID int unsigned not null,
    constraint `s7vi9_mkv_companies_activities_s7vi9_mkv_companies_companyID_fk`
        foreign key (companyID)
            references `s7vi9_mkv_companies` (id)
            on update cascade
            on delete restrict,
    constraint `s7vi9_mkv_comp_activities_s7vi9_mkv_activities_activityID_fk`
        foreign key (activityID)
            references `s7vi9_mkv_activities` (id)
            on update cascade
            on delete restrict
)
    character set utf8
    collate utf8_general_ci;
