create table `#__mkv_companies_army_history`
(
    id              smallint unsigned not null auto_increment primary key,
    companyID       int unsigned      not null,
    army_year       year              not null default 2015 comment 'Год участия в выставке',
    square_type     tinyint           not null default 1 comment 'Тип выставочной площади',
    square_value    double(5, 2)      not null default 0 comment 'Площадь',
    targets         text              null     default null comment 'Цели',
    thematics       text              null     default null comment 'Тематические направления',
    stand           text              null     default null comment 'Номер стенда',
    exposition      text              null     default null comment 'Экспозиция',
    diversification text              null     default null comment 'Диверсификация',
    forum_new_items text              null     default null comment 'Новинки форума',
    full_new_items  text              null     default null comment 'Полные новинки',
    is_ndp          boolean           null     default null comment 'Участие в НДП',
    comment         text              null     default null comment 'Комментарий',
    constraint `#__mkv_companies_ah_#__mkv_companies_companyID_id_fk` foreign key (companyID) references `#__mkv_companies` (id) on update cascade on delete cascade
) character set utf8
  collate utf8_general_ci;
