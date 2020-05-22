set foreign_key_checks = 0;
truncate table `#__mkv_companies_contacts_occupancy_new`;
insert into `#__mkv_companies_contacts_occupancy_new`
select null, id, 0, 0
from `#__mkv_companies`;
update `#__mkv_companies_contacts_occupancy_new` o
set o.for_building = (select ifnull(sum(c.for_building),0) from `#__mkv_companies_contacts` c where c.companyID = o.companyID);
update `#__mkv_companies_contacts_occupancy_new` o
set o.for_accreditation = (select ifnull(sum(c.for_accreditation),0) from `#__mkv_companies_contacts` c where c.companyID = o.companyID);
set foreign_key_checks = 1;
