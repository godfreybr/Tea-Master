-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.3.22-MariaDB-0+deb10u1 - Debian 10
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table lcars_teamaster.tea_pages
CREATE TABLE IF NOT EXISTS `tea_pages` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `title_full` varchar(50) NOT NULL,
  `content` text DEFAULT NULL,
  `hidden` tinyint(1) NOT NULL DEFAULT 0,
  `link_only` tinyint(1) NOT NULL DEFAULT 0,
  `admin_only` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Short Name` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COMMENT='This table contains all standard pages on the store. These can be hidden or admin only.';

-- Dumping data for table lcars_teamaster.tea_pages: ~7 rows (approximately)
/*!40000 ALTER TABLE `tea_pages` DISABLE KEYS */;
REPLACE INTO `tea_pages` (`id`, `title`, `title_full`, `content`, `hidden`, `link_only`, `admin_only`) VALUES
	(1, 'home', 'Home', '<h2>News</h2>\r\n<p><b>28-10-2014:</b> Brand new teapots, teacups, tea leaves and the new black market.</p>\r\n<p><b>17-10-2014:</b> New teapots added.</p>', 0, 0, 0),
	(2, 'about', 'About', '<p>Tea Masters is a new startup department inside the LCARS Systems corporation. We have come together to build our vision for an online game. We want to build a fun and engaging social Tea game. We also want to create a micro-transaction market which will profit the company as well as benefit the users experience. Our parent company prides itself on a quality experience and we will embrace this ethic.</p>\r\n<p>Our major product is a game named Tea Master. In Tea Master, users get to play the role of a maid or butler and serve a master. Each master comes with their own personality, tastes and personal preferences. The player must learn the personality of the master and take care of them. Players do this by serving them appropriate tea &amp; snacks for the masters mood at any given time. Players must farm and collect ingredients to make the teas &amp; snacks. However should the players wish it they can also purchase ingredients directly from our eStore.</p>', 0, 0, 0),
	(3, 'store', 'Store', '<h2>Welcome to the store.</h2>', 0, 1, 0),
	(4, 'game', 'Game', '<p>The Tea Master game is not complete yet, but you can buy all your items before hand!</p>\r\n<img src="uploads/tea_master_game_cover.png" width="750" height="525" alt="Tea Master Game" />', 0, 0, 0),
	(5, 'login', 'Login', NULL, 1, 1, 0),
	(6, 'register', 'Register', NULL, 1, 1, 0),
	(7, 'divination', 'Tea Divination', '<style type="text/css">\r\np {line-height: 2em;}\r\n</style>\r\n<h1>Reading the Tea Leaves or Coffee Grounds</h1>\r\n<p>Reading tea leaves or coffee grounds has traditionally been practiced in many countries by the women in the family, typically at gatherings of family and friends. Tea leaf reading is also referred to as tasseomancy, tasseography or teomancy. Coffee reading is known as cafeomancy. But this sort of divination has long been practised wherever there is a liquid that leaves behind some sort of dregs, whether it be tea leaves or coffee grounds. In ancient times, they would read the wine lees left in the glass.</p>\r\n<h2>Method</h2>\r\n<p>First of all sit, down and enjoy your cup of tea. Remembering of course, that you need to make your tea the old-fashioned way using a teapot, so that you end up with a fair few tea leaves! You need a teacup with a wide mouth, sloping side of cups, and a plain, undecorated surface inside of cup. Do not strain the tea as you pour it. Many people believe you cannot read your own cup, however that is a personal preference. As with any form of divination, it is always difficult to read your own fortune objectively.</p>\r\n<p>If you prefer coffee, simply brew your favourite variety of coffee and add a pinch or two of dry coffee grounds to the coffee so that there will be enough grounds to read. If you add the grounds before drinking, then let the cup sit for a few minutes so that the grounds sink to the bottom. Otherwise add the grounds to the remaining coffee dregs after you have drunk your cup of coffee. You will find that different varieties of coffee, such as Turkish or Greek coffee, are more suitable for coffee reading.</p>\r\n<p>Part of the ritual of this form of divination is to sit down and enjoy the tea and the company of your fellow drinkers before you get started. This is not as frivolous as it sounds as it allows you to relax and also gather your thoughts.</p>\r\n<p>Before you even start the reading , there may already be some early signs to interpret:</p>\r\n<ul>\r\n	<li>Bubbles on the surface of your tea or coffee means that money is on its way.</li>\r\n	<li>If any tea leaves are floating on the surface, then visitors are imminent. The number of leaves shows how many days away they are.</li>\r\n	<li>If two teaspoons are accidently placed on a saucer, then you can expect news of twins soon.</li>\r\n	<li>If a teaspoon is placed upside down onto a saucer then you will hear news of the ill-health of a close relative.</li>\r\n</ul>\r\n<p>Finish your tea leaving a small amount of liquid in the bottom of cup of the cup. Holding the cup in your left hand, swirl the tea leaves round three times in a clockwise direction. Make sure that the remaining tea swirls around the whole of the cup.</p>\r\n<p>Then, upend the cup on the saucer and let the liquid drain away.</p>\r\n<p>Coffee drinkers can use the same method with the remains of their coffee, or they can pour the remains across a plate and interpret the patterns that are left on the plate.</p>\r\n<p><i>Variations with Coffee Reading:</i> In Romania the coffee grounds are swirled so that the most of the inside of the cup is covered. In many Middle East areas, before the start of the reading, the drinker "opens the heart" by by placing the right thumb at the inside bottom of the cup and twisting clockwise slightly. The impression that is left by this small action is then interpreted by the reader as the drinker\'s inner thoughts or emotions.</p>\r\n<p>Now you can examine the cup and the patterns of the tea leaves inside.</p>\r\n<p>As a general first impression, just a scattering of leaves inside the cup indicates a tidy mind and disciplined life. A lot of leaves indicates a rich, full, busy life.</p>\r\n<h2>Reading the Leaves</h2>\r\n<p>The cup is held so that the handle points towards the questioner. The handle represents the questioner and his or her home, and the tea leaves are read in relation to the position of the handle.</p>\r\n<p>The rim of the Cup represents recent events. Leaves lying closer to the bottom of the Cup indicate events that are more distant in time. The very bottom of the Cup represents misfortunes.</p>\r\n<p>Leaves that lie to the right of the handle indicate the future, and leaves to the left of the handle indicate the past.</p>\r\n<p>The further away the leaves lie from the handle, the further away the events are in either time or even physical distance.</p>\r\n<p>First take a quick look inside the cup to see if there are any signs that jump out at you:</p>\r\n<ul>\r\n	<li>Any distinct drops of tea or coffee that remain in the cup despite the swirling and emptying of the cup, represent tears.</li>\r\n	<li>A very large clump of tea leaves indicates trouble. Near the handle - trouble caused by your own making. Opposite the handle - the trouble is not your fault.</li>\r\n	<li>Tea-stalks indicate people. Long stalks indicate men. Shorter stalks indicate women. Pale or dark stalks indicate colouring. Slanted stalks indicate untrustworthy people.</li>\r\n</ul>\r\n<p>Most tea leaf readers interpret the patterns that the dark tea leaves make against the light background of the cup. However, some also read the images formed in white (seen on the cup itself), with the dark clumps of tea leaves forming the background.</p>\r\n<p>Please note that the symbols and interpretations commonly used with tasseomancy can be very different from those used in dream interpretation.</p>\r\n<h2>Symbols</h2>\r\n<p>The symbols and meanings that follow below can be used as a general guide when doing your readings. However, you may find that certain symbols have a particular meaning for you alone and vary from the meanings given below. Feel free to follow your own instincts when doing readings. Basically, the rule of thumb is, if it works well, then stick with it.</p>\r\n<h3>A</h3>\r\n<ul>\r\n	<li><b>Abbey:</b> Freedom from worry.</li>\r\n	<li><b>Ace of Clubs:</b> A letter.</li>\r\n	<li><b>Ace of Diamonds:</b> A present.</li>\r\n	<li><b>Ace of Hearts:</b> Happiness.</li>\r\n	<li><b>Ace of Spades:</b> A large building.</li>\r\n	<li><b>Acorn:</b> Success At top of cup - Financial success. Middle of cup - Good health. Near bottom of cup - Improvement in health or finances.</li>\r\n	<li><b>Aircraft:</b> Sudden journey, not without risk. Possible diappointment. If broken indicates an accident.</li>\r\n	<li><b>Alligator:</b> Treachery, an accident.</li>\r\n	<li><b>Anchor:</b> Top of cup - success in business and romance. Middle of cup - prosperous voyage. Near bottom of cup - social success. Obsured - anticipate difficulties.</li>\r\n	<li><b>Angel:</b> Good news.</li>\r\n	<li><b>Ankle:</b> Instability.</li>\r\n	<li><b>Ant:</b> Success through perseverance.</li>\r\n	<li><b>Anvil:</b> Conscientious effort.</li>\r\n	<li><b>Apple:</b> Business achievement.</li>\r\n	<li><b>Arc:</b> Ill health, accidents.</li>\r\n	<li><b>Arch:</b> Journey abroad, a wedding.</li>\r\n	<li><b>Arrow:</b> Bad news.</li>\r\n	<li><b>Axe:</b> Difficulites and troubles that will be overcome.</li>\r\n</ul>\r\n<h3>B</h3>\r\n<ul>\r\n	<li><b>Baby:</b> A series of small worries.</li>\r\n	<li><b>Bag:</b> A trap ahead. If open - you can escape; if closed - you will be trapped.</li>\r\n	<li><b>Bagpipes:</b> Disappointment.</li>\r\n	<li><b>Ball:</b> A person connected with sport, or variable fortunes in your life.</li>\r\n	<li><b>Balloon:</b> Short-term troubles.</li>\r\n	<li><b>Barrel:</b> A party.</li>\r\n	<li><b>Basin:</b> Trouble at home. If broken - serious trouble.</li>\r\n	<li><b>Basket:</b> If empty - money worries. If full - a present. If near the handle of cup - a baby. If near the top of cup - possessions. If full of flowers - social success. Surrounded by dots - unexpected money coming your way.</li>\r\n	<li><b>Bat:</b> False friends, a journey ending in disappointment.</li>\r\n	<li><b>Bath:</b> Disappointment.</li>\r\n	<li><b>Bayonet:</b> A minor accident, a spiteful remark.</li>\r\n	<li><b>Beans:</b> Poverty.</li>\r\n	<li><b>Bear:</b> Facing handle of cup - irrational decisions cause difficulties. Facing away from handle of cup - a journey.</li>\r\n	<li><b>Bed:</b> Inertia.</li>\r\n	<li><b>Bee:</b> Social success, good news. Near handle of cup - friends gathering. Swarm of bees - success with an audience.</li>\r\n	<li><b>Beehive:</b> Prosperity.</li>\r\n	<li><b>Beetle:</b> Scandal, a difficult undertaking.</li>\r\n	<li><b>Bell:</b> Unexpected news. Near top of cup - promotion. Near bottom of cup - sad news. Two bells - joy. Several bells - a wedding.</li>\r\n	<li><b>Bellows:</b> Plans will meet with setbacks.</li>\r\n	<li><b>Bird:</b> Good news.</li>\r\n	<li><b>Birdcage:</b> Obstacles, quarrels.</li>\r\n	<li><b>Bird\'s nest:</b> Domestic harmoney, love.</li>\r\n	<li><b>Bishop:</b> Good luck coming.</li>\r\n	<li><b>Boat:</b> Visit from a friend, a safe refuge.</li>\r\n	<li><b>Book:</b> Open - expect legal actions, future success. Closed - delays, difficult studies.</li>\r\n	<li><b>Boomerang:</b> Treachery, envy.</li>\r\n	<li><b>Boot:</b> Achievement, protection from pain. Pointing away from handle of cup - dismissal. Broken - failure.</li>\r\n	<li><b>Bottle:</b> One bottle - pleasure. Several bottles - illness.</li>\r\n	<li><b>Bouquet:</b> Love and happiness.</li>\r\n	<li><b>Bow (Bow and Arrow):</b> Scandal, gossip.</li>\r\n	<li><b>Box:</b> Open - romantic troubles solved. Closed - the lost will be found.</li>\r\n	<li><b>Bracelet:</b> Impending marriage.</li>\r\n	<li><b>Branch:</b> With leaves -  a birth. Without leaves - a disappointment.</li>\r\n	<li><b>Bread:</b> Avoid waste.</li>\r\n	<li><b>Bridge:</b> An opportunity for success.</li>\r\n	<li><b>Broom:</b> small worries disappear, a false friend.</li>\r\n	<li><b>Buckle:</b> Disappointments ahead.</li>\r\n	<li><b>Bugle:</b> Hard work necessary.</li>\r\n	<li><b>Building:</b> A move.</li>\r\n	<li><b>Bull:</b> Quarrels, enmity.</li>\r\n	<li><b>Buoy:</b> Keep hoping.</li>\r\n	<li><b>Bush:</b> New friends, fresh opportunities.</li>\r\n	<li><b>Butterfly:</b> Frivolity, fickleness. Surrounded by dots - frittering away money.</li>\r\n</ul>\r\n<h3>C</h3>\r\n<ul>\r\n	<li><b>Cab:</b> A disappointment.</li>\r\n	<li><b>Cabbage:</b> Jealousy causes complications at work.</li>\r\n	<li><b>Cage:</b> A proposal.</li>\r\n	<li><b>Camel:</b> Useful news.</li>\r\n	<li><b>Candle:</b> Help form others, pursuit of knowledge.</li>\r\n	<li><b>Cannon:</b> News of a soldier or a government employee.</li>\r\n	<li><b>Cap:</b> Trouble ahead - be careful.</li>\r\n	<li><b>Car:</b> Good fortune.</li>\r\n	<li><b>Cart:</b> Success in business.</li>\r\n	<li><b>Castle:</b> Financial gain through marriage, a strong character rising to prominence.</li>\r\n	<li><b>Cat:</b> A quarrel, treachery, a false friend.</li>\r\n	<li><b>Cattle:</b> Prosperity.</li>\r\n	<li><b>Chain:</b> An engagement or wedding.</li>\r\n	<li><b>Chair:</b> An unexpected guest. Surrounded by dots - financial improvements.</li>\r\n	<li><b>Cherries:</b> A happy love affair.</li>\r\n	<li><b>Chessmen:</b> Difficulties ahead.</li>\r\n	<li><b>Chimney:</b> Hidden risks.</li>\r\n	<li><b>Church:</b> Ceremony, unexpected money.</li>\r\n	<li><b>Cigar:</b> New friends.</li>\r\n	<li><b>Circle:</b> Success, a wedding. With a dot - a baby. With small lines nearby - efforts hampered.</li>\r\n	<li><b>Claw:</b> A hidden enemy.</li>\r\n	<li><b>Clock:</b> Avoid delay, think of the future, a recovery from illness.</li>\r\n	<li><b>Clouds:</b> Trouble ahead. Surrounded by dots - money trouble ahead.</li>\r\n	<li><b>Clover:</b> Prosperity.</li>\r\n	<li><b>Coat:</b> A parting, an end of a friendship.</li>\r\n	<li><b>Cockatoo:</b> Trouble among friends.</li>\r\n	<li><b>Coffeepot:</b> Slight illness.</li>\r\n	<li><b>Coffin:</b> Bad news.</li>\r\n	<li><b>Coin:</b> Repayment of debts.</li>\r\n	<li><b>Collar:</b> Dependence on others for success and happiness.</li>\r\n	<li><b>Column:</b> Promotion, success, arrogance.</li>\r\n	<li><b>Comb:</b> Deceit, a false friend.</li>\r\n	<li><b>Comet:</b> An unexpected visitor.</li>\r\n	<li><b>Compass:</b> Travel, a change of job.</li>\r\n	<li><b>Corkscrew:</b> Curiosity causing trouble.</li>\r\n	<li><b>Crab:</b> An enemy.</li>\r\n	<li><b>Crescent:</b> A journey.</li>\r\n	<li><b>Cross:</b> Sacrifice, trouble, ill health. Within  a square - trouble averted. Two crosses - long life. Three crosses - great achievement.</li>\r\n	<li><b>Crown:</b> Honour, success, a wish coming true, a legacy.</li>\r\n	<li><b>Crutches:</b> Help from a friend.</li>\r\n	<li><b>Cup:</b> Reward for effort.</li>\r\n	<li><b>Curtain:</b> A secret.</li>\r\n	<li><b>Cymbal:</b> Insincere love.</li>\r\n</ul>\r\n<h3>D</h3>\r\n<ul>\r\n	<li><b>Daffodil:</b> Great happiness.</li>\r\n	<li><b>Dagger:</b> Impetuousness, danger ahead, enemies.</li>\r\n	<li><b>Daisy:</b> Happiness in love.</li>\r\n	<li><b>Dancer:</b> Disappointment.</li>\r\n	<li><b>Deer:</b> A dispute or quarrel.</li>\r\n	<li><b>Desk:</b> Letter containing good news.</li>\r\n	<li><b>Devil:</b> Evil influences.</li>\r\n	<li><b>Dish:</b> Quarrel at home.</li>\r\n	<li><b>Dog:</b> Good friends. If running - good news, happy meetings. At bottom of cup - friend in trouble.</li>\r\n	<li><b>Donkey:</b> Be patient and optimstic.</li>\r\n	<li><b>Door:</b> Strange occurrence.</li>\r\n	<li><b>Dot:</b> This symbolises the importance of the nearest symbol. Several dots - money.</li>\r\n	<li><b>Dove:</b> Good fortune.</li>\r\n	<li><b>Dragon:</b> Unforesen changes, trouble.</li>\r\n	<li><b>Drum:</b> Scandal, gossip, a new job, arguments.</li>\r\n	<li><b>Duck:</b> Money coming in.</li>\r\n	<li><b>Dustpan:</b> Strange news about a friend.</li>\r\n</ul>\r\n<h3>E</h3>\r\n<ul>\r\n	<li><b>Eagle:</b> A change for the better.</li>\r\n	<li><b>Ear:</b> Unexpected news.</li>\r\n	<li><b>Earrings:</b> Misunderstanding.</li>\r\n	<li><b>Easel:</b> Artistic success.</li>\r\n	<li><b>Egg:</b> Prosperity, success - the more eggs the better.</li>\r\n	<li><b>Eggcup:</b> Danger is passing.</li>\r\n	<li><b>Elephant:</b> Wisdom, strength, lasting success, a trustworthy friend.</li>\r\n	<li><b>Engine:</b> News on its way fast.</li>\r\n	<li><b>Envelope:</b> Good news.</li>\r\n	<li><b>Eye:</b> Overcoming difficulties, take care.</li>\r\n</ul>\r\n<h3>F</h3>\r\n<ul>\r\n	<li><b>Face:</b> One face - a change, setback. Several faces - a party.</li>\r\n	<li><b>Fairy:</b> Joy and enchantment.</li>\r\n	<li><b>Fan:</b> Flirtation, indiscretion.</li>\r\n	<li><b>Feather:</b> Instability, inconsistency, lack of concentration.</li>\r\n	<li><b>Feet:</b> An important decision.</li>\r\n	<li><b>Fence:</b> Limitation to activities, minor setbacks, future success.</li>\r\n	<li><b>Fender:</b> Beware of a person you dislike.</li>\r\n	<li><b>Fern:</b> Disloyalty, an unfaithful lover.</li>\r\n	<li><b>Finger:</b> Emphasises the symbol to which it points.</li>\r\n	<li><b>Fir:</b> Artistic succes. The higher the tree, the better.</li>\r\n	<li><b>Fire:</b> Achievement, avoid hasty over-reactions.</li>\r\n	<li><b>Fireplace:</b> Matters related to your home.</li>\r\n	<li><b>Fish:</b> Good fortune in all things, health, wealth and happiness.</li>\r\n	<li><b>Fist:</b> An argument.</li>\r\n	<li><b>Flag:</b> Danger ahead.</li>\r\n	<li><b>Flower:</b> Wish coming true.</li>\r\n	<li><b>Fly:</b> Domestic irritations. The more flies, the more petty problems.</li>\r\n	<li><b>Font:</b> A birth.</li>\r\n	<li><b>Fork:</b> A false friend, flattery.</li>\r\n	<li><b>Forked Line:</b> Decisions to be made.</li>\r\n	<li><b>Fountain:</b> Future success and happiness.</li>\r\n	<li><b>Fox:</b> A deceitful friend.</li>\r\n	<li><b>Frog:</b> Success through a change of home or job, avoid self-importance.</li>\r\n	<li><b>Fruit:</b> Prosperity.</li>\r\n</ul>\r\n<h3>G</h3>\r\n<ul>\r\n	<li><b>Gallows:</b> Social failure, enemies confounded.</li>\r\n	<li><b>Garden roller:</b> Difficulties ahead.</li>\r\n	<li><b>Garland:</b> Success, great honour.</li>\r\n	<li><b>Gate:</b> Opportunity, future happiness.</li>\r\n	<li><b>Geese:</b> Invitations, unexpected visitors.</li>\r\n	<li><b>Giraffe:</b> Think before you speak.</li>\r\n	<li><b>Glass:</b> Integrity.</li>\r\n	<li><b>Glove:</b> A challenge.</li>\r\n	<li><b>Goat:</b> Enemies threaten, news about a sailor.</li>\r\n	<li><b>Gondola:</b> Romance, travel.</li>\r\n	<li><b>Gramophone:</b> Pleasure.</li>\r\n	<li><b>Grapes:</b> Happiness.</li>\r\n	<li><b>Grasshopper:</b> News of a much travelled friend.</li>\r\n	<li><b>Greyhound:</b> Good fortune.</li>\r\n	<li><b>Guitar:</b> Happiness in love.</li>\r\n	<li><b>Gun:</b> Trouble, quarrels.</li>\r\n</ul>\r\n<h3>H</h3>\r\n<ul>\r\n	<li><b>Hammer:</b> Overcoming obstacles, ruthlessness, work that is uncongenial.</li>\r\n	<li><b>Hand:</b> Friendship.</li>\r\n	<li><b>Handcuffs:</b> Trouble ahead.</li>\r\n	<li><b>Hare:</b> Timidity, news of a friend.</li>\r\n	<li><b>Harp:</b> Harmony in love.</li>\r\n	<li><b>Hat:</b> A new occupation, a change. Bent and broken - failure likely. In bottom of cup - a rival. At side of cup - diplomacy.</li>\r\n	<li><b>Hawk:</b> Sudden danger, jealousy.</li>\r\n	<li><b>Hayrick:</b> Think before you act.</li>\r\n	<li><b>Head:</b> New opportunities.</li>\r\n	<li><b>Heart:</b> Love and marriage, a trustworthy friend.</li>\r\n	<li><b>Heather:</b> Good fortune.</li>\r\n	<li><b>Hen:</b> Domestic bliss.</li>\r\n	<li><b>Hill:</b> Obstacles, setbacks.</li>\r\n	<li><b>Hoe:</b> Hard work leading to success.</li>\r\n	<li><b>Holly:</b> An importance occurrence in the winter.</li>\r\n	<li><b>Horn:</b> Abundance.</li>\r\n	<li><b>Horse:</b> Galloping - good news from a lover. Head only - romance.</li>\r\n	<li><b>Horseshoe:</b> Good luck.</li>\r\n	<li><b>Hourglass:</b> A decision that must be made.</li>\r\n	<li><b>House:</b> Security.</li>\r\n</ul>\r\n<h3>I</h3>\r\n<ul>\r\n	<li><b>Iceberg:</b> Danger.</li>\r\n	<li><b>Initials:</b> Usually those of people known to you. If next to a triangle, the initials of strangers.</li>\r\n	<li><b>Inkpot:</b> A letter.</li>\r\n	<li><b>Insect:</b> Minor problems soon overcome.</li>\r\n	<li><b>Ivy leaf:</b> Reliable friend.</li>\r\n</ul>\r\n<h2>References</h2>\r\n<p>All formatting is original, all content belongs to:</p>\r\n<p>Powers, S. (2014). <em>Serena\'s Guide to Divination and Fortune Telling using Tea Leaves, Coffee Grounds, Wine Lees. Tasseography. Tasseomancy. Cafeomancy.</em>. [online] Serenapowers.com. Available at: http://www.serenapowers.com/tealeaves.html [Accessed 6 Oct. 2014].</p>', 1, 0, 0);
/*!40000 ALTER TABLE `tea_pages` ENABLE KEYS */;

-- Dumping structure for table lcars_teamaster.tea_sessions
CREATE TABLE IF NOT EXISTS `tea_sessions` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `session_key` varchar(255) NOT NULL,
  `user_id` int(3) NOT NULL,
  `expiry` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `session_key` (`session_key`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='This table contains the user session keys.';

-- Dumping data for table lcars_teamaster.tea_sessions: ~0 rows (approximately)
/*!40000 ALTER TABLE `tea_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `tea_sessions` ENABLE KEYS */;

