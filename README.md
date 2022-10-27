# Homder-Base de datos
Base de datos del sistema.
-------------------------------------------------------------------
```MySql
    create database Homder;

    use Homder;

    create table `user`(

        `id` int auto_increment,

        `name` varchar(100) not null ,

        `email` varchar(100) not null,

        `password` varchar(100) not null,

        primary key (`id`)

    )
```
