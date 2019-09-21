DROP DATABASE IF EXISTS SoftwareManager;

CREATE DATABASE SoftwareManager;

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
  softwares VARCHAR(1100) NOT NULL, -- 1100 is a value to make sure no overflow or data truncation will happen
  PRIMARY KEY(id)
);

-- Creating users table
CREATE TABLE user (
  id CHAR(36) NOT NULL,
  name VARCHAR(64) NOT NULL,
  email VARCHAR(64) NOT NULL,
  password VARCHAR(64) NOT NULL,
  is_admin BOOLEAN NOT NULL DEFAULT false,
  PRIMARY KEY(id)
);