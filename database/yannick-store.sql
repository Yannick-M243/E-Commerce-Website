-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 13 avr. 2022 à 18:23
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `yannick-store`
--

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

CREATE TABLE `customer` (
  `customerNo` int(11) NOT NULL,
  `firstName` tinytext NOT NULL,
  `lastName` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `tel` tinytext NOT NULL,
  `username` tinytext NOT NULL,
  `uPassword` longtext NOT NULL,
  `usertype` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `customer`
--

INSERT INTO `customer` (`customerNo`, `firstName`, `lastName`, `email`, `tel`, `username`, `uPassword`, `usertype`) VALUES
(14, 'admin', 'admin', 'dapsshop1@gmail.com', '0714206877', 'admin', '$2y$10$d4/D1a0ZtyJ55qXz6W.KpOc/qAxv.UXW68rW8uebWzpyUEeqlokHO', 'mainAdmin'),
(24, 'Yannick', 'Makwenge', 'yannickmakwenge@gmail.com', '+27714206877', 'yannick', '$2y$10$doF93rCEgJXaTuKhiRzgIuSfkdLyU7rc56yqC8ZGLxKe7Coe.QHZ6', 'user');

-- --------------------------------------------------------

--
-- Structure de la table `customer_orders`
--

CREATE TABLE `customer_orders` (
  `orderId` int(11) NOT NULL,
  `itemName` text NOT NULL,
  `size` longtext NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `customer_orders`
--

INSERT INTO `customer_orders` (`orderId`, `itemName`, `size`, `price`, `quantity`) VALUES
(40, 'Nike Air Jordan 3', '6', 250, 2),
(40, 'Nike Air Jordan 1', '8,5', 300, 1),
(41, 'Nike Air Jordan 3', '7', 250, 1),
(41, 'adidas', '6,5', 250, 1);

-- --------------------------------------------------------

--
-- Structure de la table `order_manager`
--

CREATE TABLE `order_manager` (
  `orderId` int(11) NOT NULL,
  `fName` text NOT NULL,
  `deliveryTel` tinytext NOT NULL,
  `deliveryAddress` text NOT NULL,
  `pay_method` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `order_manager`
--

INSERT INTO `order_manager` (`orderId`, `fName`, `deliveryTel`, `deliveryAddress`, `pay_method`) VALUES
(40, 'Yannick Makwenge', '+27714206877', '12 College road, Rondebosh, Capetown, Western Cape, 7700', 'COD'),
(41, 'Yannick Makwenge', '+27714206877', '12 College road, Rondebosh, Capetown, Western Cape, 7700', 'COD');

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `productNo` int(11) NOT NULL,
  `image` longtext NOT NULL,
  `productName` tinytext NOT NULL,
  `description` longtext NOT NULL,
  `size` tinytext NOT NULL,
  `price` int(11) NOT NULL,
  `productOrder` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`productNo`, `image`, `productName`, `description`, `size`, `price`, `productOrder`) VALUES
(15, '.60db41e1c0f201.40986025.jpg', 'Nike Air Jordan 1', 'Nice shoes', 'a:6:{i:0;s:3:\"8,5\";i:1;s:1:\"9\";i:2;s:3:\"9,5\";i:3;s:2:\"10\";i:4;s:4:\"10,5\";i:5;s:2:\"11\";}', 300, '2'),
(16, '.60e2dc0c85ab27.66604823.jpg', 'Nike Air Jordan 3', 'Nice shoes', 'a:3:{i:0;s:1:\"6\";i:1;s:1:\"7\";i:2;s:2:\"10\";}', 250, '3'),
(17, '.60eab4ac0de785.13840651.jpg', 'adidas', 'Nice shoes', 'a:3:{i:0;s:1:\"6\";i:1;s:3:\"6,5\";i:2;s:2:\"10\";}', 250, '3');

-- --------------------------------------------------------

--
-- Structure de la table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetNo` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerNo`);

--
-- Index pour la table `order_manager`
--
ALTER TABLE `order_manager`
  ADD PRIMARY KEY (`orderId`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productNo`);

--
-- Index pour la table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdResetNo`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `order_manager`
--
ALTER TABLE `order_manager`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `productNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
