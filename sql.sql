create table users
(
	id int auto_increment
		primary key,
	username varchar(255) not null,
	password varchar(255) not null,
	constraint users_username_uindex
		unique (username)
);

create table rents
(
	id int auto_increment
		primary key,
	name varchar(255) not null,
	price decimal(8,2) not null,
	description text not null,
	user_id int not null
);
