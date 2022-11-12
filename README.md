# Homder-Base de datos
Ejecute el código en su consola SQL para la creación de la base de datos.
-------------------------------------------------------------------
```MySql
    create database Homder;
    use Homder;

    create table `users`(
        `id` int auto_increment,
        `name` varchar(100) not null ,
        `email` varchar(100) not null,
        `password` varchar(100) not null,
        'description' varchar(255),
        `profile-pic` varchar(255) default 'http://localhost/Homder/img/default-user.svg',

        primary key (`id`)
    );

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

    create table `post_images`(
        `id` int auto_increment,
        `file_name` varchar(255) not null,
        `uploaded_on` datetime not null,
        `status` enum('0', '1') default '1',
        `post_id` int,
        primary key (`id`),
        foreign key (post_id) references posts(id)
    );

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
