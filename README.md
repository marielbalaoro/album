# SONG LYRICS CRUD
# Docker-PHP-MySql
```
- docker 24.0.7
- docker-compose 1.25.4
- php 8
- MySQL 8.2
```
## Getting Started 🚀
```
# Clone this repository
1. $git clone https://github.com/marielbalaoro/docker-php-crud.git

# RUN this command
2. cd docker-php-crud
3. docker-compose up -d

# access phpMyAdmin
4. http://localhost:8081

`username: devuser`
`password`: devpass`

# access web
5. http://localhost:8000

6. create table in crud_db database
```
CREATE TABLE `songs` (
    `id` int NOT NULL,
    `title` varchar(100) NOT NULL,
    `artist` varchar(100) NOT NULL,
    `lyrics` longtext NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
ALTER TABLE `songs`
ADD PRIMARY KEY (`id`);
ALTER TABLE `songs`
MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
```
```
&copy; 2024 - developed by <a href="https://github.com/marielbalaoro">Mariel</a>.
