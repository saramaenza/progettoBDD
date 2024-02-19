-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 25, 2020 alle 01:44
-- Versione del server: 10.1.38-MariaDB
-- Versione PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `progetto`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `blog`
--

CREATE TABLE `blog` (
  `id_blog` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `font` varchar(20) NOT NULL,
  `sfondo` varchar(10) NOT NULL,
  `nome_utente` varchar(20) NOT NULL,
  `tema` varchar(20) NOT NULL,
  `coautore` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `blog`
--

INSERT INTO `blog` (`id_blog`, `nome`, `font`, `sfondo`, `nome_utente`, `tema`, `coautore`) VALUES
(15, 'Gattosamente', 'Book Antiqua', '#e3d655', 'saramaenza', 'gatti', 'gaiasasso'),
(16, 'TV Addicted', 'Century Gothic', '#e4b098', 'saramaenza', 'serie tv', ''),
(17, 'Show must go on', 'Book Antiqua', '#ff80c0', 'gaiasasso', 'serie tv', 'luciabianchi88'),
(18, 'Passione canina', 'Comic Sans MS', '#808000', 'luciabianchi88', 'Cani', ''),
(19, 'Londra', 'arial', '#0080c0', 'gaiasasso', 'viaggi', ''),
(20, 'Dolci, che passione!', 'calibri', '#c2794e', 'mrossi', 'cibo', 'luciabianchi88'),
(21, 'Pastamania', 'century', '#ffff80', 'mrossi', 'cibo', 'saramaenza'),
(22, 'cucinare le uova', 'Century Gothic', '#ff6060', 'mrossi', 'cibo', ''),
(23, 'il cuoco perfetto', 'corbel', '#8080c0', 'mrossi', 'cibo', ''),
(24, 'Motori ruggenti', 'garamond', '#e2323f', 'luca1995', 'macchine', ''),
(25, 'Coldplay', 'calibri', '#48f49a', 'luciabianchi88', 'musica', ''),
(26, 'Adele', 'verdana', '#afc0cf', 'gaiasasso', 'musica', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `commenti`
--

CREATE TABLE `commenti` (
  `testo` varchar(120) NOT NULL,
  `nome_utente` varchar(20) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_commento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `commenti`
--

INSERT INTO `commenti` (`testo`, `nome_utente`, `id_post`, `id_commento`) VALUES
('Hai proprio ragione!	', 'gaiasasso', 30, 3),
('Troppo bella				', 'gaiasasso', 28, 4),
('Io sono una super fan di Harry potter!! :)			', 'saramaenza', 34, 5),
('					Adoro questa serie!', 'luciabianchi88', 29, 6),
('Io invece de \"Il trono di spade\" <3', 'luciabianchi88', 34, 7),
('	Ã¨ il mio cane preferito!	', 'saramaenza', 36, 8),
('				sono troppo simpatici	', 'saramaenza', 37, 9),
('bellissimo!', 'gaiasasso', 35, 10),
('La vista da lassÃ¹ Ã¨ fantastica!!', 'saramaenza', 39, 11),
('Io ne ho due: Un maschio e una femmina! Li adoro troppo!', 'mrossi', 36, 12),
('sono curioso di guardarla			', 'mrossi', 29, 13),
('					Bellissima cittÃ ', 'mrossi', 38, 14),
('					Che buonaaaaaa', 'luciabianchi88', 42, 15),
('					Il mio dolce preferito in assoluto', 'luciabianchi88', 40, 16),
('					ProverÃ² al piÃ¹ presto a cucinarlo', 'saramaenza', 43, 17),
('					Ã¨ proprio verooo', 'saramaenza', 47, 18),
('					che bontÃ ', 'gaiasasso', 41, 19),
('la adoro	', 'gaiasasso', 42, 20),
('					che belli!', 'luca1995', 33, 21),
('		Meravigliosa		', 'luca1995', 28, 22),
('					Vorrei tanto andarci', 'luca1995', 39, 23),
('Hunger Games!!', 'luca1995', 34, 24),
('					Una razza meravigliosa', 'luca1995', 36, 25),
('Sono proprio curioso di assaggiarlo', 'luca1995', 46, 26),
('					Buono buono buono', 'luca1995', 40, 27);

-- --------------------------------------------------------

--
-- Struttura della tabella `post`
--

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `titolo` varchar(20) NOT NULL,
  `testo` varchar(400) NOT NULL,
  `immagine` varchar(40) NOT NULL,
  `ora_data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_blog` int(11) NOT NULL,
  `nome_utente` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `post`
--

INSERT INTO `post` (`id_post`, `titolo`, `testo`, `immagine`, `ora_data`, `id_blog`, `nome_utente`) VALUES
(28, 'Gossip Girl', 'Questa bellissima serie sbarca in USA nel 2007 ed ha subito un successo planetario.\r\nComposta da 6 stagioni tratta la vita privata di un gruppo di adolescenti di Manhattan.\r\nVoto: 100 / 100', 'maxresdefault.jpg', '2020-01-23 19:04:45', 16, 'saramaenza'),
(29, 'The witcher', 'Questa serie tv tratta le vicende del giovane stregone Geralt di Rivia tra amore, magia e passione.\r\nLa serie Ã¨ composta al momento di una unica stagione ma Ã¨ confermato il rinnovo da parte di Netflix.\r\nVoto: 85 / 100', 'Z3NkfR4ffrtfMiJ64786xQ-1200-80.jpg', '2020-01-23 19:02:56', 16, 'saramaenza'),
(30, 'Migliore mangime ', 'Il migliore mangime per i gatti domestici Ã¨ senza dubbio il Kitekat.\r\nFantastico per rendere il pelo dei nostri amici splendente e morbidissimo!', 'kit-kat-multipak-pescatore.jpg', '2020-01-23 19:08:40', 15, 'saramaenza'),
(31, 'Topini che passione', 'Gli intramontabili topi giocattolo sono il miglior regalo per i nostri pelosetti!', 'YL-S-0141-03.jpg', '2020-01-23 19:11:15', 15, 'saramaenza'),
(32, 'Adottami', 'Non comprare un gatto di razza, fai una scelta con il cuore e scegli un pelosetto da adottare dei tanti abbandonati.', 'randagio.jpg', '2020-01-23 19:17:21', 15, 'saramaenza'),
(33, 'Brr che freddo', 'Cappottini elegantissimi per i nostri amici a quattro zampe, ottimi per proteggerli dal freddo', 'cappotto.jpg', '2020-01-23 19:15:59', 15, 'saramaenza'),
(34, 'Vita da fan', 'La vita di un fan non Ã¨ per niente facile!\r\nBisogna sempre essere aggiornati sulle novitÃ  in uscita, evitare gli spoiler e trovare tutti i gossip piÃ¹ succulenti!\r\nE tu di cosa ti ritieni un vero fan?', 'fandoms.jpg', '2020-01-23 19:24:23', 17, 'gaiasasso'),
(35, 'San Bernardo ', 'Noto per il suo amore, la sua gentilezza e la sua tolleranza nonostante la mole, il cane di San Bernardo Ã¨ buono con le famiglie con bambini ben educati. Inoltre, ambisce ad avere lâ€™approvazione del suo proprietario, facilitando cosÃ¬ lâ€™addestramento.', 'sanbernando.jpg', '2020-01-24 23:20:38', 18, 'luciabianchi88'),
(36, 'Bovaro del Bernese', ' Di temperamento buono e vigile, il Bovaro del Bernese ambisce a ottenere lâ€™approvazione del suo proprietario e gioisce quando gli vengono assegnati lavori come cane da compagnia.', 'bovaro.jpg', '2020-01-24 23:24:53', 18, 'luciabianchi88'),
(37, 'Golden Retriever', 'PoichÃ© il Golden Retriever ama compiacere, risponde positivamente allâ€™addestramento allâ€™obbedienza. Questo tratto Ã¨ completato dal temperamento giocoso, affettuoso ed equilibrato.', 'golden.jpg', '2020-01-24 23:26:19', 18, 'luciabianchi88'),
(38, 'Big Ben', 'La grande campana dell Elizabeth Tower, comunemente chiamata Big Ben, Ã¨ una delle icone londinesi e la troviamo nel quartiere di Westminster. ', 'londra.jpg', '2020-01-24 23:34:53', 19, 'gaiasasso'),
(39, 'London Eye', 'Il London Eye si trova sulla sponda sud del Tamigi, vicino a Westminster, ed Ã¨ uno dei simboli piÃ¹ amati di Londra. Regala panorami della cittÃ  che lasciano a bocca aperta, se hai tempo di regalarti una pausa dalla frenesia della cittÃ  sottostante; da lassÃ¹ scattare belle foto Ã¨ quasi un gioco da ragazzi.', 'eye.jpg', '2020-01-24 23:36:45', 19, 'gaiasasso'),
(40, 'Torta Sacher', 'La torta Sacher (ted. Sachertorte) Ã¨ una torta al cioccolato inventata dal pasticciere, allora sedicenne, Franz Sacher per il principe Klemens von Metternich il 9 luglio 1832 a Vienna, in Austria.', 'sacher.jpg', '2020-01-24 23:47:26', 20, 'mrossi'),
(41, 'Strudel', 'Lo strudel (dal tedesco Strudel, \"vortice\") Ã¨ un dolce a pasta arrotolata o ripiena che puÃ² essere dolce o salata, ma nella sua versione piÃ¹ conosciuta Ã¨ dolce a base di mele, pinoli, uvetta e cannella.', 'hd650x433_wm.jpg', '2020-01-24 23:49:52', 20, 'mrossi'),
(42, 'Carbonara', 'La pasta alla carbonara Ã¨ un piatto caratteristico del Lazio, e piÃ¹ in particolare di Roma preparato con ingredienti popolari e dal gusto intenso.\r\n\r\nI tipi di pasta tradizionalmente piÃ¹ usati sono gli spaghetti o i rigatoni.', 'carbonara.jpg', '2020-01-24 23:52:39', 21, 'mrossi'),
(43, 'Uovo in camicia', 'L uovo in camicia Ã¨ una preparazione culinaria dell uovo consistente nel gettarlo crudo e sgusciato in acqua bollente (acidificata con aceto) e mantenervelo per almeno 3 minuti.', 'SH_uovo_camicia.jpg', '2020-01-24 23:56:21', 22, 'mrossi'),
(44, 'Uova strapazzate', 'Le uova strapazzate sono un piatto molto diffuso a base di uova, tipicamente di gallina. Il piatto consiste nel miscelare tra loro l albume e il tuorlo dell uovo per poi friggerlo in olio caldo rompendo (strapazzare, sbattere) la coagulazione biochimica del preparato.', 'UOVA-STRAPAZZATE.jpg', '2020-01-24 23:59:07', 22, 'mrossi'),
(45, 'Uova al tegamino', 'Con l appellativo uovo all occhio di bue (o con quello di uovo al tegamino viene comunemente chiamato un piatto composto da un uovo preparato mediante frittura; spesso in un piatto se ne consumano 2 o 3 insieme.', 'uova-al-tegamino.jpg', '2020-01-25 00:00:27', 22, 'mrossi'),
(46, 'Uovo alla coque ', 'Un uovo alla coque Ã¨ un uovo cotto in modo tale che l albume solidifica mentre il tuorlo rimane liquido.', 'cucinare-uovo-alla-coque-perfetto.webp', '2020-01-25 00:02:28', 22, 'mrossi'),
(47, 'Ci vuole ordine', 'Una delle regole fondamentali per essere un buon cuoco Ã¨ quello di mantenere sempre in ordine e pulita la vostra cucina!', 'Pulizia-cucine.png', '2020-01-25 00:10:01', 23, 'mrossi'),
(48, 'Ferrari Portofino', 'La Ferrari Portofino Ã¨ un autovettura sportiva di tipo gran turismo ad alte prestazioni con carrozzeria coupÃ©-cabriolet prodotta dalla casa automobilistica italiana Ferrari a partire dal 2018.', '390px-Ferrari_Portofino_IMG_0532.jpg', '2020-01-25 00:20:37', 24, 'luca1995'),
(49, 'Fix You', 'Fix You Ã¨ un singolo del gruppo musicale britannico Coldplay, pubblicato il 5 settembre 2005 come secondo estratto dal terzo album in studio X&Y.\r\nIl brano, scritto dal frontman del gruppo, Chris Martin, non Ã¨ dedicato a una persona in particolare, ma potrebbe essere indirizzato alla ex moglie Gwyneth Paltrow dopo la scomparsa del padre di lei: Â«fix youÂ» significa infatti Â«consolartiÂ».', '', '2020-01-25 00:27:03', 25, 'luciabianchi88'),
(50, 'Yellow', 'Yellow Ã¨ un singolo del gruppo musicale britannico Coldplay, il secondo estratto dal primo album in studio Parachutes e pubblicato il 26 giugno 2000.\r\nNel 2001 il brano ha vinto un NME Awards come miglior singolo dell anno', '', '2020-01-25 00:27:59', 25, 'luciabianchi88'),
(51, 'Biografia', 'Adele Laurie Blue Adkins Ã¨ nata il 5 maggio 1988 nel quartiere di Tottenham, da Penny Adkins e Mark Evans. La madre si separÃ² dal compagno due anni piÃ¹ tardi, e da quel momento si occupÃ² da sola della figlia. I rapporti tra Adele ed Evans, poco frequenti sin dalla separazione dei genitori, si incrinarono ulteriormente quando, nel 1999, l uomo divenne dipendente dall alcol; ', 'adele-25-922x550.jpg', '2020-01-25 00:33:57', 26, 'gaiasasso');

-- --------------------------------------------------------

--
-- Struttura della tabella `tema`
--

CREATE TABLE `tema` (
  `nome_tema` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `tema`
--

INSERT INTO `tema` (`nome_tema`) VALUES
('Cani'),
('cibo'),
('gatti'),
('macchine'),
('musica'),
('serie tv'),
('viaggi');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `nome_utente` varchar(20) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `indirizzo` varchar(30) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `num_doc` varchar(20) NOT NULL,
  `data_doc` varchar(10) NOT NULL,
  `luogo_doc` varchar(20) NOT NULL,
  `ente_doc` varchar(20) NOT NULL,
  `premium` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`nome_utente`, `nome`, `cognome`, `password`, `email`, `indirizzo`, `tel`, `num_doc`, `data_doc`, `luogo_doc`, `ente_doc`, `premium`) VALUES
('gaiasasso', 'Gaia', 'Sasso', '12345678', 'gaia.sasso@gmail.com', 'via 2 Giugno 13', '3493393910', 'A28372', '13/09/2018', 'Pisa', 'Comune', 0),
('luca1995', 'Luca', 'Cecchi', 'sdcuunjkan', 'lucacecc@gmail.com', 'Via Bianchi 34', '3427854637', 'AW44445', '18/08/2017', 'Napoli', 'Comune', 0),
('luciabianchi88', 'Lucia', 'Bianchi', 'jowudnakaue', 'luciabianchi@gmail.com', 'via Cattaneo 10', '3478976543', 'AY83d7', '06/08/2011', 'Livorno', 'Comune', 0),
('mrossi', 'Marco', 'Rossi', 'ursfjwicbu8s', 'marcorossi@gmail.com', 'Via Garibaldi 34', '3467842345', 'AX749290', '04/01/2013', 'Pontedera', 'Comune', 1),
('saramaenza', 'Sara', 'Maenza', '12345678', 'sara.maenza98@gmail.com', 'via profeti 141', '340221148', 'A47hd8', '2/07/2016', 'Cascina', 'Comune', 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id_blog`),
  ADD KEY `nome_utente` (`nome_utente`),
  ADD KEY `blog_ibfk_3` (`tema`);

--
-- Indici per le tabelle `commenti`
--
ALTER TABLE `commenti`
  ADD PRIMARY KEY (`id_commento`),
  ADD KEY `id_post` (`id_post`),
  ADD KEY `nome_utente` (`nome_utente`);

--
-- Indici per le tabelle `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `nome_utente` (`nome_utente`),
  ADD KEY `id_blog` (`id_blog`);

--
-- Indici per le tabelle `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`nome_tema`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`nome_utente`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `blog`
--
ALTER TABLE `blog`
  MODIFY `id_blog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT per la tabella `commenti`
--
ALTER TABLE `commenti`
  MODIFY `id_commento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT per la tabella `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_2` FOREIGN KEY (`nome_utente`) REFERENCES `utente` (`nome_utente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blog_ibfk_3` FOREIGN KEY (`tema`) REFERENCES `tema` (`nome_tema`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `commenti`
--
ALTER TABLE `commenti`
  ADD CONSTRAINT `commenti_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commenti_ibfk_2` FOREIGN KEY (`nome_utente`) REFERENCES `utente` (`nome_utente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`nome_utente`) REFERENCES `utente` (`nome_utente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_ibfk_3` FOREIGN KEY (`id_blog`) REFERENCES `blog` (`id_blog`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
