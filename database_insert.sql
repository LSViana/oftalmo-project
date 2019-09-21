USE SoftwareManager;

-- Wipe database
DELETE FROM Software WHERE true;
DELETE FROM Laboratory WHERE true;
DELETE FROM User WHERE true;

-- Insert users
-- TODO

-- Insert softwares
INSERT INTO `Software` (`id`, `color`, `name`, `logo`, `description`) VALUES
('421DAE6E-A6CD-476B-9A56-4720A496C419', '#ff0000', 'YouTube', 'https://i.pinimg.com/originals/de/1c/91/de1c91788be0d791135736995109272a.png', 'YouTube is an American video-sharing website headquartered in San Bruno, California. Three former PayPal employeesâ€”Chad Hurley, Steve Chen, and Jawed Karimâ€”created the service in February 2005.'),
('99657978-22DA-4C61-9116-75EA16136F77', '#2360cf', 'Word', 'https://upload.wikimedia.org/wikipedia/commons/4/48/Microsoft_Word_logo.png', 'Microsoft Word is a word processor developed by Microsoft. It was first released on October 25, 1983 under the name Multi-Tool Word for Xenix systems.'),
('ECF6A8C3-9192-497F-A2E2-8F56664FF31C', '#5573ec', 'Visual Studio Code', 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Visual_Studio_Code_1.35_icon.svg/1200px-Visual_Studio_Code_1.35_icon.svg.png', 'Visual Studio Code is a source-code editor developed by Microsoft for Windows, Linux and macOS. It includes support for debugging, embedded Git control and GitHub, syntax highlighting, intelligent code completion, snippets, and code refactoring.');

-- Insert laboratories
INSERT INTO `Laboratory` (`id`, `name`, `computers`, `softwares`) VALUES
('E35E3E35-F657-473C-AFA3-7EDFEC85EB91', 'LaboratÃ³rio 1', 32, '[\"421DAE6E-A6CD-476B-9A56-4720A496C419\",\"99657978-22DA-4C61-9116-75EA16136F77\"]'),
('EE46319D-74C4-4278-B31C-B3B2ACA769E9', 'LaboratÃ³rio 2', 12, '[\"ECF6A8C3-9192-497F-A2E2-8F56664FF31C\"]');