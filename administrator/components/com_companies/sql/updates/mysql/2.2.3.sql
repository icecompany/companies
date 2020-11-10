alter table `#__mkv_companies`
    add targets text character set utf8mb4 collate utf8mb4_general_ci null default null comment 'Цели участия в выставках' after moscow_office_house;

alter table `#__mkv_companies_clients`
    add `comment` text character set utf8mb4 collate utf8mb4_general_ci null default null;

alter table `#__mkv_companies_cooperation`
    add `comment` text character set utf8mb4 collate utf8mb4_general_ci null default null;

alter table `#__mkv_companies_partners`
    add `comment` text character set utf8mb4 collate utf8mb4_general_ci null default null;
