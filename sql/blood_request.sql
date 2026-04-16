-- ====================================================
-- สร้างตาราง blood_requests สำหรับ MySQL 5.x
-- ====================================================

CREATE TABLE IF NOT EXISTS `blood_requests` (
  `id`               INT(11)       NOT NULL AUTO_INCREMENT,

  -- 1. ข้อมูลผู้ป่วย
  `patient_name`     VARCHAR(200)  NOT NULL DEFAULT '',
  `diag`             VARCHAR(255)  NOT NULL DEFAULT '',
  `doctor`           VARCHAR(200)  NOT NULL DEFAULT '',
  `ptright`          VARCHAR(100)  NOT NULL DEFAULT '',

  -- 2. ประวัติรับเลือด
  `got_blood`        TINYINT(1)    NOT NULL DEFAULT 0,
  `get_blood_date`   DATE          NULL,
  `hospital`         VARCHAR(200)  NOT NULL DEFAULT '',

  -- 3. กรุ๊ปเลือด
  `blood_group`      VARCHAR(50)   NOT NULL DEFAULT '',
  `blood_group_rh`   VARCHAR(50)   NOT NULL DEFAULT '',

  -- 4. ชนิดเลือดที่ขอ (checkbox + unit)
  `prc`              TINYINT(1)    NOT NULL DEFAULT 0,
  `prc_unit`         VARCHAR(20)   NOT NULL DEFAULT '',
  `lrpc`             TINYINT(1)    NOT NULL DEFAULT 0,
  `lrpc_unit`        VARCHAR(20)   NOT NULL DEFAULT '',
  `ffp`              TINYINT(1)    NOT NULL DEFAULT 0,
  `ffp_unit`         VARCHAR(20)   NOT NULL DEFAULT '',
  `plt_conc`         TINYINT(1)    NOT NULL DEFAULT 0,
  `plt_conc_unit`    VARCHAR(20)   NOT NULL DEFAULT '',
  `sdp`              TINYINT(1)    NOT NULL DEFAULT 0,
  `sdp_unit`         VARCHAR(20)   NOT NULL DEFAULT '',
  `other_blood`      TINYINT(1)    NOT NULL DEFAULT 0,
  `other_other`      VARCHAR(200)  NOT NULL DEFAULT '',

  -- 5. เหตุผล
  `reason`           VARCHAR(100)  NOT NULL DEFAULT '',
  `other_reason`     VARCHAR(255)  NOT NULL DEFAULT '',
  `blood_order_date` DATE          NULL,
  `blood_used_date`  DATE          NULL,

  -- แพทย์ / พยาบาล
  `doctor_order`     VARCHAR(200)  NOT NULL DEFAULT '',
  `nurse`            VARCHAR(200)  NOT NULL DEFAULT '',
  `date_drawn`       DATETIME      NULL,

  `created_at`       DATETIME      NOT NULL,

  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
