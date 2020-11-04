create table `#__mkv_companies_projects_other`
(
    id int unsigned not null auto_increment primary key,
    companyID int unsigned not null,
    `year` year not null comment 'Год участия',
    title text not null comment 'Название выставки',
    finances double(11,2) not null default 0 comment 'Оборот средств',
    constraint `#__mkv_companies_projects_other_cid_fk` foreign key (companyID) references `#__mkv_companies` (id)
        on update cascade on delete cascade,
    index `#__mkv_companies_projects_other_companyID_year_index` (companyID, `year`)
)
    character set utf8mb4 collate utf8mb4_general_ci comment 'Участие компаний в других выставках';

