
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- administrators
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `administrators`;

CREATE TABLE `administrators`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(64),
    `password` VARCHAR(96),
    `display_name` VARCHAR(64),
    `last_login` DATETIME,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- chats
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `chats`;

CREATE TABLE `chats`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_transmitter` INTEGER,
    `id_receiver` INTEGER,
    `message` TEXT,
    `transmitter_date_sent` DATETIME,
    `transmitter_date_reading` DATETIME,
    `receiver_date_sent` DATETIME,
    `receiver_date_reading` DATETIME,
    `archived_transmitter` TINYINT(1) DEFAULT 0,
    `archived_receiver` TINYINT(1) DEFAULT 0,
    `attachment_file` VARCHAR(64),
    `attachment_group` BIGINT,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- commerces
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `commerces`;

CREATE TABLE `commerces`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_user` INTEGER,
    `id_position_commerce` INTEGER,
    `id_heading_commerce` INTEGER,
    `id_province` INTEGER,
    `id_locality` INTEGER,
    `token` TEXT,
    `logo` VARCHAR(64),
    `business_name` VARCHAR(96),
    `cuit_cuil` VARCHAR(48),
    `name` VARCHAR(64),
    `phone` VARCHAR(16),
    `phone_personal` VARCHAR(16),
    `email` VARCHAR(64),
    `password` VARCHAR(96),
    `address` VARCHAR(255),
    `address_lat` VARCHAR(64),
    `address_lng` VARCHAR(64),
    `address_locality` VARCHAR(64),
    `address_region` VARCHAR(64),
    `address_country` VARCHAR(24),
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `id_position_commerce` (`id_position_commerce`),
    INDEX `id_heading_commerce` (`id_heading_commerce`),
    INDEX `id_province` (`id_province`),
    INDEX `id_locality` (`id_locality`),
    CONSTRAINT `commerces_ibfk_1`
        FOREIGN KEY (`id_position_commerce`)
        REFERENCES `positions_commerce` (`id`)
        ON UPDATE CASCADE
        ON DELETE SET NULL,
    CONSTRAINT `commerces_ibfk_2`
        FOREIGN KEY (`id_heading_commerce`)
        REFERENCES `headings_commerce` (`id`)
        ON UPDATE CASCADE
        ON DELETE SET NULL,
    CONSTRAINT `commerces_ibfk_3`
        FOREIGN KEY (`id_province`)
        REFERENCES `provinces` (`id`)
        ON UPDATE CASCADE
        ON DELETE SET NULL,
    CONSTRAINT `commerces_ibfk_4`
        FOREIGN KEY (`id_locality`)
        REFERENCES `provinces_localities` (`id`)
        ON UPDATE CASCADE
        ON DELETE SET NULL
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- commerces_branch_offices
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `commerces_branch_offices`;

CREATE TABLE `commerces_branch_offices`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_commerce` INTEGER,
    `name` VARCHAR(64),
    `address` VARCHAR(96),
    `registered_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `id_commerce` (`id_commerce`),
    CONSTRAINT `commerces_branch_offices_ibfk_1`
        FOREIGN KEY (`id_commerce`)
        REFERENCES `commerces` (`id`)
        ON UPDATE CASCADE
        ON DELETE SET NULL
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- commerces_clients
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `commerces_clients`;

CREATE TABLE `commerces_clients`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_commerce` INTEGER,
    `id_locality` INTEGER,
    `id_province` INTEGER,
    `fullname` VARCHAR(64),
    `email` VARCHAR(64),
    `address` VARCHAR(96),
    `phone` VARCHAR(16),
    `registered_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `id_locality` (`id_locality`),
    INDEX `id_province` (`id_province`),
    CONSTRAINT `commerces_clients_ibfk_1`
        FOREIGN KEY (`id_locality`)
        REFERENCES `provinces_localities` (`id`)
        ON UPDATE CASCADE
        ON DELETE SET NULL,
    CONSTRAINT `commerces_clients_ibfk_2`
        FOREIGN KEY (`id_province`)
        REFERENCES `provinces` (`id`)
        ON UPDATE CASCADE
        ON DELETE SET NULL
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- commerces_preferences
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `commerces_preferences`;

