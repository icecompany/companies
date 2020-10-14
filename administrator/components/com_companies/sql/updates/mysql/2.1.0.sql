delete from `#__mkv_contracts` where id = 13415 limit 1;

alter table `#__mkv_contracts`
    add constraint `#__mkv_contracts_#__mkv_companies_id_fk`
        foreign key (companyID) references `#__mkv_companies` (id)
            on update cascade on delete cascade;