-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 27, 2018 at 03:48 PM
-- Server version: 5.7.17-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_id` int(11) NOT NULL,
  `libuser_id` int(11) DEFAULT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_password` varchar(255) NOT NULL,
  `account_isonline` tinyint(1) NOT NULL DEFAULT '0',
  `account_role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `libuser_id`, `account_name`, `account_password`, `account_isonline`, `account_role`) VALUES
(1, 1, 'admin', '$2y$10$p8oMO5i/PFCycyTY2QeDJOTKWotfi0EcAWMnsX8LY4y0WbW6C1c2W', 1, 'admin'),
(2, 9, 'user_', '$2y$10$eV2zneSPxCfZikEvDKPBh.3OuPJRQKxQ5V1rjBZ96gx.QW8T.9Jsm', 0, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `article_id` int(11) NOT NULL,
  `article_titel` varchar(255) NOT NULL,
  `article_synopsis` mediumtext NOT NULL,
  `article_publisher` varchar(255) NOT NULL,
  `article_keywords` varchar(255) NOT NULL,
  `article_tags` varchar(255) NOT NULL,
  `article_cover` varchar(255) NOT NULL,
  `article_urlpdf` varchar(255) NOT NULL,
  `article_urlaudio` varchar(255) NOT NULL,
  `article_pages` int(11) NOT NULL,
  `article_publishingdate` date NOT NULL,
  `article_category` varchar(255) NOT NULL,
  `article_author` varchar(255) NOT NULL,
  `article_borrowable` tinyint(1) NOT NULL DEFAULT '1',
  `article_memo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`article_id`, `article_titel`, `article_synopsis`, `article_publisher`, `article_keywords`, `article_tags`, `article_cover`, `article_urlpdf`, `article_urlaudio`, `article_pages`, `article_publishingdate`, `article_category`, `article_author`, `article_borrowable`, `article_memo`) VALUES
