-- CREATE DATABASE
CREATE DATABASE WebsiteProject;
GO

-- USE DATABASE
USE WebsiteProject;
GO


/* ==============================
   TABLE: U (Users)
   ============================== */
CREATE TABLE U (
    id INT IDENTITY(1,1) PRIMARY KEY,
    uname VARCHAR(255) NOT NULL,
    mail VARCHAR(255) NOT NULL,
    pass VARCHAR(255) NOT NULL
);
GO


/* ==============================
   TABLE: B (Bookings)
   ============================== */
CREATE TABLE B (
    id INT IDENTITY(1,1) PRIMARY KEY,
    user_id INT NOT NULL,
    hotel_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    headcount INT NULL,
    date_start DATE NOT NULL,
    date_end DATE NOT NULL,
    inquiry VARCHAR(MAX) NULL,
    price INT NOT NULL,
    img_folder VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT GETDATE(),

    CONSTRAINT FK_B_U FOREIGN KEY (user_id) REFERENCES U(id)
);
GO


ALTER TABLE B
ADD total_price INT NULL;
