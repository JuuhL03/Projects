create database z4hub
use z4hub

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password CHAR(25) NOT NULL,  
    email VARCHAR(250) NOT NULL,
    created_at DATETIME,
    account_status VARCHAR(2),
    user_plan VARCHAR(10)
);

CREATE TABLE client (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    document VARCHAR(15),
    name_client VARCHAR(250) NOT NULL,
    created_at DATETIME,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE objects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name_object VARCHAR(250) NOT NULL,
    client_id INT NOT NULL,
    value FLOAT,
    created_at DATETIME,
    FOREIGN KEY (client_id) REFERENCES users(id)
);
