DROP TABLE IF EXISTS `antse_cool`.`teachers`;
CREATE TABLE `antse_cool`.`teachers` (
    `teacher_id` INT NOT NULL AUTO_INCREMENT,
    `teacher_fistName` VARCHAR(128) NOT NULL,
    `teacher_lastName` VARCHAR(128) NOT NULL,
    `teacher_email` VARCHAR(128) NOT NULL,
    `add_at` DATE NOT NULL,
    `teacher_state` INT NOT NULL DEFAULT 1,
    PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `antse_cool`.`modules`;
CREATE TABLE `antse_cool`.`modules` (
    `module_id` VARCHAR(128) NOT NULL,
    `module_name` VARCHAR(128) NOT NULL,
    `module_state` INT NOT NULL DEFAULT 1,
    PRIMARY KEY (`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `antse_cool`.`groups`;
CREATE TABLE `antse_cool`.`groups` (
    `group_id` INT NOT NULL AUTO_INCREMENT,
    `group_name` VARCHAR(128) NOT NULL,
    PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `antse_cool`.`teacher_modules`;
CREATE TABLE `antse_cool`.`teacher_modules` (
    `teacherMod_id` INT NOT NULL AUTO_INCREMENT,
    `module_id` VARCHAR(128) NOT NULL,
    `teacher_id` INT NOT NULL,
    `group_id` INT NOT NULL,
    PRIMARY KEY (`teacherMod_id`),
    FOREIGN KEY (`module_id`) REFERENCES `antse_cool`.`modules`(`module_id`),
    FOREIGN KEY (`teacher_id`) REFERENCES `antse_cool`.`teachers`(`teacher_id`),
    FOREIGN KEY (`group_id`) REFERENCES `antse_cool`.`groups`(`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `antse_cool`.`students`;
CREATE TABLE `antse_cool`.`students` (
    `student_id` VARCHAR(128) NOT NULL,
    `student_firstName` VARCHAR(128) NOT NULL,
    `student_lastName` VARCHAR(128) NOT NULL,
    `student_email` VARCHAR(128) NOT NULL,
    `group_id` INT NOT NULL,
    `add_at` DATE NOT NULL,
    `student_state` INT NOT NULL DEFAULT 1,
    PRIMARY KEY (`student_id`),
    FOREIGN KEY (`group_id`) REFERENCES `antse_cool`.`groups`(`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `antse_cool`.`grades`;
CREATE TABLE `antse_cool`.`grades` (
    `grade_id` INT NOT NULL AUTO_INCREMENT,
    `student_id` VARCHAR(128) NOT NULL,
    `module_id` VARCHAR(128) NOT NULL,
    PRIMARY KEY (`grade_id`),
    FOREIGN KEY (`student_id`) REFERENCES `antse_cool`.`students`(`student_id`),
    FOREIGN KEY (`module_id`) REFERENCES `antse_cool`.`modules`(`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;