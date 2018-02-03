/* Database creation */

CREATE DATABASE /*!32312 IF NOT EXISTS*/`filmski_arhiv_iteh` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `filmski_arhiv_iteh`;

/* Table structure for table `administrator` */

DROP TABLE IF EXISTS `administrator`;

CREATE TABLE `administrator` (
  `AdministratorID` int(11) NOT NULL AUTO_INCREMENT,
  `Ime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Prezime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `KorisnickoIme` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `KorisnickaSifra` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`AdministratorID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/* Data for the table `administrator` */

INSERT INTO `administrator`(`AdministratorID`,`Ime`,`Prezime`,`KorisnickoIme`,`KorisnickaSifra`) VALUES 
(1,'Vidan','Dulanović','vidan','vidan'),
(2,'Admin','Admin','admin','admin'),
(3,'Ljubiša','Dulanović','ljubo','ljubo');

/* Table structure for table `film` */

DROP TABLE IF EXISTS `film`;

CREATE TABLE `film` (
  `FilmID` int(11) NOT NULL AUTO_INCREMENT,
  `Naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Godina` int(11) NOT NULL,
  `ZanrID` int(11) NOT NULL,
  `Poster` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Opis` varchar(350) COLLATE utf8_unicode_ci NOT NULL,
  `ReziserID` int(11) NOT NULL,
  `Uloge` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `Trajanje` int(11) NOT NULL,
  `Trejler` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `IMDbLink` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`FilmID`),
  KEY `ReziserID` (`ReziserID`),
  KEY `ZanrID` (`ZanrID`),
  CONSTRAINT `film_ibfk_1` FOREIGN KEY (`ReziserID`) REFERENCES `reziser` (`ReziserID`) ON UPDATE CASCADE,
  CONSTRAINT `film_ibfk_2` FOREIGN KEY (`ZanrID`) REFERENCES `zanr` (`ZanrID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/* Data for the table `film` */

INSERT INTO `film`(`FilmID`,`Naziv`,`Godina`,`ZanrID`,`Poster`,`Opis`,`ReziserID`,`Uloge`,`Trajanje`,`Trejler`,`IMDbLink`) VALUES 
(1,'Apokalipsa danas\r\n',1979,1,'https://images-na.ssl-images-amazon.com/images/M/MV5BYWNjNjZjYmMtOTRjOC00ZGIwLWI2YzEtMjkxNTAzODkzZDRlXkEyXkFqcGdeQXVyNjUwNzk3NDc@._V1_.jpg','During the Vietnam War, Captain Willard is sent on a dangerous mission into Cambodia to assassinate a renegade colonel who has set himself up as a god among a local tribe.',3,'Martin Sheen, Marlon Brando, Robert Duvall',202,'snDR7XsSkB4','tt0078788'),
(2,'Staze slave\r\n',1957,1,'https://images-na.ssl-images-amazon.com/images/M/MV5BOTI5Nzc0OTMtYzBkMS00NjkxLThmM2UtNjM2ODgxN2M5NjNkXkEyXkFqcGdeQXVyNjQ2MjQ5NzM@._V1_SY1000_CR0,0,653,1000_AL_.jpg','After refusing to attack an enemy position, a general accuses the soldiers of cowardice and their commanding officer must defend them.',2,'Kirk Douglas, Ralph Meeker, Adolphe Menjou',88,'nmDA60X-f_A','tt0050825'),
(3,'Lorens od Arabije\r\n',1962,1,'https://images-na.ssl-images-amazon.com/images/M/MV5BYWY5ZjhjNGYtZmI2Ny00ODM0LWFkNzgtZmI1YzA2N2MxMzA0XkEyXkFqcGdeQXVyNjUwNzk3NDc@._V1_SY1000_CR0,0,693,1000_AL_.jpg','The story of T.E. Lawrence, the English officer who successfully united and lead the diverse, often warring, Arab tribes during World War I in order to fight the Turks.',1,'Peter O-Toole, Alec Guinness, Anthony Quinn',228,'zmr1iSG3RTA','tt0056172'),
(4,'Bojevi metak\r\n',1987,1,'https://images-na.ssl-images-amazon.com/images/M/MV5BMjA4NzY4ODk4Nl5BMl5BanBnXkFtZTgwOTcxNTYxMTE@._V1_.jpg','A pragmatic U.S. Marine observes the dehumanizing effects the Vietnam War has on his fellow recruits from their brutal boot camp training to the bloody street fighting in Hue.',2,'Matthew Modine, R. Lee Ermey, Vincent D-Onofrio',116,'x9f6JaaX7Wg','tt0093058'),
(5,'Andrej Rubljov\r\n',1966,2,'https://images-na.ssl-images-amazon.com/images/M/MV5BODQyMDAzMTQ3OV5BMl5BanBnXkFtZTgwNjUyMTM2MTE@._V1_.jpg','The life, times and afflictions of the fifteenth-century Russian iconographer.',6,'Anatoliy Solonitsyn, Ivan Lapikov, Nikolay Grinko',205,'CbguowlkZ4g','tt0060107'),
(6,'Stradanje Jovanke Orleanke\r\n',1928,2,'https://images-na.ssl-images-amazon.com/images/M/MV5BMjQxMjk5ODUxMl5BMl5BanBnXkFtZTgwNDI2MjUwMzE@._V1_SY1000_CR0,0,692,1000_AL_.jpg','A chronicle of the trial of Jeanne d-Arc on charges of heresy, and the efforts of her ecclesiastical jurists to force Jeanne to recant her claims of holy visions.',8,'Maria Falconetti, Eugene Silvain, André Berley',110,'IQAchMdy__8','tt0019254'),
(7,'Ivan Grozni\r\n',1945,2,'https://images-na.ssl-images-amazon.com/images/M/MV5BMjAxMDU2ODMxNF5BMl5BanBnXkFtZTgwNjk4OTQwMjE@._V1_.jpg','During the early part of his reign, Ivan the Terrible faces betrayal from the aristocracy and even his closest friends as he seeks to unite the Russian people.',7,'Nikolay Cherkasov, Lyudmila Tselikovskaya, Serafima Birman',191,'JcJkHCihTmE','tt0037824'),
(8,'Oklopnjača Potemkin\r\n',1925,2,'https://images-na.ssl-images-amazon.com/images/M/MV5BMTEyMTQzMjQ0MTJeQTJeQWpwZ15BbWU4MDcyMjg4OTEx._V1_SY1000_CR0,0,708,1000_AL_.jpg','A dramatized account of a great Russian naval mutiny and a resulting street demonstration which brought on a police massacre.',7,'Aleksandr Antonov, Vladimir Barsky, Grigori Aleksandrov',75,'kS5kzTbNKjs','tt0015648'),
(9,'Stalker\r\n',1979,3,'https://images-na.ssl-images-amazon.com/images/M/MV5BNDY2NjU0NDAxOF5BMl5BanBnXkFtZTgwNjQ4MTI2MTE@._V1_.jpg','A guide leads two men through an area known as the Zone to find a room that grants wishes.',6,'Alisa Freyndlikh, Aleksandr Kaydanovskiy, Anatoliy Solonitsyn',163,'GM_GOpfEQUw','tt0079944'),
(10,'Istrebljivač\r\n',1982,3,'https://images-na.ssl-images-amazon.com/images/M/MV5BZWZlYmEyYTItNGRjYy00ZmMxLWEzMWItM2Q2NjZlNTMwMjQ3XkEyXkFqcGdeQXVyNDYyMDk5MTU@._V1_SY1000_CR0,0,665,1000_AL_.jpg','A blade runner must pursue and try to terminate four replicants who stole a ship in space and have returned to Earth to find their creator.',10,'Harrison Ford, Rutger Hauer, Sean Young',117,'eogpIG53Cis','tt0083658'),
(11,'Metropolis\r\n',1927,3,'https://images-na.ssl-images-amazon.com/images/M/MV5BNDAzNTkyODg1MF5BMl5BanBnXkFtZTgwMDA3NDkwMDE@._V1_.jpg','In a futuristic city sharply divided between the working class and the citys planners, the son of the city mastermind falls in love with a working class prophet who predicts the coming of a savior to mediate their differences.',11,'Brigitte Helm, Alfred Abel, Gustav Fröhlich',145,'ZSExdX0tds4','tt0017136'),
(12,'2001: Odiseja u svemiru\r\n',1968,3,'https://images-na.ssl-images-amazon.com/images/M/MV5BMTZkZTBhYmUtMTIzNy00YTViLTg1OWItNGUwMmVlN2FjZTVkXkEyXkFqcGdeQXVyNDYyMDk5MTU@._V1_SY1000_SX675_AL_.jpg','Humanity finds a mysterious, obviously artificial object buried beneath the Lunar surface and, with the intelligent computer H.A.L. 9000, sets off on a quest.',2,'Keir Dullea, Gary Lockwood, William Sylvester',161,'Z2UWOeBcsJI','tt0062622'),
(14,'Paklena pomorandža\r\n',1971,3,'https://images-na.ssl-images-amazon.com/images/M/MV5BMTY3MjM1Mzc4N15BMl5BanBnXkFtZTgwODM0NzAxMDE@._V1_SY1000_CR0,0,675,1000_AL_.jpg','In future Britain, Alex DeLarge, a charismatic and psycopath delinquent, who likes to practice crimes and ultra-violence with his gang, is jailed and volunteers for an experimental aversion therapy developed by the government in an effort to solve society-s crime problem - but not all goes according to plan.',2,'Malcolm McDowell, Patrick Magee, Michael Bates',136,'SPRzm8ibDQ8','tt0066921'),
(15,'Solaris\r\n',1972,3,'https://images-na.ssl-images-amazon.com/images/M/MV5BMjAyNjQwMjc5Nl5BMl5BanBnXkFtZTgwOTk4MjI2MTE@._V1_.jpg','A psychologist is sent to a station orbiting a distant planet in order to discover what has caused the crew to go insane.',6,'Natalya Bondarchuk, Donatas Banionis, Jüri Järvet',167,'R4vSPEDxGic','tt0069293'),
(16,'Tuđin\r\n',1979,3,'https://images-na.ssl-images-amazon.com/images/M/MV5BNDNhN2IxZWItNGEwYS00ZDNhLThiM2UtODU3NWJlZjBkYjQxXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SY1000_CR0,0,681,1000_AL_.jpg','After a space merchant vessel perceives an unknown transmission as distress call, their landing on the source moon finds one of the crew attacked by a mysterious lifeform. Continuing their journey back to Earth with the attacked crew having recovered and the critter deceased, they soon realize that its life cycle has merely begun.',10,'Sigourney Weaver, Tom Skerritt, John Hurt',117,'LjLamj-b0I8','tt0078748'),
(17,'Sever-severozapad',1959,4,'https://images-na.ssl-images-amazon.com/images/M/MV5BMjQwMTQ0MzgwNl5BMl5BanBnXkFtZTgwNjc4ODE4MzE@._V1_SY1000_CR0,0,639,1000_AL_.jpg','A hapless New York advertising executive is mistaken for a government agent by a group of foreign spies, and is pursued across the country while he looks for a way to survive.',16,'Cary Grant, Eva Marie Saint, James Mason',136,'HRfmTpmIUwo','tt0053125'),
(18,'Kineska četvrt\r\n',1974,4,'https://images-na.ssl-images-amazon.com/images/M/MV5BMTZiZTA5MWItNTgyMy00ZGZkLThjNGQtOWI0MTU5ZDI4NmJmXkEyXkFqcGdeQXVyNjc1NTYyMjg@._V1_SY1000_CR0,0,674,1000_AL_.jpg','A private detective hired to expose an adulterer finds himself caught up in a web of deceit, corruption and murder.',18,'Jack Nicholson, Faye Dunaway, John Huston',130,'T37QkBc4IGY','tt0071315'),
(19,'Vrtoglavica\r\n',1958,4,'https://images-na.ssl-images-amazon.com/images/M/MV5BYTE4ODEwZDUtNDFjOC00NjAxLWEzYTQtYTI1NGVmZmFlNjdiL2ltYWdlL2ltYWdlXkEyXkFqcGdeQXVyNjc1NTYyMjg@._V1_SY1000_CR0,0,645,1000_AL_.jpg','A San Francisco detective suffering from acrophobia investigates the strange activities of an old friends wife, all the while becoming dangerously obsessed with her.',16,'James Stewart, Kim Novak, Barbara Bel Geddes',129,'Z5jvQwwHQNY','tt0052357'),
(20,'M\r\n',1931,4,'https://images-na.ssl-images-amazon.com/images/M/MV5BMTQyNjA5NzU5MV5BMl5BanBnXkFtZTgwMDk1MTA5MTE@._V1_.jpg','When the police in a German city are unable to catch a child-murderer, other criminals join in the manhunt.',11,'Peter Lorre, Ellen Widmann, Inge Landgut',117,'d1344KFFpRo','tt0022100'),
(21,'Građanin Kejn\r\n',1941,4,'https://images-na.ssl-images-amazon.com/images/M/MV5BMTQ2Mjc1MDQwMl5BMl5BanBnXkFtZTcwNzUyOTUyMg@@._V1_.jpg','Following the death of a publishing tycoon, news reporters scramble to discover the meaning of his final utterance.',15,'Orson Welles, Joseph Cotten, Dorothy Comingore',119,'8dxh3lwdOFw','tt0033467'),
(22,'Dobar, loš, zao\r\n',1966,5,'https://images-na.ssl-images-amazon.com/images/M/MV5BOTQ5NDI3MTI4MF5BMl5BanBnXkFtZTgwNDQ4ODE5MDE@._V1_SY1000_CR0,0,656,1000_AL_.jpg','A bounty hunting scam joins two men in an uneasy alliance against a third in a race to find a fortune in gold buried in a remote cemetery.',19,'Clint Eastwood, Eli Wallach, Lee Van Cleef',179,'WCN5JJY_wiA','tt0060196'),
(23,'Za dolar više\r\n',1967,5,'https://images-na.ssl-images-amazon.com/images/M/MV5BMTQzMjIzOTEzMF5BMl5BanBnXkFtZTcwMTUzNTk3NA@@._V1_SY1000_CR0,0,666,1000_AL_.jpg','Two bounty hunters with the same intentions team up to track down a Western outlaw.',19,'Clint Eastwood, Lee Van Cleef, Gian Maria Volontè',132,'DDRNEwFOttw','tt0059578'),
(24,'Bilo jednom na Divljem zapadu\r\n',1968,5,'https://images-na.ssl-images-amazon.com/images/M/MV5BYjFiOTlmMzgtOGZlYi00NjY0LThmMzEtNmQ0OTgxNGViOTZmXkEyXkFqcGdeQXVyNjc1NTYyMjg@._V1_SY1000_CR0,0,658,1000_AL_.jpg','A mysterious stranger with a harmonica joins forces with a notorious desperado to protect a beautiful widow from a ruthless assassin working for the railroad.',19,'Henry Fonda, Charles Bronson, Claudia Cardinale',165,'_kD54-q1uFM','tt0064116'),
(25,'Glava za brisanje',1977,6,'https://images-na.ssl-images-amazon.com/images/M/MV5BMGY0MTA5ZmMtOGQxZC00ZWZjLWJkODQtYzc3YjdiYTVjMjcxXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SY1000_CR0,0,742,1000_AL_.jpg','Henry Spencer tries to survive his industrial environment, his angry girlfriend, and the unbearable screams of his newly born mutant child.',47,'Jack Nance, Charlotte Stewart, Allen Joseph',89,'oK-2_OsBe0s','tt0074486'),
(26,'Isijavanje\r\n',1980,6,'https://images-na.ssl-images-amazon.com/images/M/MV5BYjRlYzU5ZDctYmEwZC00ZjBjLTk1YmYtZjlmMjk5YWRlYTAzL2ltYWdlXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_SY1000_CR0,0,663,1000_AL_.jpg','A family heads to an isolated hotel for the winter where an evil and spiritual presence influences the father into violence, while his psychic son sees horrific forebodings from the past and of the future.',2,'Jack Nicholson, Shelley Duvall, Danny Lloyd',146,'5Cb3ik6zP2I','tt0081505'),
(27,'Psiho\r\n',1960,6,'https://images-na.ssl-images-amazon.com/images/M/MV5BMDI3OWRmOTEtOWJhYi00N2JkLTgwNGItMjdkN2U0NjFiZTYwXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SY1000_CR0,0,663,1000_AL_.jpg','A Phoenix secretary embezzles $40,000 from her employers client, goes on the run, and checks into a remote motel run by a young man under the domination of his mother.',16,'Anthony Perkins, Janet Leigh, Vera Miles',109,'NG3-GlvKPcg','tt0054215'),
(28,'Isterivač đavola\r\n',1973,6,'https://images-na.ssl-images-amazon.com/images/M/MV5BYzczOGRlMzQtNDAzMS00MjdlLTk5Y2QtNTM3MDE3NjRkYzQwXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_.jpg','When a teenage girl is possessed by a mysterious entity, her mother seeks the help of two priests to save her daughter.',26,'Ellen Burstyn, Max von Sydow, Linda Blair',132,'YDGw1MTEe9k','tt0070047'),
(29,'Iz prošlosti\r\n',1947,7,'https://images-na.ssl-images-amazon.com/images/M/MV5BMDE0MjYxYmMtM2VhMC00MjhiLTg5NjItMDkzZGM5MGVlYjMxL2ltYWdlL2ltYWdlXkEyXkFqcGdeQXVyNjc1NTYyMjg@._V1_SY1000_CR0,0,667,1000_AL_.jpg','A private eye escapes his past to run a gas station in a small town, but his past catches up with him. Now he must return to the big city world of danger, corruption, double crosses and duplicitous dames.',30,'Robert Mitchum, Jane Greer, Kirk Douglas',97,'saurMhQHblc','tt0039689'),
(30,'Bulevar sumraka\r\n',1950,7,'https://images-na.ssl-images-amazon.com/images/M/MV5BMTc3NDYzODAwNV5BMl5BanBnXkFtZTgwODg1MTczMTE@._V1_.jpg','A hack screenwriter writes a screenplay for a former silent-film star who has faded into Hollywood obscurity.',13,'William Holden, Gloria Swanson, Erich von Stroheim',110,'Y3P0Zpe-2og','tt0043014'),
(31,'Lora\r\n',1944,7,'https://images-na.ssl-images-amazon.com/images/M/MV5BMTU5MjQwMzk1NF5BMl5BanBnXkFtZTcwOTA5NDgyMw@@._V1_SY1000_CR0,0,629,1000_AL_.jpg','A police detective falls in love with the woman whose murder he is investigating.',29,'Gene Tierney, Dana Andrews, Clifton Webb',88,'QJRp5C15PgE','tt0037008'),
(32,'Malteški soko\r\n',1941,7,'https://images-na.ssl-images-amazon.com/images/M/MV5BMTc4MDEzOTMwMl5BMl5BanBnXkFtZTgwMTc2NjgyMjE@._V1_.jpg','A private detective takes on a case that involves him with three eccentric criminals, a gorgeous liar, and their quest for a priceless statuette.',28,'Humphrey Bogart, Mary Astor, Gladys George',100,'3a9YU1SVbSE','tt0033870'),
(33,'Kec u rukavu\r\n',1951,7,'https://images-na.ssl-images-amazon.com/images/M/MV5BNDUzZjlhZTYtN2E5MS00ODQ3LWI1ZjgtNzdiZmI0NTZiZTljXkEyXkFqcGdeQXVyMjI4MjA5MzA@._V1_SY1000_CR0,0,657,1000_AL_.jpg','A frustrated former big-city journalist now stuck working for an Albuquerque newspaper exploits a story about a man trapped in a cave to re-jump start his career, but the situation quickly escalates into an out-of-control circus.',13,'Kirk Douglas, Jan Sterling, Robert Arthur',111,'x0Gsv5p5GdY','tt0043338'),
(34,'Kum\r\n',1972,8,'https://images-na.ssl-images-amazon.com/images/M/MV5BNTc0ZDk1YWItZDZiNi00NTdmLWE0MDctNTVhYTRhMDBmZjNjXkEyXkFqcGdeQXVyMjUzOTY1NTc@._V1_.jpg','The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.',3,'Marlon Brando, Al Pacino, James Caan',175,'sY1S34973zA','tt0068646'),
(35,'Rašomon\r\n',1950,8,'https://images-na.ssl-images-amazon.com/images/M/MV5BMjEzMzA4NDE2OF5BMl5BanBnXkFtZTcwNTc5MDI2NQ@@._V1._CR0,0,503,683_.jpg','A heinous crime and its aftermath are recalled from differing points of view.',14,'Toshirô Mifune, Machiko Kyô, Masayuki Mori',88,'xCZ9TguVOIA','tt0042876'),
(36,'Žaoka\r\n',1973,8,'https://images-na.ssl-images-amazon.com/images/M/MV5BMTY5MjM1OTAyOV5BMl5BanBnXkFtZTgwMDkwODg4MDE@._V1._CR52,57,915,1388_SY1000_CR0,0,659,1000_AL_.jpg','In Chicago in September 1936, a young con man seeking revenge for his murdered partner teams up with a master of the big con to win a fortune from a criminal banker.',32,'Paul Newman, Robert Redford, Robert Shaw',129,'LN2hBOIXhBs','tt0070735'),
(37,'Taksista\r\n',1976,8,'https://images-na.ssl-images-amazon.com/images/M/MV5BNGQxNDgzZWQtZTNjNi00M2RkLWExZmEtNmE1NjEyZDEwMzA5XkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SY1000_CR0,0,654,1000_AL_.jpg','A mentally unstable Vietnam War veteran works as a night-time taxi driver in New York City where the perceived decadence and sleaze feeds his urge for violent action, attempting to save a preadolescent prostitute in the process.',31,'Robert De Niro, Jodie Foster, Cybill Shepherd',113,'sLpMx8_TYOo','tt0075314'),
(38,'Kum 2\r\n',1974,8,'https://images-na.ssl-images-amazon.com/images/M/MV5BOTE1MTBiYzYtMDI1OC00ZTUxLTg0ZWQtZjdjMzA0OTM1NGMwXkEyXkFqcGdeQXVyMjUzOTY1NTc@._V1_.jpg','The early life and career of Vito Corleone in 1920s New York is portrayed while his son, Michael, expands and tightens his grip on the family crime syndicate.',3,'Al Pacino, Robert De Niro, Robert Duvall',202,'qJr92K_hKl0','tt0071562'),
(39,'Fani i Aleksandar\r\n',1982,9,'https://images-na.ssl-images-amazon.com/images/M/MV5BOTUyODUwNjc0NV5BMl5BanBnXkFtZTcwMTk0MTcyMQ@@._V1_SY1000_CR0,0,714,1000_AL_.jpg','Two young Swedish children experience the many comedies and tragedies of their family, the Ekdahls.',38,'Bertil Guve, Pernilla Allwin, Kristina Adolphson',188,'IkszXVEUHco','tt0083922'),
(40,'Tokijska priča\r\n',1950,9,'https://images-na.ssl-images-amazon.com/images/M/MV5BMmIxZGIzZmMtMGU3Ny00OWU2LWI2NjMtZmVjN2M0MDYwMmVlXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_.jpg','An old couple visit their children and grandchildren in the city; but the children have little time for them.',49,'Chishû Ryû, Chieko Higashiyama, Sô Yamamura',136,'5zEKw4VQIeY','tt0046438'),
(41,'Let iznad kukavičjeg gnezda\r\n',1975,9,'https://images-na.ssl-images-amazon.com/images/M/MV5BZjA0OWVhOTAtYWQxNi00YzNhLWI4ZjYtNjFjZTEyYjJlNDVlL2ltYWdlL2ltYWdlXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SY1000_CR0,0,672,1000_AL_.jpg','A criminal pleads insanity after getting into trouble again and once in the mental institution rebels against the oppressive nurse and rallies up the scared patients.',37,'Jack Nicholson, Louise Fletcher, Michael Berryman',133,'2WSyJgydTsA','tt0073486'),
(42,'Prezir\r\n',1963,9,'https://images-na.ssl-images-amazon.com/images/M/MV5BMTA3MjY5MjQ5ODleQTJeQWpwZ15BbWU4MDU4NjQ5NDIx._V1_.jpg','Screenwriter Paul Javals marriage to his wife Camille disintegrates during movie production as she spends time with the producer. Layered conflicts between art and business ensue.',48,'Brigitte Bardot, Jack Palance, Michel Piccoli',103,'2wjDWnKTROI','tt0057345'),
(43,'Sanšo sudski izvršitelj\r\n',1952,9,'https://images-na.ssl-images-amazon.com/images/M/MV5BMTgyNTcwNjEzNF5BMl5BanBnXkFtZTcwODc0OTM0MQ@@._V1._CR56,19,298,474_.jpg','In medieval Japan, a compassionate governor is sent into exile. His wife and children try to join him, but are separated, and the children grow up amid suffering and oppression.',46,'Kinuyo Tanaka, Yoshiaki Hanayagi, Kyôko Kagawa',124,'1TSo4GBi1xI','tt0047445'),
(44,'Konformista\r\n',1970,9,'https://images-na.ssl-images-amazon.com/images/M/MV5BODFlYzU4YTItN2EwYi00ODI3LTkwNTQtMDdkNjM3YjMyMTgyXkEyXkFqcGdeQXVyNjc1NTYyMjg@._V1_.jpg','A weak-willed Italian man becomes a fascist flunky who goes abroad to arrange the assassination of his old teacher, now a political dissident.',45,'Jean-Louis Trintignant, Stefania Sandrelli, Gastone Moschin',111,'QWZO1GLMD2Y','tt0065571'),
(45,'Kradljivci bicikala',1948,9,'https://images-na.ssl-images-amazon.com/images/M/MV5BOTI3NTcwNzEtNDA1MS00ZjE0LThkNDEtMmU4MjVmNTQ1ZDBmXkEyXkFqcGdeQXVyNjc1NTYyMjg@._V1_.jpg','In post-war Italy, a working-class mans bicycle is stolen. He and his son set out to find it.',44,'Lamberto Maggiorani, Enzo Staiola, Lianella Carell',89,'H3jnzXX9mXs','tt0040522'),
(46,'Dobri momci\r\n',1990,9,'https://images-na.ssl-images-amazon.com/images/M/MV5BNThjMzczMjctZmIwOC00NTQ4LWJhZWItZDdhNTk5ZTdiMWFlXkEyXkFqcGdeQXVyNDYyMDk5MTU@._V1_SY1000_CR0,0,669,1000_AL_.jpg','Henry Hill and his friends work their way up through the mob hierarchy.',31,'Robert De Niro, Ray Liotta, Joe Pesci',146,'qo5jJpHtI1Y','tt0099685'),
(47,'Noć lovca\r\n',1955,10,'https://images-na.ssl-images-amazon.com/images/M/MV5BMDY2OTM4NjItNmUzNC00NmNkLWI0ZGEtMzY5NTEwZDQzYzIyXkEyXkFqcGdeQXVyNjc1NTYyMjg@._V1_SY1000_CR0,0,667,1000_AL_.jpg','A religious fanatic marries a gullible widow whose young children are reluctant to tell him where their real daddy hid $10,000 hed stolen in a robbery.',39,'Robert Mitchum, Shelley Winters, Lillian Gish',92,'Y8dX6ZKJe2o','tt0048424'),
(48,'Persona\r\n',1966,10,'https://images-na.ssl-images-amazon.com/images/M/MV5BMTc1OTgxNjYyNF5BMl5BanBnXkFtZTcwNjM2MjM2NQ@@._V1_SY1000_CR0,0,634,1000_AL_.jpg','A nurse is put in charge of a mute actress and finds that their personas are melding together.',38,'Bibi Andersson, Liv Ullmann, Margaretha Krook',85,'amxvetvKfho','tt0060827'),
(49,'Konopac\r\n',1948,10,'https://images-na.ssl-images-amazon.com/images/M/MV5BYWFjMDNlYzItY2VlMS00ZTRkLWJjYTEtYjI5NmFlMGE3MzQ2XkEyXkFqcGdeQXVyNjc1NTYyMjg@._V1_SY1000_CR0,0,645,1000_AL_.jpg','Two young men strangle their \"inferior\" classmate, hide his body in their apartment, and invite his friends and family to a dinner party as a means to challenge the \"perfection\" of their crime.',16,'James Stewart, John Dall, Farley Granger',80,'8xkQoH8QbVs','tt0040746'),
(50,'Na usamljenom mestu\r\n',1950,10,'https://images-na.ssl-images-amazon.com/images/M/MV5BNjRmZjcwZTQtYWY0ZS00ODAwLTg4YTktZDhlZDMwMTM1MGFkXkEyXkFqcGdeQXVyNjc1NTYyMjg@._V1_SY1000_SX672_AL_.jpg','A potentially violent screenwriter is a murder suspect until his lovely neighbor clears him. But she begins to have doubts...',40,'Humphrey Bogart, Gloria Grahame, Frank Lovejoy',94,'Cq9VYIrFy3M','tt0042593'),
(51,'Prozor u dvorište\r\n',1954,10,'https://images-na.ssl-images-amazon.com/images/M/MV5BNGUxYWM3M2MtMGM3Mi00ZmRiLWE0NGQtZjE5ODI2OTJhNTU0XkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SY1000_CR0,0,683,1000_AL_.jpg','A wheelchair-bound photographer spies on his neighbours from his apartment window and becomes convinced one of them has committed murder.',16,'James Stewart, Grace Kelly, Wendell Corey',112,'6kCcZCMYw38','tt0047396'),
(52,'Sedam samuraja\r\n',1954,11,'https://images-na.ssl-images-amazon.com/images/M/MV5BMTc5MDY1MjU5MF5BMl5BanBnXkFtZTgwNDM2OTE4MzE@._V1_SY1000_CR0,0,712,1000_AL_.jpg','A poor village under attack by bandits recruits seven unemployed samurai to help them defend themselves.',14,'Toshirô Mifune, Takashi Shimura, Keiko Tsushima',207,'7mw6LyyoeGE','tt0047478'),
(53,'Ben-Hur\r\n',1959,11,'https://images-na.ssl-images-amazon.com/images/M/MV5BNjgxY2JiZDYtZmMwOC00ZmJjLWJmODUtMTNmNWNmYWI5ODkwL2ltYWdlL2ltYWdlXkEyXkFqcGdeQXVyNjc1NTYyMjg@._V1_SY1000_SX659_AL_.jpg','When a Jewish prince is betrayed and sent into slavery by a Roman friend, he regains his freedom and comes back for revenge.',41,'Charlton Heston, Jack Hawkins, Stephen Boyd',212,'NR1ZHKw09n8','tt0052618'),
(54,'Dersu Uzala\r\n',1975,11,'https://images-na.ssl-images-amazon.com/images/M/MV5BYWY0OWJlZTgtMWUzNy00MGJhLTk5YzQtNmY5MDEwOTIxNjMyXkEyXkFqcGdeQXVyNjc1NTYyMjg@._V1_SY1000_CR0,0,666,1000_AL_.jpg','The Russian army sends an explorer on an expedition to the snowy Siberian wilderness where he makes friends with a seasoned local hunter.',14,'Maksim Munzuk, Yuriy Solomin, Mikhail Bychkov',144,'ct_7VNF0_jQ','tt0071411'),
(55,'Blago Sijera Madre\r\n',1948,11,'https://images-na.ssl-images-amazon.com/images/M/MV5BMTQ4MzUzOTYwOV5BMl5BanBnXkFtZTgwNDA4MzgyMjE@._V1_.jpg','Fred Dobbs and Bob Curtin, two Americans searching for work in Mexico, convince an old prospector to help them mine for gold in the Sierra Madre Mountains.',28,'Humphrey Bogart, Walter Huston, Tim Holt',126,'vGpvO8JabEc','tt0040897'),
(56,'Andaluzijski pas\r\n',1929,12,'https://images-na.ssl-images-amazon.com/images/M/MV5BODc0MTEwMzcwNV5BMl5BanBnXkFtZTgwMzQ3ODMwMzE@._V1_SY1000_CR0,0,695,1000_AL_.jpg','Luis Buñuel and Salvador Dalí present seventeen minutes of bizarre, surreal imagery.',42,'Pierre Batcheff, Simone Mareuil, Luis Buñuel',16,'BVbTEVfLksU','tt0020530'),
(57,'Sedmi pečat\r\n',1957,12,'https://images-na.ssl-images-amazon.com/images/M/MV5BNDMxZjI4OGUtMzZhZS00ZTcwLWIyYWUtZTQ0Zjg4ZmIzYTcwXkEyXkFqcGdeQXVyNTI4MjkwNjA@._V1_SY1000_CR0,0,692,1000_AL_.jpg','A man seeks answers about life, death, and the existence of God as he plays chess against the Grim Reaper during the Black Plague.',38,'Max von Sydow, Gunnar Björnstrand, Bengt Ekerot',96,'NtkFei4wRjE','tt0050976'),
(58,'Osam i po',1963,12,'https://images-na.ssl-images-amazon.com/images/M/MV5BMTQ4MTA0NjEzMF5BMl5BanBnXkFtZTgwMDg4NDYxMzE@._V1_SY1000_CR0,0,719,1000_AL_.jpg','A harried movie director retreats into his memories and fantasies.',43,'Marcello Mastroianni, Anouk Aimée, Claudia Cardinale',138,'PTmiA-uNSD8','tt0056801'),
(59,'Ugetsu\r\n',1953,12,'https://images-na.ssl-images-amazon.com/images/M/MV5BMjE4NDE0OTI3NF5BMl5BanBnXkFtZTcwNjEyMTIzMQ@@._V1._CR15,24,325,474_.jpg','A tale of ambition, family, love, and war set in the midst of the Japanese Civil Wars of the sixteenth century.',46,'Masayuki Mori, Machiko Kyô, Kinuyo Tanaka',96,'ecTMsz_KDIE','tt0046478'),
(60,'Anđeo uništenja\r\n',1962,12,'https://images-na.ssl-images-amazon.com/images/M/MV5BN2Y2NzNlN2ItOTQ1YS00M2Y3LTgwMmYtMjgyYjVlN2NiYTE3XkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SY1000_CR0,0,709,1000_AL_.jpg','The guests at an upper-class dinner party find themselves unable to leave.',42,'Silvia Pinal, Jacqueline Andere, Enrique Rambal',95,'ERHL5nzEMmM','tt0056732');

/* Table structure for table `reziser` */

DROP TABLE IF EXISTS `reziser`;

CREATE TABLE `reziser` (
  `ReziserID` int(11) NOT NULL AUTO_INCREMENT,
  `Ime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Prezime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Slika` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `DatumRodjenja` date NOT NULL,
  `MestoRodjenja` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `DatumSmrti` date DEFAULT NULL,
  `MestoSmrti` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Zemlja` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ReziserID`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/* Data for the table `reziser` */

INSERT INTO `reziser`(`ReziserID`,`Ime`,`Prezime`,`Slika`,`DatumRodjenja`,`MestoRodjenja`,`DatumSmrti`,`MestoSmrti`,`Zemlja`) VALUES 
(1,'Dejvid','Lin','https://images-na.ssl-images-amazon.com/images/M/MV5BMjM3NzIzMzg4M15BMl5BanBnXkFtZTcwOTA1Mzg3Mw@@._V1_.jpg','1908-03-25','Krojdon, UK','1991-04-16','London, UK','UK'),
(2,'Stenli','Kubrik','https://images-na.ssl-images-amazon.com/images/M/MV5BMTIwMzAwMzg1MV5BMl5BanBnXkFtZTYwMjc4ODQ2._V1_.jpg','1928-07-26','Njujork, SAD','1999-03-07','Harpenden, UK','SAD'),
(3,'Fransis Ford','Kopola','https://images-na.ssl-images-amazon.com/images/M/MV5BMTM5NDU3OTgyNV5BMl5BanBnXkFtZTcwMzQxODA0NA@@._V1_SY1000_CR0,0,665,1000_AL_.jpg','1939-04-07','Detroit, SAD',NULL,NULL,'SAD'),
(6,'Andrej','Tarkovski','https://images-na.ssl-images-amazon.com/images/M/MV5BMTk3NDU2MjQ4OF5BMl5BanBnXkFtZTgwOTAzMzE5MTE@._V1_.jpg','1932-04-04','Zavražje, SSSR','1986-12-29','Pariz, Francuska','SSSR'),
(7,'Sergej','Ajzenštajn','https://images-na.ssl-images-amazon.com/images/M/MV5BNzgzMDgyNDA3NV5BMl5BanBnXkFtZTgwNjE1OTExMjE@._V1_.jpg','1898-01-22','Riga, Rusko carstvo(sada Letonija)','1948-02-11','Moskva, SSSR','SSSR'),
(8,'Karl Teodor','Drejer','https://images-na.ssl-images-amazon.com/images/M/MV5BMTU4OTQzODE3M15BMl5BanBnXkFtZTgwMTk5OTk1MjE@._V1_SY1000_CR0,0,708,1000_AL_.jpg','1889-02-03','Kopenhagen, Danska','1968-03-20','Kopenhagen, Danska','Danska'),
(10,'Ridli','Skot','https://images-na.ssl-images-amazon.com/images/M/MV5BMjAwMzc0NjY3OF5BMl5BanBnXkFtZTcwNTU0MjQ1Mw@@._V1_.jpg','1937-11-30','Saut Šilds, UK',NULL,NULL,'UK'),
(11,'Fric','Lang','https://images-na.ssl-images-amazon.com/images/M/MV5BNzU2ODY0NzkwNF5BMl5BanBnXkFtZTgwNDI0MTE5MTE@._V1._CR40.883331298828125,1.5333404541015625,355,473_.jpg','1890-12-05','Beč, Austrougarska(sada Austrija)','1976-08-02','Beverli Hils, SAD','Austrija/Nemačka/SAD'),
(12,'Teri','Gilijam','https://images-na.ssl-images-amazon.com/images/M/MV5BODAyMDM0NjEwOF5BMl5BanBnXkFtZTcwMTUyMDY5Mg@@._V1_.jpg','1940-11-22','Mineapolis, SAD',NULL,NULL,'SAD/UK'),
(13,'Bili','Vajlder','https://images-na.ssl-images-amazon.com/images/M/MV5BMTA2MDc2MDIwMzFeQTJeQWpwZ15BbWU2MDA3MTg0Ng@@._V1_.jpg','1906-06-22','Suča, Austrougarska(sada Poljska)','2002-03-27','Zapadni Los Anđeles, SAD','SAD'),
(14,'Akira','Kurosava','https://images-na.ssl-images-amazon.com/images/M/MV5BMjE3ODQwNTY2Nl5BMl5BanBnXkFtZTcwMTI5ODM1Mw@@._V1_.jpg','1910-03-23','Tokio, Japan','1998-09-06','Tokio, Japan','Japan'),
(15,'Orson','Vels','https://images-na.ssl-images-amazon.com/images/M/MV5BOTE1Nzg5NzMwM15BMl5BanBnXkFtZTYwMDQwMTM2._V1_.jpg','1915-05-06','Kenoša, SAD','1985-10-10','Holivud, SAD','SAD'),
(16,'Alfred','Hičkok','https://images-na.ssl-images-amazon.com/images/M/MV5BMTQxOTg3ODc2NV5BMl5BanBnXkFtZTYwNTg0NTU2._V1_.jpg','1899-08-13','London, UK','1980-04-29','Bel Er, SAD','UK/SAD'),
(18,'Roman','Polanski','https://images-na.ssl-images-amazon.com/images/M/MV5BMTAzNzgwMzMyNDNeQTJeQWpwZ15BbWU2MDg0MDkzNA@@._V1_.jpg','1933-08-18','Pariz, Francuska',NULL,NULL,'Poljska/Francuska/SAD'),
(19,'Serđo','Leone','https://images-na.ssl-images-amazon.com/images/M/MV5BMTk4Njk5MzY3MV5BMl5BanBnXkFtZTcwMTEyMzE0NA@@._V1_SY1000_CR0,0,707,1000_AL_.jpg','1929-01-03','Rim, Italija','1989-04-30','Rim, Italija','Italija'),
(26,'Vilijem','Fridkin','https://images-na.ssl-images-amazon.com/images/M/MV5BMTUwNjUzNzA0M15BMl5BanBnXkFtZTcwNzU5MDkwMw@@._V1_SY1000_CR0,0,788,1000_AL_.jpg','1935-08-29','Čikago, SAD',NULL,NULL,'SAD'),
(28,'Džon','Hjuston','https://images-na.ssl-images-amazon.com/images/M/MV5BMjI0OTcyMDcxMF5BMl5BanBnXkFtZTcwNDY0MjE3Mw@@._V1_.jpg','1906-08-05','Nevada, SAD','1987-08-28','Midltaun, SAD','SAD'),
(29,'Oto','Preminger','https://images-na.ssl-images-amazon.com/images/M/MV5BMjE5MzcyODgwNF5BMl5BanBnXkFtZTgwNzUzNDgxMDE@._V1_.jpg','1905-12-05','Vicnic, Austrougarska(sada Vižnjica, Ukrajina)','1986-04-23','Njujork, SAD','SAD'),
(30,'Žak','Turner','https://images-na.ssl-images-amazon.com/images/M/MV5BMTkzN2U0NDctMTFhYS00NGJkLWJiMDAtYTkzYTk5NWQ2MmVhXkEyXkFqcGdeQXVyMjUxODE0MDY@._V1_.jpg','1904-11-12','Pariz, Francuska','1977-12-19','Beržerak, Francuska','SAD'),
(31,'Martin','Skorseze','https://images-na.ssl-images-amazon.com/images/M/MV5BMTcyNDA4Nzk3N15BMl5BanBnXkFtZTcwNDYzMjMxMw@@._V1_.jpg','1942-11-17','Njujork, SAD',NULL,NULL,'SAD'),
(32,'Džordž Roj','Hil','https://images-na.ssl-images-amazon.com/images/M/MV5BMjE1NzM2MTM1OF5BMl5BanBnXkFtZTgwNjA3Nzg4MDE@._V1_.jpg','1921-12-20','Mineapolis, SAD','2002-12-27','Njujork, SAD','SAD'),
(37,'Miloš','Forman','https://images-na.ssl-images-amazon.com/images/M/MV5BNDY5NDAyODM2Nl5BMl5BanBnXkFtZTcwMzgzNzg3OA@@._V1_SY1000_CR0,0,760,1000_AL_.jpg','1932-02-18','Časlav, Čehoslovačka(sada Češka)',NULL,NULL,'Čehoslovačka/SAD'),
(38,'Ingmar','Bergman','https://images-na.ssl-images-amazon.com/images/M/MV5BMTc4MjQwMzY0N15BMl5BanBnXkFtZTcwNTI1NTM1MQ@@._V1_.jpg','1918-07-14','Upsala, Švedska','2007-07-30','Foro, Švedska','Švedska'),
(39,'Čarls','Lafton','https://images-na.ssl-images-amazon.com/images/M/MV5BMTMzOTQ0MTMzNF5BMl5BanBnXkFtZTYwNzkyNjI2._V1_.jpg','1899-07-01','Skarborou, UK','1962-12-15','Holivud, SAD','UK/SAD'),
(40,'Nikolas','Rej','https://images-na.ssl-images-amazon.com/images/M/MV5BZWQ3ZmZlMWUtOTdhZS00Mzk4LTk0YjEtYzM4MWNmNmMyNjY2XkEyXkFqcGdeQXVyMjUxODE0MDY@._V1_SY1000_CR0,0,793,1000_AL_.jpg','1911-08-07','Gejlzvil, SAD','1979-06-16','Njujork, SAD','SAD'),
(41,'Vilijam','Vajler','https://images-na.ssl-images-amazon.com/images/M/MV5BMTk0MjMzMzk5OF5BMl5BanBnXkFtZTcwMTMyMzQ5Mw@@._V1_.jpg','1902-07-01','Milhauzen, Nemačka(sada Miluz, Francuska)','1981-07-27','Los Anđeles, SAD','SAD'),
(42,'Luis','Bunjuel','https://images-na.ssl-images-amazon.com/images/M/MV5BMTAxNDAyNjE4OTBeQTJeQWpwZ15BbWU3MDc2NDM3MTg@._V1_SY1000_CR0,0,929,1000_AL_.jpg','1900-02-22','Kalanda, Španija','1983-07-29','Meksiko Siti, Meksiko','Španija/Francuska'),
(43,'Federiko','Felini','https://images-na.ssl-images-amazon.com/images/M/MV5BMjE0NDI1MDU5Nl5BMl5BanBnXkFtZTgwNjQ2ODMwMzE@._V1_SY1000_CR0,0,729,1000_AL_.jpg','1920-01-20','Rimini, Italija','1993-10-31','Rim, Italija','Italija'),
(44,'Vitorio','De Sika','https://images-na.ssl-images-amazon.com/images/M/MV5BMzcxOTgxMTY3NV5BMl5BanBnXkFtZTgwODE5OTk3MTE@._V1._CR4.1875,158.71306800842285,1512.4545288085938,1886.1817073822021_SY1000_CR0,0,801,1000_AL_.jpg','1901-07-07','Sora, Italija','1974-11-13','Noji-sir-Sen, Francuska','Italija'),
(45,'Bernardo','Bertoluči','https://images-na.ssl-images-amazon.com/images/M/MV5BMTc2OTY0NjAyN15BMl5BanBnXkFtZTgwMjY5MDY2MDE@._V1_SY1000_CR0,0,744,1000_AL_.jpg','1941-03-16','Parma, Italija',NULL,NULL,'Italija/Francuska'),
(46,'Kenđi','Mizoguči','https://images-na.ssl-images-amazon.com/images/M/MV5BMTkyMzYzOTgxN15BMl5BanBnXkFtZTgwNjA0NDE2MjE@._V1_.jpg','1898-05-16','Tokio, Japan','1956-08-24','Kjoto, Japan','Japan'),
(47,'Dejvid','Linč','https://images-na.ssl-images-amazon.com/images/M/MV5BMTQ1MTY2MTY2Nl5BMl5BanBnXkFtZTcwMDg1ODYwNA@@._V1_SY1000_CR0,0,803,1000_AL_.jpg','1946-01-20','Misula, SAD',NULL,NULL,'SAD'),
(48,'Žan-Lik','Godar','https://images-na.ssl-images-amazon.com/images/M/MV5BOTQ5NjYwODg1MF5BMl5BanBnXkFtZTgwMTA2NzI2MDE@._V1_SY1000_CR0,0,1502,1000_AL_.jpg','1930-12-03','Pariz, Francuska',NULL,NULL,'Francuska'),
(49,'Jasuđiro','Ozu','https://images-na.ssl-images-amazon.com/images/M/MV5BMTExMzQyOTA3NDdeQTJeQWpwZ15BbWU4MDA0MjEzMjIx._V1_SY1000_CR0,0,709,1000_AL_.jpg','1903-12-12','Tokio, Japan','1963-12-12','Tokio, Japan','Japan');

/* Table structure for table `zanr` */

DROP TABLE IF EXISTS `zanr`;

CREATE TABLE `zanr` (
  `ZanrID` int(11) NOT NULL AUTO_INCREMENT,
  `NazivZanra` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ZanrID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/* Data for the table `zanr` */

INSERT INTO `zanr`(`ZanrID`,`NazivZanra`) VALUES 
(1,'Ratni'),
(2,'Istorijski'),
(3,'Sci-fi'),
(4,'Misterija'),
(5,'Vestern'),
(6,'Horor'),
(7,'Film-noar'),
(8,'Krimić'),
(9,'Drama'),
(10,'Triler'),
(11,'Avantura'),
(12,'Fantazija');
