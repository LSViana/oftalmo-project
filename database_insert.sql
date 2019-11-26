USE SoftwareManager;

-- Wipe database
DELETE FROM Software WHERE id != '';
DELETE FROM Laboratory WHERE id != '';
DELETE FROM SoftwareInLaboratory WHERE id != '';
DELETE FROM User WHERE id != '';

-- Insert users
INSERT INTO `User` (`id`, `name`, `email`, `password`, `is_admin`) VALUES
('f302961c-3183-4479-a7b9-957d51df2b58', 'Lucas Viana', 'lucas@gmail.com', 'Asdf1234', true),
('aa0866da-73be-44b1-80ba-3c66ef20c62e', 'Matheus Moreira', 'matheus@gmail.com', 'Asdf1234', false);


-- Insert softwares
INSERT INTO `Software` (`id`, `color`, `name`, `logo`, `description`) VALUES
('421DAE6E-A6CD-476B-9A56-4720A496C419', '#ff0000', 'YouTube', 'https://i.pinimg.com/originals/de/1c/91/de1c91788be0d791135736995109272a.png', 'YouTube is an American video-sharing website headquartered in San Bruno, California. Three former PayPal employeesâ€”Chad Hurley, Steve Chen, and Jawed Karimâ€”created the service in February 2005.'),
('99657978-22DA-4C61-9116-75EA16136F77', '#2360cf', 'Word', 'https://upload.wikimedia.org/wikipedia/commons/4/48/Microsoft_Word_logo.png', 'Microsoft Word is a word processor developed by Microsoft. It was first released on October 25, 1983 under the name Multi-Tool Word for Xenix systems.'),
('ECF6A8C3-9192-497F-A2E2-8F56664FF31C', '#5573ec', 'Visual Studio Code', 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Visual_Studio_Code_1.35_icon.svg/1200px-Visual_Studio_Code_1.35_icon.svg.png', 'Visual Studio Code is a source-code editor developed by Microsoft for Windows, Linux and macOS. It includes support for debugging, embedded Git control and GitHub, syntax highlighting, intelligent code completion, snippets, and code refactoring.');

-- Insert laboratories
INSERT INTO `Laboratory` (`id`, `name`, `computers`) VALUES
('E35E3E35-F657-473C-AFA3-7EDFEC85EB91', 'Laboratório 1', 32),
('EE46319D-74C4-4278-B31C-B3B2ACA769E9', 'Laboratório 2', 12);

-- Insert softwares in laboratories
INSERT INTO `SoftwareInLaboratory` (`id`, `softwareId`, `laboratoryId`) VALUES
('521DAE6E-A6CD-476B-9A56-4720A496C419', '421DAE6E-A6CD-476B-9A56-4720A496C419', 'E35E3E35-F657-473C-AFA3-7EDFEC85EB91'),
('621DAE6E-A6CD-476B-9A56-4720A496C419', '99657978-22DA-4C61-9116-75EA16136F77', 'E35E3E35-F657-473C-AFA3-7EDFEC85EB91'),
('721DAE6E-A6CD-476B-9A56-4720A496C419', 'ECF6A8C3-9192-497F-A2E2-8F56664FF31C', 'EE46319D-74C4-4278-B31C-B3B2ACA769E9');