(2, 'شرح أصول اعتقاد أهل السنة والجماعة', 'شرح أصول اعتقاد أهل السنة والجماعة من الكتاب والسنة وإجماع الصحابة والتابعين ومن بعدهم هو كتاب في العقيدة الإسلامية لهبة الله بن الحسن بن منصور الطبري اللالكائي الشافعي (ت 418 هـ)، قسم فيه اللالكائي أصول العقيدة عند أهل السنة والجماعة إلى التوحيد والأسماء والصفات، والإيمان بالنبي، ومعنى الإيمان أنه قول وعمل، الإيمان بالشفاعة، والإيمان بالآخرة والجنة والنار ومشاهد يوم القيامة، وفضائل الصحابة.', 'دار طيبة', 'فقه', 'كتاب', 'pics/books/18047-charh-ousoul.jpg', '', '', 1687, '2003-01-01', 'سنة', 'اللالكائي ', 1, ''),
(3, 'دروس في العقيدة الإسلامية ', '', 'دار الرسول الأكرم ', '', 'كتاب', 'pics/books/alfekerbooks069_000COVER.jpg', '', '', 1200, '2016-01-01', 'عقيدة', 'الشيخ محمد تقي مصباح اليزدي', 1, NULL),
(4, 'مجموع فتاوى شيخ الإسلام أحمد بن تيمية ', '', 'مجمع الملك فهد لطباعة المصحف الشريف', '', 'كتاب', 'pics/books/j4know_2016_4_30_04_06_1462046789pm.jpg', '', '', 37, '2004-01-01', 'فقه', 'أحمد بن عبد الحليم بن تيمية', 1, NULL),
(5, 'مقامات بديع الزمان الهمذاني', '\r\nصفحة من مقامات بديع الزمان الهمداني\r\nمقامات بديع الزمان الهمذاني ، أول كتاب ألف في فن المقامات، إلا أنه لم يلق ما لقيته مقامات الحريري من العناية بشرحها وتفسير غريبها لأسباب يعرفها من نظر في مقامات بديع الزمان ورسائله كالرسالة رقم 167، فضاع القسم الأكبر منها ولم يبق من أصل 400 مقامة هي مجموع الكتاب سوى 52 مقامة، عاث بها النساخ كما يقول الأستاذ الإمام محمد عبده (بما أفسد المبنى وغير المعنى مع زيادات تضر بالأصول وتذهب بالذهن عن المعقول، ونقص يُهزّع الأساليب وينقض بنيان التراكيب، فالناظر فيها إن كان ضعيفاً ضل وحار، وإن كان عرّيفاً لم يأمن العثار) وقد أوجز حاجي خليفة التعريف به واكتفي بقوله : (وهو سابق على الحريري والحريري ألف على منواله)', 'داار نشر الكتاب', 'مقامات', 'كتاب', 'pics/books/____.jpg', '', '', 403, '1963-01-01', 'سنة', 'بديع الزمان الهمذاني', 1, ''),
(6, 'صور من الشرق في أندونسيا', 'قال المؤلف في مقدمة الطبعة الأولى للكتاب: \"من ست سنين انعقد في القدس مؤتمر إسلامي للنظر في نكبة فلسطين وطريق العمل على نصرتها، وفدت عليه الوفود من بلاد الإسلام كلها، من مراكش إلى أندونيسيا، وكان \"برلماناً شعبياً\" مثّل كلَّ بلد فيه زعماؤه وكبار أهله. ورأى أعضاء المؤتمر القدس وما حلّ بها، وشاهدوا آثار المأساة وبقاياها؛ فتقاسموا على نذر أنفسهم للعمل لها. وانتخب المؤتمر لجاناً ثلاثاً، كانت إحداها لجنة للدعاية والإنعاش الروحي، شرّفني برياستها وكلفها أن تطوف العالم الإسلامي، تعرف بفلسطين وتدعو الناس لإمدادها بالمال. وكنا خمسة: اثنين من العراق؛ الشيخ الزهاوي والأستاذ الصواف، واثنين من الجزائر، وأنا. فاعتذر الجزائريان، ورجع الصواف مضطراً من كراتشي، فبقيت مع أستاذنا الجليل، بركة العصر، الشيخ أمجد الزهاوي. وكان علينا أن نجمع المال، ولكنا خفنا أن يقول الناس إننا سرقنا أو أخذنا لأنفسنا؛ فآثرنا السلامة، وجعلنا عملنا أن نشرح للناس قضية فلسطين ونصف لهم مأساتها ونعرض عليهم أدوارها، وأن نؤلف اللجان في كل بلد لتجمع هي المال لها وتبعثه مع أمناء منها\".', ' دار المنارة - جدة', '.', 'كتاب', 'pics/books/7852172.jpg', '', '', 200, '2008-01-01', 'سنة', 'علي الطنطاوي', 1, ''),
(7, 'عبقرية عثمان بن عفان رضي الله عنه', 'يتحدث في هذا الكتاب عن الخليفة الثالث عثمان بن عفان وعن اريحيته وليس عبقريته. و يقارن بين ما كان عليه العرب قبل الإسلام من ظلم الحكام إلى ما وصلوا اليه من محاسبة الحاكم وهي إحدى أهم ركائز الديموقراطية ويتحدث عن حادث مبايعته كخليفة وكيف تم اختياره من بين صحابيين جليلين هما: علي بن أبي طالب وعبد الرحمن بن عوف وان اختياره لم يكن خدعة للامام علي.\r\n\r\nو يعارض الكاتب رأي بعض المؤرخين الذين اتهموه بالضعف ويشيد بدوره في استدباب الامن بعد الهجمات التي حدثت من دول الجوار بعد مقتل الخليفة الثاني عمر بن الخطاب. و يتحدث عن الرخاء الاقتصادي الذي حدث في عهد الخليفة عثمان وانه وصل لدرجة جعلت الناس يتجرؤون على الحكام من دون علم. كما يتحدث الكاتب عن إسلامه وجمع القرآن. و يولي أهمية لحادث اغتياله أكثر من حادث اغتيال الخليفة عمر لانه حدث بايد مسلمة ولم يكن ثورة شعبية وانما نتيجة لمشاغبة محلية خلافاً للخليفة عمر الذي اغتاله مجوسي بتدبير وتخطيط.', 'المكتبة العصريه', 'حضارة', 'كتاب', 'pics/books/10429043.jpg', '', '', 150, '2006-01-01', 'حضارة', 'عباس محمود العقاد', 1, NULL),
(8, 'فقه السنة', '', 'دار الكتاب العربي', 'فقه', 'كتاب', 'pics/books/fikhsonna.jpg', '', '', 1725, '1973-01-01', 'سنة', 'السيد سابق', 1, ''),
(9, 'روائع من اشعار الصحابة', '\r\nهذا الكتاب الذي بين أيدينا -كتاب روائع من إشعار الصحابة- من مؤلفات الأستاذ البارع الأديب المحدث العلامة فريد الدين مسعود حفظه الله تعالى وأبقاه لنا دخرا ثمينا، وقد قام المؤلف بتأليف هذا الكتاب الرائع الممتاز في سنة 1389/1968م. جمع فيه 435 بيتا من41 صحابيا من أصحاب النبي صلى الله عليه وسلم، وكان من أهداف المؤلف -كما حدثني- جمع الأبيات التي تتعلق بها قصة إيمانية رائعة، مما أنشدها أصحاب النبي صلى الله عليه وسلم بدافع من العطفة الإيمانية. وقد أمرني المؤلف -شيخي و', 'دار الحديث- القاهرة', '', 'كتاب', 'pics/books/g2337.jpg', '', '', 244, '2005-01-01', '', 'فريد الدين مسعود', 1, NULL),
(10, ' البصائر والذخائر', 'كتاب البصائر والذخائر: هو كتاب ضخم ألفه التوحيدي كما يقول ياقوت في عشرة أجزاء، كل جزء له فاتحة وخاتمة وقد عشر على تسعة أجزاء منها وهو ثمرة عمل دام خمسة عشر عاما امتدت بين 350 هـ و 365 هـ وقد عرف الكتاب بأسماء مختلفة فهو تارة البصائر والذخائر، أو البصائر والنوادر، وأخرى بصائر القدماء وسرائر الحكماء وخواطر البلغاء، وحينا، أخبار القدماء وذخائر الحكماء كما ورد في غرر الخصائص للوطواط وحينا آخر، البصائر عند ياقوت الرومي والاسنوي صاحب طبقات الشافعية وعند التوحيدي نفسه في مثالب الوزيرين.\r\n\r\nأن هذا الكتاب ثمرة مطالعات التوحيدي ومشاهداته وسماعاته وقد ذكر التوحيدي في مطالع كتابه المصادر الرئيسية التي أعتمد عليها في تصنيفه هذا الأثر الضخم فهي تشتمل إلى جانب مؤلفات الجاحظ، على أمهات المتب المعروفة مثل \"النوادر\" لأبي عبد الله محمد بن زياد الاعرابي و\"الكامل\" للمبرد و\"عيون الأخبار\" لأبن قتيبة و\"مجالسات ثعلب\" و\"المنظوم والمنثور\" لأبن أبي طاهر و\"الأوراق\" للصولي و\"الوزراء\" لأبن عبدوس و\"الحيوانات\" لقدامة هذا عدا القرآن والسنة، ولا شك في أن التوحيدي أقدم على أختيار ما وتدوين ما دوّن بدافع من ذوقه وهواه ومزاجه وثقافته الدينية التقليدية ومذهبه الفلسفي في الاعتزال.\r\n', ' دار صادر - بيروت', ' البصائر,الذخائر', 'كتاب', 'pics/books/13099936.jpg', '', '', 756, '2009-01-01', 'أدب', 'أبو حيان التوحيدي', 1, ''),
(11, 'فقه السيرة', 'ومحمد - صلى الله عليه وسلم - ليس قصة تتلى في يوم ميلاده كما يفعل الناس الآن، ولا التنويه به يكون في الصلوات... المخترعة التي قد تُضم إلى ألفاظ الأذان، ولا إكنان حبه يكون بتأليف مدائح له أو صياغة نعوت مستغربة يتلوها العاشقون، ويتأوهون أو لا يتأوهون! فرباط المسلم برسوله الكريم أقوى وأعمق من هذه الروابط الملفقة المكذوبة على الدين، وما جنح المسلمون إلى هذه التعابير في الإبانة عن تعلقهم بنبيهم - إلا يوم أن تركوا الباب الملئ وأعياهم حمله، فاكتفوا بالمظاهر والأشكال. ولما كانت هذه المظاهر والأشكال محدودة في الإسلام، فقد افتنُّوا في اختلاق صور أخرى، ولا عليهم فهي لن تكلفهم جهدًا ينكصون عنه، إن الجهد الذي يتطلب العزمات هو الاستمساك باللباب المهجور، والعودة إلى جوهر الدين ذاته، فبدلًا من الاستماع إلى قصة المولد يتلوها صوت رخيم، ينهض المرء إلى تقويم نفسه وإصلاح شأنه حتى يكون قريبًا من سنن محمد صلى الله عليه وسلم في معاشه ومعاده، وحربه وسلمه، وعلمه وعمله، وعاداته وعباداته...', ' دار الدعوة', 'سيرة،سنة،فقه', 'كتاب', 'pics/books/16121890.jpg', '', '', 525, '1987-01-01', 'سيرة', 'محمد الغزالي', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `borrow_id` int(11) NOT NULL,
  `copy_id` int(11) DEFAULT NULL,
  `libuser_id` int(11) DEFAULT NULL,
  `borrow_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `borrow_returndate` datetime NOT NULL,
  `borrow_returned` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`borrow_id`, `copy_id`, `libuser_id`, `borrow_date`, `borrow_returndate`, `borrow_returned`) VALUES
(1, 5, 12, '2018-01-26 09:35:10', '2018-05-01 09:35:10', 1),
(2, 9, 7, '2018-01-10 09:35:29', '2018-04-18 09:35:29', 1),
(3, 1, 9, '2018-01-26 09:35:35', '2018-05-11 09:35:35', 1),
(4, 18, 1, '2018-02-26 09:35:47', '2018-05-11 09:35:47', 1),
(5, 25, 7, '2018-01-26 09:36:04', '2018-05-11 09:36:04', 1),
(6, 13, 4, '2018-04-26 09:38:36', '2018-05-11 09:38:36', 1),
(7, 2, 9, '2018-01-26 09:39:11', '2018-05-11 09:39:11', 1),
(8, 3, 8, '2018-03-26 09:39:18', '2018-05-11 09:39:18', 1),
(9, 8, 1, '2018-01-26 09:39:25', '2018-05-11 09:39:25', 1),
(10, 4, 1, '2018-04-26 09:39:36', '2018-05-11 09:39:36', 1),
(11, 6, 7, '2018-02-26 09:39:43', '2018-05-11 09:39:43', 1),
(12, 7, 1, '2018-02-26 09:40:09', '2018-05-11 09:40:09', 1),
(13, 5, 1, '2018-02-26 09:40:15', '2018-05-11 09:40:15', 1),
(14, 1, 9, '2018-02-26 09:40:23', '2018-05-11 09:40:23', 1),
(16, 4, 2, '2018-02-06 19:04:40', '2018-04-08 20:04:40', 1),
(17, 5, 2, '2018-02-06 19:04:40', '2018-04-08 20:04:40', 1),
(18, 6, 2, '2018-02-06 19:04:40', '2018-04-08 20:04:40', 1),
(19, 7, 2, '2018-02-06 19:04:40', '2018-04-08 20:04:40', 1),
(20, 9, 2, '2018-02-06 19:04:40', '2018-04-08 20:04:40', 1),
(21, 10, 2, '2018-02-06 19:04:40', '2018-04-08 20:04:40', 1),
(22, 11, 2, '2018-03-06 19:04:41', '2018-04-08 20:04:41', 1),
(23, 1, 2, '2018-03-06 19:06:26', '2018-04-08 20:06:26', 1),
(24, 2, 2, '2018-03-06 19:06:26', '2018-04-30 20:06:26', 1),
(25, 4, 1, '2018-03-06 19:12:24', '2018-04-08 20:12:24', 1),
(26, 5, 1, '2018-03-06 19:12:24', '2018-04-08 20:12:24', 1),
(27, 4, 3, '2018-04-06 19:14:15', '2018-04-08 20:14:15', 1),
(28, 5, 3, '2018-02-06 19:14:15', '2018-04-08 20:14:15', 1),
(29, 6, 3, '2018-03-06 19:14:15', '2018-04-08 20:14:15', 1),
(30, 7, 3, '2018-03-06 19:14:15', '2018-04-08 20:14:15', 1),
(31, 4, 2, '2018-04-06 19:28:09', '1970-01-01 01:00:00', 1),
(32, 5, 2, '2018-04-06 19:28:09', '1970-01-01 01:00:00', 1),
(33, 6, 2, '2018-04-06 19:28:09', '1970-01-01 01:00:00', 1),
(34, 4, 2, '2018-04-06 19:30:56', '2018-04-21 20:30:56', 1),
(35, 5, 2, '2018-04-06 19:30:56', '2018-04-21 20:30:56', 1),
(36, 6, 2, '2018-04-06 19:30:56', '2018-04-21 20:30:56', 1),
(37, 1, 2, '2018-04-06 19:31:36', '2018-04-21 20:31:36', 1),
(38, 2, 2, '2018-04-06 19:31:36', '2018-04-21 20:31:36', 1),
(39, 3, 2, '2018-04-06 19:31:37', '2018-04-21 20:31:37', 1),
(40, 4, 2, '2018-04-06 19:31:37', '2018-04-21 20:31:37', 1),
(41, 5, 5, '2018-04-06 19:31:42', '2018-04-21 20:31:42', 1),
(42, 6, 5, '2018-04-06 19:31:42', '2018-04-21 20:31:42', 1),
(43, 7, 5, '2018-04-06 19:31:43', '2018-04-21 20:31:43', 1),
(44, 9, 1, '2018-04-06 19:31:48', '2018-04-21 20:31:48', 1),
(45, 10, 1, '2018-04-06 19:31:48', '2018-04-21 20:31:48', 1),
(46, 11, 4, '2018-04-06 19:31:54', '2018-04-21 20:31:54', 1),
(47, 1, 2, '2018-04-06 19:35:04', '2018-04-21 20:35:04', 1),
(48, 2, 2, '2018-04-06 19:35:04', '2018-04-21 20:35:04', 1),
(49, 3, 2, '2018-04-06 19:35:04', '2018-04-21 20:35:04', 1),
(50, 4, 2, '2018-04-06 19:35:04', '2018-04-21 20:35:04', 1),
(51, 6, 2, '2018-04-06 19:28:09', '2018-04-30 01:00:00', 1),
(52, 4, 2, '2018-04-06 19:30:56', '2018-04-21 20:30:56', 1),
(53, 5, 2, '2018-04-06 19:30:56', '2018-04-21 20:30:56', 1),
(54, 6, 2, '2018-04-06 19:30:56', '2018-04-21 20:30:56', 1),
(55, 1, 2, '2018-04-06 19:31:36', '2018-04-21 20:31:36', 1),
(56, 2, 2, '2018-04-06 19:31:36', '2018-04-21 20:31:36', 1),
(57, 3, 2, '2018-04-06 19:31:37', '2018-04-21 20:31:37', 1),
(58, 4, 2, '2018-04-06 19:31:37', '2018-04-21 20:31:37', 1),
(59, 5, 5, '2018-04-06 19:31:42', '2018-04-21 20:31:42', 1),
(60, 6, 5, '2018-04-06 19:31:42', '2018-04-21 20:31:42', 1),
(61, 7, 5, '2018-04-06 19:31:43', '2018-04-21 20:31:43', 1),
(62, 9, 1, '2018-04-06 19:31:48', '2018-04-21 20:31:48', 1),
(63, 10, 1, '2018-04-06 19:31:48', '2018-04-21 20:31:48', 1),
(64, 11, 4, '2018-04-06 19:31:54', '2018-04-21 20:31:54', 1),
(65, 1, 2, '2018-04-06 19:35:04', '2018-04-21 20:35:04', 1),
(66, 2, 2, '2018-04-06 19:35:04', '2018-04-21 20:35:04', 1),
(67, 3, 2, '2018-04-06 19:35:04', '2018-04-21 20:35:04', 1),
(68, 4, 2, '2018-04-06 19:35:04', '2018-04-21 20:35:04', 1),
(69, 5, 12, '2018-01-26 09:35:10', '2018-05-01 09:35:10', 1),
(70, 9, 7, '2018-01-10 09:35:29', '2018-04-18 09:35:29', 1),
(71, 1, 9, '2018-01-26 09:35:35', '2018-05-11 09:35:35', 1),
(72, 18, 1, '2018-02-26 09:35:47', '2018-05-11 09:35:47', 1),
(73, 25, 7, '2018-01-26 09:36:04', '2018-05-11 09:36:04', 1),
(74, 13, 4, '2018-04-26 09:38:36', '2018-05-11 09:38:36', 1),
(75, 2, 9, '2018-01-26 09:39:11', '2018-05-11 09:39:11', 1),
(76, 3, 8, '2018-03-26 09:39:18', '2018-05-11 09:39:18', 1),
(77, 8, 1, '2018-01-26 09:39:25', '2018-05-11 09:39:25', 1),
(78, 4, 1, '2018-04-26 09:39:36', '2018-05-11 09:39:36', 1),
(79, 6, 7, '2018-02-26 09:39:43', '2018-05-11 09:39:43', 1),
(80, 7, 1, '2018-02-26 09:40:09', '2018-05-11 09:40:09', 1),
(81, 5, 1, '2018-02-26 09:40:15', '2018-05-11 09:40:15', 1),
(82, 1, 9, '2018-02-26 09:40:23', '2018-05-11 09:40:23', 1),
(83, 4, 2, '2018-02-06 19:04:40', '2018-04-08 20:04:40', 1),
(84, 5, 2, '2018-02-06 19:04:40', '2018-04-08 20:04:40', 1),
(85, 6, 2, '2018-02-06 19:04:40', '2018-04-08 20:04:40', 1),
(86, 7, 2, '2018-02-06 19:04:40', '2018-04-08 20:04:40', 1),
(87, 9, 2, '2018-02-06 19:04:40', '2018-04-08 20:04:40', 1),
(88, 10, 2, '2018-02-06 19:04:40', '2018-04-08 20:04:40', 1),
(89, 11, 2, '2018-03-06 19:04:41', '2018-04-08 20:04:41', 1),
(90, 1, 2, '2018-03-06 19:06:26', '2018-04-08 20:06:26', 1),
(91, 2, 2, '2018-03-06 19:06:26', '2018-04-08 20:06:26', 1),
(92, 4, 1, '2018-03-06 19:12:24', '2018-04-08 20:12:24', 1),
(93, 5, 1, '2018-03-06 19:12:24', '2018-04-08 20:12:24', 1),
(94, 5, 12, '2018-01-26 09:35:10', '2018-05-01 09:35:10', 1),
(95, 9, 7, '2018-01-10 09:35:29', '2018-04-18 09:35:29', 1),
(96, 1, 9, '2018-01-26 09:35:35', '2018-05-11 09:35:35', 1),
(97, 18, 1, '2018-02-26 09:35:47', '2018-05-11 09:35:47', 1),
(98, 25, 7, '2018-01-26 09:36:04', '2018-05-11 09:36:04', 1),
(99, 13, 4, '2018-04-26 09:38:36', '2018-05-11 09:38:36', 1),
(100, 2, 9, '2018-01-26 09:39:11', '2018-05-11 09:39:11', 1),
(101, 3, 8, '2018-03-26 09:39:18', '2018-05-11 09:39:18', 1),
(102, 8, 1, '2018-01-26 09:39:25', '2018-05-11 09:39:25', 1),
(103, 4, 1, '2018-04-26 09:39:36', '2018-05-11 09:39:36', 1),
(104, 6, 7, '2018-02-26 09:39:43', '2018-05-11 09:39:43', 1),
(105, 7, 1, '2018-02-26 09:40:09', '2018-05-11 09:40:09', 1),
(106, 5, 1, '2018-02-26 09:40:15', '2018-05-11 09:40:15', 1),
(107, 1, 9, '2018-02-26 09:40:23', '2018-05-11 09:40:23', 1),
(108, 4, 2, '2018-02-06 19:04:40', '2018-04-08 20:04:40', 1),
(109, 5, 2, '2018-02-06 19:04:40', '2018-04-08 20:04:40', 1),
(110, 6, 2, '2018-02-06 19:04:40', '2018-04-08 20:04:40', 1),
(111, 7, 2, '2018-02-06 19:04:40', '2018-04-08 20:04:40', 1),
(112, 9, 2, '2018-02-06 19:04:40', '2018-04-08 20:04:40', 1),
(113, 10, 2, '2018-02-06 19:04:40', '2018-04-08 20:04:40', 1),
(114, 11, 2, '2018-03-06 19:04:41', '2018-04-08 20:04:41', 1),
(115, 1, 2, '2018-03-06 19:06:26', '2018-04-08 20:06:26', 1),
(116, 2, 2, '2018-03-06 19:06:26', '2018-04-30 20:06:26', 1),
(117, 4, 1, '2018-03-06 19:12:24', '2018-04-08 20:12:24', 1),
(118, 5, 1, '2018-03-06 19:12:24', '2018-04-08 20:12:24', 1),
(119, 4, 2, '2018-04-26 10:05:22', '2018-05-11 10:05:22', 0),
(120, 1, 1, '2018-04-26 10:05:29', '2018-05-11 10:05:29', 1),
(121, 15, 1, '2018-04-26 10:05:40', '2018-05-11 10:05:40', 0),
(122, 19, 11, '2018-04-27 15:51:54', '2018-05-07 15:51:54', 1),
(123, 11, 1, '2018-04-27 15:55:13', '2018-05-12 15:55:13', 0);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `config_number_max` int(11) NOT NULL,
  `config_reservation_max` int(11) NOT NULL,
  `config_days_max` int(11) NOT NULL,
  `config_insc` date NOT NULL,
  `config_email_address` varchar(255) DEFAULT NULL,
  `config_email_smtp` varchar(255) DEFAULT NULL,
  `config_email_tls` varchar(10) DEFAULT NULL,
  `config_reservation_number` int(11) DEFAULT NULL,
  `config_id` int(11) NOT NULL,
  `config_email_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`config_number_max`, `config_reservation_max`, `config_days_max`, `config_insc`, `config_email_address`, `config_email_smtp`, `config_email_tls`, `config_reservation_number`, `config_id`, `config_email_password`) VALUES
