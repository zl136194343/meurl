/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2020-03-08 23:43:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `k` varchar(255) NOT NULL,
  `v` text,
  PRIMARY KEY (`k`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES ('captcha_id', 'a30cdbb466e9349385762477cb2c7df6');
INSERT INTO `config` VALUES ('description', '技术改变生活');
INSERT INTO `config` VALUES ('email', '88888@qq.com');
INSERT INTO `config` VALUES ('host', 'smtp.mxhichina.com');
INSERT INTO `config` VALUES ('invite_rate', '10');
INSERT INTO `config` VALUES ('invite_sw', '1');
INSERT INTO `config` VALUES ('keywords', '聚合支付,微信支付,支付宝,口碑商家,京东支付,京东金融,美团支付,百度支付,百付宝,第三方支付,第四方支付');
INSERT INTO `config` VALUES ('password', '123456');
INSERT INTO `config` VALUES ('port', '465');
INSERT INTO `config` VALUES ('private_key', '6f70322308eb29ae0d85516a14a32d2c');
INSERT INTO `config` VALUES ('qq', '88888');
INSERT INTO `config` VALUES ('sitename', '小微支付');
INSERT INTO `config` VALUES ('title', '微信支付合作伙伴|支付宝合作伙伴|京东钱包合作伙伴');
INSERT INTO `config` VALUES ('username', 'admin@yyhy.me');
INSERT INTO `config` VALUES ('wx_cert_path', '../cert/apiclient_cert.pem');
INSERT INTO `config` VALUES ('wx_key_path', '../cert/apiclient_key.pem');
INSERT INTO `config` VALUES ('wx_rate', '0.38%');

-- ----------------------------
-- Table structure for invite
-- ----------------------------
DROP TABLE IF EXISTS `invite`;
CREATE TABLE `invite` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `s_uid` int(10) NOT NULL,
  `money` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of invite
-- ----------------------------

-- ----------------------------
-- Table structure for ld_errorddh
-- ----------------------------
DROP TABLE IF EXISTS `ld_errorddh`;
CREATE TABLE `ld_errorddh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pay` varchar(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `zhanghao` varchar(20) DEFAULT NULL,
  `cny` varchar(255) DEFAULT NULL,
  `text1` varchar(255) DEFAULT NULL,
  `text2` varchar(255) DEFAULT NULL,
  `text3` varchar(255) DEFAULT NULL,
  `text4` int(8) DEFAULT '0',
  `text5` int(8) DEFAULT '0',
  `paytimm` varchar(255) DEFAULT NULL,
  `appid` varchar(255) DEFAULT NULL,
  `timm` varchar(255) DEFAULT NULL,
  `timmt` varchar(255) DEFAULT NULL,
  `timme` varchar(255) DEFAULT NULL,
  `dingdanerror` int(8) DEFAULT '0',
  `ddh` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ld_errorddh
-- ----------------------------

-- ----------------------------
-- Table structure for ld_ewmadmin
-- ----------------------------
DROP TABLE IF EXISTS `ld_ewmadmin`;
CREATE TABLE `ld_ewmadmin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adminname` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `custom1` varchar(255) DEFAULT NULL,
  `custom2` varchar(255) DEFAULT NULL,
  `custom3` varchar(255) DEFAULT NULL,
  `custom4` varchar(255) DEFAULT NULL,
  `custom5` varchar(255) DEFAULT NULL,
  `custom6` varchar(255) DEFAULT NULL,
  `urls` varchar(255) DEFAULT NULL,
  `appid` varchar(255) DEFAULT NULL,
  `userkey` varchar(255) DEFAULT NULL,
  `fkok` int(2) DEFAULT NULL,
  `jiekou` varchar(255) DEFAULT NULL,
  `fanhui` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ld_ewmadmin
-- ----------------------------
INSERT INTO `ld_ewmadmin` VALUES ('1', 'ac520', 'e10adc3949ba59abbe56e057f20f883e', 'add_balance', '1', 'approved', '1562757095', '1000000', '0', '1', 'www.8f646.cn', '15627570535239', '63061978', '1', 'www.8f646.cn/ok.php', 'www.8f646.cn/aaa.php');

-- ----------------------------
-- Table structure for ld_ewmddh
-- ----------------------------
DROP TABLE IF EXISTS `ld_ewmddh`;
CREATE TABLE `ld_ewmddh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pay` varchar(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `zhanghao` varchar(20) DEFAULT NULL,
  `cny` varchar(255) DEFAULT NULL,
  `text1` varchar(255) DEFAULT NULL,
  `text2` varchar(255) DEFAULT NULL,
  `text3` varchar(255) DEFAULT NULL,
  `text4` int(8) DEFAULT '0',
  `text5` int(8) DEFAULT '0',
  `uid` varchar(255) DEFAULT NULL,
  `appid` varchar(255) DEFAULT NULL,
  `timm` varchar(255) DEFAULT NULL,
  `timmt` varchar(255) DEFAULT NULL,
  `timme` varchar(255) DEFAULT NULL,
  `dingdanok` int(8) DEFAULT '0',
  `ddh` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ld_ewmddh
-- ----------------------------
INSERT INTO `ld_ewmddh` VALUES ('1', '3', '1.08', '3', '1.08', '', '', '', '0', '0', '2019071019330474757', '15627570535239', '1562758564', '1562758384', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('2', '3', '1.17', '1', '1.17', '', '', '', '0', '0', '2019071019433044012', '15627570535239', '1562759191', '1562759011', '1562759032', '1', '10156275903260888008229790200312');
INSERT INTO `ld_ewmddh` VALUES ('3', '3', '1.92', '1', '1.92', '', '', '', '0', '0', '2019071019475201957', '15627570535239', '1562759452', '1562759272', '1562759288', '1', '10156275928890230329789273055813');
INSERT INTO `ld_ewmddh` VALUES ('4', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019071019565222011', '15627570535239', '1562759992', '1562759812', '1562759828', '1', '10156275982837493456653362820604');
INSERT INTO `ld_ewmddh` VALUES ('5', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019071020014339877', '15627570535239', '1562760284', '1562760104', '1562760116', '1', '101562760116646656794237379565');
INSERT INTO `ld_ewmddh` VALUES ('6', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019071020043497852', '15627570535239', '1562760454', '1562760274', '1562760289', '1', '10156276028964078067642977472726');
INSERT INTO `ld_ewmddh` VALUES ('7', '3', '1.01', '1', '1.00', '', '', '', '0', '0', '2019071020045602263', '15627570535239', '1562760476', '1562760296', '1562760333', '1', '10156276033363675208169679269187');
INSERT INTO `ld_ewmddh` VALUES ('8', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019071020085377592', '15627570535239', '1562760714', '1562760534', '1562760551', '1', '10156276055111708882588548338778');
INSERT INTO `ld_ewmddh` VALUES ('9', '3', '1.01', '1', '1.00', '', '', '', '0', '0', '2019071020091731828', '15627570535239', '1562760737', '1562760557', '1562760579', '1', '10156276057915403084192028134809');
INSERT INTO `ld_ewmddh` VALUES ('10', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019071020111717746', '15627570535239', '1562760858', '1562760678', '1562760692', '1', '101562760692276280167656372195110');
INSERT INTO `ld_ewmddh` VALUES ('11', '3', '1.01', '1', '1.00', '', '', '', '0', '0', '2019071020113884896', '15627570535239', '1562760878', '1562760698', '1562760754', '1', '101562760754869796130346431223311');
INSERT INTO `ld_ewmddh` VALUES ('12', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019071020174387350', '15627570535239', '1562761243', '1562761063', '1562761076', '1', '101562761076590702691528596683112');
INSERT INTO `ld_ewmddh` VALUES ('13', '3', '1.01', '1', '1.00', '', '', '', '0', '0', '2019071020180288477', '15627570535239', '1562761262', '1562761082', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('14', '3', '1.02', '1', '1.00', '', '', '', '0', '0', '2019071020185774748', '15627570535239', '1562761317', '1562761137', '1562761149', '1', '101562761149708072762619897434913');
INSERT INTO `ld_ewmddh` VALUES ('15', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019071020191606611', '15627570535239', '1562761336', '1562761156', '1562761171', '1', '101562761171650195573946731774414');
INSERT INTO `ld_ewmddh` VALUES ('16', '3', '1.03', '1', '1.00', '', '', '', '0', '0', '2019071020193770403', '15627570535239', '1562761358', '1562761178', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('17', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019071020232110677', '15627570535239', '1562761581', '1562761401', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('18', '3', '1.01', '1', '1.00', '', '', '', '0', '0', '2019071020241803990', '15627570535239', '1562761638', '1562761458', '1562761476', '1', '10156276147655313592792855153215');
INSERT INTO `ld_ewmddh` VALUES ('19', '3', '1.02', '1', '1.00', '', '', '', '0', '0', '2019071020243472322', '15627570535239', '1562761654', '1562761474', '1562761486', '1', '101562761486159518950210541429916');
INSERT INTO `ld_ewmddh` VALUES ('20', '3', '1.03', '1', '1.00', '', '', '', '0', '0', '2019071020244282624', '15627570535239', '1562761662', '1562761482', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('21', '3', '1.04', '1', '1.00', '', '', '', '0', '0', '2019071020245239749', '15627570535239', '1562761672', '1562761492', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('22', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019071020262315986', '15627570535239', '1562761763', '1562761583', '1562761600', '1', '101562761600107414517060730929817');
INSERT INTO `ld_ewmddh` VALUES ('23', '3', '1.01', '1', '1.00', '', '', '', '0', '0', '2019071020272363233', '15627570535239', '1562761823', '1562761643', '1562761662', '1', '101562761662346829832322846192018');
INSERT INTO `ld_ewmddh` VALUES ('24', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019071020275362503', '15627570535239', '1562761853', '1562761673', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('25', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019071020311880405', '15627570535239', '1562762058', '1562761878', '1562761902', '1', '101562761902876309200950433235219');
INSERT INTO `ld_ewmddh` VALUES ('26', '3', '1.01', '1', '1.00', '', '', '', '0', '0', '2019071020312219024', '15627570535239', '1562762062', '1562761882', '1562761914', '1', '101562761914438810894855913948120');
INSERT INTO `ld_ewmddh` VALUES ('27', '3', '1.02', '1', '1.00', '', '', '', '0', '0', '2019071020315536033', '15627570535239', '1562762095', '1562761915', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('28', '3', '1.03', '1', '1.00', '', '', '', '0', '0', '2019071020320144462', '15627570535239', '1562762101', '1562761921', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('29', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019071020324901736', '15627570535239', '1562762149', '1562761969', '1562761982', '1', '101562761982801472369610283080021');
INSERT INTO `ld_ewmddh` VALUES ('30', '3', '1.01', '1', '1.00', '', '', '', '0', '0', '2019071020330986861', '15627570535239', '1562762169', '1562761989', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('31', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019071020424798935', '15627570535239', '1562762747', '1562762567', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('32', '3', '1.01', '1', '1.00', '', '', '', '0', '0', '2019071020433393725', '15627570535239', '1562762793', '1562762613', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('33', '3', '1.02', '1', '1.00', '', '', '', '0', '0', '2019071020442408247', '15627570535239', '1562762844', '1562762664', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('34', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019071020470780451', '15627570535239', '1562763007', '1562762827', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('35', '3', '1.01', '1', '1.00', '', '', '', '0', '0', '2019071020483590363', '15627570535239', '1562763095', '1562762915', '1562762928', '1', '101562762928586814945494592463225');
INSERT INTO `ld_ewmddh` VALUES ('36', '3', '1.02', '1', '1.00', '', '', '', '0', '0', '2019071020485407064', '15627570535239', '1562763114', '1562762934', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('37', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019071021004389834', '15627570535239', '1562763823', '1562763643', '1562763669', '1', '101562763669756189942189191049526');
INSERT INTO `ld_ewmddh` VALUES ('38', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019071021035689021', '15627570535239', '1562764016', '1562763836', '1562763848', '1', '101562763848266010842524288795127');
INSERT INTO `ld_ewmddh` VALUES ('39', '3', '1.01', '1', '1.00', '', '', '', '0', '0', '2019071021041275743', '15627570535239', '1562764033', '1562763853', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('40', '3', '1.02', '1', '1.00', '', '', '', '0', '0', '2019071021050259365', '15627570535239', '1562764083', '1562763903', '1562763918', '1', '101562763918572374557440066567228');
INSERT INTO `ld_ewmddh` VALUES ('41', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019071021061886614', '15627570535239', '1562764159', '1562763979', '1562763995', '1', '10156276399526627412444426868629');
INSERT INTO `ld_ewmddh` VALUES ('42', '3', '1.02', '1', '1.00', '', '', '', '0', '0', '2019071021064253769', '15627570535239', '1562764182', '1562764002', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('43', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019071021205143357', '15627570535239', '1562765032', '1562764852', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('44', '3', '1.01', '1', '1.00', '', '', '', '0', '0', '2019071021211935803', '15627570535239', '1562765059', '1562764879', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('45', '3', '1.02', '1', '1.00', '', '', '', '0', '0', '2019071021212622480', '15627570535239', '1562765066', '1562764886', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('46', '3', '1.03', '1', '1.00', '', '', '', '0', '0', '2019071021214929481', '15627570535239', '1562765089', '1562764909', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('47', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019071021502858865', '15627570535239', '1562766809', '1562766629', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('48', '3', '1.01', '1', '1.00', '', '', '', '0', '0', '2019071021504832657', '15627570535239', '1562766832', '1562766652', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('49', '3', '1.02', '1', '1.00', '', '', '', '0', '0', '2019071021511574862', '15627570535239', '1562766856', '1562766676', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('50', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019071021594270853', '15627570535239', '1562767363', '1562767183', '1562767210', '1', '10156276721028849354529443996552');
INSERT INTO `ld_ewmddh` VALUES ('51', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019071022045425905', '15627570535239', '1562767674', '1562767494', '1562767512', '1', '10156276751279467083618402704433');
INSERT INTO `ld_ewmddh` VALUES ('52', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019071022073731652', '15627570535239', '1562767837', '1562767657', '1562767681', '1', '10156276768146760720129851437454');
INSERT INTO `ld_ewmddh` VALUES ('53', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019071022113794791', '15627570535239', '1562768078', '1562767898', '1562767913', '1', '10156276791338676376505617121135');
INSERT INTO `ld_ewmddh` VALUES ('54', '3', '1.01', '1', '1.00', '', '', '', '0', '0', '2019071022123158008', '15627570535239', '1562768131', '1562767951', '1562767964', '1', '10156276796436826732306095747536');
INSERT INTO `ld_ewmddh` VALUES ('55', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019071023111272265', '15627570535239', '1562771653', '1562771473', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('56', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019071101112416984', '15627570535239', '1562778864', '1562778684', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('57', '3', '1.01', '1', '1.00', '', '', '', '0', '0', '2019071101132287110', '15627570535239', '1562778983', '1562778803', '1562778820', '1', '10156277882014185857099912970021');
INSERT INTO `ld_ewmddh` VALUES ('58', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019071101150285889', '15627570535239', '1562779083', '1562778903', '1562778921', '1', '10156277892165313458041239687182');
INSERT INTO `ld_ewmddh` VALUES ('59', '3', '1.01', '1', '1.00', '', '', '', '0', '0', '2019071101154781343', '15627570535239', '1562779128', '1562778948', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('60', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019071220375409624', '15627570535239', '1562935254', '1562935074', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('61', '3', '1.01', '1', '1.00', '', '', '', '0', '0', '2019071220380746308', '15627570535239', '1562935267', '1562935087', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('62', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019072301472611924', '15627570535239', '1563817826', '1563817646', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('63', '3', '1.01', '1', '1.00', '', '', '', '0', '0', '2019072301473957914', '15627570535239', '1563817840', '1563817660', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('64', '3', '1.02', '1', '1.00', '', '', '', '0', '0', '2019072301502133397', '15627570535239', '1563818002', '1563817822', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('65', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019072301505619107', '15627570535239', '1563818036', '1563817856', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('66', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019072301570321305', '15627570535239', '1563818403', '1563818223', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('67', '3', '1.01', '1', '1.00', '', '', '', '0', '0', '2019072301574703876', '15627570535239', '1563818448', '1563818268', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('68', '3', '1.02', '1', '1.00', '', '', '', '0', '0', '2019072301585979599', '15627570535239', '1563818520', '1563818340', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('69', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019072302045010090', '15627570535239', '1563818870', '1563818690', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('70', '3', '1.01', '1', '1.00', '', '', '', '0', '0', '2019072302074877354', '15627570535239', '1563819049', '1563818869', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('71', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019072302075625117', '15627570535239', '1563819057', '1563818877', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('72', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019072317240980413', '15627570535239', '1563874031', '1563873851', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('73', '3', '1.01', '1', '1.00', '', '', '', '0', '0', '2019072317245219733', '15627570535239', '1563874073', '1563873893', null, '0', null);
INSERT INTO `ld_ewmddh` VALUES ('74', '3', '1.00', '1', '1.00', '', '', '', '0', '0', '2019072317282759112', '15627570535239', '1563874288', '1563874108', null, '0', null);

-- ----------------------------
-- Table structure for ld_ewmszb
-- ----------------------------
DROP TABLE IF EXISTS `ld_ewmszb`;
CREATE TABLE `ld_ewmszb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pay` varchar(20) DEFAULT NULL,
  `name` decimal(15,2) DEFAULT NULL,
  `zhanghao` varchar(20) DEFAULT NULL,
  `cny` varchar(255) DEFAULT NULL,
  `appid` varchar(255) DEFAULT NULL,
  `picurl` varchar(255) DEFAULT NULL,
  `ewmurl` varchar(255) DEFAULT NULL,
  `fenzuid` varchar(255) DEFAULT NULL,
  `timm` varchar(255) DEFAULT NULL,
  `onoff` int(6) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ld_ewmszb
-- ----------------------------
INSERT INTO `ld_ewmszb` VALUES ('27', '3', '1.00', '1', '1.00', '15627570535239', 'tywx1.jpg', 'tywx1.jpg', '99999', '1563874288', '0');
INSERT INTO `ld_ewmszb` VALUES ('28', '3', '1.01', '1', '1.00', '15627570535239', 'tywx1.jpg', 'tywx1.jpg', '99999', '1563874073', '0');
INSERT INTO `ld_ewmszb` VALUES ('29', '3', '1.02', '1', '1.00', '15627570535239', 'tywx1.jpg', 'tywx1.jpg', '99999', '1563818520', '0');

-- ----------------------------
-- Table structure for ld_ewmzu
-- ----------------------------
DROP TABLE IF EXISTS `ld_ewmzu`;
CREATE TABLE `ld_ewmzu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zuname` varchar(20) DEFAULT NULL,
  `zhanghao` varchar(20) DEFAULT NULL,
  `money` float DEFAULT NULL,
  `appid` varchar(255) DEFAULT NULL,
  `onoff` int(6) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ld_ewmzu
-- ----------------------------

-- ----------------------------
-- Table structure for ld_failedlogin
-- ----------------------------
DROP TABLE IF EXISTS `ld_failedlogin`;
CREATE TABLE `ld_failedlogin` (
  `username` char(30) NOT NULL,
  `ip` char(15) DEFAULT NULL,
  `time` int(10) unsigned DEFAULT NULL,
  `num` tinyint(1) DEFAULT NULL,
  `isadmin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ld_failedlogin
-- ----------------------------
INSERT INTO `ld_failedlogin` VALUES ('ac520', '182.139.13.253', '1563816439', '4', '1');
INSERT INTO `ld_failedlogin` VALUES ('admin', '118.113.21.236', '1563816324', '5', '1');
INSERT INTO `ld_failedlogin` VALUES ('josha', '118.113.21.236', '1563816445', '5', '1');

-- ----------------------------
-- Table structure for ld_zhanghaoon
-- ----------------------------
DROP TABLE IF EXISTS `ld_zhanghaoon`;
CREATE TABLE `ld_zhanghaoon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zhanghao` varchar(20) DEFAULT NULL,
  `onoff` varchar(20) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `appid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ld_zhanghaoon
-- ----------------------------
INSERT INTO `ld_zhanghaoon` VALUES ('7', '1', '1', '1', '15627570535239');
INSERT INTO `ld_zhanghaoon` VALUES ('8', '1', '1', '2', '15627570535239');
INSERT INTO `ld_zhanghaoon` VALUES ('9', '1', '0', '3', '15627570535239');

-- ----------------------------
-- Table structure for ld_zhanghaozu
-- ----------------------------
DROP TABLE IF EXISTS `ld_zhanghaozu`;
CREATE TABLE `ld_zhanghaozu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zhanghao` varchar(20) DEFAULT NULL,
  `zfbewmurl` varchar(255) DEFAULT NULL,
  `qqewmurl` varchar(255) DEFAULT NULL,
  `wxewmurl` varchar(255) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `appid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ld_zhanghaozu
-- ----------------------------
INSERT INTO `ld_zhanghaozu` VALUES ('3', '1', null, null, 'tywx1.jpg', '0', '15627570535239');

-- ----------------------------
-- Table structure for log
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `msg` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log
-- ----------------------------
INSERT INTO `log` VALUES ('1', '1', '后台管理员修改余额为10000元', '2020-03-08 23:33:47');
INSERT INTO `log` VALUES ('2', '1', '升级VIP消费638.65元', '2020-03-08 23:37:30');
INSERT INTO `log` VALUES ('3', '1', '升级VIP消费1809.59元', '2020-03-08 23:37:38');

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `qq` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `addtime` varchar(255) NOT NULL,
  `auth` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO `member` VALUES ('1', 'admin', '$2y$10$YDnOymRp1j2gMAmE3bwik.yCtCIXtRujhfI3vh0dJfC8GBGFc1ZT2', '12345678', '12345678@qq.com', '2019-09-09 21:38:42', 'bae5a778b50a886bbc11a5bfbf56f3fe');

-- ----------------------------
-- Table structure for notice
-- ----------------------------
DROP TABLE IF EXISTS `notice`;
CREATE TABLE `notice` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `date` varchar(255) NOT NULL,
  `look` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of notice
-- ----------------------------

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `trade_no` varchar(32) NOT NULL DEFAULT '' COMMENT '订单号',
  `out_trade_no` varchar(32) DEFAULT NULL COMMENT '商户订单号',
  `mchid` varchar(64) DEFAULT NULL COMMENT '微信商户号',
  `u_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `o_name` varchar(255) DEFAULT NULL COMMENT '商品ID',
  `notify_url` varchar(255) DEFAULT NULL COMMENT '通知地址',
  `money` varchar(255) DEFAULT NULL COMMENT '金额',
  `m_type` int(1) DEFAULT '0' COMMENT '1为手机，2为PC',
  `addtime` varchar(255) DEFAULT NULL COMMENT '创建时间',
  `endtime` varchar(255) DEFAULT NULL COMMENT '完成时间',
  `state` int(1) NOT NULL DEFAULT '0' COMMENT '订单状态',
  PRIMARY KEY (`trade_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order
-- ----------------------------

-- ----------------------------
-- Table structure for recharge
-- ----------------------------
DROP TABLE IF EXISTS `recharge`;
CREATE TABLE `recharge` (
  `trade_no` varchar(32) NOT NULL,
  `uid` int(11) NOT NULL,
  `money` float(10,2) NOT NULL,
  `state` int(11) DEFAULT '0',
  `addtime` varchar(64) NOT NULL,
  `endtime` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`trade_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of recharge
-- ----------------------------
INSERT INTO `recharge` VALUES ('2020030823374757440', '1', '30.00', '0', '2020-03-08 23:37:47', null);

-- ----------------------------
-- Table structure for submit
-- ----------------------------
DROP TABLE IF EXISTS `submit`;
CREATE TABLE `submit` (
  `sid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_card_name` varchar(255) DEFAULT NULL COMMENT '身份证姓名',
  `id_card_number` varchar(255) DEFAULT NULL COMMENT '身份证号码',
  `id_card_valid_time` varchar(255) DEFAULT NULL COMMENT '身份证有效期限',
  `id_card_copy` varchar(255) DEFAULT NULL COMMENT '身份证人像面照片',
  `id_card_national` varchar(255) DEFAULT NULL COMMENT '身份证国徽面照片',
  `account_name` varchar(255) DEFAULT NULL COMMENT '开户名称',
  `account_bank` varchar(255) DEFAULT NULL COMMENT '开户银行',
  `bank_name` varchar(255) DEFAULT NULL COMMENT '开户银行全称（含支行）',
  `store_name` varchar(255) DEFAULT NULL COMMENT '门店名称',
  `store_street` varchar(255) DEFAULT NULL COMMENT '门店街道名称',
  `store_entrance_pic` varchar(255) DEFAULT NULL COMMENT '门店门口照片',
  `indoor_pic` varchar(255) DEFAULT NULL COMMENT '店内环境照片',
  `merchant_shortname` varchar(255) DEFAULT NULL COMMENT '商户简称',
  `
service_phone` varchar(255) DEFAULT NULL COMMENT '客服电话',
  `product_desc` varchar(255) DEFAULT NULL COMMENT '售卖商品/提供服务描述',
  `contact` varchar(255) DEFAULT NULL COMMENT '联系人姓名',
  `contact_phone` varchar(255) DEFAULT NULL COMMENT '手机号码',
  `contact_email` varchar(255) DEFAULT NULL COMMENT '联系邮箱',
  `rate` varchar(255) DEFAULT NULL,
  `service_phone` varchar(255) DEFAULT NULL,
  `u_id` int(11) NOT NULL COMMENT '用户ID',
  `mchid` varchar(255) DEFAULT NULL,
  `addtime` varchar(255) DEFAULT NULL,
  `config_state` int(11) DEFAULT '0',
  `did` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of submit
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `s_uid` int(10) DEFAULT NULL,
  `uname` varchar(32) DEFAULT NULL COMMENT '用户名',
  `upwd` varchar(255) DEFAULT NULL COMMENT '用户密码',
  `email` varchar(32) DEFAULT NULL COMMENT '用户邮箱',
  `qq` varchar(15) DEFAULT NULL COMMENT '用户QQ',
  `created_at` datetime DEFAULT NULL COMMENT '注册时间',
  `token` varchar(255) DEFAULT NULL COMMENT '验证token',
  `v_id` int(11) DEFAULT '0' COMMENT '会员外键',
  `docking` varchar(255) DEFAULT NULL COMMENT '对接Token',
  `uprice` varchar(255) DEFAULT '1' COMMENT '用户余额',
  `v_time` varchar(64) NOT NULL DEFAULT '0' COMMENT '开通会员时间',
  `v_time_expire` varchar(64) DEFAULT NULL COMMENT '会员到期时间',
  `status` enum('1','0') DEFAULT '1' COMMENT '0为封禁,1为正常',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', null, 'test', '$2y$10$O6NsdoUXR63wl.C9fEpJQeoMA4eyQ4bbaWVM1nU6nmMrhft55floC', '353889786@qq.com', '353889786', '2020-03-08 23:32:08', '$2y$10$SJ/hAxcBn0BCs2v4V3c2YObDNCn9gfbpHjvupdO4Bw3fasWXMQhla', '4', null, '7551.76', '0', '2020-12-30', '1');

-- ----------------------------
-- Table structure for vip
-- ----------------------------
DROP TABLE IF EXISTS `vip`;
CREATE TABLE `vip` (
  `vid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vname` varchar(32) DEFAULT NULL COMMENT '会员名称',
  `vprice` varchar(32) DEFAULT NULL COMMENT '会员原价',
  `price` varchar(32) DEFAULT NULL COMMENT '会员出售价格',
  `wx_rate` varchar(10) DEFAULT NULL COMMENT '微信费率',
  `info` text COMMENT '会员介绍',
  PRIMARY KEY (`vid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vip
-- ----------------------------
INSERT INTO `vip` VALUES ('1', '小会员', '18.88', '8.88', '1.3', '1');
INSERT INTO `vip` VALUES ('2', '会员', '88.88', '66.66', '1', '1');
INSERT INTO `vip` VALUES ('3', '大会员', '188.88', '88', '0.8', '1');
INSERT INTO `vip` VALUES ('4', '超级会员', '888.88', '188.88', '0.5', '1');
INSERT INTO `vip` VALUES ('5', '普通会员', '1', '1', '1', '1');

-- ----------------------------
-- Table structure for wei_ad
-- ----------------------------
DROP TABLE IF EXISTS `wei_ad`;
CREATE TABLE `wei_ad` (
  `a_name` longtext,
  `a_url` longtext,
  `a_pic` longtext,
  `a_position` longtext,
  `a_time` datetime DEFAULT NULL,
  `f_id` int(11) NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wei_ad
-- ----------------------------

-- ----------------------------
-- Table structure for wei_admin
-- ----------------------------
DROP TABLE IF EXISTS `wei_admin`;
CREATE TABLE `wei_admin` (
  `a_name` varchar(255) DEFAULT NULL,
  `a_password` varchar(255) DEFAULT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wei_admin
-- ----------------------------
INSERT INTO `wei_admin` VALUES ('admin', 'e10adc3949ba59abbe56e057f20f883e', '1');

-- ----------------------------
-- Table structure for wei_channel
-- ----------------------------
DROP TABLE IF EXISTS `wei_channel`;
CREATE TABLE `wei_channel` (
  `name` longtext,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wei_channel
-- ----------------------------
INSERT INTO `wei_channel` VALUES ('乱伦', '17', '1');
INSERT INTO `wei_channel` VALUES ('呦女', '19', '2');
INSERT INTO `wei_channel` VALUES ('人寿', '20', '3');
INSERT INTO `wei_channel` VALUES ('国产', '21', '4');
INSERT INTO `wei_channel` VALUES ('欧美', '27', '5');
INSERT INTO `wei_channel` VALUES ('日韩', '28', '6');

-- ----------------------------
-- Table structure for wei_dashang
-- ----------------------------
DROP TABLE IF EXISTS `wei_dashang`;
CREATE TABLE `wei_dashang` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `vid` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wei_dashang
-- ----------------------------

-- ----------------------------
-- Table structure for wei_domain
-- ----------------------------
DROP TABLE IF EXISTS `wei_domain`;
CREATE TABLE `wei_domain` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext,
  `zt` int(11) DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=646 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wei_domain
-- ----------------------------
INSERT INTO `wei_domain` VALUES ('645', 'www.lcgqh.cn', '0');

-- ----------------------------
-- Table structure for wei_domainku
-- ----------------------------
DROP TABLE IF EXISTS `wei_domainku`;
CREATE TABLE `wei_domainku` (
  `name` longtext,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wei_domainku
-- ----------------------------

-- ----------------------------
-- Table structure for wei_fangwen
-- ----------------------------
DROP TABLE IF EXISTS `wei_fangwen`;
CREATE TABLE `wei_fangwen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fangwen_ip` varchar(200) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `fangwen_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=284 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of wei_fangwen
-- ----------------------------
INSERT INTO `wei_fangwen` VALUES ('1', '223.73.208.62', '1', '1562748754');
INSERT INTO `wei_fangwen` VALUES ('2', '223.73.208.62', '1', '1562748755');
INSERT INTO `wei_fangwen` VALUES ('3', '101.226.225.85', '1', '1562748803');
INSERT INTO `wei_fangwen` VALUES ('4', '101.226.225.85', '1', '1562748803');
INSERT INTO `wei_fangwen` VALUES ('5', '223.73.208.62', '1', '1562748894');
INSERT INTO `wei_fangwen` VALUES ('6', '223.73.208.62', '1', '1562748894');
INSERT INTO `wei_fangwen` VALUES ('7', '101.226.225.85', '1', '1562748917');
INSERT INTO `wei_fangwen` VALUES ('8', '101.226.225.85', '1', '1562748918');
INSERT INTO `wei_fangwen` VALUES ('9', '183.3.226.234', '1', '1562748981');
INSERT INTO `wei_fangwen` VALUES ('10', '183.3.226.234', '1', '1562748982');
INSERT INTO `wei_fangwen` VALUES ('11', '61.151.178.174', '1', '1562749346');
INSERT INTO `wei_fangwen` VALUES ('12', '61.151.178.166', '1', '1562749470');
INSERT INTO `wei_fangwen` VALUES ('13', '101.89.19.197', '1', '1562749494');
INSERT INTO `wei_fangwen` VALUES ('14', '101.89.19.197', '1', '1562749495');
INSERT INTO `wei_fangwen` VALUES ('15', '61.129.6.251', '1', '1562749628');
INSERT INTO `wei_fangwen` VALUES ('16', '101.226.225.85', '1', '1562751720');
INSERT INTO `wei_fangwen` VALUES ('17', '101.226.225.85', '1', '1562751721');
INSERT INTO `wei_fangwen` VALUES ('18', '101.226.225.85', '1', '1562751732');
INSERT INTO `wei_fangwen` VALUES ('19', '101.226.225.85', '1', '1562751733');
INSERT INTO `wei_fangwen` VALUES ('20', '183.3.226.234', '1', '1562751893');
INSERT INTO `wei_fangwen` VALUES ('21', '183.3.226.234', '1', '1562751893');
INSERT INTO `wei_fangwen` VALUES ('22', '183.3.226.234', '1', '1562751904');
INSERT INTO `wei_fangwen` VALUES ('23', '183.3.226.234', '1', '1562751904');
INSERT INTO `wei_fangwen` VALUES ('24', '183.3.226.234', '1', '1562751941');
INSERT INTO `wei_fangwen` VALUES ('25', '183.3.226.234', '1', '1562751941');
INSERT INTO `wei_fangwen` VALUES ('26', '183.3.226.234', '1', '1562751960');
INSERT INTO `wei_fangwen` VALUES ('27', '183.3.226.234', '1', '1562751964');
INSERT INTO `wei_fangwen` VALUES ('28', '183.3.226.234', '1', '1562751966');
INSERT INTO `wei_fangwen` VALUES ('29', '183.3.226.234', '1', '1562751966');
INSERT INTO `wei_fangwen` VALUES ('30', '183.3.226.234', '1', '1562751967');
INSERT INTO `wei_fangwen` VALUES ('31', '183.3.226.234', '1', '1562751967');
INSERT INTO `wei_fangwen` VALUES ('32', '183.3.226.234', '1', '1562751968');
INSERT INTO `wei_fangwen` VALUES ('33', '183.3.226.234', '1', '1562751969');
INSERT INTO `wei_fangwen` VALUES ('34', '183.3.226.234', '1', '1562751970');
INSERT INTO `wei_fangwen` VALUES ('35', '183.3.226.234', '0', '1562757260');
INSERT INTO `wei_fangwen` VALUES ('36', '183.3.226.234', '0', '1562757262');
INSERT INTO `wei_fangwen` VALUES ('37', '183.3.226.234', '0', '1562757264');
INSERT INTO `wei_fangwen` VALUES ('38', '183.3.226.234', '0', '1562757265');
INSERT INTO `wei_fangwen` VALUES ('39', '183.3.226.234', '0', '1562757265');
INSERT INTO `wei_fangwen` VALUES ('40', '101.226.225.85', '0', '1562757266');
INSERT INTO `wei_fangwen` VALUES ('41', '183.3.226.234', '0', '1562757266');
INSERT INTO `wei_fangwen` VALUES ('42', '101.226.225.85', '0', '1562757272');
INSERT INTO `wei_fangwen` VALUES ('43', '101.226.225.85', '0', '1562757273');
INSERT INTO `wei_fangwen` VALUES ('44', '101.89.29.94', '0', '1562757325');
INSERT INTO `wei_fangwen` VALUES ('45', '101.91.62.99', '0', '1562757327');
INSERT INTO `wei_fangwen` VALUES ('46', '180.97.118.223', '0', '1562757328');
INSERT INTO `wei_fangwen` VALUES ('47', '61.129.8.179', '0', '1562757331');
INSERT INTO `wei_fangwen` VALUES ('48', '101.227.139.172', '0', '1562757332');
INSERT INTO `wei_fangwen` VALUES ('49', '61.151.178.175', '0', '1562757332');
INSERT INTO `wei_fangwen` VALUES ('50', '58.247.206.141', '0', '1562757336');
INSERT INTO `wei_fangwen` VALUES ('51', '101.91.60.106', '0', '1562757337');
INSERT INTO `wei_fangwen` VALUES ('52', '183.3.226.234', '0', '1562757344');
INSERT INTO `wei_fangwen` VALUES ('53', '183.3.226.234', '0', '1562757348');
INSERT INTO `wei_fangwen` VALUES ('54', '183.3.226.234', '0', '1562757352');
INSERT INTO `wei_fangwen` VALUES ('55', '183.3.226.234', '0', '1562757355');
INSERT INTO `wei_fangwen` VALUES ('56', '61.129.7.235', '0', '1562757412');
INSERT INTO `wei_fangwen` VALUES ('57', '61.129.6.251', '0', '1562757415');
INSERT INTO `wei_fangwen` VALUES ('58', '101.89.239.238', '0', '1562757419');
INSERT INTO `wei_fangwen` VALUES ('59', '183.3.226.234', '0', '1562757468');
INSERT INTO `wei_fangwen` VALUES ('60', '183.3.226.234', '2', '1562757473');
INSERT INTO `wei_fangwen` VALUES ('61', '183.3.226.234', '2', '1562757474');
INSERT INTO `wei_fangwen` VALUES ('62', '112.60.1.73', '2', '1562757475');
INSERT INTO `wei_fangwen` VALUES ('63', '183.3.226.234', '2', '1562757476');
INSERT INTO `wei_fangwen` VALUES ('64', '183.3.226.234', '2', '1562757478');
INSERT INTO `wei_fangwen` VALUES ('65', '183.3.226.234', '2', '1562757478');
INSERT INTO `wei_fangwen` VALUES ('66', '183.3.226.234', '2', '1562757480');
INSERT INTO `wei_fangwen` VALUES ('67', '58.251.112.211', '2', '1562757481');
INSERT INTO `wei_fangwen` VALUES ('68', '101.226.225.85', '2', '1562757500');
INSERT INTO `wei_fangwen` VALUES ('69', '101.226.225.85', '2', '1562757509');
INSERT INTO `wei_fangwen` VALUES ('70', '61.151.178.165', '2', '1562757533');
INSERT INTO `wei_fangwen` VALUES ('71', '61.129.6.151', '2', '1562757534');
INSERT INTO `wei_fangwen` VALUES ('72', '61.129.7.235', '2', '1562757535');
INSERT INTO `wei_fangwen` VALUES ('73', '61.151.178.165', '2', '1562757537');
INSERT INTO `wei_fangwen` VALUES ('74', '101.89.239.120', '2', '1562757538');
INSERT INTO `wei_fangwen` VALUES ('75', '101.89.29.86', '2', '1562757540');
INSERT INTO `wei_fangwen` VALUES ('76', '101.91.60.110', '2', '1562757540');
INSERT INTO `wei_fangwen` VALUES ('77', '101.91.60.107', '2', '1562757562');
INSERT INTO `wei_fangwen` VALUES ('78', '101.89.29.86', '2', '1562757563');
INSERT INTO `wei_fangwen` VALUES ('79', '101.226.225.85', '2', '1562758381');
INSERT INTO `wei_fangwen` VALUES ('80', '183.3.226.234', '2', '1562758381');
INSERT INTO `wei_fangwen` VALUES ('81', '183.3.226.234', '2', '1562758388');
INSERT INTO `wei_fangwen` VALUES ('82', '101.91.60.104', '2', '1562758452');
INSERT INTO `wei_fangwen` VALUES ('83', '223.73.208.62', '2', '1562758463');
INSERT INTO `wei_fangwen` VALUES ('84', '183.3.226.234', '2', '1562758470');
INSERT INTO `wei_fangwen` VALUES ('85', '183.3.226.234', '2', '1562758475');
INSERT INTO `wei_fangwen` VALUES ('86', '101.226.225.85', '2', '1562758786');
INSERT INTO `wei_fangwen` VALUES ('87', '101.226.225.85', '2', '1562758793');
INSERT INTO `wei_fangwen` VALUES ('88', '101.226.225.85', '2', '1562759008');
INSERT INTO `wei_fangwen` VALUES ('89', '183.3.226.234', '2', '1562759270');
INSERT INTO `wei_fangwen` VALUES ('90', '183.253.216.107', '3', '1562759725');
INSERT INTO `wei_fangwen` VALUES ('91', '183.253.216.107', '3', '1562759727');
INSERT INTO `wei_fangwen` VALUES ('92', '211.97.131.166', '3', '1562759741');
INSERT INTO `wei_fangwen` VALUES ('93', '101.226.225.85', '3', '1562759787');
INSERT INTO `wei_fangwen` VALUES ('94', '101.91.60.110', '3', '1562759788');
INSERT INTO `wei_fangwen` VALUES ('95', '101.227.139.178', '3', '1562759790');
INSERT INTO `wei_fangwen` VALUES ('96', '211.97.131.166', '3', '1562759795');
INSERT INTO `wei_fangwen` VALUES ('97', '101.89.29.97', '3', '1562759802');
INSERT INTO `wei_fangwen` VALUES ('98', '211.97.131.166', '3', '1562759802');
INSERT INTO `wei_fangwen` VALUES ('99', '180.97.118.223', '3', '1562759871');
INSERT INTO `wei_fangwen` VALUES ('100', '211.97.131.166', '3', '1562759935');
INSERT INTO `wei_fangwen` VALUES ('101', '61.151.178.165', '3', '1562759999');
INSERT INTO `wei_fangwen` VALUES ('102', '211.97.131.166', '3', '1562760089');
INSERT INTO `wei_fangwen` VALUES ('103', '211.97.131.166', '3', '1562760097');
INSERT INTO `wei_fangwen` VALUES ('104', '183.253.216.107', '3', '1562760270');
INSERT INTO `wei_fangwen` VALUES ('105', '183.253.216.107', '3', '1562760530');
INSERT INTO `wei_fangwen` VALUES ('106', '183.253.216.107', '3', '1562760653');
INSERT INTO `wei_fangwen` VALUES ('107', '211.97.131.166', '3', '1562760675');
INSERT INTO `wei_fangwen` VALUES ('108', '61.129.6.251', '3', '1562760718');
INSERT INTO `wei_fangwen` VALUES ('109', '211.97.131.166', '4', '1562761008');
INSERT INTO `wei_fangwen` VALUES ('110', '211.97.131.166', '3', '1562761028');
INSERT INTO `wei_fangwen` VALUES ('111', '183.3.226.234', '2', '1562761061');
INSERT INTO `wei_fangwen` VALUES ('112', '101.91.60.104', '4', '1562761073');
INSERT INTO `wei_fangwen` VALUES ('113', '211.97.131.166', '4', '1562761084');
INSERT INTO `wei_fangwen` VALUES ('114', '211.97.131.166', '3', '1562761097');
INSERT INTO `wei_fangwen` VALUES ('115', '211.97.131.166', '3', '1562761130');
INSERT INTO `wei_fangwen` VALUES ('116', '211.97.131.166', '4', '1562761133');
INSERT INTO `wei_fangwen` VALUES ('117', '61.151.178.197', '4', '1562761149');
INSERT INTO `wei_fangwen` VALUES ('118', '183.253.216.107', '3', '1562761389');
INSERT INTO `wei_fangwen` VALUES ('119', '101.89.29.97', '4', '1562761397');
INSERT INTO `wei_fangwen` VALUES ('120', '183.253.216.107', '4', '1562761456');
INSERT INTO `wei_fangwen` VALUES ('121', '183.3.226.234', '2', '1562761472');
INSERT INTO `wei_fangwen` VALUES ('122', '58.247.206.151', '4', '1562761525');
INSERT INTO `wei_fangwen` VALUES ('123', '183.253.216.107', '4', '1562761575');
INSERT INTO `wei_fangwen` VALUES ('124', '211.97.131.166', '3', '1562761632');
INSERT INTO `wei_fangwen` VALUES ('125', '211.97.131.166', '4', '1562761636');
INSERT INTO `wei_fangwen` VALUES ('126', '101.226.225.85', '4', '1562761865');
INSERT INTO `wei_fangwen` VALUES ('127', '211.97.131.166', '4', '1562761870');
INSERT INTO `wei_fangwen` VALUES ('128', '101.226.225.85', '4', '1562761873');
INSERT INTO `wei_fangwen` VALUES ('129', '183.3.226.234', '2', '1562761968');
INSERT INTO `wei_fangwen` VALUES ('130', '211.97.131.166', '4', '1562762043');
INSERT INTO `wei_fangwen` VALUES ('131', '58.251.112.211', '2', '1562762210');
INSERT INTO `wei_fangwen` VALUES ('132', '61.129.7.235', '2', '1562762276');
INSERT INTO `wei_fangwen` VALUES ('133', '183.3.226.234', '2', '1562762564');
INSERT INTO `wei_fangwen` VALUES ('134', '101.226.225.85', '2', '1562762609');
INSERT INTO `wei_fangwen` VALUES ('135', '183.3.226.234', '2', '1562762661');
INSERT INTO `wei_fangwen` VALUES ('136', '101.226.225.85', '2', '1562762738');
INSERT INTO `wei_fangwen` VALUES ('137', '183.3.226.234', '2', '1562762869');
INSERT INTO `wei_fangwen` VALUES ('138', '183.3.226.234', '2', '1562762914');
INSERT INTO `wei_fangwen` VALUES ('139', '101.226.225.85', '4', '1562763641');
INSERT INTO `wei_fangwen` VALUES ('140', '101.226.225.85', '4', '1562763703');
INSERT INTO `wei_fangwen` VALUES ('141', '101.226.225.85', '4', '1562763707');
INSERT INTO `wei_fangwen` VALUES ('142', '101.226.225.85', '4', '1562763713');
INSERT INTO `wei_fangwen` VALUES ('143', '183.3.226.234', '2', '1562763834');
INSERT INTO `wei_fangwen` VALUES ('144', '112.48.22.60', '4', '1562763836');
INSERT INTO `wei_fangwen` VALUES ('145', '211.97.131.166', '4', '1562763899');
INSERT INTO `wei_fangwen` VALUES ('146', '211.97.131.166', '4', '1562763975');
INSERT INTO `wei_fangwen` VALUES ('147', '101.89.239.216', '4', '1562763981');
INSERT INTO `wei_fangwen` VALUES ('148', '122.97.174.1', '3', '1562764841');
INSERT INTO `wei_fangwen` VALUES ('149', '122.97.174.1', '3', '1562764872');
INSERT INTO `wei_fangwen` VALUES ('150', '122.97.174.1', '3', '1562764877');
INSERT INTO `wei_fangwen` VALUES ('151', '122.97.174.1', '3', '1562764884');
INSERT INTO `wei_fangwen` VALUES ('152', '122.97.174.1', '3', '1562764907');
INSERT INTO `wei_fangwen` VALUES ('153', '122.97.174.1', '3', '1562764941');
INSERT INTO `wei_fangwen` VALUES ('154', '61.151.178.165', '3', '1562764943');
INSERT INTO `wei_fangwen` VALUES ('155', '112.48.22.60', '4', '1562766623');
INSERT INTO `wei_fangwen` VALUES ('156', '112.48.22.60', '4', '1562766660');
INSERT INTO `wei_fangwen` VALUES ('157', '101.89.29.97', '4', '1562766676');
INSERT INTO `wei_fangwen` VALUES ('158', '112.48.22.60', '4', '1562766855');
INSERT INTO `wei_fangwen` VALUES ('159', '211.97.131.166', '4', '1562767166');
INSERT INTO `wei_fangwen` VALUES ('160', '211.97.131.166', '4', '1562767491');
INSERT INTO `wei_fangwen` VALUES ('161', '211.97.131.166', '4', '1562767653');
INSERT INTO `wei_fangwen` VALUES ('162', '183.3.226.234', '2', '1562767895');
INSERT INTO `wei_fangwen` VALUES ('163', '183.3.226.234', '2', '1562767947');
INSERT INTO `wei_fangwen` VALUES ('164', '101.226.225.85', '4', '1562771470');
INSERT INTO `wei_fangwen` VALUES ('165', '183.3.226.234', '2', '1562778084');
INSERT INTO `wei_fangwen` VALUES ('166', '101.226.225.85', '4', '1562778681');
INSERT INTO `wei_fangwen` VALUES ('167', '183.253.216.107', '4', '1562778720');
INSERT INTO `wei_fangwen` VALUES ('168', '183.253.216.107', '4', '1562778743');
INSERT INTO `wei_fangwen` VALUES ('169', '183.253.216.107', '4', '1562778746');
INSERT INTO `wei_fangwen` VALUES ('170', '183.253.216.107', '4', '1562778747');
INSERT INTO `wei_fangwen` VALUES ('171', '183.253.216.107', '4', '1562778749');
INSERT INTO `wei_fangwen` VALUES ('172', '183.253.216.107', '4', '1562778750');
INSERT INTO `wei_fangwen` VALUES ('173', '183.253.216.107', '4', '1562778751');
INSERT INTO `wei_fangwen` VALUES ('174', '183.253.216.107', '4', '1562778752');
INSERT INTO `wei_fangwen` VALUES ('175', '101.226.225.85', '4', '1562778760');
INSERT INTO `wei_fangwen` VALUES ('176', '101.226.225.85', '4', '1562778762');
INSERT INTO `wei_fangwen` VALUES ('177', '101.226.225.85', '4', '1562778763');
INSERT INTO `wei_fangwen` VALUES ('178', '101.226.225.85', '4', '1562778764');
INSERT INTO `wei_fangwen` VALUES ('179', '101.226.225.85', '4', '1562778765');
INSERT INTO `wei_fangwen` VALUES ('180', '101.226.225.85', '4', '1562778772');
INSERT INTO `wei_fangwen` VALUES ('181', '183.253.216.107', '4', '1562778779');
INSERT INTO `wei_fangwen` VALUES ('182', '61.151.178.177', '4', '1562778782');
INSERT INTO `wei_fangwen` VALUES ('183', '211.97.130.178', '4', '1562778798');
INSERT INTO `wei_fangwen` VALUES ('184', '61.151.207.141', '4', '1562778806');
INSERT INTO `wei_fangwen` VALUES ('185', '101.89.29.97', '4', '1562778813');
INSERT INTO `wei_fangwen` VALUES ('186', '101.227.139.172', '4', '1562778815');
INSERT INTO `wei_fangwen` VALUES ('187', '101.89.239.120', '4', '1562778824');
INSERT INTO `wei_fangwen` VALUES ('188', '61.151.178.166', '4', '1562778830');
INSERT INTO `wei_fangwen` VALUES ('189', '211.97.130.178', '4', '1562778898');
INSERT INTO `wei_fangwen` VALUES ('190', '101.226.225.85', '4', '1562778934');
INSERT INTO `wei_fangwen` VALUES ('191', '101.226.225.85', '2', '1562935070');
INSERT INTO `wei_fangwen` VALUES ('192', '101.91.60.107', '2', '1562935131');
INSERT INTO `wei_fangwen` VALUES ('193', '61.151.178.177', '2', '1562935142');
INSERT INTO `wei_fangwen` VALUES ('194', '157.255.172.18', '2', '1563817649');
INSERT INTO `wei_fangwen` VALUES ('195', '61.151.178.197', '2', '1563817710');
INSERT INTO `wei_fangwen` VALUES ('196', '157.255.172.16', '2', '1563818275');
INSERT INTO `wei_fangwen` VALUES ('197', '157.255.172.16', '2', '1563818342');
INSERT INTO `wei_fangwen` VALUES ('198', '183.61.51.70', '2', '1563818345');
INSERT INTO `wei_fangwen` VALUES ('199', '157.255.172.16', '2', '1563818878');
INSERT INTO `wei_fangwen` VALUES ('200', '157.255.172.16', '2', '1563818889');
INSERT INTO `wei_fangwen` VALUES ('201', '157.255.172.16', '2', '1563818890');
INSERT INTO `wei_fangwen` VALUES ('202', '157.255.172.16', '2', '1563818898');
INSERT INTO `wei_fangwen` VALUES ('203', '157.255.172.16', '2', '1563818899');
INSERT INTO `wei_fangwen` VALUES ('204', '101.206.169.20', '2', '1563873886');
INSERT INTO `wei_fangwen` VALUES ('205', '101.206.169.20', '2', '1563873887');
INSERT INTO `wei_fangwen` VALUES ('206', '124.116.224.125', '2', '1563874356');
INSERT INTO `wei_fangwen` VALUES ('207', '124.116.224.125', '2', '1563874356');
INSERT INTO `wei_fangwen` VALUES ('208', '124.116.224.125', '2', '1563874359');
INSERT INTO `wei_fangwen` VALUES ('209', '42.236.10.75', '0', '1563874396');
INSERT INTO `wei_fangwen` VALUES ('210', '101.89.239.120', '2', '1563874595');
INSERT INTO `wei_fangwen` VALUES ('211', '123.151.77.70', '2', '1569131085');
INSERT INTO `wei_fangwen` VALUES ('212', '123.151.77.70', '2', '1569131086');
INSERT INTO `wei_fangwen` VALUES ('213', '123.151.77.70', '2', '1569131105');
INSERT INTO `wei_fangwen` VALUES ('214', '123.151.77.70', '2', '1569131105');
INSERT INTO `wei_fangwen` VALUES ('215', '101.89.239.230', '2', '1569131145');
INSERT INTO `wei_fangwen` VALUES ('216', '101.89.239.230', '2', '1569131145');
INSERT INTO `wei_fangwen` VALUES ('217', '101.91.62.99', '2', '1569131165');
INSERT INTO `wei_fangwen` VALUES ('218', '125.39.46.58', '2', '1569131344');
INSERT INTO `wei_fangwen` VALUES ('219', '125.39.46.58', '2', '1569131345');
INSERT INTO `wei_fangwen` VALUES ('220', '125.39.46.58', '2', '1569131371');
INSERT INTO `wei_fangwen` VALUES ('221', '125.39.46.58', '2', '1569131377');
INSERT INTO `wei_fangwen` VALUES ('222', '125.39.46.58', '2', '1569131389');
INSERT INTO `wei_fangwen` VALUES ('223', '125.39.46.58', '2', '1569131394');
INSERT INTO `wei_fangwen` VALUES ('224', '125.39.46.58', '2', '1569131400');
INSERT INTO `wei_fangwen` VALUES ('225', '180.97.118.223', '2', '1569131405');
INSERT INTO `wei_fangwen` VALUES ('226', '125.39.46.58', '2', '1569131413');
INSERT INTO `wei_fangwen` VALUES ('227', '125.39.46.58', '2', '1569131413');
INSERT INTO `wei_fangwen` VALUES ('228', '125.39.46.58', '2', '1569131418');
INSERT INTO `wei_fangwen` VALUES ('229', '125.39.46.58', '2', '1569131418');
INSERT INTO `wei_fangwen` VALUES ('230', '125.39.46.58', '2', '1569131423');
INSERT INTO `wei_fangwen` VALUES ('231', '125.39.46.58', '2', '1569131423');
INSERT INTO `wei_fangwen` VALUES ('232', '125.39.46.58', '2', '1569131440');
INSERT INTO `wei_fangwen` VALUES ('233', '125.39.46.58', '2', '1569131446');
INSERT INTO `wei_fangwen` VALUES ('234', '61.151.178.197', '2', '1569131453');
INSERT INTO `wei_fangwen` VALUES ('235', '125.39.46.58', '2', '1569131464');
INSERT INTO `wei_fangwen` VALUES ('236', '125.39.46.58', '2', '1569131470');
INSERT INTO `wei_fangwen` VALUES ('237', '125.39.46.58', '2', '1569131487');
INSERT INTO `wei_fangwen` VALUES ('238', '125.39.46.58', '2', '1569131492');
INSERT INTO `wei_fangwen` VALUES ('239', '125.39.46.58', '2', '1569131494');
INSERT INTO `wei_fangwen` VALUES ('240', '125.39.46.58', '2', '1569131515');
INSERT INTO `wei_fangwen` VALUES ('241', '125.39.46.58', '2', '1569131522');
INSERT INTO `wei_fangwen` VALUES ('242', '125.39.46.58', '2', '1569131543');
INSERT INTO `wei_fangwen` VALUES ('243', '123.151.77.70', '2', '1569131735');
INSERT INTO `wei_fangwen` VALUES ('244', '123.151.77.70', '2', '1569131746');
INSERT INTO `wei_fangwen` VALUES ('245', '101.89.29.86', '2', '1569131798');
INSERT INTO `wei_fangwen` VALUES ('246', '123.151.77.70', '2', '1569131927');
INSERT INTO `wei_fangwen` VALUES ('247', '123.151.77.70', '2', '1569131931');
INSERT INTO `wei_fangwen` VALUES ('248', '123.151.77.70', '2', '1569131935');
INSERT INTO `wei_fangwen` VALUES ('249', '123.151.77.70', '2', '1569131938');
INSERT INTO `wei_fangwen` VALUES ('250', '123.151.77.70', '2', '1569132617');
INSERT INTO `wei_fangwen` VALUES ('251', '123.151.77.70', '2', '1569135538');
INSERT INTO `wei_fangwen` VALUES ('252', '123.151.77.70', '2', '1569135549');
INSERT INTO `wei_fangwen` VALUES ('253', '123.151.77.70', '2', '1569137543');
INSERT INTO `wei_fangwen` VALUES ('254', '123.151.77.70', '2', '1569137559');
INSERT INTO `wei_fangwen` VALUES ('255', '123.151.77.70', '2', '1569137567');
INSERT INTO `wei_fangwen` VALUES ('256', '123.151.77.70', '2', '1569137571');
INSERT INTO `wei_fangwen` VALUES ('257', '125.39.46.58', '2', '1569137575');
INSERT INTO `wei_fangwen` VALUES ('258', '113.96.219.248', '2', '1569137899');
INSERT INTO `wei_fangwen` VALUES ('259', '113.96.219.247', '2', '1569138410');
INSERT INTO `wei_fangwen` VALUES ('260', '113.96.219.247', '2', '1569138426');
INSERT INTO `wei_fangwen` VALUES ('261', '113.96.219.247', '2', '1569138429');
INSERT INTO `wei_fangwen` VALUES ('262', '113.96.219.247', '2', '1569138431');
INSERT INTO `wei_fangwen` VALUES ('263', '113.96.219.247', '2', '1569138437');
INSERT INTO `wei_fangwen` VALUES ('264', '14.116.141.150', '2', '1569144842');
INSERT INTO `wei_fangwen` VALUES ('265', '112.96.240.239', '2', '1569145432');
INSERT INTO `wei_fangwen` VALUES ('266', '112.96.240.40', '2', '1569145530');
INSERT INTO `wei_fangwen` VALUES ('267', '112.96.240.40', '2', '1569145536');
INSERT INTO `wei_fangwen` VALUES ('268', '112.96.240.40', '2', '1569145538');
INSERT INTO `wei_fangwen` VALUES ('269', '112.96.240.40', '2', '1569145539');
INSERT INTO `wei_fangwen` VALUES ('270', '112.96.240.40', '2', '1569145540');
INSERT INTO `wei_fangwen` VALUES ('271', '112.96.240.40', '2', '1569145541');
INSERT INTO `wei_fangwen` VALUES ('272', '112.96.240.40', '2', '1569145542');
INSERT INTO `wei_fangwen` VALUES ('273', '101.89.29.94', '2', '1569145597');
INSERT INTO `wei_fangwen` VALUES ('274', '61.151.207.186', '2', '1569145598');
INSERT INTO `wei_fangwen` VALUES ('275', '61.129.6.227', '2', '1569145599');
INSERT INTO `wei_fangwen` VALUES ('276', '101.89.239.232', '2', '1569145603');
INSERT INTO `wei_fangwen` VALUES ('277', '113.96.219.247', '2', '1569146980');
INSERT INTO `wei_fangwen` VALUES ('278', '183.3.234.63', '2', '1569147431');
INSERT INTO `wei_fangwen` VALUES ('279', '183.3.234.56', '2', '1569147440');
INSERT INTO `wei_fangwen` VALUES ('280', '183.3.234.54', '2', '1569147446');
INSERT INTO `wei_fangwen` VALUES ('281', '101.227.139.194', '2', '1569147471');
INSERT INTO `wei_fangwen` VALUES ('282', '183.3.234.63', '2', '1569147472');
INSERT INTO `wei_fangwen` VALUES ('283', '101.227.139.178', '2', '1569147500');

-- ----------------------------
-- Table structure for wei_fankui
-- ----------------------------
DROP TABLE IF EXISTS `wei_fankui`;
CREATE TABLE `wei_fankui` (
  `uid` int(11) DEFAULT NULL,
  `remark` longtext,
  `huifu` longtext,
  `date` datetime DEFAULT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wei_fankui
-- ----------------------------

-- ----------------------------
-- Table structure for wei_fencheng
-- ----------------------------
DROP TABLE IF EXISTS `wei_fencheng`;
CREATE TABLE `wei_fencheng` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `one` int(11) DEFAULT NULL,
  `two` int(11) DEFAULT NULL,
  `three` int(11) DEFAULT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wei_fencheng
-- ----------------------------
INSERT INTO `wei_fencheng` VALUES ('5', '5', '1', '1', '0');
INSERT INTO `wei_fencheng` VALUES ('7', '5', '1', '1', '41');
INSERT INTO `wei_fencheng` VALUES ('8', '5', '1', '1', '40');
INSERT INTO `wei_fencheng` VALUES ('9', '5', '1', '1', '45');
INSERT INTO `wei_fencheng` VALUES ('10', '5', '1', '1', '353');
INSERT INTO `wei_fencheng` VALUES ('11', '5', '1', '1', '58');
INSERT INTO `wei_fencheng` VALUES ('12', '5', '1', '1', '359');
INSERT INTO `wei_fencheng` VALUES ('13', '5', '1', '1', '129');
INSERT INTO `wei_fencheng` VALUES ('14', '5', '1', '1', '3');
INSERT INTO `wei_fencheng` VALUES ('15', '5', '1', '1', '5');
INSERT INTO `wei_fencheng` VALUES ('16', '5', '1', '1', '30');
INSERT INTO `wei_fencheng` VALUES ('17', '5', '1', '1', '4');
INSERT INTO `wei_fencheng` VALUES ('18', '5', '1', '1', '38');
INSERT INTO `wei_fencheng` VALUES ('19', '5', '1', '1', '23');
INSERT INTO `wei_fencheng` VALUES ('20', '5', '1', '1', '69');

-- ----------------------------
-- Table structure for wei_guanliyuan
-- ----------------------------
DROP TABLE IF EXISTS `wei_guanliyuan`;
CREATE TABLE `wei_guanliyuan` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `qx` longtext,
  `loginname` longtext,
  `loginpassword` longtext,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wei_guanliyuan
-- ----------------------------

-- ----------------------------
-- Table structure for wei_hezi
-- ----------------------------
DROP TABLE IF EXISTS `wei_hezi`;
CREATE TABLE `wei_hezi` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `name` longtext,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wei_hezi
-- ----------------------------
INSERT INTO `wei_hezi` VALUES ('2', '2', '测试');

-- ----------------------------
-- Table structure for wei_hezidtl
-- ----------------------------
DROP TABLE IF EXISTS `wei_hezidtl`;
CREATE TABLE `wei_hezidtl` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `hid` int(11) DEFAULT NULL,
  `url` longtext,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wei_hezidtl
-- ----------------------------
INSERT INTO `wei_hezidtl` VALUES ('5', '2', '2', 'asdfasdfasdf');

-- ----------------------------
-- Table structure for wei_hezishipin
-- ----------------------------
DROP TABLE IF EXISTS `wei_hezishipin`;
CREATE TABLE `wei_hezishipin` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `hid` int(11) NOT NULL,
  `vid` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wei_hezishipin
-- ----------------------------
INSERT INTO `wei_hezishipin` VALUES ('37', '2', '2', '93', '2019-07-23 01:49:44');

-- ----------------------------
-- Table structure for wei_image
-- ----------------------------
DROP TABLE IF EXISTS `wei_image`;
CREATE TABLE `wei_image` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `image` longtext,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wei_image
-- ----------------------------
INSERT INTO `wei_image` VALUES ('1', '/editor/php/../../uploadfile/file/20190922/20190922135439_38109.jpg');
INSERT INTO `wei_image` VALUES ('2', '/editor/php/../../uploadfile/file/20190922/20190922135449_33519.jpg');
INSERT INTO `wei_image` VALUES ('4', '/editor/php/../../uploadfile/file/20190922/20190922135723_29929.jpg');
INSERT INTO `wei_image` VALUES ('5', '/editor/php/../../uploadfile/file/20190922/20190922135735_77221.jpg');

-- ----------------------------
-- Table structure for wei_kouliang
-- ----------------------------
DROP TABLE IF EXISTS `wei_kouliang`;
CREATE TABLE `wei_kouliang` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `num` double DEFAULT NULL,
  `nums` double DEFAULT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wei_kouliang
-- ----------------------------
INSERT INTO `wei_kouliang` VALUES ('66', '2', '3', '1', '0');

-- ----------------------------
-- Table structure for wei_kouliangorder
-- ----------------------------
DROP TABLE IF EXISTS `wei_kouliangorder`;
CREATE TABLE `wei_kouliangorder` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `dingdanhao` longtext,
  `laiyuan` longtext,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wei_kouliangorder
-- ----------------------------

-- ----------------------------
-- Table structure for wei_log
-- ----------------------------
DROP TABLE IF EXISTS `wei_log`;
CREATE TABLE `wei_log` (
  `l_name` varchar(255) DEFAULT NULL,
  `l_qk` longtext,
  `l_ip` varchar(255) DEFAULT NULL,
  `l_date` datetime DEFAULT NULL,
  `f_id` int(11) NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wei_log
-- ----------------------------
INSERT INTO `wei_log` VALUES ('josha', '用户【josha】登录成功	', '27.155.55.245', '2019-07-10 16:25:10', '0', '1');
INSERT INTO `wei_log` VALUES ('josha', '用户【josha】登录成功	', '183.253.216.107', '2019-07-10 17:10:24', '0', '2');
INSERT INTO `wei_log` VALUES ('josha', '用户【josha】登录成功	', '183.253.216.107', '2019-07-10 19:39:05', '0', '3');
INSERT INTO `wei_log` VALUES ('josha', '用户【josha】登录成功	', '183.253.216.107', '2019-07-10 20:01:00', '0', '4');
INSERT INTO `wei_log` VALUES ('josha', '用户【josha】登录成功	', '223.73.208.62', '2019-07-10 20:13:25', '0', '5');
INSERT INTO `wei_log` VALUES ('josha', '用户【josha】登录成功	', '183.253.216.107', '2019-07-10 21:04:48', '0', '6');
INSERT INTO `wei_log` VALUES ('josha', '用户【josha】登录成功	', '183.253.216.107', '2019-07-10 22:03:44', '0', '7');
INSERT INTO `wei_log` VALUES ('josha', '用户【josha】登录成功	', '183.253.216.107', '2019-07-11 00:53:08', '0', '8');
INSERT INTO `wei_log` VALUES ('josha', '用户【josha】登录成功	', '223.73.208.62', '2019-07-11 00:57:59', '0', '9');
INSERT INTO `wei_log` VALUES ('josha', '用户【josha】登录成功	', '175.43.244.244', '2019-07-11 17:08:55', '0', '10');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '118.113.21.236', '2019-07-23 00:48:50', '0', '11');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '118.113.21.236', '2019-07-23 01:39:58', '0', '12');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '112.115.18.53', '2019-07-28 23:58:03', '0', '13');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '123.52.207.49', '2019-07-29 01:52:11', '0', '14');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '116.249.100.30', '2019-08-03 03:20:18', '0', '15');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '112.115.18.119', '2019-08-06 22:15:17', '0', '16');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '114.234.16.68', '2019-08-10 01:11:13', '0', '17');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '106.57.77.66', '2019-08-10 15:21:40', '0', '18');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '49.68.182.149', '2019-08-14 19:17:48', '0', '19');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '117.153.41.129', '2019-09-22 08:33:05', '0', '20');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '221.1.98.30', '2019-09-22 08:36:21', '0', '21');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '221.1.98.30', '2019-09-22 08:39:25', '0', '22');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '221.1.98.30', '2019-09-22 08:45:45', '0', '23');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '221.1.98.30', '2019-09-22 08:53:01', '0', '24');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '117.153.41.129', '2019-09-22 09:18:54', '0', '25');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '221.1.98.30', '2019-09-22 10:07:54', '0', '26');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '221.1.98.30', '2019-09-22 10:09:15', '0', '27');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '221.1.98.30', '2019-09-22 12:45:37', '0', '28');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '223.104.185.124', '2019-09-22 12:51:33', '0', '29');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '221.1.98.30', '2019-09-22 13:30:30', '0', '30');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '221.1.98.30', '2019-09-22 13:45:39', '0', '31');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '221.1.98.30', '2019-09-22 13:52:55', '0', '32');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '182.109.252.128', '2019-09-22 14:14:02', '0', '33');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '117.164.152.69', '2019-09-22 16:41:57', '0', '34');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '117.164.152.69', '2019-09-22 16:56:22', '0', '35');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '223.104.185.124', '2019-09-22 17:14:44', '0', '36');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '117.164.152.69', '2019-09-22 17:17:22', '0', '37');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '223.104.185.124', '2019-09-22 17:17:42', '0', '38');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '223.104.185.124', '2019-09-22 17:32:54', '0', '39');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '223.104.185.124', '2019-09-22 17:47:59', '0', '40');
INSERT INTO `wei_log` VALUES ('admin', '用户【admin】登录成功	', '119.1.2.197', '2019-10-31 12:40:39', '0', '41');

-- ----------------------------
-- Table structure for wei_order
-- ----------------------------
DROP TABLE IF EXISTS `wei_order`;
CREATE TABLE `wei_order` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `dingdanhao` longtext,
  `vid` int(11) DEFAULT NULL,
  `uid` int(11) NOT NULL,
  `ip` longtext,
  `vprice` double DEFAULT NULL,
  `payprice` double DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `pdate` datetime DEFAULT NULL,
  `jiaoyihao` longtext NOT NULL,
  `zt` int(11) NOT NULL,
  `kouliang` int(11) DEFAULT '0',
  `kl` int(11) DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wei_order
-- ----------------------------
INSERT INTO `wei_order` VALUES ('1', '2019071019180280876', '7', '2', '223.73.208.62', '1', null, '2019-07-10 19:18:03', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('2', '2019071019182449828', '17', '2', '140.243.221.114', '1', null, '2019-07-10 19:18:25', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('3', '', '17', '2', '101.89.19.197', '1', null, '2019-07-10 19:19:26', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('4', '2019071019330474757', '15', '2', '140.243.221.114', '1', null, '2019-07-10 19:33:04', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('5', '2019071019330470681', '11', '2', '223.73.208.62', '1', null, '2019-07-10 19:33:05', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('6', '2019071019342589688', '5', '2', '223.73.208.62', '1', null, '2019-07-10 19:34:26', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('7', '2019071019343172916', '6', '2', '223.73.208.62', '1', null, '2019-07-10 19:34:32', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('8', '2019071019362647885', '6', '2', '223.73.208.62', '1', null, '2019-07-10 19:36:26', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('9', '2019071019394841522', '5', '2', '140.243.221.114', '1', null, '2019-07-10 19:39:48', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('10', '2019071019395519340', '14', '2', '140.243.221.114', '1', null, '2019-07-10 19:39:55', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('11', '2019071019433044012', '11', '2', '140.243.221.114', '1', '1.17', '2019-07-10 19:43:31', '2019-07-10 19:44:00', '10156275903260888008229790200312', '1', '1', '0');
INSERT INTO `wei_order` VALUES ('22', '2019071020180288477', '15', '2', '223.73.208.62', '1', null, '2019-07-10 20:18:02', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('25', '2019071020193770403', '43', '4', '211.97.131.166', '1', null, '2019-07-10 20:19:38', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('26', '2019071020232110677', '20', '3', '183.253.216.107', '1', null, '2019-07-10 20:23:21', null, '', '0', '0', '0');
INSERT INTO `wei_order` VALUES ('29', '2019071020244282624', '40', '4', '183.253.216.107', '1', null, '2019-07-10 20:24:42', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('30', '2019071020245239749', '8', '2', '223.73.208.62', '1', null, '2019-07-10 20:24:52', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('32', '2019071020272363233', '47', '4', '211.97.131.166', '1', null, '2019-07-10 20:27:23', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('33', '2019071020275362503', '47', '4', '211.97.131.166', '1', null, '2019-07-10 20:27:53', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('34', '2019071020311880405', '40', '4', '211.97.131.166', '1', null, '2019-07-10 20:31:18', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('35', '2019071020312219024', '41', '4', '140.243.221.114', '1', null, '2019-07-10 20:31:22', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('36', '2019071020315536033', '40', '4', '211.97.131.166', '1', null, '2019-07-10 20:31:55', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('37', '2019071020320144462', '41', '4', '140.243.221.114', '1', null, '2019-07-10 20:32:01', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('38', '2019071020324901736', '15', '2', '223.73.208.62', '1', null, '2019-07-10 20:32:49', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('39', '2019071020330986861', '15', '2', '223.73.208.62', '1', null, '2019-07-10 20:33:09', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('40', '2019071020424798935', '13', '2', '223.73.208.62', '1', null, '2019-07-10 20:42:47', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('41', '2019071020433393725', '14', '2', '140.243.221.114', '1', null, '2019-07-10 20:43:33', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('42', '2019071020442408247', '16', '2', '223.73.208.62', '1', null, '2019-07-10 20:44:24', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('43', '2019071020470780451', '5', '2', '140.243.221.114', '1', null, '2019-07-10 20:47:07', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('44', '2019071020483590363', '15', '2', '223.73.208.62', '1', null, '2019-07-10 20:48:35', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('45', '2019071020485407064', '15', '2', '223.73.208.62', '1', null, '2019-07-10 20:48:54', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('48', '2019071021041275743', '5', '2', '223.73.208.62', '1', null, '2019-07-10 21:04:12', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('51', '2019071021064253769', '37', '4', '211.97.131.166', '1', null, '2019-07-10 21:06:42', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('52', '2019071021205143357', '23', '3', '122.97.174.1', '1', null, '2019-07-10 21:20:52', null, '', '0', '0', '0');
INSERT INTO `wei_order` VALUES ('53', '2019071021211935803', '32', '3', '122.97.174.1', '1', null, '2019-07-10 21:21:19', null, '', '0', '0', '0');
INSERT INTO `wei_order` VALUES ('54', '2019071021212622480', '28', '3', '122.97.174.1', '1', null, '2019-07-10 21:21:26', null, '', '0', '0', '0');
INSERT INTO `wei_order` VALUES ('55', '2019071021214929481', '26', '3', '122.97.174.1', '1', null, '2019-07-10 21:21:49', null, '', '0', '0', '0');
INSERT INTO `wei_order` VALUES ('56', '2019071021502858865', '37', '4', '112.48.22.60', '1', null, '2019-07-10 21:50:28', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('57', '2019071021504832657', '37', '4', '112.48.22.60', '1', null, '2019-07-10 21:50:52', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('58', '2019071021511574862', '37', '4', '112.48.22.60', '1', null, '2019-07-10 21:51:16', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('64', '2019071023111272265', '40', '4', '140.243.30.213', '1', null, '2019-07-10 23:11:13', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('65', '2019071101112416984', '42', '4', '140.243.58.157', '1', null, '2019-07-11 01:11:24', null, '', '0', '0', '0');
INSERT INTO `wei_order` VALUES ('68', '2019071101154781343', '43', '4', '140.243.58.157', '1', null, '2019-07-11 01:15:48', null, '', '0', '0', '0');
INSERT INTO `wei_order` VALUES ('69', '2019071220375409624', '16', '2', '175.43.245.187', '1', null, '2019-07-12 20:37:54', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('70', '2019071220380746308', '16', '2', '175.43.245.187', '1', null, '2019-07-12 20:38:07', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('71', '2019072301472611924', '81', '2', '101.206.171.135', '1', null, '2019-07-23 01:47:26', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('72', '2019072301473957914', '75', '2', '101.206.171.135', '1', null, '2019-07-23 01:47:40', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('73', '2019072301502133397', '93', '2', '101.206.171.135', '1', null, '2019-07-23 01:50:22', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('74', '2019072301505619107', '93', '2', '101.206.171.135', '1', null, '2019-07-23 01:50:56', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('75', '2019072301570321305', '93', '2', '101.206.171.135', '1', null, '2019-07-23 01:57:03', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('76', '2019072301574703876', '93', '2', '101.206.171.135', '1', null, '2019-07-23 01:57:48', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('77', '2019072301585979599', '93', '2', '101.206.171.135', '1', null, '2019-07-23 01:59:00', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('78', '2019072302045010090', '93', '2', '101.206.171.135', '1', null, '2019-07-23 02:04:50', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('79', '2019072302074877354', '93', '2', '101.206.171.135', '1', null, '2019-07-23 02:07:49', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('80', '2019072302075625117', '93', '2', '101.206.171.135', '1', null, '2019-07-23 02:07:57', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('81', '2019072317240980413', '93', '2', '101.206.169.20', '1', null, '2019-07-23 17:24:11', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('82', '2019072317245219733', '93', '2', '101.206.169.20', '1', null, '2019-07-23 17:24:53', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('83', '2019072317282759112', '93', '2', '101.206.169.20', '1', null, '2019-07-23 17:28:28', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('84', '2019072317321184251', '93', '2', '124.116.224.125', '1', null, '2019-07-23 17:32:11', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('85', '2019072317323282728', '93', '2', '124.116.224.125', '1', null, '2019-07-23 17:32:32', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('86', '2019072317330614986', '93', '2', '124.116.224.125', '1', null, '2019-07-23 17:33:07', null, '', '0', '1', '0');
INSERT INTO `wei_order` VALUES ('87', '2019092213450862364', '95', '2', '221.1.98.30', '1', null, '2019-09-22 13:45:10', null, '', '0', '0', '0');
INSERT INTO `wei_order` VALUES ('88', '2019092213451597849', '95', '2', '221.1.98.30', '1', null, '2019-09-22 13:45:15', null, '', '0', '0', '0');
INSERT INTO `wei_order` VALUES ('89', '2019092215322953030', '97', '2', '221.1.98.30', '3', null, '2019-09-22 15:32:30', null, '', '0', '0', '0');
INSERT INTO `wei_order` VALUES ('90', '2019092215323450366', '97', '2', '221.1.98.30', '3', null, '2019-09-22 15:32:34', null, '', '0', '0', '0');
INSERT INTO `wei_order` VALUES ('91', '2019092217440347824', '96', '2', '112.96.240.239', '3', null, '2019-09-22 17:44:04', null, '', '0', '0', '0');
INSERT INTO `wei_order` VALUES ('92', '2019092217443263431', '96', '2', '112.96.240.239', '3', null, '2019-09-22 17:44:32', null, '', '0', '0', '0');
INSERT INTO `wei_order` VALUES ('93', '2019092218094746821', '97', '2', '117.164.152.69', '3', null, '2019-09-22 18:09:48', null, '', '0', '0', '0');
INSERT INTO `wei_order` VALUES ('94', '2019092218095810826', '97', '2', '117.164.152.69', '3', null, '2019-09-22 18:09:58', null, '', '0', '0', '0');
INSERT INTO `wei_order` VALUES ('95', '2019092218095918671', '97', '2', '117.164.152.69', '3', null, '2019-09-22 18:09:59', null, '', '0', '0', '0');
INSERT INTO `wei_order` VALUES ('96', '2019092218095972482', '97', '2', '117.164.152.69', '3', null, '2019-09-22 18:10:00', null, '', '0', '0', '0');

-- ----------------------------
-- Table structure for wei_rmbjl
-- ----------------------------
DROP TABLE IF EXISTS `wei_rmbjl`;
CREATE TABLE `wei_rmbjl` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `qje` double DEFAULT NULL,
  `je` double DEFAULT NULL,
  `hje` double DEFAULT NULL,
  `remark` longtext,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wei_rmbjl
-- ----------------------------
INSERT INTO `wei_rmbjl` VALUES ('1', '1', '2', '0', '1.17', '1.17', '用户打赏|金额:1.17|资源ID:11', '2019-07-10 19:44:00');
INSERT INTO `wei_rmbjl` VALUES ('2', '1', '2', '1.17', '1.92', '3.09', '用户打赏|金额:1.92|资源ID:5', '2019-07-10 19:48:15');
INSERT INTO `wei_rmbjl` VALUES ('3', '1', '3', '0', '1', '1', '用户打赏|金额:1|资源ID:31', '2019-07-10 19:57:15');
INSERT INTO `wei_rmbjl` VALUES ('4', '1', '3', '1', '1', '2', '用户打赏|金额:1|资源ID:23', '2019-07-10 20:02:04');
INSERT INTO `wei_rmbjl` VALUES ('5', '1', '3', '2', '1', '3', '用户打赏|金额:1|资源ID:28', '2019-07-10 20:04:57');
INSERT INTO `wei_rmbjl` VALUES ('6', '1', '3', '3', '1', '4', '用户打赏|金额:1|资源ID:28', '2019-07-10 20:05:36');
INSERT INTO `wei_rmbjl` VALUES ('7', '1', '3', '4', '1', '5', '用户打赏|金额:1|资源ID:27', '2019-07-10 20:09:17');
INSERT INTO `wei_rmbjl` VALUES ('8', '1', '3', '5', '1', '6', '用户打赏|金额:1|资源ID:27', '2019-07-10 20:09:40');
INSERT INTO `wei_rmbjl` VALUES ('9', '1', '3', '6', '1', '7', '用户打赏|金额:1|资源ID:21', '2019-07-10 20:11:38');
INSERT INTO `wei_rmbjl` VALUES ('10', '1', '4', '0', '1', '1', '用户打赏|金额:1|资源ID:43', '2019-07-10 20:19:17');
INSERT INTO `wei_rmbjl` VALUES ('11', '1', '4', '1', '1', '2', '用户打赏|金额:1|资源ID:43', '2019-07-10 20:19:37');
INSERT INTO `wei_rmbjl` VALUES ('12', '1', '4', '2', '1', '3', '用户打赏|金额:1|资源ID:47', '2019-07-10 21:01:12');
INSERT INTO `wei_rmbjl` VALUES ('13', '1', '2', '3.09', '1', '4.09', '用户打赏|金额:1|资源ID:5', '2019-07-10 21:04:14');
INSERT INTO `wei_rmbjl` VALUES ('14', '1', '4', '3', '1', '4', '用户打赏|金额:1|资源ID:33', '2019-07-10 21:05:19');
INSERT INTO `wei_rmbjl` VALUES ('15', '1', '4', '4', '1', '5', '用户打赏|金额:1|资源ID:37', '2019-07-10 21:06:42');
INSERT INTO `wei_rmbjl` VALUES ('16', '1', '4', '5', '1', '6', '用户打赏|金额:1|资源ID:36', '2019-07-10 22:00:18');
INSERT INTO `wei_rmbjl` VALUES ('17', '1', '4', '6', '1', '7', '用户打赏|金额:1|资源ID:40', '2019-07-10 22:05:14');
INSERT INTO `wei_rmbjl` VALUES ('18', '1', '4', '7', '1', '8', '用户打赏|金额:1|资源ID:43', '2019-07-10 22:08:08');
INSERT INTO `wei_rmbjl` VALUES ('19', '1', '2', '4.09', '1', '5.09', '用户打赏|金额:1|资源ID:7', '2019-07-10 22:11:56');
INSERT INTO `wei_rmbjl` VALUES ('20', '1', '2', '5.09', '1', '6.09', '用户打赏|金额:1|资源ID:9', '2019-07-10 22:12:46');

-- ----------------------------
-- Table structure for wei_rukoudomain
-- ----------------------------
DROP TABLE IF EXISTS `wei_rukoudomain`;
CREATE TABLE `wei_rukoudomain` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext,
  `zt` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=290 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wei_rukoudomain
-- ----------------------------
INSERT INTO `wei_rukoudomain` VALUES ('289', 'ys7.bc2022.cn', '0');

-- ----------------------------
-- Table structure for wei_shikan
-- ----------------------------
DROP TABLE IF EXISTS `wei_shikan`;
CREATE TABLE `wei_shikan` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ip` longtext,
  `vid` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wei_shikan
-- ----------------------------

-- ----------------------------
-- Table structure for wei_shipin
-- ----------------------------
DROP TABLE IF EXISTS `wei_shipin`;
CREATE TABLE `wei_shipin` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `name` longtext,
  `image` longtext,
  `url` longtext,
  `color` longtext,
  `font` longtext,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wei_shipin
-- ----------------------------
INSERT INTO `wei_shipin` VALUES ('64', '21', '0', '女大学生援交实行跪式服务，像狗一样蹲着给我舔鸡巴', 'http://144496.com:2100/20190617/XnT8deov/1.jpg', 'http://144496.com:2100/20190617/XnT8deov/index.m3u8', '', '', '2019-07-23 01:45:49');
INSERT INTO `wei_shipin` VALUES ('66', '28', '0', '現役女教師美女幹砲自拍初體驗', 'https://img.dadiziyuan.net/upload/vod/2019-02-18/155048199912.jpg\\r', 'https://dadi-yun.com/20190217/471_c42aee49/index.m3u8', '', '', '2019-09-22 13:43:13');
INSERT INTO `wei_shipin` VALUES ('67', '28', '0', '心跳不已 我女友最愛料理跟幹砲 川島愛奈', 'https://img.dadiziyuan.net/upload/vod/2019-02-18/155048197919.jpg\\r', 'https://dadi-yun.com/20190217/441_acf415aa/index.m3u8', '', '', '2019-09-22 13:47:13');

-- ----------------------------
-- Table structure for wei_system
-- ----------------------------
DROP TABLE IF EXISTS `wei_system`;
CREATE TABLE `wei_system` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `s_userupload` int(11) DEFAULT NULL,
  `s_pc` int(11) DEFAULT NULL,
  `s_suiji` int(11) DEFAULT '0',
  `s_api` longtext,
  `s_mintxje` double DEFAULT NULL,
  `s_maxtxje` double DEFAULT NULL,
  `s_maxtxcs` int(11) DEFAULT NULL,
  `s_txsxf` double DEFAULT NULL,
  `s_name` longtext,
  `s_sname` longtext,
  `s_content` longtext,
  `s_domain` longtext,
  `s_domains` longtext,
  `s_tzdomain1` longtext,
  `s_tzdomain2` longtext,
  `s_tzdomain3` longtext,
  `s_tzdomain4` longtext,
  `s_tzdomain5` longtext,
  `s_tzdomain6` longtext,
  `s_tzdomain7` longtext,
  `s_tzdomain8` longtext,
  `s_tzdomain9` longtext,
  `s_tzdomain10` longtext,
  `s_hezi` int(11) DEFAULT NULL,
  `s_fangfengurl` longtext,
  `s_tichengset` int(11) DEFAULT NULL,
  `s_morenticheng` double DEFAULT NULL,
  `s_banben` double DEFAULT NULL,
  `s_dingshi` int(11) DEFAULT NULL,
  `s_tzweiba` longtext,
  `s_notice` longtext,
  `s_dailiprice` decimal(8,2) NOT NULL,
  `s_wapnotice` longtext,
  `s_ad_open` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wei_system
-- ----------------------------
INSERT INTO `wei_system` VALUES ('1', '1', '1', '1', 'urlcn', '100', '100000', '4', '25', '推广中心', '推广中心', '1', 'www.youhutong.com', '1', '10.com', '10.com', '11.com', '22.5u7sqi.top', '13.com', '14.com', '2.pp0176p.cn', 'q.pp0174p.cn', '2.pp0172p.cn', '2.pp0169p.cn', '1', 'from=qqllq&to=wx&pid=yszt.html', '0', '5', '3', '0', '123123', '<p>\r\n	<span style=\"font-size:32px;background-color:#E53333;\"><b>稳定上量！及时更新！</b></span> \r\n</p>', '10.00', '1\r\n', '0');

-- ----------------------------
-- Table structure for wei_tousu
-- ----------------------------
DROP TABLE IF EXISTS `wei_tousu`;
CREATE TABLE `wei_tousu` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `sid` int(11) DEFAULT NULL,
  `type` longtext,
  `content` longtext,
  `ip` longtext,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wei_tousu
-- ----------------------------

-- ----------------------------
-- Table structure for wei_tpl
-- ----------------------------
DROP TABLE IF EXISTS `wei_tpl`;
CREATE TABLE `wei_tpl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tpl_id` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=209 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of wei_tpl
-- ----------------------------
INSERT INTO `wei_tpl` VALUES ('1', '02', '4');
INSERT INTO `wei_tpl` VALUES ('2', '02', '4');
INSERT INTO `wei_tpl` VALUES ('3', '01', '40');
INSERT INTO `wei_tpl` VALUES ('4', '06', '41');
INSERT INTO `wei_tpl` VALUES ('5', '01', '71');
INSERT INTO `wei_tpl` VALUES ('6', '01', '81');
INSERT INTO `wei_tpl` VALUES ('7', '02', '80');
INSERT INTO `wei_tpl` VALUES ('8', '04', '79');
INSERT INTO `wei_tpl` VALUES ('9', '01', '90');
INSERT INTO `wei_tpl` VALUES ('10', '02', '75');
INSERT INTO `wei_tpl` VALUES ('11', '01', '124');
INSERT INTO `wei_tpl` VALUES ('12', '01', '134');
INSERT INTO `wei_tpl` VALUES ('13', '01', '130');
INSERT INTO `wei_tpl` VALUES ('14', '03', '138');
INSERT INTO `wei_tpl` VALUES ('15', '02', '135');
INSERT INTO `wei_tpl` VALUES ('16', '02', '133');
INSERT INTO `wei_tpl` VALUES ('17', '02', '144');
INSERT INTO `wei_tpl` VALUES ('18', '04', '118');
INSERT INTO `wei_tpl` VALUES ('19', '04', '153');
INSERT INTO `wei_tpl` VALUES ('20', '03', '158');
INSERT INTO `wei_tpl` VALUES ('21', '01', '160');
INSERT INTO `wei_tpl` VALUES ('22', '04', '163');
INSERT INTO `wei_tpl` VALUES ('23', '01', '164');
INSERT INTO `wei_tpl` VALUES ('24', '01', '161');
INSERT INTO `wei_tpl` VALUES ('25', '02', '165');
INSERT INTO `wei_tpl` VALUES ('26', '04', '73');
INSERT INTO `wei_tpl` VALUES ('27', '01', '70');
INSERT INTO `wei_tpl` VALUES ('28', '01', '175');
INSERT INTO `wei_tpl` VALUES ('29', '04', '197');
INSERT INTO `wei_tpl` VALUES ('30', '04', '177');
INSERT INTO `wei_tpl` VALUES ('31', '01', '211');
INSERT INTO `wei_tpl` VALUES ('32', '01', '213');
INSERT INTO `wei_tpl` VALUES ('33', '04', '113');
INSERT INTO `wei_tpl` VALUES ('34', '02', '206');
INSERT INTO `wei_tpl` VALUES ('35', '01', '237');
INSERT INTO `wei_tpl` VALUES ('36', '04', '236');
INSERT INTO `wei_tpl` VALUES ('37', '02', '235');
INSERT INTO `wei_tpl` VALUES ('38', '01', '256');
INSERT INTO `wei_tpl` VALUES ('39', '02', '257');
INSERT INTO `wei_tpl` VALUES ('40', '02', '261');
INSERT INTO `wei_tpl` VALUES ('41', '01', '260');
INSERT INTO `wei_tpl` VALUES ('42', '01', '274');
INSERT INTO `wei_tpl` VALUES ('43', '08', '131');
INSERT INTO `wei_tpl` VALUES ('44', '01', '98');
INSERT INTO `wei_tpl` VALUES ('45', '03', '84');
INSERT INTO `wei_tpl` VALUES ('46', '01', '233');
INSERT INTO `wei_tpl` VALUES ('47', '04', '87');
INSERT INTO `wei_tpl` VALUES ('48', '02', '280');
INSERT INTO `wei_tpl` VALUES ('49', '03', '265');
INSERT INTO `wei_tpl` VALUES ('50', '03', '246');
INSERT INTO `wei_tpl` VALUES ('51', '04', '290');
INSERT INTO `wei_tpl` VALUES ('52', '01', '95');
INSERT INTO `wei_tpl` VALUES ('53', '08', '184');
INSERT INTO `wei_tpl` VALUES ('54', '04', '292');
INSERT INTO `wei_tpl` VALUES ('55', '01', '293');
INSERT INTO `wei_tpl` VALUES ('56', '02', '295');
INSERT INTO `wei_tpl` VALUES ('57', '02', '297');
INSERT INTO `wei_tpl` VALUES ('58', '05', '302');
INSERT INTO `wei_tpl` VALUES ('59', '01', '303');
INSERT INTO `wei_tpl` VALUES ('60', '01', '316');
INSERT INTO `wei_tpl` VALUES ('61', '01', '326');
INSERT INTO `wei_tpl` VALUES ('62', '03', '331');
INSERT INTO `wei_tpl` VALUES ('63', '02', '328');
INSERT INTO `wei_tpl` VALUES ('64', '08', '223');
INSERT INTO `wei_tpl` VALUES ('65', '01', '72');
INSERT INTO `wei_tpl` VALUES ('66', '08', '340');
INSERT INTO `wei_tpl` VALUES ('67', '04', '344');
INSERT INTO `wei_tpl` VALUES ('68', '02', '103');
INSERT INTO `wei_tpl` VALUES ('69', '03', '350');
INSERT INTO `wei_tpl` VALUES ('70', '02', '351');
INSERT INTO `wei_tpl` VALUES ('71', '01', '307');
INSERT INTO `wei_tpl` VALUES ('72', '02', '337');
INSERT INTO `wei_tpl` VALUES ('73', '02', '352');
INSERT INTO `wei_tpl` VALUES ('74', '02', '338');
INSERT INTO `wei_tpl` VALUES ('75', '02', '354');
INSERT INTO `wei_tpl` VALUES ('76', '05', '108');
INSERT INTO `wei_tpl` VALUES ('77', '01', '346');
INSERT INTO `wei_tpl` VALUES ('78', '06', '291');
INSERT INTO `wei_tpl` VALUES ('79', '01', '358');
INSERT INTO `wei_tpl` VALUES ('80', '02', '377');
INSERT INTO `wei_tpl` VALUES ('81', '02', '216');
INSERT INTO `wei_tpl` VALUES ('82', '04', '185');
INSERT INTO `wei_tpl` VALUES ('83', '08', '323');
INSERT INTO `wei_tpl` VALUES ('84', '01', '385');
INSERT INTO `wei_tpl` VALUES ('85', '01', '389');
INSERT INTO `wei_tpl` VALUES ('86', '01', '78');
INSERT INTO `wei_tpl` VALUES ('87', '02', '353');
INSERT INTO `wei_tpl` VALUES ('88', '04', '117');
INSERT INTO `wei_tpl` VALUES ('89', '04', '194');
INSERT INTO `wei_tpl` VALUES ('90', '03', '101');
INSERT INTO `wei_tpl` VALUES ('91', '03', '218');
INSERT INTO `wei_tpl` VALUES ('92', '02', '403');
INSERT INTO `wei_tpl` VALUES ('93', '01', '414');
INSERT INTO `wei_tpl` VALUES ('94', '08', '183');
INSERT INTO `wei_tpl` VALUES ('95', '01', '419');
INSERT INTO `wei_tpl` VALUES ('96', '02', '423');
INSERT INTO `wei_tpl` VALUES ('97', '02', '232');
INSERT INTO `wei_tpl` VALUES ('98', '01', '425');
INSERT INTO `wei_tpl` VALUES ('99', '01', '427');
INSERT INTO `wei_tpl` VALUES ('100', '01', '429');
INSERT INTO `wei_tpl` VALUES ('101', '04', '434');
INSERT INTO `wei_tpl` VALUES ('102', '02', '445');
INSERT INTO `wei_tpl` VALUES ('103', '04', '448');
INSERT INTO `wei_tpl` VALUES ('104', '04', '449');
INSERT INTO `wei_tpl` VALUES ('105', '01', '420');
INSERT INTO `wei_tpl` VALUES ('106', '08', '455');
INSERT INTO `wei_tpl` VALUES ('107', '08', '457');
INSERT INTO `wei_tpl` VALUES ('108', '02', '456');
INSERT INTO `wei_tpl` VALUES ('109', '02', '179');
INSERT INTO `wei_tpl` VALUES ('110', '01', '469');
INSERT INTO `wei_tpl` VALUES ('111', '02', '468');
INSERT INTO `wei_tpl` VALUES ('112', '01', '96');
INSERT INTO `wei_tpl` VALUES ('113', '04', '416');
INSERT INTO `wei_tpl` VALUES ('114', '01', '482');
INSERT INTO `wei_tpl` VALUES ('115', '01', '91');
INSERT INTO `wei_tpl` VALUES ('116', '02', '443');
INSERT INTO `wei_tpl` VALUES ('117', '01', '137');
INSERT INTO `wei_tpl` VALUES ('118', '01', '494');
INSERT INTO `wei_tpl` VALUES ('119', '02', '498');
INSERT INTO `wei_tpl` VALUES ('120', '02', '1');
INSERT INTO `wei_tpl` VALUES ('121', '02', '17');
INSERT INTO `wei_tpl` VALUES ('122', '04', '7');
INSERT INTO `wei_tpl` VALUES ('123', '01', '61');
INSERT INTO `wei_tpl` VALUES ('124', '02', '39');
INSERT INTO `wei_tpl` VALUES ('125', '02', '19');
INSERT INTO `wei_tpl` VALUES ('126', '02', '16');
INSERT INTO `wei_tpl` VALUES ('127', '03', '54');
INSERT INTO `wei_tpl` VALUES ('128', '04', '18');
INSERT INTO `wei_tpl` VALUES ('129', '02', '68');
INSERT INTO `wei_tpl` VALUES ('130', '04', '8');
INSERT INTO `wei_tpl` VALUES ('131', '01', '49');
INSERT INTO `wei_tpl` VALUES ('132', '01', '42');
INSERT INTO `wei_tpl` VALUES ('133', '04', '76');
INSERT INTO `wei_tpl` VALUES ('134', '02', '83');
INSERT INTO `wei_tpl` VALUES ('135', '01', '45');
INSERT INTO `wei_tpl` VALUES ('136', '08', '58');
INSERT INTO `wei_tpl` VALUES ('137', '04', '13');
INSERT INTO `wei_tpl` VALUES ('138', '01', '65');
INSERT INTO `wei_tpl` VALUES ('139', '04', '34');
INSERT INTO `wei_tpl` VALUES ('140', '01', '102');
INSERT INTO `wei_tpl` VALUES ('141', '04', '107');
INSERT INTO `wei_tpl` VALUES ('142', '02', '109');
INSERT INTO `wei_tpl` VALUES ('143', '02', '60');
INSERT INTO `wei_tpl` VALUES ('144', '02', '53');
INSERT INTO `wei_tpl` VALUES ('145', '04', '10');
INSERT INTO `wei_tpl` VALUES ('146', '05', '122');
INSERT INTO `wei_tpl` VALUES ('147', '02', '120');
INSERT INTO `wei_tpl` VALUES ('148', '01', '126');
INSERT INTO `wei_tpl` VALUES ('149', '04', '9');
INSERT INTO `wei_tpl` VALUES ('150', '02', '15');
INSERT INTO `wei_tpl` VALUES ('151', '05', '36');
INSERT INTO `wei_tpl` VALUES ('152', '06', '88');
INSERT INTO `wei_tpl` VALUES ('153', '01', '128');
INSERT INTO `wei_tpl` VALUES ('154', '04', '55');
INSERT INTO `wei_tpl` VALUES ('155', '04', '106');
INSERT INTO `wei_tpl` VALUES ('156', '01', '67');
INSERT INTO `wei_tpl` VALUES ('157', '08', '132');
INSERT INTO `wei_tpl` VALUES ('158', '02', '139');
INSERT INTO `wei_tpl` VALUES ('159', '04', '123');
INSERT INTO `wei_tpl` VALUES ('160', '01', '50');
INSERT INTO `wei_tpl` VALUES ('161', '02', '20');
INSERT INTO `wei_tpl` VALUES ('162', '04', '21');
INSERT INTO `wei_tpl` VALUES ('163', '04', '127');
INSERT INTO `wei_tpl` VALUES ('164', '04', '143');
INSERT INTO `wei_tpl` VALUES ('165', '04', '145');
INSERT INTO `wei_tpl` VALUES ('166', '02', '47');
INSERT INTO `wei_tpl` VALUES ('167', '01', '51');
INSERT INTO `wei_tpl` VALUES ('168', '02', '59');
INSERT INTO `wei_tpl` VALUES ('169', '02', '62');
INSERT INTO `wei_tpl` VALUES ('170', '01', '69');
INSERT INTO `wei_tpl` VALUES ('171', '01', '31');
INSERT INTO `wei_tpl` VALUES ('172', '01', '74');
INSERT INTO `wei_tpl` VALUES ('173', '02', '5');
INSERT INTO `wei_tpl` VALUES ('174', '01', '121');
INSERT INTO `wei_tpl` VALUES ('175', '02', '141');
INSERT INTO `wei_tpl` VALUES ('176', '02', '150');
INSERT INTO `wei_tpl` VALUES ('177', '01', '168');
INSERT INTO `wei_tpl` VALUES ('178', '01', '38');
INSERT INTO `wei_tpl` VALUES ('179', '08', '172');
INSERT INTO `wei_tpl` VALUES ('180', '08', '173');
INSERT INTO `wei_tpl` VALUES ('181', '01', '181');
INSERT INTO `wei_tpl` VALUES ('182', '08', '159');
INSERT INTO `wei_tpl` VALUES ('183', '01', '191');
INSERT INTO `wei_tpl` VALUES ('184', '01', '234');
INSERT INTO `wei_tpl` VALUES ('185', '01', '212');
INSERT INTO `wei_tpl` VALUES ('186', '04', '231');
INSERT INTO `wei_tpl` VALUES ('187', '02', '225');
INSERT INTO `wei_tpl` VALUES ('188', '08', '320');
INSERT INTO `wei_tpl` VALUES ('189', '02', '259');
INSERT INTO `wei_tpl` VALUES ('190', '01', '192');
INSERT INTO `wei_tpl` VALUES ('191', '04', '322');
INSERT INTO `wei_tpl` VALUES ('192', '02', '278');
INSERT INTO `wei_tpl` VALUES ('193', '02', '325');
INSERT INTO `wei_tpl` VALUES ('194', '02', '272');
INSERT INTO `wei_tpl` VALUES ('195', '02', '273');
INSERT INTO `wei_tpl` VALUES ('196', '02', '348');
INSERT INTO `wei_tpl` VALUES ('197', '01', '356');
INSERT INTO `wei_tpl` VALUES ('198', '02', '339');
INSERT INTO `wei_tpl` VALUES ('199', '04', '365');
INSERT INTO `wei_tpl` VALUES ('200', '03', '370');
INSERT INTO `wei_tpl` VALUES ('201', '02', '367');
INSERT INTO `wei_tpl` VALUES ('202', '04', '360');
INSERT INTO `wei_tpl` VALUES ('203', '01', '380');
INSERT INTO `wei_tpl` VALUES ('204', '04', '392');
INSERT INTO `wei_tpl` VALUES ('205', '01', '284');
INSERT INTO `wei_tpl` VALUES ('206', '04', '399');
INSERT INTO `wei_tpl` VALUES ('207', '08', '415');
INSERT INTO `wei_tpl` VALUES ('208', '02', '2');

-- ----------------------------
-- Table structure for wei_tx
-- ----------------------------
DROP TABLE IF EXISTS `wei_tx`;
CREATE TABLE `wei_tx` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `shoukuantu` longtext,
  `shoukuanfs` longtext,
  `shoukuanzh` longtext,
  `shoukuanxm` longtext,
  `rmb` double DEFAULT NULL,
  `sxf` double DEFAULT NULL,
  `zt` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wei_tx
-- ----------------------------

-- ----------------------------
-- Table structure for wei_tx_default
-- ----------------------------
DROP TABLE IF EXISTS `wei_tx_default`;
CREATE TABLE `wei_tx_default` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `shoukuanfs` varchar(255) NOT NULL,
  `shoukuanzh` varchar(255) NOT NULL,
  `shoukuanxm` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of wei_tx_default
-- ----------------------------

-- ----------------------------
-- Table structure for wei_tzurl
-- ----------------------------
DROP TABLE IF EXISTS `wei_tzurl`;
CREATE TABLE `wei_tzurl` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wei_tzurl
-- ----------------------------

-- ----------------------------
-- Table structure for wei_user
-- ----------------------------
DROP TABLE IF EXISTS `wei_user`;
CREATE TABLE `wei_user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` longtext,
  `password` longtext,
  `rmb` double NOT NULL DEFAULT '0',
  `qq` longtext,
  `nickname` longtext,
  `sxf` double DEFAULT '0',
  `skm` longtext,
  `shangji` int(11) DEFAULT NULL,
  `ticheng` double DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wei_user
-- ----------------------------
INSERT INTO `wei_user` VALUES ('2', '1111', '123', '6.09', '1111', null, '0', null, null, '5', '2019-07-10 18:49:35');

-- ----------------------------
-- Table structure for wei_usershipin
-- ----------------------------
DROP TABLE IF EXISTS `wei_usershipin`;
CREATE TABLE `wei_usershipin` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `isdel` int(11) DEFAULT '0',
  `cid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `shipinid` int(11) DEFAULT NULL,
  `vid` int(11) DEFAULT NULL,
  `shikan` int(11) DEFAULT '0',
  `name` longtext,
  `fengmian` longtext,
  `image` longtext,
  `url` longtext,
  `price` double DEFAULT NULL,
  `pv` int(11) DEFAULT '0',
  `ysurl` int(11) DEFAULT NULL,
  `urlcn` longtext,
  `tcn` longtext,
  `date` datetime DEFAULT NULL,
  `max_price` decimal(8,2) NOT NULL,
  `dwzcn` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wei_usershipin
-- ----------------------------
INSERT INTO `wei_usershipin` VALUES ('1', '0', '28', '1', null, '1', '0', '在美国的中国留学生小妹被大屌白人班主任下课后潜规则.mp4', null, 'http://sp.335819.vip:2100/20190709/C32xLB53/1.jpg', 'http://sp.335819.vip:2100/20190709/C32xLB53/index.m3u8', '1', '0', null, null, null, '2019-07-10 16:38:13', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('2', '0', '28', '1', null, '2', '0', '	 在餐馆死角处打炮 眼看四方耳听八方.mp4', null, 'http://sp.335819.vip:2100/20190709/ut3dJ5vO/1.jpg', 'http://sp.335819.vip:2100/20190709/ut3dJ5vO/index.m3u8', '1', '0', null, null, null, '2019-07-10 17:39:25', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('3', '0', '17', '1', null, '3', '0', '再别人家偷干别人的老婆.mp4', null, 'http://sp.335819.vip:2100/20190709/1fkgfJmp/1.jpg', 'http://sp.335819.vip:2100/20190709/1fkgfJmp/index.m3u8', '1', '0', null, null, null, '2019-07-10 17:39:25', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('4', '0', '28', '1', null, '4', '0', '孕妇-美女孕妇轮奸道具插完逼还肛交直接干出屎52分钟.mp4', null, '', 'http://sp.335819.vip:2100/20190709/xRHwvjw5/index.m3u8', '1', '0', null, null, null, '2019-07-10 17:39:25', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('5', '1', '28', '2', null, '1', '0', '在美国的中国留学生小妹被大屌白人班主任下课后潜规则.mp4', null, 'http://sp.335819.vip:2100/20190709/C32xLB53/1.jpg', 'http://sp.335819.vip:2100/20190709/C32xLB53/index.m3u8', '1', '3', null, 'http://url.cn/5VbZ9nH', null, '2019-07-10 19:17:32', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('6', '1', '28', '2', null, '2', '0', '	 在餐馆死角处打炮 眼看四方耳听八方.mp4', null, 'http://sp.335819.vip:2100/20190709/ut3dJ5vO/1.jpg', 'http://sp.335819.vip:2100/20190709/ut3dJ5vO/index.m3u8', '1', '0', null, 'http://url.cn/5HSODj6', null, '2019-07-10 19:17:32', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('7', '1', '17', '2', null, '3', '0', '再别人家偷干别人的老婆.mp4', null, 'http://sp.335819.vip:2100/20190709/1fkgfJmp/1.jpg', 'http://sp.335819.vip:2100/20190709/1fkgfJmp/index.m3u8', '1', '2', null, 'http://url.cn/5r5GlQy', null, '2019-07-10 19:17:32', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('8', '1', '28', '2', null, '4', '0', '孕妇-美女孕妇轮奸道具插完逼还肛交直接干出屎52分钟.mp4', null, '', 'http://sp.335819.vip:2100/20190709/xRHwvjw5/index.m3u8', '1', '1', null, 'http://url.cn/5MMMQTu', null, '2019-07-10 19:17:32', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('9', '1', '21', '2', null, '5', '0', '孕妇，3P孕妇，轮流上，全部射，旁边还有一群人看他们表演 40分51秒长片_baofeng_0.mp4', null, 'http://sp.335819.vip:2100/20190709/AU952Wlb/1.jpg', 'http://sp.335819.vip:2100/20190709/AU952Wlb/index.m3u8', '1', '2', null, 'http://url.cn/58DBUPj', null, '2019-07-10 19:17:32', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('10', '1', '21', '2', null, '6', '0', '约的苗族长腿气质女神，超诱惑，操逼时还教我怎么从后面干才会更爽，30分钟.mp4', null, 'http://sp.335819.vip:2100/20190709/iK5DGFDO/1.jpg', 'http://sp.335819.vip:2100/20190709/iK5DGFDO/index.m3u8', '1', '0', null, 'http://url.cn/5qeLNbE', null, '2019-07-10 19:17:32', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('11', '1', '28', '2', null, '7', '0', '约操主动上门想体验性爱快感娇羞可爱95骚妹纸.mp4', null, 'http://sp.335819.vip:2100/20190709/nHHzsAI9/1.jpg', 'http://sp.335819.vip:2100/20190709/nHHzsAI9/index.m3u8', '1', '2', null, 'http://url.cn/5cVARX3', null, '2019-07-10 19:17:32', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('12', '1', '28', '2', null, '8', '0', ' 援交-韩国父女乱伦援交-女儿享受父爱.mp4', null, 'http://sp.335819.vip:2100/20190709/QokSIYNN/1.jpg', '	http://sp.335819.vip:2100/20190709/QokSIYNN/index.m3u8', '1', '0', null, 'http://url.cn/5KICpaC', null, '2019-07-10 19:17:32', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('13', '1', '28', '2', null, '9', '0', ' 援交-韩国父女乱伦援交-女儿享受父爱.mp4', null, 'http://sp.335819.vip:2100/20190709/QokSIYNN/1.jpg', '	http://sp.335819.vip:2100/20190709/QokSIYNN/index.m3u8', '1', '0', null, 'http://url.cn/5MQl4ee', null, '2019-07-10 19:17:32', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('14', '1', '28', '2', null, '10', '0', '	 援交的大奶正妹海天盛筵也就是这个级别了.mp4', null, 'http://sp.335819.vip:2100/20190709/Cfm9IrPa/1.jpg', 'http://sp.335819.vip:2100/20190709/Cfm9IrPa/index.m3u8', '1', '0', null, 'http://url.cn/5KpO9g4', null, '2019-07-10 19:17:32', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('15', '1', '28', '2', null, '11', '0', '	 欲望老板娘宿舍偷情男友，疯狂抽插爽得直叫.mp4', null, 'http://sp.335819.vip:2100/20190709/xSdPEGcT/1.jpg', 'http://sp.335819.vip:2100/20190709/xSdPEGcT/index.m3u8', '1', '2', null, 'http://url.cn/5ItAjqq', null, '2019-07-10 19:17:32', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('16', '1', '28', '2', null, '12', '0', '和最愛的人進行最棒的內射做愛。25 苗條美女·超級色情淫亂_4.mp4', null, 'http://sp.335819.vip:2100/20190709/NPKELNSc/1.jpg', 'http://sp.335819.vip:2100/20190709/NPKELNSc/index.m3u8', '1', '0', null, 'http://url.cn/50LLc2M', 'http://t.cn/AilmN8z9', '2019-07-10 19:17:32', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('17', '1', '28', '2', null, '13', '0', '	 儿子和妈妈第一次乱伦,还偷偷录下做爱全程 我只想说插一晚少活几年我愿意，一晚最少也要射她一百次.mp4', null, 'http://sp.335819.vip:2100/20190709/Bo7fR5sp/1.jpg', 'http://sp.335819.vip:2100/20190709/Bo7fR5sp/index.m3u8', '1', '0', null, 'http://url.cn/52T2gO9', 'http://t.cn/AilmOlVO', '2019-07-10 19:17:32', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('18', '0', '5', '3', null, '16', '0', '在餐馆死角处打炮 眼看四方耳听八方', null, 'http://sp.335819.vip:2100/20190709/ut3dJ5vO/1.jpg', 'http://sp.335819.vip:2100/20190709/ut3dJ5vO/index.m3u8', '1', '0', null, null, null, '2019-07-10 19:54:36', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('19', '0', '0', '3', null, '14', '0', '在美国的中国留学生小妹被大屌白人班主任下课后潜规则.mp4\r', null, '', 'http://sp.335819.vip:2100/20190709/C32xLB53/index.m3u8', '1', '0', null, null, null, '2019-07-10 19:54:36', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('20', '0', '28', '3', null, '13', '0', '	 儿子和妈妈第一次乱伦,还偷偷录下做爱全程 我只想说插一晚少活几年我愿意，一晚最少也要射她一百次.mp4', null, 'http://sp.335819.vip:2100/20190709/Bo7fR5sp/1.jpg', 'http://sp.335819.vip:2100/20190709/Bo7fR5sp/index.m3u8', '1', '0', null, null, null, '2019-07-10 19:54:36', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('21', '0', '28', '3', null, '12', '0', '和最愛的人進行最棒的內射做愛。25 苗條美女·超級色情淫亂_4.mp4', null, 'http://sp.335819.vip:2100/20190709/NPKELNSc/1.jpg', 'http://sp.335819.vip:2100/20190709/NPKELNSc/index.m3u8', '1', '4', null, null, null, '2019-07-10 19:54:36', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('22', '0', '28', '3', null, '11', '0', '	 欲望老板娘宿舍偷情男友，疯狂抽插爽得直叫.mp4', null, 'http://sp.335819.vip:2100/20190709/xSdPEGcT/1.jpg', 'http://sp.335819.vip:2100/20190709/xSdPEGcT/index.m3u8', '1', '0', null, null, null, '2019-07-10 19:54:36', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('23', '0', '28', '3', null, '10', '0', '	 援交的大奶正妹海天盛筵也就是这个级别了.mp4', null, 'http://sp.335819.vip:2100/20190709/Cfm9IrPa/1.jpg', 'http://sp.335819.vip:2100/20190709/Cfm9IrPa/index.m3u8', '1', '3', null, null, null, '2019-07-10 19:54:36', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('24', '0', '28', '3', null, '9', '0', ' 援交-韩国父女乱伦援交-女儿享受父爱.mp4', null, 'http://sp.335819.vip:2100/20190709/QokSIYNN/1.jpg', '	http://sp.335819.vip:2100/20190709/QokSIYNN/index.m3u8', '1', '0', null, null, null, '2019-07-10 19:54:36', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('25', '0', '28', '3', null, '8', '0', ' 援交-韩国父女乱伦援交-女儿享受父爱.mp4', null, 'http://sp.335819.vip:2100/20190709/QokSIYNN/1.jpg', '	http://sp.335819.vip:2100/20190709/QokSIYNN/index.m3u8', '1', '0', null, null, null, '2019-07-10 19:54:36', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('26', '0', '28', '3', null, '7', '0', '约操主动上门想体验性爱快感娇羞可爱95骚妹纸.mp4', null, 'http://sp.335819.vip:2100/20190709/nHHzsAI9/1.jpg', 'http://sp.335819.vip:2100/20190709/nHHzsAI9/index.m3u8', '1', '0', null, null, null, '2019-07-10 19:54:36', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('27', '0', '21', '3', null, '6', '0', '约的苗族长腿气质女神，超诱惑，操逼时还教我怎么从后面干才会更爽，30分钟.mp4', null, 'http://sp.335819.vip:2100/20190709/iK5DGFDO/1.jpg', 'http://sp.335819.vip:2100/20190709/iK5DGFDO/index.m3u8', '1', '4', null, null, null, '2019-07-10 19:54:36', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('28', '0', '21', '3', null, '5', '0', '孕妇，3P孕妇，轮流上，全部射，旁边还有一群人看他们表演 40分51秒长片_baofeng_0.mp4', null, 'http://sp.335819.vip:2100/20190709/AU952Wlb/1.jpg', 'http://sp.335819.vip:2100/20190709/AU952Wlb/index.m3u8', '1', '3', null, null, null, '2019-07-10 19:54:36', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('29', '0', '28', '3', null, '4', '0', '孕妇-美女孕妇轮奸道具插完逼还肛交直接干出屎52分钟.mp4', null, '', 'http://sp.335819.vip:2100/20190709/xRHwvjw5/index.m3u8', '1', '0', null, null, null, '2019-07-10 19:54:36', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('30', '0', '17', '3', null, '3', '0', '再别人家偷干别人的老婆.mp4', null, 'http://sp.335819.vip:2100/20190709/1fkgfJmp/1.jpg', 'http://sp.335819.vip:2100/20190709/1fkgfJmp/index.m3u8', '1', '0', null, null, null, '2019-07-10 19:54:36', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('31', '0', '28', '3', null, '2', '0', '	 在餐馆死角处打炮 眼看四方耳听八方.mp4', null, 'http://sp.335819.vip:2100/20190709/ut3dJ5vO/1.jpg', 'http://sp.335819.vip:2100/20190709/ut3dJ5vO/index.m3u8', '1', '2', null, null, null, '2019-07-10 19:54:36', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('32', '0', '28', '3', null, '1', '0', '在美国的中国留学生小妹被大屌白人班主任下课后潜规则.mp4', null, 'http://sp.335819.vip:2100/20190709/C32xLB53/1.jpg', 'http://sp.335819.vip:2100/20190709/C32xLB53/index.m3u8', '1', '0', null, null, null, '2019-07-10 19:54:36', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('33', '0', '5', '4', null, '16', '0', '在餐馆死角处打炮 眼看四方耳听八方', null, 'http://sp.335819.vip:2100/20190709/ut3dJ5vO/1.jpg', 'http://sp.335819.vip:2100/20190709/ut3dJ5vO/index.m3u8', '1', '2', null, null, null, '2019-07-10 20:16:21', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('34', '0', '0', '4', null, '14', '0', '在美国的中国留学生小妹被大屌白人班主任下课后潜规则.mp4\r', null, '', 'http://sp.335819.vip:2100/20190709/C32xLB53/index.m3u8', '1', '0', null, null, null, '2019-07-10 20:16:21', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('35', '0', '28', '4', null, '13', '0', '	 儿子和妈妈第一次乱伦,还偷偷录下做爱全程 我只想说插一晚少活几年我愿意，一晚最少也要射她一百次.mp4', null, 'http://sp.335819.vip:2100/20190709/Bo7fR5sp/1.jpg', 'http://sp.335819.vip:2100/20190709/Bo7fR5sp/index.m3u8', '1', '0', null, null, null, '2019-07-10 20:16:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('36', '0', '28', '4', null, '12', '0', '和最愛的人進行最棒的內射做愛。25 苗條美女·超級色情淫亂_4.mp4', null, 'http://sp.335819.vip:2100/20190709/NPKELNSc/1.jpg', 'http://sp.335819.vip:2100/20190709/NPKELNSc/index.m3u8', '1', '5', null, null, null, '2019-07-10 20:16:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('37', '0', '28', '4', null, '11', '0', '	 欲望老板娘宿舍偷情男友，疯狂抽插爽得直叫.mp4', null, 'http://sp.335819.vip:2100/20190709/xSdPEGcT/1.jpg', 'http://sp.335819.vip:2100/20190709/xSdPEGcT/index.m3u8', '1', '2', null, null, null, '2019-07-10 20:16:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('38', '0', '28', '4', null, '10', '0', '	 援交的大奶正妹海天盛筵也就是这个级别了.mp4', null, 'http://sp.335819.vip:2100/20190709/Cfm9IrPa/1.jpg', 'http://sp.335819.vip:2100/20190709/Cfm9IrPa/index.m3u8', '1', '2', null, null, null, '2019-07-10 20:16:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('39', '0', '28', '4', null, '9', '0', ' 援交-韩国父女乱伦援交-女儿享受父爱.mp4', null, 'http://sp.335819.vip:2100/20190709/QokSIYNN/1.jpg', '	http://sp.335819.vip:2100/20190709/QokSIYNN/index.m3u8', '1', '0', null, null, null, '2019-07-10 20:16:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('40', '0', '28', '4', null, '8', '0', ' 援交-韩国父女乱伦援交-女儿享受父爱.mp4', null, 'http://sp.335819.vip:2100/20190709/QokSIYNN/1.jpg', '	http://sp.335819.vip:2100/20190709/QokSIYNN/index.m3u8', '1', '4', null, null, null, '2019-07-10 20:16:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('41', '0', '28', '4', null, '7', '0', '约操主动上门想体验性爱快感娇羞可爱95骚妹纸.mp4', null, 'http://sp.335819.vip:2100/20190709/nHHzsAI9/1.jpg', 'http://sp.335819.vip:2100/20190709/nHHzsAI9/index.m3u8', '1', '0', null, null, null, '2019-07-10 20:16:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('42', '0', '21', '4', null, '6', '0', '约的苗族长腿气质女神，超诱惑，操逼时还教我怎么从后面干才会更爽，30分钟.mp4', null, 'http://sp.335819.vip:2100/20190709/iK5DGFDO/1.jpg', 'http://sp.335819.vip:2100/20190709/iK5DGFDO/index.m3u8', '1', '0', null, null, null, '2019-07-10 20:16:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('43', '0', '21', '4', null, '5', '0', '孕妇，3P孕妇，轮流上，全部射，旁边还有一群人看他们表演 40分51秒长片_baofeng_0.mp4', null, 'http://sp.335819.vip:2100/20190709/AU952Wlb/1.jpg', 'http://sp.335819.vip:2100/20190709/AU952Wlb/index.m3u8', '1', '6', null, null, null, '2019-07-10 20:16:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('44', '0', '28', '4', null, '4', '0', '孕妇-美女孕妇轮奸道具插完逼还肛交直接干出屎52分钟.mp4', null, '', 'http://sp.335819.vip:2100/20190709/xRHwvjw5/index.m3u8', '1', '0', null, null, null, '2019-07-10 20:16:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('45', '0', '17', '4', null, '3', '0', '再别人家偷干别人的老婆.mp4', null, 'http://sp.335819.vip:2100/20190709/1fkgfJmp/1.jpg', 'http://sp.335819.vip:2100/20190709/1fkgfJmp/index.m3u8', '1', '0', null, null, null, '2019-07-10 20:16:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('46', '0', '28', '4', null, '2', '0', '	 在餐馆死角处打炮 眼看四方耳听八方.mp4', null, 'http://sp.335819.vip:2100/20190709/ut3dJ5vO/1.jpg', 'http://sp.335819.vip:2100/20190709/ut3dJ5vO/index.m3u8', '1', '0', null, null, null, '2019-07-10 20:16:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('47', '0', '28', '4', null, '1', '0', '在美国的中国留学生小妹被大屌白人班主任下课后潜规则.mp4', null, 'http://sp.335819.vip:2100/20190709/C32xLB53/1.jpg', 'http://sp.335819.vip:2100/20190709/C32xLB53/index.m3u8', '1', '5', null, null, null, '2019-07-10 20:16:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('48', '1', '21', '2', null, '63', '0', '国产】激烈的撞击小鮑魚很飽滿夾的JJ好爽，邊幹邊拍', null, 'http://sp.335819.vip:2100/20190709/U8pKOmR0/1.jpg', 'http://sp.335819.vip:2100/20190709/U8pKOmR0/index.m3u8', '1', '0', null, 'http://url.cn/5Y2zjuz', null, '2019-07-23 01:17:33', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('49', '1', '0', '2', null, '14', '0', '在美国的中国留学生小妹被大屌白人班主任下课后潜规则.mp4\r', null, '', 'http://sp.335819.vip:2100/20190709/C32xLB53/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('50', '1', '5', '2', null, '16', '0', '在餐馆死角处打炮 眼看四方耳听八方', null, 'http://sp.335819.vip:2100/20190709/ut3dJ5vO/1.jpg', 'http://sp.335819.vip:2100/20190709/ut3dJ5vO/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('51', '1', '6', '2', null, '17', '0', '再别人家偷干别人的老婆', null, 'http://sp.335819.vip:2100/20190709/1fkgfJmp/1.jpg', 'http://sp.335819.vip:2100/20190709/1fkgfJmp/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('52', '1', '5', '2', null, '18', '0', '孕妇-美女孕妇轮奸道具插完逼还肛交直接干出屎', null, 'http://sp.335819.vip:2100/20190709/xRHwvjw5/1.jpg', 'http://sp.335819.vip:2100/20190709/xRHwvjw5/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('53', '1', '5', '2', null, '19', '0', '孕妇，3P孕妇，轮流上，全部射，旁边还有一群人看他们表演 40分51秒长片', null, 'http://sp.335819.vip:2100/20190709/AU952Wlb/1.jpg', 'http://sp.335819.vip:2100/20190709/AU952Wlb/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('54', '1', '6', '2', null, '20', '0', '约的苗族长腿气质女神，超诱惑，操逼时还教我怎么从后面干才会更爽', null, 'http://sp.335819.vip:2100/20190709/iK5DGFDO/index.m3u8', 'http://sp.335819.vip:2100/20190709/iK5DGFDO/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('55', '1', '5', '2', null, '21', '0', '约操主动上门想体验性爱快感娇羞可爱95骚妹纸', null, 'http://sp.335819.vip:2100/20190709/nHHzsAI9/1.jpg', 'http://sp.335819.vip:2100/20190709/nHHzsAI9/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('56', '1', '17', '2', null, '22', '0', '援交-韩国父女乱伦援交-女儿享受父爱', null, 'http://sp.335819.vip:2100/20190709/QokSIYNN/1.jpg', 'http://sp.335819.vip:2100/20190709/QokSIYNN/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('57', '1', '17', '2', null, '23', '0', '援交的大奶正妹海天盛筵也就是这个级别了', null, 'http://sp.335819.vip:2100/20190709/Cfm9IrPa/1.jpg', 'http://sp.335819.vip:2100/20190709/Cfm9IrPa/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('58', '1', '17', '2', null, '26', '0', '和最愛的人進行最棒的內射做愛。25 苗條美女·超級色情淫亂', null, 'http://sp.335819.vip:2100/20190709/NPKELNSc/1.jpg', 'http://sp.335819.vip:2100/20190709/NPKELNSc/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('59', '1', '0', '2', null, '28', '0', 'http://sp.335819.vip:2100/20190709/Bo7fR5sp/1.jpg', null, '17\r', '儿子和妈妈第一次乱伦,还偷偷录下做爱全程 我只想说插一晚少活几年我愿意，一晚最少也要射她一百次', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('60', '1', '17', '2', null, '29', '0', '儿子和妈妈第一次乱伦,还偷偷录下做爱全程 我只想说插一晚少活几年我愿意，一晚最少也要射她一百次', null, 'http://sp.335819.vip:2100/20190709/Bo7fR5sp/1.jpg', 'http://sp.335819.vip:2100/20190709/Bo7fR5sp/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('61', '1', '17', '2', null, '30', '0', '儿子跟妈妈，国语对白', null, 'http://sp.335819.vip:2100/20190709/KmCxElxV/1.jpg', 'http://sp.335819.vip:2100/20190709/KmCxElxV/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('62', '1', '17', '2', null, '31', '0', '对白淫荡有趣的母子乱伦儿子性冲动把妈妈的肉丝撕破了草逼', null, 'http://sp.335819.vip:2100/20190709/smBIbFJN/1.jpg', 'http://sp.335819.vip:2100/20190709/smBIbFJN/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('63', '1', '17', '2', null, '32', '0', '对白淫荡淫骚主播小妖精浴室洗澡洗逼逼下面的逼毛好浓密好想用鸡巴搓她的逼毛', null, 'http://sp.335819.vip:2100/20190709/Iy4K2m2P/1.jpg', 'http://sp.335819.vip:2100/20190709/Iy4K2m2P/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('64', '1', '21', '2', null, '33', '0', '对白淫荡国产剧情乱伦儿子高考前辛苦了辣妈身体犒劳', null, 'http://sp.335819.vip:2100/20190709/ciQA1P4s/1.jpg', 'http://sp.335819.vip:2100/20190709/ciQA1P4s/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('65', '1', '21', '2', null, '34', '0', '东北逃课系列之约学校舞蹈系美女酒店性爱,长得确实漂亮,床上操完后不过瘾,在卫生间洗澡时又口爆！国语对白', null, 'http://sp.335819.vip:2100/20190709/mLJ6YFRE/1.jpg', 'http://sp.335819.vip:2100/20190709/mLJ6YFRE/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('66', '1', '21', '2', null, '35', '0', '德国女孩破处', null, 'http://sp.335819.vip:2100/20190709/nymuNGpz/1.jpg', 'http://sp.335819.vip:2100/20190709/nymuNGpz/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('67', '1', '21', '2', null, '36', '0', '导演潜规则艺校舞蹈系师妹的无套内射特写 完整33分钟', null, 'http://sp.335819.vip:2100/20190709/e0zQyyek/1.jpg', 'http://sp.335819.vip:2100/20190709/e0zQyyek/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('68', '1', '21', '2', null, '37', '0', '当她妈妈睡着时强奸她3.', null, 'http://sp.335819.vip:2100/20190709/WUvkgDih/1.jpg', 'http://sp.335819.vip:2100/20190709/WUvkgDih/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('69', '1', '28', '2', null, '38', '0', '当她妈妈睡着时强奸她2.', null, 'http://sp.335819.vip:2100/20190709/TfLPhS1w/1.jpg', 'http://sp.335819.vip:2100/20190709/TfLPhS1w/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('70', '1', '21', '2', null, '39', '0', '当她妈妈睡着时强奸她1.', null, 'http://sp.335819.vip:2100/20190709/zPgXBxU5/1.jpg', 'http://sp.335819.vip:2100/20190709/zPgXBxU5/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('71', '1', '21', '2', null, '40', '0', '大一小嫩妹一年不到就勾搭上了富二代 肥逼浪叫真骚姿势学的真不少没少操啊', null, 'http://sp.335819.vip:2100/20190709/alVw5ST6/1.jpg', 'http://sp.335819.vip:2100/20190709/alVw5ST6/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('72', '1', '21', '2', null, '41', '0', '搭讪星巴克极品娇嫩大学生 蒙眼翘美乳骚妹纸臣服J8淫威呻吟不止 浪叫好听 淫荡的伸出香舌求吻', null, 'http://sp.335819.vip:2100/20190709/QmqqEerb/1.jpg', 'http://sp.335819.vip:2100/20190709/alVw5ST6/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('73', '1', '21', '2', null, '42', '0', '【国产】女友自拍给我看请狼友鉴定她是否有收费主播的潜质', null, 'http://sp.335819.vip:2100/20190709/XwonpspP/1.jpg', 'http://sp.335819.vip:2100/20190709/XwonpspP/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('74', '1', '21', '2', null, '43', '0', '从弟弟老公一直到老爸全部做一遍', null, 'http://sp.335819.vip:2100/20190709/49EPOzFs/1.jpg', 'http://sp.335819.vip:2100/20190709/49EPOzFs/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('75', '1', '21', '2', null, '44', '0', '【国产】嫩肉细皮长发清纯大学校花 一对白花花的奶子好诱人，这样的尤物一天干她三次都不累 极品中的极品.', null, 'http://sp.335819.vip:2100/20190709/MNDcuQnr/1.jpg', 'http://sp.335819.vip:2100/20190709/MNDcuQnr/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('76', '1', '21', '2', null, '45', '0', '【国产】内射骚妻小悠，精彩对话.', null, 'http://sp.335819.vip:2100/20190709/yAQeLXgn/1.jpg', 'http://sp.335819.vip:2100/20190709/yAQeLXgn/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('77', '1', '21', '2', null, '46', '0', '【国产】陌陌约来的极品身材女', null, 'http://sp.335819.vip:2100/20190709/BWJF1INT/1.jpg', 'http://sp.335819.vip:2100/20190709/BWJF1INT/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('78', '1', '21', '2', null, '47', '0', '穿着丝袜躺床上睡着了被儿子看见后忍不住干醒', null, 'http://sp.335819.vip:2100/20190709/bYipX5rU/1.jpg', 'http://sp.335819.vip:2100/20190709/bYipX5rU/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('79', '1', '21', '2', null, '48', '0', '【国产】悶騷眼鏡妹和男友愛愛', null, 'http://sp.335819.vip:2100/20190709/hgPcO2lV/1.jpg', 'http://sp.335819.vip:2100/20190709/hgPcO2lV/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('80', '1', '21', '2', null, '49', '0', '【国产】滿足了老公的欲求嬌羞與床上放荡.', null, 'http://sp.335819.vip:2100/20190709/XWNLY6tC/1.jpg', 'http://sp.335819.vip:2100/20190709/XWNLY6tC/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('81', '1', '21', '2', null, '50', '0', '【国产】两男干一女3P', null, 'http://sp.335819.vip:2100/20190709/q4y4W1G3/1.jpg', 'http://sp.335819.vip:2100/20190709/q4y4W1G3/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('82', '1', '21', '2', null, '51', '0', '【国产】客厅沙发狂操 淫荡叫声啊啊啊 全程淫语 激情爆射 完整版.mp4', null, 'http://sp.335819.vip:2100/20190709/bltlnZDB/1.jpg', 'http://sp.335819.vip:2100/20190709/bltlnZDB/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('83', '1', '21', '2', null, '52', '0', '初次下海四十路美女熟女的超敏感地带', null, 'http://sp.335819.vip:2100/20190709/dkE73XG9/1.jpg', 'http://sp.335819.vip:2100/20190709/dkE73XG9/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('84', '1', '0', '2', null, '54', '0', 'http://sp.335819.vip:2100/20190709/tyt4K30a/1.jpg', null, '21\r', '【国产】酒店与粉嫩粉嫩的18岁女孩边拍边玩还用手机拍特写国语对白.mp4', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('85', '1', '21', '2', null, '55', '0', '【国产】酒店爆操美乳粉穴小美女逼紧水多极品国语对白.', null, 'http://sp.335819.vip:2100/20190709/J887Pob0/1.jpg', 'http://sp.335819.vip:2100/20190709/J887Pob0/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('86', '1', '21', '2', null, '56', '0', '【国产】今天和女友在[宾馆录的', null, 'http://sp.335819.vip:2100/20190709/Bh5YUln4/1.jpg', 'http://sp.335819.vip:2100/20190709/Bh5YUln4/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('87', '1', '21', '2', null, '57', '0', '【国产】極品校花女神酒店偷約會 勁力十足叫聲爽', null, 'http://sp.335819.vip:2100/20190709/nm58oRZM/1.jpg', 'http://sp.335819.vip:2100/20190709/nm58oRZM/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('88', '1', '21', '2', null, '58', '0', '吃饭时嫂子把腿伸向了我的鸡巴', null, 'http://sp.335819.vip:2100/20190709/uiM1JT7W/1.jpg', 'http://sp.335819.vip:2100/20190709/uiM1JT7W/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('89', '1', '21', '2', null, '59', '0', '【国产】极品女客户开房偷情', null, 'http://sp.335819.vip:2100/20190709/HCOg6h3u/1.jpg', 'http://sp.335819.vip:2100/20190709/HCOg6h3u/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('90', '1', '21', '2', null, '60', '0', '【国产】极品苗条少妇浴室自摸不过隐找小叔子来泻火，身材真诱人', null, 'http://sp.335819.vip:2100/20190709/GeDVUArF/1.jpg', 'http://sp.335819.vip:2100/20190709/GeDVUArF/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('91', '1', '21', '2', null, '61', '0', '【国产】极品90小嫩妹，水的不行', null, 'http://sp.335819.vip:2100/20190709/WOpCq2GO/1.jpg', 'http://sp.335819.vip:2100/20190709/WOpCq2GO/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('92', '1', '21', '2', null, '62', '0', '趁嫂子睡着后偷袭', null, 'http://sp.335819.vip:2100/20190709/bjfMfwbi/1.jpg', 'http://sp.335819.vip:2100/20190709/bjfMfwbi/index.m3u8', '1', '0', null, null, null, '2019-07-23 01:19:22', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('93', '1', '21', '2', null, '64', '0', '女大学生援交实行跪式服务，像狗一样蹲着给我舔鸡巴', null, 'http://144496.com:2100/20190617/XnT8deov/1.jpg', 'http://144496.com:2100/20190617/XnT8deov/index.m3u8', '1', '0', null, 'http://url.cn/5HI8lgi', '', '2019-07-23 01:46:44', '0.00', '短网址接口调用已用完，请及时续费 http://baofeng.la');
INSERT INTO `wei_usershipin` VALUES ('94', '1', '21', '2', null, '64', '0', '女大学生援交实行跪式服务，像狗一样蹲着给我舔鸡巴', null, 'http://144496.com:2100/20190617/XnT8deov/1.jpg', 'http://144496.com:2100/20190617/XnT8deov/index.m3u8', '1', '0', null, 'http://url.cn/5AWggmu', 'http://t.cn/AiHMIlFY', '2019-07-29 00:16:56', '0.00', '账户或接口已经到期，请登录充值续费  http://baofeng.la');
INSERT INTO `wei_usershipin` VALUES ('95', '1', '28', '2', null, '66', '0', '現役女教師美女幹砲自拍初體驗', null, 'https://img.dadiziyuan.net/upload/vod/2019-02-18/155048199912.jpg\r', 'https://dadi-yun.com/20190217/471_c42aee49/index.m3u8', '1', '0', null, null, null, '2019-09-22 13:44:16', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('96', '0', '21', '2', null, '64', '0', '女大学生援交实行跪式服务，像狗一样蹲着给我舔鸡巴', '', 'http://144496.com:2100/20190617/XnT8deov/1.jpg', 'http://144496.com:2100/20190617/XnT8deov/index.m3u8', '3', '0', null, null, null, '2019-09-22 13:48:29', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('97', '0', '28', '2', null, '66', '0', '現役女教師美女幹砲自拍初體驗', '', 'https://img.dadiziyuan.net/upload/vod/2019-02-18/155048199912.jpg\r', 'https://dadi-yun.com/20190217/471_c42aee49/index.m3u8', '3', '0', null, null, null, '2019-09-22 13:48:29', '0.00', '');
INSERT INTO `wei_usershipin` VALUES ('98', '0', '28', '2', null, '67', '0', '心跳不已 我女友最愛料理跟幹砲 川島愛奈', '', 'https://img.dadiziyuan.net/upload/vod/2019-02-18/155048197919.jpg\r', 'https://dadi-yun.com/20190217/441_acf415aa/index.m3u8', '3', '0', null, 'http://url.cn/52QHykf', '', '2019-09-22 13:48:29', '0.00', '');

-- ----------------------------
-- Table structure for wei_yqm
-- ----------------------------
DROP TABLE IF EXISTS `wei_yqm`;
CREATE TABLE `wei_yqm` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `card` longtext,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wei_yqm
-- ----------------------------
INSERT INTO `wei_yqm` VALUES ('111', '3', 'TCBC5GGV', '2019-07-10 19:51:41');
INSERT INTO `wei_yqm` VALUES ('112', '4', 'DK4RBGPA', '2019-07-10 20:14:34');

-- ----------------------------
-- Table structure for wei_zhu
-- ----------------------------
DROP TABLE IF EXISTS `wei_zhu`;
CREATE TABLE `wei_zhu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domain` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of wei_zhu
-- ----------------------------
INSERT INTO `wei_zhu` VALUES ('9', 'www.youhutong.com');
