alter table `#__mkv_companies`
    add associations text null default null comment 'Ассоциации' after bik,
    add representations text null default null comment 'Представительства в городах' after associations,
    add branches text null default null comment 'Филиалы' after representations,
    add main_office_city int unsigned null default null comment 'Город головного офиса' after branches,
    add main_office_index varchar(9) null default null comment 'Индекс головного офиса' after main_office_city,
    add main_office_street text null default null comment 'Улица головного офиса' after main_office_index,
    add main_office_house text null default null comment 'Дом головного офиса' after main_office_street,
    add moscow_office_index varchar(9) null default null comment 'Индекс представительства в Москве' after main_office_house,
    add moscow_office_street text null default null comment 'Улица представительства в Москве' after moscow_office_index,
    add moscow_office_house text null default null comment 'Дом представительства в Москве' after moscow_office_street,
    add index `#__mkv_companies_main_office_city_index` (main_office_city),
    add constraint `#__mkv_companies_#__grph_cities_main_office_city_id` foreign key (main_office_city) references `#__grph_cities` (id) on update cascade on delete cascade;
