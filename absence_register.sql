CREATE TABLE `antse_cool`.`absence_registers` (
  `student_id` varchar(128) NOT NULL,
  `module_id` varchar(128) NOT NULL,
  `date` DATE NOT NULL,
  FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;