(2, 2, 15, '1994-10-20', '', '', '', 2, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `copy`
--

CREATE TABLE `copy` (
  `copy_id` int(11) NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `copy_state` varchar(255) NOT NULL DEFAULT 'idle',
  `copy_position` int(11) NOT NULL,
  `copy_price` float NOT NULL,
  `copy_source` varchar(255) NOT NULL,
  `copy_enteringdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `copy`
--

INSERT INTO `copy` (`copy_id`, `article_id`, `copy_state`, `copy_position`, `copy_price`, `copy_source`, `copy_enteringdate`) VALUES
(1, 2, 'متوفر', 150, 0, 'متبرع', '2014-01-01'),
(2, 2, 'متوفر', 150, 1500, 'شراء', '2015-01-01'),
(3, 3, 'محجز', 40, 2500, 'شراء', '2017-01-01'),
(4, 3, 'معار', 40, 0, 'تبرع', '2018-01-01'),
(5, 10, 'متوفر', 20, 700, 'شراء', '2018-08-26'),
(6, 10, 'متوفر', 20, 700, 'شراء', '2015-08-26'),
(7, 10, 'متوفر', 20, 700, 'شراء', '2015-08-26'),
(8, 10, 'متوفر', 21, 700, 'شراء', '2015-08-26'),
(9, 10, 'متوفر', 21, 700, 'شراء', '2015-08-26'),
(10, 9, 'محجز', 53, 0, 'تبرع', '2008-04-26'),
(11, 9, 'معار', 53, 0, 'تبرع', '2008-04-26'),
(12, 9, 'متوفر', 54, 600, 'شراء', '2013-04-26'),
(13, 11, 'متوفر', 10, 2500, 'شراء', '2003-04-26'),
(14, 11, 'متوفر', 10, 2500, 'شراء', '2003-04-26'),
(15, 11, 'معار', 10, 2500, 'شراء', '2007-04-26'),
(16, 11, 'متوفر', 10, 2500, 'شراء', '2018-04-26'),
(17, 6, 'متوفر', 40, 0, 'تبرع', '2013-04-26'),
(18, 6, 'متوفر', 45, 750, 'تبرع', '2014-04-26'),
(19, 7, 'متوفر', 150, 0, 'تبرع', '2014-04-26'),
(20, 7, 'متوفر', 150, 0, 'تبرع', '2014-04-26'),
(21, 7, 'متوفر', 150, 0, 'تبرع', '2016-04-26'),
(22, 7, 'متوفر', 150, 0, 'تبرع', '2016-04-26'),
(23, 8, 'متوفر', 70, 0, 'تبرع', '2003-04-26'),
(24, 4, 'متوفر', 90, 4500, ' شراء', '2005-04-26'),
(25, 5, 'متوفر', 140, 0, 'تبرع', '2017-04-26');

-- --------------------------------------------------------

--
-- Table structure for table `libreturn`
--

CREATE TABLE `libreturn` (
  `libreturn_id` int(11) NOT NULL,
  `libuser_id` int(11) DEFAULT NULL,
  `copy_id` int(11) DEFAULT NULL,
  `libreturn_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `libreturn`
--

INSERT INTO `libreturn` (`libreturn_id`, `libuser_id`, `copy_id`, `libreturn_date`) VALUES
(1, 4, 13, '2018-04-26 08:38:57'),
(2, 1, 18, '2018-04-26 08:38:58'),
(3, 7, 25, '2018-04-26 08:38:59'),
(4, 7, 9, '2018-04-26 08:39:00'),
(5, 12, 5, '2018-04-26 08:39:01'),
(6, 9, 1, '2018-04-26 08:39:02'),
(7, 9, 2, '2018-04-26 08:39:57'),
(8, 8, 3, '2018-04-26 08:39:58'),
(9, 1, 8, '2018-04-26 08:39:59'),
(10, 1, 4, '2018-04-26 08:40:00'),
(11, 7, 6, '2018-04-26 08:40:01'),
(12, 1, 7, '2018-04-26 08:40:32'),
(13, 1, 5, '2018-04-26 08:40:33'),
(14, 9, 1, '2018-04-26 08:40:34'),
(15, 1, 5, '2018-04-26 09:03:48'),
(16, 11, 19, '2018-04-27 14:52:52'),
(17, 1, 1, '2018-04-27 14:54:58');

-- --------------------------------------------------------

--
-- Table structure for table `libuser`
--

CREATE TABLE `libuser` (
  `libuser_id` int(11) NOT NULL,
  `libuser_firstname` varchar(255) NOT NULL,
  `libuser_lastname` varchar(255) NOT NULL,
  `libuser_adress` varchar(255) NOT NULL,
  `libuser_birthdate` date NOT NULL,
  `libuser_birthplace` varchar(255) NOT NULL,
  `libuser_susbcriptiondate` date NOT NULL,
  `libuser_speciality` varchar(255) NOT NULL,
  `libuser_phonenumber` varchar(255) NOT NULL,
  `libuser_email` varchar(255) NOT NULL,
  `libuser_blocked` tinyint(1) NOT NULL DEFAULT '0',
  `libuser_memo` varchar(255) DEFAULT NULL,
  `libuser_reference` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `libuser`
--

INSERT INTO `libuser` (`libuser_id`, `libuser_firstname`, `libuser_lastname`, `libuser_adress`, `libuser_birthdate`, `libuser_birthplace`, `libuser_susbcriptiondate`, `libuser_speciality`, `libuser_phonenumber`, `libuser_email`, `libuser_blocked`, `libuser_memo`, `libuser_reference`) VALUES
(1, 'محمد', 'قنون', 'باطوار', '1994-10-20', 'مغنية', '2010-10-10', 'طالب', '07777777', 'email@gmail.com', 0, '', '7cc20ccee08943'),
(2, 'عمر', 'داود', 'فلاوسن', '1996-08-23', 'تلمسان', '2018-04-25', 'طالب', '0123456', 'sniperfromdz@gmail.com', 0, NULL, '46973751cbf89fc2'),
(3, 'مجاهدي', 'محمد هشام', '14 حي المصلى أوزيدان تلمسان', '1989-07-12', 'تلمسان', '2018-04-26', 'طالب', '05555555', 'e@e.cm', 0, NULL, '207dffa2857196a2'),
(4, 'قيطون', 'نعيمة', 'رقم 13 حي الكدية تلمسان', '1988-07-12', 'تيرني', '2018-04-26', 'طالب', '05555555', 'e@e.cm', 0, NULL, '3f68fc61f375a3f9'),
(5, 'محمّد', 'بلعربي', 'ص ب رقم 06 برج عريمة الرمشي تلمسان', '1965-12-18', 'بني وارسوس', '2018-04-26', 'عامل', '05555555', 'e@e.cm', 0, NULL, '4866b8b2db715cb5'),
(6, 'عبد الصّمد', 'داودي', 'تجمع 75 رقم 12 خريبة ندرومة', '1990-03-18', 'ندرومة', '2018-04-26', 'تلميد', '1236548', 'e@e.cm', 0, NULL, 'a43dcdfed810f856'),
(7, 'عبد القادر', 'ميلودي', 'حي الصداقة بلدية تاغزوت عين تالوت', '1971-05-18', 'عين تالوت', '2018-04-26', 'عامل', '1236548', 'e@e.cm', 0, NULL, '58d8e94fde5e0fb6'),
(8, 'ماحي', 'قندوز', 'شارع 68 منزل 20 ندرومة', '1987-02-11', 'سواحلية', '2018-04-26', 'تلميد', '1236548', 'e@e.cm', 0, NULL, '940da1e31ff4b988'),
(9, 'بخيتي', 'عيسى', 'شارع 68 منزل 20 ندرومةحي 320 مسكن تعاونية النسيم رقم 01 عين تومشنت', '1972-03-27', 'عين تومشنت', '2018-04-26', 'طالب', '1236548', 'e@e.cm', 0, NULL, '132031549e41d87d'),
(10, 'هشام', 'عبد الرحيم', 'طريق سيدي بلعباس أولاد ميمون', '1998-07-17', 'تلمسان', '2018-04-26', 'تلميد', '1236548', '', 0, NULL, '47f0c0cd3ea7ae80'),
(11, 'سعيد', 'بوعالية', '108 حي 195 سكن سبعة شيوخ تلمسان', '1984-06-20', 'تلمسان', '2018-04-26', 'عامل', '05555555', '', 0, NULL, 'dcb6705bdfd846dc'),
(12, 'فتحي', 'رياحي', 'فلاوسن', '1970-02-12', 'تلمسان', '2018-04-26', 'طالب', '1236548', 'e@e.cm', 0, NULL, 'd715210705fa9b11');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` int(11) NOT NULL,
  `libuser_id` int(11) DEFAULT NULL,
  `copy_id` int(11) DEFAULT NULL,
  `reservation_date` datetime NOT NULL,
  `reservation_returndate` datetime NOT NULL,
  `reservation_done` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservation_id`, `libuser_id`, `copy_id`, `reservation_date`, `reservation_returndate`, `reservation_done`) VALUES
(2, 1, 10, '2018-04-26 09:18:25', '2018-04-28 09:18:25', 0),
(3, 1, 13, '2018-04-26 09:18:30', '2018-04-28 09:18:30', 1),
(4, 9, 3, '2018-04-27 15:16:11', '2018-04-29 15:16:11', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `account_name` (`account_name`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`article_id`);

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`borrow_id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`config_id`);

--
-- Indexes for table `copy`
--
ALTER TABLE `copy`
  ADD PRIMARY KEY (`copy_id`);

--
-- Indexes for table `libreturn`
--
ALTER TABLE `libreturn`
  ADD PRIMARY KEY (`libreturn_id`);

--
-- Indexes for table `libuser`
--
ALTER TABLE `libuser`
  ADD PRIMARY KEY (`libuser_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `borrow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;
--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `config_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `copy`
--
ALTER TABLE `copy`
  MODIFY `copy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `libreturn`
--
ALTER TABLE `libreturn`
  MODIFY `libreturn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `libuser`
--
ALTER TABLE `libuser`
  MODIFY `libuser_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `inscription` ON SCHEDULE EVERY 1 DAY STARTS '2018-04-23 13:53:01' ON COMPLETION PRESERVE ENABLE DO update libuser set 
        libuser_blocked = true
        where (
          select config_insc
            from config
            where DATE_FORMAT(CURRENT_DATE,'%m-%d') = DATE_FORMAT(config_insc,'%m-%d'))$$

CREATE DEFINER=`root`@`localhost` EVENT `reservation` ON SCHEDULE EVERY '0 23' DAY_HOUR STARTS '2018-04-23 23:00:00' ON COMPLETION PRESERVE ENABLE DO update copy,reservation set 
        copy_state = 'متوفر',
        reservation_done = true
        where copy.copy_id in(
          select copy.copy_id 
            from (select * from copy) as copy,(SELECT * from reservation) as reservation
            where reservation.copy_id = copy.copy_id
            and CURRENT_TIMESTAMP > reservation.reservation_returndate
            and copy_state = 'محجز'
            and reservation_done = false
        )$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
