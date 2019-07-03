-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2019 at 01:50 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `letjovanje_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `anketa_glas`
--

CREATE TABLE `anketa_glas` (
  `id` int(10) NOT NULL,
  `odgovor_id` int(30) DEFAULT NULL,
  `ip` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anketa_glas`
--

INSERT INTO `anketa_glas` (`id`, `odgovor_id`, `ip`) VALUES
(1, 2, '24.135.215.135'),
(2, 1, '109.245.34.27'),
(3, 3, '24.135.237.239'),
(4, 2, '62.193.153.157'),
(5, 2, '24.135.219.162'),
(6, 2, '217.65.199.81'),
(7, 2, '217.65.199.81'),
(8, 2, '24.135.215.135'),
(9, 1, '89.216.97.224'),
(10, 1, '89.216.97.224'),
(11, 1, '89.216.97.224'),
(12, 1, '89.216.97.224'),
(13, 1, '91.150.69.60');

-- --------------------------------------------------------

--
-- Table structure for table `anketa_odgovor`
--

CREATE TABLE `anketa_odgovor` (
  `id` int(30) NOT NULL,
  `tekst` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `br_glasova` int(5) DEFAULT '0',
  `pitanje_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anketa_odgovor`
--

INSERT INTO `anketa_odgovor` (`id`, `tekst`, `br_glasova`, `pitanje_id`) VALUES
(1, 'Krit', 6, 1),
(2, 'Tajland', 6, 1),
(3, 'Evija', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `anketa_pitanje`
--

CREATE TABLE `anketa_pitanje` (
  `id` int(10) NOT NULL,
  `tekst` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aktivna` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anketa_pitanje`
--

INSERT INTO `anketa_pitanje` (`id`, `tekst`, `aktivna`) VALUES
(1, 'Post meseca?', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `galerija`
--

CREATE TABLE `galerija` (
  `id` int(255) NOT NULL,
  `naslov` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `putanja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galerija`
--

INSERT INTO `galerija` (`id`, `naslov`, `alt`, `putanja`) VALUES
(1, 'Plaža 1', 'plaža1', 'img/gallery/gallery-1.jpg'),
(2, 'Plaža 2', 'plaža2', 'img/gallery/gallery-2.jpg'),
(3, 'Plaža 3', 'plaža3', 'img/gallery/gallery-3.jpg'),
(4, 'Plaža 4', 'plaža4', 'img/gallery/gallery-4.jpg'),
(5, 'Plaža 5', 'plaža5', 'img/gallery/gallery-5.jpg'),
(6, 'Plaža 6', 'plaža6', 'img/gallery/gallery-6.jpg'),
(7, 'Plaža 7', 'plaža7', 'img/gallery/gallery-7.jpg'),
(8, 'Plaža 8', 'plaža8', 'img/gallery/gallery-8.jpg'),
(9, 'Plaža 9', 'plaža9', 'img/gallery/gallery-9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id` int(30) NOT NULL,
  `tekst` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `datum` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `korisnik_id` int(11) NOT NULL,
  `post_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id`, `tekst`, `datum`, `korisnik_id`, `post_id`) VALUES
(1, 'Zvuči zanimljivo...', '2018-06-10 10:06:18', 6, 5),
(2, 'Sjajan tekst!', '2018-06-10 10:12:20', 4, 5),
(3, 'Uuu, ide mi se tamo :D', '2018-06-10 10:18:22', 5, 5),
(7, 'Kolega Rankoviću, sajt KIDA, nadam se da ste raspoloženi da putujete na Tajland sa mnom.', '2018-06-23 13:32:56', 3, 4),
(8, 'čao čao od Maje Majić poyy', '2018-06-23 13:37:56', 5, 4),
(9, 'Vidi je ova Bojana bitcharka XEXE', '2018-06-23 13:38:15', 5, 4),
(10, 'RANKOVIĆ JE SAMO MOJ ODABIJTE SVE !', '2018-06-23 13:40:08', 5, 4),
(11, 'Koleginice Majić, mislim da ste promašili epistemološku suštinu i iskazali izuzetnu nedorečenost kao bit ovog nesvakidašnjeg bloga. Mislite o tome.', '2018-06-23 13:44:10', 4, 4),
(12, 'ALO BRE ?!?!?! Vidi je ova bitcharka se javlja! Jel ti nije dovoljno shto sam ti skinula dechka ', '2018-06-23 13:46:12', 5, 4),
(13, 'Koleginice molim vas! Rankovića ima za sve nas, budite mirne.', '2018-06-23 13:47:30', 3, 4),
(14, 'Tačno. Ovde se potpuno vidi simplifikovani pristup krajnje složenom fenomenu čovekove gluposti. U potpunosti je izraženo vulgarno minimizirane i suženje svedeno na etičke kodekse. Jedino valjan put za prevazilaženje ovih deontoloških himera je svakako sistematično razvijanje filozofije morala u okviru ove tematike. Mislite o tome. ', '2018-06-23 13:52:46', 4, 4),
(23, 'Jedva čekamo tekst sa Kavosa! ', '2018-06-25 13:09:28', 8, 5),
(26, 'test', '2018-06-25 13:10:53', 8, 3),
(32, 'Test2', '2018-06-25 18:27:42', 6, 3),
(33, 'Test3', '2018-06-25 18:29:04', 5, 3),
(37, 'Test8', '2018-06-25 18:29:39', 5, 3),
(38, 'Test9', '2018-06-25 18:31:35', 3, 3),
(39, 'Test10', '2018-06-25 18:31:41', 3, 3),
(40, 'Yotzar plodi!', '2018-06-26 21:52:57', 12, 5),
(42, 'Majko presveta...', '2018-06-26 22:29:01', 12, 4),
(46, 'sjajno', '2018-07-02 00:58:34', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prezime` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lozinka` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datum` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `aktivan` bit(1) DEFAULT NULL,
  `uloga_id` int(11) NOT NULL,
  `slika` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'img/users/empty.jpg',
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `email`, `lozinka`, `datum`, `aktivan`, `uloga_id`, `slika`, `token`) VALUES
(1, 'Luka', 'Lukić', 'luka.lukic@ict.edu.rs', '69a939d1fb39cff508d1fe26f8317c59', '2018-06-20 12:00:00', b'1', 1, 'img/users/luka.jpg', NULL),
(2, 'Jovan', 'Ranković', 'jovan.rankovic@ict.edu.rs', '029e3a5e4ce5d013abf860860e644319', '2018-06-20 12:00:01', b'1', 1, 'img/users/admin.jpg', NULL),
(3, 'Bojana', 'Barać', 'bojana@gmail.com', 'da072c32e127424c6f8d92c1403e60b1', '2018-06-20 12:00:02', b'1', 1, 'img/users/bojana.jpg', NULL),
(4, 'Ana', 'Anić', 'ana@gmail.com', '5390489da3971cbbcd22c159d54d24da', '2018-06-20 12:00:03', b'1', 2, 'img/users/ana.jpg', NULL),
(5, 'Maja', 'Majić', 'maja@gmail.com', 'd855db9851db7dfa20b86d44dd2c753a', '2018-06-20 12:00:04', b'1', 2, 'img/users/maja.jpg', NULL),
(6, 'Pera', 'Perić', 'pera@gmail.com', 'bf676ed1364b5857fba69b5623c81b64', '2018-06-20 12:00:05', b'1', 2, 'img/users/pera.jpg', NULL),
(8, 'Deni', 'Denić', 'deni@hotmail.com', 'a8113b1772317b4a920ef248123d76b3', '2018-06-25 13:04:39', b'1', 2, 'img/users/1530086122855202564CAM00209.jpg', '27a9bc6a4ece28c383c0b71598ec5da6'),
(12, 'Lazar', 'Djoković', 'lazar.djokovic@ict.edu.rs', '0698d4ca4100fa10e93feaf3a91878ba', '2018-06-26 21:50:16', b'1', 2, 'img/users/1530049950113445912521617998_1669305736427094_3119274567523188428_n.jpg', '7786f7706d4b0cb238d99fead2195ac6'),
(13, 'Nemanja', 'Lukić', 'nemanja.lukic@ict.edu.rs', 'd0aeeef9a9aeddbaa999b7b65101b3a1', '2018-07-02 01:04:40', b'1', 2, 'img/users/1530493480367100662slika.png', NULL),
(14, 'Nikola', 'Erić', 'nikola@gmail.com', 'a646e457db47ad218d6d9d3ce325878b', '2018-07-05 09:37:16', b'1', 1, 'img/users/empty.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `link`
--

CREATE TABLE `link` (
  `id` int(5) NOT NULL,
  `naslov` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pozicija` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `link`
--

INSERT INTO `link` (`id`, `naslov`, `url`, `pozicija`) VALUES
(1, 'Početna', 'index.php', 1),
(2, 'Kontakt', 'index.php?stranica=kontakt', 2);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(100) NOT NULL,
  `naslov` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tekst` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `datum` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `korisnik_id` int(11) NOT NULL,
  `slika` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `naslov`, `tekst`, `datum`, `korisnik_id`, `slika`) VALUES
(1, 'Santorini', 'Poželeli smo da odemo na krstarenje. Želeli smo nešto bliže, pa smo odabrali grčka ostrva, krstarenje Mediteranom, odnosno krstarenje istočnim Mediteranom. Obišli smo fantastične destinacije. Malo turske obale, tačnije Kušadasi, Efes, a malo više grčkih ostrva: Mikonos, Krit, Patmos, Rodos...\r\n\r\nOstrvo koje je na mene definitivno ostavilo najveći utisak, kao tzv. \"highlight\" celog krstarenja je ostrvo Santorini. Prva asocijacija na Santorini su bele kuće, kaskadno poređane, zbog konfiguracije samog ostrva, i plavo ofarbana vrata i prozori uz preslatke bugenvilije. I to zaista uživo deluje fantastično. Ostrvo je jedinstveno, živopisno, raznobojno. Vulkanskog je porekla, i to se da primetiti po reljefu, plažama, bojama... Zemlja je crvenkasta, a plaže bele, crne i crvene, zapanjujuće litice.\r\nVetrenjače, pećinska naselja, više od 600 crkava... bitna obeležja ostrva, koje neću zaboraviti, kao ni celo krstarenje.\r\nDa ostrvo nije poznato samo po vulkanima i reljefnim oblicima nastalim pod uticajem rada vulkana i seizmičkih pokreta, \"pobrinula\" su se pojednima vrlo simpatična mesta na ostrvu. Na mojoj listi, prvo mesto zauzima selo Oija. Predivna atmosfera, predivan ambijent. Selo sa boemskim šmekom. Selo je malo. Bukvalno jedna ulica i nekoliko kuća, klasičneog kikladskog tipa, sa nekoliko malenih galerija. Na najvećoj površini je hotel sa velikim brojem bazena, stepensato poređanih. Ukoliko želite, možete se žičarom (koja je izgrađena 1979. godine) spustiti do luke stare Fire, ili pak peške niz 588 stepenika, ili jašući na magarcu...U staroj Firi se nalazi dosta prodavnica, gde možete naći pregršt suvenira, koji će krasiti neki kutak u Vašem domu i podsećati Vas na nezaboravno krstarenje.\r\nDrugo interesantno mesto je Fira. Izuzetno ekskluzivno mesto, skupo mesto, počev od zemljišta, pa do ugostiteljskih usluga. Stecište umetnika i poznatih ličnosti. \r\nAkrotiri je takođe mesto vredno pomena. Može se reći da selo predstavlja arheološko nalazište neolitskog tipa, tačnije iz 5 veka pre nove ere. Nekada je bilo naseljeno. Tadašnji stanovnici su napustili ostrvo zbog vulkanske erupcije. Vulkanski pepeo je prekrio i konzervisao  ceo Akrotiri, te sačuvao građevine i mnogobrojne freske.\r\nKažu da je Santorini veoma uzbudljiv noću, ali nas je put navodio dalje, ka sledećem sredozmnom dragulju, te smo žurili...', '2018-06-06 00:00:00', 2, 'img/blog/blog5.jpg'),
(2, 'Tasos', 'Jedinstvena lepota Mermerne plaže, zalazak sunca na Atspasu i kupanje u prirodnom bazenu Giola samo su neki od doživljaja koji vas očekuju na smaragdnom ostrvu! Uzivajte u letu 2017 na Tasosu, ostrvu nadaleko poznatom po čistim plažama, kvalitetnom vinu i ukusnom medu. \r\n \r\nParadise beach \r\nPlaža koja sa pravom nosi ovo ime! Sitan pesak, omamljujući zvuk talasa i koktel iz obližnjeg bara su sve što vam treba za savršeni odmor, a što ćete naći upravo ovde. \r\nPlaža je takođe pogodna za porodične ljude, koji mogu da uživaju u prelepom ambijentu dok se njihova deca kupaju u plićaku koji je dug do 30 metara. Talasi su takođe karakteristika Paradise plaže, tako da zadovoljstvu mališana neće biti kraja. \r\nPrilaz: Od Potosa, istočnom stranom, vozite magistralom oko 30 km. Od magistrale do plaže vodi zemljani u nekim delovima veoma uzak put, zbog čega se mnogi odlučuju da parkiraju svoj automobil pored magistrale, iako postoji parking uz plažu. Ne očajavate, jer pešaka do ovog raja na zemlji vam treba nekih sedam minuta nakon što se parkirate. \r\nSadržaj:  Na plaži možete se opustiti i uživati u obroku u restoranu, ili pak u nekom od koktela iz bara. \r\n\r\nMermerna plaža\r\nFini pesak pomešan sa milionima sitnih, belih komadića mermera, kog su čak i antički Grci koristili za izradu svojih hramova, učinili su Mermernu plažu nadaleko poznatom! \r\nPrilaz: Mermerna plaža je smeštena u maloj, usamljenoj uvali i nije pristupačna putem. Za one koji žele da je posete, trebalo bi da se usmere na hotelsko - apartmanski kompleks Makriamos, od kojeg postoji zemljani put, sa naznakom „Saliara Beach“, odakle ima 5 km. Možete se dobro pripremiti i do nje krenuti peške ili se usuditi da idete kolima, uprkos neasfaltiranom putu i beloj mermernoj prašini. Plaža je na kraju puta, a prizor koji ćete videti je dovoljna nagrada za vašu upornost - mermerni šljunak i nestvarno plavo more. \r\nSadržaj:  Na plaži je zabranjeno unositi svoje suncobrane i ležaljke, te tako neće vam biti teško da se opredelite za neki od onih koji se nalaze na plaži. Ugođaj vam može upotpuniti neko od osveženja iz egzotičnog bara. \r\n\r\nAtspas (Šećerna plaža)\r\nOno što će Vas na ovoj plazi oduševiti je čarobni zalazak sunca, koji će vam zauvek ostati u sećanju! Ovu malu peščanu plažu odlikuje kristalno čista voda sa postepenim ulaskom koja je idealna za boravak porodica sa decom. \r\nPrilaz: Plaža se nalazi na ulasku u Skalu Marijes iz pravca Limenarije i na njoj su vam dostupne lezaljke, iza kojih je postavljena mreža za odbojku. Automobil možete parkirati tik uz plažu. \r\nSadržaj: S obzirom da je ovde gotovo uvek prijatna atmosfera, ljudi lako dođu u kontakt jedni sa drugima, te se dobro društvo za odbojku brzo nađe. Za one koji su više za podvodne aktivnosti, Šećerna plažu krase brojne morske zvezde, a na vama je samo da uživate u prizoru!\r\n\r\nGiola\r\nIako Giola nije plaža, već prirodni bazen, zbog svoje lepote i retkosti ona je nazaobilazna destinacija kada je u pitanju poseta Tasosu! Ono što vas očekuje ovde jeste smaragdno zelena boja vode kao kontrast plavetnilu mora čiji nemirni talasi udaraju o osam metara visoke litice, dok vi uživate u ovom jedinstvenom fenomenu.\r\nPrilaz: Giola se nalazi na krajnjem jugoistoku ostrva, na delu obale koja je okrenuta ka pučini Egejskog mora. Do nje se dolazi vožnjom od mesta Poto prema mestu Astris. Na glavnom putu nema oznake za bazen, vi pratite znak sa sirenama nakon kog skrenite levo i pratite put do same obale i plaže, gde se možete parkirati. Nakon ovog „lakšeg“ dela puta, čeka vas 2 km dugo pešačenje sa nadom da ćete konačno ugledati veličanstvenu Giolu. \r\nSadržaj: Ulazak u Giolu je moguć samo uskakanjem, tako da oni najhrabriji mogu ovde napraviti fotografiju na kojoj bi im i oni najprobirljiviji pozavideli!', '2018-06-07 00:00:00', 2, 'img/blog/blog4.jpg'),
(3, 'Evija', 'Povoljni klimatski uslovi, prelepe plaže i termalni izvori učinile su Eviju kada je turizam u pitanju nadaleko poznatom. Tome je doprinela i blizina Atine, grada muzeja, koja se nalazi na dva sata vožnje i koju možete u vidu izleta posetiti i istražiti. LetJovanje Vas vodi na ovo drugo po veličini ostrvo Grčke po specijalnoj ceni od 150 eur (prevoz i smeštaj za 10 dana), a ovo su naši predlozi za vaš nezaboravan odmor:\r\n\r\n1.      Odvojite vreme i posetite Alikes, koja se nalazi nedalko od glavnog grada, gde možete uživati u peskovitoj plaži i morskim specijalitetima u nekoj od taverni.\r\n\r\n2.      Na samo 4 kilometara od Pefkija, u gustoj borovoj šumi nalazi se vodopad koji će vas rashladiti u vrelim letnjim danima i odakle se pruža prelepa panorama na Pefki. Pored žubora vode ovde jedino možete čuti još cvrkut ptica i nežno pucketanje šišarki na suncu.\r\n\r\n3.      Svatite do sela Gerakija možete kupiti domaći origano koji će vašoj hrani dati poseban ukus!\r\n\r\n4.      Posebna atrakcija ostrva je Meghalos Platanos - veliki 600 godina star platan - gde se tokom leta unutar ovog znamenog stabla nalazi mali samoposlužujući kafić gde možete probati ukusnu grčku kafu.\r\n\r\n5.      Ukoliko ste nostalgični u potrazi za dobrom čašicom možete otići do sela Artemision i Asiminio i uživati u dobroj rakiji.\r\n\r\n6.      Posetite glavni grad Evije, Halkidu, osetite duh ovog mesta i obiđite interesantan arheološki muzej kao i tvrđavu iz XV veka.   \r\n\r\n7.      Za one željne provoda, preporučujemo plažu Kanatadika na kojima se nalazi mnoštvo beach barova sa dobrom muzikom i omamljujućim koktelima.\r\n\r\n8.      Za avanturiste preporučujemo posetu Agia Anna gde možete uživati u surfovanju i paraglajdingu!\r\n\r\n9.      Odvojite vreme i posetite Edipsos, gde možete opustiti svoja čula i okupati se u termalnim izvorima koji se u vidu vodopada ulivaju u more.\r\n\r\n10.  Od Evije do prestonice Grčke treba oko dva sata vožnje. Posetu Atini upotpunite obilaskom muzeja na Akropolju, uzivanju u pogledu koji se pruža sa Partenona na citavu Atinu kao i u ispijanju kafe u nekom o čuvenih kafića na Plaki ili Tisiju.\r\n\r\nSvakako značajna stavka jesu i cene hrane i izleta, i reći ćemo vam jedno - nigde u Grčkoj nećete jefinije letovati! Evija će vam zasigurno pružiti pravi mediteranskih duh u onom izvornom obliku koji se danas retko nalazi.', '2018-06-08 00:00:00', 2, 'img/blog/blog3.jpg'),
(4, 'Tajland', 'Da li ste pozeleli da svoj odmor provedete u zemlji osmeha, mirnog srca i vedrog duha? Negde gde je domaćinima životna filozofija mai pen rai \'\'bez brige\'\'? Negde gde će vas dočekati sa osmehom na licu i ponuditi slatki med od ananasa za dobrodošlicu?  Zemlji koju odlikuje pozitivna energija,  gde je narod u potpunosti zadržao svoju drevnu kulturu i jako je ponosan svojom zemljom? Onda je prava destinacija za vaše putovanje upravo Tajland koji u doslovnom prevodu znači \'\'Zemlja slobodnih\'\'. Tajland nudi širok dijapazon prirodnih lepota koje su savršene za odmor, od zelenih dzungli i dolina, preko jako zanimljivih gradova pa do neverovatnih ostrva koja ostavljaju brojne turiste bez daha. Pored prirodnih lepota, ova zemlja nudi turistima mir i gostoprimstvo, možda upravo iz razloga što preko 90% stanovništva čine budisti.\r\n\r\nGlavni grad Tajlanda je Bangkok, koji se nalazi u centralnom delu zemlje i koji je jedan od najgušće naseljenih gradova u Aziji. Ovaj grad je jako zanimljiv jer pored modernih nebodera i užurbanog saobraćaja, istovremeno odise tradicionalnim toplim gostoprimstvom, i starim načinom života koji se i dalje održava pored reke Chao Praya (Reka kraljeva ). Šetajući gradom naićićete na jako veliki broj raznovrsnih restorana, tako da gotovo svuda možete naći svežu i ukusnu tradicionalnu hranu po pristupačnim cenama, kao i puno specijaliteta, na primer škampi u kokosu ili piletina u listovima banane, čiji ukus nećete tako lako zaboraviti, tako da se može reći da je Bangkok raj za gurmane.\r\n\r\nSeverni deo Tajlanda je pretežno planinski, karakterišu ga prelepi zeleni pejzaži koji su savršeni za avanturiste i beg u prirodu. Na severu zemlje nalazi se i grad Chiang Mai koji je poznat po aktuelnim noćnim pijacama, gde severno od njega u zelenim dolinama videćete  uzgajališta orhideja kao i kampove za treniranje slonova, što opet ukazuje na to koliko je ova zemlja jedinstvena. Centralni deo Tajlanda karakterističan je i po ogromnim poljima pirinča, kao i po brojnim nacionalnim parkovima koji svi zajedno obuhvataju 34500km kvadratnih površine Tajlanda. Ukoliko se nadjete u ovoj predivnoj zemlji, posetu nekom od brojnih nacionalnih parkova svakako ne smete propustiti. Posebno izdvajamo nacionalni park  Khao Yai, gde možete u toku šetnje okruženi orhidejama i zelenim krošnjama susresti preko 900 različitih životinjskih vrsta, koje su tu nastanjene, od kojih je slon nacionalni simbol ove zemlje.\r\n\r\nNa jugu, u Tajlandskom zalivu i Anadomskom moru nalaze se brojna egzotična tropska ostrva, sa prelepim letovalištima kao što su  Phuket, Ko Phi Phi,  Koh Samui i druga. Svako od brojnih ostrva Tajlanda su pravi tropski raj za posetioce, i poseduju prelepe duge plaže sa izvarednim peskom, i svako od njih ima poseban šarm koji će vas očarati. Ono što im je zajedničko jeste da ostrva predstavljaju oaze mira sa tirkizno plavim morem, kao i fascinantno bujno zelenilo i stene na obodu plaža. I naravno neizostavna ponuda čuvene tajlandske masaže na svakom koraku. Svakako Tajland i sva njegova lepota, kao i osećaj koji boravak u ovoj zemlji pruža, ne mogu se opisati niti dočarati rečima, već ih treba doživeti. ', '2018-06-09 00:00:00', 2, 'img/blog/blog2.jpg'),
(5, 'Krit', 'Ako ste u potrazi za idealnim mestom za odmor, gde će na jednom mestu biti spojeni prelepa priroda, zelenilo, plaže sa belim peskom i prozirnom tirkiznom vodom, prijatna klima ali i slikoviti gradovi, skrivena sela i sadržaji za provod, Krit je kao stvoren za vas i vaše letovanje 2018.\r\n\r\nOstrvo Krit zaista nudi za svakog po nešto, odlična je destinacija i za porodice sa decom, i za parove, ali i za društvo. Na Kritu osim kupanja i sunčanja, možete da se vratite u prošlost kroz obilazak arheoloških nalazišta, znamenitosti i gradova, da uživate u tavernama, uz muziku na liri, ili večeri provodite u atraktivnim barovima. Ostrvo ima sve potrebno za kvalitetan odmor uz avanturizam i rekreaciju tokom boravka na istom. Što se tiče plaža ima ih preko 100, a među njima su neke od najlepših u Grčkoj pa i Mediteranu, sa belim, zlatnim, čak i roze peskom, sitnim šljunkom, skrivene uvale i dugačke, uređene plaže. Tu su i one sa prirodnom hladovinom, kedrovog, palminog ili drugog drveća. Priroda na ostrvu zaista je očaravajuća, od čempresa na jugu, hrastova i čempresa na zapadu, do nepreglednih maslinjaka, ali i borovine u oblasti Thripti, na istoku, a tu su i plaže prekrivene palmama, kao Vai ili Preveli. Kako se nalazi u Mediteranu okružen sa tri kontinenta, Krit ima specifičan mediteranski duh, sa afričkim i arapskim primesama. Krićani su vrlo ljubazni i srdačni i gde god da se uputite naići ćete na toplo gostoprimstvo i nasmejana lica. Ono što svakako savetujemo je da obiđete što je više moguće, posebno očaravajućih plaža tokom boravka na Kritu, bilo kroz izlete, ili sami automobilom ili autobusima. Ovde pogledajte koje su najlepše plaže na Kritu i koje izlete ne biste trebali da propustite.\r\n\r\nZa opušten porodični odmor preporuka su regije Retimno i Heraklion, mesta kao što su Kokini Chani, Gouves, Analipsi, Stalis. Glavni grad Iraklion, ali i gradovi Retimno i Hanja svojim uskim uličicama i arhitekturom sa venecijanskim uticajem podsećaju na italijanske primorske gradiće i idealni su za starije putnike ili porodice sa decom. U ovim gradovima nema klubova niti barova na plaži namenjenih izlascima do ranih jutarnjih sati, već je sve podređeno mirnom odmoru, uživanju u večernjim šetnjama i kritskim specijalitetima u odličnim tavernama.  Može se reći da su donekle ovo mondenska letovališta, na severnoj strani ostrva, ali svakako pristupačna, koja pružaju potpuni ugođaj. U ovim dvema oblastima, naći ćete veliki broj raznovrsnih hotela, od velikih hotelskih kompleksa sa više bazena i atrakcija za decu, do onih manjih gradskih, te među njima i onaj savršen za odmor kakav želite.\r\n\r\nZa mlade idealna mesta su Hersonisos i Malia. Ova dva gradića zadovoljiće potrebe svih koji su željni provoda, jer je ovde zagarantovan na mnogim i dnevnim i noćnim žurkama. Nalaze na svega 20ak kilometara od glavnog grada, te su mogućnosti za izlete i obilaske plaža brojne, ukoliko poželite da predahnete od aktivnog noćnog života. Malia je poznata kao letovalište koje preferiraju mladi turisti iz Britanije, gde se muzika čuje na svakom koraku, dok je Hersonisos popularan među Holanđanima. Naravno, preporuka i za one koji se odluče za neko od ovih letovališta je da ne propuste i druge gradove i prelepe paže širom ostrva Krit. ', '2018-06-10 00:00:00', 2, 'img/blog/blog1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `id` int(2) NOT NULL,
  `naziv` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`id`, `naziv`) VALUES
(1, 'admin'),
(2, 'korisnik');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anketa_glas`
--
ALTER TABLE `anketa_glas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `odgovor_id` (`odgovor_id`);

--
-- Indexes for table `anketa_odgovor`
--
ALTER TABLE `anketa_odgovor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pitanje_id` (`pitanje_id`);

--
-- Indexes for table `anketa_pitanje`
--
ALTER TABLE `anketa_pitanje`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galerija`
--
ALTER TABLE `galerija`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `korisnik_id` (`korisnik_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `uloga_id` (`uloga_id`);

--
-- Indexes for table `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pozicija` (`pozicija`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `korisnik_id` (`korisnik_id`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anketa_glas`
--
ALTER TABLE `anketa_glas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `anketa_odgovor`
--
ALTER TABLE `anketa_odgovor`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `anketa_pitanje`
--
ALTER TABLE `anketa_pitanje`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `galerija`
--
ALTER TABLE `galerija`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `link`
--
ALTER TABLE `link`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anketa_glas`
--
ALTER TABLE `anketa_glas`
  ADD CONSTRAINT `anketa_glas_ibfk_1` FOREIGN KEY (`odgovor_id`) REFERENCES `anketa_odgovor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `anketa_odgovor`
--
ALTER TABLE `anketa_odgovor`
  ADD CONSTRAINT `anketa_odgovor_ibfk_1` FOREIGN KEY (`pitanje_id`) REFERENCES `anketa_pitanje` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`id`),
  ADD CONSTRAINT `komentar_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`);

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `korisnik_ibfk_1` FOREIGN KEY (`uloga_id`) REFERENCES `uloga` (`id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
