CREATE TABLE `antse_cool`.`scheldules` (
  `module_id` varchar(128) NOT NULL, 
  `group_id` INT NOT NULL,
  `date` DATE NOT NULL,
  `begin_at`TIME NOT NULL,
  `end_at` TIME NOT NULL,
  FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`), 
  FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci; 