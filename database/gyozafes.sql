-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2026-03-05 13:30:01
-- サーバのバージョン： 10.4.32-MariaDB
-- PHP のバージョン: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gyozafes`
--
CREATE DATABASE IF NOT EXISTS `gyozafes` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `gyozafes`;

-- --------------------------------------------------------

--
-- テーブルの構造 `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `admins`
--

INSERT INTO `admins` (`id`, `name`, `pass`, `create_at`, `update_at`) VALUES
(1, 'admin', '$2y$10$rbU5FLm6TtW6HK1g/GQM.umNsYDGPwGdsJqFx9Y1OX.4/UPDDdPNu', '2026-03-05 21:18:20', '2026-03-05 21:18:20');

-- --------------------------------------------------------

--
-- テーブルの構造 `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `body` text NOT NULL,
  `state` int(11) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `contact_status`
--

CREATE TABLE `contact_status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `contact_status`
--

INSERT INTO `contact_status` (`id`, `name`, `create_at`, `update_at`) VALUES
(1, '未対応', '2026-03-05 21:11:35', '2026-03-05 21:11:35'),
(2, '対応中', '2026-03-05 21:11:35', '2026-03-05 21:11:35'),
(3, '完了', '2026-03-05 21:11:35', '2026-03-05 21:11:35'),
(4, '対応不要', '2026-03-05 21:11:35', '2026-03-05 21:11:35');

-- --------------------------------------------------------

--
-- テーブルの構造 `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `category` int(11) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`, `category`, `create_at`, `update_at`) VALUES
(1, '入場料はかかりますか？', '入場は無料です。どなたでもご自由にお楽しみいただけます。飲食の購入は各店舗でお支払いください。', 1, '2026-03-05 21:14:27', '2026-03-05 21:14:27'),
(2, '開催時間を教えてください。', '平日は16:00~22:00、土日祝は11:00~22:00です。各日最終入場受付は21:00、ラストオーダーは21:15です。', 1, '2026-03-05 21:14:27', '2026-03-05 21:14:27'),
(3, '雨天の場合も開催されますか？', '雨天決行ですが、荒天の場合は安全を考慮し中止となる場合があります。最新情報はSNSでお知らせします。', 1, '2026-03-05 21:14:27', '2026-03-05 21:14:27'),
(4, '支払い方法を教えてください。', '現金のほか、主要な電子マネー・QRコード決済がご利用いただけます。', 1, '2026-03-05 21:14:27', '2026-03-05 21:14:27'),
(5, '喫煙所はありますか？', '会場内は全面禁煙ですが、敷地外に指定の喫煙エリアを設けています。スタッフの案内に従ってご利用ください。', 2, '2026-03-05 21:14:27', '2026-03-05 21:14:27'),
(6, '授乳室やおむつ替えスペースはありますか？', 'メインゲート付近に授乳室とおむつ替え台を設置しています。小さなお子様連れでも安心してご利用いただけます。', 2, '2026-03-05 21:14:27', '2026-03-05 21:14:27'),
(7, '駐車場はありますか？', '専用駐車場はございません。公共交通機関のご利用をおすすめします。', 2, '2026-03-05 21:14:27', '2026-03-05 21:14:27'),
(8, 'ペットを連れて入場できますか？', '混雑が予想されるため、ペットの同伴はご遠慮ください。ただし補助犬は入場可能です。', 2, '2026-03-05 21:14:27', '2026-03-05 21:14:27'),
(9, 'ゴミはどうすればよいですか？', '会場内に分別ゴミ箱を設置しています。リサイクルにご協力をお願いします。', 2, '2026-03-05 21:14:27', '2026-03-05 21:14:27'),
(10, '忘れ物をした場合はどうすればよいですか？', '会場本部でお預かりしています。イベント終了後は実行委員会までお問い合わせください。', 3, '2026-03-05 21:14:27', '2026-03-05 21:14:27'),
(11, 'トイレはどこにありますか？', '会場内に複数の仮設トイレを設置しています。', 3, '2026-03-05 21:14:27', '2026-03-05 21:14:27'),
(12, 'SNSで写真を投稿しても良いですか？', '大歓迎です！公式ハッシュタグ「#ふくおか餃子FES」をつけて投稿してください。', 3, '2026-03-05 21:14:27', '2026-03-05 21:14:27'),
(13, '開催中止の場合はどうなりますか？', '安全を最優先に判断し、中止の場合は公式サイトとSNSでお知らせします。', 3, '2026-03-05 21:14:27', '2026-03-05 21:14:27'),
(14, '問い合わせ先を教えてください。', '「<a class=\"c-bb\" href=\"./contact.php\">お問い合わせ</a>」ページのフォームまたは事務局メール宛にご連絡ください。', 3, '2026-03-05 21:14:27', '2026-03-05 21:14:27');

