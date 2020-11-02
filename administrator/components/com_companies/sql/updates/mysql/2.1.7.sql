alter table `#__mkv_companies_activities` drop foreign key `#__mkv_comp_activities_#__mkv_activities_activityID_fk`;

alter table `#__mkv_companies_activities`
    add constraint `#__mkv_comp_activities_#__mkv_activities_activityID_fk`
        foreign key (activityID) references `#__mkv_activities` (id)
            on update cascade on delete cascade;

alter table `#__mkv_companies_activities` drop foreign key `#__mkv_companies_activities_#__mkv_companies_companyID_fk`;

alter table `#__mkv_companies_activities`
    add constraint `#__mkv_companies_activities_#__mkv_companies_companyID_fk`
        foreign key (companyID) references `#__mkv_companies` (id)
            on update cascade on delete cascade;

