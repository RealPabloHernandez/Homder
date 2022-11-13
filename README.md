# Homder — Base de datos
Ejecute los códigos en el apartado de comandos de su MySql para ejecutar con éxito Homder.
-------------------------------------------------------------------
```MySql
    create database Homder;
    use Homder;
```
Tabla de usuarios
```MySql
    create table `users`(
        `id` int auto_increment,
        `name` varchar(100) not null ,
        `email` varchar(100) not null,
        `password` varchar(100) not null,
        `description` varchar(255),
        `phone` varchar(15),
        `profile-pic` varchar(255) default 'default-user.svg',

        primary key (`id`)
    );
```
Tabla de publicaciones
```MySql
    create table `posts`(
        `id` int auto_increment,
        `title` varchar(100) not null ,
        `description` varchar(500) not null,
        `location` varchar(120),
        `price` varchar(20) not null ,
        `rooms` int,
        `bathrooms` int,
        `innerArea` decimal,
        `outerArea` decimal,
        `userID`  int,
        primary key (id),
        foreign key (userid) REFERENCES users(id)
    );
```
Tabla de imágenes de publicaciones
```MySql
    create table `post_images`(
        `id` int auto_increment,
        `file_name` varchar(255) not null,
        `uploaded_on` datetime not null,
        `status` enum('0', '1') default '1',
        `post_id` int,
        primary key (`id`),
        foreign key (post_id) references posts(id)
    );
```

Tabla de calificaciones de usuario
```MySql
    create table `ratings`(
        `id` int auto_increment,
        `rating` int default 0,
        `user_id` int,
        `target_id` int,
        PRIMARY KEY (id),
        FOREIGN KEY (user_id) references users(id),
        FOREIGN KEY (target_id) references users(id)
    );
```


