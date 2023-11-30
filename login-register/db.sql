CREATE TABLE users(
    firstname VARCHAR(128) NOT NULL,
    midname VARCHAR(255) NOT NULL,
    surname VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    birthday date NULL,
    houseblockno VARCHAR(255) NOT NULL,
    street VARCHAR(255) NOT NULL,
    barangay VARCHAR(255) NOT NULL,
    municipality VARCHAR(255) NOT NULL,
    cityprovince VARCHAR(255) NOT NULL,
    zipcode VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    contactno VARCHAR(13) NOT NULL,
    password VARCHAR(255) NOT NULL
);