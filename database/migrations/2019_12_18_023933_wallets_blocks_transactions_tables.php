<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class WalletsBlocksTransactionsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sqls = [];

        $sqls[] = <<<SQL
CREATE TABLE IF NOT EXISTS `blocks` (
  `id` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `parent_block_id` BIGINT(19) UNSIGNED NULL DEFAULT NULL,
  `top_id_list` VARCHAR(16384) NULL DEFAULT NULL,
  `hash` VARCHAR(1024) NOT NULL,
  `height` INT(11) NOT NULL DEFAULT 0,
  `reward` BIGINT(20) NOT NULL DEFAULT 0,
  `fees` BIGINT(20) NOT NULL DEFAULT 0,
  `total_forged` BIGINT(20) NOT NULL DEFAULT 0,
  `processed_amount` BIGINT(20) NOT NULL DEFAULT 0,
  `created_at` DATETIME NULL DEFAULT NULL,
  `updated_at` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_block_n_idx` (`user_id` ASC),
  INDEX `fk_block_n1_idx` (`parent_block_id` ASC),
  CONSTRAINT `fk_block_n`
    FOREIGN KEY (`user_id`)
    REFERENCES `users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `fk_block_n1`
    FOREIGN KEY (`parent_block_id`)
    REFERENCES `blocks` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;
SQL;
        $sqls[] = <<<SQL
CREATE TABLE IF NOT EXISTS `wallets` (
  `id` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT(20) UNSIGNED NOT NULL,
  `sum` BIGINT(20) NOT NULL DEFAULT 0,
  `created_at` DATETIME NULL DEFAULT NULL,
  `updated_at` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_wallet_n1_idx` (`user_id` ASC),
  CONSTRAINT `fk_wallet_n1`
    FOREIGN KEY (`user_id`)
    REFERENCES `users` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;
SQL;
        $sqls[] = <<<SQL
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT,
  `block_id` BIGINT(19) UNSIGNED NOT NULL,
  `sender_wallet_id` BIGINT(19) UNSIGNED NOT NULL,
  `recipient_wallet_id` BIGINT(19) UNSIGNED NOT NULL,
  `confirmations` VARCHAR(255) NOT NULL,
  `smartbridge` VARCHAR(4096) NULL DEFAULT NULL,
  `amount` BIGINT(20) NOT NULL,
  `fee` BIGINT(20) NOT NULL DEFAULT 0,
  `created_at` DATETIME NULL DEFAULT NULL,
  `updated_at` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_transaction_n1_idx` (`block_id` ASC),
  INDEX `fk_transaction_n2_idx` (`sender_wallet_id` ASC),
  INDEX `fk_transaction_n3_idx` (`recipient_wallet_id` ASC),
  CONSTRAINT `fk_transaction_n1`
    FOREIGN KEY (`block_id`)
    REFERENCES `blocks` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_transaction_n2`
    FOREIGN KEY (`sender_wallet_id`)
    REFERENCES `wallets` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_transaction_n3`
    FOREIGN KEY (`recipient_wallet_id`)
    REFERENCES `wallets` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;
SQL;

        foreach ($sqls as $sql) {
            DB::statement($sql);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