-- Dumping structure for table lcars_teamaster.tea_shopping_carts
CREATE TABLE IF NOT EXISTS `tea_shopping_carts` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `cart_owner` int(3) NOT NULL,
  `item` int(3) NOT NULL,
  `amount` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Item & Owner` (`cart_owner`,`item`),
  KEY `cart_item` (`item`),
  CONSTRAINT `cart_item` FOREIGN KEY (`item`) REFERENCES `tea_store_item` (`id`),
  CONSTRAINT `cart_owner` FOREIGN KEY (`cart_owner`) REFERENCES `tea_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table lcars_teamaster.tea_shopping_carts: ~0 rows (approximately)
/*!40000 ALTER TABLE `tea_shopping_carts` DISABLE KEYS */;
/*!40000 ALTER TABLE `tea_shopping_carts` ENABLE KEYS */;

-- Dumping structure for table lcars_teamaster.tea_store_categories
CREATE TABLE IF NOT EXISTS `tea_store_categories` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `subcategory` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `display_name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Short Name` (`name`),
  KEY `Sub Category` (`subcategory`),
  CONSTRAINT `SubCategory` FOREIGN KEY (`subcategory`) REFERENCES `tea_store_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1 COMMENT='This table contains the categories that items can exist in. Each category can have child or parent objects.';

-- Dumping data for table lcars_teamaster.tea_store_categories: ~24 rows (approximately)
/*!40000 ALTER TABLE `tea_store_categories` DISABLE KEYS */;
REPLACE INTO `tea_store_categories` (`id`, `subcategory`, `name`, `display_name`, `description`) VALUES
	(1, NULL, 'tea_leaves', 'Tea Leaves', NULL),
	(2, NULL, 'tea_pots', 'Tea Pots', NULL),
	(3, 2, 'cast_iron_pots', 'Cast Iron Teapots', ' Cast iron does an excellent job of distributing the heat evenly throughout the teapot, so it extracts the most flavor and nutrients from the tea leaves. And cast iron pots look beautiful as you serve tea or as they sit on your counter.'),
	(4, 2, 'ceramic_pots', 'Ceramic Teapots', 'Ceramic allows for more color and detail than some of the other options, so ceramic teapots are exceptionally pretty. Because of this, they can easily go from decoration to functional teapot.'),
	(5, 1, 'green_leaves', 'Green Tea Leaves', 'Straight green teas have a clean, delicious taste you will enjoy. When paired with other fruits or spices, the flavor excites your tastebuds and provides an enjoyable treat.'),
	(6, 1, 'white_leaves', 'White Tea Leaves', 'White teas are appreciated by tea connoisseurs for their unmatched subtlety, complexity, natural sweetness, and delicacy. Least processed (steamed and dried) of all tea types.'),
	(7, NULL, 'milks', 'Milks', NULL),
	(8, NULL, 'sugars', 'Sugars', NULL),
	(9, NULL, 'cups', 'Cups', NULL),
	(10, 2, 'yixing_pots', 'Yixing Teapots', 'Yixing pots are made from a clay in the Jiangsu province of China that absorbs the flavors of your favorite tea. Because of this, they should only be used on one type of tea.'),
	(11, 2, 'glass_pots', 'Glass Teapots', 'Glass teapots allow you to see the tea as it steeps; some tea leaves unfurl or pop and some artisan teas even bloom. It makes for a unique experience in enjoying tea. However, glass teapots won\'t hold heat as well, so a teapot warmer is recommended.'),
	(12, 1, 'black_leaves', 'Black Tea Leaves', 'Delicious black teas are loved in the West. Full-bodied and strong, they taste great alone or with milk and sugar. And they make great iced tea.'),
	(13, 1, 'oolong_leaves', 'Oolong Tea Leaves', 'Oolong (also Wulong) teas are crafted by an artisan who knows exactly how much to process (dry) the teas before they are perfect.'),
	(14, 1, 'chai_leaves', 'Chai Tea Leaves', 'Chai spice is generally a combination of cinnamon, cardamom, ginger, cloves and vanilla, among other spices. Of course, we played with the blend and created a selection of very distinct chai teas for you; each one delicious in its own way.'),
	(15, 1, 'herbal_leaves', 'Herbal Tea Leaves', 'Our delicious herbal teas are made only from the best ingredients. From the sweet to the spicy, Teavana\'s herbal tea selection has something for everyone. And these teas are made from ingredients so fresh that you can actually eat them!'),
	(16, 1, 'rooibos_leaves', 'Rooibos Tea Leaves', 'Rooibos teas are herbal infusions made from a South African red bush and sometimes called "red tea." There are also green Rooibos teas that are just as delicious as the popular red teas. Rooibos teas are delicious iced or hot and come in a wide variety of'),
	(17, 9, 'cast_iron_cups', 'Cast Iron Cups', 'Cast Iron Cups are hand-crafted by specialty artisans in Japan.'),
	(18, 9, 'glass_cups', 'Glass Cups', 'Looking for that perfect tea cup? Teavana glass tea mugs and cups are unique and functional:'),
	(19, 9, 'ceramic_cups', 'Ceramic Cups', 'Looking for that perfect tea cup? From glass to ceramic to cast iron, our tea mugs and cups are unique and functional. Choose a mug that symbolizes your dreams or one that puts your personality on display. From whimsical to artsy to modern, shop now for t'),
	(20, 9, 'infuser_cups', 'Infuser Cups', 'Make tea right in your cup with our Infuser Tea Mugs.'),
	(21, 22, 'cakes', 'Cakes', NULL),
	(22, NULL, 'snacks', 'Snacks', NULL),
	(23, 22, 'biscuits', 'Biscuits', NULL),
	(24, NULL, 'black_market', 'Black Market', 'These are black market items who\'s legality is questionable.');
/*!40000 ALTER TABLE `tea_store_categories` ENABLE KEYS */;

-- Dumping structure for table lcars_teamaster.tea_store_item
CREATE TABLE IF NOT EXISTS `tea_store_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `display_name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `description_short` tinytext NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount` int(2) NOT NULL DEFAULT 0,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `stock` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Short Name` (`name`),
  KEY `Category` (`category`),
  CONSTRAINT `Category` FOREIGN KEY (`category`) REFERENCES `tea_store_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COMMENT='This table contains all the items that can be purchased from the store.';

