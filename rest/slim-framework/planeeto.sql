/* STEP 1: Create Database for the Application */
CREATE DATABASE IF NOT EXISTS planeeto DEFAULT CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';
USE planeeto;

/* STEP 2: Setup Tables for the Application */
CREATE TABLE planet (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) UNIQUE NOT NULL,
	region VARCHAR(50) DEFAULT 'unknown',
	physical_class VARCHAR(50) DEFAULT 'unknown',  
    diameter INT DEFAULT NULL,
	capital VARCHAR(50) DEFAULT 'unknown',	
	description TEXT DEFAULT NULL,
	picture VARCHAR(100) DEFAULT 'default.jpg',
    PRIMARY KEY (id)
);

/* STEP 3: Insert Initial Data */
INSERT INTO  planet (
	id,
	name,
	region,
	physical_class,
	diameter,
	capital,
	description,
	picture
) VALUES (
	NULL ,  'Coruscant',  'Core Worlds',  'Terrestrial',  '12240',  'Humans, Taung, Zhell', 'Coruscant, originally called Notron, also known as Imperial Center or the Queen of the Core, was a planet located in the Galactic Core. It was generally agreed that Coruscant was, during most of galactic history, the most politically important world in the galaxy.', 'coruscant.jpg'),(
	NULL ,  'Anaxes',  'Core Worlds',  'Terrestrial',  '16100',  'Anaxsi', 'Anaxes was a fortress world located in the Axum system of the Core Worlds, and was known as the Defender of the Core by the Galactic Republic and later the Galactic Empire. It was located on the Perlemian Trade Route and shared its sun, Solis Axum, with Selgon, Grastes, Axum, Urfon, Phlors Rex, Phlors Regina, and Ichium.', 'anaxes.jpg'),(
	NULL ,  'Fondor',  'Colonies',  'Terrestrial',  '9100',  'Mynocks, Mud Puppy, Fondorian', 'Fondor was a planet famous throughout the galaxy for its extensive orbital shipyards, outclassed only by those at Corellia and Kuat. The Fondor Shipyards were associated with the Techno Union prior to the Clone Wars, and were sufficiently vast to construct the Executor, Darth Vaders Executor-class Star Dreadnought. The capital city was Fondor City and later Oridin City.', 'fondor.jpg'),(
	NULL ,  'Bestine IV',  'Inner Rim',  'Terrestrial',  '6400',  'Sink Crab, Armored Fish', 'Bestine IV, or simply Bestine, was an aquacultural planet in the Inner Rim, along the Corellian Trade Spine. Nearly all of its surface was covered by a vast ocean, but there were many rugged islands spread across the planet.', 'bestine.jpg'),(
	NULL ,  'Duro',  'Core Worlds',  'Terrestrial',  '12765',  'Duros, Fefze Beetle', 'Duro (also known as Duros) was the heavily polluted and depopulated homeworld of the Duros species. Located on the Corellian Trade Spine in the Core, the planet itself was mostly abandoned, mainly housing food processing plants. Most of the population lived in one of the twenty orbiting cities. Duro was also home to a large number of orbital shipyards.', 'duro.jpg'),(
	NULL ,  'Naboo',  'Mid Rim',  'Terrestrial',  '11000',  'Humans, Selonian, Slice Hound, Wonat', 'Corellia was the capital planet of the Corellian system, which included Selonia, Drall, Tralus, and Talus. It was also the birthplace of smuggler and New Republic General Han Solo as well as Rogue Squadron pilot and New Republic hero Wedge Antilles, along with many other humans who played important roles in the histories of the Rebel Alliance, New Republic, and Galactic Alliance.', 'corellia.jpg'
);