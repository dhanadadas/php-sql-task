CREATE TABLE `users` (
`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
   `name`     VARCHAR(255) DEFAULT NULL,
   `gender` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0 - неуказан, 1 - мужчина, 2 - женщина.',
   `birth_date`   INT(11) NOT NULL COMMENT 'Дата в unixtime.',
   PRIMARY KEY (`id`)
);
CREATE TABLE `phone_numbers` (
`id`      INT(11) NOT NULL AUTO_INCREMENT,
   `user_id`  INT(11) UNSIGNED NOT NULL,
   `phone`    VARCHAR(255) DEFAULT NULL,
   PRIMARY KEY (`id`),
    INDEX `index_foreignkey_phone_numbers_users` (`user_id`)  USING BTREE,
FOREIGN KEY (user_id) REFERENCES users(id)
); 

SELECT name as "имя", count(phone_numbers.user_id) as "количество телефонов"
    FROM users LEFT JOIN phone_numbers ON users.id=phone_numbers.user_id 
    WHERE `gender` = 2 AND `birth_date` BETWEEN (UNIX_TIMESTAMP()-(31536000*22)) AND (UNIX_TIMESTAMP()-568025136) group by users.id