
CREATE DATABASE /*!32312 IF NOT EXISTS*/ `tourism_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `tourism_db`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `user_id` int(30) NOT NULL,
  `package_id` int(30) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=pending,1=confirm, 2=cancelled\r\n',
  `schedule` date DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
INSERT INTO `book_list` VALUES (1,1,1,1,'2026-05-27','2026-05-24 22:44:10');
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inquiry` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `subject` varchar(250) NOT NULL,
  `message` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `packages` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `title` text DEFAULT NULL,
  `tour_location` text DEFAULT NULL,
  `cost` double NOT NULL,
  `description` text DEFAULT NULL,
  `upload_path` text DEFAULT NULL,
  `cover_image` text DEFAULT NULL,
  `gallery_images` longtext DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 =active ,2 = Inactive',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
INSERT INTO `packages` VALUES (1,'Taj Mahal Sunrise Escape','Agra, Uttar Pradesh',5999,'<p>Begin your Agra experience with a calm sunrise-focused plan around the Taj Mahal, followed by heritage viewpoints, Mughal architecture, local crafts, and relaxed food stops. This package is designed for travelers who want a smooth, photogenic day without rushing from one place to another.</p><h3>Suggested Itinerary</h3><ul><li><strong>Early morning:</strong> Pickup from hotel/railway station and proceed toward the Taj Mahal sunrise viewing window.</li><li><strong>Morning:</strong> Visit the Taj Mahal area with enough time for photos, gardens, marble details, and riverside views.</li><li><strong>Late morning:</strong> Continue to Agra Fort exterior/optional interior visit depending on ticket preference and available time.</li><li><strong>Afternoon:</strong> Explore marble inlay craft lanes, local sweet shops, and recommended lunch options.</li><li><strong>Evening:</strong> Visit Mehtab Bagh viewpoint for a softer view of the Taj across the Yamuna before drop-off.</li></ul><h3>Package Notes</h3><p>Entry tickets, meals, guide charges, and camera fees can be added separately. The route can be customized for couples, families, or photography-focused travelers.</p>',NULL,'https://commons.wikimedia.org/wiki/Special:FilePath/Taj%20Mahal,%20Agra,%20India%20%2846800656644%29.jpg','[\"https://commons.wikimedia.org/wiki/Special:FilePath/Taj%20Mahal,%20Agra,%20India%20%2846800656644%29.jpg\",\"https://commons.wikimedia.org/wiki/Special:FilePath/Taj%20Mahal,%20Agra,%20India.jpg\",\"https://commons.wikimedia.org/wiki/Special:FilePath/Mehtab%20Bagh%20facing%20Taj%20Mahal.JPG\",\"https://commons.wikimedia.org/wiki/Special:FilePath/Taj%20Fort%201%20%286639570149%29.jpg\"]',1,'2026-05-24 22:30:11'),(2,'Jaipur Heritage Weekend','Jaipur, Rajasthan',7499,'<p>A colorful Jaipur weekend covering royal forts, palace facades, city markets, and sunset-friendly viewpoints. This package gives travelers a balanced route with sightseeing, shopping, food breaks, and enough time to enjoy the character of the Pink City.</p><h3>Suggested Itinerary</h3><ul><li><strong>Day 1:</strong> Arrival in Jaipur, hotel check-in, local market walk around Bapu Bazaar or Johari Bazaar, and optional evening at Patrika Gate.</li><li><strong>Day 2:</strong> Visit Amber Fort, Jal Mahal photo stop, Hawa Mahal facade, City Palace area, and Jantar Mantar surroundings.</li><li><strong>Day 3:</strong> Slow breakfast, optional Nahargarh/Jaigarh viewpoint, handicraft shopping, and departure.</li></ul><h3>Package Notes</h3><p>Ideal for families, friends, and culture lovers. Cab, hotel category, guide, monument tickets, and meals can be customized based on budget and travel style.</p>',NULL,'https://commons.wikimedia.org/wiki/Special:FilePath/Amer%20Fort,%20Jaipur.jpg','[\"https://commons.wikimedia.org/wiki/Special:FilePath/Amer%20Fort,%20Jaipur.jpg\",\"https://commons.wikimedia.org/wiki/Special:FilePath/Jaipur%2003-2016%2002%20Amber%20Fort.jpg\",\"https://commons.wikimedia.org/wiki/Special:FilePath/Hawa%20Mahal%20Jaipur.jpg\",\"https://commons.wikimedia.org/wiki/Special:FilePath/20191218%20Hawa%20Mahal%20%28The%20Palace%20of%20Winds%29%20in%20Jaipur,%201150%209148.jpg\"]',1,'2026-05-24 22:30:11'),(3,'Alleppey Backwater Houseboat','Alappuzha, Kerala',9999,'<p>Experience Kerala at a slower rhythm with a backwater-focused Alleppey trip. The package is built around calm waterways, houseboat scenery, village landscapes, coconut groves, and traditional Kerala-style hospitality.</p><h3>Suggested Itinerary</h3><ul><li><strong>Day 1 morning:</strong> Arrive at Alleppey and board the houseboat/day-cruise point after a welcome briefing.</li><li><strong>Day 1 afternoon:</strong> Cruise through narrow canals, paddy fields, village banks, and open lake stretches with lunch on board where applicable.</li><li><strong>Day 1 evening:</strong> Sunset views, tea/snacks, and optional overnight stay depending on selected boat type.</li><li><strong>Day 2 morning:</strong> Breakfast on board, short cruise, checkout, and optional visit to Alleppey beach or local market.</li></ul><h3>Package Notes</h3><p>Boat category, AC/non-AC rooms, meal plan, private/shared cruise, and overnight stay can change the final price. Best for couples, families, and relaxed scenic holidays.</p>',NULL,'https://commons.wikimedia.org/wiki/Special:FilePath/Houseboat%20in%20Alleppey%20%287057374293%29.jpg','[\"https://commons.wikimedia.org/wiki/Special:FilePath/Houseboat%20in%20Alleppey%20%287057374293%29.jpg\",\"https://commons.wikimedia.org/wiki/Special:FilePath/Backwaters%20of%20Alleppey.jpg\",\"https://commons.wikimedia.org/wiki/Special:FilePath/Houseboat%20on%20Alleppey%20backwaters%20%28Kerala,%20India%202023%29%20%2852703799562%29.jpg\",\"https://commons.wikimedia.org/wiki/Special:FilePath/Alappuzha%20Kerala%20India%20file%282022%29.jpg\"]',1,'2026-05-24 22:30:11'),(4,'Goa Beach Escape','Baga, Calangute and North Goa',6999,'<p>A lively Goa escape for travelers who want beaches, cafes, forts, markets, and flexible free time. This package focuses on North Goa highlights while leaving space for optional nightlife, cruises, and water-sport add-ons.</p><h3>Suggested Itinerary</h3><ul><li><strong>Day 1:</strong> Arrival, hotel check-in, evening beach walk at Baga or Calangute, and cafe time.</li><li><strong>Day 2:</strong> North Goa sightseeing with Fort Aguada, Sinquerim, Candolim, Calangute, Baga, and optional water sports.</li><li><strong>Day 3:</strong> Leisure day for beach hopping, shopping, optional cruise, clubbing, or South Goa add-on.</li><li><strong>Day 4:</strong> Breakfast, checkout, souvenir shopping, and departure.</li></ul><h3>Package Notes</h3><p>Good for friends, couples, and budget beach holidays. Hotel category, scooter/cab choice, water sports, and cruise options can be customized.</p>',NULL,'https://commons.wikimedia.org/wiki/Special:FilePath/Baga%20Beach,%20Goa.jpg','[\"https://commons.wikimedia.org/wiki/Special:FilePath/Baga%20Beach,%20Goa.jpg\",\"https://commons.wikimedia.org/wiki/Special:FilePath/Baga%20Beach,%20Calangute,%20Goa.jpg\",\"https://commons.wikimedia.org/wiki/Special:FilePath/Aguada%20Fort%20-%20Sinquerim%20Beach%20-%20Goa%20-%200001.jpg\",\"https://commons.wikimedia.org/wiki/Special:FilePath/Aguada%20fort%20Goa%20vrvbgoa2k24%20%281%29.jpg\"]',1,'2026-05-24 22:30:11'),(5,'Ladakh Pangong Adventure','Leh, Nubra Valley and Pangong Tso',20400,'<p>A dramatic high-altitude Ladakh journey for travelers who want monasteries, mountain roads, sand dunes, blue lakes, and unforgettable landscapes. The itinerary is designed with acclimatization in mind before longer drives.</p><h3>Suggested Itinerary</h3><ul><li><strong>Day 1:</strong> Arrive in Leh, rest, acclimatize, and enjoy a light evening around Leh Market if comfortable.</li><li><strong>Day 2:</strong> Leh local sightseeing including Shanti Stupa, monasteries, palace viewpoints, and nearby cultural stops.</li><li><strong>Day 3:</strong> Drive to Nubra Valley via Khardung La with Diskit Monastery and Hunder sand dunes.</li><li><strong>Day 4:</strong> Nubra to Pangong Tso route, lake views, photography, and overnight stay near the lake where available.</li><li><strong>Day 5:</strong> Return to Leh with scenic stops and free evening.</li><li><strong>Day 6:</strong> Departure from Leh.</li></ul><h3>Package Notes</h3><p>Weather, permits, road conditions, and altitude comfort can affect the plan. Best suited for adventure travelers, photographers, bikers, and mountain-road lovers.</p>',NULL,'https://commons.wikimedia.org/wiki/Special:FilePath/Pangong%20Lake,%20Ladakh,%20India%2006.jpg','[\"https://commons.wikimedia.org/wiki/Special:FilePath/Pangong%20Lake,%20Ladakh,%20India%2006.jpg\",\"https://commons.wikimedia.org/wiki/Special:FilePath/A%20view%20of%20Pangong%20Tso.jpg\",\"https://commons.wikimedia.org/wiki/Special:FilePath/A%20Lady%20in%20White%20Dress,%20Hunder%20Sand%20Dunes,%20Nubra%20Valley,%20Ladakh.jpg\",\"https://commons.wikimedia.org/wiki/Special:FilePath/Monk%20engrossed%20in%20prayer%20in%20a%20monastery%20in%20Ladakh.jpg\"]',1,'2026-05-24 22:30:11'),(6,'Kashmir Valley Highlights','Srinagar, Gulmarg, Pahalgam and Sonamarg',18999,'<p>A scenic Kashmir route covering lake life, gardens, meadows, valleys, and mountain viewpoints. This package is ideal for travelers who want the classic Kashmir experience with a comfortable pace and optional upgrades.</p><h3>Suggested Itinerary</h3><ul><li><strong>Day 1:</strong> Arrive in Srinagar, check in, evening Shikara ride on Dal Lake, and local market time.</li><li><strong>Day 2:</strong> Srinagar sightseeing with Mughal gardens, lake viewpoints, and optional houseboat stay upgrade.</li><li><strong>Day 3:</strong> Day trip or transfer to Gulmarg for meadow views, gondola option, and snow activities in season.</li><li><strong>Day 4:</strong> Visit Pahalgam with valley views, riverside stops, and optional Betaab/Aru/Chandanwari local sightseeing.</li><li><strong>Day 5:</strong> Sonamarg-style mountain excursion subject to season and road conditions.</li><li><strong>Day 6:</strong> Departure from Srinagar.</li></ul><h3>Package Notes</h3><p>Best for honeymooners, families, and nature lovers. Gondola tickets, pony rides, union taxis, snow activities, and premium stays can be added separately.</p>',NULL,'https://commons.wikimedia.org/wiki/Special:FilePath/Dal%20lake%20aesthetics.jpg','[\"https://commons.wikimedia.org/wiki/Special:FilePath/Dal%20lake%20aesthetics.jpg\",\"https://commons.wikimedia.org/wiki/Special:FilePath/Pahalgam%20Valley.jpg\",\"https://commons.wikimedia.org/wiki/Special:FilePath/Sonamarg%20Kashmir%20J%26K%20India.jpg\",\"https://commons.wikimedia.org/wiki/Special:FilePath/Sindh%20River,%20Sonmarg%20-%20Kashmir%20%2845126478305%29.jpg\"]',1,'2026-05-24 22:30:11');
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rate_review` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `user_id` int(30) NOT NULL,
  `package_id` int(30) NOT NULL,
  `rate` int(11) NOT NULL,
  `review` text DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
INSERT INTO `rate_review` VALUES (1,4,1,5,'<p>Beautiful sunrise plan and very easy to understand.</p>','2026-05-24 22:30:11'),(2,5,3,5,'<p>The backwater package looks peaceful and well priced.</p>','2026-05-24 22:30:11'),(3,4,4,4,'<p>Good Goa weekend option for a budget trip.</p>','2026-05-24 22:30:11');
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_info` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
INSERT INTO `system_info` VALUES (1,'name','Explore India Tours'),(6,'short_name','Explore India'),(11,'logo','uploads/1623978900_masskara.png'),(13,'user_avatar','uploads/user_avatar.jpg'),(14,'cover','https://commons.wikimedia.org/wiki/Special:FilePath/Baga%20Beach,%20Goa.jpg');
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
INSERT INTO `users` VALUES (1,'Administrator','User','admin','0192023a7bbd73250516f069df18b500','uploads/1620201300_avatar.png',NULL,1,'2021-01-20 14:02:37','2021-06-18 16:47:05'),(4,'Demo','Traveler','demo_traveler','1254737c076cf867dc53d60a0364f38e',NULL,NULL,0,'2021-06-19 08:36:09','2021-06-19 10:53:12'),(5,'Sample','Guest','sample_guest','4744ddea876b11dcb1d169fadf494418',NULL,NULL,0,'2021-06-19 10:01:51','2021-06-19 12:03:23');

