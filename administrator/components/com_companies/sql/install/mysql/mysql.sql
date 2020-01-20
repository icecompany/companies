create table if not exists `#__mkv_companies`
(
    id int unsigned auto_increment,
    is_contractor boolean default 0 comment 'Компания является подрядчиком',
    is_ndp boolean default 0 comment 'Компания является организатором НДП',
    form varchar(255) default null null comment 'Форма собственности',
    title text not null comment 'Название краткое',
    title_full text default null null comment 'Название полное',
    title_en text default null null comment 'Название на английском',
    director_name text default null null comment 'Руководитель',
    director_post text default null null comment 'Должность руководителя',
    legal_city int unsigned not null comment 'Город (юр)',
    legal_index varchar(10) default null null comment 'Индекс (юр)',
    legal_street text default null null comment 'Улица (юр)',
    legal_house varchar(525) default null null comment 'Дом (юр)',
    fact_city int unsigned not null comment 'Город (факт)',
    fact_index varchar(10) default null null comment 'Индекс (факт)',
    fact_street text default null null comment 'Улица (факт)',
    fact_house varchar(255) default null null comment 'Дом (факт)',
    phone_1 varchar(255) default null null comment 'Тел 1',
    phone_1_comment text default null null comment 'Тел 1 (комментарий)',
    phone_2 varchar(255) default null null comment 'Тел 2',
    phone_2_comment text default null null comment 'Тел 2 (комментарий)',
    fax varchar(255) default null null comment 'Факс',
    email text default null null comment 'Email',
    site text default null null comment 'Веб-сайт',
    inn varchar(20) default null null comment 'ИНН',
    kpp varchar(255) default null null comment 'КПП',
    rs varchar(255) default null null comment 'Расс. счёт',
    ks varchar(255) default null null comment 'Кор. счёт',
    bank text default null null comment 'Наименование банка',
    bik varchar(25) default null null comment 'БИК',
    comment text default null null comment 'Комментарий',
    constraint `#__mkv_companies_pk`
        primary key (id),
    constraint `#__mkv_companies_#__grph_cities_id_fk`
        foreign key (legal_city) references `#__grph_cities` (id),
    constraint `#__mkv_companies_#__grph_cities_id_fk_2`
        foreign key (fact_city) references `#__grph_cities` (id)
) character set utf8 collate utf8_general_ci
    comment 'Компании';

create index `#__mkv_companies_tip_index`
    on `#__mkv_companies` (tip);

