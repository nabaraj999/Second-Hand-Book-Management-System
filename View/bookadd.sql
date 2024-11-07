CREATE TABLE bookadd (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    isbn VARCHAR(13) NOT NULL UNIQUE,
    price DECIMAL(10, 2) NOT NULL,
    published_date DATE NOT NULL,
    category VARCHAR(255) NOT NULL,
    cover VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    language VARCHAR(255) NOT NULL,
    pages INT NOT NULL;
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
