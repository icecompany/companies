create table `#__mkv_companies_turnover`
(
    id        int unsigned  not null primary key auto_increment,
    companyID int unsigned  not null,
    year      year          not null,
    turnover  double(11, 2) not null default 0,
    constraint `#__mkv_companies_turnover_#__mkv_companies_companyID_id_fk`
        foreign key (companyID) references `#__mkv_companies` (id)
            on update cascade on delete cascade,
    index `#__mkv_companies_turnover_companyID_year_index` (companyID, year)
) character set utf8mb4
  collate utf8mb4_general_ci comment 'Оборот средств компаний по годам';

create table `#__russian_regions`
(
    id    tinyint unsigned not null primary key auto_increment,
    code  tinyint unsigned not null unique,
    title varchar(255)     not null,
    index `#__russian_regions_code_index` (code)
) character set utf8mb4
  collate utf8mb4_general_ci comment 'Список регионов РФ с кодами';

INSERT INTO `#__russian_regions` (id, code, title)
VALUES (1, 2, 'Республика Алтай');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (2, 3, 'Республика Башкортостан');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (3, 4, 'Республика Бурятия');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (4, 5, 'Республика Дагестан');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (5, 6, 'Республика Ингушетия');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (6, 7, 'Кабардино-Балкарская Республика');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (7, 8, 'Республика Калмыкия');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (8, 9, 'Карачаево-Черкесская Республика');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (9, 10, 'Республика Карелия');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (10, 11, 'Республика Коми');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (11, 12, 'Республика Крым');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (12, 13, 'Республика Марий Эл');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (13, 14, 'Республика Мордовия');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (14, 15, 'Республика Саха (Якутия)');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (15, 16, 'Республика Северная Осетия');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (16, 17, 'Республика Татарстан');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (17, 18, 'Республика Тыва');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (18, 19, 'Удмуртская Республика');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (19, 20, 'Республика Хакасия');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (20, 21, 'Чеченская Республика');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (21, 22, 'Чувашская Республика');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (22, 23, 'Алтайский край');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (23, 24, 'Забайкальский край');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (24, 25, 'Камчатский край');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (25, 26, 'Краснодарский край');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (26, 27, 'Красноярский край');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (27, 28, 'Пермский край');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (28, 29, 'Приморский край');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (29, 30, 'Ставропольский край');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (30, 31, 'Хабаровский край');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (31, 32, 'Амурская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (32, 33, 'Архангельская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (33, 34, 'Астраханская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (34, 35, 'Белгородская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (35, 36, 'Брянская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (36, 37, 'Владимирская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (37, 38, 'Волгоградская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (38, 39, 'Вологодская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (39, 40, 'Воронежская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (40, 41, 'Ивановская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (41, 42, 'Иркутская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (42, 43, 'Калининградская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (43, 44, 'Калужская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (44, 45, 'Кемеровская область — Кузбасс');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (45, 46, 'Кировская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (46, 47, 'Костромская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (47, 48, 'Курганская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (48, 49, 'Курская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (49, 50, 'Ленинградская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (50, 51, 'Липецкая область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (51, 52, 'Магаданская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (52, 53, 'Московская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (53, 54, 'Мурманская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (54, 55, 'Нижегородская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (55, 56, 'Новгородская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (56, 57, 'Новосибирская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (57, 58, 'Омская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (58, 59, 'Оренбургская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (59, 60, 'Орловская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (60, 61, 'Пензенская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (61, 62, 'Псковская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (62, 63, 'Ростовская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (63, 64, 'Рязанская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (64, 65, 'Самарская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (65, 66, 'Саратовская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (66, 67, 'Сахалинская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (67, 68, 'Свердловская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (68, 69, 'Смоленская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (69, 70, 'Тамбовская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (70, 71, 'Тверская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (71, 72, 'Томская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (72, 73, 'Тульская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (73, 74, 'Тюменская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (74, 75, 'Ульяновская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (75, 76, 'Челябинская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (76, 77, 'Ярославская область');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (77, 78, 'Москва');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (78, 79, 'Санкт-Петербург');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (79, 80, 'Севастополь');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (80, 81, 'Еврейская АО');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (81, 82, 'Ненецкий АО');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (82, 83, 'Ханты-Мансийский АО — Югра');
INSERT INTO `#__russian_regions` (id, code, title)
VALUES (83, 84, 'Чукотский АО');

create table `#__mkv_companies_regions`
(
    id        int unsigned     not null primary key auto_increment,
    companyID int unsigned     not null,
    regionID  tinyint unsigned not null,
    struct    text             null default null,
    comment   text             null default null,
    constraint `#__mkv_companies_regions_#__russian_regions_regionID_id_fk`
        foreign key (regionID) references `#__russian_regions` (id)
            on update cascade on delete restrict
) character set utf8mb4
  collate utf8mb4_general_ci;

alter table `#__mkv_companies_projects_other`
    drop finances;