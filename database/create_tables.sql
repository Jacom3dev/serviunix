-- Create database
CREATE DATABASE company;

-- Select the database
USE company;

CREATE TABLE department (
    id INT AUTO_INCREMENT PRIMARY KEY,
    departmentName VARCHAR(100) NOT NULL
);

CREATE TABLE gender (
    id INT AUTO_INCREMENT PRIMARY KEY,
    genderName VARCHAR(50) NOT NULL
);

CREATE TABLE employee (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(100) NOT NULL,
    lastName VARCHAR(100) NOT NULL,
    hireDate DATE NOT NULL,
    comments TEXT,
    genderId INT NOT NULL,
    departmentId INT NOT NULL,
    FOREIGN KEY (genderId) REFERENCES gender(id),
    FOREIGN KEY (departmentId) REFERENCES department(id)
);

CREATE TABLE expense (
    id INT AUTO_INCREMENT PRIMARY KEY,
    year INT NOT NULL,
    month INT NOT NULL,
    income DECIMAL(10, 2) NOT NULL,
    expense DECIMAL(10, 2) NOT NULL,
    departmentId INT NOT NULL,
    FOREIGN KEY (departmentId) REFERENCES department(id)
);

-- Insert some genders
INSERT INTO gender (genderName) VALUES ('Male');
INSERT INTO gender (genderName) VALUES ('Female');

-- Insert some departments
INSERT INTO department (departmentName) VALUES ('IT');
INSERT INTO department (departmentName) VALUES ('Customer Service');

-- Insert some employees
INSERT INTO employee (firstName, lastName, hireDate, comments, genderId, departmentId) 
VALUES ('Juan', 'Pérez', '2024-12-01', 'Outstanding employee', 1, 1);

INSERT INTO employee (firstName, lastName, hireDate, comments, genderId, departmentId) 
VALUES ('Maria', 'Gomez', '2023-05-15', 'Great team player', 2, 2);

INSERT INTO employee (firstName, lastName, hireDate, comments, genderId, departmentId) 
VALUES ('Carlos', 'Ramirez', '2022-02-10', 'Experienced developer', 1, 1);

INSERT INTO employee (firstName, lastName, hireDate, comments, genderId, departmentId) 
VALUES ('Ana', 'Martinez', '2021-07-20', 'Responsible and dedicated', 2, 1);

INSERT INTO employee (firstName, lastName, hireDate, comments, genderId, departmentId) 
VALUES ('Luis', 'Hernandez', '2020-09-15', 'Excellent communicator', 1, 2);

INSERT INTO employee (firstName, lastName, hireDate, comments, genderId, departmentId) 
VALUES ('Elena', 'Lopez', '2023-01-25', 'Great at problem solving', 2, 2);

INSERT INTO employee (firstName, lastName, hireDate, comments, genderId, departmentId) 
VALUES ('Pedro', 'Diaz', '2024-04-18', 'Strong analytical skills', 1, 1);

INSERT INTO employee (firstName, lastName, hireDate, comments, genderId, departmentId) 
VALUES ('Lucia', 'Fernandez', '2022-11-05', 'Team-oriented and proactive', 2, 2);

INSERT INTO employee (firstName, lastName, hireDate, comments, genderId, departmentId) 
VALUES ('Ricardo', 'Gonzalez', '2024-03-30', 'Great leadership qualities', 1, 1);

INSERT INTO employee (firstName, lastName, hireDate, comments, genderId, departmentId) 
VALUES ('Sofia', 'Perez', '2024-06-10', 'Creative and passionate', 2, 2);

-- Insert some expenses
INSERT INTO expense (year, month, income, expense, departmentId) 
VALUES (2024, 12, 50000.00, 30000.00, 1);

INSERT INTO expense (year, month, income, expense, departmentId) 
VALUES (2024, 12, 20000.00, 12000.00, 2);

INSERT INTO expense (year, month, income, expense, departmentId) 
VALUES (2024, 11, 45000.00, 28000.00, 1);

INSERT INTO expense (year, month, income, expense, departmentId) 
VALUES (2024, 11, 18000.00, 11000.00, 2);

INSERT INTO expense (year, month, income, expense, departmentId) 
VALUES (2024, 10, 48000.00, 29000.00, 1);

INSERT INTO expense (year, month, income, expense, departmentId) 
VALUES (2024, 10, 19000.00, 11500.00, 2);

INSERT INTO expense (year, month, income, expense, departmentId) 
VALUES (2024, 9, 47000.00, 27000.00, 1);

INSERT INTO expense (year, month, income, expense, departmentId) 
VALUES (2024, 9, 18500.00, 12500.00, 2);

INSERT INTO expense (year, month, income, expense, departmentId) 
VALUES (2024, 8, 46000.00, 28000.00, 1);

INSERT INTO expense (year, month, income, expense, departmentId) 
VALUES (2024, 8, 20000.00, 13000.00, 2);



-- Listado de todos los datos de los empleados del departamento "IT"
SELECT e.id, e.firstName, e.lastName, e.hireDate, e.comments, g.genderName, d.departmentName
FROM employee e
JOIN gender g ON e.genderId = g.id
JOIN department d ON e.departmentId = d.id
WHERE d.departmentName = 'IT';

-- Listado de los 3 departamentos que más gastos producen
SELECT d.departmentName, SUM(e.expense) AS total_expenses
FROM expense e
JOIN department d ON e.departmentId = d.id
GROUP BY d.departmentName
ORDER BY total_expenses DESC
LIMIT 3;


-- Listado de datos del empleado con mayor salario
SELECT e.id, e.firstName, e.lastName, e.hireDate, e.comments, g.genderName, d.departmentName, ex.income AS salary
FROM employee e
JOIN gender g ON e.genderId = g.id
JOIN department d ON e.departmentId = d.id
JOIN expense ex ON ex.departmentId = e.departmentId
ORDER BY ex.income DESC
LIMIT 1;

-- Cantidad de empleados con salarios menores a 1,500,000
SELECT COUNT(*) AS num_employees
FROM employee e
JOIN expense ex ON e.departmentId = ex.departmentId
WHERE ex.income < 1500000;
