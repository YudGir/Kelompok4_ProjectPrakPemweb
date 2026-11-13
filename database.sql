CREATE DATABASE IF NOT EXISTS db_lootswap;
USE db_lootswap;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    nama_item VARCHAR(100) NOT NULL,
    nama_game VARCHAR(50) NOT NULL,
    item_dicari VARCHAR(100) NOT NULL,
    kontak VARCHAR(100) NOT NULL,
    status VARCHAR(20) DEFAULT 'Tersedia',
    gambar VARCHAR(255) DEFAULT 'default.png',
    CONSTRAINT fk_user_item FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
