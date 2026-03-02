-- 対応状況追加
INSERT INTO `contact_status`(`name`, `create_at`, `update_at`) VALUES 
('未対応',now(),now()),
('対応中',now(),now()),
('完了',now(),now()),
('対応不要',now(),now());

-- 不必要なカラムの削除
ALTER TABLE `contacts` DROP `date`;