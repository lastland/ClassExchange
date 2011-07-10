/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/*==============================================================*/


drop table if exists class_wanted;

drop table if exists classes;

drop table if exists classtime;

drop table if exists classtime_wanted;

drop table if exists exchanges;

drop table if exists takes;

drop table if exists teachers;

drop table if exists teaches;

drop table if exists users;

/*==============================================================*/
/* Table: class_wanted                                          */
/*==============================================================*/
create table class_wanted
(
   exchange_id          int not null,
   class_id             int not null,
   primary key (exchange_id, class_id)
);

/*==============================================================*/
/* Table: classes                                               */
/*==============================================================*/
create table classes
(
   class_id             int not null auto_increment,
   class_name           varchar(64) not null,
   class_type           varchar(64) not null,
   class_introduction   text,
   class_remark         text,
   primary key (class_id)
);

/*==============================================================*/
/* Table: classtime                                             */
/*==============================================================*/
create table classtime
(
   classtime_id         int not null auto_increment,
   start_time           smallint not null,
   end_time             smallint not null,
   day_in_week          smallint not null,
   primary key (classtime_id)
);

/*==============================================================*/
/* Table: classtime_wanted                                      */
/*==============================================================*/
create table classtime_wanted
(
   exchange_id          int not null,
   classtime_id         int not null,
   primary key (exchange_id, classtime_id)
);

/*==============================================================*/
/* Table: exchanges                                             */
/*==============================================================*/
create table exchanges
(
   exchange_id          int not null auto_increment,
   class_id             int not null,
   exc_exchange_id      int,
   user_id              int not null,
   exc_exchange_id2     int,
   exc_exchange_id3     int,
   exchange_remark      text,
   exchange_status      smallint not null default 0,
   primary key (exchange_id)
);

/*==============================================================*/
/* Table: takes                                                 */
/*==============================================================*/
create table takes
(
   class_id             int not null,
   classtime_id         int not null,
   primary key (class_id, classtime_id)
);

/*==============================================================*/
/* Table: teachers                                              */
/*==============================================================*/
create table teachers
(
   teacher_id           int not null auto_increment,
   teacher_name         varchar(64) not null,
   teacher_introdution  text,
   primary key (teacher_id)
);

/*==============================================================*/
/* Table: teaches                                               */
/*==============================================================*/
create table teaches
(
   teacher_id           int not null,
   class_id             int not null,
   primary key (teacher_id, class_id)
);

/*==============================================================*/
/* Table: users                                                 */
/*==============================================================*/
create table users
(
   user_id              int not null auto_increment,
   authority            smallint not null default 0,
   user_name            varchar(64) not null,
   user_password        varchar(64) not null,
   user_description     text,
   user_good_eval       int default 0,
   user_bad_eval        int default 0,
   user_mobile          varchar(64) not null,
   user_email           varchar(64),
   primary key (user_id)
);

alter table class_wanted add constraint FK_class_wanted foreign key (exchange_id)
      references exchanges (exchange_id) on delete restrict on update restrict;

alter table class_wanted add constraint FK_exchange_wanted_for_class foreign key (class_id)
      references classes (class_id) on delete restrict on update restrict;

alter table classtime_wanted add constraint FK_classtime_wanted foreign key (exchange_id)
      references exchanges (exchange_id) on delete restrict on update restrict;

alter table classtime_wanted add constraint FK_exchange_wanted_for_classti foreign key (classtime_id)
      references classtime (classtime_id) on delete restrict on update restrict;

alter table exchanges add constraint FK_class_for_exchange foreign key (class_id)
      references classes (class_id) on delete restrict on update restrict;

alter table exchanges add constraint FK_exchange_compete_for_another foreign key (exc_exchange_id)
      references exchanges (exchange_id) on delete restrict on update restrict;

alter table exchanges add constraint FK_exchanges_of_user foreign key (user_id)
      references users (user_id) on delete restrict on update restrict;

alter table exchanges add constraint FK_final_competitor foreign key (exc_exchange_id2)
      references exchanges (exchange_id) on delete restrict on update restrict;

alter table exchanges add constraint FK_final_host foreign key (exc_exchange_id3)
      references exchanges (exchange_id) on delete restrict on update restrict;

alter table takes add constraint FK_class_of_classtime foreign key (classtime_id)
      references classtime (classtime_id) on delete restrict on update restrict;

alter table takes add constraint FK_classtime_of_class foreign key (class_id)
      references classes (class_id) on delete restrict on update restrict;

alter table teaches add constraint FK_class_of_teacher foreign key (teacher_id)
      references teachers (teacher_id) on delete restrict on update restrict;

alter table teaches add constraint FK_teacher_of_class foreign key (class_id)
      references classes (class_id) on delete restrict on update restrict;

