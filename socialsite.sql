/* Manual by Namitha S.
email id:yes.namitha.99@gmail.com*/
--
-- Database: `socialsite`
--
CREATE DATABASE IF NOT EXISTS `socialsite` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `socialsite`;

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

CREATE TABLE IF NOT EXISTS `friend` (
  `profile_id1` int(8) NOT NULL,
  `profile_id2` int(8) NOT NULL,
  PRIMARY KEY (`profile_id1`,`profile_id2`),
  KEY `frd2` (`profile_id2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `profile_id` int(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  PRIMARY KEY (`profile_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;


-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE IF NOT EXISTS `request` (
  `profile_id` int(8) NOT NULL,
  `sent_to` int(8) NOT NULL,
  PRIMARY KEY (`profile_id`,`sent_to`),
  KEY `req2` (`sent_to`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `updatestatus`
--

CREATE TABLE IF NOT EXISTS `updatestatus` (
  `profile_id` int(8) NOT NULL,
  `msg` text NOT NULL,
  `username` varchar(30) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`profile_id`,`time`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- --------------------------------------------------------

-- Constraints for dumped tables
--

--
-- Constraints for table `friend`
--
ALTER TABLE `friend`
  ADD CONSTRAINT `frd2` FOREIGN KEY (`profile_id2`) REFERENCES `login` (`profile_id`),
  ADD CONSTRAINT `frd1` FOREIGN KEY (`profile_id1`) REFERENCES `login` (`profile_id`);

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `req2` FOREIGN KEY (`sent_to`) REFERENCES `login` (`profile_id`),
  ADD CONSTRAINT `req1` FOREIGN KEY (`profile_id`) REFERENCES `login` (`profile_id`);

--
-- Constraints for table `updatestatus`
--
ALTER TABLE `updatestatus`
  ADD CONSTRAINT `upd` FOREIGN KEY (`profile_id`) REFERENCES `login` (`profile_id`);

