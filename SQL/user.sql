CREATE DATABASE blog;

use blog;

create TABLE `user` (
    Id int AUTO_INCREMENT PRIMARY KEY,
    Login varchar(50),
    Email varchar(50),
    `Password` varchar(50),
    `urlAvatar` varchar(255),
    `Role` varchar(50) DEFAULT 'follower'
);

CREATE TABLE record  (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Id_autor INT,
    `Date` VARCHAR(25),
    Status VARCHAR(25) default 'not approved',
    Text LONGTEXT,
    `Like` INT default 0,
    `DisLike` INT default 0
    )


create table comment(
    Id INT AUTO_INCREMENT PRIMARY KEY,
    IdAutor int,
    IdRecord int,
    `Date` VARCHAR(25),
    Status boolean,
    Text LONGTEXT,
    `Like` INT default 0,
    `DisLike` INT default 0
    )