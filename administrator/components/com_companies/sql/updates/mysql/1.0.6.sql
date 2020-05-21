create table `#__mkv_companies_contacts_occupancy_new` (
                                                              id int unsigned not null auto_increment primary key,
                                                              companyID int unsigned not null not null,
                                                              for_building tinyint unsigned not null default 0 comment 'Количество контактов для застройки',
                                                              for_accreditation tinyint not null default 0 comment 'Количество контактов для аккредитации',
                                                              unique index `#__mkv_companies_contacts_occupancy_new_companyID_uindex` (companyID),
                                                              constraint `#__mkv_companies_contacts_occupancy_new_companies_cID_id_fk`
                                                                  foreign key (companyID) references `#__mkv_companies` (id)
                                                                      on update cascade on delete cascade,
                                                              index `#__mkv_companies_contacts_occupancy_new_cid_acc_bldg_index` (companyID, for_building, for_accreditation)
) character set utf8 collate utf8_general_ci;

insert into `#__mkv_companies_contacts_occupancy_new`
select null, c.companyID, ifnull(sum(c.for_building),0), ifnull(sum(c.for_accreditation),0)
from `#__mkv_companies_contacts` c
group by c.companyID;
