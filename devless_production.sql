-- Valentina Studio --
-- MySQL dump --
-- ---------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- ---------------------------------------------------------


-- CREATE TABLE "apps" -------------------------------------
CREATE TABLE `apps` (
	`id` Int( 10 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`name` VarChar( 255 ) NOT NULL,
	`description` Text NOT NULL,
	`token` VarChar( 255 ) NOT NULL DEFAULT '29f840da12f7dc2059f08817faf994ee',
	`created_at` Timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
	`updated_at` Timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
ENGINE = InnoDB
AUTO_INCREMENT = 2;
-- ---------------------------------------------------------


-- CREATE TABLE "devless_dump" -----------------------------
CREATE TABLE `devless_dump` (
	`id` Int( 10 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`key` VarChar( 255 ) NOT NULL,
	`value` Text NOT NULL,
	`notes` Text NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- ---------------------------------------------------------


-- CREATE TABLE "migrations" -------------------------------
CREATE TABLE `migrations` (
	`migration` VarChar( 255 ) NOT NULL,
	`batch` Int( 11 ) NOT NULL )
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
ENGINE = InnoDB;
-- ---------------------------------------------------------


-- CREATE TABLE "password_resets" --------------------------
CREATE TABLE `password_resets` (
	`email` VarChar( 255 ) NOT NULL,
	`token` VarChar( 255 ) NOT NULL,
	`created_at` Timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' )
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
ENGINE = InnoDB;
-- ---------------------------------------------------------


-- CREATE TABLE "services" ---------------------------------
CREATE TABLE `services` (
	`id` Int( 10 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`name` VarChar( 255 ) NOT NULL,
	`description` Text NULL,
	`driver` Text NULL,
	`hostname` Text NULL,
	`username` Text NULL,
	`password` Text NULL,
	`database` Text NULL,
	`port` Text NULL,
	`script` Text NOT NULL,
	`script_init_vars` Text NOT NULL,
	`resource_access_right` Text NOT NULL,
	`public` TinyInt( 1 ) NULL,
	`active` TinyInt( 1 ) NOT NULL,
	`calls` Int( 11 ) NULL,
	`created_at` Timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
	`updated_at` Timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
	PRIMARY KEY ( `id` ),
	CONSTRAINT `services_name_unique` UNIQUE( `name` ) )
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
ENGINE = InnoDB
AUTO_INCREMENT = 2;
-- ---------------------------------------------------------


-- CREATE TABLE "table_metas" ------------------------------
CREATE TABLE `table_metas` (
	`id` Int( 10 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`table_name` VarChar( 255 ) NOT NULL,
	`schema` Text NOT NULL,
	`count` Int( 11 ) NULL,
	`access` TinyInt( 1 ) NULL,
	`service_id` Int( 10 ) UNSIGNED NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
ENGINE = InnoDB
AUTO_INCREMENT = 4;
-- ---------------------------------------------------------


-- CREATE TABLE "users" ------------------------------------
CREATE TABLE `users` (
	`id` Int( 10 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`username` VarChar( 255 ) NOT NULL DEFAULT 'NA',
	`email` VarChar( 255 ) NOT NULL,
	`password` VarChar( 60 ) NOT NULL,
	`role` TinyInt( 1 ) NOT NULL DEFAULT '0',
	`first_name` VarChar( 255 ) NULL,
	`phone_number` VarChar( 255 ) NULL,
	`last_name` VarChar( 255 ) NULL,
	`status` TinyInt( 1 ) NOT NULL,
	`session_token` VarChar( 255 ) NULL,
	`session_time` VarChar( 255 ) NULL,
	`remember_token` VarChar( 100 ) NULL,
	`created_at` Timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
	`updated_at` Timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
ENGINE = InnoDB
AUTO_INCREMENT = 2;
-- ---------------------------------------------------------


-- Dump data of "devless_dump" -----------------------------
-- ---------------------------------------------------------


-- CREATE INDEX "password_resets_email_index" --------------
CREATE INDEX `password_resets_email_index` USING BTREE ON `password_resets`( `email` );
-- ---------------------------------------------------------


-- CREATE INDEX "password_resets_token_index" --------------
CREATE INDEX `password_resets_token_index` USING BTREE ON `password_resets`( `token` );
-- ---------------------------------------------------------


-- CREATE INDEX "table_metas_service_id_foreign" -----------
CREATE INDEX `table_metas_service_id_foreign` USING BTREE ON `table_metas`( `service_id` );
-- ---------------------------------------------------------


-- CREATE LINK "table_metas_service_id_foreign" ------------
ALTER TABLE `table_metas`
	ADD CONSTRAINT `table_metas_service_id_foreign` FOREIGN KEY ( `service_id` )
	REFERENCES `services`( `id` )
	ON DELETE Cascade
	ON UPDATE Restrict;
-- ---------------------------------------------------------


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------
