/*
 Navicat MySQL Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50720
 Source Host           : localhost
 Source Database       : discography

 Target Server Type    : MySQL
 Target Server Version : 50720
 File Encoding         : utf-8

 Date: 11/28/2018 17:14:07 PM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `albums`
-- ----------------------------
DROP TABLE IF EXISTS `albums`;
CREATE TABLE `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artists_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `token` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F4E2474F54A05007` (`artists_id`),
  CONSTRAINT `FK_F4E2474F54A05007` FOREIGN KEY (`artists_id`) REFERENCES `artists` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `albums`
-- ----------------------------
BEGIN;
INSERT INTO `albums` VALUES ('103', '38', 'The King of Limbs', 'The King of Limbs is the eighth studio album by English rock band Radiohead, produced by Nigel Godrich. It was self-released on 18 February 2011 as a download in MP3 and WAV formats, followed by physical CD and 12\" vinyl releases on 28 March, a wider digital release via AWAL, and a special \"newspaper\" edition on 9 May 2011. The physical editions were released through the band\'s Ticker Tape imprint on XL in the United Kingdom, TBD in the United States, and Hostess Entertainment in Japan.', '2L3SFI', 'https://goo.gl/CsDNgQ'), ('104', '38', 'OK Computer', 'OK Computer is the third studio album by the English alternative rock band Radiohead, released on 16 June 1997 on Parlophone in the United Kingdom and 1 July 1997 by Capitol Records in the United States. It marks a deliberate attempt by the band to move away from the introspective guitar-oriented sound of their previous album The Bends. Its layered sound and wide range of influences set it apart from many of the Britpop and alternative rock bands popular at the time and laid the groundwork for Radiohead\'s later, more experimental work.', 'UD51UB', 'https://goo.gl/tJZYkB'), ('105', '39', 'Dummy', 'Dummy is the debut album of the Bristol-based group Portishead. Released in August 22, 1994 on Go! Discs, the album earned critical acclaim, winning the 1995 Mercury Music Prize. It is often credited with popularizing the trip-hop genre and is frequently cited in lists of the best albums of the 1990s. Although it achieved modest chart success overseas, it peaked at #2 on the UK Album Chart and saw two of its three singles reach #13. The album was certified gold in 1997 and has sold two million copies in Europe. As of September 2011, the album was certified double-platinum in the United Kingdom and has sold as of September 2011 825,000 copies.', 'SDELHQ', 'https://goo.gl/evUdcY'), ('106', '39', 'Third', 'Third is the third studio album by English musical group Portishead, released on 27 April 2008, on Island Records in the United Kingdom, two days after on Mercury Records in the United States, and on 30 April 2008 on Universal Music Japan in Japan. It is their first release in 10 years, and their first studio album in eleven years. Third entered the UK Album Chart at #2, and became the band\'s first-ever American Top 10 album on the Billboard 200, reaching #7 in its entry week.', 'SHL83E', 'https://goo.gl/9fmjsi');
COMMIT;

-- ----------------------------
--  Table structure for `artists`
-- ----------------------------
DROP TABLE IF EXISTS `artists`;
CREATE TABLE `artists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `artists`
-- ----------------------------
BEGIN;
INSERT INTO `artists` VALUES ('38', 'Radiohead', '1UCAQF'), ('39', 'Portishead', 'FLTXLN');
COMMIT;

-- ----------------------------
--  Table structure for `songs`
-- ----------------------------
DROP TABLE IF EXISTS `songs`;
CREATE TABLE `songs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `length` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BAECB19B1137ABCF` (`album_id`),
  CONSTRAINT `FK_BAECB19B1137ABCF` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `songs`
-- ----------------------------
BEGIN;
INSERT INTO `songs` VALUES ('1', '103', 'Bloom', '315'), ('2', '103', 'Morning Mr Magpie', '281'), ('3', '103', 'Little by Little', '267'), ('4', '103', 'Feral', '193'), ('5', '103', 'Lotus Flower', '301'), ('6', '103', 'Codex', '287'), ('7', '103', 'Give Up the Ghost', '290'), ('8', '103', 'Separator', '320'), ('9', '104', 'Airbag', '284'), ('10', '104', 'Paranoid Android', '383'), ('11', '104', 'Subterranean Homesick Alien', '267'), ('12', '104', 'Exit Music (For a Film)', '264'), ('13', '104', 'Let Down', '299'), ('14', '104', 'Karma Police', '261'), ('15', '104', 'Fitter Happier', '117'), ('16', '104', 'Electioneering', '230'), ('17', '104', 'Climbing Up the Walls', '285'), ('18', '104', 'No Surprises', '228'), ('19', '104', 'Lucky', '259'), ('20', '104', 'The Tourist', '324'), ('21', '105', 'Mysterons', '302'), ('22', '105', 'Sour Times', '251'), ('23', '105', 'Strangers', '235'), ('24', '105', 'It Could Be Sweet', '256'), ('25', '105', 'Wandering Star', '291'), ('26', '105', 'It\'s a Fire', '229'), ('27', '105', 'Numb', '234'), ('28', '105', 'Roads', '302'), ('29', '105', 'Pedestal', '219'), ('30', '105', 'Biscuit', '301'), ('31', '105', 'Glory Box', '306'), ('32', '106', 'Silence', '298'), ('33', '106', 'Hunter', '237'), ('34', '106', 'Nylon Smile', '196'), ('35', '106', 'The Rip', '269'), ('36', '106', 'Plastic', '207'), ('37', '106', 'We Carry On', '387'), ('38', '106', 'Deep Water', '91'), ('39', '106', 'Machine Gun', '283'), ('40', '106', 'Small', '405'), ('41', '106', 'Magic Doors', '212'), ('42', '106', 'Threads', '345');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
