-- faq_categoriesテーブルにnot null制約の追加とis_deleteのデフォルト値を追加
ALTER TABLE `faq_categories` CHANGE `name` `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL, CHANGE `is_delete` `is_delete` TINYINT(1) NOT NULL DEFAULT '0', CHANGE `create_at` `create_at` DATETIME NOT NULL, CHANGE `update_at` `update_at` DATETIME NOT NULL;

-- faq_categoriesテーブルに表示順用のソート番号カラムを追加
ALTER TABLE `faq_categories` ADD `sort_order` INT(11) NOT NULL AFTER `name`, ADD UNIQUE (`sort_order`);

-- faq_categoriesテーブルにデータを追加
INSERT INTO `faq_categories`(`name`, `sort_order`, `create_at`, `update_at`) VALUES ('ご来場について',1 ,now(),now()),('会場について',2,now(),now()),('その他',3,now(),now())

-- faqテーブルにNotNull制約を追加
ALTER TABLE `faq` CHANGE `question` `question` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL, CHANGE `answer` `answer` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL, CHANGE `category` `category` INT(11) NOT NULL, CHANGE `create_at` `create_at` DATETIME NOT NULL, CHANGE `update_at` `update_at` DATETIME NOT NULL;

-- faqテーブルにデータを追加
INSERT INTO `faq`(`question`, `answer`, `category`, `create_at`, `update_at`) VALUES 
('入場料はかかりますか？', '入場は無料です。どなたでもご自由にお楽しみいただけます。飲食の購入は各店舗でお支払いください。', 1, NOW(), NOW()),
('開催時間を教えてください。', '平日は16:00~22:00、土日祝は11:00~22:00です。各日最終入場受付は21:00、ラストオーダーは21:15です。', 1, NOW(), NOW()),
('雨天の場合も開催されますか？', '雨天決行ですが、荒天の場合は安全を考慮し中止となる場合があります。最新情報はSNSでお知らせします。', 1, NOW(), NOW()),
('支払い方法を教えてください。', '現金のほか、主要な電子マネー・QRコード決済がご利用いただけます。', 1, NOW(), NOW()),
('喫煙所はありますか？', '会場内は全面禁煙ですが、敷地外に指定の喫煙エリアを設けています。スタッフの案内に従ってご利用ください。', 2, NOW(), NOW()),
('授乳室やおむつ替えスペースはありますか？', 'メインゲート付近に授乳室とおむつ替え台を設置しています。小さなお子様連れでも安心してご利用いただけます。', 2, NOW(), NOW()),
('駐車場はありますか？', '専用駐車場はございません。公共交通機関のご利用をおすすめします。', 2, NOW(), NOW()),
('ペットを連れて入場できますか？', '混雑が予想されるため、ペットの同伴はご遠慮ください。ただし補助犬は入場可能です。', 2, NOW(), NOW()),
('ゴミはどうすればよいですか？', '会場内に分別ゴミ箱を設置しています。リサイクルにご協力をお願いします。', 2, NOW(), NOW()),
('忘れ物をした場合はどうすればよいですか？', '会場本部でお預かりしています。イベント終了後は実行委員会までお問い合わせください。', 3, NOW(), NOW()),
('トイレはどこにありますか？', '会場内に複数の仮設トイレを設置しています。', 3, NOW(), NOW()),
('SNSで写真を投稿しても良いですか？', '大歓迎です！公式ハッシュタグ「#ふくおか餃子FES」をつけて投稿してください。', 3, NOW(), NOW()),
('開催中止の場合はどうなりますか？', '安全を最優先に判断し、中止の場合は公式サイトとSNSでお知らせします。', 3, NOW(), NOW()),
('問い合わせ先を教えてください。', '「<a class="c-bb" href="./contact.php">お問い合わせ</a>」ページのフォームまたは事務局メール宛にご連絡ください。', 3, NOW(), NOW());