-- Dumping data for table lcars_teamaster.tea_store_item: ~13 rows (approximately)
/*!40000 ALTER TABLE `tea_store_item` DISABLE KEYS */;
REPLACE INTO `tea_store_item` (`id`, `category`, `name`, `display_name`, `description`, `description_short`, `price`, `discount`, `date_added`, `stock`) VALUES
	(1, 4, 'red_rosa', 'Red Rosa', 'The Red Rosa is a special teapot.', 'Turkey Tea', 100.00, 0, '2014-09-30 10:10:38', 1),
	(3, 4, 'tall_pot', 'Tall Pot', 'The tall pot is useful for compact yet large capacities', 'A tall pot', 1.55, 0, '2014-10-13 05:29:20', 999),
	(4, 19, 'megane_cup', 'Megane Tea Cup', 'The glasses teacup or "Megane" in the original Japanese, is a happy cup with sunglasses.', 'A cup with glasses', 2.00, 0, '2014-10-23 12:24:38', 999),
	(5, 19, 'sleeper_cup', 'Sleeper Cup', 'The sleeping cup enhances ones ability to sleep through soothing tea.', 'A cup for sleeping', 5.00, 0, '2014-10-26 09:19:58', 1000),
	(6, 4, 'giraffe_pot', 'Giraffe Pot', 'The Giraffe teapot is based upon a giraffe.', 'A Giraffe shaped Teapot', 3.55, 0, '2014-10-27 09:36:22', 1000),
	(7, 4, 'binary_pot', 'Binary Pot', 'The binary teapot has a hidden message that was engraved on the front by the original owner. The meaning of the message itself however has since been lost.', 'The Binary Teapot', 6.50, 0, '2014-10-28 19:03:40', 1000),
	(8, 5, 'green_leaves', 'Green Leaves', 'Some generic Green Tea Leaves', 'Green Tea Leaves', 0.50, 0, '2014-10-28 19:09:19', 999),
	(9, 12, 'gray_leaves', 'Gray Leaves', 'Some generic gray tea leaves.', 'Gray Tea Leaves', 0.50, 0, '2014-10-28 19:09:45', 1000),
	(10, 24, 'vodka_leaves', 'Vodka Leaves', 'These are alcoholic vodka leaves and they are highly illegal.', 'Alcoholic Vodka Tea Leaves', 4.00, 0, '2014-10-28 20:11:44', 999),
	(11, 24, 'scotch_leaves', 'Scotch Leaves', 'These are alcoholic scotch leaves and are highly illegal.', 'Alcoholic Scotch Leaves', 12.00, 0, '2014-10-28 20:16:22', 1000),
	(12, 24, 'love_leaves', 'Love Leaves', 'These love inducing tea leaves are rare and highly sough after. They are also highly illegal for their personality affecting abilities.', 'Love inducing tea leaves', 45.00, 0, '2014-10-28 20:20:07', 997),
	(13, 19, 'divination_cup', 'Divination Cup', 'This is a divination cup which predicts the journey to IKEA through meatball divination.', 'IKEA Divination Cup', 7.00, 0, '2014-10-29 22:37:11', 997),
	(14, 17, 'polecup', 'Iron Pole Cup', 'For those who are dumbfounded by extraneous blocks of text, the iron pole cup is best suited for the job.\r\n\r\nAble to bring your concentration and worries to a dead stop.', 'The Iron Pole Cup for the distracted', 1.95, 0, '2015-03-31 16:55:25', 22);