-- --------------------------------------------------------

--
-- テーブルの構造 `faq_categories`
--

CREATE TABLE `faq_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `faq_categories`
--

INSERT INTO `faq_categories` (`id`, `name`, `sort_order`, `is_delete`, `create_at`, `update_at`) VALUES
(1, 'ご来場について', 1, 0, '2026-03-05 21:13:55', '2026-03-05 21:13:55'),
(2, '会場について', 2, 0, '2026-03-05 21:13:55', '2026-03-05 21:13:55'),
(3, 'その他', 3, 0, '2026-03-05 21:13:55', '2026-03-05 21:13:55');

-- --------------------------------------------------------

--
-- テーブルの構造 `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `news`
--

INSERT INTO `news` (`id`, `author`, `title`, `body`, `create_at`, `update_at`) VALUES
(1, 'admin', 'ふくおか餃子FES開催決定！', 'テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト', '2026-03-05 21:15:20', '2026-03-05 21:15:20'),
(2, 'admin', '出店企業様大募集中！', 'テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト', '2026-03-05 21:15:20', '2026-03-05 21:15:20'),
(3, 'admin', '出店企業様決定！', 'テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト', '2026-03-05 21:15:20', '2026-03-05 21:15:20'),
(4, 'admin', '出店者インタビュー　博多区で人気の「博多ぎょうざ堂」', 'テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト', '2026-03-05 21:15:20', '2026-03-05 21:15:20');

-- --------------------------------------------------------

