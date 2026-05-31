-- Modern Interior Design Website Database
-- Run: composer run clinic   (or: php cli.php)

CREATE DATABASE IF NOT EXISTS modern
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE modern;

-- ---------------------------------------------------------------------------
-- Users: registration, login, and admin role
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS users (
    id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name      VARCHAR(100)  NOT NULL,
    last_name       VARCHAR(100)  NOT NULL,
    phone           VARCHAR(20)   NOT NULL,
    email           VARCHAR(255)  NOT NULL,
    username        VARCHAR(100)  NULL,
    password_hash   VARCHAR(255)  NOT NULL,
    role            ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    created_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    UNIQUE KEY uq_users_phone   (phone),
    UNIQUE KEY uq_users_email   (email),
    UNIQUE KEY uq_users_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------------
-- Reviews / comments submitted by registered users
-- Admin can approve, reject, and respond
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS reviews (
    id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id         INT UNSIGNED NOT NULL,
    body            TEXT          NOT NULL,
    rating          TINYINT UNSIGNED NULL COMMENT '1-5 stars, optional',
    status          ENUM('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending',
    admin_response  TEXT          NULL,
    responded_by    INT UNSIGNED  NULL COMMENT 'admin user who wrote the response',
    responded_at    TIMESTAMP     NULL,
    created_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_reviews_user
        FOREIGN KEY (user_id) REFERENCES users (id)
        ON DELETE CASCADE ON UPDATE CASCADE,

    CONSTRAINT fk_reviews_responded_by
        FOREIGN KEY (responded_by) REFERENCES users (id)
        ON DELETE SET NULL ON UPDATE CASCADE,

    INDEX idx_reviews_status (status),
    INDEX idx_reviews_user   (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------------
-- Portfolio images managed by admin
-- Files live in storage/pics/; this table stores metadata
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS portfolio_pics (
    id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    filename        VARCHAR(255)  NOT NULL COMMENT 'file name inside storage/pics/',
    title           VARCHAR(255)  NOT NULL,
    description     TEXT          NULL,
    sort_order      INT UNSIGNED  NOT NULL DEFAULT 0,
    is_active       TINYINT(1)    NOT NULL DEFAULT 1,
    uploaded_by     INT UNSIGNED  NULL,
    created_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_pics_uploaded_by
        FOREIGN KEY (uploaded_by) REFERENCES users (id)
        ON DELETE SET NULL ON UPDATE CASCADE,

    UNIQUE KEY uq_pics_filename (filename),
    INDEX idx_pics_active_order (is_active, sort_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------------
-- Seed: default admin account
-- Email: admin@modern.local  |  Phone: 09120000000  |  Password: admin123
-- Change this password immediately after first login!
-- ---------------------------------------------------------------------------
INSERT INTO users (first_name, last_name, phone, email, username, password_hash, role)
VALUES (
    'مدیر',
    'سایت',
    '09120000000',
    'admin@modern.local',
    'admin',
    '$2y$12$VkSGjdMk32tr3XlXYDsHjOO32p4yVgOni6LRzXrezvauW8t88AANS',
    'admin'
);

-- Seed: existing portfolio images from storage/pics/
INSERT INTO portfolio_pics (filename, title, description, sort_order, uploaded_by) VALUES
('نشیمن.jpg',      'نشیمن مدرن',       'فضای نشیمنی روشن و دلنشین با تمرکز روی بافت و نور طبیعی.',           1, 1),
('اتاق_خواب.jpg',  'اتاق خواب آرام',   'ترکیب رنگ‌های نرم و مبلمان ساده برای استراحتی آرامش‌بخش.',           2, 1),
('اشپزخانه.jpg',   'آشپزخانه کلاسیک',  'استفاده از متریال طبیعی و نورپردازی مناسب در طراحی آشپزخانه.',        3, 1),
('مبل_ایرانی.jpg', 'نشیمن ایرانی',     'آمیختن المان‌های سنتی با فرم‌های مدرن در یک فضای خانوادگی.',          4, 1),
('گلخانه.jpg',     'گلخانه داخلی',     'ایجاد حسی سبز و زنده با استفاده از گیاهان در طراحی داخلی.',           5, 1),
('مدرن.jpg',       'منزل مدرن',        'طراحی مینیمال و کارآمد برای زندگی مدرن و راحت.',                      6, 1);
