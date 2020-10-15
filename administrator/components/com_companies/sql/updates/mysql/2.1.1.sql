create table `#__mkv_companies_complain`
(
    id        int  not null auto_increment primary key,
    old_title text null default null
) character set utf8
  collate utf8_general_ci;

create fulltext index `title_3`
    on `#__mkv_companies` (title);
