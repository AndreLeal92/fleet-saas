CREATE TABLE companies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    cnpj VARCHAR(20),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_id INT,
    name VARCHAR(120),
    email VARCHAR(120),
    password VARCHAR(255),
    role VARCHAR(50),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (company_id) REFERENCES companies(id)
);

CREATE TABLE vehicles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_id INT,
    plate VARCHAR(10),
    brand VARCHAR(100),
    model VARCHAR(100),
    year INT,
    fuel_type VARCHAR(50),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (company_id) REFERENCES companies(id)
);

CREATE TABLE drivers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_id INT,
    name VARCHAR(120),
    license_number VARCHAR(50),
    license_expiry DATE,
    FOREIGN KEY (company_id) REFERENCES companies(id)
);

CREATE TABLE fuel_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_id INT,
    vehicle_id INT,
    driver_id INT,
    liters DECIMAL(10,2),
    price_per_liter DECIMAL(10,2),
    total_cost DECIMAL(10,2),
    odometer INT,
    fuel_station VARCHAR(150),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (company_id) REFERENCES companies(id),
    FOREIGN KEY (vehicle_id) REFERENCES vehicles(id),
    FOREIGN KEY (driver_id) REFERENCES drivers(id)
);