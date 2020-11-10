create table `#__mkv_foivs`
(
    id         smallint unsigned                                     not null auto_increment primary key,
    title      text character set utf8mb4 collate utf8mb4_general_ci not null comment 'Общее название',
    title_full text character set utf8mb4 collate utf8mb4_general_ci null default null comment 'Полное название'
)
    character set utf8mb4
    collate utf8mb4_general_ci comment 'Список ФОИВов';

create table `#__mkv_companies_foivs`
(
    id         int unsigned                                          not null auto_increment primary key,
    companyID  int unsigned                                          not null,
    foivID     smallint unsigned                                     not null,
    department text character set utf8mb4 collate utf8mb4_general_ci null default null comment 'Структурное подразделение',
    `comment`  text character set utf8mb4 collate utf8mb4_general_ci null default null comment 'Комментарий',
    constraint `#__mkv_companies_foivs_#__mkv_companies_fk` foreign key (companyID)
        references `#__mkv_companies` (id) on update cascade on delete cascade,
    constraint `#__mkv_companies_foivs_#__mkv_foivs_fk` foreign key (foivID)
        references `#__mkv_foivs` (id) on update cascade on delete cascade,
    unique index `#__mkv_companies_foivs_companyID_foivID_uindex` (companyID, foivID)
) character set utf8mb4
  collate utf8mb4_general_ci;

INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (1, 'МВД РФ', 'Министерство внутренних дел Российской Федерации');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (2, 'МЧС России',
        'Министерство Российской Федерации по делам гражданской обороны, чрезвычайным ситуациям и ликвидации последствий стихийных бедствий');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (3, 'МИД России', 'Министерство иностранных дел Российской Федерации');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (4, 'РОССОТРУДНИЧЕСТВО',
        'Федеральное агентство по делам Содружества Независимых Государств, соотечественников, проживающих за рубежом, и по международному гуманитарному сотрудничеству');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (5, 'Минобороны России', 'Министерство обороны Российской Федерации');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (6, 'ФСВТС России', 'Федеральная служба по военно-техническому сотрудничеству');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (7, 'ФСТЭК России', 'Федеральная служба по техническому и экспортному контролю');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (8, 'Минюст России', 'Министерство юстиции Российской Федерации');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (9, 'ФСИН России', 'Федеральная служба исполнения наказаний');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (10, 'ФССП России', 'Федеральная служба судебных приставов');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (11, 'ГФС России', 'Государственная фельдъегерская служба Российской Федерации (федеральная служба)');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (12, 'СВР России', 'Служба внешней разведки Российской Федерации (федеральная служба)');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (13, 'ФСБ России', 'Федеральная служба безопасности Российской Федерации (федеральная служба)');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (14, 'РОСГВАРДИЯ', 'Федеральная служба войск национальной гвардии Российской Федерации (федеральная служба)');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (15, 'ФСО России', 'Федеральная служба охраны Российской Федерации (федеральная служба)');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (16, 'РОСФИНМОНИТОРИНГ', 'Федеральная служба по финансовому мониторингу (федеральная служба)');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (17, 'Росархив', 'Федеральное архивное агентство (федеральное агентство)');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (18, 'ГУСП', 'Главное управление специальных программ Президента Российской Федерации (федеральное агентство)');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (19, 'Управделами президента РФ', 'Управление делами Президента Российской Федерации (федеральное агентство)');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (20, 'Минздрав России', 'Министерство здравоохранения Российской Федерации');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (21, 'Минкультуры России', 'Министерство культуры Российской Федерации');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (22, 'Минобрнауки России', 'Министерство науки и высшего образования Российской Федерации');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (23, 'Минприроды России', 'Министерство природных ресурсов и экологии Российской Федерации');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (24, 'Росгидромет', 'Федеральная служба по гидрометеорологии и мониторингу окружающей среды');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (25, 'Росприроднадзор', 'Федеральная служба по надзору в сфере природопользования');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (26, 'Росводресурсы', 'Федеральное агентство водных ресурсов');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (27, 'РОСЛЕСХОЗ', 'Федеральное агентство лесного хозяйства');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (28, 'Роснедра', 'Федеральное агентство по недропользованию');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (29, 'Минпромторг России', 'Министерство промышленности и торговли Российской Федерации');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (30, 'Росстандарт', 'Федеральное агентство по техническому регулированию и метрологии');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (31, 'Минпросвещения России', 'Министерство просвещения Российской Федерации');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (32, 'Минвостокразвития России', 'Министерство Российской Федерации по развитию Дальнего Востока и Арктики');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (33, 'Минселхоз России', 'Министерство сельского хозяйства Российской Федерации');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (34, 'Россельхознадзор', 'Федеральная служба по ветеринарному и фитосанитарному надзору');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (35, 'Росрыболовство', 'Федеральное агентство по рыболовству');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (36, 'Минспорт России', 'Министерство спорта Российской Федерации');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (37, 'Минстрой России', 'Министерство строительства и жилищно-коммунального хозяйства Российской Федерации');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (38, 'Минтранс России', 'Министерство транспорта Российской Федерации');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (39, 'Ространснадзор', 'Федеральная служба по надзору в сфере транспорта');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (40, 'Росавиация', 'Федеральное агентство воздушного транспорта');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (41, 'Росавтодор', 'Федеральное дорожное агентство');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (42, 'Росжелдор', 'Федеральное агентство железнодорожного транспорта');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (43, 'Росморречфлот', 'Федеральное агентство морского и речного транспорта');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (44, 'Минтруд России', 'Министерство труда и социальной защиты Российской Федерации');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (45, 'Роструд', 'Федеральная служба по труду и занятости');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (46, 'Минфин России', 'Министерство финансов Российской Федерации');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (47, 'ФНС России', 'Федеральная налоговая служба');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (48, 'Пробирная палата России', 'Федеральная пробирная палата (федеральная служба)');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (49, 'Росалкогольрегулирование', 'Федеральная служба по регулированию алкогольного рынка');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (50, 'ФТС России', 'Федеральная таможенная служба');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (51, 'Казначейство России', 'Федеральное казначейство (федеральная служба)');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (52, 'Росимущество', 'Федеральное агентство по управлению государственным имуществом');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (53, 'Минцифры России', 'Министерство цифрового развития, связи и массовых коммуникаций Российской Федерации');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (54, 'Роскомнадзор',
        'Федеральная служба по надзору в сфере связи, информационных технологий и массовых коммуникаций');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (55, 'Роспечать', 'Федеральное агентство по печати и массовым коммуникациям');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (56, 'Россвязь', 'Федеральное агентство связи');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (57, 'Минэкономразвития России', 'Министерство экономического развития Российской Федерации');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (58, 'Росаккредитация', 'Федеральная служба по аккредитации');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (59, 'Росстат', 'Федеральная служба государственной статистики');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (60, 'Роспатент', 'Федеральная служба по интеллектуальной собственности');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (61, 'Ростуризм', 'Федеральное агентство по туризму');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (62, 'Минэнерго России', 'Министерство энергетики Российской Федерации');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (63, 'ФАС России', 'Федеральная антимонопольная служба');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (64, 'Росреестр', 'Федеральная служба государственной регистрации, кадастра и картографии');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (65, 'Роспотребнадзор',
        'Федеральная служба по надзору в сфере защиты прав потребителей и благополучия человека');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (66, 'Росздравнадзор', 'Федеральная служба по надзору в сфере здравоохранения');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (67, 'Рособрнадзор', 'Федеральная служба по надзору в сфере образования и науки');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (68, 'Ростехнадзор', 'Федеральная служба по экологическому, технологическому и атомному надзору');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (69, 'РОСРЕЗЕРВ', 'Федеральное агентство по государственным резервам');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (70, 'ФМБА России ', 'Федеральное медико-биологическое агентство');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (71, 'Росмолодёжь', 'Федеральное агентство по делам молодёжи');
INSERT INTO `#__mkv_foivs` (id, title, title_full)
VALUES (72, 'ФАДН России', 'Федеральное агентство по делам национальностей');