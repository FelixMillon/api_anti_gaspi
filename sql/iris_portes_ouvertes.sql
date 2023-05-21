drop database if exists iris_portes_ouvertes; 
create database iris_portes_ouvertes; 
use iris_portes_ouvertes; 

create table etudiant (
	idetudiant int (3) not null auto_increment, 
	nom varchar (50), 
	prenom varchar(50),
	email varchar(50), 
	mdp varchar(50),
	tel varchar(20), 
	primary key (idetudiant)
);

create table porte (
	idporte int (3) not null auto_increment,
	dateporte date , 
	horaire varchar(30), 
	description text, 
	statut enum ("distanciel", "presentiel"), 
	lieu enum ("école", "hors école"),
	primary key (idporte)
);
create table inscription (
	idinscription int (3) not null auto_increment,
	dateinscription date, 
	idetudiant int(3) not null, 
	idporte int(3) not null,
	primary key(idinscription), 
	foreign key (idetudiant) references etudiant (idetudiant),
	foreign key (idporte) references porte (idporte)
);

insert into etudiant values 
(null,"Anais", "Abass","a@gmail.com", "123", "07676767"), 
(null,"Ché", "Mahdi","c@gmail.com", "123", "03434334"),
(null,"Yanis", "Tom","y@gmail.com", "123", "067676");

insert into porte values 
(null, "2023-03-15","10h - 15h", "BTS SIO",
	"presentiel","école"), 
(null, "2023-04-10","10h - 15h", "Mastere",
	"distanciel","école");

insert into inscription values
(null, sysdate(), 1, 1), (null, sysdate(), 1, 2), 
(null, sysdate(), 3, 2), (null, sysdate(), 3, 1);

create view lesPortes as (
	select p.*, e.email, e.idetudiant, ins.dateinscription
	from etudiant e, porte p, inscription ins 
	where e.idetudiant = ins.idetudiant
	and p.idporte = ins.idporte
); 




