alter table `s7vi9_mkv_companies`
    add fulltext (title, title_full, title_en);

create index `s7vi9_prj_user_action_log_itemID_action_section_index`
    on `s7vi9_prj_user_action_log` (itemID, action, section);