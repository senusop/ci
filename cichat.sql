-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 12. Januari 2016 jam 20:35
-- Versi Server: 5.1.41
-- Versi PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cichat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `avatar`
--

CREATE TABLE IF NOT EXISTS `avatar` (
  `avatar_id` int(10) NOT NULL AUTO_INCREMENT,
  `avatar_name` varchar(250) NOT NULL,
  `path` varchar(200) NOT NULL,
  `avatar` varchar(200) NOT NULL,
  PRIMARY KEY (`avatar_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data untuk tabel `avatar`
--

INSERT INTO `avatar` (`avatar_id`, `avatar_name`, `path`, `avatar`) VALUES
(1, 'avatar1', 'images/avatar', 'avatar1.jpg'),
(2, 'avatar2', 'images/avatar', 'avatar2.jpg'),
(4, 'avatar3', 'images/avatar', 'avatar3.jpg'),
(5, 'avatar4', 'images/avatar', 'avatar4.jpg'),
(6, 'avatar5', 'images/avatar', 'avatar5.jpg'),
(7, 'avatar6', 'images/avatar', 'avatar6.jpg'),
(8, 'avatar7', 'images/avatar', 'avatar7.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `id_chat` int(99) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pesan` text NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_chat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=104 ;

--
-- Dumping data untuk tabel `chat`
--

INSERT INTO `chat` (`id_chat`, `user`, `waktu`, `pesan`, `id_user`) VALUES
(103, 'usopp', '2016-01-12 20:24:36', '14722 12763 7158 4358 2479 4358 6345 6201 1494 4358 6345 4358 15351 8480 6201 1494 11189 6201 14722 11189 15351 11189', 118);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `level` varchar(6) NOT NULL,
  `email` varchar(200) NOT NULL,
  `dateRegister` date NOT NULL,
  `path` varchar(200) NOT NULL,
  `avatar` varchar(210) NOT NULL,
  `on` int(2) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=119 ;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama`, `level`, `email`, `dateRegister`, `path`, `avatar`, `on`) VALUES
(116, 'sentk', 'd96f686108f23c7fdb318a421bed1e2a', 'sent', 'member', 'sent@gmail.com', '2016-01-12', './users/sentk/img/avatar', '1452604522.jpg', 0),
(117, 'gaara', 'd96f686108f23c7fdb318a421bed1e2a', 'gaara', 'member', 'gaara@gmail.com', '2016-01-12', './users/gaara/img/avatar', '1452604868.jpg', 0),
(118, 'usopp', 'd96f686108f23c7fdb318a421bed1e2a', 'usopp', 'member', 'usop@gmail.com', '2016-01-12', './users/usopp/img/avatar', '1452605043.jpg', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
