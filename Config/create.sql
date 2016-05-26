
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- dealer_googletimezone
-- ---------------------------------------------------------------------

CREATE TABLE `dealer_googletimezone`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `dealer_id` INTEGER NOT NULL,
    `timezone` VARCHAR(255) NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    `version` INTEGER DEFAULT 0,
    `version_created_at` DATETIME,
    `version_created_by` VARCHAR(100),
    PRIMARY KEY (`id`),
    INDEX `FI_dealer_googletimezone_dealer_id` (`dealer_id`),
    CONSTRAINT `fk_dealer_googletimezone_dealer_id`
    FOREIGN KEY (`dealer_id`)
    REFERENCES `dealer` (`id`)
        ON UPDATE RESTRICT
        ON DELETE CASCADE
) ENGINE=InnoDB;


-- ---------------------------------------------------------------------
-- dealer_googletimezone_version
-- ---------------------------------------------------------------------

CREATE TABLE `dealer_googletimezone_version`
(
    `id` INTEGER NOT NULL,
    `dealer_id` INTEGER NOT NULL,
    `timezone` VARCHAR(255) NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    `version` INTEGER DEFAULT 0 NOT NULL,
    `version_created_at` DATETIME,
    `version_created_by` VARCHAR(100),
    `dealer_id_version` INTEGER DEFAULT 0,
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `dealer_googletimezone_version_FK_1`
    FOREIGN KEY (`id`)
    REFERENCES `dealer_googletimezone` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