CREATE TABLE `commerces_preferences`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_commerce` INTEGER,
    `max_offers` INTEGER,
    `send_mails` TINYINT(1),
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `id_commerce` (`id_commerce`),
    CONSTRAINT `commerces_preferences_ibfk_1`
        FOREIGN KEY (`id_commerce`)
        REFERENCES `commerces` (`id`)
        ON UPDATE CASCADE
        ON DELETE SET NULL
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- commerces_rates
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `commerces_rates`;

CREATE TABLE `commerces_rates`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_commerce` INTEGER,
    `name` VARCHAR(64),
    `km` FLOAT,
    `price` DECIMAL(10,2),
    `registered_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `id_commerce` (`id_commerce`),
    CONSTRAINT `commerces_rates_ibfk_1`
        FOREIGN KEY (`id_commerce`)
        REFERENCES `commerces` (`id`)
        ON UPDATE CASCADE
        ON DELETE SET NULL
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- commerces_reminders
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `commerces_reminders`;

CREATE TABLE `commerces_reminders`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_commerce` INTEGER,
    `icon` VARCHAR(48),
    `title` VARCHAR(64),
    `content` VARCHAR(96),
    `registered_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `commerces_reminders_ibfk_1` (`id_commerce`),
    CONSTRAINT `commerces_reminders_ibfk_1`
        FOREIGN KEY (`id_commerce`)
        REFERENCES `commerces` (`id`)
        ON UPDATE CASCADE
        ON DELETE SET NULL
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- commerces_shipments
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `commerces_shipments`;

CREATE TABLE `commerces_shipments`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_commerce` INTEGER,
    `id_rate` INTEGER,
    `id_shipment` INTEGER,
    `uuid` VARCHAR(48),
    `pickup_at_name` VARCHAR(255),
    `pickup_at_lat` VARCHAR(32),
    `pickup_at_lng` VARCHAR(32),
    `pickup_at_locality` VARCHAR(64),
    `pickup_at_region` VARCHAR(56),
    `pickup_at_country` VARCHAR(48),
    `size` VARCHAR(8),
    `priority` INTEGER,
    `type` INTEGER,
    `type_rate` INTEGER,
    `description` VARCHAR(96),
    `delivery_date` DATE,
    `delivery_address_lat` VARCHAR(32),
    `delivery_address_lng` VARCHAR(32),
    `delivery_address_locality` VARCHAR(64),
    `delivery_address_region` VARCHAR(56),
    `delivery_address_country` VARCHAR(48),
    `addressee_name` VARCHAR(64),
    `addressee_phone` VARCHAR(48),
    `delivery_address` VARCHAR(96),
    `registered_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `id_rate` (`id_rate`),
    CONSTRAINT `commerces_shipments_ibfk_1`
        FOREIGN KEY (`id_rate`)
        REFERENCES `commerces_rates` (`id`)
        ON UPDATE CASCADE
        ON DELETE SET NULL
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- companies
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `companies`;

CREATE TABLE `companies`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_company_contract_duration` INTEGER,
    `cuit` VARCHAR(8),
    `name` VARCHAR(64),
    `rate_base_price` DOUBLE,
    `rate_price_km` DOUBLE,
    `rate_percent_night_schedule` DOUBLE,
    `rate_percent_non_business_day` DOUBLE,
    `percent_commission` INTEGER,
    `registered_at` DATETIME,
    `phone` VARCHAR(48),
    `email` VARCHAR(48),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- companies_contract_durations
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `companies_contract_durations`;

CREATE TABLE `companies_contract_durations`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(16),
    `months` INTEGER,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- countries
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `countries`;

