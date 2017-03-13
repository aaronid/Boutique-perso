-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Dim 13 Mars 2011 à 13:40
-- Version du serveur: 5.1.36
-- Version de PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `boutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `numclient` int(5) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `prenom` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `adr1` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `adr2` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `cp` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `ville` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `infoslivraison` text COLLATE latin1_general_ci,
  `tel` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `mail` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `login` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `mdp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`numclient`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`numclient`, `nom`, `prenom`, `adr1`, `adr2`, `cp`, `ville`, `infoslivraison`, `tel`, `mail`, `login`, `mdp`) VALUES
(1, 'BERNARD', 'Claude', 'Les Platanes', '35 av des Oliviers', '06000', 'Nice', 'en haut de résidence', '0625252525', 'claude.bernard@free.fr', 'cb', 'toto'),
(2, 'DUPONT', 'Jacques', 'av des fleurs', '', '06000', 'Nice', '', '0606060606', '', 'essai', 'essai');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `numcommande` int(5) NOT NULL AUTO_INCREMENT,
  `datecommande` date NOT NULL,
  `livraisonok` tinyint(1) NOT NULL,
  `numclient` int(5) NOT NULL,
  PRIMARY KEY (`numcommande`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Contenu de la table `commande`
--


-- --------------------------------------------------------

--
-- Structure de la table `lignecom`
--

CREATE TABLE IF NOT EXISTS `lignecom` (
  `numcommande` int(5) NOT NULL,
  `nomarticle` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `qte` int(3) NOT NULL,
  PRIMARY KEY (`numcommande`,`nomarticle`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Contenu de la table `lignecom`
--


-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE IF NOT EXISTS `panier` (
  `idclient` int(5) NOT NULL,
  `idarticle` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

