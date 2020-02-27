alter table `#__mkv_companies`
    add checked_out int not null default 0,
    add checked_out_time datetime null default null;

