CREATE TABLE `Users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email_ID` varchar(255) NOT NULL UNIQUE,
  `password` varchar(360) NOT NULL,
  `isAdmin` boolean NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `Products` (
  `productID` int(11) NOT NULL AUTO_INCREMENT,
  `productName` varchar(255) NOT NULL,
  `price` float(11) NOT NULL,
  `image_path` varchar(255),
  `description` varchar(5000),
  PRIMARY KEY (`productID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- TRACKS ALL RELATIONSHIPS BETWEEN USER AND PRODUCT, ACTS AS A CART AND A STORAGE FOR PURCHASED/SHIPPED PRODUCTS
-- IF `isPurchased` IS FALSE, THEN PRODUCT IS IN USER'S CART
-- IF `isPurchased` IS TURE, THEN PRODUCT HAS BEEN PURCHASED. `date` AND `time` OF PURCHASE IS THEN RECORDED, THIS
--    DATA IS THEN ONLY VISIBLE TO ADMINISTRATORS
CREATE TABLE `Users_Products` (
  `orderID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `isPurchased` boolean NOT NULL DEFAULT 0,
  `date` date,
  `isShipped` boolean NOT NULL DEFAULT 0,
  PRIMARY KEY (`orderID`),
  FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`)
  ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (`productID`) REFERENCES `Products` (`productID`)
  ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `Reviews` (
  `reviewID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL, 
  `feedback` varchar(5000) NOT NULL,
  PRIMARY KEY (`reviewID`),
  FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`)
  ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
