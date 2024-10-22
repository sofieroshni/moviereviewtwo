-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 09, 2024 at 03:15 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moviereview`
--

-- --------------------------------------------------------

--
-- Table structure for table `actors`
--

DROP TABLE IF EXISTS `actors`;
CREATE TABLE IF NOT EXISTS `actors` (
  `actorId` int NOT NULL AUTO_INCREMENT,
  `actor_img` varchar(255) COLLATE utf8mb3_danish_ci DEFAULT NULL,
  `actmovActorId` int DEFAULT NULL,
  `actorName` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_danish_ci DEFAULT NULL,
  `birth_year` int DEFAULT NULL,
  `actor_nationality` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_danish_ci DEFAULT NULL,
  `actor_describ` varchar(255) COLLATE utf8mb3_danish_ci DEFAULT NULL,
  PRIMARY KEY (`actorId`),
  UNIQUE KEY `actmovActorId` (`actmovActorId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_danish_ci;

--
-- Dumping data for table `actors`
--

INSERT INTO `actors` (`actorId`, `actor_img`, `actmovActorId`, `actorName`, `birth_year`, `actor_nationality`, `actor_describ`) VALUES
(1, NULL, NULL, 'Morten Hemmingsen', 1980, 'Danish', 'Morten Hemmingsen er en dansk skuespiller kendt for sine roller i tv-serier som \"Arvingerne\" og forskellige teaterproduktioner. Han er anerkendt for sine alsidige skuespiltalenter på tværs af genrer.'),
(2, NULL, NULL, 'Marie Bach Hansen', 1985, 'Danish', 'Marie Bach Hansen er en dansk skuespillerinde bedst kendt for sin rolle som Signe i den populære tv-serie \"Arvingerne\". Hun har også arbejdet på teaterscenen og i andre danske filmproduktioner.'),
(3, NULL, NULL, 'Søren Malling', 1964, 'Danish', 'Søren Malling er en markant dansk skuespiller, kendt for sine præstationer i tv-serier som \"Borgen\" og \"Forbrydelsen\". Hans intense skuespil har gjort ham til et velkendt navn i dansk film og tv.'),
(4, NULL, NULL, 'Nikolaj Lie Kaas', 1973, 'Danish', 'Nikolaj Lie Kaas er en højt respekteret dansk skuespiller, kendt for sine roller i både danske og internationale film. Hans mest kendte værker inkluderer \"Afdeling Q\"-filmene og \"Engle & Dæmoner\".'),
(5, NULL, NULL, 'Bodil Jørgensen', 1961, 'Danish', 'Bodil Jørgensen er en velkendt dansk skuespillerinde med en lang karriere inden for film, tv og teater. Hun er kendt for sin rolle i \"Idioterne\" og sine stærke dramatiske præstationer.'),
(6, NULL, NULL, 'Lars Mikkelsen', 1964, 'Danish', 'Lars Mikkelsen, bror til skuespiller Mads Mikkelsen, er en dansk skuespiller kendt for sine roller i \"House of Cards\", \"Sherlock\" og danske serier som \"Borgen\". Hans tilstedeværelse i både internationale og danske produktioner er bredt anerkendt.'),
(7, NULL, NULL, 'Trine Dyrholm', 1972, 'Danish', 'Trine Dyrholm er en af Danmarks mest alsidige skuespillerinder, med en karriere, der spænder over film, tv og musik. Hun er kendt for sine roller i film som \"Festen\" og \"Den skaldede frisør\".'),
(8, NULL, NULL, 'Pilou Asbæk', 1982, 'Danish', 'Pilou Asbæk er en dansk skuespiller, internationalt kendt for sin rolle som Euron Greyjoy i \"Game of Thrones\". I Danmark er han især anerkendt for film som \"Kapringen\" og serien \"Borgen\".'),
(9, NULL, NULL, 'Ulrich Thomsen', 1963, 'Danish', 'Ulrich Thomsen er en dansk skuespiller og instruktør, kendt for sine præstationer i \"Festen\" og internationale produktioner som \"The World Is Not Enough\" og \"The International\".'),
(11, NULL, NULL, 'Anders W Berthelsen', 1969, 'DK', 'Anders W Berthelsen er en dansk skuespiller med en alsidig karriere inden for tv, film og teater. Han er kendt for sine roller i \"Italiensk for begyndere\" og den populære tv-serie \"Krøniken\".'),
(12, NULL, NULL, 'Safina Waldau\r\n', 2003, 'Dansk', 'Safina Waldau er en dansk skuespiller og datter af skuespilleren Nikolaj Coster-Waldau, som er kendt for sin rolle som Jaime Lannister i serien Game of Thrones. Safina har medvirket i danske film og tv-serier, herunder filmen Kollision (2019), hvor hun sp');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `review_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `review_id` (`review_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_danish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `movieId` int NOT NULL AUTO_INCREMENT,
  `movieactorMovieId` int DEFAULT NULL,
  `movie_img` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_danish_ci DEFAULT NULL,
  `movieTitle` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_danish_ci DEFAULT NULL,
  `release_year` year DEFAULT NULL,
  `genre` varchar(100) COLLATE utf8mb3_danish_ci DEFAULT NULL,
  `director` varchar(255) COLLATE utf8mb3_danish_ci DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `movie_resume` text CHARACTER SET utf8mb3 COLLATE utf8mb3_danish_ci,
  PRIMARY KEY (`movieId`),
  KEY `movieactorIMovied` (`movieactorMovieId`),
  KEY `movieactorMovieId` (`movieactorMovieId`)
) ;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movieId`, `movieactorMovieId`, `movie_img`, `movieTitle`, `release_year`, `genre`, `director`, `rating`, `created_at`, `movie_resume`) VALUES
(2, NULL, '', 'Kontra', '2023', 'Drama', 'Jonas Risvig', 4.5, '2024-09-25 12:32:14', ''),
(3, NULL, '', 'Mørkeland', '2022', 'Crime', 'Mikkel Serup', 4.3, '2024-09-25 12:44:11', ''),
(4, NULL, '', 'Speak No Evil', '2022', 'Thriller', 'Christian Tafdrup', 4.1, '2024-09-25 12:44:11', ''),
(87, NULL, '', 'Kapgang', '2014', 'Drama', 'Niels Arden Oplev', 3.8, '2024-09-25 12:49:40', ''),
(88, NULL, '', 'Guldhornene', '2007', 'Drama', 'Mette Knudsen', 3.3, '2024-09-25 12:49:40', ''),
(100, NULL, '', 'Kærestesorger', '2009', 'Thriller', 'Nils Malmros', 3.8, '2024-09-25 12:49:41', ''),
(101, NULL, '', 'Køterevolutionen', '2021', 'Komedie', 'Henrik Ruben Genz', 3.0, '2024-10-02 17:43:18', ''),
(103, NULL, '', 'København', '2020', 'Romantik', 'Thomas Vinterberg', 4.0, '2024-10-02 17:51:50', ''),
(104, NULL, '', 'Drømmehjerte', '2018', 'Fantasi', 'Jannik Johansen', 2.0, '2024-10-02 17:54:23', ''),
(105, NULL, '', 'Kollektivet', '2016', 'Drama', 'Thomas Vinterberg', NULL, '2024-10-03 12:08:04', ''),
(136, NULL, NULL, 'sc', NULL, NULL, NULL, NULL, '2024-10-07 19:00:33', NULL),
(137, NULL, NULL, 'titel', NULL, NULL, NULL, NULL, '2024-10-07 19:01:17', NULL),
(138, NULL, NULL, '3', NULL, NULL, NULL, NULL, '2024-10-07 19:01:39', NULL),
(139, NULL, NULL, 'ss', NULL, NULL, NULL, NULL, '2024-10-07 20:08:50', NULL),
(140, NULL, NULL, 'Inception', NULL, NULL, NULL, NULL, '2024-10-07 20:31:40', NULL),
(141, NULL, NULL, 'sofie', NULL, NULL, NULL, NULL, '2024-10-07 20:32:07', NULL),
(142, NULL, NULL, 'sofie1', NULL, NULL, NULL, NULL, '2024-10-07 20:32:32', NULL),
(143, NULL, NULL, 'sofie', NULL, NULL, NULL, NULL, '2024-10-07 20:32:57', NULL),
(144, NULL, NULL, 'sofie', NULL, NULL, NULL, NULL, '2024-10-07 20:33:16', NULL),
(145, NULL, NULL, 'Inception', NULL, NULL, NULL, NULL, '2024-10-07 20:33:47', NULL),
(146, NULL, NULL, 'sofie', NULL, NULL, NULL, NULL, '2024-10-07 20:48:51', NULL),
(147, NULL, NULL, 'lort', NULL, NULL, NULL, NULL, '2024-10-07 20:49:09', NULL),
(148, NULL, NULL, 'testnr10000000000000', NULL, NULL, NULL, NULL, '2024-10-07 20:49:38', NULL),
(149, NULL, NULL, 's', NULL, NULL, NULL, NULL, '2024-10-07 20:50:35', NULL),
(150, NULL, NULL, 'sofie', NULL, NULL, NULL, NULL, '2024-10-07 20:57:59', NULL),
(151, NULL, NULL, 'scsc', NULL, NULL, NULL, NULL, '2024-10-07 21:04:27', NULL),
(152, NULL, NULL, 'sofie', NULL, NULL, NULL, NULL, '2024-10-07 21:14:39', NULL),
(153, NULL, NULL, 'SFS', NULL, NULL, NULL, NULL, '2024-10-07 23:47:26', NULL),
(154, NULL, NULL, 'skk', NULL, NULL, NULL, NULL, '2024-10-08 00:37:04', NULL),
(155, NULL, NULL, 'sofeiv', NULL, NULL, NULL, NULL, '2024-10-09 00:30:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `movie_actor`
--

DROP TABLE IF EXISTS `movie_actor`;
CREATE TABLE IF NOT EXISTS `movie_actor` (
  `reviewerConId` int DEFAULT NULL,
  `movieactorId` int NOT NULL AUTO_INCREMENT,
  `reviewConId` int DEFAULT NULL,
  `movieConId` int DEFAULT NULL,
  `actorConId` int DEFAULT NULL,
  PRIMARY KEY (`movieactorId`),
  UNIQUE KEY `reviewConId_2` (`reviewConId`,`movieConId`),
  KEY `movieConId` (`movieConId`),
  KEY `reviewConId` (`reviewConId`),
  KEY `reviewConId_3` (`reviewConId`,`movieConId`,`actorConId`),
  KEY `actorConId` (`actorConId`),
  KEY `reviewerConId` (`reviewerConId`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_danish_ci;

--
-- Dumping data for table `movie_actor`
--

INSERT INTO `movie_actor` (`reviewerConId`, `movieactorId`, `reviewConId`, `movieConId`, `actorConId`) VALUES
(1, 1, 2, 3, 11),
(1, 3, 1, 4, 11),
(1, 19, 31, 101, 11),
(2, 20, NULL, 105, 7),
(3, 21, 32, 105, 6),
(NULL, 22, NULL, 105, 3),
(1, 23, NULL, 105, 2),
(5, 24, NULL, 105, 8),
(2, 25, NULL, 3, 3),
(NULL, 26, NULL, 3, 2),
(3, 27, NULL, 3, 8),
(2, 28, 34, 103, 7),
(4, 29, 35, 103, 3),
(5, 30, 36, 103, 8),
(NULL, 31, NULL, 87, 7),
(NULL, 32, NULL, 87, 6),
(NULL, 33, NULL, 87, 3),
(NULL, 34, NULL, 104, 7),
(NULL, 35, NULL, 104, 6),
(NULL, 36, NULL, 104, 3),
(2, 37, 3, 2, 12),
(2, 38, 49, 103, NULL),
(NULL, 41, NULL, NULL, NULL),
(NULL, 42, NULL, NULL, NULL),
(NULL, 43, NULL, NULL, NULL),
(NULL, 44, NULL, NULL, NULL),
(NULL, 45, NULL, NULL, NULL),
(NULL, 46, NULL, NULL, NULL),
(NULL, 47, NULL, NULL, NULL),
(NULL, 48, NULL, NULL, NULL),
(NULL, 49, NULL, NULL, NULL),
(NULL, 50, NULL, NULL, NULL),
(NULL, 51, NULL, NULL, NULL),
(NULL, 52, NULL, NULL, NULL),
(NULL, 53, NULL, 136, NULL),
(NULL, 54, NULL, 137, NULL),
(NULL, 55, NULL, 138, NULL),
(NULL, 56, NULL, 139, NULL),
(NULL, 57, 81, 140, NULL),
(NULL, 58, NULL, 141, NULL),
(NULL, 59, 83, 142, NULL),
(NULL, 60, NULL, 143, NULL),
(NULL, 61, NULL, 144, NULL),
(NULL, 62, NULL, 145, NULL),
(NULL, 63, NULL, 146, NULL),
(NULL, 64, NULL, 147, NULL),
(NULL, 65, NULL, 148, NULL),
(NULL, 66, NULL, 149, NULL),
(NULL, 67, NULL, 150, NULL),
(NULL, 68, NULL, 151, NULL),
(NULL, 69, NULL, 152, NULL),
(NULL, 70, 94, 153, NULL),
(NULL, 71, NULL, 154, NULL),
(32, 72, 96, 155, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviewers`
--

