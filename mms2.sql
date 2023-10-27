-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Dim 08 Mars 2020 à 11:25
-- Version du serveur :  5.7.29-0ubuntu0.18.04.1
-- Version de PHP :  7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ehwhlinmidbv2`
--

-- --------------------------------------------------------

--
-- Structure de la table `assures`
--

CREATE TABLE `assures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `assures`
--

INSERT INTO `assures` (`id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, '2020-03-05 10:37:28', '2020-03-05 10:37:28'),
(2, NULL, '2020-03-07 16:45:08', '2020-03-07 16:45:08'),
(3, NULL, '2020-03-07 16:56:10', '2020-03-07 16:56:10');

-- --------------------------------------------------------

--
-- Structure de la table `beneficiaires`
--

CREATE TABLE `beneficiaires` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Normal',
  `label` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taux` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `beneficiaires`
--

INSERT INTO `beneficiaires` (`id`, `type`, `label`, `taux`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Normal', NULL, 100, NULL, '2020-03-05 10:37:58', '2020-03-05 10:37:58'),
(2, 'Normal', NULL, 50, NULL, '2020-03-07 16:51:26', '2020-03-07 16:51:26'),
(3, 'Normal', NULL, 50, NULL, '2020-03-07 16:51:26', '2020-03-07 16:51:26'),
(4, 'Normal', NULL, 100, NULL, '2020-03-07 16:57:28', '2020-03-07 16:57:28');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `marchand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `clients`
--

INSERT INTO `clients` (`id`, `marchand_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, '2020-03-05 10:37:28', '2020-03-05 10:37:28'),
(2, NULL, NULL, '2020-03-07 16:45:08', '2020-03-07 16:45:08'),
(3, NULL, NULL, '2020-03-07 16:56:10', '2020-03-07 16:56:10');

-- --------------------------------------------------------

--
-- Structure de la table `communes`
--

CREATE TABLE `communes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departement_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `communes`
--

INSERT INTO `communes` (`id`, `nom`, `departement_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Banikoara', 1, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(2, 'Gogounou', 1, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(3, 'Kandi', 1, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(4, 'Karimama', 1, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(5, 'Malanville', 1, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(6, 'Segbana', 1, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(7, 'Boukoumbé', 2, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(8, 'Cobly', 2, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(9, 'Kérou', 2, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(10, 'Kouandé', 2, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(11, 'Matéri', 2, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(12, 'Natitingou', 2, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(13, 'Pehonko', 2, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(14, 'Tanguiéta', 2, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(15, 'Toucountouna', 2, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(16, 'Abomey-Calavi', 3, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(17, 'Allada', 3, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(18, 'Kpomassè', 3, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(19, 'Ouidah', 3, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(20, 'Sô-Ava', 3, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(21, 'Toffo', 3, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(22, 'Tori-Bossito', 3, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(23, 'Zè', 3, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(24, 'Bembéréké', 4, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(25, 'Kalalé', 4, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(26, 'N\'Dali', 4, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(27, 'Nikki', 4, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(28, 'Parakou', 4, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(29, 'Pèrèrè', 4, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(30, 'Sinendé', 4, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(31, 'Tchaourou', 4, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(32, 'Bantè', 5, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(33, 'Dassa-Zoumè', 5, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(34, 'Glazoué', 5, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(35, 'Ouèssè', 5, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(36, 'Savalou', 5, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(37, 'Savè', 5, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(38, 'Aplahoué', 6, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(39, 'Djakotomey', 6, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(40, 'Dogbo-Tota', 6, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(41, 'Klouékanmè', 6, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(42, 'Lalo', 6, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(43, 'Toviklin', 6, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(44, 'Bassila', 7, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(45, 'Copargo', 7, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(46, 'Djougou', 7, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(47, 'Ouaké', 7, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(48, 'Cotonou', 8, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(49, 'Athiémé', 9, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(50, 'Bopa', 9, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(51, 'Comè', 9, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(52, 'Grand-Popo', 9, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(53, 'Houéyogbé', 9, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(54, 'Lokossa', 9, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(55, 'Adjarra', 10, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(56, 'Adjohoun', 10, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(57, 'Aguégués', 10, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(58, 'Akpro-Missérété', 10, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(59, 'Avrankou', 10, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(60, 'Bonou', 10, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(61, 'Dangbo', 10, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(62, 'Porto-Novo', 10, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(63, 'Sèmè-Kpodji', 10, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(64, 'Adja-Ouèrè', 11, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(65, 'Ifangni', 11, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(66, 'Kétou', 11, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(67, 'Pobè', 11, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(68, 'Sakété', 11, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(69, 'Abomey', 12, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(70, 'Agbangnizoun', 12, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(71, 'Bohicon', 12, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(72, 'Covè', 12, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(73, 'Djidja', 12, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(74, 'Ouinhi', 12, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(75, 'Zangnanado', 12, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(76, 'Za-Kpota', 12, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(77, 'Zogbodomey', 12, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07');

-- --------------------------------------------------------

--
-- Structure de la table `contrats`
--

CREATE TABLE `contrats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `assure_id` bigint(20) UNSIGNED NOT NULL,
  `q1` tinyint(1) NOT NULL DEFAULT '0',
  `q2` tinyint(1) NOT NULL DEFAULT '0',
  `q3` tinyint(1) NOT NULL DEFAULT '0',
  `q4` tinyint(1) NOT NULL DEFAULT '0',
  `q5` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `contrats`
--

INSERT INTO `contrats` (`id`, `reference`, `client_id`, `assure_id`, `q1`, `q2`, `q3`, `q4`, `q5`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '2A2N1756', 1, 1, 0, 0, 0, 0, 1, NULL, '2020-03-05 10:37:28', '2020-03-05 10:37:28'),
(2, '46L3N1255', 2, 2, 0, 0, 0, 0, 1, NULL, '2020-03-07 16:45:08', '2020-03-07 16:45:08'),
(3, '46L3N2684', 3, 3, 0, 0, 0, 0, 1, NULL, '2020-03-07 16:56:10', '2020-03-07 16:56:10');

-- --------------------------------------------------------

--
-- Structure de la table `contrat_beneficiaire`
--

CREATE TABLE `contrat_beneficiaire` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `beneficiaire_id` bigint(20) UNSIGNED NOT NULL,
  `contrat_id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `contrat_beneficiaire`
--

INSERT INTO `contrat_beneficiaire` (`id`, `beneficiaire_id`, `contrat_id`, `active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, NULL, NULL),
(2, 2, 2, 1, NULL, NULL, NULL),
(3, 3, 2, 1, NULL, NULL, NULL),
(4, 4, 3, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `contrat_marchand`
--

CREATE TABLE `contrat_marchand` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `marchand_id` bigint(20) UNSIGNED NOT NULL,
  `contrat_id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `contrat_marchand`
--

INSERT INTO `contrat_marchand` (`id`, `marchand_id`, `contrat_id`, `active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, NULL, NULL, NULL),
(2, 3, 2, 1, NULL, NULL, NULL),
(3, 3, 3, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `departements`
--

CREATE TABLE `departements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prefecture` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `departements`
--

INSERT INTO `departements` (`id`, `nom`, `code`, `prefecture`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Alibori', 'Y', 'Kandi', NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(2, 'Atacora', 'V', 'Natitingou', NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(3, 'Atlantique', 'A', 'Allada', NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(4, 'Borgou', 'B', 'Parakou', NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(5, 'Collines', 'C', 'Dassa-Zoumè', NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(6, 'Couffo', 'U', 'Aplahoué', NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(7, 'Donga', 'D', 'Djougou', NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(8, 'Littoral', 'L', 'Cotonou', NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(9, 'Mono', 'M', 'Lokossa', NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(10, 'Ouémé', 'O', 'Porto-Novo', NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(11, 'Plateau', 'P', 'Pobè', NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(12, 'Zou', 'Z', 'Abomey', NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07');

-- --------------------------------------------------------

--
-- Structure de la table `directions`
--

CREATE TABLE `directions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `directions`
--

INSERT INTO `directions` (`id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(2, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(3, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(4, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(5, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(6, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07');

-- --------------------------------------------------------

--
-- Structure de la table `etats`
--

CREATE TABLE `etats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fichiers`
--

CREATE TABLE `fichiers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fichierable_id` bigint(20) UNSIGNED NOT NULL,
  `fichierable_type` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `fichiers`
--

INSERT INTO `fichiers` (`id`, `label`, `nom`, `fichierable_id`, `fichierable_type`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'CNI', '1583404648CNI2A2N1756.png', 1, 'App\\Models\\Contrat', NULL, '2020-03-05 10:37:28', '2020-03-05 10:37:28'),
(2, 'BAI', '1583404648BAI2A2N1756.jpg', 1, 'App\\Models\\Contrat', NULL, '2020-03-05 10:37:28', '2020-03-05 10:37:28'),
(3, 'CNI', '1583599508CNI46L3N1255.jpg', 2, 'App\\Models\\Contrat', NULL, '2020-03-07 16:45:08', '2020-03-07 16:45:08'),
(4, 'BAI', '1583599508BAI46L3N1255.jpg', 2, 'App\\Models\\Contrat', NULL, '2020-03-07 16:45:08', '2020-03-07 16:45:08'),
(5, 'CNI', '1583600170CNI46L3N2684.png', 3, 'App\\Models\\Contrat', NULL, '2020-03-07 16:56:10', '2020-03-07 16:56:10'),
(6, 'BAI', '1583600170BAI46L3N2684.png', 3, 'App\\Models\\Contrat', NULL, '2020-03-07 16:56:10', '2020-03-07 16:56:10');

-- --------------------------------------------------------

--
-- Structure de la table `marchands`
--

CREATE TABLE `marchands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entreprise` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registre` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `personne` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `marchands`
--

INSERT INTO `marchands` (`id`, `reference`, `entreprise`, `registre`, `personne`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '', 'test', 'test', 'morale', NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(2, '2A2', NULL, NULL, 'physique', NULL, '2020-03-05 07:33:15', '2020-03-05 07:33:15'),
(3, '46L3', NULL, NULL, 'physique', NULL, '2020-03-07 16:15:28', '2020-03-07 16:15:28');

-- --------------------------------------------------------

--
-- Structure de la table `marchand_super_marchand`
--

CREATE TABLE `marchand_super_marchand` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `marchand_id` bigint(20) UNSIGNED NOT NULL,
  `super_marchand_id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `marchand_super_marchand`
--

INSERT INTO `marchand_super_marchand` (`id`, `marchand_id`, `super_marchand_id`, `active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, NULL, NULL),
(2, 2, 2, 1, NULL, NULL, NULL),
(3, 3, 46, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2018_11_06_222923_create_transactions_table', 1),
(9, '2018_11_07_192923_create_transfers_table', 1),
(10, '2018_11_07_202152_update_transfers_table', 1),
(11, '2018_11_15_124230_create_wallets_table', 1),
(12, '2018_11_19_164609_update_transactions_table', 1),
(13, '2018_11_20_133759_add_fee_transfers_table', 1),
(14, '2018_11_22_131953_add_status_transfers_table', 1),
(15, '2018_11_22_133438_drop_refund_transfers_table', 1),
(16, '2019_05_13_111553_update_status_transfers_table', 1),
(17, '2019_06_25_103755_add_exchange_status_transfers_table', 1),
(18, '2019_07_29_184926_decimal_places_wallets_table', 1),
(19, '2019_08_19_000000_create_failed_jobs_table', 1),
(20, '2019_10_02_193759_add_discount_transfers_table', 1),
(21, '2020_01_04_075745_create_departements_table', 1),
(22, '2020_01_04_075756_create_communes_table', 1),
(23, '2020_01_04_093525_add_commune_id_to_users_table', 1),
(24, '2020_01_04_100148_create_permission_tables', 1),
(25, '2020_01_05_220756_create_directions_table', 1),
(26, '2020_01_05_220805_create_super_marchands_table', 1),
(27, '2020_01_05_220809_create_marchands_table', 1),
(28, '2020_01_05_220812_create_clients_table', 1),
(29, '2020_01_05_220816_create_assures_table', 1),
(30, '2020_01_05_220819_create_beneficiaires_table', 1),
(31, '2020_01_05_221119_create_contrats_table', 1),
(32, '2020_01_06_011013_create_nsias_table', 1),
(33, '2020_01_06_081056_create_userables_table', 1),
(34, '2020_01_11_225455_create_prospects_table', 1),
(35, '2020_01_11_225610_create_soldes_table', 1),
(36, '2020_01_14_210138_create_contrat_beneficiaire_table', 1),
(37, '2020_01_14_212755_create_fichiers_table', 1),
(38, '2020_01_18_072713_create_sinistres_table', 1),
(39, '2020_01_21_125829_create_etats_table', 1),
(40, '2020_02_02_135107_create_sms_table', 1),
(41, '2020_02_08_211910_create_mobile_money_table', 1),
(42, '2020_02_19_035733_create_tempp_table', 1),
(43, '2020_02_23_164101_create_souscriptions_table', 1),
(44, '2020_02_23_164821_create_statut_souscriptions_table', 1),
(45, '2020_02_23_170706_create_souscription_statut_souscription_table', 1),
(46, '2020_02_23_171255_create_primes_table', 1),
(47, '2020_02_26_120710_create_contrat_marchand_table', 1),
(48, '2020_02_29_135123_create_marchand_super_marchand_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `mobile_money`
--

CREATE TABLE `mobile_money` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `msisdn` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operation_type` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operateur` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `response` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `response_code` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `response_msg` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transref` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `narration` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `mobile_money`
--

INSERT INTO `mobile_money` (`id`, `msisdn`, `operation_type`, `operateur`, `amount`, `response`, `response_code`, `response_msg`, `transref`, `firstname`, `lastname`, `narration`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '22997967833', 'REQUESTPAYMENT', 'MTN', '1', '{\"responsecode\":\"01\",\"responsemsg\":\"Pending\",\"transref\":\"1583404690EHWHLINMIA\",\"serviceref\":null,\"comment\":null}', '01', 'Pending', '1583404690EHWHLINMIA', 'SOUSOUDJI', 'KADNEL', 'contrat1S1', 56, NULL, '2020-03-05 10:38:11', '2020-03-05 10:38:11'),
(2, '22997967833', 'REQUESTPAYMENT', 'MTN', '1', '{\"responsecode\":\"01\",\"responsemsg\":\"Pending\",\"transref\":\"1583404822EHWHLINMIA\",\"serviceref\":null,\"comment\":null}', '01', 'Pending', '1583404822EHWHLINMIA', 'SOUSOUDJI', 'KADNEL', 'contrat1S1', 56, NULL, '2020-03-05 10:40:23', '2020-03-05 10:40:23'),
(3, '22997967833', 'REQUESTPAYMENT', 'MTN', '1', '{\"responsecode\":\"01\",\"responsemsg\":\"Pending\",\"transref\":\"1583405081EHWHLINMIA\",\"serviceref\":null,\"comment\":null}', '01', 'Pending', '1583405081EHWHLINMIA', 'SOUSOUDJI', 'KADNEL', 'contrat1S1', 56, NULL, '2020-03-05 10:44:42', '2020-03-05 10:44:42'),
(4, '22997967833', 'REQUESTPAYMENT', 'MTN', '1', '{\"responsecode\":\"00\",\"responsemsg\":\"Successfully processed transaction.\",\"transref\":\"1583598835EHWHLINMIA\",\"serviceref\":\"910678120\",\"comment\":null}', '00', 'Successfully processed transaction.', '1583598835EHWHLINMIA', 'SOUSOUDJI', 'KADNEL', 'contrat1S1', 56, NULL, '2020-03-07 16:33:56', '2020-03-07 16:34:12'),
(5, '22999151256', 'REQUESTPAYMENT', 'MOOV', '1', '{\"responsecode\":\"92\",\"responsemsg\":\"\",\"transref\":\"1583599949EHWHLINMMV\",\"serviceref\":null,\"comment\":null}', '92', '', '1583599949EHWHLINMMV', 'ADEBIYI', 'Jeanne', 'contrat2S2', 60, NULL, '2020-03-07 16:53:01', '2020-03-07 16:53:01'),
(6, '22999151256', 'REQUESTPAYMENT', 'MOOV', '1', '{\"responsecode\":\"92\",\"responsemsg\":\"\",\"transref\":\"1583600005EHWHLINMMV\",\"serviceref\":null,\"comment\":null}', '92', '', '1583600005EHWHLINMMV', 'ADEBIYI', 'Jeanne', 'contrat2S2', 60, NULL, '2020-03-07 16:53:27', '2020-03-07 16:53:27'),
(7, '22999151256', 'REQUESTPAYMENT', 'MOOV', '1', '{\"responsecode\":\"92\",\"responsemsg\":\"\",\"transref\":\"1583600028EHWHLINMMV\",\"serviceref\":null,\"comment\":null}', '92', '', '1583600028EHWHLINMMV', 'ADEBIYI', 'Jeanne', 'contrat2S2', 60, NULL, '2020-03-07 16:53:49', '2020-03-07 16:53:49'),
(8, '22999151256', 'REQUESTPAYMENT', 'MOOV', '1', '{\"responsecode\":\"92\",\"responsemsg\":\"\",\"transref\":\"1583600041EHWHLINMMV\",\"serviceref\":null,\"comment\":null}', '92', '', '1583600041EHWHLINMMV', 'ADEBIYI', 'Jeanne', 'contrat2S2', 60, NULL, '2020-03-07 16:54:02', '2020-03-07 16:54:02'),
(9, '22996254399', 'REQUESTPAYMENT', 'MTN', '1', '{\"responsecode\":\"00\",\"responsemsg\":\"Successfully processed transaction.\",\"transref\":\"1583600256EHWHLINMIA\",\"serviceref\":\"910713417\",\"comment\":null}', '00', 'Successfully processed transaction.', '1583600256EHWHLINMIA', 'DUJARDIN', 'Jean', 'contrat3S3', 60, NULL, '2020-03-07 16:57:36', '2020-03-07 16:57:52'),
(10, '22996254399', 'REQUESTPAYMENT', 'MTN', '1', '{\"responsecode\":\"00\",\"responsemsg\":\"Successfully processed transaction.\",\"transref\":\"1583600446EHWHLINMIA\",\"serviceref\":\"910718234\",\"comment\":null}', '00', 'Successfully processed transaction.', '1583600446EHWHLINMIA', 'DUJARDIN', 'Jean', 'primeC3', 60, NULL, '2020-03-07 17:00:46', '2020-03-07 17:01:07');

-- --------------------------------------------------------

--
-- Structure de la table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 2),
(3, 'App\\User', 3),
(4, 'App\\User', 4),
(5, 'App\\User', 5),
(6, 'App\\User', 6),
(12, 'App\\User', 7),
(13, 'App\\User', 8),
(14, 'App\\User', 9),
(7, 'App\\User', 10),
(8, 'App\\User', 11),
(7, 'App\\User', 12),
(7, 'App\\User', 13),
(7, 'App\\User', 14),
(7, 'App\\User', 15),
(7, 'App\\User', 16),
(7, 'App\\User', 17),
(7, 'App\\User', 18),
(7, 'App\\User', 19),
(7, 'App\\User', 20),
(7, 'App\\User', 21),
(7, 'App\\User', 22),
(7, 'App\\User', 23),
(7, 'App\\User', 24),
(7, 'App\\User', 25),
(7, 'App\\User', 26),
(7, 'App\\User', 27),
(7, 'App\\User', 28),
(7, 'App\\User', 29),
(7, 'App\\User', 30),
(7, 'App\\User', 31),
(7, 'App\\User', 32),
(7, 'App\\User', 33),
(7, 'App\\User', 34),
(7, 'App\\User', 35),
(7, 'App\\User', 36),
(7, 'App\\User', 37),
(7, 'App\\User', 38),
(7, 'App\\User', 39),
(7, 'App\\User', 40),
(7, 'App\\User', 41),
(7, 'App\\User', 42),
(7, 'App\\User', 43),
(7, 'App\\User', 44),
(7, 'App\\User', 45),
(7, 'App\\User', 46),
(7, 'App\\User', 47),
(7, 'App\\User', 48),
(7, 'App\\User', 49),
(7, 'App\\User', 50),
(7, 'App\\User', 51),
(7, 'App\\User', 52),
(7, 'App\\User', 53),
(7, 'App\\User', 54),
(7, 'App\\User', 55),
(8, 'App\\User', 56),
(9, 'App\\User', 57),
(11, 'App\\User', 57),
(10, 'App\\User', 58),
(7, 'App\\User', 59),
(8, 'App\\User', 60),
(9, 'App\\User', 61),
(10, 'App\\User', 61),
(11, 'App\\User', 62),
(11, 'App\\User', 63),
(9, 'App\\User', 64),
(10, 'App\\User', 64),
(11, 'App\\User', 65);

-- --------------------------------------------------------

--
-- Structure de la table `nsias`
--

CREATE TABLE `nsias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `direction_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `nsias`
--

INSERT INTO `nsias` (`id`, `direction_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(2, 1, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(3, 1, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07');

-- --------------------------------------------------------

--
-- Structure de la table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'store assures', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(2, 'index assures', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(3, 'create assures', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(4, 'destroy assures', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(5, 'update assures', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(6, 'show assures', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(7, 'edit assures', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(8, 'store beneficiaires', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(9, 'index beneficiaires', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(10, 'create beneficiaires', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(11, 'destroy beneficiaires', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(12, 'update beneficiaires', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(13, 'show beneficiaires', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(14, 'edit beneficiaires', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(15, 'index clients', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(16, 'store clients', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(17, 'create clients', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(18, 'destroy clients', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(19, 'update clients', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(20, 'show clients', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(21, 'edit clients', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(22, 'index dash', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(23, 'index directions', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(24, 'store directions', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(25, 'create directions', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(26, 'show directions', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(27, 'update directions', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(28, 'destroy directions', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(29, 'edit directions', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(30, 'index supermarchands', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(31, 'store supermarchands', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(32, 'create supermarchands', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(33, 'destroy supermarchands', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(34, 'update supermarchands', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(35, 'show supermarchands', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(36, 'edit supermarchands', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(37, 'store nsia', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(38, 'index nsia', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(39, 'create nsia', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(40, 'destroy nsia', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(41, 'update nsia', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(42, 'show nsia', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(43, 'edit nsia', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(44, 'confirm password', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(45, 'email password', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(46, 'request password', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(47, 'update password', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(48, 'reset password', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(49, 'store marchands', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(50, 'index marchands', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(51, 'create marchands', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(52, 'destroy marchands', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(53, 'update marchands', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(54, 'show marchands', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(55, 'edit marchands', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(56, 'status users', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(57, 'store utilisateurs', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(58, 'index utilisateurs', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(59, 'create utilisateurs', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(60, 'destroy utilisateurs', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(61, 'update utilisateurs', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(62, 'show utilisateurs', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(63, 'edit utilisateurs', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(64, 'index visiteurs', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(65, 'store visiteurs', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(66, 'create visiteurs', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(67, 'show visiteurs', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(68, 'update visiteurs', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(69, 'destroy visiteurs', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(70, 'edit visiteurs', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07');

-- --------------------------------------------------------

--
-- Structure de la table `primes`
--

CREATE TABLE `primes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `souscription_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `montant` int(11) NOT NULL,
  `c_marchand` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_first_marchand` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `c_smarchand` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_first_smarchand` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `c_nsia` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_mms` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_prime` date NOT NULL DEFAULT '2020-03-05',
  `statut_commission` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `primes`
--

INSERT INTO `primes` (`id`, `souscription_id`, `user_id`, `montant`, `c_marchand`, `c_first_marchand`, `c_smarchand`, `c_first_smarchand`, `c_nsia`, `c_mms`, `date_prime`, `statut_commission`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 3, 60, 1000, '2000', '0', '1000', '0', '6750', '250', '2020-03-05', NULL, NULL, '2020-03-07 17:01:07', '2020-03-07 17:01:07'),
(2, 3, 60, 1000, '1800', '0', '650', '0', '6750', '800', '2020-03-05', NULL, NULL, '2020-03-07 17:01:07', '2020-03-07 17:01:07'),
(3, 3, 60, 1000, '1800', '0', '650', '0', '6750', '800', '2020-03-05', NULL, NULL, '2020-03-07 17:01:08', '2020-03-07 17:01:08');

-- --------------------------------------------------------

--
-- Structure de la table `prospects`
--

CREATE TABLE `prospects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `commune_id` bigint(20) UNSIGNED NOT NULL,
  `marchand_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Direction', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(2, 'Direction_ARH', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(3, 'Direction_C', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(4, 'Direction_FC', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(5, 'Direction_MAC', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(6, 'ITMMS', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(7, 'SuperMarchand', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(8, 'Marchand', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(9, 'Client', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(10, 'Assuré', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(11, 'Bénéficiaire', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(12, 'Nsia', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(13, 'Nsia1', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(14, 'Nsia2', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(15, 'ITNSIA', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(18, 'super-admin', 'web', '2020-03-05 04:04:07', '2020-03-05 04:04:07');

-- --------------------------------------------------------

--
-- Structure de la table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 18),
(2, 18),
(3, 18),
(4, 18),
(5, 18),
(6, 18),
(7, 18),
(8, 18),
(9, 18),
(10, 18),
(11, 18),
(12, 18),
(13, 18),
(14, 18),
(15, 18),
(16, 18),
(17, 18),
(18, 18),
(19, 18),
(20, 18),
(21, 18),
(22, 18),
(23, 18),
(24, 18),
(25, 18),
(26, 18),
(27, 18),
(28, 18),
(29, 18),
(30, 18),
(31, 18),
(32, 18),
(33, 18),
(34, 18),
(35, 18),
(36, 18),
(37, 18),
(38, 18),
(39, 18),
(40, 18),
(41, 18),
(42, 18),
(43, 18),
(44, 18),
(45, 18),
(46, 18),
(47, 18),
(48, 18),
(49, 18),
(50, 18),
(51, 18),
(52, 18),
(53, 18),
(54, 18),
(55, 18),
(56, 18),
(57, 18),
(58, 18),
(59, 18),
(60, 18),
(61, 18),
(62, 18),
(63, 18),
(64, 18),
(65, 18),
(66, 18),
(67, 18),
(68, 18),
(69, 18),
(70, 18);

-- --------------------------------------------------------

--
-- Structure de la table `sinistres`
--

CREATE TABLE `sinistres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_sinistre` date NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `contrat_id` bigint(20) UNSIGNED NOT NULL,
  `statut` enum('Non traité','En cours','Terminé') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Non traité',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sms`
--

CREATE TABLE `sms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from` bigint(20) UNSIGNED NOT NULL,
  `to` bigint(20) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sent` tinyint(1) NOT NULL DEFAULT '1',
  `response` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `sms`
--

INSERT INTO `sms` (`id`, `from`, `to`, `message`, `sent`, `response`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 12, 56, 'Votre compte Marchand est cree. Login : votre numero, mot de passe : 1234', 1, '', NULL, '2020-03-05 07:33:21', '2020-03-05 07:33:21'),
(2, 56, 57, 'Bienvenue chez EHWLINMI ASSURANCE. Ref Contrat:2A2N1756. Login : votre numero, mot de passe : 1234. Ne perdez pas votre couverture, payer votre prime a temps. GMMS et NSIA vous remercient.', 1, '', NULL, '2020-03-05 10:37:31', '2020-03-05 10:37:31'),
(3, 1, 59, 'Votre compte SuperMarchand est cree. Login : votre numero, mot de passe : 1234', 1, '', NULL, '2020-03-07 16:09:42', '2020-03-07 16:09:42'),
(4, 59, 60, 'Votre compte Marchand est cree. Login : votre numero, mot de passe : 1234', 1, '', NULL, '2020-03-07 16:15:31', '2020-03-07 16:15:31'),
(5, 60, 61, 'Bienvenue chez EHWLINMI ASSURANCE. Ref Contrat:46L3N1255. Login : votre numero, mot de passe : 1234. Ne perdez pas votre couverture, payer votre prime a temps. GMMS et NSIA vous remercient.', 1, '', NULL, '2020-03-07 16:45:11', '2020-03-07 16:45:11'),
(6, 60, 64, 'Bienvenue chez EHWLINMI ASSURANCE. Ref Contrat:46L3N2684. Login : votre numero, mot de passe : 1234. Ne perdez pas votre couverture, payer votre prime a temps. GMMS et NSIA vous remercient.', 1, '', NULL, '2020-03-07 16:56:11', '2020-03-07 16:56:11'),
(7, 60, 64, 'DUJARDIN Jean, votre payement de 3000F est recu pour le contrat 46L3N2684. Reste a payer 9000. GMMS et NSIA vous remercient.', 1, '', NULL, '2020-03-07 17:01:11', '2020-03-07 17:01:11');

-- --------------------------------------------------------

--
-- Structure de la table `soldes`
--

CREATE TABLE `soldes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `souscriptions`
--

CREATE TABLE `souscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contrat_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `statut` enum('Attente de paiement','Attente de traitement','Valide','Rejeté','Sinistre','Terminé') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Attente de paiement',
  `date_effet` date NOT NULL DEFAULT '2020-03-05',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `souscriptions`
--

INSERT INTO `souscriptions` (`id`, `contrat_id`, `user_id`, `statut`, `date_effet`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 56, 'Valide', '2020-03-07', NULL, '2020-03-05 10:37:28', '2020-03-07 16:34:12'),
(2, 2, 60, 'Attente de paiement', '2020-03-05', NULL, '2020-03-07 16:45:08', '2020-03-07 16:45:08'),
(3, 3, 60, 'Valide', '2020-03-07', NULL, '2020-03-07 16:56:10', '2020-03-07 16:57:52');

-- --------------------------------------------------------

--
-- Structure de la table `souscription_statut_souscription`
--

CREATE TABLE `souscription_statut_souscription` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `souscription_id` bigint(20) UNSIGNED NOT NULL,
  `statut_souscription_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `motif` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `souscription_statut_souscription`
--

INSERT INTO `souscription_statut_souscription` (`id`, `souscription_id`, `statut_souscription_id`, `user_id`, `motif`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 56, 'Nouvelle souscription', NULL, '2020-03-05 10:37:28', '2020-03-05 10:37:28'),
(2, 1, 2, 56, 'Paiement éffectué', NULL, '2020-03-07 16:34:12', '2020-03-07 16:34:12'),
(3, 1, 3, 56, 'Validation automatique', NULL, '2020-03-07 16:34:12', '2020-03-07 16:34:12'),
(4, 2, 1, 60, 'Nouvelle souscription', NULL, '2020-03-07 16:45:08', '2020-03-07 16:45:08'),
(5, 3, 1, 60, 'Nouvelle souscription', NULL, '2020-03-07 16:56:10', '2020-03-07 16:56:10'),
(6, 3, 2, 60, 'Paiement éffectué', NULL, '2020-03-07 16:57:52', '2020-03-07 16:57:52'),
(7, 3, 3, 60, 'Validation automatique', NULL, '2020-03-07 16:57:52', '2020-03-07 16:57:52');

-- --------------------------------------------------------

--
-- Structure de la table `statut_souscriptions`
--

CREATE TABLE `statut_souscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `statut_souscriptions`
--

INSERT INTO `statut_souscriptions` (`id`, `label`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Attente de paiement', NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(2, 'Attente de traitement', NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(3, 'Valide', NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(4, 'Rejeté', NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(5, 'Sinistre', NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(6, 'Terminé', NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07');

-- --------------------------------------------------------

--
-- Structure de la table `super_marchands`
--

CREATE TABLE `super_marchands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entreprise` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registre` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `personne` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direction_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `super_marchands`
--

INSERT INTO `super_marchands` (`id`, `reference`, `entreprise`, `registre`, `personne`, `direction_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '', 'test', 'test', 'morale', 1, NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(2, '2A', 'NET-DIRECT', 'RCCM', 'morale', 1, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(3, '3L', NULL, NULL, 'physique', 1, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(4, '4L', NULL, NULL, 'physique', 1, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(5, '5A', NULL, NULL, 'physique', 1, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(6, '6A', NULL, NULL, 'physique', 1, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(7, '7A', NULL, NULL, 'physique', 1, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(8, '8A', 'AJTG RACI', 'RB/ABC/19A13831', 'morale', 1, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(9, '9L', 'CANADIME SARL', 'RCCM RB / LOT/ 10B6268', 'morale', 1, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(10, '10A', NULL, NULL, 'physique', 1, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(11, '11Z', NULL, NULL, 'physique', 1, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(12, '12Z', NULL, NULL, 'physique', 1, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(13, '13L', NULL, NULL, 'physique', 1, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(14, '14L', NULL, NULL, 'physique', 1, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(15, '15A', NULL, NULL, 'physique', 1, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(16, '16B', NULL, NULL, 'physique', 1, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(17, '17C', NULL, NULL, 'physique', 1, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(18, '18A', NULL, NULL, 'physique', 1, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(19, '19A', NULL, NULL, 'physique', 1, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(20, '20M', 'New Horizon Corporate (NHC)', 'RB/COT/11A11740', 'morale', 1, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(21, '21M', NULL, NULL, 'physique', 1, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(22, '22L', 'VIE - NOUVELLE - GS', 'RB/COT/19A51327', 'morale', 1, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(23, '23Z', 'DADJA MAHOULE SARL', 'RB/COT/18B20891', 'morale', 1, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(24, '24L', NULL, NULL, 'physique', 1, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(25, '25A', 'DOVON & FILS', 'RB/ABC/19A13906', 'morale', 1, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(26, '26A', 'EAGLE GROUP INTERNATIONAL SARL', 'RB/ABC/15B578', 'morale', 1, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(27, '27A', NULL, NULL, 'physique', 1, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(28, '28L', NULL, NULL, 'physique', 1, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(29, '29A', NULL, NULL, 'physique', 1, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(30, '30L', NULL, NULL, 'physique', 1, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(31, '31U', 'TOTAL SERVICES PLUS', 'RB/LKS/19A1101', 'morale', 1, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(32, '32L', 'SOJELIE SARL', 'RCCMRBCOT/16B16002', 'morale', 1, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(33, '33A', NULL, NULL, 'physique', 1, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(34, '34A', NULL, NULL, 'physique', 1, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(35, '35L', 'Houansou', 'RB/COT/14A19701', 'morale', 1, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(36, '36Z', 'Ets Royal Irokosa', 'RB/ABY/19A5812', 'morale', 1, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(37, '37L', NULL, NULL, 'physique', 1, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(38, '38A', NULL, NULL, 'physique', 1, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(39, '39L', NULL, NULL, 'physique', 1, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(40, '40B', 'Afrique Consulting Services (ACS)', 'RB/PKO/18A5434', 'morale', 1, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(41, '41L', NULL, NULL, 'physique', 1, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(42, '42C', NULL, NULL, 'physique', 1, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(43, '43L', 'D@FR & FILS', 'RB/COT', 'morale', 1, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(44, '44L', NULL, NULL, 'physique', 1, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(45, '45L', NULL, NULL, 'physique', 1, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(46, '46L', NULL, NULL, 'physique', 1, NULL, '2020-03-07 16:09:37', '2020-03-07 16:09:37');

-- --------------------------------------------------------

--
-- Structure de la table `tempp`
--

CREATE TABLE `tempp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `other1` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other2` text COLLATE utf8mb4_unicode_ci,
  `response` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `payable_type` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payable_id` bigint(20) UNSIGNED NOT NULL,
  `wallet_id` int(10) UNSIGNED DEFAULT NULL,
  `type` enum('deposit','withdraw') COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` bigint(20) NOT NULL,
  `confirmed` tinyint(1) NOT NULL,
  `meta` json DEFAULT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `transactions`
--

INSERT INTO `transactions` (`id`, `payable_type`, `payable_id`, `wallet_id`, `type`, `amount`, `confirmed`, `meta`, `uuid`, `created_at`, `updated_at`) VALUES
(1, 'App\\User', 1, 1, 'deposit', 10000, 1, NULL, 'f6b2a43f-81c0-44a1-9a53-744ae281304b', '2020-03-07 16:34:12', '2020-03-07 16:34:12'),
(2, 'App\\User', 1, 1, 'deposit', 10000, 1, NULL, '77deae63-d004-463c-966b-b8f8e2ec17d0', '2020-03-07 16:57:52', '2020-03-07 16:57:52'),
(3, 'App\\User', 60, 174, 'deposit', 2000, 1, NULL, 'c4145143-73a5-4542-b8f3-ca6411b41ae2', '2020-03-07 17:01:07', '2020-03-07 17:01:07'),
(4, 'App\\User', 59, 171, 'deposit', 1000, 1, NULL, '29ca6706-1c67-42ad-af20-4fecc971f8f9', '2020-03-07 17:01:07', '2020-03-07 17:01:07'),
(5, 'App\\User', 1, 3, 'deposit', 250, 1, NULL, '1a6a69f5-74ae-48d1-887a-ef32faac5b6e', '2020-03-07 17:01:07', '2020-03-07 17:01:07'),
(6, 'App\\User', 7, 21, 'deposit', 6750, 1, NULL, '33361ea0-b8d3-48d6-82a9-e28345443dd4', '2020-03-07 17:01:07', '2020-03-07 17:01:07'),
(7, 'App\\User', 60, 174, 'deposit', 1800, 1, NULL, '8588cf96-f51b-4ebe-9789-b0c08f5b8172', '2020-03-07 17:01:07', '2020-03-07 17:01:07'),
(8, 'App\\User', 59, 171, 'deposit', 650, 1, NULL, 'd55c6ff3-0838-47bb-b271-4c6fdd2732fd', '2020-03-07 17:01:07', '2020-03-07 17:01:07'),
(9, 'App\\User', 1, 3, 'deposit', 800, 1, NULL, '14d64d11-4c95-4779-8167-16e69e90afc2', '2020-03-07 17:01:07', '2020-03-07 17:01:07'),
(10, 'App\\User', 7, 21, 'deposit', 6750, 1, NULL, '7dc25081-50e6-497a-9388-665b2c945c89', '2020-03-07 17:01:07', '2020-03-07 17:01:07'),
(11, 'App\\User', 60, 174, 'deposit', 1800, 1, NULL, 'c6c6afe0-65c7-4c3a-96c4-addb25112166', '2020-03-07 17:01:07', '2020-03-07 17:01:07'),
(12, 'App\\User', 59, 171, 'deposit', 650, 1, NULL, 'e56a235a-280b-49ea-bb43-4eb7c8f69f39', '2020-03-07 17:01:07', '2020-03-07 17:01:07'),
(13, 'App\\User', 1, 3, 'deposit', 800, 1, NULL, 'b8f3f255-ff94-414c-9061-c56a624cc759', '2020-03-07 17:01:08', '2020-03-07 17:01:08'),
(14, 'App\\User', 7, 21, 'deposit', 6750, 1, NULL, '2e822f69-c32b-4c70-8a67-9f9c2f6e494a', '2020-03-07 17:01:08', '2020-03-07 17:01:08');

-- --------------------------------------------------------

--
-- Structure de la table `transfers`
--

CREATE TABLE `transfers` (
  `id` int(10) UNSIGNED NOT NULL,
  `from_type` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` bigint(20) UNSIGNED NOT NULL,
  `to_type` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('exchange','transfer','paid','refund','gift') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'transfer',
  `status_last` enum('exchange','transfer','paid','refund','gift') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposit_id` int(10) UNSIGNED NOT NULL,
  `withdraw_id` int(10) UNSIGNED NOT NULL,
  `discount` bigint(20) NOT NULL DEFAULT '0',
  `fee` bigint(20) NOT NULL DEFAULT '0',
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `userables`
--

CREATE TABLE `userables` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `userable_id` bigint(20) UNSIGNED NOT NULL,
  `userable_type` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `userables`
--

INSERT INTO `userables` (`user_id`, `userable_id`, `userable_type`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'App\\Models\\Direction', NULL, NULL, NULL),
(2, 2, 'App\\Models\\Direction', NULL, NULL, NULL),
(3, 3, 'App\\Models\\Direction', NULL, NULL, NULL),
(4, 4, 'App\\Models\\Direction', NULL, NULL, NULL),
(5, 5, 'App\\Models\\Direction', NULL, NULL, NULL),
(6, 6, 'App\\Models\\Direction', NULL, NULL, NULL),
(7, 1, 'App\\Models\\Nsia', NULL, NULL, NULL),
(8, 2, 'App\\Models\\Nsia', NULL, NULL, NULL),
(9, 3, 'App\\Models\\Nsia', NULL, NULL, NULL),
(10, 1, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(11, 1, 'App\\Models\\Marchand', NULL, NULL, NULL),
(12, 2, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(13, 3, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(14, 4, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(15, 5, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(16, 6, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(17, 7, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(18, 8, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(19, 9, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(20, 10, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(21, 11, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(22, 12, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(23, 13, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(24, 14, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(25, 15, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(26, 16, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(27, 17, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(28, 18, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(29, 19, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(30, 20, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(31, 21, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(32, 22, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(33, 23, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(34, 24, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(35, 25, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(36, 26, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(37, 27, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(38, 28, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(39, 29, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(40, 30, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(41, 31, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(42, 32, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(43, 33, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(44, 34, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(45, 35, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(46, 36, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(47, 37, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(48, 38, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(49, 39, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(50, 40, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(51, 41, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(52, 42, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(53, 43, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(54, 44, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(55, 45, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(56, 2, 'App\\Models\\Marchand', NULL, NULL, NULL),
(57, 1, 'App\\Models\\Client', NULL, NULL, NULL),
(58, 1, 'App\\Models\\Assure', NULL, NULL, NULL),
(57, 1, 'App\\Models\\Beneficiaire', NULL, NULL, NULL),
(59, 46, 'App\\Models\\SuperMarchand', NULL, NULL, NULL),
(60, 3, 'App\\Models\\Marchand', NULL, NULL, NULL),
(61, 2, 'App\\Models\\Client', NULL, NULL, NULL),
(61, 2, 'App\\Models\\Assure', NULL, NULL, NULL),
(62, 2, 'App\\Models\\Beneficiaire', NULL, NULL, NULL),
(63, 3, 'App\\Models\\Beneficiaire', NULL, NULL, NULL),
(64, 3, 'App\\Models\\Client', NULL, NULL, NULL),
(64, 3, 'App\\Models\\Assure', NULL, NULL, NULL),
(65, 4, 'App\\Models\\Beneficiaire', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sexe` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ifu` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `situation_matrimoniale` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_sessid` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employeur` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `last_seen_at` timestamp NULL DEFAULT NULL,
  `banned_until` datetime DEFAULT NULL,
  `password` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `commune_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `adresse`, `telephone`, `email`, `sexe`, `ifu`, `date_naissance`, `situation_matrimoniale`, `last_sessid`, `profession`, `employeur`, `picture`, `actif`, `email_verified_at`, `last_seen_at`, `banned_until`, `password`, `remember_token`, `deleted_at`, `created_at`, `updated_at`, `commune_id`) VALUES
(1, 'Mr. Keon Cole', 'Alize Larkin', 'Dr. Lucio D\'Amore Sr.', '97000000', 'esperanza43@example.org', 'Masculin', NULL, '2020-03-05', 'Samanta Collier', NULL, NULL, NULL, NULL, 0, '2020-03-05 04:04:07', '2020-03-08 08:29:06', NULL, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'vlJYxmKQpu5u58zGgyQqNrNWV6Kpzkgm4741P8CYnMgsUK2xtazFgrHybmWC', NULL, '2020-03-05 04:04:07', '2020-03-08 08:29:06', 2),
(2, 'Clotilde Ruecker', 'Aron Dicki', 'Sylvia Boyle', '97000001', 'dayana.metz@example.net', 'Masculin', NULL, '2020-03-05', 'Curtis Wintheiser', NULL, NULL, NULL, NULL, 0, '2020-03-05 04:04:07', NULL, NULL, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'AHKhy8mZ7w', NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07', 2),
(3, 'Jamie Schoen', 'Isidro Zieme V', 'Aimee Little', '97000002', 'stokes.lola@example.net', 'Masculin', NULL, '2020-03-05', 'Celine Mueller', NULL, NULL, NULL, NULL, 0, '2020-03-05 04:04:07', NULL, NULL, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'VDa7u5yWjN', NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07', 2),
(4, 'Tomas Paucek IV', 'Wilford Donnelly', 'Brenden Cummings', '97000003', 'terrill18@example.org', 'Masculin', NULL, '2020-03-05', 'Bertha Gottlieb', NULL, NULL, NULL, NULL, 0, '2020-03-05 04:04:07', NULL, NULL, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'pA8KuI58HB', NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07', 2),
(5, 'Marlin McKenzie Jr.', 'Sheila Stanton', 'Arnulfo Will', '97000004', 'sanford.emelie@example.net', 'Masculin', NULL, '2020-03-05', 'Caesar Koss I', NULL, NULL, NULL, NULL, 0, '2020-03-05 04:04:07', '2020-03-07 16:49:04', NULL, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'tbYjBOEwgKgTY8BfTbwYGa1b2fxcLMgJJeBdxyfvLebApKQTXf41wn6RIbya', NULL, '2020-03-05 04:04:07', '2020-03-07 16:49:04', 2),
(6, 'Prof. Ford Trantow', 'Mathias Sipes', 'Prof. Michelle Kirlin', '97000005', 'mwalter@example.net', 'Masculin', NULL, '2020-03-05', 'Mr. Arturo Leannon', NULL, NULL, NULL, NULL, 0, '2020-03-05 04:04:07', '2020-03-07 16:47:55', NULL, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', '7JSakrHzeJ1iH0l1jQVRh7WH9xXUkdsxj8q1eiNivNzesQ88KrQudBgOElwG', NULL, '2020-03-05 04:04:07', '2020-03-07 16:47:55', 2),
(7, 'Prof. Milan Spencer V', 'Prof. Alanis Kemmer III', 'Mr. Hal Bayer V', '97000006', 'samara.ritchie@example.net', 'Masculin', NULL, '2020-03-05', 'Gregory Gorczany DDS', NULL, NULL, NULL, NULL, 0, '2020-03-05 04:04:07', NULL, NULL, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'j523OssPQa', NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07', 2),
(8, 'Thurman Stark', 'Dante Rempel', 'Casper Breitenberg', '97000007', 'bradley.schimmel@example.org', 'Masculin', NULL, '2020-03-05', 'Bertha Tillman Jr.', NULL, NULL, NULL, NULL, 0, '2020-03-05 04:04:07', NULL, NULL, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'JiBubcyCn3', NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07', 2),
(9, 'Gustave Medhurst', 'Remington Nienow', 'Gail Keeling', '97000008', 'maybelle25@example.net', 'Masculin', NULL, '2020-03-05', 'Mark Hodkiewicz', NULL, NULL, NULL, NULL, 0, '2020-03-05 04:04:07', NULL, NULL, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'ait041Qzx3', NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07', 2),
(10, 'Dora Gibson', 'Lenore Cormier Jr.', 'Josiah Anderson', '97000009', 'jaunita82@example.org', 'Masculin', NULL, '2020-03-05', 'Dr. Vicente Abshire', NULL, NULL, NULL, NULL, 0, '2020-03-05 04:04:07', NULL, NULL, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'HKkUfTamaQ', NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07', 2),
(11, 'Terrence Bartoletti', 'Enrico Balistreri', 'Arnoldo Kirlin', '970000010', 'neal.mitchell@example.com', 'Masculin', NULL, '2020-03-05', 'Arvilla Raynor DDS', NULL, NULL, NULL, NULL, 0, '2020-03-05 04:04:07', NULL, NULL, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', '5iEBW92M8U', NULL, '2020-03-05 04:04:07', '2020-03-05 04:04:07', 2),
(12, 'ASSAN', 'Branly', 'CALAVI ZOGBADJE', '95071520', NULL, NULL, NULL, NULL, NULL, NULL, 'Informaticien', 'NET-DIRECT', NULL, 0, NULL, '2020-03-05 07:33:21', NULL, '$2y$10$5GNbLREolihpVWFvoGVGWeP9uRf.ZJSNUob2Ne2Hl/68N34xe20A6', NULL, NULL, '2020-03-05 04:04:36', '2020-03-05 07:33:21', 16),
(13, 'ADJANOHOUN', 'Jonas', 'Sainte Rita, Cotonou', '96039167', 'adjanohounlandry@gmail.com', 'Masculin', NULL, '1982-06-10', 'Marié(e)', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '$2y$10$nGce3SjqzD5MBJMIAGLP7eQqw/JN738SLGEzDzZ.NmNvgBX1NTL.a', NULL, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36', 48),
(14, 'MOREIRA PINTO', 'Ida', 'Carré 2214 KOUHOUNOU', '95400001', 'idapintomoreira1@gmail.com', 'Feminin', NULL, '1959-02-28', 'Divorcé(e)', NULL, 'RESTAURATRICE', 'LE LAURIER', NULL, 0, NULL, NULL, NULL, '$2y$10$t8xcWT12DbwR4Hh1/UeQzO0Y2zKCFhdjPRAe5JhWmMU5dOupWTODa', NULL, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36', 48),
(15, 'AVIMADJE', 'C. S. Peggy', 'Maison Avimadje / Gbenan, Ouidah', '66409707', 'ovimadjestephane25@gmail.com', 'Masculin', '0201810323599', '1991-01-08', 'Celibataire', NULL, 'Étudiant', NULL, NULL, 0, NULL, NULL, NULL, '$2y$10$JZOvviH/Imth4n.OWcRBc.F9frxXZGA1dDaXGE9.GXKiQlbGoenlW', NULL, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36', 19),
(16, 'DOSSOU-GBETE', 'Coffi Ernest', 'Calavi / Sèmè Maison SB /KOUSSENOUDO', '97447130', 'ernest2002fr@yahoo.fr', 'Masculin', '1201501063908', '1975-11-21', 'Marié(e)', NULL, 'INFORMATICIEN', NULL, NULL, 0, NULL, NULL, NULL, '$2y$10$hYEqPQm6Ciyin33GD31oF.oR02iWHtEOQp2PBlbOElkMn/RGDOstu', NULL, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36', 16),
(17, 'BLIHOUN', 'F. Carnegie', 'Maison Agbandjaï / Houéto', '66664667', 'carnegieblihoun@gmail.com', 'Masculin', NULL, '1986-10-09', 'Marié(e)', NULL, 'Enseignant', NULL, NULL, 0, NULL, NULL, NULL, '$2y$10$noGeCR0XZK46Q4Twi4g4xe/NBK1/hU0xi2UAzvS2BvXp3dtlitIfW', NULL, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36', 16),
(18, 'KOGBEDJI', 'Gbékpododolonmé Racidi', 'Zogbadjé, Maison Quénum', '94196062', 'gkogbedji@gmail.com', NULL, '0201910806938', NULL, NULL, NULL, 'Gérant', NULL, NULL, 0, NULL, NULL, NULL, '$2y$10$TBPwkCnFc3rMeoBP3/5ED.GHB/8LztTPJzyKy5xevXNyl466veB0e', NULL, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36', 16),
(19, 'DJOKO', 'Béni', 'Carré 825 MISSITE', '95841879', 'benidjoko@gmail.com', NULL, '3201001487112', NULL, NULL, NULL, 'Commerçant', 'CANADIME SARL', NULL, 0, NULL, NULL, NULL, '$2y$10$Izz8UK2rV56Hw3MZwzoW1OJ50WH6d3GndpQB2FijGWEFuPXrgxARq', NULL, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36', 48),
(20, 'ADETONAH', 'Baldyne', 'Calvi Tokan', '97243347', 'baldynah@yahoo.fr', 'Feminin', NULL, '1993-09-16', 'Celibataire', NULL, 'Comptable', 'Groupe MMS', NULL, 0, NULL, NULL, NULL, '$2y$10$TAJzvigYvGzllaOsNzmDHewB/bVmtZdSao1ZJc5tKGrNs.Lh6fujC', NULL, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36', 16),
(21, 'YETONDJI', 'IVONICK', 'Abomey', '95787828', NULL, 'Masculin', NULL, '1986-04-10', 'Marié(e)', NULL, 'Comptable', 'UNIVERSITEL', NULL, 0, NULL, NULL, NULL, '$2y$10$JAwKWPiNarDc5pLxEC/gRu08ARmGrQHYJ1aj2PZBEBJ9.bXiwYH8G', NULL, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36', 71),
(22, 'HOUNDJANTO', 'Cyrille', 'MONGNON', '94477597', 'cyrillehoundjanto8@gmail.com', 'Masculin', NULL, '1997-04-19', 'Celibataire', NULL, 'INSTITUTEUR', NULL, NULL, 0, NULL, NULL, NULL, '$2y$10$VP07xqOVMWcw9RxNq5IEKeI10kF0u.P8B.BKgBMGaII5hS2D8Yi6i', NULL, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36', 69),
(23, 'BACHIROU', 'Charlotte A. A. Soubédath', 'C/2076 Monontin, Maison Gninhodanc David', '97678525', 'bachiroucharlotte@gmail.com', 'Feminin', NULL, '1990-11-04', 'Celibataire', NULL, 'Géographe', NULL, NULL, 0, NULL, NULL, NULL, '$2y$10$4MGxeC8fS8em0nD0ZD/l3uXu1Sl6fuqnHWcujOvDezt/XrLF3qYdG', NULL, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36', 48),
(24, 'AMELINA', 'Marguerite', 'C/702 Gbegamey', '96838832', 'amelinamarguerite@gmail.com', 'Feminin', NULL, '1970-12-30', 'Marié(e)', NULL, 'Employée de bureau', 'Caisse CODES', NULL, 0, NULL, NULL, NULL, '$2y$10$dPgoZw90HdONWYfsZOSHLu.xoDC7lwcZwgWLTQbxRwNkts1dJou36', NULL, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36', 48),
(25, 'KPEHOUNTON', 'ROLAND T.', 'Godomey Salamey', '96199039', 'ktognidroland@yahoo.fr', 'Masculin', '1200901879003', '1972-05-13', 'Marié(e)', NULL, 'CONSULTANT FORMATEUR EN GRH', NULL, NULL, 0, NULL, NULL, NULL, '$2y$10$O9xJeLkVXM3ggeFlfYTJbOCVaXcz5IbRCIKCzNSHpmGj4Em/PewSO', NULL, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36', 16),
(26, 'AHOYO', 'Joël Tonankpon Coovi', 'Bp: 43', '97210461', 'ahoyotonankpon@gmail.com', 'Masculin', NULL, '1977-06-13', 'Celibataire', NULL, 'Administrateur RH', NULL, NULL, 0, NULL, NULL, NULL, '$2y$10$8YyxURZPZqvvuWQx1MWxbOlh2VSAIv.mqeO6xxWWAIfAb/pbBJTSi', NULL, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36', 28),
(27, 'MIGNONGNI', 'Coffi Gilbert', 'BANTE', '94120300', NULL, 'Masculin', NULL, '1996-11-08', 'Celibataire', NULL, 'ETUDIANT', NULL, NULL, 0, NULL, NULL, NULL, '$2y$10$MCeGEQvm1RwPrKiw.8c2uuGZ2JFqLLWMisOSjg78yImDhXzoDOaSC', NULL, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36', 32),
(28, 'VISSIN', 'Brice Corneille Edgard', 'Awaké / Togba', '97532508', 'vissinbricecorneille@gmail.com', 'Masculin', NULL, '1965-01-27', 'Marié(e)', NULL, 'Enseignant', NULL, NULL, 0, NULL, NULL, NULL, '$2y$10$qRhvi4U8s8ubB0usppMF3OGtCXUzaXx1v12liQg6j8ge1QZgem1IC', NULL, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36', 16),
(29, 'BOKO', 'LYDIE', 'cocotomey - tokpa', '96545055', 'lydiekboko1@gmail.com', 'Feminin', NULL, '1975-01-01', 'Marié(e)', NULL, 'gestionnaire comptable', NULL, NULL, 0, NULL, NULL, NULL, '$2y$10$BZQxVBZ4WitAnyIyxbqOV.y4bKDkza0f.BPMU55DTfYzPuRgf048G', NULL, NULL, '2020-03-05 04:04:36', '2020-03-05 04:04:36', 16),
(30, 'ALLAGBE', 'William Arnaud', 'Cité la Victoire / Calavi', '97291119', 'nhcgroup@hotmail.fr', NULL, '320110023819', NULL, NULL, NULL, 'Communicateur - Biochimiste', 'NHC', NULL, 0, NULL, NULL, NULL, '$2y$10$DgwrO79osc9hJBWRLH8qhOGvw0OlZg4hFMiDZKnjqBQqfHEgygmHe', NULL, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37', 51),
(31, 'ZIATE', 'ARMEL', 'DOUTOU KPODJI', '97222793', 'ziatearmel@gmail.com', 'Masculin', '1201501999807', '1985-01-01', 'Marié(e)', NULL, 'PROMOTEUR DE CENTRE INFORMATIQUE', NULL, NULL, 0, NULL, NULL, NULL, '$2y$10$BW1MExNmiNLyUCLXZdPWTOd2oAXlAaqe6P5KBxuLw4Y01oqibQ0Im', NULL, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37', 53),
(32, 'NATHO', 'Samuel R.', 'Gbégamey', '96700859', 'nathosamuel1@gmail.com', NULL, NULL, NULL, NULL, NULL, 'Informaticien', NULL, NULL, 0, NULL, NULL, NULL, '$2y$10$MgI0kjpgHykakDtrVEDyuOpwXKe1Yet4swI2oqT214WEkAwmoYo66', NULL, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37', 48),
(33, 'AHOYO AIGBE', 'REMY JONAS', '8e arrondissement Cot - carré 1147 M/AHOYO', '66240420', 'dadjamsarl@gmail.com', NULL, '3201810227513', NULL, NULL, NULL, 'Conseil agricole-Ingénieur agro-industrielle-Comerce', 'DADJRA MAHOULE', NULL, 0, NULL, NULL, NULL, '$2y$10$oo.N6VA0Jc0jbMwS3O74LeEuKStPsKpUXMybCRw.UzbOJmYJ/sYom', NULL, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37', 69),
(34, 'WOUEKPE', 'Fabrice Fiacre', '04BP1433/C Missogbé Maison WOUEKPE', '67043206', 'romeoeric@gmail.com', 'Masculin', NULL, '1991-04-13', 'Celibataire', NULL, 'Technicien hydraulique', NULL, NULL, 0, NULL, NULL, NULL, '$2y$10$mLu9XLhPcoywL3Uglq0NQORVHeePjVLrzTp3H3C9QqU9AMsWtF7qy', NULL, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37', 48),
(35, 'DOVON', 'CHARLES LE BON', 'abomey-calavi', '95361579', 'charleslebond@gmail.com', NULL, '95361579', NULL, NULL, NULL, 'GERANT', 'DOVON & FILS', NULL, 0, NULL, NULL, NULL, '$2y$10$hjegNGikD4HEoRTYNk9LLub5wu2RibJA3EkTo.YGf2gL/lEKU52IS', NULL, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37', 16),
(36, 'GANGBO', 'FROBENIUS JOEL', 'GODOMEY TOGOUDOGBEGNIGAN', '62023949', 'jgangbo@gmail.com', NULL, '3201500313215', NULL, NULL, NULL, 'ASSUREUR', 'EAGLE GROUP INTERNATIONAL SARL', NULL, 0, NULL, NULL, NULL, '$2y$10$3hBXzTF7fkE3RFqL13TlYOjVhso8XCS1eHL.vB7U3abna65HEVWom', NULL, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37', 16),
(37, 'GBETE', 'EUGENE YAOVI', 'Tankpè', '96466860', 'eugenegbete@gmail.com', 'Masculin', '011394A', '1991-02-07', 'Celibataire', NULL, 'Formateur en marketing du réseau', NULL, NULL, 0, NULL, NULL, NULL, '$2y$10$lTsfU/t3P6NqOPXkpdEbI.v5ePEARNfJa7AbcIV/3W72HELJnkima', NULL, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37', 16),
(38, 'FABIYI', 'Robert', 'Akpakpa missessin c/3 m/fabiyi blaise', '97821139', 'fabiyirobert4@gmail.com', 'Masculin', NULL, '1974-04-30', 'Marié(e)', NULL, 'Journaliste', 'Jérôme carlos', NULL, 0, NULL, NULL, NULL, '$2y$10$cn92lBCwWMyWqW9nm2QKd.EA98JWPKvZg9xHqHsjj2mrA24TGvcgq', NULL, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37', 48),
(39, 'NOUGBODE', 'MARCEL COOVI', 'Ouedo m/nougbode', '96198966', 'nougbodemarcel@gmail.com', 'Masculin', NULL, '1985-01-17', 'Celibataire', NULL, 'Informaticien', NULL, NULL, 0, NULL, NULL, NULL, '$2y$10$dhzOdkUqYY8HoSr3d1dEK.oW6wCUbI5Q47X9GXwq4mEtbjZTaYyQu', NULL, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37', 16),
(40, 'ADETONAH', 'LUC ABEL', 'c/1434 m/vedoko', '97383120', NULL, 'Masculin', NULL, '1974-04-29', 'Marié(e)', NULL, 'Promoteur d\'ONG', NULL, NULL, 0, NULL, NULL, NULL, '$2y$10$7UTR0cr.qogHIjmKmv.hXuxN62EkUA9PRWBiO2.DAr0Io94Po0K2O', NULL, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37', 48),
(41, 'FANTCHAO', 'JOSEPH ALBERT', 'Kpakomey/azoue', '94194547', 'totalservicesp.2019@gmail.com', NULL, '0201810207375', NULL, NULL, NULL, 'Entrepreneur', NULL, NULL, 0, NULL, NULL, NULL, '$2y$10$zKxggB6FnCBToGHs2XoHUu8qrcXJmsDbR05rqZQynma9s9cR8avRm', NULL, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37', 38),
(42, 'SOSSAMINOU', 'JEAN-LUC', 'Fidjrossè akogbato', '66111616', 'sojeliesarl@gmail.com', NULL, '3201641660013', NULL, NULL, NULL, 'Commerçant', NULL, NULL, 0, NULL, NULL, NULL, '$2y$10$0W4ny2vvUMHjSASJqxhHUehNzhjonw7IpCDbMCezSZx56doK/RJBm', NULL, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37', 48),
(43, 'AIVETINDE', 'PASCAL', 'Ouedo - abomey calavi', '96445251', NULL, 'Masculin', NULL, '1976-01-13', 'Marié(e)', NULL, 'Mécanicien auto', 'Garage Aipas Junior', NULL, 0, NULL, NULL, NULL, '$2y$10$aduRufhWbvw7Ak2ZsJGGsugYdVvWJ4xZAdEnB1d989EYfw29Y3Xbi', NULL, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37', 16),
(44, 'BALLO KOUZO', 'Bertin Marius', 'Togoudo', '62217588', NULL, 'Masculin', '1201643276303', '1992-08-31', 'Celibataire', NULL, 'Étudiant', NULL, NULL, 0, NULL, NULL, NULL, '$2y$10$qf3iZ76kljl9BLUkz/nhm.v9vzI7Y5XY7A9iI731.mTJMBYIyZuJi', NULL, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37', 16),
(45, 'HOUANSOU', 'Giovanni Nathan Sèdjro', 'Godomey', '66369115', 'leminceart@gmail.com', NULL, '1201400865505', NULL, NULL, NULL, 'Directeur', NULL, NULL, 0, NULL, NULL, NULL, '$2y$10$0u.2kqM4BEvEQ/f4vwsjAedJEivDEWfMr54rpMFFrabhI31tsWr6W', NULL, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37', 48),
(46, 'SIMICLA', 'Alphonse', 'Bohicon /Zakpo', '95216741', NULL, 'Masculin', '0201910855463', '1987-03-15', 'Marié(e)', NULL, 'Technicien Marketing', 'NOCIBE', NULL, 0, NULL, NULL, NULL, '$2y$10$vDCIfo8shfnkOZVkLJ8bTOB/qZ6G/S2l/shv1D9Tr9FlbBze28KuW', NULL, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37', 71),
(47, 'EHOUZOU', 'Marie-Béranger', 'cotonou', '65803384', 'imelleehouzou@gmail.com', 'Feminin', NULL, '1995-05-26', 'Celibataire', NULL, 'comercial MMS', 'GMMS', NULL, 0, NULL, NULL, NULL, '$2y$10$Gahog4c24p3rLWn3OiVTveD.XJVq0P/4XkFAqAUAek5iE3jgaXXhS', NULL, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37', 48),
(48, 'SOGBODODJI', 'Romuald', 'PAHOU', '66261836', 'romualdlinosogbododji@gmail.com', 'Masculin', NULL, '1991-05-15', 'Celibataire', NULL, 'INFORMATICIEN', NULL, NULL, 0, NULL, NULL, NULL, '$2y$10$531Qqt6KvThOlxIerqvd9.cq1QWYfOKQBNPjeBUiP3wF7.X/8iXfW', NULL, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37', 19),
(49, 'TOGUI LOGUI', 'Alberic Romaric', 'womey', '66402146', 'toguilogui64@gmail.com', 'Masculin', NULL, '1993-02-09', 'Celibataire', NULL, 'Agent comercial', 'Groupe MMS', NULL, 0, NULL, NULL, NULL, '$2y$10$6zgLNGc0lSERFQ8xY2rkSuUnoQmq/j9f1lq8/MNO8eUCpqzHwdu4q', NULL, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37', 48),
(50, 'ABDOULAYE', 'Abdel Aziz', 'Parakou', '95965425', 'africoser@gmail.com', NULL, '1201407293908', NULL, NULL, NULL, 'Agronome', NULL, NULL, 0, NULL, NULL, NULL, '$2y$10$UzxizWXI.OQQcYOHBpOYYeas4w7rJdKnIagn0W7uME0yIksfDtxQW', NULL, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37', 28),
(51, 'MISSAINHOUN', 'Judith', 'Cotonou', '96532257', 'j.missainhoun@gmail.com', 'Feminin', '2201000284508', '1979-11-19', 'Marié(e)', NULL, 'Employée institution financière', NULL, NULL, 0, NULL, NULL, NULL, '$2y$10$TeHwCQGQNtRdJDV9CHamM.cddYm59WNRUiw2ej4UTZp80nFxdAMzG', NULL, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37', 48),
(52, 'TOFOHOSSOU', 'Comlan Antoine', 'Houéyiho II / Maison Tossou C/1357', '65584444', 'antoine87.9tof@gmail.com', 'Masculin', NULL, '1991-12-29', 'Celibataire', NULL, 'Étudiant', NULL, NULL, 0, NULL, NULL, NULL, '$2y$10$GWaJpH4V3puPxrMHtiy1Regk0cXNospBgK.vSK.fnriu.4JJ.nPEi', NULL, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37', 32),
(53, 'DANSOU', 'Franck Damien', 'Godomey Usine d\'engrais', '63778311', 'Fdansou34@gmail.com', NULL, '1201501791302', NULL, NULL, NULL, 'Agent d\'assurance', NULL, NULL, 0, NULL, NULL, NULL, '$2y$10$wI7T8SP67QDb.Ei0E2t8PO7OREPkVrOYe10xpjfZZ6Jch/8WuVPvW', NULL, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37', 48),
(54, 'AHOUNGBE', 'Enagnon Aldo Romaric', 'Dékoungbé', '94249831', NULL, 'Masculin', NULL, '1982-09-26', 'Celibataire', NULL, 'Commercial', NULL, NULL, 0, NULL, NULL, NULL, '$2y$10$HtfU5QTiG6LaC4Kn3NrUke3EaSqD.ysA6bW9TqaZ/uArBbq/wkaO6', NULL, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37', 48),
(55, 'LOITCHA', 'Charles', 'Cotonou', '66025855', NULL, 'Masculin', NULL, '1991-11-22', 'Celibataire', NULL, 'Étudiant', NULL, NULL, 0, NULL, NULL, NULL, '$2y$10$rAakn3q7rv7jGvfkzOqXX.VyjwWX5kNF/y0nW2PLx.Im3AFeC8Xd2', NULL, NULL, '2020-03-05 04:04:37', '2020-03-05 04:04:37', 48),
(56, 'HOUNKONNOU', 'LUCRECE', 'COTONOU', '62945095', NULL, 'Feminin', NULL, '1999-09-09', 'Marié(e)', NULL, 'ETUDIANT', 'AZ', NULL, 0, NULL, '2020-03-07 16:44:26', NULL, '$2y$10$PP8oz05TcE0hX0E6GYsp..VjLlGlRcS4FowVhNnyRvZyy7dI5vmf6', NULL, NULL, '2020-03-05 07:33:15', '2020-03-07 16:44:26', 16),
(57, 'SOUSOUDJI', 'KADNEL', 'Cotonou', '97967833', NULL, 'Masculin', NULL, '1999-09-09', 'Marié(e)', NULL, 'ELEVE', NULL, NULL, 0, NULL, '2020-03-07 16:30:56', NULL, '$2y$10$9fNwOpD3Xtx4cD5krEfVneZoHa9Jwcqcphf0hNym/Oh2.FHOcl3JW', NULL, NULL, '2020-03-05 10:37:28', '2020-03-07 16:30:56', 16),
(58, 'TOTO', 'ZZZZ', 'Cotonou', '9796783344', NULL, 'Masculin', NULL, '1999-09-09', 'Marié(e)', NULL, 'FZRFREG', NULL, NULL, 0, NULL, NULL, NULL, '$2y$10$Bs30Es9IZ82AuIgeAtBg6OS/N60mKEFgRWnyFdI7d8yorgFdrmHMq', NULL, NULL, '2020-03-05 10:37:28', '2020-03-05 10:37:28', 16),
(59, 'DOE', 'John', 'Akpakpa', '07896545', NULL, 'Masculin', NULL, '1978-03-05', 'Marié(e)', NULL, NULL, NULL, NULL, 0, NULL, '2020-03-08 08:36:14', NULL, '$2y$10$dDiChvzsMiwCGOFLn0KH/uZ4wU67zX8YEUQ/VvYxnTwH3YSjJXhgW', NULL, NULL, '2020-03-07 16:09:37', '2020-03-08 08:36:14', 48),
(60, 'Afolabi', 'Jean', 'Akpakpa / Ciné Concorde', '369852', 'afolabijean@gmail.com', 'Masculin', NULL, '1991-03-18', 'Celibataire', NULL, NULL, NULL, NULL, 0, NULL, '2020-03-07 17:03:00', NULL, '$2y$10$oTfH35PDbEBuwdnm6FYeX.scFX4aykMAmSdA/0sKGxLcbtYHL9Tta', NULL, NULL, '2020-03-07 16:15:28', '2020-03-07 17:03:00', 48),
(61, 'ADEBIYI', 'Jeanne', 'Tokpa', '99151256', NULL, 'Feminin', NULL, '1978-05-23', 'Marié(e)', NULL, 'Employée de banque', 'BOA', NULL, 0, NULL, NULL, NULL, '$2y$10$EeuHTR5tJLxNYnx004J9NuOnKja79aHo58o7rQ977Y6gBLowxFfTy', NULL, NULL, '2020-03-07 16:45:08', '2020-03-07 16:45:08', 48),
(62, 'Gbian', 'Mélanie', 'Tokpa', '78968574', NULL, 'Feminin', NULL, '1978-10-05', 'Marié(e)', NULL, 'Commerçante', 'N/A', NULL, 0, NULL, NULL, NULL, '$2y$10$6PO6x5I7tit1Kqm7cst4ueVLnG6jo1hLhdsn2ERHbOt.WUNZ0gDZa', NULL, NULL, '2020-03-07 16:51:26', '2020-03-07 16:51:26', 48),
(63, 'Gbian', 'Charles', 'DG', '326', NULL, 'Masculin', NULL, '2017-03-11', 'Celibataire', NULL, 'NA', 'NA', NULL, 0, NULL, NULL, NULL, '$2y$10$SW1fjfmjvn9xJyKQIdpuQe/WZq98GEfRzV92D1q2aH9KgcnNhUTsy', NULL, NULL, '2020-03-07 16:51:26', '2020-03-07 16:51:26', 48),
(64, 'Dujardin', 'Jean', 'SD', '96254399', NULL, 'Masculin', NULL, '1976-03-07', 'Marié(e)', NULL, 'NA', 'NA', NULL, 0, NULL, NULL, NULL, '$2y$10$tNO7HnhYLFDJluvhVwPhiu0b7OKYAfgSKV4CPEwsmpiS01dA7t9k.', NULL, NULL, '2020-03-07 16:56:10', '2020-03-07 16:56:10', 48),
(65, 'Dujardin', 'Aline', 'SD', '233', NULL, 'Feminin', NULL, '2018-04-03', 'Celibataire', NULL, 'DS', 'DS', NULL, 0, NULL, NULL, NULL, '$2y$10$LoKzMQcCbI2sB7PDH4dTC.WU4Qa3BNLPtzE7cC7P90yDx7y/vAOpi', NULL, NULL, '2020-03-07 16:57:28', '2020-03-07 16:57:28', 48);

-- --------------------------------------------------------

--
-- Structure de la table `wallets`
--

CREATE TABLE `wallets` (
  `id` int(10) UNSIGNED NOT NULL,
  `holder_type` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `holder_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` bigint(20) NOT NULL DEFAULT '0',
  `decimal_places` smallint(6) NOT NULL DEFAULT '2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `wallets`
--

INSERT INTO `wallets` (`id`, `holder_type`, `holder_id`, `name`, `slug`, `description`, `balance`, `decimal_places`, `created_at`, `updated_at`) VALUES
(1, 'App\\User', 1, 'Solde Principal', 'principal', NULL, 20000, 2, '2020-03-05 04:04:07', '2020-03-07 16:57:52'),
(2, 'App\\User', 1, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(3, 'App\\User', 1, 'Solde Commission', 'commission', NULL, 1850, 2, '2020-03-05 04:04:07', '2020-03-07 17:01:08'),
(4, 'App\\User', 2, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(5, 'App\\User', 2, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(6, 'App\\User', 2, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(7, 'App\\User', 3, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(8, 'App\\User', 3, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(9, 'App\\User', 3, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(10, 'App\\User', 4, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(11, 'App\\User', 4, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(12, 'App\\User', 4, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(13, 'App\\User', 5, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(14, 'App\\User', 5, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(15, 'App\\User', 5, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(16, 'App\\User', 6, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(17, 'App\\User', 6, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(18, 'App\\User', 6, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(19, 'App\\User', 7, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(20, 'App\\User', 7, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(21, 'App\\User', 7, 'Solde Commission', 'commission', NULL, 20250, 2, '2020-03-05 04:04:07', '2020-03-07 17:01:08'),
(22, 'App\\User', 8, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(23, 'App\\User', 8, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(24, 'App\\User', 8, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(25, 'App\\User', 9, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(26, 'App\\User', 9, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(27, 'App\\User', 9, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(28, 'App\\User', 10, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(29, 'App\\User', 10, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(30, 'App\\User', 10, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(31, 'App\\User', 11, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(32, 'App\\User', 11, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(33, 'App\\User', 11, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:07', '2020-03-05 04:04:07'),
(34, 'App\\User', 12, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(35, 'App\\User', 12, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(36, 'App\\User', 12, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(37, 'App\\User', 13, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(38, 'App\\User', 13, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(39, 'App\\User', 13, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(40, 'App\\User', 14, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(41, 'App\\User', 14, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(42, 'App\\User', 14, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(43, 'App\\User', 15, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(44, 'App\\User', 15, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(45, 'App\\User', 15, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(46, 'App\\User', 16, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(47, 'App\\User', 16, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(48, 'App\\User', 16, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(49, 'App\\User', 17, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(50, 'App\\User', 17, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(51, 'App\\User', 17, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(52, 'App\\User', 18, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(53, 'App\\User', 18, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(54, 'App\\User', 18, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(55, 'App\\User', 19, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(56, 'App\\User', 19, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(57, 'App\\User', 19, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(58, 'App\\User', 20, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(59, 'App\\User', 20, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(60, 'App\\User', 20, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(61, 'App\\User', 21, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(62, 'App\\User', 21, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(63, 'App\\User', 21, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(64, 'App\\User', 22, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(65, 'App\\User', 22, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(66, 'App\\User', 22, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(67, 'App\\User', 23, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(68, 'App\\User', 23, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(69, 'App\\User', 23, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(70, 'App\\User', 24, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(71, 'App\\User', 24, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(72, 'App\\User', 24, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(73, 'App\\User', 25, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(74, 'App\\User', 25, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(75, 'App\\User', 25, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(76, 'App\\User', 26, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(77, 'App\\User', 26, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(78, 'App\\User', 26, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(79, 'App\\User', 27, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(80, 'App\\User', 27, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(81, 'App\\User', 27, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(82, 'App\\User', 28, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(83, 'App\\User', 28, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(84, 'App\\User', 28, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(85, 'App\\User', 29, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(86, 'App\\User', 29, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(87, 'App\\User', 29, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:36', '2020-03-05 04:04:36'),
(88, 'App\\User', 30, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(89, 'App\\User', 30, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(90, 'App\\User', 30, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(91, 'App\\User', 31, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(92, 'App\\User', 31, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(93, 'App\\User', 31, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(94, 'App\\User', 32, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(95, 'App\\User', 32, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(96, 'App\\User', 32, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(97, 'App\\User', 33, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(98, 'App\\User', 33, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(99, 'App\\User', 33, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(100, 'App\\User', 34, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(101, 'App\\User', 34, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(102, 'App\\User', 34, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(103, 'App\\User', 35, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(104, 'App\\User', 35, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(105, 'App\\User', 35, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(106, 'App\\User', 36, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(107, 'App\\User', 36, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(108, 'App\\User', 36, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(109, 'App\\User', 37, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(110, 'App\\User', 37, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(111, 'App\\User', 37, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(112, 'App\\User', 38, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(113, 'App\\User', 38, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(114, 'App\\User', 38, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(115, 'App\\User', 39, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(116, 'App\\User', 39, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(117, 'App\\User', 39, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(118, 'App\\User', 40, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(119, 'App\\User', 40, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(120, 'App\\User', 40, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(121, 'App\\User', 41, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(122, 'App\\User', 41, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(123, 'App\\User', 41, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(124, 'App\\User', 42, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(125, 'App\\User', 42, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(126, 'App\\User', 42, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(127, 'App\\User', 43, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(128, 'App\\User', 43, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(129, 'App\\User', 43, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(130, 'App\\User', 44, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(131, 'App\\User', 44, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(132, 'App\\User', 44, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(133, 'App\\User', 45, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(134, 'App\\User', 45, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(135, 'App\\User', 45, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(136, 'App\\User', 46, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(137, 'App\\User', 46, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(138, 'App\\User', 46, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(139, 'App\\User', 47, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(140, 'App\\User', 47, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(141, 'App\\User', 47, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(142, 'App\\User', 48, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(143, 'App\\User', 48, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(144, 'App\\User', 48, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(145, 'App\\User', 49, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(146, 'App\\User', 49, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(147, 'App\\User', 49, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(148, 'App\\User', 50, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(149, 'App\\User', 50, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(150, 'App\\User', 50, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(151, 'App\\User', 51, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(152, 'App\\User', 51, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(153, 'App\\User', 51, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(154, 'App\\User', 52, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(155, 'App\\User', 52, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(156, 'App\\User', 52, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(157, 'App\\User', 53, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(158, 'App\\User', 53, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(159, 'App\\User', 53, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(160, 'App\\User', 54, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(161, 'App\\User', 54, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(162, 'App\\User', 54, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(163, 'App\\User', 55, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(164, 'App\\User', 55, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(165, 'App\\User', 55, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 04:04:37', '2020-03-05 04:04:37'),
(166, 'App\\User', 56, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-05 07:33:21', '2020-03-05 07:33:21'),
(167, 'App\\User', 56, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-05 07:33:21', '2020-03-05 07:33:21'),
(168, 'App\\User', 56, 'Solde Commission', 'commission', NULL, 0, 2, '2020-03-05 07:33:21', '2020-03-05 07:33:21'),
(169, 'App\\User', 59, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-07 16:09:42', '2020-03-07 16:09:42'),
(170, 'App\\User', 59, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-07 16:09:42', '2020-03-07 16:09:42'),
(171, 'App\\User', 59, 'Solde Commission', 'commission', NULL, 2300, 2, '2020-03-07 16:09:42', '2020-03-07 17:01:07'),
(172, 'App\\User', 60, 'Solde Principal', 'principal', NULL, 0, 2, '2020-03-07 16:15:31', '2020-03-07 16:15:31'),
(173, 'App\\User', 60, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-07 16:15:31', '2020-03-07 16:15:31'),
(174, 'App\\User', 60, 'Solde Commission', 'commission', NULL, 5600, 2, '2020-03-07 16:15:31', '2020-03-07 17:01:07'),
(175, 'App\\User', 64, 'Default Wallet', 'default', NULL, 0, 2, '2020-03-07 17:00:04', '2020-03-07 17:00:04');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `assures`
--
ALTER TABLE `assures`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `beneficiaires`
--
ALTER TABLE `beneficiaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_marchand_id_foreign` (`marchand_id`);

--
-- Index pour la table `communes`
--
ALTER TABLE `communes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `communes_departement_id_foreign` (`departement_id`);

--
-- Index pour la table `contrats`
--
ALTER TABLE `contrats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contrats_client_id_foreign` (`client_id`),
  ADD KEY `contrats_assure_id_foreign` (`assure_id`);

--
-- Index pour la table `contrat_beneficiaire`
--
ALTER TABLE `contrat_beneficiaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contrat_beneficiaire_beneficiaire_id_foreign` (`beneficiaire_id`),
  ADD KEY `contrat_beneficiaire_contrat_id_foreign` (`contrat_id`);

--
-- Index pour la table `contrat_marchand`
--
ALTER TABLE `contrat_marchand`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contrat_marchand_marchand_id_foreign` (`marchand_id`),
  ADD KEY `contrat_marchand_contrat_id_foreign` (`contrat_id`);

--
-- Index pour la table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `directions`
--
ALTER TABLE `directions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etats`
--
ALTER TABLE `etats`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fichiers`
--
ALTER TABLE `fichiers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `marchands`
--
ALTER TABLE `marchands`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `marchand_super_marchand`
--
ALTER TABLE `marchand_super_marchand`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marchand_super_marchand_marchand_id_foreign` (`marchand_id`),
  ADD KEY `marchand_super_marchand_super_marchand_id_foreign` (`super_marchand_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mobile_money`
--
ALTER TABLE `mobile_money`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mobile_money_user_id_foreign` (`user_id`);

--
-- Index pour la table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Index pour la table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Index pour la table `nsias`
--
ALTER TABLE `nsias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nsias_direction_id_foreign` (`direction_id`);

--
-- Index pour la table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Index pour la table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Index pour la table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Index pour la table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `primes`
--
ALTER TABLE `primes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `primes_souscription_id_foreign` (`souscription_id`),
  ADD KEY `primes_user_id_foreign` (`user_id`);

--
-- Index pour la table `prospects`
--
ALTER TABLE `prospects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prospects_commune_id_foreign` (`commune_id`),
  ADD KEY `prospects_marchand_id_foreign` (`marchand_id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Index pour la table `sinistres`
--
ALTER TABLE `sinistres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sinistres_client_id_foreign` (`client_id`),
  ADD KEY `sinistres_contrat_id_foreign` (`contrat_id`);

--
-- Index pour la table `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sms_from_foreign` (`from`),
  ADD KEY `sms_to_foreign` (`to`);

--
-- Index pour la table `soldes`
--
ALTER TABLE `soldes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `souscriptions`
--
ALTER TABLE `souscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `souscriptions_contrat_id_foreign` (`contrat_id`),
  ADD KEY `souscriptions_user_id_foreign` (`user_id`);

--
-- Index pour la table `souscription_statut_souscription`
--
ALTER TABLE `souscription_statut_souscription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `souscription_statut_souscription_souscription_id_foreign` (`souscription_id`),
  ADD KEY `souscription_statut_souscription_statut_souscription_id_foreign` (`statut_souscription_id`),
  ADD KEY `souscription_statut_souscription_user_id_foreign` (`user_id`);

--
-- Index pour la table `statut_souscriptions`
--
ALTER TABLE `statut_souscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `super_marchands`
--
ALTER TABLE `super_marchands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `super_marchands_direction_id_foreign` (`direction_id`);

--
-- Index pour la table `tempp`
--
ALTER TABLE `tempp`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_uuid_unique` (`uuid`),
  ADD KEY `transactions_payable_type_payable_id_index` (`payable_type`,`payable_id`),
  ADD KEY `payable_type_ind` (`payable_type`,`payable_id`,`type`),
  ADD KEY `payable_confirmed_ind` (`payable_type`,`payable_id`,`confirmed`),
  ADD KEY `payable_type_confirmed_ind` (`payable_type`,`payable_id`,`type`,`confirmed`),
  ADD KEY `transactions_type_index` (`type`),
  ADD KEY `transactions_wallet_id_foreign` (`wallet_id`);

--
-- Index pour la table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transfers_uuid_unique` (`uuid`),
  ADD KEY `transfers_from_type_from_id_index` (`from_type`,`from_id`),
  ADD KEY `transfers_to_type_to_id_index` (`to_type`,`to_id`),
  ADD KEY `transfers_deposit_id_foreign` (`deposit_id`),
  ADD KEY `transfers_withdraw_id_foreign` (`withdraw_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_telephone_unique` (`telephone`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_commune_id_foreign` (`commune_id`);

--
-- Index pour la table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wallets_holder_type_holder_id_slug_unique` (`holder_type`,`holder_id`,`slug`),
  ADD KEY `wallets_holder_type_holder_id_index` (`holder_type`,`holder_id`),
  ADD KEY `wallets_slug_index` (`slug`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `assures`
--
ALTER TABLE `assures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `beneficiaires`
--
ALTER TABLE `beneficiaires`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `communes`
--
ALTER TABLE `communes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT pour la table `contrats`
--
ALTER TABLE `contrats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `contrat_beneficiaire`
--
ALTER TABLE `contrat_beneficiaire`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `contrat_marchand`
--
ALTER TABLE `contrat_marchand`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `departements`
--
ALTER TABLE `departements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `directions`
--
ALTER TABLE `directions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `etats`
--
ALTER TABLE `etats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fichiers`
--
ALTER TABLE `fichiers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `marchands`
--
ALTER TABLE `marchands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `marchand_super_marchand`
--
ALTER TABLE `marchand_super_marchand`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT pour la table `mobile_money`
--
ALTER TABLE `mobile_money`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `nsias`
--
ALTER TABLE `nsias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT pour la table `primes`
--
ALTER TABLE `primes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `prospects`
--
ALTER TABLE `prospects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `sinistres`
--
ALTER TABLE `sinistres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `sms`
--
ALTER TABLE `sms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `soldes`
--
ALTER TABLE `soldes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `souscriptions`
--
ALTER TABLE `souscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `souscription_statut_souscription`
--
ALTER TABLE `souscription_statut_souscription`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `statut_souscriptions`
--
ALTER TABLE `statut_souscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `super_marchands`
--
ALTER TABLE `super_marchands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT pour la table `tempp`
--
ALTER TABLE `tempp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT pour la table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_marchand_id_foreign` FOREIGN KEY (`marchand_id`) REFERENCES `marchands` (`id`);

--
-- Contraintes pour la table `communes`
--
ALTER TABLE `communes`
  ADD CONSTRAINT `communes_departement_id_foreign` FOREIGN KEY (`departement_id`) REFERENCES `departements` (`id`);

--
-- Contraintes pour la table `contrats`
--
ALTER TABLE `contrats`
  ADD CONSTRAINT `contrats_assure_id_foreign` FOREIGN KEY (`assure_id`) REFERENCES `assures` (`id`),
  ADD CONSTRAINT `contrats_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Contraintes pour la table `contrat_beneficiaire`
--
ALTER TABLE `contrat_beneficiaire`
  ADD CONSTRAINT `contrat_beneficiaire_beneficiaire_id_foreign` FOREIGN KEY (`beneficiaire_id`) REFERENCES `beneficiaires` (`id`),
  ADD CONSTRAINT `contrat_beneficiaire_contrat_id_foreign` FOREIGN KEY (`contrat_id`) REFERENCES `contrats` (`id`);

--
-- Contraintes pour la table `contrat_marchand`
--
ALTER TABLE `contrat_marchand`
  ADD CONSTRAINT `contrat_marchand_contrat_id_foreign` FOREIGN KEY (`contrat_id`) REFERENCES `contrats` (`id`),
  ADD CONSTRAINT `contrat_marchand_marchand_id_foreign` FOREIGN KEY (`marchand_id`) REFERENCES `marchands` (`id`);

--
-- Contraintes pour la table `marchand_super_marchand`
--
ALTER TABLE `marchand_super_marchand`
  ADD CONSTRAINT `marchand_super_marchand_marchand_id_foreign` FOREIGN KEY (`marchand_id`) REFERENCES `marchands` (`id`),
  ADD CONSTRAINT `marchand_super_marchand_super_marchand_id_foreign` FOREIGN KEY (`super_marchand_id`) REFERENCES `super_marchands` (`id`);

--
-- Contraintes pour la table `mobile_money`
--
ALTER TABLE `mobile_money`
  ADD CONSTRAINT `mobile_money_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `nsias`
--
ALTER TABLE `nsias`
  ADD CONSTRAINT `nsias_direction_id_foreign` FOREIGN KEY (`direction_id`) REFERENCES `directions` (`id`);

--
-- Contraintes pour la table `primes`
--
ALTER TABLE `primes`
  ADD CONSTRAINT `primes_souscription_id_foreign` FOREIGN KEY (`souscription_id`) REFERENCES `souscriptions` (`id`),
  ADD CONSTRAINT `primes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `prospects`
--
ALTER TABLE `prospects`
  ADD CONSTRAINT `prospects_commune_id_foreign` FOREIGN KEY (`commune_id`) REFERENCES `communes` (`id`),
  ADD CONSTRAINT `prospects_marchand_id_foreign` FOREIGN KEY (`marchand_id`) REFERENCES `marchands` (`id`);

--
-- Contraintes pour la table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `sinistres`
--
ALTER TABLE `sinistres`
  ADD CONSTRAINT `sinistres_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `sinistres_contrat_id_foreign` FOREIGN KEY (`contrat_id`) REFERENCES `contrats` (`id`);

--
-- Contraintes pour la table `sms`
--
ALTER TABLE `sms`
  ADD CONSTRAINT `sms_from_foreign` FOREIGN KEY (`from`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `sms_to_foreign` FOREIGN KEY (`to`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `souscriptions`
--
ALTER TABLE `souscriptions`
  ADD CONSTRAINT `souscriptions_contrat_id_foreign` FOREIGN KEY (`contrat_id`) REFERENCES `contrats` (`id`),
  ADD CONSTRAINT `souscriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `souscription_statut_souscription`
--
ALTER TABLE `souscription_statut_souscription`
  ADD CONSTRAINT `souscription_statut_souscription_souscription_id_foreign` FOREIGN KEY (`souscription_id`) REFERENCES `contrats` (`id`),
  ADD CONSTRAINT `souscription_statut_souscription_statut_souscription_id_foreign` FOREIGN KEY (`statut_souscription_id`) REFERENCES `statut_souscriptions` (`id`),
  ADD CONSTRAINT `souscription_statut_souscription_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `super_marchands`
--
ALTER TABLE `super_marchands`
  ADD CONSTRAINT `super_marchands_direction_id_foreign` FOREIGN KEY (`direction_id`) REFERENCES `directions` (`id`);

--
-- Contraintes pour la table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `transfers`
--
ALTER TABLE `transfers`
  ADD CONSTRAINT `transfers_deposit_id_foreign` FOREIGN KEY (`deposit_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transfers_withdraw_id_foreign` FOREIGN KEY (`withdraw_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_commune_id_foreign` FOREIGN KEY (`commune_id`) REFERENCES `communes` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
