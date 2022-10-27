# Homder-Base de datos
Ejecute el código en su consola SQL para la creación de la base de datos.
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