CREATE TABLE `countries`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `iso` SMALLINT NOT NULL,
    `iso2` CHAR(2) NOT NULL,
    `iso3` CHAR(3) NOT NULL,
    `prefix` smallint(5) unsigned NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `continent` VARCHAR(16),
    `subcontinent` VARCHAR(32),
    `currency_iso` VARCHAR(3),
    `currency_name` VARCHAR(100),
    PRIMARY KEY (`id`),
    UNIQUE INDEX `iso2` (`iso2`),
    UNIQUE INDEX `iso3` (`iso3`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- gmaps_apikeys
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `gmaps_apikeys`;

CREATE TABLE `gmaps_apikeys`
(
    `id` INTEGER NOT NULL,
    `api_key` TEXT,
    `registered_at` DATETIME,
    `associated_account_email` VARCHAR(96),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- headings_commerce
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `headings_commerce`;

CREATE TABLE `headings_commerce`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(64),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- notifications
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_user` INTEGER,
    `id_shipment` INTEGER,
    `id_offer` INTEGER,
    `title` VARCHAR(64),
    `content` TEXT,
    `datetime` DATETIME,
    `readed` TINYINT(1),
    `group` VARCHAR(96),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- notifications_deleted
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `notifications_deleted`;

CREATE TABLE `notifications_deleted`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_user` INTEGER(255),
    `id_notification` INTEGER,
    `deleted_at` DATETIME,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- positions_commerce
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `positions_commerce`;

CREATE TABLE `positions_commerce`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(96),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- product_types
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `product_types`;

CREATE TABLE `product_types`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(64),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- provinces
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `provinces`;

CREATE TABLE `provinces`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(48),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- provinces_localities
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `provinces_localities`;

CREATE TABLE `provinces_localities`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_province` INTEGER,
    `name` VARCHAR(48),
    PRIMARY KEY (`id`),
    INDEX `id_province` (`id_province`),
    CONSTRAINT `provinces_localities_ibfk_1`
        FOREIGN KEY (`id_province`)
        REFERENCES `provinces` (`id`)
        ON UPDATE CASCADE
        ON DELETE SET NULL
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- shipments
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shipments`;

CREATE TABLE `shipments`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_user` INTEGER NOT NULL,
    `id_product_type` INTEGER,
    `id_shipment_type` INTEGER DEFAULT 0,
    `id_status` INTEGER,
    `pin` VARCHAR(8) NOT NULL,
    `start_address` VARCHAR(255),
    `start_address_place_id` TEXT,
    `start_address_lat` DECIMAL(8,6),
    `start_address_lon` DECIMAL(9,6),
    `start_address_locality` VARCHAR(64),
    `start_address_region` VARCHAR(64),
    `start_address_country` VARCHAR(24),
    `waypoint_address` VARCHAR(255),
    `waypoint_address_place_id` TEXT,
    `waypoint_address_lat` DECIMAL(8,6),
    `waypoint_address_lon` DECIMAL(9,6),
    `waypoint_address_locality` VARCHAR(64),
    `waypoint_address_region` VARCHAR(64),
    `waypoint_address_country` VARCHAR(24),
    `end_address` VARCHAR(255),
    `end_address_place_id` TEXT,
    `end_address_lat` DECIMAL(8,6),
    `end_address_lon` DECIMAL(9,6),
    `end_address_locality` VARCHAR(64),
    `end_address_region` VARCHAR(64),
    `end_address_country` VARCHAR(24),
    `receiver_name` VARCHAR(48),
    `receiver_phone` VARCHAR(96),
    `description` TEXT,
    `measurements_width` DOUBLE,
    `measurements_width_unit` VARCHAR(4),
    `measurements_height` DOUBLE,
    `measurements_height_unit` VARCHAR(4),
    `measurements_depth` DOUBLE,
    `measurements_depth_unit` VARCHAR(4),
    `measurements_weight` DOUBLE,
    `measurements_weight_unit` VARCHAR(4),
    `out_now` TINYINT(1),
    `max_arrival_date` DATETIME,
    `receive_offers` TINYINT(1),
    `amount_payable` DOUBLE,
    `registered_at` DATETIME,
    `updated_at` DATETIME,
    `address_dist_1_dis_value` INTEGER DEFAULT 0,
    `address_dist_1_dis_desc` VARCHAR(16) DEFAULT '',
    `address_dist_1_dur_value` INTEGER DEFAULT 0,
    `address_dist_1_dur_desc` VARCHAR(16) DEFAULT '',
    `address_dist_2_dis_value` INTEGER DEFAULT 0,
    `address_dist_2_dis_desc` VARCHAR(16) DEFAULT '',
    `address_dist_2_dur_value` INTEGER,
    `address_dist_2_dur_desc` VARCHAR(16) DEFAULT '',
    `delivered_at` DATETIME,
    `declared_value` DOUBLE,
    `additional_address_information` TEXT,
    `must_arrive` DATETIME,
    `max_offers` INTEGER,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- shipments_ignored
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shipments_ignored`;

CREATE TABLE `shipments_ignored`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_user` INTEGER,
    `id_shipment` INTEGER,
    `registered_at` DATETIME,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- shipments_offers
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shipments_offers`;

CREATE TABLE `shipments_offers`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_user` INTEGER,
    `id_shipment` INTEGER,
    `offer` DOUBLE,
    `transport_id` INTEGER,
    `transport_type` INTEGER,
    `estimated_arrival_date` DATETIME,
    `registered_at` DATETIME,
    `accepted_at` DATETIME,
    `approximate_arrival_value` DOUBLE,
    `approximate_arrival_desc` VARCHAR(48),
    `approximate_distance_value` DOUBLE,
    `approximate_distance_desc` VARCHAR(48),
    `readed` TINYINT(1) DEFAULT 0,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- shipments_offers_deleted
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shipments_offers_deleted`;

CREATE TABLE `shipments_offers_deleted`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_offer` INTEGER,
    `deleted_at` DATETIME,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- shipments_operations_history
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shipments_operations_history`;

CREATE TABLE `shipments_operations_history`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_shipment` INTEGER,
    `id_user` INTEGER,
    `uid` VARCHAR(36),
    `datetime` DATETIME,
    `valor` INTEGER,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- shipments_payments
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shipments_payments`;

CREATE TABLE `shipments_payments`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_shipment` INTEGER,
    `preference_id` VARCHAR(96),
    `collection_id` VARCHAR(16) NOT NULL,
    `collection_status` VARCHAR(16),
    `merchant_order_id` VARCHAR(16),
    `total_paid_amount` DOUBLE,
    `net_received_amount` DOUBLE,
    `registered_at` DATETIME,
    `fee_mp` DOUBLE,
    `fee_nv` DOUBLE,
    `card_type_id` VARCHAR(36),
    `card_method_id` VARCHAR(48),
    `card_expiration_month` INTEGER,
    `card_expiration_year` INTEGER,
    `card_cardholder_identification_type` VARCHAR(16),
    `card_cardholder_identification_number` VARCHAR(16),
    `card_cardholder_name` VARCHAR(96),
    `card_date_created` DATETIME,
    `card_date_last_updated` DATETIME,
    PRIMARY KEY (`id`,`collection_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- shipments_payments_extra
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shipments_payments_extra`;

CREATE TABLE `shipments_payments_extra`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_shipment` INTEGER,
    `preference_id` VARCHAR(96),
    `collection_id` VARCHAR(16) NOT NULL,
    `collection_status` VARCHAR(16),
    `merchant_order_id` VARCHAR(16),
    `total_paid_amount` DOUBLE,
    `net_received_amount` DOUBLE,
    `registered_at` DATETIME,
    `fee_mp` DOUBLE,
    `fee_nv` DOUBLE,
    `card_type_id` VARCHAR(36),
    `card_method_id` VARCHAR(48),
    `card_expiration_month` INTEGER,
    `card_expiration_year` INTEGER,
    `card_cardholder_identification_type` VARCHAR(16),
    `card_cardholder_identification_number` VARCHAR(16),
    `card_cardholder_name` VARCHAR(96),
    `card_date_created` DATETIME,
    `card_date_last_updated` DATETIME,
    PRIMARY KEY (`id`,`collection_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- shipments_pictures
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shipments_pictures`;

CREATE TABLE `shipments_pictures`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_shipment` INTEGER,
    `name` VARCHAR(64),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- shipments_returns
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shipments_returns`;

CREATE TABLE `shipments_returns`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_shipment` INTEGER,
    `id_user` INTEGER,
    `id_reason` INTEGER,
    `id_option` INTEGER,
    `comments_reason` TEXT,
    `dispatch_expenses` DOUBLE,
    `receiver_fullname` VARCHAR(96),
    `receiver_contact` VARCHAR(96),
    `datetime` DATETIME,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- shipments_returns_files
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shipments_returns_files`;

CREATE TABLE `shipments_returns_files`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_shipment` INTEGER,
    `name` VARCHAR(64),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- shipments_returns_options
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shipments_returns_options`;

CREATE TABLE `shipments_returns_options`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(96),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- shipments_returns_reasons
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shipments_returns_reasons`;

CREATE TABLE `shipments_returns_reasons`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(96),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- shipments_status
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shipments_status`;

CREATE TABLE `shipments_status`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(64),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- shipments_type
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shipments_type`;

CREATE TABLE `shipments_type`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(48),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- shipments_users_locations
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shipments_users_locations`;

CREATE TABLE `shipments_users_locations`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_shipment` INTEGER,
    `id_user` INTEGER,
    `lat` DECIMAL(10,8),
    `lng` DECIMAL(11,8),
    `datetime` DATETIME,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `unique_shipments_users_locations` (`id_shipment`, `id_user`, `lat`, `lng`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_company` INTEGER,
    `avatar` VARCHAR(64),
    `fullname` VARCHAR(64),
    `first_name` VARCHAR(32),
    `last_name` VARCHAR(32),
    `password` VARCHAR(96),
    `email` VARCHAR(96),
    `country` VARCHAR(64),
    `country_code` VARCHAR(2),
    `home_address` VARCHAR(128),
    `providence_code` VARCHAR(16),
    `providence` VARCHAR(56),
    `locality_code` VARCHAR(16),
    `locality` VARCHAR(48),
    `postal_code` VARCHAR(16),
    `dni` VARCHAR(32),
    `dni_front` VARCHAR(32),
    `dni_back` VARCHAR(32),
    `phone` VARCHAR(48),
    `drivers_license` VARCHAR(48),
    `overall_rating` DOUBLE DEFAULT 0,
    `last_login` DATETIME,
    `registered_at` DATETIME,
    `updated_at` DATETIME,
    `last_location_lat` DECIMAL(10,8),
    `last_location_lng` DECIMAL(11,8),
    `last_location_datetime` DATETIME,
    `last_location_locality` VARCHAR(64),
    `last_location_region` VARCHAR(64),
    `last_location_country` VARCHAR(24),
    `timezone` VARCHAR(48),
    `traveling` TINYINT(1) DEFAULT 0,
    `verified` TINYINT(1) DEFAULT 0 NOT NULL,
    `pwd_reset_code` VARCHAR(8),
    `commission` INTEGER,
    `disabled` TINYINT(1) DEFAULT 0,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- users_activity_history
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users_activity_history`;

CREATE TABLE `users_activity_history`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_user` INTEGER,
    `id_shipment` INTEGER,
    `type` INTEGER,
    `previous_balance` DOUBLE,
    `new_balance` DOUBLE,
    `date_time` DATETIME,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- users_conveyances
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users_conveyances`;

CREATE TABLE `users_conveyances`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_user` INTEGER,
    `type` INTEGER,
    `brand` VARCHAR(64),
    `model` VARCHAR(64),
    `year` INTEGER,
    `domain` VARCHAR(96),
    `main_photo` VARCHAR(64),
    `identification_card` VARCHAR(64),
    `insurance_policy` VARCHAR(255),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- users_email_verification
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users_email_verification`;

CREATE TABLE `users_email_verification`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(64),
    `code` VARCHAR(4),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- users_favorites
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users_favorites`;

CREATE TABLE `users_favorites`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_user` INTEGER,
    `id_favorite` INTEGER,
    `favorite` TINYINT(1),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- users_mp
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users_mp`;

CREATE TABLE `users_mp`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_user` INTEGER NOT NULL,
    `code` VARCHAR(96) NOT NULL,
    `registered_at` DATETIME NOT NULL,
    `updated_at` DATETIME,
    `access_token` VARCHAR(255),
    `public_key` VARCHAR(255),
    `live_mode` TINYINT(1),
    `user_id` INTEGER,
    `token_type` VARCHAR(64),
    `expires_in` BIGINT,
    `scope` VARCHAR(96),
    `customer_id` VARCHAR(96),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- users_mp_cards
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users_mp_cards`;

CREATE TABLE `users_mp_cards`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- users_push_reg_ids
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users_push_reg_ids`;

CREATE TABLE `users_push_reg_ids`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(64),
    `reg_id` TEXT,
    `updated_at` DATETIME,
    `dev_platform` VARCHAR(48),
    `dev_model` VARCHAR(64),
    `dev_version` VARCHAR(16),
    `dev_manufacturer` VARCHAR(96),
    `dev_virtual` TINYINT(1),
    `enabled` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- users_ratings
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users_ratings`;

CREATE TABLE `users_ratings`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_user` INTEGER,
    `id_shipment` INTEGER,
    `rating` DOUBLE,
    `comments` TEXT,
    `register_at` DATETIME,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- users_settings
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users_settings`;

CREATE TABLE `users_settings`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_id` INTEGER,
    `push_new_shipments` TINYINT(1) DEFAULT 1,
    `push_offers` TINYINT(1) DEFAULT 1,
    `push_chats` TINYINT(1) DEFAULT 1,
    `online` TINYINT(1) DEFAULT 1,
    `rate_base_price` DOUBLE,
    `rate_base_price_enabled` TINYINT(1),
    `rate_price_km` DOUBLE,
    `rate_price_km_enabled` TINYINT(1),
    `rate_percent_night_schedule` DOUBLE,
    `rate_percent_night_schedule_enabled` TINYINT(1),
    `rate_percent_non_business_day` DOUBLE,
    `rate_percent_non_business_day_enabled` TINYINT(1),
    `shipments_max_offers` INTEGER,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- users_social_connect
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users_social_connect`;

CREATE TABLE `users_social_connect`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `uid` VARCHAR(64) NOT NULL,
    `provider` VARCHAR(24) NOT NULL,
    `email` VARCHAR(64) NOT NULL,
    `authentication` TEXT,
    `info` TEXT,
    PRIMARY KEY (`id`,`uid`,`provider`,`email`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
