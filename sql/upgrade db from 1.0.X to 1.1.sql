--
-- Only run this to upgrade from 1.0.X to 1.1.X
-- This script will add profile table and make necessary modifications
-- Either copy into SQL command or use your application import tool
--

CREATE TABLE `profileT` (
  `profile_ID` int NOT NULL COMMENT 'Unique row ID',
  `profile_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'User-friendly profile name',
  `profile_description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Description of profile',
  `profile_active` int NOT NULL DEFAULT '1' COMMENT 'If 1 then GUI will display the profile',
  `profile_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date and time row was created'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='List of profiles to separate accounts';

INSERT INTO `profileT` (`profile_ID`, `profile_name`, `profile_description`, `profile_active`, `profile_created`) VALUES
(1, 'Default', 'The default profile', 1, '2022-07-30 12:26:27');

ALTER TABLE `accountsT` CHANGE `userID` `profile_ID` INT NOT NULL DEFAULT '1' COMMENT 'Links to profileT table';

ALTER TABLE `accountsT` ADD INDEX(`profile_ID`);

-- Done