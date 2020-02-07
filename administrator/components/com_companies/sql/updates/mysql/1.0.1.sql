alter table `#__mkv_companies`
    add fulltext (title, title_full, title_en);

create index `#__prj_user_action_log_itemID_action_section_index`
    on `#__prj_user_action_log` (itemID, action, section);

create table `#__mkv_companies_parents`
(
    id        int unsigned auto_increment,
    companyID int unsigned not null,
    parentID  int unsigned not null,
    constraint `#__mkv_companies_parents_pk`
        primary key (id),
    constraint `#__mkv_companies_parents_#__mkv_companies_id_id_fk`
        foreign key (companyID, parentID) references `#__mkv_companies` (id, id)
            on update cascade on delete cascade
) character set utf8
  collate utf8_general_ci
    comment 'Родительские компании';

create index `#__mkv_companies_parents_companyID_index`
    on `#__mkv_companies_parents` (companyID);

create unique index `#__mkv_companies_parents_companyID_uindex`
    on `#__mkv_companies_parents` (companyID);

create or replace view `#__grph_cities_all` as
select c.id, c.name as city, c.region_id, r.name as region, r.country_id, cntr.name as country
from `#__grph_cities` c
         left join `#__grph_regions` r on c.region_id = r.id
         left join `#__grph_countries` cntr on r.country_id = cntr.id;

alter table `#__mkv_companies`
    add published tinyint default 1 not null;

create index `#__mkv_companies_published_index`
    on `#__mkv_companies` (published);

drop table if exists `#__mkv_activities`;
create table `#__mkv_activities` (
                                      id int unsigned not null auto_increment primary key,
                                      title varchar(255) not null default '' comment 'Название вида деятельности',
                                      for_contractor boolean not null default 0 comment 'Используется для подрадчиков',
                                      for_ndp boolean not null default 0 comment 'Используется для НДП'
) character set utf8 collate utf8_general_ci;

create index `#__mkv_activities_title_index` on `#__mkv_activities` (title);
create index `#__mkv_activities_for_contractor_index` on `#__mkv_activities` (for_contractor);
create index `#__mkv_activities_for_ndp_index` on `#__mkv_activities` (for_ndp);

drop table if exists `#__mkv_companies_activities`;
create table `#__mkv_companies_activities`
(
    id         int unsigned not null auto_increment primary key,
    companyID  int unsigned not null,
    activityID int unsigned not null,
    constraint `#__mkv_companies_activities_#__mkv_companies_companyID_fk`
        foreign key (companyID)
            references `#__mkv_companies` (id)
            on update cascade
            on delete restrict,
    constraint `#__mkv_comp_activities_#__mkv_activities_activityID_fk`
        foreign key (activityID)
            references `#__mkv_activities` (id)
            on update cascade
            on delete restrict
)
    character set utf8
    collate utf8_general_ci;
alter table `#__mkv_companies_activities` add unique index `#__mkv_companies_activities_companyID_activityID_uindex` (companyID, activityID);

create table if not exists  `#__mkv_companies_contacts`
(
    id int unsigned not null auto_increment primary key,
    companyID int unsigned not null,
    fio varchar(255) not null comment 'ФИО контакта',
    post varchar(255) not null comment 'Должность',
    phone_work varbinary(255) null default null comment 'Рабочий телефон',
    phone_mobile varbinary(255) null default null comment 'Мобильный телефон',
    email varbinary(255) null default null comment 'Email',
    for_accreditation boolean not null default 0 comment 'Ответственный за аккредитацию',
    for_building boolean not null default 0 comment 'Ответственный за застройку',
    `comment` text null default null,
    constraint `#__mkv_companies_contacts_#__mkv_companies_companyID_id`
        foreign key (companyID)
            references `#__mkv_companies` (id)
            on delete cascade on update cascade
) character set utf8 collate utf8_general_ci;

alter table `#__mkv_companies_contacts`
    add index `#__mkv_companies_contacts_fio_index` (fio),
    add index `#__mkv_companies_contacts_for_accreditation` (for_accreditation),
    add index `#__mkv_companies_contacts_for_building` (for_building);

alter table `#__mkv_companies_contacts`
    add phone_work_additional varchar(10) null default null after phone_work,
    add phone_mobile_additional varchar(10) null default null after phone_mobile;

alter table `#__mkv_companies`
    add phone_1_additional varchar(10) null default null after phone_1,
    add phone_2_additional varchar(10) null default null after phone_2;

alter table `#__mkv_activities`
    add `weight` tinyint unsigned not null default 0 after for_ndp;

alter table `#__mkv_activities` add index `#__mkv_activities_weight_index` (weight);

alter table `#__mkv_companies`
    add fax_additional varchar(10) null default null after fax;