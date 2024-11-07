CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    book_id VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    reference_code VARCHAR(255) NOT NULL,
    booktitle VARCHAR(255) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);