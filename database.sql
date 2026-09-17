CREATE TABLE IF NOT EXISTS faculty (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    department VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    phone VARCHAR(20),
    availability VARCHAR(255) DEFAULT 'Available'
);

CREATE TABLE IF NOT EXISTS appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(100) NOT NULL,
    student_email VARCHAR(150) NOT NULL,
    faculty_id INT NOT NULL,
    appointment_date DATE NOT NULL,
    appointment_time TIME NOT NULL,
    purpose TEXT NOT NULL,
    status ENUM('Pending','Approved','Rejected','Completed') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (faculty_id) REFERENCES faculty(id) ON DELETE CASCADE
);

INSERT IGNORE INTO faculty (id,name,department,email,phone,availability) VALUES
(1,'Dr. A. Sharma','Computer Science','asharma@example.com','9876543210','Mon-Fri, 10 AM - 4 PM'),
(2,'Prof. P. Verma','Artificial Intelligence','pverma@example.com','9876543211','Mon-Wed, 11 AM - 3 PM'),
(3,'Dr. S. Khan','Information Technology','skhan@example.com','9876543212','Tue-Fri, 12 PM - 5 PM');
