-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2024 at 05:32 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scholarship_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL,
  `username` varbinary(255) DEFAULT NULL,
  `pass` varbinary(255) DEFAULT NULL,
  `name` varbinary(255) DEFAULT NULL,
  `email` varbinary(255) DEFAULT NULL,
  `contact` varbinary(255) DEFAULT NULL,
  `admin_type` varbinary(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `username`, `pass`, `name`, `email`, `contact`, `admin_type`) VALUES
(1, 0x68506a62746f6b45386d686e67642f2f4b66703779773d3d, 0x68453471773330634a394a31575a6b506f77356c61773d3d, 0x61456e666e6575464c63446a6c5265734671726c44773d3d, 0x727447704142466f68496d337342563775524e4d66673d3d, 0x696f4531336d7351666171695754776a304c776375673d3d, 0x334776764d6f2b6e3735303954317678584e376c41673d3d);

-- --------------------------------------------------------

--
-- Table structure for table `tb_adminlog`
--

CREATE TABLE `tb_adminlog` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `actn` varbinary(255) DEFAULT NULL,
  `date_time` varbinary(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_adminlog`
--

INSERT INTO `tb_adminlog` (`id`, `admin_id`, `actn`, `date_time`) VALUES
(4, 1, 0x374235656d6f30384550584941692b59764a704444513d3d, 0x53692b336a67337034726f4277456f4c46346c4a4d634a636d36776d4d575932474a6d3762484f7545766f3d),
(5, 1, 0x50386330444a4855775133346c7356324d582b5649513d3d, 0x33595a4b78305230674d394d566c523366704430424d4754776555664347526d42636630586d466152386b3d),
(6, 1, 0x374235656d6f30384550584941692b59764a704444513d3d, 0x33595a4b78305230674d394d566c52336670443042486436546958484b366d446c43766848625173314c413d),
(7, 1, 0x50386330444a4855775133346c7356324d582b5649513d3d, 0x6f6a62697072497066314847346262734336514150734754776555664347526d42636630586d466152386b3d),
(8, 1, 0x374235656d6f30384550584941692b59764a704444513d3d, 0x67486d4e554f4430466f69776c41615a6b7a32314761364a4d2b38595931774646316557394467642f61343d),
(9, 1, 0x50386330444a4855775133346c7356324d582b5649513d3d, 0x3076706f756b763857594d68626d324871355a5832526b4a2b557a774c6f777a6d68676c5242303767786f3d),
(10, 1, 0x374235656d6f30384550584941692b59764a704444513d3d, 0x3076706f756b763857594d68626d324871355a5832586436546958484b366d446c43766848625173314c413d),
(11, 1, 0x50386330444a4855775133346c7356324d582b5649513d3d, 0x36575757525373714d48314434422b5767616f4572532f42486f6d50587473766d4c334633716a7936514d3d),
(12, 1, 0x374235656d6f30384550584941692b59764a704444513d3d, 0x4f4b715a5648466451637842527049667969387249734754776555664347526d42636630586d466152386b3d),
(13, 1, 0x50386330444a4855775133346c7356324d582b5649513d3d, 0x57394d595a2f3467454949662f6b366d39662f49392f566c364f75767059784e723856766e6763304c776b3d),
(14, 1, 0x374235656d6f30384550584941692b59764a704444513d3d, 0x57394d595a2f3467454949662f6b366d39662f493939674d686251376a3731374d51334851586f694471413d),
(15, 1, 0x50386330444a4855775133346c7356324d582b5649513d3d, 0x395972316e55795432727977514e726b52365334724d4a636d36776d4d575932474a6d3762484f7545766f3d),
(16, 1, 0x374235656d6f30384550584941692b59764a704444513d3d, 0x765665667651656778746d47783149736c70584944785974617a644377733664346968706545582f6f43593d),
(17, 1, 0x374235656d6f30384550584941692b59764a704444513d3d, 0x4a5a6d4444772f3375522f71374930444d3256344b327358495a7576676f44427553437066782b396148553d),
(18, 1, 0x374235656d6f30384550584941692b59764a704444513d3d, 0x582f7765454a657a7a543853723342494b78476444676a54395450426d35335870456f6a4a414d344f54513d),
(19, 1, 0x374235656d6f30384550584941692b59764a704444513d3d, 0x4e50557158514f5a6958316f7341557534594a654b686b4a2b557a774c6f777a6d68676c5242303767786f3d),
(20, 1, 0x374235656d6f30384550584941692b59764a704444513d3d, 0x4a657a704d6b4a2b4c424c496d527a5743384f6c4d706b38663642466a686b456f64696a6e56504c346a303d);

-- --------------------------------------------------------

--
-- Table structure for table `tb_announcement`
--

CREATE TABLE `tb_announcement` (
  `id` int(11) NOT NULL,
  `title` varbinary(255) DEFAULT NULL,
  `body` varbinary(500) DEFAULT NULL,
  `picture` varbinary(255) DEFAULT NULL,
  `created_at` varbinary(255) DEFAULT NULL,
  `updated_at` varbinary(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_application`
--

CREATE TABLE `tb_application` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `application_num` varbinary(255) DEFAULT NULL,
  `application_date` varbinary(255) DEFAULT NULL,
  `yearsem_id` int(11) DEFAULT NULL,
  `scholarship_id` int(11) DEFAULT NULL,
  `applicant_type` varbinary(255) DEFAULT NULL,
  `isScholar` varbinary(255) DEFAULT NULL,
  `otherScholarships` varbinary(500) DEFAULT NULL,
  `stats` varbinary(255) DEFAULT NULL,
  `isLocked` varbinary(255) DEFAULT NULL,
  `files` varbinary(10000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_application`
--

INSERT INTO `tb_application` (`id`, `student_id`, `application_num`, `application_date`, `yearsem_id`, `scholarship_id`, `applicant_type`, `isScholar`, `otherScholarships`, `stats`, `isLocked`, `files`) VALUES
(18, 9, 0x6244775a47337370464f77684b5544725a784b4648397677556e756d66656e446e57755470506a70664e383d, 0x644a557672546d73334e474372757a483665354d74773d3d, 3, 1, 0x5679797a6c6372394b576e7a6d4b6b6c597156716e513d3d, 0x4854637a35562b6538757441545170412b4b457557773d3d, 0x7a6336744b52615a7942325639664546716755446b413d3d, 0x6549657978537a747636664657484e2b3171386136673d3d, 0x61533631785a6374647671645778696a7044373731673d3d, 0x423353596f6643436954467969537545614b2b6642326d7663302f3933427a564876635934502b725a46776a42354a554c544a6b636c49484a59464c4449446467382f572b314b5130353735636a6b596c686d662b665a7768304651304d766759565872644d31305a31343d);

-- --------------------------------------------------------

--
-- Table structure for table `tb_approve`
--

CREATE TABLE `tb_approve` (
  `id` int(11) NOT NULL,
  `application_id` int(11) DEFAULT NULL,
  `award_number` varbinary(255) DEFAULT NULL,
  `approved_date` varbinary(255) DEFAULT NULL,
  `allowance` varbinary(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_approve`
--

INSERT INTO `tb_approve` (`id`, `application_id`, `award_number`, `approved_date`, `allowance`) VALUES
(3, 18, 0x5266474c7957666d476230687a4349334a6e42644442714339513574554c6c544d496d3378416f733645513d, 0x717a4f2b557379754c436f582f6c6245727a37462f513d3d, 0x782b394850344e4e435a335959304f586262396c47413d3d);

-- --------------------------------------------------------

--
-- Table structure for table `tb_familyinfo`
--

CREATE TABLE `tb_familyinfo` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `father_name` varbinary(255) DEFAULT NULL,
  `father_occupation` varbinary(255) DEFAULT NULL,
  `father_address` varbinary(255) DEFAULT NULL,
  `father_status` varbinary(255) DEFAULT NULL,
  `mother_name` varbinary(255) DEFAULT NULL,
  `mother_occupation` varbinary(255) DEFAULT NULL,
  `mother_address` varbinary(255) DEFAULT NULL,
  `mother_status` varbinary(255) DEFAULT NULL,
  `no_of_siblings` varbinary(255) DEFAULT NULL,
  `gross_income` varbinary(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_familyinfo`
--

INSERT INTO `tb_familyinfo` (`id`, `student_id`, `father_name`, `father_occupation`, `father_address`, `father_status`, `mother_name`, `mother_occupation`, `mother_address`, `mother_status`, `no_of_siblings`, `gross_income`) VALUES
(4, 9, 0x44466c4e615964485531645933356450396a57654d45707172455a6659527a2f2b4e6b6a614439797937733d, 0x4d416d724a4366724c6c34317753534e4b6e4f3051673d3d, 0x436c4d51664c37304975456c7279714c4b7379723257426961784f6848517a496d753156774343483164383d, 0x596e2f304d327a417736344b597058556d49307961513d3d, 0x62386b394b2b424b427931397259712b675956706a796c694337562f382f61564332433367706c646f33493d, 0x7a6336744b52615a7942325639664546716755446b413d3d, 0x436c4d51664c37304975456c7279714c4b7379723257426961784f6848517a496d753156774343483164383d, 0x6f56667246733135554c552f69386d65634e503850413d3d, 0x6b4a54634b57722b466672366750745756704e4172413d3d, 0x6368664451362b7a42677866434671776835316f30773d3d);

-- --------------------------------------------------------

--
-- Table structure for table `tb_fees`
--

CREATE TABLE `tb_fees` (
  `id` int(11) NOT NULL,
  `name` varbinary(255) DEFAULT NULL,
  `description` varbinary(500) DEFAULT NULL,
  `amount` varbinary(255) DEFAULT NULL,
  `coverage` varbinary(255) DEFAULT NULL,
  `frequency` varbinary(255) DEFAULT NULL,
  `ref_no` varbinary(255) DEFAULT NULL,
  `approval_date` varbinary(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_fees`
--

INSERT INTO `tb_fees` (`id`, `name`, `description`, `amount`, `coverage`, `frequency`, `ref_no`, `approval_date`) VALUES
(1, 0x396f31524246315459514f30434832777977317339513d3d, 0x7141647230716d3237314c71353647774931785a794e593252524a5756786f30755766506a74365257582b43572f4f4e6655794d586573333767524632776648374a374b4f505a2b676e515178715a77774c52415542546d4a4146617a66386347386f506b615a4d4279317541522b3946686e714b53735633462f6c524b6c42703769647143653034304b4a416f6651714b35466a4b57384657772f5952505a6d7342766d6733546d334d742b33415745465a57736767326578562f6f617a39414864587834364c333768424e36515a4b666453356a685256524d697859764d385830323036316d2b45773559725047306e63505371667270342f316654376e, 0x50796632592b4576682b77536b464d436a746e4a6d513d3d, 0x786e4f4474762f505037496668524d6e6476745959673d3d, 0x6b4a54634b57722b466672366750745756704e4172413d3d, 0x534646355269697a34526f47544c704870435a7834462f477a6961414e35334d4c36656c5a704e4c667052756e75545567787741484e306c424e466d7845424a, 0x7a51415045313544376c375775787642375662514d513d3d),
(3, 0x535571726838356f51326635525850493448626567673d3d, 0x7141647230716d3237314c71353647774931785a794e616b44555131304762716d734348554b494b6e496d4d33314763634555476f7a4f382b42654d426c764d5a764844725763796949523176536133453837792b496647486d4745696349737530664c386f5a4f6c32694559664352696e6a36704b756b4c45756f41455a3371316b7369446a4c3375587472724a446f796b324c413d3d, 0x67636b34786137686c545a7072635a307865724262773d3d, 0x786e4f4474762f505037496668524d6e6476745959673d3d, 0x6b4a54634b57722b466672366750745756704e4172413d3d, 0x534646355269697a34526f47544c704870435a7834462f477a6961414e35334d4c36656c5a704e4c667052756e75545567787741484e306c424e466d7845424a, 0x7a51415045313544376c375775787642375662514d513d3d),
(4, 0x476a38417437563677396f68346f474f7a432f6e73513d3d, 0x54376666704875723149707a622f6f6b7533364c4f565361694c3632546b646d623568437232554a4865756b6f6c656265526968517670694652764c516e2f475a572b7273584e3257776f7552676e2f2f564e5165497769556f544f4a564a38794d474b4c6c4873546c6e2b4571717567473478736844744631457a34693430384b3436624d736b636e567257586c544439593278372f797a37366c6c6972646444646279735778492f4c39544b6b30427866465637704d306e735a5269757a685a63684e4b46716e506f394955584e436136452b49756b355453616b586e3832624978746f503272466e3875324c676342494a734c7839584c66473477784d7053374f416b366175732b636f70666e653167617665325261724f6e3058442f6f64504f4f5a7972384c61484d7966356b5549774d39675336362b664f633675545158715475563274352b514b4c6f2b46724b7030673d3d, 0x555a5539363043365641585354696e4b6e672b5451413d3d, 0x786e4f4474762f505037496668524d6e6476745959673d3d, 0x6b4a54634b57722b466672366750745756704e4172413d3d, 0x4e6a48757049594b6b5a2b645577496e6767374c75544b384f6d796e3061577752396675524f76462b484c774833625a385777433455356f63374a4a68336852, 0x7a51415045313544376c375775787642375662514d513d3d);

-- --------------------------------------------------------

--
-- Table structure for table `tb_program`
--

CREATE TABLE `tb_program` (
  `id` int(11) NOT NULL,
  `name` varbinary(255) DEFAULT NULL,
  `cost_per_unit` varbinary(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_program`
--

INSERT INTO `tb_program` (`id`, `name`, `cost_per_unit`) VALUES
(1, 0x3538794b79464a5939666d3034596659586e6c714345576c4f4c3866486f366d726a5a4a54703652373847694c31356a78734e69764371454f54753150646951, 0x466239483837626d465035663853345278484b6f4f513d3d),
(3, 0x3330796e52544d62647850777658737561572f2b386262586b5936677733684966613436663158597534656d5871754b4d57434e344a34447231426e324b5630, 0x466239483837626d465035663853345278484b6f4f513d3d);

-- --------------------------------------------------------

--
-- Table structure for table `tb_scholarships`
--

CREATE TABLE `tb_scholarships` (
  `id` int(11) NOT NULL,
  `name` varbinary(255) DEFAULT NULL,
  `description` varbinary(500) DEFAULT NULL,
  `allowance` varbinary(255) DEFAULT NULL,
  `start_date` varbinary(255) DEFAULT NULL,
  `end_date` varbinary(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_scholarships`
--

INSERT INTO `tb_scholarships` (`id`, `name`, `description`, `allowance`, `start_date`, `end_date`) VALUES
(1, 0x4c5066505157584862436352595745706f6d494835356f38666550534e46535a3965366b5644636d4f62773d, 0x6a2b645044526d6e617574372b2b7031324c4b676652616279326f4768474154355044473569706e322f62797a385238746a7177342f414a636f7872426d74562b62554a4c5a3831724643705a68656e544d567230445942757279784a744e53736c4c79593439366f6144425776474b78697a33563367584b7230645771563961462b762b555235714e704c332f6f6b45676b4e435472386d697256343148617a71597639392f77325542734b65367a5a4b564b69686a644b59744b746e31394c78303948377868504e34436742743463713350304b44737a3939496f476738374756505a48374f4755412b71326c6849324b487056646b4e4c7572674564717356636f6e762b532b2f54755850464774705a424b7670536b32774766336f69686b34626c3838504a757950786b4e4b647377537a43396a687571646a7543336667436872325279554a7873493857327473456c4b4f42777178784a6d41743362766a6f5577386a6e53383d, 0x782b394850344e4e435a335959304f586262396c47413d3d, 0x78657a536f634733366265756d375773354858554c673d3d, 0x554546334155305743584a7957766e4e376e2f7168413d3d),
(4, 0x6b676c457835704f2f2b416f42456b2b58447148485945716b6c76536d493466743742534a78624c436b343d, 0x676b504d78356172654f5964474d3277714f466a7a71513472534e6a566e6550446c394f714f4f47463156586230774438462f51486c7072423065457974766d48376c3363534f466c695a772f72314f4b666b4b643371784a34317274395454397830702f4b6b445755465463536d49375348556d66486b754f37424e74704e575169782b416941717450357a635334674c5a594353586c6f4f4a66622f4c773275545a79646c393352715a4862614b712f2b69487539306b515472666f6a677a7575636947635661434c542b475a58316959444852313847657a67716c342f7a6f35414d54465336585a473653524d54493376314c37513939464d784f6c5264594e7967735634795776327149366b30632b782f335954616e474f516c6234514f456d32573657587a7658564e4b4a38707459564953644c5035396c794c4a477a4f75715231556155536359324a327946392f502b5248654761763756412b4f79554e312f534b704e493d, 0x2f2b2f7166795262315562756b53734879304f5249413d3d, 0x78657a536f634733366265756d375773354858554c673d3d, 0x6245586d37447973446837573455536442792b2b63413d3d);

-- --------------------------------------------------------

--
-- Table structure for table `tb_student`
--

CREATE TABLE `tb_student` (
  `id` int(11) NOT NULL,
  `student_number` varbinary(255) DEFAULT NULL,
  `pass` varbinary(255) DEFAULT NULL,
  `email` varbinary(255) DEFAULT NULL,
  `contact` varbinary(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_student`
--

INSERT INTO `tb_student` (`id`, `student_number`, `pass`, `email`, `contact`) VALUES
(9, 0x4b4a46474650386f395274426d4a2b474b73336b4c513d3d, 0x6b77346b33456d674d715a48714345664c3455764b673d3d, 0x7855416c424c4b6a6a503433624d71787a394e677569572f4f574a6a677245635942346d586457637057773d, 0x696f4531336d7351666171695754776a304c776375673d3d);

-- --------------------------------------------------------

--
-- Table structure for table `tb_studentinfo`
--

CREATE TABLE `tb_studentinfo` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `profile_pic` varbinary(255) DEFAULT NULL,
  `lrn` varbinary(255) DEFAULT NULL,
  `school_attended` varbinary(255) DEFAULT NULL,
  `school_id_num` varbinary(255) DEFAULT NULL,
  `school_address` varbinary(255) DEFAULT NULL,
  `school_sector` varbinary(255) DEFAULT NULL,
  `disability` varbinary(255) DEFAULT NULL,
  `tribal_membership` varchar(255) DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL,
  `yearlevel_id` int(11) DEFAULT NULL,
  `total_units` varbinary(255) DEFAULT NULL,
  `last_name` varbinary(255) DEFAULT NULL,
  `first_name` varbinary(255) DEFAULT NULL,
  `middle_name` varbinary(255) DEFAULT NULL,
  `birthdate` varbinary(255) DEFAULT NULL,
  `birthplace` varbinary(255) DEFAULT NULL,
  `sex` varbinary(255) DEFAULT NULL,
  `civil_status` varbinary(255) DEFAULT NULL,
  `religion` varbinary(255) DEFAULT NULL,
  `citizenship` varbinary(255) DEFAULT NULL,
  `address` varbinary(255) DEFAULT NULL,
  `postal_code` varbinary(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_studentinfo`
--

INSERT INTO `tb_studentinfo` (`id`, `student_id`, `profile_pic`, `lrn`, `school_attended`, `school_id_num`, `school_address`, `school_sector`, `disability`, `tribal_membership`, `program_id`, `yearlevel_id`, `total_units`, `last_name`, `first_name`, `middle_name`, `birthdate`, `birthplace`, `sex`, `civil_status`, `religion`, `citizenship`, `address`, `postal_code`) VALUES
(4, 9, 0x764b63376b556d647a6e794c6f302b55487166386635596d637478486133694c4d33342f6d5368314c377061646e5372384478324273324f61515963546c527436536d344c636b692f647757562b697379444c7536513d3d, 0x2f57574b56716b547237454c714930566843495a41413d3d, 0x546c4b65363346566962543938586f555a634546735638354a366d57503050576d6270664b6978796635633d, 0x7a6336744b52615a7942325639664546716755446b413d3d, 0x637932592f46332f38326a6353477075643450332b6161546a6e61363772493862784d4b41353731365a303d, 0x424564567a316d336f36734837784f4a717673374e513d3d, 0x7a6336744b52615a7942325639664546716755446b413d3d, 'zc6tKRaZyB2V9fEFqgUDkA==', 3, 16, 0x794271584f7a5166764135443249685157457a792b413d3d, 0x55656e2b655258374d6e42394c346d624e65704d2b673d3d, 0x4947594b4c513879615036574141317065484d4e67513d3d, 0x6573366e2f434173744b52754c3359624579434f48773d3d, 0x7968596e4d6a4e4968465238677656685265523571413d3d, 0x6f624c49322b48466b436a514747374467745536326161546a6e61363772493862784d4b41353731365a303d, 0x7538645355304f763543535178756846714b673457673d3d, 0x795765794741656b354266554d5a7237714a56632b773d3d, 0x434a474442642f6c76763972634769664c4150556f413d3d, 0x535a6e2b667a4c784575475649524b4648615a705a773d3d, 0x3048303176784f3353455869775a66722f765169365a70727959434678366f4949506c477549556e52366451756658634a4a42306f564931465454414f4a6575, 0x6d75784865545039363877516a4c445368776b7a31513d3d);

-- --------------------------------------------------------

--
-- Table structure for table `tb_yearlevel`
--

CREATE TABLE `tb_yearlevel` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `name` varbinary(255) DEFAULT NULL,
  `fees_id` varbinary(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_yearlevel`
--

INSERT INTO `tb_yearlevel` (`id`, `program_id`, `name`, `fees_id`) VALUES
(2, 1, 0x57654e783864485a71705651437547304c55584465513d3d, 0x5068315a344258696734436e4b3264315758666443513d3d),
(4, 1, 0x474b516350676e6b6d4a4443472f73374a6143496a413d3d, 0x5068315a344258696734436e4b3264315758666443513d3d),
(5, 3, 0x57654e783864485a71705651437547304c55584465513d3d, 0x4272666c582f764f585876712b4c56367a684d3152513d3d),
(7, 3, 0x474b516350676e6b6d4a4443472f73374a6143496a413d3d, 0x5068315a344258696734436e4b3264315758666443513d3d),
(15, 3, 0x586b7430655658446c44614c6f57754b735a695932513d3d, 0x66654c4564527970506551475363362f70565a3565413d3d),
(16, 3, 0x55466d3068426b6a627939384e762f6e5947374571413d3d, 0x66654c4564527970506551475363362f70565a3565413d3d);

-- --------------------------------------------------------

--
-- Table structure for table `tb_yearsem`
--

CREATE TABLE `tb_yearsem` (
  `id` int(11) NOT NULL,
  `academic_year` varbinary(255) DEFAULT NULL,
  `semester` varbinary(255) DEFAULT NULL,
  `start_date` varbinary(255) DEFAULT NULL,
  `end_date` varbinary(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_yearsem`
--

INSERT INTO `tb_yearsem` (`id`, `academic_year`, `semester`, `start_date`, `end_date`) VALUES
(3, 0x436372774f497158704743744143576d47637a4469413d3d, 0x625372443347694d787062353465732b596b714156773d3d, 0x644a557672546d73334e474372757a483665354d74773d3d, 0x514c757a66505035366e7059767150396258454548413d3d),
(4, 0x436372774f497158704743744143576d47637a4469413d3d, 0x6337792b6954477775716e31376c7049684a547772773d3d, 0x7348645a4d3846707279314f73337979455a7a5a73513d3d, 0x7439522b6b6b447434552b32724e5a5035376a6666673d3d);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_adminlog`
--
ALTER TABLE `tb_adminlog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `tb_announcement`
--
ALTER TABLE `tb_announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_application`
--
ALTER TABLE `tb_application`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `yearsem_id` (`yearsem_id`),
  ADD KEY `scholarship_id` (`scholarship_id`);

--
-- Indexes for table `tb_approve`
--
ALTER TABLE `tb_approve`
  ADD PRIMARY KEY (`id`),
  ADD KEY `application_id` (`application_id`);

--
-- Indexes for table `tb_familyinfo`
--
ALTER TABLE `tb_familyinfo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `tb_fees`
--
ALTER TABLE `tb_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_program`
--
ALTER TABLE `tb_program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_scholarships`
--
ALTER TABLE `tb_scholarships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_student`
--
ALTER TABLE `tb_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_studentinfo`
--
ALTER TABLE `tb_studentinfo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `program_id` (`program_id`),
  ADD KEY `yearlevel_id` (`yearlevel_id`);

--
-- Indexes for table `tb_yearlevel`
--
ALTER TABLE `tb_yearlevel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_id` (`program_id`);

--
-- Indexes for table `tb_yearsem`
--
ALTER TABLE `tb_yearsem`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_adminlog`
--
ALTER TABLE `tb_adminlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_announcement`
--
ALTER TABLE `tb_announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_application`
--
ALTER TABLE `tb_application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_approve`
--
ALTER TABLE `tb_approve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_familyinfo`
--
ALTER TABLE `tb_familyinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_fees`
--
ALTER TABLE `tb_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_program`
--
ALTER TABLE `tb_program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_scholarships`
--
ALTER TABLE `tb_scholarships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_student`
--
ALTER TABLE `tb_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_studentinfo`
--
ALTER TABLE `tb_studentinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_yearlevel`
--
ALTER TABLE `tb_yearlevel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_yearsem`
--
ALTER TABLE `tb_yearsem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_adminlog`
--
ALTER TABLE `tb_adminlog`
  ADD CONSTRAINT `tb_adminlog_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `tb_admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_application`
--
ALTER TABLE `tb_application`
  ADD CONSTRAINT `tb_application_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `tb_student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_application_ibfk_2` FOREIGN KEY (`yearsem_id`) REFERENCES `tb_yearsem` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_application_ibfk_3` FOREIGN KEY (`scholarship_id`) REFERENCES `tb_scholarships` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_approve`
--
ALTER TABLE `tb_approve`
  ADD CONSTRAINT `tb_approve_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `tb_application` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_familyinfo`
--
ALTER TABLE `tb_familyinfo`
  ADD CONSTRAINT `tb_familyinfo_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `tb_student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_studentinfo`
--
ALTER TABLE `tb_studentinfo`
  ADD CONSTRAINT `tb_studentinfo_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `tb_student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_studentinfo_ibfk_2` FOREIGN KEY (`program_id`) REFERENCES `tb_program` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_studentinfo_ibfk_3` FOREIGN KEY (`yearlevel_id`) REFERENCES `tb_yearlevel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_yearlevel`
--
ALTER TABLE `tb_yearlevel`
  ADD CONSTRAINT `tb_yearlevel_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `tb_program` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
