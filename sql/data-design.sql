DROP TABLE IF EXISTS favorite;
DROP TABLE IF EXISTS product;
DROP TABLE IF EXISTS profile;

CREATE TABLE profile (

  profileID INT UNSIGNED AUTO_INCREMENT NOT NULL,
  profileActivationToken CHAR(32),
  profileAtHandle VARCHAR(32) UNIQUE NOT NULL,
  profileEmail VARCHAR(128) UNIQUE NOT NULL,
  profilePassHash CHAR(128) NOT NULL,
  profilePassSalt CHAR(64) NOT NULL,
  PRIMARY KEY(profileId)

);

CREATE TABLE product (

  productId INT UNSIGNED AUTO_INCREMENT NOT NULL,
  productContent VARCHAR(128) NOT NULL,
  productPrice DECIMAL(6,2) NOT NULL,
  productDate DATE NOT NULL,
  PRIMARY KEY (productId)

);

CREATE TABLE favorite (

  favoriteProfileId INT UNSIGNED NOT NULL,
  favoriteProductId INT UNSIGNED NOT NULL,
  favortieDate DATETIME(6) NOT NULL,

  INDEX(favoriteProfileId),
  INDEX(favoriteProductId),

  FOREIGN KEY(favoriteProductId) REFERENCES product(productId),
  FOREIGN KEY(favoriteProfileId) REFERENCES profile(profileId),

  PRIMARY KEY(favoriteProductId, favoriteProfileId)

);