CREATE TABLE notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)ENGINE=InnoDB CHARSET=utf8;

INSERT INTO notes (content) VALUES ('Buy groceries for the week.');
INSERT INTO notes (content) VALUES ('Read chapters 4 and 5 of the React documentation.');
INSERT INTO notes (content) VALUES ('Book an appointment with the dentist.');