-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: localhost    Database: Devi_db
-- ------------------------------------------------------
-- Server version	8.0.36-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `devinettes`
--

DROP TABLE IF EXISTS `devinettes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `devinettes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `solution` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devinettes`
--

LOCK TABLES `devinettes` WRITE;
/*!40000 ALTER TABLE `devinettes` DISABLE KEYS */;
INSERT INTO `devinettes` VALUES (1,'Je suis plus haut que le plus haut,Plus bas que le plus bas,Meilleur que Dieu et pire que le diable.Si on me mange,on en meurt','Rien'),(2,'En étant cassé je suis plus utile que quand je ne le suis pas','un oeuf'),(3,'Je suis quelque chose qui t\'appartient mais que les gens utilisent plus que toi','Ton prenom'),(4,'Je grandis sans etre vivant.je n\'ai pas de poumon,mais j\'ai besoin d\'air pour vivre,meme si je n\'ai pas de bouche,L\'eau me tue','le feu'),(5,'quelle lettre peut-on lancer dans tous les sens','la lettre D(dé)'),(6,'Mr et Mme Dupont ont 6 fils.ils ont tous une soeur,combien y-a-t-il de personne dans cette famille','9 personnes'),(7,'je suis grand quand  je suis jeune et petit quand je suis vieux.je rayonne de vie et le vent est mon plus grand ennemi','une bougie'),(8,'Qu\'est ce qu\'on peut attraper mais jamais lancer','un rhume'),(9,'A quelle question on ne peut jamais repondre oui','est-ce que tu dors?');
/*!40000 ALTER TABLE `devinettes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-17 19:37:04