--
-- テーブルの構造 `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `image_alt` text NOT NULL,
  `shop_id` int(11) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `products`
--

INSERT INTO `products` (`id`, `name`, `body`, `quantity`, `price`, `file_name`, `image_alt`, `shop_id`, `create_at`, `update_at`) VALUES
(8, '肉汁あふれる焼き餃子', '香ばしく焼き上げた皮の中には、あふれんばかりの肉汁がぎっしり。\r\n厳選された国産豚とキャベツの旨味が広がる、満足感たっぷりの一品です。\r\n一口噛めば、ジュワッとした肉汁が口いっぱいに広がります。', 6, 580, 'menu01.jpg', '肉汁あふれる焼き餃子', 1, '2026-03-05 21:17:37', '2026-03-05 21:17:37'),
(9, 'ふっくら蒸しあげ餃子', 'もちもちの皮で包んだ餃子を、丁寧に蒸し上げた優しい味わいの一皿。\r\n蒸気でふっくら仕上げた皮はとろけるようにやわらかく、\r\n野菜と肉の旨味がじんわり広がります。\r\n特製のポン酢だれをつけて、さっぱりとお召し上がりください。', 8, 520, 'menu02.jpg', 'ふっくら蒸しあげ餃子', 2, '2026-03-05 21:17:37', '2026-03-05 21:17:37'),
(10, '中華風スープ餃子', '鶏ガラと香味野菜をじっくり煮込んだ特製スープに、\r\nつるりとした水餃子を浮かべた人気メニュー。\r\n旨味たっぷりのスープと、もちもち食感の餃子が絶妙に絡み合います。\r\n彩り豊かな野菜とご一緒に、ほっと温まる一杯をどうぞ。', 5, 680, 'menu03.jpg', '中華風スープ餃子', 3, '2026-03-05 21:17:37', '2026-03-05 21:17:37'),
(11, 'カリもち！揚げ餃子', '\"外はカリッ、中はもちっと食感が楽しい、人気の揚げ餃子。\r\n特製スパイスを混ぜ込んだ肉餡は、香ばしい皮と相性抜群。\r\nおつまみとしても、おやつ感覚でも楽しめるクセになる味です。\r\n熱々のうちに、レモンを絞ってどうぞ！\"', 5, 600, 'menu04.jpg', 'カリもち！揚げ餃子', 4, '2026-03-05 21:17:37', '2026-03-05 21:17:37'),
(12, 'お口に広がる地中海の風', 'オリーブオイルとハーブで仕上げた、地中海スタイルの創作餃子。\r\nしっとりとした皮に包まれた具材は、チーズ・オリーブ・トマトの香りが絶妙なバランス。\r\n芳醇なオイルソースとハーブの香りが口いっぱいに広がります。\r\nワインにもぴったりな、上品な一皿。', 5, 720, 'menu05.jpg', 'お口に広がる地中海の風', 5, '2026-03-05 21:17:37', '2026-03-05 21:17:37'),
(13, '素材の旨味ひきたつ水餃子', '国産野菜と豚肉の旨味をぎゅっと閉じ込めた、つるんと食感の水餃子。\r\n素材本来の味を生かすため、化学調味料を使わず丁寧に手包み。\r\nあっさりとした特製だれで、いくつでも食べられる軽やかな味わいです。\r\n熱々のままでも、冷やしてもおいしい万能餃子。', 8, 550, 'menu06.jpg', '素材の旨味ひきたつ水餃子', 6, '2026-03-05 21:17:37', '2026-03-05 21:17:37'),
(14, 'しびうまラー油餃子', '自家製の花椒ラー油をたっぷり絡めた、刺激的な一皿。\r\nひと口食べれば、山椒のしびれと唐辛子の辛味がじわっと広がり、\r\nジューシーな肉餡の旨味が後を引きます。\r\n辛党必食！ 病みつきになる辛さでリピーター続出。', 6, 620, 'menu07.jpg', 'しびうまラー油餃子', 7, '2026-03-05 21:17:37', '2026-03-05 21:17:37');

-- --------------------------------------------------------

--
-- テーブルの構造 `shops`
--

CREATE TABLE `shops` (
  `id` int(11) NOT NULL,
  `shop_num` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `shops`
--

INSERT INTO `shops` (`id`, `shop_num`, `name`, `body`, `is_delete`, `create_at`, `update_at`) VALUES
(1, 'B-01', '博多ぎょうざ堂', '福岡を代表する老舗餃子専門店。国産豚とキャベツを使用し、ひとつひとつ手包みで仕上げています。外はカリッと、中は肉汁たっぷりの博多スタイルが人気。', 0, '2026-03-05 21:17:24', '2026-03-05 21:17:24'),
(2, 'B-02', '中華食堂 蒸々屋（むしむしや）', '優しい味わいの蒸し料理を得意とする中華食堂。ふっくら蒸し上げた餃子や点心が好評で、家族連れにも人気。手作りの皮が自慢です。', 0, '2026-03-05 21:17:24', '2026-03-05 21:17:24'),
(3, 'B-03', '餃子茶寮 彩香（さいか）', '和のテイストを取り入れた創作中華が魅力の茶寮。旨味たっぷりのスープ餃子をはじめ、彩り豊かなメニューを提供しています。', 0, '2026-03-05 21:17:24', '2026-03-05 21:17:24'),
(4, 'B-04', '餃子バル 風雷坊（ふうらいぼう）', 'スタイリッシュな餃子バルとして若者に人気。ビールやワインとの相性を考えたスパイシーな揚げ餃子が名物。夜の一杯にぴったり。', 0, '2026-03-05 21:17:24', '2026-03-05 21:17:24'),
(5, 'B-05', 'Mediterraneo Gyoza（メディテラネオ ギョウザ）', '地中海の食文化を融合した創作餃子専門店。オリーブやハーブを使った新感覚の餃子で女性客に人気。見た目も華やか。', 0, '2026-03-05 21:17:24', '2026-03-05 21:17:24'),
(6, 'B-06', '餃子処 湯心（ゆごころ）', '素材の味を大切にした、体にやさしい餃子を提供。化学調味料不使用の水餃子が看板商品。シンプルながら深い味わいです。', 0, '2026-03-05 21:17:24', '2026-03-05 21:17:24'),
(7, 'B-07', '辛味房 赤龍（しんみぼう せきりゅう）', '本格四川の技を受け継ぐ辛味料理専門店。花椒を効かせた「しびうまラー油餃子」が人気で、辛党ファンが多数来店。', 0, '2026-03-05 21:17:24', '2026-03-05 21:17:24');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- テーブルのインデックス `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_ibfk_1` (`state`);

--
-- テーブルのインデックス `contact_status`
--
ALTER TABLE `contact_status`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faq_ibfk_1` (`category`);

--
-- テーブルのインデックス `faq_categories`
--
ALTER TABLE `faq_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sort_order` (`sort_order`);

--
-- テーブルのインデックス `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shopid_ibfk_1` (`shop_id`);

--
-- テーブルのインデックス `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `contact_status`
--
ALTER TABLE `contact_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- テーブルの AUTO_INCREMENT `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- テーブルの AUTO_INCREMENT `faq_categories`
--
ALTER TABLE `faq_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- テーブルの AUTO_INCREMENT `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- テーブルの AUTO_INCREMENT `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`state`) REFERENCES `contact_status` (`id`);

--
-- テーブルの制約 `faq`
--
ALTER TABLE `faq`
  ADD CONSTRAINT `faq_ibfk_1` FOREIGN KEY (`category`) REFERENCES `faq_categories` (`id`);

--
-- テーブルの制約 `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `shopid_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
