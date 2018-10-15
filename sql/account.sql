create table account
	(
	 uid bigint not null,
	 email varchar(255) primary key,
	 passward varchar(255),
	 FOREIGN KEY (uid) REFERENCES profile(id)
	);

insert into account
	values(1,'ak9067007327@gmail.com','1234');