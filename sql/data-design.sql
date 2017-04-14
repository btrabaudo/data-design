DROP TABLE IF EXISTS favorite;
DROP TABLE IF EXISTS product;
DROP TABLE IF EXISTS profile;

CREATE TABLE profile (

profileID INT UNSIGNED AUTO_INCREMENT NOT NULL,
profileActivationToken CHAR(32),
profileAtHandle VARCHAR(32) NOT NULL,
profileEmail VARCHAR(128) UNIQUE NOT NULL,
profilePassHash CHAR (128) NOT NULL,
profilePassSalt CHAR (64) NOT NULL,
UNIQUE(profileEmail),
UNIQUE(profileAtHandle)
PRIMARY KEY(profileId)

);

CREATE TABLE product (

productId INT UNSIGNED AUTO_INCREMENT NOT NULL,
productContent VARCHAR (128) NOT NULL,
productPrice DECIMAL NOT NULL,
productDate DATETIME NOT NULL,
PRIMARY KEY (productId)

);

CREATE TABLE favorite (

favoriteProfileId INT UNSIGNED NOT NULL,
favoriteProductId INT UNSIGNED NOT NULL,
favortieDate DATETIME NOT NULL,

INDEX(favoriteProfileId),
INDEX(favoriteProductId),

FOREIGN KEY(favoriteProductId)
FOREIGN KEY(favoriteProfileId)

PRIMARY KEY(favoriteProductId, favoriteProfileId)

);