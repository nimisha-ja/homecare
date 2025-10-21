ALTER TABLE `staff` ADD `passport_no` VARCHAR(255) NOT NULL AFTER `passport_file`;
ALTER TABLE staff
    ADD passport_expiry DATE,
    ADD dbs_expiry DATE,
    ADD training_expiry DATE;
ALTER TABLE `clients` ADD `special_weekday_day` DECIMAL(10,2) NULL DEFAULT NULL AFTER `special_rate_above_8hrs`, ADD `special_weekday_night` DECIMAL(10,2) NULL DEFAULT NULL AFTER `special_weekday_day`, ADD `special_weekend_day` DECIMAL(10,2) NULL DEFAULT NULL AFTER `special_weekday_night`, ADD `special_weekend_night` DECIMAL(10,2) NULL DEFAULT NULL AFTER `special_weekend_day`, ADD `special_bank_holiday` DECIMAL(10,2) NULL DEFAULT NULL AFTER `special_weekend_night`, ADD `special_early_shift` DECIMAL(10,2) NULL DEFAULT NULL AFTER `special_bank_holiday`, ADD `special_late_shift` DECIMAL(10,2) NULL DEFAULT NULL AFTER `special_early_shift`;