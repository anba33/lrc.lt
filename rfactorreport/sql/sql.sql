-- phpMyAdmin SQL Dump
-- version 2.7.0-pl1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generatie Tijd: 23 Feb 2006 om 17:41
-- Server versie: 5.0.18
-- PHP Versie: 4.4.1-pl1
-- 
-- Database: `rfactorreport`
-- 

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `driverstandings`
-- 

CREATE TABLE `driverstandings` (
  `drivername` text collate latin1_general_ci NOT NULL,
  `team` text collate latin1_general_ci NOT NULL,
  `poles` tinyint(4) NOT NULL,
  `wins` tinyint(4) NOT NULL,
  `fastestlaps` tinyint(4) NOT NULL,
  `points` mediumint(9) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `fastestlaps`
-- 

CREATE TABLE `fastestlaps` (
  `rfactorreportid` bigint(20) NOT NULL,
  `servername` text collate latin1_general_ci NOT NULL,
  `trackname` text collate latin1_general_ci NOT NULL,
  `position` tinyint(4) NOT NULL,
  `drivername` text collate latin1_general_ci NOT NULL,
  `carnumber` tinyint(4) NOT NULL,
  `cartype` text collate latin1_general_ci NOT NULL,
  `team` text collate latin1_general_ci NOT NULL,
  `time` text collate latin1_general_ci NOT NULL,
  `exported` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `fastests1`
-- 

CREATE TABLE `fastests1` (
  `rfactorreportid` bigint(4) NOT NULL,
  `servername` text collate latin1_general_ci NOT NULL,
  `trackname` text collate latin1_general_ci NOT NULL,
  `position` tinyint(4) NOT NULL,
  `drivername` text collate latin1_general_ci NOT NULL,
  `carnumber` tinyint(4) NOT NULL,
  `cartype` text collate latin1_general_ci NOT NULL,
  `team` text collate latin1_general_ci NOT NULL,
  `time` text collate latin1_general_ci NOT NULL,
  `exported` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `fastests2`
-- 

CREATE TABLE `fastests2` (
  `rfactorreportid` bigint(4) NOT NULL,
  `servername` text collate latin1_general_ci NOT NULL,
  `trackname` text collate latin1_general_ci NOT NULL,
  `position` tinyint(4) NOT NULL,
  `drivername` text collate latin1_general_ci NOT NULL,
  `carnumber` tinyint(4) NOT NULL,
  `cartype` text collate latin1_general_ci NOT NULL,
  `team` text collate latin1_general_ci NOT NULL,
  `time` text collate latin1_general_ci NOT NULL,
  `exported` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `fastests3`
-- 

CREATE TABLE `fastests3` (
  `rfactorreportid` bigint(4) NOT NULL,
  `servername` text collate latin1_general_ci NOT NULL,
  `trackname` text collate latin1_general_ci NOT NULL,
  `position` tinyint(4) NOT NULL,
  `drivername` text collate latin1_general_ci NOT NULL,
  `carnumber` tinyint(4) NOT NULL,
  `cartype` text collate latin1_general_ci NOT NULL,
  `team` text collate latin1_general_ci NOT NULL,
  `time` text collate latin1_general_ci NOT NULL,
  `exported` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `qualificationresults`
-- 

CREATE TABLE `qualificationresults` (
  `rfactorreportid` bigint(4) NOT NULL,
  `servername` text collate latin1_general_ci NOT NULL,
  `trackname` text collate latin1_general_ci NOT NULL,
  `position` tinyint(4) NOT NULL,
  `drivername` text collate latin1_general_ci NOT NULL,
  `carnumber` tinyint(4) NOT NULL,
  `cartype` text collate latin1_general_ci NOT NULL,
  `team` text collate latin1_general_ci NOT NULL,
  `time` text collate latin1_general_ci NOT NULL,
  `exported` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

-- 
-- Tabel structuur voor tabel `raceresults`
-- 

CREATE TABLE `raceresults` (
  `rfactorreportid` bigint(4) NOT NULL,
  `servername` text collate latin1_general_ci NOT NULL,
  `trackname` text collate latin1_general_ci NOT NULL,
  `position` tinyint(4) NOT NULL,
  `drivername` text collate latin1_general_ci NOT NULL,
  `carnumber` tinyint(4) NOT NULL,
  `cartype` text collate latin1_general_ci NOT NULL,
  `team` text collate latin1_general_ci NOT NULL,
  `time` text collate latin1_general_ci NOT NULL,
  `laps` tinyint(4) NOT NULL,
  `pitstops` text collate latin1_general_ci NOT NULL,
  `exported` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;