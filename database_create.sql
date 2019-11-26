DROP DATABASE IF EXISTS SoftwareManager;

CREATE DATABASE SoftwareManager CHARACTER SET utf8 COLLATE utf8_general_ci;

USE SoftwareManager;

-- Creating software table
CREATE TABLE Software (
  id CHAR(36) NOT NULL, -- 36 is the default size of the "GUID" we are using
  color CHAR(7) NOT NULL, -- 7 because it's the "#" and the 6 hex characters
  name VARCHAR(64) NOT NULL,
  logo VARCHAR(256) NOT NULL,
  description VARCHAR(512) NOT NULL,
  PRIMARY KEY(id)
);

-- Creating laboratories table
CREATE TABLE Laboratory (
  id CHAR(36) NOT NULL,
  name CHAR(64) NOT NULL,
  computers INT NOT NULL,
  PRIMARY KEY(id)
);

-- Creating softwares in laboratory table
CREATE TABLE SoftwareInLaboratory (
  id CHAR(36) NOT NULL,
  laboratoryId CHAR(36) NOT NULL,
  softwareId CHAR(36) NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY (laboratoryId) REFERENCES Laboratory(id) ON DELETE CASCADE,
  FOREIGN KEY (softwareId) REFERENCES Software(id) ON DELETE CASCADE
);

-- Creating users table
CREATE TABLE User (
  id CHAR(36) NOT NULL,
  name VARCHAR(64) NOT NULL,
  email VARCHAR(64) NOT NULL,
  password VARCHAR(64) NOT NULL,
  is_admin BOOLEAN NOT NULL DEFAULT false,
  PRIMARY KEY(id)
);