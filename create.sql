/*
Carlos Munoz
final
INFO_1335_4A
Rosas
5-26-2021
*/

--Delete grades_db if it already exists --
DROP DATABASE IF EXISTS grades_db;

--Create grades_db database --
CREATE DATABASE grades_db;

--Select grades_db database --
USE grades_db;

-- Create `class` table with attributes and keys --
CREATE TABLE `class` (
    `class_id` INT NOT NULL AUTO_INCREMENT,
    `dept` CHAR(4),
    `num` INT,
    `section` CHAR(2),
    `name` VARCHAR(45),
    `semester` CHAR(2),
    `year` INT,
    PRIMARY KEY (`class_id`)
);

-- Create `assignment` table with attributes and keys --
CREATE TABLE `assignment` (
  `grade_id` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(45),
  `pt_possible` INT,
  `pt_earn` DECIMAL,
  `class_id` INT,
  PRIMARY KEY (`grade_id`),
  CONSTRAINT `fk_assignment_class`
    FOREIGN KEY (`class_id`)
    REFERENCES `class` (`class_id`)
);

-- Add 3 classes into the `class` table --
INSERT INTO class (dept, num, section, name, semester, year)
    VALUES 
    ('info', 1001, 'ww', 'JavaScript I', 'SP', 2021),
    ('info', 1002, 'ws', 'JavaScript II', 'SP', 2021),
    ('info', 1003, 'wv', 'JavaScript III', 'SP', 2021);

-- Add 5 assignments for each of the 3 classes added --
INSERT INTO assignment (description, pt_possible, pt_earn, class_id)
    VALUES
    ('Assgnment 1', 100, 75, 1),
    ('Assgnment 2', 100, 75, 1),
    ('Assgnment 3', 100, 75, 1),
    ('Assgnment 4', 100, 75, 1),
    ('Assgnment 5', 100, 75, 1),
    ('Assgnment 1', 100, 75, 2),
    ('Assgnment 2', 100, 75, 2),
    ('Assgnment 3', 100, 75, 2),
    ('Assgnment 4', 100, 75, 2),
    ('Assgnment 5', 100, 75, 2),
    ('Assgnment 1', 100, 75, 3),
    ('Assgnment 2', 100, 75, 3),
    ('Assgnment 3', 100, 75, 3),
    ('Assgnment 4', 100, 75, 3),
    ('Assgnment 5', 100, 75, 3);

-- Delete user and privileges for carlos@localhost if it already exist --
DROP user carlos@localhost;
FLUSH privileges;

-- Create user carlos@localhost and a password -- 
CREATE USER carlos@localhost IDENTIFIED BY 'mCC**$';

-- Grant privileges to carlos@localhost --
GRANT SELECT, INSERT, UPDATE
ON *.* TO carlos@localhost;