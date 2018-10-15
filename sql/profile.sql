create table profile
	(
		id bigint auto_increment primary key ,
		firstName varchar(255) not null,
		lastName varchar(255),
		dob date,
		gender varchar(20),
		address varchar(255),
		country varchar(255),
		phone varchar(50) not null
	);

insert into profile (firstName,lastName,phone)
values('Amit','Kushwaha','7237007609');