/*!40000 ALTER TABLE `tea_store_item` ENABLE KEYS */;

-- Dumping structure for table lcars_teamaster.tea_users
CREATE TABLE IF NOT EXISTS `tea_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `group` int(2) NOT NULL DEFAULT 5,
  `credits` decimal(10,2) NOT NULL DEFAULT 0.00,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `suburb` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `postcode` varchar(5) NOT NULL,
  `home_phone` varchar(8) NOT NULL,
  `mobile_phone` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Short Name` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `user_group` (`group`),
  CONSTRAINT `user_group` FOREIGN KEY (`group`) REFERENCES `tea_user_groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COMMENT='This table contains all the users for the store.';

-- Dumping data for table lcars_teamaster.tea_users: ~2 rows (approximately)
/*!40000 ALTER TABLE `tea_users` DISABLE KEYS */;
REPLACE INTO `tea_users` (`id`, `username`, `group`, `credits`, `email`, `password`, `first_name`, `last_name`, `address`, `suburb`, `state`, `country`, `postcode`, `home_phone`, `mobile_phone`) VALUES
	(1, 'sysadmin', 1, 276.80, 'admin@example.com', '$2y$10$ic6dxEJEXT4BJQtlDyxxDe/docXF8Cpr6vIg0kiu5UhSKD9pTlB5a', 'System', 'Administrator', '321B Baker Street', 'Miranda', 'Illinious', 'Australia', '61212', '94984894', '4984984984'),
	(2, 'testuser', 5, 300.00, 'user@example.com', '$2y$10$ic6dxEJEXT4BJQtlDyxxDe/docXF8Cpr6vIg0kiu5UhSKD9pTlB5a', 'Test', 'User', '72 Fancy Street', 'Bfg Division', 'North AmaLee', 'Jingo Jungle', '7458', '65416596', '9496419541');
/*!40000 ALTER TABLE `tea_users` ENABLE KEYS */;

-- Dumping structure for table lcars_teamaster.tea_user_groups
CREATE TABLE IF NOT EXISTS `tea_user_groups` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) NOT NULL,
  `is_admin` bit(1) NOT NULL DEFAULT b'0',
  `is_mod` bit(1) NOT NULL DEFAULT b'0',
  `is_manifest` bit(1) NOT NULL DEFAULT b'0',
  `is_support` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Name` (`group_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='This table contains all the groups and their capabilities.';

-- Dumping data for table lcars_teamaster.tea_user_groups: ~5 rows (approximately)
/*!40000 ALTER TABLE `tea_user_groups` DISABLE KEYS */;
REPLACE INTO `tea_user_groups` (`id`, `group_name`, `is_admin`, `is_mod`, `is_manifest`, `is_support`) VALUES
	(1, 'Admin', b'1', b'1', b'1', b'1'),
	(2, 'Moderator', b'0', b'1', b'0', b'0'),
	(3, 'Manifest Manager', b'0', b'0', b'1', b'0'),
	(4, 'Tech Support', b'0', b'0', b'0', b'1'),
	(5, 'User', b'0', b'0', b'0', b'0');
/*!40000 ALTER TABLE `tea_user_groups` ENABLE KEYS */;

-- Dumping structure for table lcars_teamaster.tea_user_inventories
CREATE TABLE IF NOT EXISTS `tea_user_inventories` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `owner` int(4) NOT NULL,
  `item` int(4) NOT NULL,
  `amount` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `owner_item` (`owner`,`item`),
  KEY `item` (`item`),
  CONSTRAINT `item` FOREIGN KEY (`item`) REFERENCES `tea_store_item` (`id`),
  CONSTRAINT `owner` FOREIGN KEY (`owner`) REFERENCES `tea_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table lcars_teamaster.tea_user_inventories: ~0 rows (approximately)
/*!40000 ALTER TABLE `tea_user_inventories` DISABLE KEYS */;
/*!40000 ALTER TABLE `tea_user_inventories` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
