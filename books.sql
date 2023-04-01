CREATE TABLE books (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
    title VARCHAR (100) NOT NULL UNIQUE, 
    price DOUBLE NOT NULL, 
    quantity INT NOT NULL, 
    flag VARCHAR (5) NOT NULL
);

INSERT INTO books (title, price, quantity, flag)
VALUES
('Of Mice and Men', 12.99, 3, false),
('To Kill a Mockingbird', 15.99, 2, false),
('Gone with the Wind', 18.99, 5, false);