-- -------------------------------------------------------------
-- TablePlus 5.3.6(496)
--
-- https://tableplus.com/
--
-- Database: sukum
-- Generation Time: 2023-11-10 14:11:44.6230
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE `tbl_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type` int DEFAULT '0',
  `status` int DEFAULT '0',
  `create_dt` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_dt` datetime DEFAULT NULL,
  `activation_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `activation_token_expiry` datetime DEFAULT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password_reset_token_created_at` datetime DEFAULT NULL,
  `update_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_users` (`id`, `fullname`, `email`, `password`, `type`, `status`, `create_dt`, `update_dt`, `activation_token`, `activation_token_expiry`, `password_reset_token`, `password_reset_token_created_at`, `update_by`) VALUES
(7, 'Mohamad Hamizi bin Mahmood', 'hamizi@ums.edu.my', '$2y$13$SAnBx0fGWkq87Qu8eMhd4.4EWMcwhwU/LG1yNwnGZQeCWEJc0A7M6', 1, 1, '2023-07-23 18:02:32', '2023-11-10 13:57:12', NULL, NULL, '8IF7gLTzsizZgky5vPiDhX5JrksJMaG2_1697936028', '2023-10-22 08:53:48', 7),
(22, 'Frederick Assin', 'frederickassin@ums.edu.my', '$2y$13$SAnBx0fGWkq87Qu8eMhd4.4EWMcwhwU/LG1yNwnGZQeCWEJc0A7M6', 1, 1, '2023-11-10 14:00:26', NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'Feronna Christianus', 'feronna@ums.edu.my', '$2y$13$SAnBx0fGWkq87Qu8eMhd4.4EWMcwhwU/LG1yNwnGZQeCWEJc0A7M6', 1, 1, '2023-11-10 14:00:26', NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'Jaquirah Jumi', 'jaquirah.jumi@ums.edu.my', '$2y$13$SAnBx0fGWkq87Qu8eMhd4.4EWMcwhwU/LG1yNwnGZQeCWEJc0A7M6', 1, 1, '2023-11-10 14:00:26', NULL, NULL, NULL, NULL, NULL, NULL);


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;