DROP TABLE IF EXISTS `reviewers`;
CREATE TABLE IF NOT EXISTS `reviewers` (
  `reviewerId` int NOT NULL AUTO_INCREMENT,
  `name_of_the_reviewer` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_danish_ci DEFAULT NULL,
  `reviewer_age` int DEFAULT NULL,
  `reviewer_email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_danish_ci DEFAULT NULL,
  `reviewer_bio` text CHARACTER SET utf8mb3 COLLATE utf8mb3_danish_ci,
  `reviewer_img` text CHARACTER SET utf8mb3 COLLATE utf8mb3_danish_ci,
  PRIMARY KEY (`reviewerId`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_danish_ci;

--
-- Dumping data for table `reviewers`
--

INSERT INTO `reviewers` (`reviewerId`, `name_of_the_reviewer`, `reviewer_age`, `reviewer_email`, `reviewer_bio`, `reviewer_img`) VALUES
(1, 'Bo Tao Michaëlis', 76, 'Michaëlis@testgmail.com', 'Bo Tao Michaëlis er en dansk kritiker, der er litteratur- og kulturanmelder ved dagbladet Politiken fra 1990. Han er søn af revyforfatteren og skuespilleren Tao Michaëlis.', ''),
(2, 'Kjartan Hansen', 42, 'Kjartan@test.gmail.com', '\nKjartan Hansen er en 42-årig dansk kulturkritiker og filmanmelder med en skarp sans for at analysere både mainstream og arthouse film. Han har været aktiv som anmelder i over 15 år og er kendt for sin dybdegående tilgang, hvor han kombinerer akademisk indsigt med en passion for filmhistorie. Med en baggrund i medievidenskab fra Københavns Universitet har Kjartan arbejdet som fast anmelder for flere danske kulturmagasiner og aviser. Hans stil er præget af en analytisk, men tilgængelig tone, hvilket gør hans anmeldelser populære både blandt filmelskere og almindelige læsere.', 'img/dreams.jpg'),
(3, ' Maja Sørensen', 32, 'Maja.sorensen@gmail.com', ' Maja SørensenMaja Sørensen er en 32-årig filmkritiker og kulturjournalist fra København. Med en baggrund i filmvidenskab fra Københavns Universitet har hun en dyb forståelse for filmens sprog og struktur. Maja har arbejdet for flere anerkendte medier, herunder Politiken og Berlingske, hvor hun leverer indsigtsfulde anmeldelser og analyser af både danske og internationale film.\r\n\r\nHun er kendt for sin evne til at fange filmens følelsesmæssige dybde og sit fokus på karakterudvikling. Maja er en stor tilhænger af både klassisk og moderne film og har en særlig forkærlighed for nordisk filmkunst. I sine anmeldelser stræber hun efter at inspirere seerne til at tænke kritisk over, hvad de ser, samtidig med at hun deler sin egen passion for fortællinger og visuel æstetik.\r\n\r\nMaja har vundet flere priser for sit arbejde og er ofte inviteret som gæst i filmrelaterede podcasts og paneldebatter, hvor hun deler sin viden og perspektiv på den filmiske verden. Hun lever for de små, men betydningsfulde øjeblikke i film, der efterlader et varigt indtryk på publikum', ''),
(4, 'Lise Nielsen', 50, 'Lise.N@gmailcom', 'Lise Nielsen, 45 år, er en passioneret filmkritiker med over 20 års erfaring inden for film- og mediebranchen. Med en uddannelse i filmvidenskab fra Københavns Universitet og en baggrund som kulturjournalist har Lise altid haft en skarp sans for at vurdere filmens æstetik og fortælling. Hun er kendt for sine detaljerede og ærlige anmeldelser, hvor hun vægter både skuespil, manuskript og filmteknik højt.\r\n\r\nLise har en forkærlighed for både arthouse-film og store Hollywood-produktioner og elsker at dykke ned i alt fra tankevækkende dramaer til episke actionfilm. Hendes dybdegående analyser og evne til at se både de store linjer og de små detaljer har gjort hende til en respekteret stemme blandt både læsere og kollegaer.', ''),
(5, 'Jens Holmberg', 38, 'jens.holmberg@gmail.com', '\r\nJens Holmberg, 38 år, er en karismatisk og alsidig filmkritiker, der har gjort sig bemærket for sin evne til at forene humor med dyb indsigt i sine anmeldelser. Med en baggrund i litteratur og visuel kommunikation fra Aarhus Universitet, begyndte Jens sin karriere som freelance skribent for forskellige online medieplatforme, hvor han hurtigt udviklede en dedikeret følgerskare.\r\n\r\nJens’ styrke ligger i hans evne til at bringe en menneskelig vinkel ind i selv de mest komplekse filmfortællinger. Han er især kendt for sin fascination af science fiction og indie-film, men hans smag spænder bredt, fra animationsfilm til mørke psykologiske thrillers. Hans anmeldelser er både analytiske og underholdende, ofte fyldt med skarpe observationer og en god portion selvironi', ''),
(32, 'sofie', 22, 'sofie.@gmail.com', 'scsc', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `reviewId` int NOT NULL AUTO_INCREMENT,
  `review_reviewcon` int DEFAULT NULL,
  `underubrik` varchar(500) COLLATE utf8mb3_danish_ci NOT NULL,
  `review_title` varchar(100) COLLATE utf8mb3_danish_ci DEFAULT NULL,
  `review_text` text COLLATE utf8mb3_danish_ci,
  `review_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `review_rating` int DEFAULT NULL,
  `moviereview_title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_danish_ci DEFAULT NULL,
  PRIMARY KEY (`reviewId`),
  KEY `review_reviewcon` (`review_reviewcon`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_danish_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `review_reviewcon`, `underubrik`, `review_title`, `review_text`, `review_date`, `review_rating`, `moviereview_title`) VALUES
(1, NULL, '’Speak No Evil’ er ligesom forgængeren, ’En frygtelig kvinde’, en kritisk udstilling af parforholdsdynamikker fra helvede. Denne gang er der dog tale om en gyser, og Christian Tafdrup er virkelig mand for at folde helvedesvisionerne ud', 'Speak No Evil anmeldelse\r\n', 'Hvad er det værste, der kan ske ved at tage imod en invitation til at besøge en familie, man har snakket godt med på en ferie? Den mest oplagte risiko er, at man løber tør for ting at tale om. At man ikke trives på de andres hjemmebane. Det fortryllede skær, der stod om samværet, da man var indlogeret på samme idylliske landssted i Toscana, hvor solen spejlede sig i poolens blå flade, og hvor man stødte ind i hinanden i de snævre gader i en nærliggende landsby, kan ske at være gået fløjten.\n\nDet er denne milde frygt for privilegerede mennesker, som Christian Tafdrup i sin nye film, Speak No Evil, tager til den yderste ekstrem. Ligesom hans to tidligere spillefilm Forældre og En frygtelig kvinde handler den om, hvor galt det kan gå, når vor tids middelklassedansker får opfyldt sit højeste ønske. I Forældre lykkedes det på magisk vis et midaldrende ægtepar, hvis rede føltes tom, efter at sønnen var flyttet hjemmefra, at gennemleve deres ungdom sammen en gang til. Det blev noget rod, selvfølgelig gjorde det det, men tankeeksperimentet var godt fundet på og ambitiøst udfoldet. Viljen til at skabe et filmisk univers, hvor lidt ud over det almindelige kan finde sted, var mærkbar.\n\nI En frygtelig kvinde (2017) bliver den mandlige hovedperson kærester med en sexet og sjov kvinde, der forvandler sig til en strid og evigt korreksende nedbryder af hans selvværd. Den film var der virkelig et marked for, omkring 185.000 så den i biografen, og alle vegne blev der drøftet, hvor godt dens karikerede portræt af det heteroseksuelle parforhold rammer. Selv syntes jeg, at skrækscenariet var irriterende uopfindsomt skruet sammen. Den psykiske manipulation gik hånd i hånd med en lang række livsstilsmarkører (såsom vegetarlasagne, mandeknold og forældrebesøg), der i filmen fremstod som små symboler på hovedpersonens åndelige kastration.\n\nNoget føles forkert for det danske par, der sammen med deres datter besøger de jævnaldrende hollændere Patrick (Fedja van Huêt) og Karin (Karina Smulders), som de har mødt på en skøn ferie i Toscana. Da Patrick og Karin finder ud af, at gæsterne er utilfredse med værtskabet, bliver de frygteligt skuffede. De skuffede miner er imidlertid kun begyndelsen på en rutsjebanetur af exceptionelt ubehag.\nNoget føles forkert for det danske par, der sammen med deres datter besøger de jævnaldrende hollændere Patrick (Fedja van Huêt) og Karin (Karina Smulders), som de har mødt på en skøn ferie i Toscana. Da Patrick og Karin finder ud af, at gæsterne er utilfredse med værtskabet, bliver de frygteligt skuffede. De skuffede miner er imidlertid kun begyndelsen på en rutsjebanetur af exceptionelt ubehag.\nSpeak No Evil er allerede blevet mere end vel modtaget af den del af filmpressen, der så den på den amerikanske filmfestival Sundance. Det er forståeligt. Den er også fuld af livsstilsmarkører, social dressur og parforholdsdynamik, hvor kvinden er bestemt, og manden er konfliktsky. Igen er hovedpersonerne frygteligt irriterende, og deres parforhold har også et element af konstant magtkamp, men filmen handler ikke bare om, hvordan to, der til at begynde med havde det skønt sammen, får det værste frem i hinanden.\n\nBjørn (Morten Burian) og Louise (Sidsel Siem Koch) har egentlig realiseret deres forestilling om det gode liv. De er begge nydelige at se på og helt almindeligt fornuftige at høre på, de har en datter, der opfører sig ordentligt og spiller fløjte i sin fritid, og venner, der kommer på besøg i deres smagfuldt indrettede lejlighed og slynger rødvin rundt i de helt rigtige glas.\n\nAlligevel længes de – og måske især Bjørn – efter noget mere. Ikke nødvendigvis noget andet, og nødigt et helt andet liv. Men der kunne godt være lidt mere følelsesmæssig intensitet, måske endda hul igennem til nogle helt igennem autentiske følelser, der kommer ud af det blå, rusker i en og føles stærkere end den stille tilfredshed ved, at livet nu igen går som planlagt. Det er ikke noget, de går og taler om, de ligner bare nogen, der har fået deres vilje og nu står med den udfordring at skjule deres skuffelse.\n\nSkandinaviske mandetårer\nPå en ferie i Toscana møder Bjørn og Louise så det hollandske par Karin (Karina Smulders) og Patrick (Fedja van Huêt), hvis søn Abel (Marius Damslev) kun er lidt yngre end deres Agnes (Liva Forsberg). At dette møde skal vise sig at være fatalt, lægger Speak No Evil ikke skjul på. Fra første øjeblik brager Sune Kølsters pompøse og ildevarslende ouverture hen over droneskud af det toscanske landskab. Der bliver ikke holdt igen med filmmusikken på noget tidspunkt, og dens ekstremt teatralske udtryk gør sit til at bekende genremæssig kulør. En stor del af filmen kunne ligne sædeskildring med fokus på fejhed, men man fornemmer på det store orkesters bulder og brag, at der er mere på færde end det.   \n\nPatrick og Karin imponerer Bjørn og Louise med deres selvfølgelige måde at indtage ethvert tænkeligt rum på, deres imødekommenhed og synlige appetit på det hele. Patrick er ikke bleg for at tage ordet, slå ud med armene og udbringe en skål for hele langbordet, når de forskellige turister er samlet til fællesmiddag på hotellet om aftenen. Patrick fortæller, han er læge og har arbejdet for Læger uden Grænser. Han strør om sig med anerkendelse, som Bjørn og Louise gladeligt tager imod. Karin er også imødekommende, bare på en mere kølig og elegant måde. Både Karin og Patrick tager det med ophøjet ro, at deres søn Abel intet siger.\n\nEn aften, hvor der er operakoncert på hotellet, fanger Patrick Bjørns blik lige i det øjeblik, hvor han sidder og er lidt forlegen over sine skandinaviske mandetårer, der er begyndt at pible frem. Louise ser ikke, hvilket længselsfuldt bæst hendes mand er, for hun har travlt med at fotografere koncerten med sin telefon. Men Patrick ser det. Og han forstår det tilsyneladende også, nikker højtideligt til Bjørn, hæver sit glas og gør sig i det øjeblik til et rigtigt godt bud på en ny ven.\n\nDa der en efterårsdag i Danmark ligger et postkort med en invitation til at besøge Patrick, Karin og Abel i Holland en weekend, trækker det rigtig meget i Bjørn for at komme afsted. Ned til Holland og spejle sig i den familie, der har indrettet sig på nogenlunde samme måde som dem selv, men lader til at leve mere lækkert og intenst.\n\nNoget føles forkert\nLouise er lidt mere tøvende over for invitationen, de har jo også allerede brugt årets flykvote, men så pakker de bare bilen og triller ned gennem Europa til Patrick og Karins villa ude i skoven. Indretningen er alt i alt mere brun og 70’er-præget, end skandinaverne er vant til, men Louise og Bjørn er høflige gæster, og den første del af besøget går med at famle sig frem til en venskabelig omgangsform.\n\nDer er velvilje på begge sider, men alligevel føles noget forkert. Patrick viser sig hverken at være læge eller skamfuld over at have udgivet sig for at være det. Det er bare noget, han gør, når han møder fremmede og er lidt usikker. I Toscana var han fuld af beundring for Louises valg om ikke at spise kød, men dog fisk. Som vært nøder han hende stædigt til at smage den vildsvinesteg, han har tilberedt, og udsætter hende for et kritisk interview om, hvorvidt fisk ikke også er kød. Han respekterer heller ikke rigtigt en lukket badeværelsesdør, og Abels tavshed, der i Toscana havde en psykisk forklaring, forklares nu med, at drengen er født uden tunge. \n\nHavde det ikke været for underlægningsmusikken og lydsiden, der så tydeligt og effektivt varsler uhygge, ville midterste del af Speak No Evil fremstå som en omgang Ruben Östlund light. Man ser mennesker, der prøver at opføre sig ordentligt, men som ikke helt kan blive enige om, hvad det vil sige, og som heller ikke formår at leve op til deres egne standarder. For eksempel vil Louise og Bjørn gerne være i stand til at sige fra, men det er så pokkers svært, når grænseoverskridelserne hele tiden befinder sig lige på grænsen mellem det, der kan tilskrives forskellige normer, og decideret hensynsløshed.\n\nChristian Tafdrup er god til at se og iscenesætte, hvor den grænse går, men det er uhyggen, der holder filmen oppe, ikke dens observationer af mellemmenneskeligt besvær. På et tidspunkt tager den gevaldigt til, og fra den sidste del af filmen vil jeg ikke afsløre andet, end at fotografi, musik og klipning går op i en højere og frygtindgydende enhed, som man ikke ser så tit i dansk film. Her kan man tale om en skrækforestilling om, hvad det værste, der kan ske, er, der overgår ens fantasi.\n\n’Speak No Evil’. Instruktion: Christian Tafdrup. Manuskript Christian og Mads Tafdrup. Fotografi: Erik Molberg Hansen. Varighed: en time og 37 minutter. Dansk. Vises i biografer over hele landet.\n\n', '2024-09-23 17:15:48', 3, 'Speak no Evil'),
(2, NULL, 'Anders W. Bertelsen er efter tyve år tilbage i topform som den stædigt ubestikkelige journalist i politisk thriller, der effektivt punkterer vor selvforståelse som et idyllisk demokrati.', 'Mørkeland anmeldelse', '2010: Borgen.DR har bombastisk bildt alverden ind, at vort land er et idyllisk demokrati, hvor de onde er grimme og groteske, mens de gode er sunde og smukke. Politik er i Lilleputland mere personlige relationer end realpolitiske rænker.\n\nNu kommer filmatiseringen af Niels Krause-Kjærs andet bind om Ulrik Torp, Mørkeland, som Mikkel Serup (Kastanjemanden) har instrueret og Marie Østerbye (Fred til lands) skrevet. Det er faktisk ikke gået Ulrik særligt godt siden sidst. Trods sine oplagte evner er han nu arbejdsløs og muligvis kræftramt.\n\nHans gamle kollega er blevet chef, og vores standhaftige snushane af en journalist må gå tiggergang og arbejdsformidling for overhovedet at få noget at rive i.\n\nPlottet begynder med, at en embedsmand af anden etnisk oprindelse end dansk, hvilket er en brik i intrigen, myrdes brutalt. Mordet har forbindelse til stærke politiske kredse og finansielle interesserer. Den myrdede var nemlig på sporet af, at der bag fred og ingen fare med dialogkaffe i Snapstinget og konsensus indbyrdes partierne lurer der antidemokratiske kræfter.\n\nHvem disse tilhører, er historiens omdrejningspunkt.\n\nMå et samfund ikke nu og da bruge midler, som helliger målet – at redde demokratiet? En spændende tematik sat i relief af, at journalistik som den fjerde statsmagt mere og mere er omkalfatret til mikrofonvenligt føleri og tandløs klummeskrivning.\n\nAnders W. Berthelsen er tilbage i topform som den stædigt ubestikkelige journalist, den sidste kritiske reporter, fagets ukuelige spørgejørgen.\n\nHan graver efter sandheden, selv om det er op ad bakke og imod alle odds. Hjemmefronten krakelerer en smule, og som nævnt er der kanske kræft i anmarch?\n\nGamle kollegaer svigter, men heldigvis er der unge idealister. To praktikanter, Emma og Simon – spillet overbevisende af Mathilde Arcel og Patrick A. Hansen – bliver håndgangne hjælpere, på trods af at Torp i begyndelsen kun har foragt for dem.\n\nNicolas Bro er igen den småbøse bamse Henrik Moll, kollegaen som nu er antiheltens boss og alligevel god nok på bunden af chefgangen. Tommy Kenter er for det meste sinister bagmand, men har desværre en tendens til at holde enetaler om rigets elendige tilstand.\n\nIna-Miriam Rosenbaum stjæler scener, når hun agerer den desillusionerede, men synkefri skriverkvinde Bente.\n\nDanske skuespillere kan deres metier og formår at levere varen i diverse gradbøjninger af umiddelbar godhed og kalkulerende ondskab. Vi får en biljagt mod slutningen, som kan kaldes for halvnoir, i og med at det meste falder på plads på rette hylde.\n\nMørkeland måtte gerne have strammet skruen til en mere tough og spændende thriller, mindre vink med en vognstang og mere antydningens kunst.\n\nMen det er bestemt en seværdigt, socialrealistisk spændingsfilm, skabt i ånden fra indigneret Leif Panduro snarere end inciterende Alfred Hitchcock.\n\nVigtigst af alt understreger filmen, at Danmark – som uafladeligt praler af at være et af verdens mindst korrupte nationer – godt kan neddæmpe sin lobhudlende selvforståelse.', '2024-09-23 17:15:48', 5, 'Mørkeland'),
(3, NULL, 'Jonas Risvigs velspillede debutfilm om ungdommens magtkampe er som at gennemleve ens egen gymnasietid på 100 intense minutter.', 'Kontra anmeldelse', 'Fint ser det ud i villaens store baghave, hvor Fanny disker op med sushi og champagne til pigerne i sin nye gymnasieklasse. \n\nHun vil gerne være venner med dem. Selv om hendes indtryk af dem endnu farves af en skolefest, hvor pigerne i klassen klippede i hendes kjole og frøs andre ude. Alt ånder umiddelbart fred og fordragelighed, indtil de senere på aftenen kommer til diskoteket Søpavillonen i København. Det viser sig, at klikens intrigante leder Kajsa har fået alle med på invitationslisten undtagen Fanny, og aftenens vært må trille mutters alene hjem. \n\nHerfra optrappes konflikten. \n\nLigesom i instruktør og manuskriptforfatter Jonas Risvigs ungdomsserier Salsa og Drenge, er der genkendelige sociale dynamikker fra virkeligheden, som der skrues op for. Det skaber en intens oplevelse af at gennemleve ens gymnasietid på 100 minutter. \n\nFortællingen følger Fanny (Andrea Hjejle), der efter forældrenes skilsmisse flytter med moren fra Lolland til Nordsjælland. \n\nEfter fejlslagne forsøg på at blive del af klassens pigegruppe, knytter hun bånd med Lilja (Anna Lehrmann), der også holdes ude i klassen, fordi hun i en brandert var sammen med den fyr, som Kajsa var forelsket i. \n\nLilja bliver på mange måder et symbol på en verden, som Fanny vil være en del af, snarere end en jævnbyrdig hovedperson. Men sammen står de stærkest, når de går i modangreb på kliken, der vil holde makkerparret ude af sociale begivenheder. \n\nJonas Risvig, der kom frem som talent på Ekko Shortlist, er fantastisk dygtig til at opbygge og udfylde sine fiktive universer, så man længes efter mere. \n\nHandlingens placeringen på et nordsjællandsk gymnasium, som for nogle er velkendt, men for andre et mystisk parallelsamfund, er smart. For bag villavejenes hække kunne der skjule sig et nordisk Beverly Hills, som bare har ventet på at blive filmet. \n\nFordommene om rige og berømte mennesker, der bryster sig af deres privilegier i en uendelig magtkamp, har noget tilfælles med fejderne i gangsterfilm fra Goodfellas til Underverden, omend de foregår i markant anderledes miljøer. \n\nTilsat et par svinestreger udkæmpes den med et bagtæppe af dyre drinks, designerkjoler og fester, som her ikke købes for narkopenge, men på forældrenes betalingskort. I stedet for skudsalver finder kampene sted ved at nedstirre sin modstander på eksklusive, basstøjende klubber med røgmaskine og lange køer udenfor. \n\nKøen går de medvirkende naturligvis udenom, mens måbende københavnere tålmodigt må vente i kulden. \n\nFanny, Lilja og det øvrige persongalleri træffer dårlige beslutninger, som øjensynligt kan have store konsekvenser. Ligesom filmen selv er deres berusede tur med en cabriolet på motorvejen medrivende og sanselig, men bestemt også nervepirrende. \n\nScenen gør løftede pegefingre overflødige og fæstner hellere blikket ved ungdommens sorgfrie liv på kanten end på de langvarige konsekvenser. \n\nDet er både Andrea Hjejles og Anna Lehrmanns debutroller i dansk film som henholdsvis Fanny og Lilja. Sammen har de en kemi, der gør venskabet overbevisende. \n\nAndrea Hjejle træder i karakter som den nyankomne med søgende blikke og påtagede smil, der pludselig forsvinder, i takt med at pigerne på skolen hærder hende med ondsindede drillerier. \n\nAnna Lehrmann giver Lilja en iskold attitude. Hun mestrer et roligt, upåvirkeligt kropssprog, som fortæller omgivelserne, at de ikke kan slå hende ud af kurs. \n\nEn anden debutant, der fortjener ros, er Nikoline Mejnert Smith. Med sin portrættering af hævngerrige og magtsyge Kajsa gør hun forestillingen om lede gymnasiepiger til virkelighed. Samtidig er der en forbigående bævren i stemmen og rødmende kinder, der afslører det mere nuancerede menneske bag facaden. \n\nMen når filmen er allerbedst, troner hun over de andre, og med sin magt er hun en mindeværdig ungdomsskurk, der kan måle sig med Peter Reichhardts rige Sten fra Bille Augusts udødelige klassiker Zappa. ', '2024-09-25 14:20:35', 2, 'Kontra'),
(31, NULL, '\r\nEn intens og gribende fortælling om samfundets udstødte – hvor loyalitet og håb er det eneste våben.', 'Køterrevolutionen Anmeldelse', '\r\n\r\n”Køterrevolutionen” er en vovet og dyb film, der tager os med på en rejse ind i en dystopisk verden, hvor gadehunde danner en modstandsbevægelse mod et undertrykkende system. Med en skarp blanding af social kommentar og action, får instruktøren os til at reflektere over, hvem der egentlig er de sande undertrykte i vores samfund. Filmen balancerer på kanten mellem det absurde og det ubehageligt realistiske, og leverer en uforglemmelig oplevelse.', '2024-10-03 22:52:45', 4, 'Køterrevolutionen'),
(32, NULL, ' En idyllisk drøm, der brister i virkelighedens kaos\r\nUnderoverskrift: Trine Dyrholm leverer en uforglemmelig præstation i en film om kærlighed, venskab og sammenbrud i et fælles hjem.', 'Kollektivet Anmeldelse \r\n', '\r\n\r\nThomas Vinterbergs Kollektivet tager os med tilbage til 1970\'ernes København, hvor idealismen blomstrer i et kollektivt fællesskab, der dog hurtigt viser sig at være sårbart over for menneskelige følelser og konflikter. Filmen følger en gruppe mennesker, der forsøger at finde lykken i et fælles hus, men som langsomt opdager, at deres drømme kan føre til både sammenhold og splittelse.\r\n\r\nTrine Dyrholm stråler som Anna, en kvinde, der er passioneret for sine idealer, men som også konfronteres med realiteterne i sit liv. Hendes præstation er både nuanceret og stærk; hun formår at vise sårbarhed, styrke og en dyb længsel efter kærlighed og accept. Lars Mikkelsen, som hendes mand, bringer en solid dybde til karakteren, der balancerer mellem støtte og frustration.\r\n\r\nVinterbergs evne til at skildre de små nuancer i menneskelige relationer er bemærkelsesværdig. Dialogen er skarp, og hver scene er gennemsyret af en intensitet, der fanger seeren. Det er her, at filmen virkelig skinner — i de stille øjeblikke, hvor ordene ikke altid er nødvendige, og hvor blikke og pauser taler højere end ord.\r\n\r\nKollektivet viser, hvordan det, der starter som en drøm om frihed og fællesskab, langsomt bliver nedbrudt af jalousi, svigt og individuelle behov. Vinterberg formår at kombinere humor og tragedie på en måde, der efterlader seeren med en følelse af ambivalens — en forståelse for både de smukke og de grimme sider af menneskelige relationer.\r\n\r\nFilmen ender med en tankevækkende refleksion over, hvad det vil sige at være menneske i et fællesskab. Kollektivet er ikke bare en fortælling om idealisme og brud; det er en dybdegående udforskning af, hvad vi er villige til at ofre for kærlighed og venskab. Vinterberg har endnu engang bevist, at han er en mester i at skildre menneskelige relationer med dybde og ægthed.\r\n\r\nKollektivet er en film, der vil resonere hos alle, der har prøvet at navigere i kompleksiteten af fællesskab og individualitet. Det er en uforglemmelig oplevelse, der efterlader en varig indtryk.', '2024-10-03 23:02:17', 5, 'Kollektivet'),
(34, NULL, ' \"København: En Følelsesmæssig Rejse\"\r\n', 'København anmeldelse', '\"København\" er en mesterlig skildring af kærlighed og tab, der fanger essensen af den moderne storby. Trine Dyrholm og Lars Mikkelsen leverer fantastiske præstationer som et par, der navigerer i livets udfordringer. Filmens cinematografi er betagende, og den griber virkelig den unikke atmosfære i København. Mens plottet til tider kan føles lidt forudsigeligt, kompenserer den dybe karakterudvikling for dette. Et must-see for dem, der elsker rørende dramaer med en smule romantik.', '2024-10-03 23:42:34', 4, 'København'),
(35, NULL, '\r\nDesværre lever \"København\" ikke op til forventningerne. \r\n', 'København anmeldelse', 'Desværre lever \"København\" ikke op til forventningerne. Selvom skuespillerne, især Søren Malling, gør et fint stykke arbejde, føles manuskriptet fladt og uinspireret. Filmens tempo er langsomt, og den mangler den nødvendige spænding til at holde publikum engageret. Dialogen føles ofte klichéfyldt, og den emotionelle dybde, som filmen sigter efter, falder fladt. Det er en film, der ser godt ud, men desværre ikke leverer på det indholdsmæssige niveau.\r\n', '2024-10-03 23:42:34', 2, 'København'),
(36, NULL, '\"København: En Nydelse for Øjnene\"', 'København Anmeldelse', '\r\n\"København\" er en visuel fest med fantastiske billeder af byen, der næsten bliver en karakter i sig selv. Trine Dyrholm skinner i sin rolle og formidler en dybde og autenticitet, der trækker seeren ind i hendes verden. Filmen fanger den skiftende dynamik i moderne relationer og berører emner som identitet og tilhørsforhold. Selvom nogle plotvendinger kan virke forudsigelige, er det den emotionelle resonans, der efterlader et varigt indtryk. En film, man ikke må gå glip af!\r\n\r\n', '2024-10-03 23:42:34', 4, 'København'),
(49, NULL, 'København en kedelig film', 'København anmeldelse', 'kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig kedelig ', '2024-10-06 00:00:00', 1, NULL),
(81, NULL, 'sf', 'sds', 'ssf', '0201-02-01 00:00:00', 5, NULL),
(83, NULL, 'sofie1', '1', 'sofie1', '2024-10-07 00:00:00', 5, NULL),
(94, NULL, 'dvs', 'sfsf', 'dvs', '0053-04-23 00:00:00', 5, NULL),
(96, NULL, 'scs', 'scsc', 'ssc', '0004-03-01 00:00:00', 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userId` int NOT NULL AUTO_INCREMENT,
  `userName` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_danish_ci NOT NULL,
  `userEmail` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_danish_ci NOT NULL,
  `userPassword` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_danish_ci NOT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `email` (`userEmail`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_danish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userPassword`) VALUES
(1, 'Sofie', 'sofie.roshni@gmail.com', '8813'),
(2, 'Hadeel', 'Hadeel03@gmail.com', 'Hadeel03');

-- --------------------------------------------------------

--
-- Table structure for table `us_mov_rev_con`
--

DROP TABLE IF EXISTS `us_mov_rev_con`;
CREATE TABLE IF NOT EXISTS `us_mov_rev_con` (
  `u_m_rev_conId` int NOT NULL,
  `umrconUserId` int DEFAULT NULL,
  `umrconMovieId` int DEFAULT NULL,
  `umrconReviewId` text COLLATE utf8mb3_danish_ci,
  PRIMARY KEY (`u_m_rev_conId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_danish_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `actors`
--
ALTER TABLE `actors`
  ADD CONSTRAINT `actors_ibfk_1` FOREIGN KEY (`actmovActorId`) REFERENCES `actors` (`actorId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_2` FOREIGN KEY (`movieactorMovieId`) REFERENCES `actors` (`actmovActorId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `movies_ibfk_3` FOREIGN KEY (`movieactorMovieId`) REFERENCES `movie_actor` (`movieactorId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `movie_actor`
--
ALTER TABLE `movie_actor`
  ADD CONSTRAINT `movie_actor_ibfk_3` FOREIGN KEY (`movieConId`) REFERENCES `movies` (`movieId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `movie_actor_ibfk_5` FOREIGN KEY (`reviewConId`) REFERENCES `reviews` (`reviewId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `movie_actor_ibfk_6` FOREIGN KEY (`actorConId`) REFERENCES `actors` (`actorId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `movie_actor_ibfk_7` FOREIGN KEY (`reviewerConId`) REFERENCES `reviewers` (`reviewerId`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
