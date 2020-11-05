create table `#__mkv_companies_partners`
(
    id int unsigned not null auto_increment primary key,
    company_1_ID int unsigned not null,
    company_2_ID int unsigned not null,
    `type` set('partner', 'competitor') comment 'Тип связи компаний',
    constraint `#__mkv_companies_partners_#__companies_company_1_ID_id_fk` foreign key (company_1_ID) references `#__mkv_companies` (id)
        on update cascade on delete cascade,
    constraint `#__mkv_companies_partners_#__companies_company_2_ID_id_fk` foreign key (company_2_ID) references `#__mkv_companies` (id)
        on update cascade on delete cascade,
    index `#__mkv_companies_partners_type_index` (`type`),
    unique index `#__mkv_companies_partners_company_1_company_2_type_index` (company_1_ID, company_2_ID, `type`)
)
    character set utf8mb4 collate utf8mb4_general_ci comment 'Конкуренты и партнёры компаний';

create table `#__mkv_companies_clients`
(
    id int unsigned not null auto_increment primary key,
    companyID int unsigned not null,
    clientID int unsigned not null,
    constraint `#__mkv_companies_clients_#__companies_companyID_id_fk` foreign key (companyID) references `#__mkv_companies` (id)
        on update cascade on delete cascade,
    constraint `#__mkv_companies_clients_#__companies_clientID_id_fk` foreign key (clientID) references `#__mkv_companies` (id)
        on update cascade on delete cascade,
    unique index `#__mkv_companies_clients_companyID_clientID_uindex` (companyID, clientID)
)
    character set utf8mb4 collate utf8mb4_general_ci comment 'Клиенты компаний';

create table `#__mkv_companies_cooperation`
(
    id int unsigned not null auto_increment primary key,
    companyID int unsigned not null,
    clientID int unsigned not null,
    constraint `#__mkv_companies_cooperation_#__companies_companyID_id_fk` foreign key (companyID) references `#__mkv_companies` (id)
        on update cascade on delete cascade,
    constraint `#__mkv_companies_cooperation_#__companies_clientID_id_fk` foreign key (clientID) references `#__mkv_companies` (id)
        on update cascade on delete cascade,
    unique index `#__mkv_companies_cooperation_companyID_clientID_uindex` (companyID, clientID)
)
    character set utf8mb4 collate utf8mb4_general_ci comment 'Поиск сотрудничества компаний';

