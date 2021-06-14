-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Apr 2021 pada 03.50
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bulletinboard`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bulletins`
--

CREATE TABLE `bulletins` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bulletins`
--

INSERT INTO `bulletins` (`id`, `title`, `body`, `created_at`) VALUES
(16, 'sdasdsdasdpoas', 'dasdsdasdkldldasdasd;adl;ayjuyjjyu', '2021-04-27 06:49:22'),
(17, 'sdasdsdasdpoas', 'dasdsdasdkldldasdasd;adl;ayjuyjjyu', '2021-04-27 06:49:22'),
(18, 'sdasdsdasdpoas', 'fsdjfsdofsdoopg', '2021-04-27 06:50:58'),
(19, 'sdasdsdasdpoas', 'fsdjfsdofsdoopg', '2021-04-27 06:50:58'),
(20, 'vcvxcvxcvxcvxvxc', 'FDSFDFSDFSFSFSFSSF', '2021-04-27 06:54:31'),
(21, 'vcvxcvxcvxcvxvxc', 'FDSFDFSDFSFSFSFSSF', '2021-04-27 06:54:31'),
(22, 'vcvxcvxcvxcvxvxc', 'FDSFDFSDXCASDASDADAFSFSFSFSSF', '2021-04-27 06:55:31'),
(23, 'vcvxcvxcvxcvxvxc', 'FDSFDFSDXCASDASDADAFSFSFSFSSF', '2021-04-27 06:55:31'),
(24, 'vcvxcvxAAAAAcvxcvxvxc', 'FDSFDFSDXCASDASDADAFSFSFSFSSF', '2021-04-27 06:56:59'),
(25, 'vcvxcvxAAAAAcvxcvxvxc', 'FDSFDFSDXCASDASDADAFSFSFSFSSF', '2021-04-27 06:56:59'),
(26, 'AAADDDDAAA', 'DDDAAAADDDDF', '2021-04-27 06:58:41'),
(27, 'AAADDDDAAA', 'DDDAAAADDDDF', '2021-04-27 06:58:41'),
(28, 'GFSJKFSKLFS', 'DFSDSDFSLFDSFL', '2021-04-27 06:59:46'),
(29, 'FDFMDFLDFLD;FDFL;', 'DFSL;FSDL;FSL;FSL;', '2021-04-27 07:00:49'),
(30, 'Porro sit ea porro qui natus.', 'Tempore qui error reprehenderit sed. Id voluptas reprehenderit qui quisquam et mollitia. Cumque facere sit qui perferendis beatae. Necessitatibus necessitatibus rerum voluptatem alias fuga qui id.', '2021-04-28 04:04:05'),
(31, 'Omnis quae ut omnis est.', 'Ratione sequi dolore praesentium. Asperiores perferendis adipisci inventore aut est vel. Sed eius eos et doloribus quasi quisquam voluptatibus.', '2021-04-28 04:04:05'),
(32, 'Fuga et maiores itaque quo.', 'Eaque minima et occaecati culpa. Ratione voluptatum hic labore aut aut corporis assumenda. Animi sed id aliquid repellat incidunt itaque voluptatem.', '2021-04-28 04:04:05'),
(33, 'Dolorem quia ea ducimus.', 'Consequatur sequi a consectetur sed nemo autem. Adipisci doloremque soluta est voluptatem. Doloribus sint qui ipsam cupiditate. Aliquam debitis vel voluptas saepe eius temporibus sit aut.', '2021-04-28 04:04:05'),
(34, 'Aut vitae in earum nemo ex.', 'Mollitia veniam doloribus enim excepturi. Consequuntur reprehenderit consequatur iure ipsam officia. Sit incidunt dolore eveniet earum.', '2021-04-28 04:04:05'),
(35, 'Et inventore officia atque qui.', 'Mollitia perferendis magni ea accusamus. Unde ut corrupti dolores aut. Sunt tenetur rerum et ut veniam fugit optio. Et doloribus consequatur nesciunt error assumenda odio.', '2021-04-28 04:04:05'),
(36, 'Quis ipsa repudiandae sapiente.', 'Maxime dolorum ducimus sequi ut neque iure. Illum magnam numquam totam facere ipsam qui quis ut. Facere sint sed voluptatum consequatur ad sapiente rerum natus.', '2021-04-28 04:04:05'),
(37, 'Ut quam nostrum ipsa ea rem.', 'Sint hic et sit corrupti hic. Aut consectetur nam consequatur nulla. Dolorum ullam rerum quia. Laudantium corrupti rem sint quidem rerum quae aut architecto. Fuga tenetur aliquam et doloribus.', '2021-04-28 04:04:05'),
(38, 'Tempore ut libero iste et ut.', 'Cum qui itaque eum. Et nam iste illo sit eligendi numquam iusto. Sint magni optio impedit rerum occaecati exercitationem ipsum.', '2021-04-28 04:04:06'),
(39, 'Nostrum id accusamus nihil.', 'Vero accusantium aut explicabo eligendi sequi aut est. Nisi dicta molestias facere quia consectetur nihil. Eveniet consequuntur deleniti iste hic totam.', '2021-04-28 04:04:06'),
(40, 'Eius libero magnam error.', 'Aut consequatur voluptatem libero at rem omnis. Qui consequatur dolorum ratione quo consequatur dolore praesentium. Voluptas corrupti minus alias aperiam at officia.', '2021-04-28 04:04:06'),
(41, 'Sit aliquam rerum itaque aut.', 'Aut expedita ut nesciunt iusto dolorum et sint sapiente. Aut ea modi quos quidem officia. Libero omnis vitae velit enim voluptatem et.', '2021-04-28 04:04:06'),
(42, 'Non quos nihil ex.', 'Asperiores a doloribus nihil sit dolorem. Non molestias qui et nostrum. Impedit blanditiis veniam qui minima explicabo libero.', '2021-04-28 04:04:06'),
(43, 'Aut quo sed sit sunt.', 'Repellat maiores deleniti expedita aut fugit quisquam et. Doloribus et ratione eos libero officiis officiis. Laboriosam quisquam officia voluptas esse quis.', '2021-04-28 04:04:06'),
(44, 'Nemo sapiente optio ut ratione.', 'Aut cupiditate repellat quis iure magni ex. Cum consequatur earum eius. Optio et veniam corporis. Nam blanditiis et dolores quia ut.', '2021-04-28 04:04:06'),
(45, 'Voluptatem cumque eos est.', 'Dolore dolorum blanditiis minus quam nobis consectetur doloremque. Pariatur placeat autem eos quis consequatur odit ex. Est quaerat repudiandae esse aut. Est fugit ducimus excepturi voluptates atque.', '2021-04-28 04:04:06'),
(46, 'Eius dolores sapiente et.', 'Voluptatem consequatur rerum quas qui. Voluptas odit minima quasi occaecati rem qui. Qui autem atque ab doloribus eos adipisci.', '2021-04-28 04:04:06'),
(47, 'Hic nihil sequi iusto non.', 'Atque ut velit voluptatum debitis quas est. Numquam dolorum vero facilis iusto et fuga quo. Aut corrupti vel et. Esse veniam velit non accusantium.', '2021-04-28 04:04:06'),
(48, 'Qui fugit est rerum id.', 'Ut eos aut consectetur consequatur autem eum. Et tempore necessitatibus cumque tempora consequatur. Nostrum atque non repudiandae dicta.', '2021-04-28 04:04:06'),
(49, 'Doloremque sed ex eaque rem.', 'Eius tempore cupiditate itaque maxime commodi. Est ad similique omnis ipsa vitae doloremque nam. Corrupti et eum vitae aliquid. Amet omnis necessitatibus ratione odio in quam ut.', '2021-04-28 04:04:06'),
(50, 'Et vel nam sequi incidunt.', 'Sit sed nisi molestiae neque. Et aspernatur est voluptas est. Eligendi molestiae repellendus pariatur. Enim perspiciatis non in voluptas aut dicta et.', '2021-04-28 04:04:06'),
(51, 'Quis dolores ex veniam numquam.', 'Ad quia consequuntur rerum saepe. Sit sit iste ab cumque ab officiis eos quisquam. Hic est qui dolorem aliquid nulla saepe.', '2021-04-28 04:04:06'),
(52, 'Dolorum beatae recusandae ea.', 'Facere amet voluptatum qui inventore. Et illo est mollitia officia. Aliquam porro quis aperiam laborum placeat aliquam.', '2021-04-28 04:04:07'),
(53, 'Ut magni ullam a perspiciatis.', 'Voluptates eius atque omnis molestiae sed voluptates numquam. Provident expedita fugit nostrum neque.', '2021-04-28 04:04:07'),
(54, 'Et qui dolorem in quia.', 'Eligendi totam enim inventore est. Dolores sit non autem. Qui inventore in sint unde eius ut nobis. Aut odit voluptatem odit minima natus et.', '2021-04-28 04:04:07'),
(55, 'Aspernatur quis eius molestias.', 'Culpa eaque alias veritatis quia. Esse nulla veritatis est est. Ea et quis non totam. Ratione sit tempore et totam et.', '2021-04-28 04:04:07'),
(56, 'Harum labore repellat et.', 'Minima ea dolor quis. Dolorum voluptas ut velit magni rerum. Dolorum autem laudantium rerum. Consectetur ullam dolores quia recusandae est dolores culpa.', '2021-04-28 04:04:07'),
(57, 'Maxime non nostrum sunt.', 'Voluptatibus et veritatis reprehenderit veniam. Qui ut cum nobis inventore nostrum quae. Voluptatem aliquam voluptas assumenda officia soluta. Quam voluptate voluptates velit est.', '2021-04-28 04:04:07'),
(58, 'Culpa ex qui aut.', 'Eius consequuntur voluptates eum asperiores nisi impedit. Ipsum quo beatae magni quia totam eum. Sunt magnam cupiditate ea eos nobis maxime beatae.', '2021-04-28 04:04:07'),
(59, 'Harum vel nemo est.', 'Sequi distinctio omnis reiciendis commodi. Consequatur fugit atque hic enim. Amet quod dolorem inventore omnis voluptatem. Architecto qui eos quas rem.', '2021-04-28 04:04:07'),
(60, 'Ut est qui et corrupti.', 'Accusamus explicabo rerum similique sapiente excepturi rerum non. Voluptate minima perferendis illo qui consequatur accusamus. Inventore nesciunt incidunt sint qui cumque nesciunt.', '2021-04-28 04:04:07'),
(61, 'Corrupti dolor quos eum.', 'Quo eveniet doloribus et velit quisquam. Dolorem voluptate qui expedita vel. Quo voluptates nisi sed nemo.', '2021-04-28 04:04:07'),
(62, 'In esse eum eos culpa.', 'Reprehenderit qui nemo nobis earum. Atque aut sed molestias. Sit qui delectus quia aut expedita in asperiores.', '2021-04-28 04:04:07'),
(63, 'Perspiciatis omnis et et est.', 'Sunt odit iure debitis omnis voluptatem. Ullam ex ut quo velit et et. Autem ullam dignissimos labore nemo delectus.', '2021-04-28 04:04:07'),
(64, 'Possimus et dicta aut sit.', 'Suscipit et accusantium quo numquam blanditiis. Fugiat sit velit qui consequatur quo nostrum. Rerum corporis quo corporis qui.', '2021-04-28 04:04:07'),
(65, 'Et iure velit qui aperiam quia.', 'Id ratione non aut fuga sunt. Adipisci sed quas et quia quia iure dignissimos. Nulla corporis laboriosam ipsum quo commodi.', '2021-04-28 04:04:07'),
(66, 'Dolor minima sunt ex ut.', 'Aut est cumque et cumque fugiat qui et. Exercitationem est tempora doloribus beatae.', '2021-04-28 04:04:07'),
(67, 'Qui consequatur illum dolores.', 'Et saepe minus voluptatem eos optio et et. Perferendis neque in ratione qui accusantium veritatis iusto fuga. Voluptatem nihil aut enim totam.', '2021-04-28 04:04:07'),
(68, 'Sapiente fugit eos omnis.', 'Culpa non optio magni consequatur expedita. Velit dolor vero dignissimos et omnis nihil. Doloribus reprehenderit nobis reprehenderit porro.', '2021-04-28 04:04:07'),
(69, 'Nulla cum reiciendis vero.', 'Et aperiam molestiae eius illum. Voluptatibus dolor ullam velit. Repellat aut unde explicabo consequatur omnis earum vero.', '2021-04-28 04:04:08'),
(70, 'A ut qui qui et.', 'Dolore ut provident ipsum reiciendis voluptates labore ab asperiores. Et odio itaque officiis fuga magnam dolores. Accusamus eius dignissimos officia doloribus.', '2021-04-28 04:04:08'),
(71, 'Cumque et doloribus et ut.', 'Ducimus porro explicabo non architecto perspiciatis sunt. Voluptate ipsa et dolor quos aut assumenda ratione autem.', '2021-04-28 04:04:08'),
(72, 'Et porro et corporis nulla.', 'Nisi voluptas rerum occaecati aliquam qui quo ea. Ut quo natus dolorum et maxime. Dolores omnis quo sunt. Dicta et quia consequatur. Natus enim sit adipisci enim. Quo quo illo et tempora maxime.', '2021-04-28 04:04:08'),
(73, 'Dolorum beatae quia ab quaerat.', 'Non omnis cum vero est autem enim. Quo odit id pariatur sunt. Quidem deserunt accusamus molestiae. Eos quo laudantium et id qui ut.', '2021-04-28 04:04:08'),
(74, 'Facere et ipsa et.', 'Quis architecto quam ullam repudiandae quia dolores. Et quia quae ullam aut et illum id dicta. Hic veritatis sint sapiente.', '2021-04-28 04:04:08'),
(75, 'sjsjsjsjsjsjsj', 'dfklflfkxdlsdl', '2021-04-28 05:47:44'),
(76, 'dhhhhhhaaaa ddjdjd', 'dhddhh dhdhdh dhdh', '2021-04-28 05:47:57'),
(77, 'ddhhdhhkf dfdfsdk', 'dsdksskfdfjldkf', '2021-04-28 05:48:07'),
(78, 'ddjdod dsdoadoa sdao', 'dsajdoasd sdoda ooop', '2021-04-28 05:49:24'),
(79, 'sdjkfjkff fdfsdjdf dfsdk', 'djkddjksdsd', '2021-04-28 05:51:57'),
(80, 'Repellat debitis velit qui.', 'Facere et dolorum accusamus ut. Distinctio qui natus fugiat et neque ipsa dolor.', '2021-04-28 06:41:13'),
(81, 'Sed odit minima cum qui.', 'Asperiores placeat sed consequatur quam rem corrupti dolorem ut. Pariatur sint veniam facere voluptatem. Ut expedita labore odit incidunt dolor quisquam.', '2021-04-28 06:41:13'),
(82, 'Iusto earum enim quod dolore.', 'Voluptas sunt ut veniam tempora voluptas magni. Minus non illum et itaque ipsum et. Nihil distinctio voluptates sint blanditiis eius. Rerum libero perferendis aut placeat.', '2021-04-28 06:41:13'),
(83, 'Quo recusandae fuga qui aut.', 'Hic quo corporis velit qui aspernatur facilis in. Necessitatibus molestias saepe ut modi. Quia ad ut aut facilis cumque aut laboriosam. Est ab minima possimus officiis velit fugiat.', '2021-04-28 06:41:13'),
(84, 'Eum qui quisquam doloremque.', 'Dolorem adipisci quae qui et id non sit. Eligendi blanditiis quasi sed dignissimos ut. Commodi cupiditate harum aliquid at iure.', '2021-04-28 06:41:13'),
(85, 'Ut quasi asperiores ratione.', 'Quia esse optio est sed nobis. Asperiores commodi voluptas quia consequatur quasi qui. Accusantium repellendus odio sed rem accusamus. Beatae eum magni laborum corrupti et non vel.', '2021-04-28 06:41:13'),
(86, 'Quis nulla autem at iste porro.', 'Ea culpa totam qui odio placeat voluptas. Et doloremque non atque exercitationem recusandae eos.', '2021-04-28 06:41:13'),
(87, 'Impedit atque et numquam.', 'Voluptatum omnis vel vero reiciendis adipisci unde eum. Molestias corporis maxime illo fuga nobis deserunt. Eius harum voluptatibus ut dolorem tempora rerum vero.', '2021-04-28 06:41:13'),
(88, 'Quidem nesciunt nisi minima.', 'Consequatur quia in est in qui quia. Non quia facere id repellat.', '2021-04-28 06:41:13'),
(89, 'Velit velit quis facilis sit.', 'Error esse non voluptates pariatur dolor. Non nesciunt rerum itaque omnis et. Esse est quis et vel quisquam voluptatum. Sit ad nobis qui et.', '2021-04-28 06:41:13'),
(90, 'Expedita et quos tenetur qui.', 'Ut rem et aliquam consectetur rerum. Placeat alias non sunt deleniti sint et voluptatem reprehenderit. Voluptates sint velit voluptas sint. Nobis laboriosam aut non repellat esse aliquid doloribus.', '2021-04-28 06:41:13'),
(91, 'Et sunt sunt ut dolores.', 'Quae a earum amet aspernatur et autem quia. Sit odit sit consectetur aut harum eveniet vitae. Iste vitae nostrum qui quia deserunt et nemo aut. Et quis aut velit soluta rerum aut aut quo.', '2021-04-28 06:41:13'),
(92, 'Atque est magnam accusamus rem.', 'Nulla nam exercitationem laudantium aut accusamus ratione accusantium illo. Et ad et qui asperiores nemo quos.', '2021-04-28 06:41:13'),
(93, 'Non sapiente accusantium sint.', 'Repudiandae quia sit esse unde ducimus. Ut quos voluptatem autem qui officiis ut id. Qui tenetur dolorem nemo alias. Aspernatur aut dolor optio eveniet.', '2021-04-28 06:41:13'),
(94, 'Rerum vel minus ut nobis.', 'Placeat mollitia pariatur maxime sunt. Architecto qui eum et dolore atque et. Et sit sequi voluptas id qui officia dolor.', '2021-04-28 06:41:13'),
(95, 'Iure et voluptates quo aut.', 'Sunt quisquam aperiam alias ipsam. Non laudantium saepe asperiores aut perferendis ea. Omnis dolor esse ipsum praesentium itaque reiciendis et voluptate. Porro quisquam adipisci eos repellendus ab.', '2021-04-28 06:41:13'),
(96, 'Id sunt vel odit.', 'Eum cumque sunt perspiciatis nostrum pariatur. Dignissimos quos aperiam atque veritatis culpa aspernatur delectus. At aperiam dicta atque molestias eos.', '2021-04-28 06:41:13'),
(97, 'Ducimus et amet accusamus.', 'Dignissimos occaecati ducimus quia. Eos voluptas necessitatibus eos possimus. Vitae at quasi itaque eos ipsum et cumque.', '2021-04-28 06:41:13'),
(98, 'Et natus est voluptas rerum.', 'Porro delectus ut debitis quam et consequatur sequi. Omnis debitis vitae eos enim. Autem ea asperiores accusantium aliquam quia enim.', '2021-04-28 06:41:13'),
(99, 'Sit cumque recusandae non.', 'Quae sit nobis et et accusamus vel facere. Quo cum temporibus tempora non est non in minima. Molestias eaque eum aut corporis. Alias sed saepe aut suscipit tenetur dolore iste saepe.', '2021-04-28 06:41:14'),
(100, 'Illo in aut consequatur in.', 'In deserunt aut voluptate. Nisi amet ut magni quia. Repudiandae sed est quisquam rerum.', '2021-04-28 06:41:14'),
(101, 'Rerum nemo eos et omnis.', 'Voluptas eum vero harum. Iste rem est consequatur soluta. Sint assumenda eum architecto placeat porro. Laborum aut quod iusto soluta.', '2021-04-28 06:41:14'),
(102, 'Aliquam officia eveniet facere.', 'Illo commodi quis harum aut dolore nam. Quidem ut ex corrupti quae deserunt aperiam blanditiis alias. Blanditiis consectetur sit nesciunt nostrum numquam nostrum earum.', '2021-04-28 06:41:14'),
(103, 'Et quia dolor sed officia.', 'Et sit eum sint reiciendis inventore qui. Voluptatum eos ea omnis eum ut. Rem nihil expedita aut nam.', '2021-04-28 06:41:14'),
(104, 'Id et qui quos.', 'Qui officia consequatur voluptatem cum ut quia. Asperiores nulla doloremque nam amet. Autem et enim quia in necessitatibus modi. Qui voluptas perspiciatis nam officiis pariatur.', '2021-04-28 06:41:14'),
(105, 'Hic ab est dolores.', 'Qui iure voluptates necessitatibus iste deleniti est. Asperiores vero veritatis aut quaerat odio laborum doloremque atque. Odit animi consequatur dolores autem sint ipsa est.', '2021-04-28 06:41:14'),
(106, 'Quo rerum sit nobis.', 'Aut provident est qui velit nihil totam. Placeat quas vero voluptatem atque. Necessitatibus reiciendis reprehenderit eos animi ipsa animi voluptatem. Alias quas est veniam sint eos et aut.', '2021-04-28 06:41:14'),
(107, 'Vel assumenda sed dolor id.', 'Quas et veritatis repellendus repudiandae omnis a molestiae. Eveniet quis minima ut deleniti voluptatem itaque veritatis eligendi. Consequatur laboriosam ea consequatur non in.', '2021-04-28 06:41:14'),
(108, 'Sapiente facilis aperiam quia.', 'Sapiente illo asperiores quia ipsum dolor. Ea vel autem similique. Autem ut eum autem id officia.', '2021-04-28 06:41:14'),
(109, 'At ducimus omnis nemo repellat.', 'Sint voluptatem sed repellendus doloremque quia odio. Iste autem quia non ut deserunt exercitationem. Corrupti doloribus deserunt dolorem. Vitae quo dolorem quia aspernatur.', '2021-04-28 06:41:14'),
(110, 'Dolores aliquam id rem.', 'Enim autem dolor sed voluptates. Quae et repudiandae tempora similique repellendus. Ut quis qui consectetur. A sit blanditiis repellendus et.', '2021-04-28 06:41:14'),
(111, 'In impedit et omnis et alias.', 'Nihil voluptatem dolor harum enim consectetur ut eligendi quidem. Autem minus totam occaecati. Sit molestias quasi harum et explicabo. Quia ratione consequatur perspiciatis.', '2021-04-28 06:41:14'),
(112, 'Ea eum voluptatem sit est.', 'Minima delectus id in dolor. Veniam suscipit quas esse sint corporis sequi. Vitae modi consequatur aut ut.', '2021-04-28 06:41:14'),
(113, 'Omnis officiis omnis optio.', 'Omnis nihil accusamus est architecto. Quisquam incidunt minima quis porro minima. Saepe sapiente magni aut ut. Et quaerat autem consequuntur commodi error at.', '2021-04-28 06:41:14'),
(114, 'Sit est nemo pariatur non.', 'Aut magnam laborum tenetur iure et. Libero doloremque est sunt qui similique. Autem omnis culpa et distinctio debitis aut ut.', '2021-04-28 06:41:14'),
(115, 'Soluta porro molestias ea.', 'Aliquid et vel aliquid corrupti qui. Impedit repellendus ducimus ad vel. Tenetur nihil expedita tenetur nemo harum eveniet. In et cum explicabo accusantium beatae non.', '2021-04-28 06:41:15'),
(116, 'fhdfhdfjjkdf', 'fhdfjdkfkdfjkdf', '2021-04-28 09:25:39');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bulletins`
--
ALTER TABLE `bulletins`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bulletins`
--
ALTER TABLE `bulletins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
