create table user (
  id INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(320) NOT NULL UNIQUE,
  name VARCHAR(64) NOT NULL,
  lastname VARCHAR(64) NOT NULL,
  password CHAR(32) NOT NULL,
  phone VARCHAR(25) NOT NULL,
  role VARCHAR(10) NOT NULL DEFAULT 'Editor',
  PRIMARY KEY (id)
);


create table ads (
  id INT NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  body VARCHAR(2200),
  imageName CHAR(32),
  imageType ENUM('jpg', 'png', 'jpeg', 'webp'),
  ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  id_user INT NOT NULL,
  FOREIGN KEY (id_user) REFERENCES user(id),
  PRIMARY KEY (id)
);
--  password 1231231
INSERT INTO `user` (`id`, `email`, `name`, `lastname`, `password`, `phone`, `role`) VALUES (NULL, 'root@dev.com', 'Nero', 'Dante', '8d4646eb2d7067126eb08adb0672f7bb', '+1(111)-111-11-11', 'Admin');