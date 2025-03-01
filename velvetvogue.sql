-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2024 at 04:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `velvetvogue`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminregister`
--

CREATE TABLE `adminregister` (
  `AdminID` int(11) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `ConfirmPassword` varchar(255) NOT NULL,
  `CreatedAt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminregister`
--

INSERT INTO `adminregister` (`AdminID`, `FullName`, `Email`, `Password`, `ConfirmPassword`, `CreatedAt`) VALUES
(1, 'Rakitha Rajapaksha', 'RakithaKesaridu@gmail.com', '$2y$10$KfQ8/EBp0dlKhU/TDMgczefnG5s8w0Rke9qgUbnoLi5FdOG.aXJBe', '$2y$10$heSdPRt0y0njPPhDK5VkRuM2zU5gwjfZC.2piBcv9HMsjBjCYDI9i', '2024-12-29 10:34:25');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(100) NOT NULL,
  `GenderID` int(11) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryName`, `GenderID`, `image_path`) VALUES
(1, 'Tops', 1, 'images/Mens Tops.jpg'),
(2, 'Tops', 2, 'images/women tops.jpg'),
(3, 'Bottoms', 1, 'images/Mens Bottoms.jpg'),
(4, 'Bottoms', 2, 'images/women bottoms.jpg'),
(5, 'Dresses', 2, 'images/women dresses.jpg'),
(6, 'Outwear', 1, 'images/Mens Outwears.jpg'),
(7, 'Outwear', 2, 'images/women outerwear.jpg'),
(8, 'Activewear', 1, 'images/Mens Activewears.jpg'),
(9, 'Activewear', 2, 'images/women activewear.jpg'),
(10, 'Suits', 1, 'images/Mens Suites.jpg'),
(11, 'Sleepwear', 1, 'images/Mens Sleepwears.jpg'),
(12, 'Sleepewear', 2, 'images/women sleepwear.jpg'),
(13, 'Undergarment', 1, 'images/Mens Undergarments.jpg'),
(14, 'Undergarment', 2, 'images/women undergarments.jpeg'),
(15, 'Footwear', 1, 'images/Mens Footwears.jpg'),
(16, 'Footwear', 2, 'images/women footwear.jpg'),
(17, 'Accessories', 1, 'images/Mens Accessories.jpg'),
(18, 'Accessories', 2, 'images/women accessories.jpeg'),
(19, 'Formal wear Top', 1, 'images/mens formal wear tops.jpg'),
(20, 'Formal wear Top', 2, 'images/women formal wear tops.jpg'),
(21, 'Formal wear Bottom', 1, 'images/mens formal wear bottoms.jpg'),
(22, 'Formal wear Bottom', 2, 'images/women formal wear bottoms.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `categorysubcategory`
--

CREATE TABLE `categorysubcategory` (
  `CategoryID` int(11) NOT NULL,
  `SubCategoryID` int(11) NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorysubcategory`
--

INSERT INTO `categorysubcategory` (`CategoryID`, `SubCategoryID`, `ID`) VALUES
(1, 1, 1),
(1, 3, 2),
(1, 4, 3),
(2, 1, 4),
(2, 2, 5),
(2, 3, 6),
(2, 4, 7),
(2, 5, 8),
(3, 6, 9),
(3, 8, 10),
(3, 9, 11),
(4, 6, 12),
(4, 7, 13),
(4, 8, 14),
(4, 9, 15),
(4, 10, 16),
(5, 11, 17),
(6, 12, 18),
(6, 13, 19),
(7, 12, 20),
(7, 13, 21),
(7, 14, 22),
(7, 15, 23),
(8, 16, 24),
(9, 16, 25),
(10, 17, 26),
(11, 18, 27),
(12, 18, 28),
(13, 21, 29),
(14, 19, 30),
(14, 20, 31),
(15, 22, 32),
(15, 23, 33),
(15, 24, 34),
(15, 25, 35),
(15, 26, 36),
(16, 22, 37),
(16, 23, 38),
(16, 24, 39),
(16, 25, 40),
(16, 26, 41),
(17, 27, 42),
(17, 28, 43),
(17, 29, 44),
(17, 30, 45),
(17, 31, 46),
(17, 32, 47),
(18, 27, 48),
(18, 28, 50),
(18, 29, 51),
(18, 30, 52),
(18, 31, 53),
(18, 32, 54),
(19, 33, 55),
(20, 33, 56),
(21, 34, 57),
(22, 34, 58);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'Anna Watson', 'Anna@gmail.com', 'Delivery Package ', 'I didn\'t get my package yet', '2024-12-28 04:30:13');

-- --------------------------------------------------------

--
-- Table structure for table `customerregister`
--

CREATE TABLE `customerregister` (
  `CustomerID` int(11) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `ConfirmPassword` varchar(255) NOT NULL,
  `CreatedAt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customerregister`
--

INSERT INTO `customerregister` (`CustomerID`, `FullName`, `Email`, `Password`, `ConfirmPassword`, `CreatedAt`) VALUES
(1, 'Tharini Rehansa Rajapaksha', '123.rehansa@gmail.com', '$2y$10$SnQ8dJSlKUYosa/ANtRmY.ipXRuoo.AQDMQgTOMWhhTsah2qMC5Mi', '$2y$10$gPK0logRPntkig7K9VVOHO.r4k3xp6Ehv3a6GKkDXB/.fveEhV2Da', '2024-12-25 13:33:50'),
(2, 'Anna Watson', 'Anna@gmail.com', '$2y$10$B6aYl4PsdQaAcSNDsRYoreQJtp/E/FNyQ02wTjBf10cmE1ZSyuPY6', '$2y$10$B6aYl4PsdQaAcSNDsRYoreQJtp/E/FNyQ02wTjBf10cmE1ZSyuPY6', '2024-12-28 09:46:33');

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `dob` date NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`id`, `email`, `first_name`, `last_name`, `phone`, `address`, `gender`, `dob`, `profile_image`, `created_at`, `updated_at`) VALUES
(1, '123.rehansa@gmail.com', 'Tharini', 'Rajapaksha', '0771740070', '8 canal economic center road Dambulla, Sri Lanka', 'Female', '2000-10-27', 'uploads/1635039844549.jpeg', '2024-12-25 08:05:04', '2024-12-25 08:05:04'),
(2, 'Anna@gmail.com', 'Anna', 'Watson', '+94779970602', '7 Hills Rose Street Sydney Australia', 'Female', '1995-10-28', 'uploads/1635039844549.jpeg', '2024-12-28 04:25:53', '2024-12-28 04:25:53');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `GenderID` int(11) NOT NULL,
  `GenderName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`GenderID`, `GenderName`) VALUES
(1, 'Men'),
(2, 'Women');

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `inquiry_message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`id`, `full_name`, `email`, `phone_number`, `subject`, `inquiry_message`, `created_at`) VALUES
(1, 'Tharini Rehansa Rajapaksha', '123.rehansa@gmail.com', '0771740070', 'Winter Jackets Needed', 'Need a quotation for winter jackets about 250', '2024-12-27 05:24:22'),
(2, 'Anna Watson', 'Anna@gmail.com', '779970601', 'Need printed T-shirts', 'I need Printed T-shirts in every size that you have available about 10 packs \r\nplease send me a quotation\r\nThank you', '2024-12-28 04:32:10');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `InvoiceID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `CustomerName` varchar(255) NOT NULL,
  `CustomerEmail` varchar(255) NOT NULL,
  `CustomerAddress` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `Country` varchar(255) NOT NULL,
  `PostalCode` varchar(10) NOT NULL,
  `Subtotal` decimal(10,2) NOT NULL,
  `ShippingFee` decimal(10,2) NOT NULL,
  `Tax` decimal(10,2) NOT NULL,
  `GrandTotal` decimal(10,2) NOT NULL,
  `InvoiceDate` date NOT NULL,
  `DueDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`InvoiceID`, `OrderID`, `CustomerName`, `CustomerEmail`, `CustomerAddress`, `City`, `Country`, `PostalCode`, `Subtotal`, `ShippingFee`, `Tax`, `GrandTotal`, `InvoiceDate`, `DueDate`) VALUES
(1, 12, 'Anna Watson', 'Anna@gmail.com', '7 hills ', 'kandy', 'Sri Lanka', '22000', 6000.00, 250.00, 520.00, 6770.00, '2024-12-29', '2025-01-05'),
(2, 13, 'Anna Watson', 'Anna@gmail.com', '7 hills ', 'kandy', 'Sri Lanka', '22000', 5100.00, 250.00, 520.00, 5870.00, '2024-12-29', '2025-01-05'),
(5, 14, 'Tharini Rehansa Rajapaksha', '123.rehansa@gmail.com', '8 canal', 'Dambulla', 'Sri Lanka', '21100', 3800.00, 250.00, 520.00, 4570.00, '2024-12-29', '2025-01-05'),
(6, 15, 'Tharini Rehansa Rajapaksha', '123.rehansa@gmail.com', '8 canal', 'Dambulla', 'Sri Lanka', '21100', 3800.00, 250.00, 520.00, 4570.00, '2024-12-29', '2025-01-05'),
(7, 16, 'Tharini Rehansa Rajapaksha', '123.rehansa@gmail.com', '8 canal', 'Dambulla', 'Sri Lanka', '21100', 3800.00, 250.00, 520.00, 4570.00, '2024-12-29', '2025-01-05'),
(8, 17, 'Tharini Rehansa Rajapaksha', '123.rehansa@gmail.com', '8 canal', 'Dambulla', 'Sri Lanka', '21100', 4100.00, 250.00, 520.00, 4870.00, '2024-12-29', '2025-01-05'),
(9, 18, 'Tharini Rehansa Rajapaksha', '123.rehansa@gmail.com', '8 canal', 'Dambulla', 'Sri Lanka', '21100', 4200.00, 250.00, 520.00, 4970.00, '2024-12-29', '2025-01-05'),
(10, 19, 'Tharini Rehansa Rajapaksha', '123.rehansa@gmail.com', '8 canal', 'Dambulla', 'Sri Lanka', '21100', 4800.00, 250.00, 520.00, 5570.00, '2024-12-29', '2025-01-05'),
(11, 20, 'Tharini Rehansa Rajapaksha', '123.rehansa@gmail.com', '8 canal', 'Dambulla', 'Sri Lanka', '21100', 5100.00, 250.00, 520.00, 5870.00, '2024-12-29', '2025-01-05'),
(12, 21, 'Tharini Rajapaksha', '123.rehansa@gmail.com', '356/5 rajakiya widiya colombo 004', 'Colombo', 'Sri Lanka', '21100', 24500.00, 250.00, 520.00, 25270.00, '2024-12-30', '2025-01-06');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `OrderID` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `CartID` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `TotalPrice` decimal(10,2) NOT NULL,
  `OrderDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `GenderID` int(11) DEFAULT NULL,
  `CategoryID` int(11) DEFAULT NULL,
  `SubCategoryID` int(11) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Type` varchar(50) NOT NULL,
  `Description` text DEFAULT NULL,
  `IsPromotion` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `ProductName`, `GenderID`, `CategoryID`, `SubCategoryID`, `Image`, `Type`, `Description`, `IsPromotion`) VALUES
(1, 'Guess Men Logo T-Shirt', 1, 1, 1, 'T-shirt 1.jpeg', 'Casual wear', 'A stylish and comfortable t-shirt featuring the iconic Guess logo. Made from high-quality cotton, this t-shirt offers a perfect fit for everyday wear. With its classic design and bold logo, it’s a must-have addition to any modern man s wardrobe. Ideal for casual outings or paired with jeans for a laid-back look.', 1),
(2, 'Polo T-Shirt', 1, 1, 1, 'T-shirt 2.jpeg', 'Casual wear', 'This classic polo t-shirt offers a smart casual style, perfect for a laid-back yet polished look. It belongs to the casual wear category and is designed for men. The image  highlights the product look.', 1),
(3, 'Crew Neck T-shirt', 1, 1, 1, 'T-shirt 3.jpeg', 'Casual wear', 'A simple yet stylish crew neck t-shirt, ideal for everyday casual wear. It is designed for men and fits within the casual wear category. The product image displays its straightforward design.', 0),
(4, 'Polo T-shirt', 1, 1, 1, 'T-shirt 4.jpeg', 'Casual wear', 'Another stylish polo t-shirt, great for a smart casual look. It is categorized under men casual wear, and the image  offers a clear representation of the product.', 0),
(5, 'Rad Graphic Tshirt', 2, 2, 1, 'Women T-shirt 1.jpeg', 'Casual wear', 'This women graphic t-shirt features a bold design, making it perfect for a trendy, casual look. It falls under the women casual wear category. The image  showcases its vibrant graphic.', 1),
(6, 'Rad Graphic Tshirt', 2, 2, 1, 'Women T-shirt 2.jpeg', 'Casual wear', 'This is another stylish women graphic t-shirt, featuring a fun design for those who want to stand out. It belongs to the casual wear category for women. The image shows the graphic detail.', 1),
(7, 'Graphic Boxy Tshirt', 2, 2, 1, 'Women T-shirt 3.jpeg', 'Casual wear', 'This women boxy t-shirt combines comfort with a cool graphic design, making it ideal for casual outfits. It is categorized under women casual wear. The image demonstrates the loose, stylish fit.', 0),
(8, 'Enjoying Life Graphic T-shirt', 2, 2, 1, 'Women T-shirt 4.jpeg', 'Casual wear', 'A graphic t-shirt designed for women, with a positive, playful message \"Enjoying Life\" for a casual, fun look. It fits into the casual wear category. The image displays the uplifting design.', 0),
(9, 'Mango Topacio Blouse', 2, 2, 2, 'Blouse 1.jpeg', 'Casual wear', 'This elegant Mango blouse offers a sophisticated look with its simple yet stylish design, making it perfect for casual or semi-formal wear. It falls under the women’s blouse category in casual wear. The image showcases the blouse’s elegant cut.', 0),
(10, 'Mango Dots Blouse', 2, 2, 2, 'Blouse 2.jpeg', 'Casual wear', 'This Mango blouse features a playful dotted pattern, adding a fun and fashionable twist to casual attire. It is categorized under women’s blouses in the casual wear section. The image highlights the dotted design.', 0),
(11, 'Mango Women Flori Blouse', 2, 2, 2, 'Blouse 3.jpeg', 'Casual wear', 'A floral blouse from Mango, offering a chic and feminine touch to casual wear. This item belongs to the women blouse category. The image illustrates the blouse floral pattern.', 0),
(12, 'Mango Blouse', 2, 2, 2, 'Blouse 4.jpeg', 'Casual wear', 'This versatile Mango blouse is perfect for casual days, combining comfort and style. It fits within the casual wear category for women’s blouses. The image presents the product’s clean, simple look.', 0),
(13, 'Printed Long Sleeve Shirt', 1, 1, 3, 'Shirt 1.jpeg', 'Casual wear', 'This men’s Guess crew neck sweatshirt combines comfort with classic styling. Perfect for casual wear, it is ideal for layering or wearing on its own. The image displays the sweatshirt’s simple yet stylish design.', 0),
(14, 'Printed Short Sleeve Shirt', 1, 1, 3, 'Shirt 2.jpeg', 'Casual wear', 'A versatile casual sweatshirt for men, offering a relaxed fit for comfort and easy styling. It falls under the casual wear category. The image highlights its casual design.', 0),
(15, 'Long Sleeve Shirt', 1, 1, 3, 'Shirt 3.jpeg', 'Casual wear', 'A stylish hoodie by Guess for men, perfect for layering in colder weather. It’s designed for casual comfort with a relaxed fit. The image shows its trendy design and comfortable fit.', 0),
(16, 'Jack & Jones Saole Shirt', 1, 1, 3, 'Shirt 4.jpeg', 'Casual wear', 'This classic hoodie for men offers a comfortable fit and a sporty look, ideal for casual days or outdoor activities. It is part of the casual wear category. The image displays the relaxed design.', 0),
(17, 'Shirt', 2, 2, 3, 'Women Shirt 1.jpeg', 'Casual wear', 'A casual sweatshirt designed for men, perfect for any laid-back occasion. This piece offers warmth and comfort in a simple style. The image illustrates the sweatshirt’s minimalist design.', 0),
(18, 'Shirt', 2, 2, 3, 'Women Shirt 2.jpeg', 'Casual wear', 'This Guess women’s sweater is ideal for a stylish yet comfortable look, perfect for cooler weather. It fits within the women’s casual wear category. The image highlights the cozy design.', 0),
(19, 'Shirt', 2, 2, 3, 'Women Shirt 3.jpeg', 'Casual wear', 'A casual sweatshirt for women, offering comfort and a laid-back style, perfect for everyday wear. It belongs to the casual wear category. The image demonstrates the simple, stylish fit.', 0),
(20, 'Shirt', 2, 2, 3, 'Women Shirt 4.jpeg', 'Casual wear', 'This women casual sweatshirt provides a relaxed fit, making it a great option for casual outings or lounging. It falls within the casual wear category for women. The image showcases the cozy design.', 0),
(21, 'Chunky Knit Wool Sweater', 1, 1, 4, 'Sweater 1.jpg', 'Casual wear', 'A sophisticated sweater from Guess for women, perfect for a more refined casual look. Ideal for cooler days, it’s stylish and comfortable. The image shows the elegant design.', 0),
(22, 'Woollen Sweaters', 1, 1, 4, 'Sweater 2.jpg', 'Casual wear', 'These Guess men’s jogger pants offer a trendy and comfortable option for casual wear. Perfect for lounging or light activities, they provide both style and practicality. The image illustrates the sporty fit.', 0),
(23, 'Woollen Sweaters', 2, 2, 4, 'Women Sweater 1.jpg', 'Casual wear', 'A pair of men’s jogger pants designed for ultimate comfort and style. Perfect for casual days or athletic activities, they belong in the casual wear category. The image showcases their sleek design.', 0),
(24, 'Woollen Sweaters', 2, 2, 4, 'Women Sweater 2.jpg', 'Casual wear', 'These casual pants for men are a great addition to any laid-back outfit, offering comfort and style in one. They fit into the casual wear category. The image displays their simple yet practical design.', 0),
(25, 'Back Tank Top', 2, 2, 5, 'Tank Top 1.jpeg', 'Casual wear', 'A stylish pair of men’s casual pants designed for comfort and ease, perfect for everyday wear. These pants are part of the casual wear category. The image highlights their versatile design.', 0),
(26, 'Rib Cropped Tank Top', 2, 2, 5, 'Tank Top 2.jpeg', 'Casual wear', 'These Guess jogger pants for women offer a comfortable yet stylish look, perfect for casual outings or lounging. They belong to the women’s casual wear category. The image shows their sleek and sporty design.', 0),
(27, 'Check Designed Pant', 1, 3, 6, 'Jeans 1.jpeg', 'Casual wear', 'These women’s jogger pants combine comfort with casual style, ideal for easygoing days. The image presents their modern design in a relaxed fit.', 0),
(28, 'Check Designed Pant', 1, 3, 6, 'Jeans 2.jpeg', 'Casual wear', 'A stylish pair of casual pants for women, perfect for everyday wear. They combine comfort with a chic design, making them versatile for casual outings. The image highlights the modern design.', 0),
(29, 'Black High Waist Boyfriend Fit Side Slit Denim', 2, 4, 6, 'Women Jeans 1.jpeg', 'Casual wear', 'These women’s casual pants are both comfortable and stylish, ideal for a relaxed, trendy look. They fall under the casual wear category. The image showcases the comfortable fit.', 0),
(30, 'Mid Waist Regular Fit Denim', 2, 4, 6, 'Women Jeans 2.jpeg', 'Casual wear', 'These men’s shorts offer a comfortable and stylish option for warm-weather casual wear. Perfect for outdoor activities, they belong in the casual wear category. The image displays the simple design.', 0),
(31, 'Printed Side Tie Up Mini Wrap Skirt', 2, 4, 7, 'Skirt 1.jpeg', 'Casual wear', 'These casual shorts for men are perfect for warmer weather or laid-back days. Comfortable and stylish, they are part of the casual wear category. The image shows their relaxed, easy fit.', 0),
(32, 'Flared Knee Length Skirt', 2, 4, 7, 'Skirt 2.jpeg', 'Casual wear', 'These stylish men’s casual shorts are perfect for the summer, offering both comfort and style for casual outings. The image highlights their sporty yet relaxed look.', 0),
(33, 'Denim Shorts', 1, 3, 8, 'Shorts 1.jpeg', 'Casual wear', 'Guess women’s shorts are a must-have for summer, providing comfort and a trendy look. Designed for a relaxed fit, they belong to the casual wear category. The image displays their chic and modern design.', 0),
(34, 'Wyos Printed Shorts', 1, 3, 8, 'Shorts 2.jpeg', 'Casual wear', 'These women’s casual shorts are perfect for the warm season, offering both comfort and style. They fit the casual wear category and are perfect for any casual occasion. The image shows the modern design.', 0),
(35, 'High Waist Pleated Zip Up Shorts', 2, 4, 8, 'Women Shorts 1.jpeg', 'Casual wear', 'These casual shorts for women are designed for comfort and style, making them perfect for the summer months. They are ideal for laid-back outings or lounging at home. The image displays their simple yet stylish design.', 0),
(36, 'Slightly Loose Fitted Mini Short', 2, 4, 8, 'Women Shorts 2.jpeg', 'Casual wear', 'These women’s casual shorts are a versatile and stylish choice for warm weather. They provide comfort and ease, perfect for any casual event or day off. The image showcases their relaxed and trendy design.', 0),
(37, 'Wyos Trousers', 1, 3, 9, 'Trousers 1.jpeg', 'Casual wear', 'This Guess men’s T-shirt offers a sleek and stylish look with a comfortable fit. It is perfect for casual wear, designed to be worn for everyday occasions. The image displays the simple yet fashionable design.', 0),
(38, 'Wyos Trousers', 1, 3, 9, 'Trousers 2.jpeg', 'Casual wear', 'A casual T-shirt for men that is both comfortable and stylish. Perfect for layering or wearing on its own, this T-shirt fits into the casual wear category. The image highlights its relaxed fit.', 0),
(39, 'High Waist Pleated Zip Up Shorts', 2, 4, 9, 'Women Trousers 1.jpeg', 'Casual wear', 'This men’s casual T-shirt is ideal for any laid-back occasion. It offers comfort and versatility, making it a great addition to any wardrobe. The image shows the simple yet practical design.', 0),
(40, 'Slightly Loose Fitted Mini Short', 2, 4, 9, 'Women Trousers 2.jpeg', 'Casual wear', 'A stylish men’s T-shirt, perfect for any casual outing. Comfortable and easy to style, this T-shirt belongs in the casual wear category. The image showcases its clean design.', 0),
(41, 'Amplify Leggings', 2, 4, 10, 'Women Leggings 1.jpeg', 'Casual wear', 'A trendy Guess women’s T-shirt that combines style and comfort. Perfect for everyday wear, it is part of the casual wear category. The image displays its chic and modern design.', 0),
(42, 'Womens Leggings', 2, 4, 10, 'Women Leggings 2.jpeg', 'Casual wear', 'This casual T-shirt for women offers a comfortable fit with a relaxed, stylish design. It is a great choice for casual outings or lounging. The image shows its simple and trendy look.', 0),
(43, '2 Tone Wrap Dress', 2, 5, 11, 'Women Dress 1.jpeg', 'Casual wear', 'This women’s casual T-shirt is perfect for a relaxed, everyday look. Comfortable and versatile, it is ideal for layering or wearing on its own. The image highlights the stylish and effortless design.', 0),
(44, 'Sleeve Belted Midi Cutlon Dress', 2, 5, 11, 'Women Dress 2.jpeg', 'Casual wear', 'A stylish casual T-shirt for women, perfect for any laid-back occasion. Comfortable and easy to pair with any outfit, this T-shirt falls into the casual wear category. The image showcases its simple design.', 0),
(45, 'Winter Jacket', 2, 7, 12, 'Women Jacket 1.jpg', 'Casual wear', 'A warm and stylish women winter jacket designed for cold weather. Featuring a comfortable fit with a plush lining, it provides both warmth and protection from the elements. This jacket is perfect for staying cozy and fashionable during winter months.', 0),
(46, 'Winter Jacket & Coat', 2, 7, 12, 'Women Jacket 2.jpeg', 'Casual wear', 'A versatile women winter jacket and coat that combines style and functionality. The jacket features a comfortable fit, with insulated material to keep you warm, while its stylish design ensures you look chic even in the harshest weather conditions.', 0),
(47, 'Puffer Jacket', 1, 6, 12, 'Jacket 1.jpg', 'Casual wear', 'A men puffer jacket offering exceptional warmth with its thick quilted padding. Designed to keep you cozy during colder months, it features a sleek design with a modern fit, making it ideal for both outdoor adventures and casual outings.', 0),
(48, 'Solid Warm Jacket', 1, 6, 12, 'Jacket 2.jpeg', 'Casual wear', 'A men solid warm jacket, built with warmth and durability in mind. Featuring a rugged, weather-resistant fabric, it ensures protection against the cold while maintaining a stylish, casual look. Ideal for layering over your everyday attire.', 0),
(49, 'Long Coat', 1, 6, 13, 'Coat 1.jpeg', 'Casual wear', 'A men long coat designed for sophistication and warmth. Featuring a classic cut with a durable finish, it’s ideal for formal occasions or layering over a suit for added protection against the cold. Perfect for those looking for both elegance and functionality.', 0),
(50, 'Solid Warm Jacket', 1, 6, 13, 'Coat 2.jpeg', 'Casual wear', 'This men solid warm jacket is a practical and stylish outerwear option. With its lightweight yet insulated design, it provides warmth while offering a sleek and modern look. Great for casual wear or outdoor activities during colder seasons.', 0),
(51, 'Long coat', 2, 7, 13, 'Women Coat 1.jpeg', 'Casual wear', 'A stylish women long coat, perfect for layering over dresses, skirts, or trousers. Made from high-quality fabric, this coat provides warmth and a polished appearance, making it suitable for both casual and formal events. Its sleek design adds a touch of elegance.', 0),
(52, 'Long coat', 2, 7, 13, 'Women Coat 2.jpeg', 'Casual wear', 'A women long coat designed for elegance and comfort, perfect for cold weather. It features a refined cut with classic details, making it a versatile choice for both workwear and casual outings. A timeless addition to any woman winter wardrobe.', 0),
(53, 'Shawl Collar Blazer', 2, 7, 14, 'Women Blazer 1.jpeg', 'Casual wear', 'A chic women shawl collar blazer that adds a sophisticated touch to any outfit. Perfect for layering over formal or smart-casual attire, this blazer offers a sleek silhouette with a cozy collar for added warmth. Ideal for the office or evening wear.', 0),
(54, 'Shawl Collar Blazer', 2, 7, 14, 'Women Blazer 2.jpeg', 'Casual wear', 'This women shawl collar blazer features a tailored fit with an elegant shawl collar design. It’s the perfect addition to both professional and casual outfits, offering both style and comfort. A versatile piece that suits any modern wardrobe.', 0),
(55, 'Shawl Collar Blazer', 2, 7, 15, 'Women Cardigan 1.jpeg', 'Casual wear', 'A cozy women cardigan made from soft, lightweight material. This versatile piece can be worn casually over almost any outfit, providing warmth and style with its relaxed fit and elegant design. Perfect for layering during cooler weather.', 0),
(56, 'Shawl Collar Blazer', 2, 7, 15, 'Women Cardigan 2.jpeg', 'Casual wear', 'A women cardigan designed for comfort and style, featuring a soft knit fabric and a loose fit. This cardigan is a perfect addition to any casual wardrobe, easily worn over dresses, shirts, or tops for added warmth and a chic, laid-back look.', 0),
(57, 'Men Tracksuit', 1, 8, 16, 'Tracksuit 1.jpeg', 'Casual wear', 'A men tracksuit offering comfort and style for any casual occasion. With a lightweight design and breathable fabric, it’s perfect for sports, workouts, or everyday wear. The tracksuit modern cut ensures you stay stylish while remaining comfortable.', 0),
(58, 'Men Tracksuit', 1, 8, 16, 'Tracksuit 2.jpeg', 'Casual wear', 'This men tracksuit is designed for both performance and style. Made with stretchy, breathable fabric, it offers ultimate comfort for active days, whether you’re at the gym or relaxing at home. The sleek design also makes it suitable for casual outings.', 0),
(59, 'Shawl Collar Blazer', 2, 9, 16, 'Women Tracksuit 1.jpeg', 'Casual wear', 'A women tracksuit crafted from soft, flexible material for an effortlessly stylish look. Perfect for both workouts and casual outings, it offers the ideal balance of comfort and fashion. The tracksuit’s tailored fit ensures you move freely while looking great.', 0),
(60, 'Shawl Collar Blazer', 2, 9, 16, 'Women Tracksuit 2.jpeg', 'Casual wear', 'This women tracksuit is designed for comfort, offering a relaxed fit and high-quality fabric. Ideal for casual wear or athletic activities, it ensures both style and functionality. The tracksuit’s modern silhouette makes it a fashionable and practical choice.', 0),
(61, 'Men Tracksuit', 1, 11, 18, 'Pajama 1.jpeg', 'Casual wear', 'A men pajama set featuring a comfortable, relaxed fit for a good night’s sleep. Made from soft cotton, this pajama set ensures comfort throughout the night with a breathable design that’s perfect for lounging or sleeping.', 0),
(62, 'Men Tracksuit', 1, 11, 18, 'Pajama 2.jpeg', 'Casual wear', 'This men’s pajama set is designed for maximum comfort, with soft fabric that feels gentle against the skin. It features an easy, loose fit and is perfect for relaxing at home or enjoying a restful night’s sleep.', 0),
(63, 'Pyjama Set', 2, 12, 18, 'Women Pajama 1.jpeg', 'Casual wear', 'A cozy women’s pyjama set made from soft, breathable fabric for a restful night’s sleep. The set includes a comfortable top and bottoms with a relaxed fit, offering the perfect balance of style and comfort for lounging or sleeping.', 0),
(64, 'Pyjama Set', 2, 12, 18, 'Women Pajama 2.jpeg', 'Casual wear', 'This women pyjama set offers comfort and style, designed with a soft, lightweight fabric that feels great against the skin. With a relaxed fit and modern design, it’s perfect for a peaceful night’s sleep or casual lounging.', 0),
(65, 'Women T Shirt Bra', 2, 14, 19, 'Bra 1.jpeg', 'Casual wear', 'A women t-shirt bra made from soft, stretchable fabric, offering comfort and support under any outfit. The smooth finish and seamless design make it ideal for wearing under fitted t-shirts or other close-fitting clothing. A must-have in every woman’s wardrobe.', 0),
(66, 'Women Cotton Bra', 2, 14, 19, 'Bra 2.jpeg', 'Casual wear', 'This women’s cotton bra offers a comfortable, natural feel, making it perfect for everyday wear. With soft cotton fabric and a simple design, it provides full support while maintaining a breathable, lightweight feel throughout the day.', 0),
(67, 'Women Panties', 2, 14, 20, 'Panties 1.jpeg', 'Casual wear', 'Comfortable women’s panties made from soft, stretchable material. Designed for all-day wear, they offer a seamless, smooth fit that pairs perfectly with a variety of outfits. These panties combine practicality with comfort.', 0),
(68, 'Women Panties', 2, 14, 20, 'Panties 2.jpeg', 'Casual wear', 'A set of women panties made from soft and breathable fabric for ultimate comfort. The seamless design ensures they remain discreet under clothing, making them ideal for everyday wear.', 0),
(69, 'Sneaker', 1, 15, 22, 'Sneaker 1.jpeg', 'Casual wear', 'A men sneaker offering both comfort and style. With a modern design and durable materials, these sneakers are perfect for casual wear or light sports activities. The sleek silhouette and cushioned sole make them ideal for all-day wear.', 0),
(70, 'Sneaker', 1, 15, 22, 'Sneaker 2.jpeg', 'Casual wear', 'This men’s sneaker features a classic design, providing comfort and durability with every step. Made with high-quality materials, these sneakers are perfect for casual outings or outdoor activities, combining style and functionality.', 0),
(71, 'Sneaker', 2, 16, 22, 'Women Sneaker 1.jpeg', 'Casual wear', 'A women’s sneaker offering both comfort and versatility. Featuring a trendy design with cushioned support, it’s perfect for everyday wear or light activities. These sneakers add a touch of sportiness to any casual outfit.', 0),
(72, 'Sneaker', 2, 16, 22, 'Women Sneaker 2.jpeg', 'Casual wear', 'Designed for women, this sneaker features a sleek, modern design with a focus on comfort and performance. Ideal for daily wear or workouts, it combines style with function, making it a perfect addition to any active wardrobe.', 0),
(73, 'Sandal', 1, 15, 23, 'Sandal 1.jpeg', 'Casual wear', 'A men’s sandal designed for both comfort and style during warm weather. The open-toe design ensures breathability, while the sturdy straps provide a secure fit. Perfect for casual outings or beach days, these sandals offer both practicality and style.', 0),
(74, 'Sandal', 1, 15, 23, 'Sandal 2.jpeg', 'Casual wear', 'This men’s sandal features an open-toe design with adjustable straps for a customizable fit. Ideal for warm weather, it combines comfort and durability, making it perfect for casual outings or relaxing at the beach.', 0),
(75, 'Sandal', 2, 16, 23, 'Women Sandal 1.jpeg', 'Casual wear', 'A women’s sandal designed for both style and comfort. With an open-toe design and adjustable straps, these sandals ensure a secure fit while adding a fashionable touch to any summer outfit. Perfect for casual wear or outdoor activities.', 0),
(76, 'Sandal', 2, 16, 23, 'Women Sandal 2.jpeg', 'Casual wear', 'This women sandal combines comfort with style, featuring an open-toe design and durable straps. Designed for casual outings or beach days, these sandals provide a breathable and comfortable fit, making them ideal for warmer weather.', 0),
(77, 'Boot', 1, 15, 24, 'Boot 1.jpeg', 'Casual wear', 'A men boot designed for durability and style. With sturdy construction and a rugged design, it offers both warmth and comfort during colder weather. The versatile style can be paired with both casual and semi-formal outfits.', 0),
(78, 'Boot', 1, 15, 24, 'Boot 2.jpeg', 'Casual wear', 'These men boots are built for both comfort and functionality. Featuring a strong, durable construction, they provide support and warmth, making them perfect for colder seasons or outdoor activities. Their rugged design also ensures versatility in various settings.', 0),
(79, 'Boot', 2, 16, 24, 'Women Boot 1.jpeg', 'Casual wear', 'A women’s boot designed for winter weather, providing warmth and a stylish look. Featuring a durable sole and soft interior lining, these boots are perfect for cold temperatures and outdoor activities, all while keeping you on trend.', 0),
(80, 'Boot', 2, 16, 24, 'Women Boot 2.jpeg', 'Casual wear', 'These women’s boots are perfect for keeping your feet warm while staying stylish. With a sturdy construction and comfortable lining, they’re ideal for outdoor adventures or everyday wear during colder months.', 0),
(81, 'Slipper', 1, 15, 25, 'Slipper 1.jpeg', 'Casual wear', 'A men’s slipper made from soft, cozy material, perfect for wearing around the house. The comfortable design provides warmth and relaxation, making them ideal for lounging or relaxing after a long day. Perfect for colder seasons.', 0),
(82, 'Slipper', 1, 15, 25, 'Slipper 2.jpeg', 'Casual wear', 'These men’s slippers are designed for comfort, with a soft lining that keeps your feet warm. Ideal for indoor wear, they are perfect for relaxing at home or after a busy day. The snug fit ensures comfort all day long.', 0),
(83, 'Slipper', 2, 16, 25, 'Women Slipper 1.jpeg', 'Casual wear', 'A women’s slipper offering a cozy, soft feel for your feet. Designed for indoor use, these slippers are perfect for relaxing at home during colder months. The plush material provides comfort, making them an ideal choice for loungewear.', 0),
(84, 'Slipper', 2, 16, 25, 'Women Slipper 2.jpeg', 'Casual wear', 'These women’s slippers are made from soft, insulating material to keep your feet warm and cozy. Ideal for wearing indoors, they offer both comfort and style, making them the perfect accessory for home relaxation.', 0),
(85, 'Formal shoe', 1, 15, 26, 'Formal shoe 1.jpeg', 'Casual wear', 'A men’s formal shoe crafted from premium leather, offering both style and comfort for formal occasions. The sleek design with polished detailing ensures a sophisticated look, making them perfect for business events or evening gatherings.', 0),
(86, 'Formal shoe', 1, 15, 26, 'Formal shoe 2.jpeg', 'Casual wear', 'These men’s formal shoes are designed to provide both comfort and elegance. Made from high-quality leather, they feature a classic design that pairs well with any formal attire, ensuring a polished and professional appearance.', 0),
(87, 'Formal shoe', 2, 16, 26, 'Women Formal shoe 1.jpeg', 'Casual wear', 'A women’s formal shoe featuring a stylish design and high-quality materials. With a sleek silhouette and comfortable fit, these shoes are perfect for business meetings, formal events, or evening occasions, offering both fashion and function.', 0),
(88, 'Formal shoe', 2, 16, 26, 'Women Formal shoe 2.jpeg', 'Casual wear', 'These women’s formal shoes combine elegance with comfort, made from soft leather with a sophisticated design. They are ideal for office wear or special occasions, providing a sleek and professional look.', 0),
(89, 'Hat', 1, 17, 27, 'Hat 1.jpeg', 'casual wear', 'A men’s hat made from durable material, providing both style and protection from the sun. The classic design complements casual or semi-formal attire, making it a versatile accessory for various occasions.', 0),
(90, 'Hat', 1, 17, 27, 'Hat 2.jpeg', 'casual wear', 'This men hat offers a timeless design that adds a touch of sophistication to any outfit. Made with breathable fabric, it provides comfort and style, perfect for casual outings or sunny days.', 0),
(91, 'Hat', 2, 18, 27, 'Women Hat 1.jpeg', 'casual wear', 'A women’s hat designed to add a chic touch to your look. Featuring a stylish, wide-brimmed design, it provides sun protection while making a bold fashion statement. Ideal for summer outings or adding a flair to your casual wear.', 0),
(92, 'Hat', 2, 18, 27, 'Women Hat 2.jpeg', 'casual wear', 'This women’s hat offers both fashion and function. With a stylish design and sun protection, it’s perfect for warm weather. The versatile style pairs well with various outfits, from casual looks to more polished summer attire.', 0),
(93, 'Bag', 1, 17, 28, 'Bag 1.jpeg', 'casual wear', 'A men’s belt crafted from high-quality leather, offering both durability and style. With a simple, sleek design, it’s perfect for pairing with jeans, trousers, or formal wear, adding a polished touch to your outfit.', 0),
(94, 'Bag', 1, 17, 28, 'Bag 2.jpeg', 'casual wear', 'This men’s belt features a timeless design with a durable leather finish. Perfect for both casual and formal outfits, it adds a touch of sophistication while providing practicality for everyday wear.', 0),
(95, 'Bag', 2, 18, 28, 'Women Bag 1.jpeg', 'casual wear', 'A women’s belt designed to add a chic touch to any outfit. Made from premium leather, it offers a sleek and elegant look, making it a perfect accessory for both casual and formal attire.', 0),
(96, 'Bag', 2, 18, 28, 'Women Bag 2.jpeg', 'casual wear', 'This women belt is both stylish and functional, featuring a durable leather material and a sleek design. Perfect for enhancing any outfit, it can be worn with dresses, skirts, or trousers for a polished, fashionable look.', 0),
(97, 'Necklace', 1, 17, 29, 'Jewelry 1.jpeg', 'casual wear', 'A men bag designed for everyday use, offering ample space for essentials. Made from high-quality material, it combines durability with style. The bag’s simple design makes it versatile enough for casual and semi-formal occasions.', 0),
(98, 'Ring', 1, 17, 29, 'Jewelry 2.jpeg', 'casual wear', 'This men bag is a practical yet stylish accessory, featuring a spacious interior and a sleek exterior. Ideal for work or casual outings, it provides plenty of room for essentials while maintaining a modern, polished look.', 0),
(99, 'Necklace', 2, 18, 29, 'Women Jewelry 1.jpeg', 'casual wear', 'A women bag made from premium materials, offering both style and functionality. With a spacious interior and elegant design, this bag is perfect for both work and leisure, complementing a variety of outfits.', 0),
(100, 'Ring', 2, 18, 29, 'Women Jewelry 2.jpeg', 'casual wear', 'This women bag features a classic, timeless design with a spacious interior to hold all your essentials. Ideal for everyday use, it combines practicality with a fashionable appearance, making it perfect for both casual and professional settings.', 0),
(101, 'Watch', 1, 17, 30, 'Watche 1.jpeg', 'casual wear', 'A stylish men wristwatch with a sleek design, perfect for both casual and formal occasions. The watch features a durable band and a polished finish, adding a sophisticated touch to any outfit. Its timeless appeal makes it a versatile accessory.', 0),
(102, 'Watch', 1, 17, 30, 'Watche 2.jpeg', 'casual wear', 'This men watch combines functionality and elegance, featuring a classic round dial with a sturdy strap. Its minimalist design allows it to seamlessly blend with both casual and formal wear. A perfect choice for daily use and special occasions.', 0),
(103, 'Watch', 2, 18, 30, 'Women Watche 1.jpeg', 'casual wear', 'A chic women watch, designed with precision and style, featuring a delicate dial and a comfortable strap. This watch complements any outfit, whether casual or more formal, and is ideal for women who appreciate subtle luxury in their accessories.', 0),
(104, 'Watch', 2, 18, 30, 'Women Watche 2.jpeg', 'casual wear', 'This women watch showcases a sophisticated design with a slim, elegant dial and a durable band. It’s perfect for any occasion, whether you re dressing up for a formal event or wearing it casually. A must-have accessory for modern women.', 0),
(105, 'Sunglass', 1, 17, 31, 'Sunglass 1.jpeg', 'casual wear', 'A men sunglasses design offering great protection from the sun while providing a bold, stylish look. These sunglasses are a perfect combination of comfort and style, ideal for outdoor activities or casual outings. The sleek design gives a sophisticated vibe.', 0),
(106, 'Sunglass', 1, 17, 31, 'Sunglass 2.jpeg', 'casual wear', 'These men sunglasses are perfect for those who want both functionality and fashion. With tinted lenses and a robust frame, they offer great UV protection and complement a variety of casual looks. They are a go-to accessory for the active, fashion-forward man.', 0),
(107, 'Sunglass', 2, 18, 31, 'Women Sunglass 1.jpeg', 'casual wear', 'Designed for women, these sunglasses offer a fashionable touch to your outdoor style while providing UV protection. With a chic frame and tinted lenses, these sunglasses pair well with both casual and semi-formal outfits. A versatile accessory that enhances any look.', 0),
(108, 'Sunglass', 2, 18, 31, 'Women Sunglass 2.jpeg', 'casual wear', 'These women sunglasses are designed to make a statement. Featuring an elegant frame and high-quality lenses, they offer comfort and protection from the sun rays. The stylish design makes them a great addition to casual or summer outfits.', 0),
(109, 'Wallet', 1, 17, 32, 'Wallet 1.jpeg', 'casual wear', 'A classic men wallet made from high-quality leather, offering ample space for cards and cash while maintaining a slim profile. This wallet combines functionality with style, making it the perfect accessory for any man who values practicality and elegance.', 0),
(110, 'Wallet', 1, 17, 32, 'Wallet 2.jpeg', 'casual wear', 'This men wallet features a minimalist design, with enough space for essentials without the bulk. The wallet durable leather construction ensures long-lasting use, and its sleek design makes it a stylish and practical accessory for everyday use.', 0),
(111, 'Wallet', 2, 18, 32, 'Women Wallet 1.jpeg', 'casual wear', 'A women wallet with a stylish, compact design, perfect for storing cards, cash, and other essentials. Made from premium materials, it offers both durability and elegance. Ideal for women who appreciate a chic, functional accessory.', 0),
(112, 'Wallet', 2, 18, 32, 'Women Wallet 2.jpeg', 'casual wear', 'This women wallet is the perfect blend of style and practicality. With multiple compartments for cards and cash, its ideal for keeping your essentials organized. The elegant design adds a sophisticated touch to any outfit, making it a must-have accessory for any woman.', 0),
(113, 'Formal Long Sleeve Shirt', 1, 19, 33, 'Formal shirt 1.jpeg', 'formal wear', NULL, 0),
(114, 'Formal Long Sleeve Shirt', 1, 19, 33, 'Formal shirt 2.jpeg', 'formal wear', NULL, 0),
(115, 'Formal Pants', 1, 21, 34, 'Formal Pants 1.jpeg', 'formal wear', NULL, 0),
(116, 'Formal Pants', 1, 21, 34, 'Formal Pants 2.jpeg', 'formal wear', NULL, 0),
(117, 'Long Sleeve Curved Hem Shirt', 2, 20, 33, 'Women Formal shirt 1.jpeg', 'formal wear', NULL, 0),
(118, 'Long Sleeve Curved Hem Shirt', 2, 20, 33, 'Women Formal shirt 2.jpeg', 'formal wear', NULL, 0),
(119, 'Formal Pants', 2, 22, 34, 'Women Formal Pants 1.jpeg', 'formal wear', NULL, 0),
(120, 'Formal Pants', 2, 22, 34, 'Women Formal Pants 2.jpeg', 'formal wear', NULL, 0),
(175, 'Men s Green Donegal Tweed 3 Piece Suit', 1, 10, 17, 'Men Suits 1.jpg', 'Casual wear', 'Crafted from premium Donegal tweed, this 3-piece suit combines timeless elegance with modern sophistication. Its rich green hue and textured finish make it perfect for weddings, formal events, or distinguished everyday wear. The tailored fit ensures comfort and a polished silhouette, while the included waistcoat adds versatility and charm.', 0),
(176, 'Rare Rabbit Men s Savyy Grey Polyester Viscose', 1, 10, 17, 'Mens Suits 2.jpg', 'Casual wear', 'Upgrade your wardrobe with the Rare Rabbit Men s Savvy Grey Suit, crafted from a premium polyester viscose blend. This sophisticated piece offers a perfect balance of comfort and style, making it an ideal choice for formal occasions or business wear.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `productdetails`
--

CREATE TABLE `productdetails` (
  `DetailID` int(11) NOT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `Size` varchar(50) DEFAULT NULL,
  `Color` varchar(50) DEFAULT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `PromotionPercentage` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productdetails`
--

INSERT INTO `productdetails` (`DetailID`, `ProductID`, `Size`, `Color`, `Quantity`, `Price`, `PromotionPercentage`) VALUES
(1, 1, 'M', 'Red', 100, 3500.00, 10),
(2, 1, 'L', 'Blue', 150, 3800.00, 10),
(3, 2, 'S', 'Green', 200, 3000.00, 10),
(4, 2, 'M', 'Black', 200, 3300.00, 10),
(5, 3, 'L', 'White', 80, 3200.00, 0),
(6, 3, 'XL', 'Grey', 120, 3500.00, 0),
(7, 4, 'S', 'Pink', 130, 3100.00, 0),
(8, 4, 'M', 'Yellow', 110, 3400.00, 0),
(9, 5, 'S', 'Purple', 60, 3300.00, 10),
(10, 5, 'M', 'Orange', 75, 3600.00, 10),
(11, 6, 'L', 'Red', 90, 3500.00, 10),
(12, 6, 'XL', 'Blue', 95, 3800.00, 10),
(13, 7, 'M', 'Brown', 140, 3400.00, 0),
(14, 7, 'L', 'Green', 160, 3700.00, 0),
(15, 8, 'S', 'Pink', 170, 3200.00, 0),
(16, 8, 'M', 'Black', 190, 3500.00, 0),
(17, 9, 'S', 'Blue', 100, 3300.00, 0),
(18, 9, 'M', 'White', 120, 3600.00, 0),
(19, 10, 'L', 'Purple', 150, 3800.00, 0),
(20, 10, 'XL', 'Grey', 180, 4000.00, 0),
(21, 11, 'S', 'Red', 200, 3600.00, 0),
(22, 11, 'M', 'Yellow', 200, 3900.00, 0),
(23, 12, 'L', 'Pink', 130, 3700.00, 0),
(24, 12, 'XL', 'Blue', 160, 4000.00, 0),
(25, 13, 'S', 'Green', 120, 3200.00, 0),
(26, 13, 'M', 'Black', 140, 3500.00, 0),
(27, 14, 'L', 'Grey', 180, 3300.00, 0),
(28, 14, 'XL', 'White', 160, 3600.00, 0),
(29, 15, 'S', 'Red', 200, 3400.00, 0),
(30, 15, 'M', 'Orange', 180, 3700.00, 0),
(31, 16, 'L', 'Purple', 200, 3800.00, 0),
(32, 16, 'XL', 'Yellow', 200, 4000.00, 0),
(33, 17, 'S', 'Pink', 200, 3200.00, 0),
(34, 17, 'M', 'Green', 200, 3400.00, 0),
(35, 18, 'L', 'Black', 200, 3500.00, 0),
(36, 18, 'XL', 'Grey', 200, 3800.00, 0),
(37, 19, 'S', 'Blue', 200, 3700.00, 0),
(38, 19, 'M', 'Yellow', 200, 3900.00, 0),
(39, 20, 'L', 'Red', 200, 4200.00, 0),
(40, 20, 'XL', 'Orange', 200, 4400.00, 0),
(41, 21, 'S', 'Purple', 100, 3600.00, 0),
(42, 21, 'M', 'White', 120, 3900.00, 0),
(43, 22, 'L', 'Pink', 150, 4200.00, 0),
(44, 22, 'XL', 'Black', 150, 4400.00, 0),
(45, 23, 'S', 'Yellow', 130, 3800.00, 0),
(46, 23, 'M', 'Blue', 140, 4000.00, 0),
(47, 24, 'L', 'Grey', 160, 4200.00, 0),
(48, 24, 'XL', 'Red', 160, 4400.00, 0),
(49, 25, 'S', 'Green', 200, 3500.00, 0),
(50, 25, 'M', 'Pink', 200, 3800.00, 0),
(51, 26, 'L', 'Black', 200, 4100.00, 0),
(52, 26, 'XL', 'Orange', 200, 4300.00, 0),
(53, 27, 'S', 'Blue', 150, 3400.00, 0),
(54, 27, 'M', 'Purple', 150, 3700.00, 0),
(55, 28, 'L', 'White', 190, 4200.00, 0),
(56, 28, 'XL', 'Yellow', 190, 4400.00, 0),
(57, 29, 'S', 'Pink', 200, 3300.00, 0),
(58, 29, 'M', 'Green', 200, 3600.00, 0),
(59, 30, 'L', 'Red', 200, 3800.00, 0),
(60, 30, 'XL', 'Blue', 200, 4100.00, 0),
(61, 31, 'S', 'Yellow', 200, 3500.00, 0),
(62, 31, 'M', 'Black', 200, 3600.00, 0),
(63, 32, 'L', 'Pink', 200, 3800.00, 0),
(64, 32, 'XL', 'Green', 200, 3900.00, 0),
(65, 33, 'S', 'Red', 200, 3700.00, 0),
(66, 33, 'M', 'Blue', 200, 3800.00, 0),
(67, 34, 'L', 'Green', 200, 4000.00, 0),
(68, 34, 'XL', 'White', 200, 4200.00, 0),
(69, 35, 'S', 'Black', 200, 3900.00, 0),
(70, 35, 'M', 'Yellow', 200, 4100.00, 0),
(71, 36, 'L', 'Red', 200, 4300.00, 0),
(72, 36, 'XL', 'Purple', 200, 4500.00, 0),
(73, 37, 'S', 'Pink', 200, 3500.00, 0),
(74, 37, 'M', 'Blue', 200, 3800.00, 0),
(75, 38, 'L', 'White', 200, 4000.00, 0),
(76, 38, 'XL', 'Yellow', 200, 4200.00, 0),
(77, 39, 'S', 'Black', 200, 4100.00, 0),
(78, 39, 'M', 'Green', 200, 4300.00, 0),
(79, 40, 'L', 'Purple', 200, 4400.00, 0),
(80, 40, 'XL', 'Red', 200, 4500.00, 0),
(81, 41, 'S', 'Blue', 200, 3800.00, 0),
(82, 41, 'M', 'Pink', 200, 4100.00, 0),
(83, 42, 'L', 'Green', 200, 4400.00, 0),
(84, 42, 'XL', 'Black', 200, 4500.00, 0),
(85, 43, 'S', 'Yellow', 200, 3700.00, 0),
(86, 43, 'M', 'Purple', 200, 3900.00, 0),
(87, 44, 'L', 'Blue', 200, 4100.00, 0),
(88, 44, 'XL', 'White', 200, 4200.00, 0),
(89, 45, 'S', 'Red', 200, 4000.00, 0),
(90, 45, 'M', 'Yellow', 200, 4200.00, 0),
(91, 46, 'L', 'Pink', 200, 4400.00, 0),
(92, 46, 'XL', 'Green', 200, 4500.00, 0),
(93, 47, 'S', 'Black', 200, 4300.00, 0),
(94, 47, 'M', 'Blue', 200, 4500.00, 0),
(95, 48, 'L', 'Red', 200, 4700.00, 0),
(96, 48, 'XL', 'Yellow', 200, 4900.00, 0),
(97, 49, 'S', 'Pink', 200, 3800.00, 0),
(98, 50, 'S', 'Red', 200, 3500.00, 0),
(99, 51, 'S', 'White', 200, 3300.00, 0),
(100, 52, 'L', 'Yellow', 200, 3600.00, 0),
(101, 53, 'S', 'Blue', 200, 3400.00, 0),
(102, 54, 'XL', 'Red', 200, 3800.00, 0),
(103, 55, 'M', 'Orange', 200, 3900.00, 0),
(104, 56, 'L', 'Green', 200, 4000.00, 0),
(105, 57, 'M', 'Purple', 200, 3500.00, 0),
(106, 58, 'L', 'Black', 200, 3700.00, 0),
(107, 59, 'XL', 'Yellow', 200, 4200.00, 0),
(108, 60, 'M', 'Grey', 200, 3800.00, 0),
(109, 61, 'S', 'Blue', 200, 3300.00, 0),
(110, 62, 'M', 'Pink', 200, 3400.00, 0),
(111, 63, 'L', 'White', 200, 3800.00, 0),
(112, 64, 'XL', 'Black', 200, 4100.00, 0),
(113, 65, 'S', 'Red', 200, 3700.00, 0),
(114, 66, 'M', 'Yellow', 200, 3900.00, 0),
(115, 67, 'L', 'Green', 200, 4100.00, 0),
(116, 68, 'XL', 'Pink', 200, 4300.00, 0),
(117, 69, 'S', 'Purple', 200, 3500.00, 0),
(118, 70, 'L', 'Orange', 200, 4200.00, 0),
(119, 71, 'M', 'Blue', 200, 3800.00, 0),
(120, 72, 'XL', 'Red', 200, 4400.00, 0),
(121, 73, 'S', 'Green', 200, 3300.00, 0),
(122, 74, 'M', 'Black', 200, 3500.00, 0),
(123, 75, 'L', 'Grey', 200, 3800.00, 0),
(124, 76, 'XL', 'Yellow', 200, 4200.00, 0),
(125, 77, 'S', 'Purple', 200, 3400.00, 0),
(126, 78, 'M', 'Blue', 200, 3600.00, 0),
(127, 79, 'L', 'Pink', 200, 3900.00, 0),
(128, 80, 'XL', 'Orange', 200, 4200.00, 0),
(129, 81, 'S', 'Yellow', 200, 3300.00, 0),
(130, 82, 'M', 'Red', 200, 3500.00, 0),
(131, 83, 'L', 'Purple', 200, 3800.00, 0),
(132, 84, 'XL', 'Blue', 200, 4000.00, 0),
(133, 85, 'S', 'Black', 200, 3400.00, 0),
(134, 86, 'M', 'Green', 200, 3700.00, 0),
(135, 87, 'L', 'Grey', 200, 3900.00, 0),
(136, 88, 'XL', 'Pink', 200, 4200.00, 0),
(161, 89, '', 'Black', 20, 5500.00, 0),
(162, 90, '', 'White', 20, 5000.00, 0),
(163, 91, '', 'Blue', 20, 4800.00, 0),
(164, 92, '', 'White', 20, 5200.00, 0),
(165, 93, '', 'Black', 20, 5400.00, 0),
(166, 94, '', 'Brown', 20, 4700.00, 0),
(167, 95, '', 'White', 20, 5100.00, 0),
(168, 96, '', 'Blue', 20, 5300.00, 0),
(169, 97, '', 'Gold', 20, 6000.00, 0),
(170, 98, '', 'Silver', 20, 5700.00, 0),
(171, 99, '', 'Gold', 20, 5900.00, 0),
(172, 100, '', 'Gold', 20, 6500.00, 0),
(173, 101, '', 'Black', 20, 5600.00, 0),
(174, 102, '', 'Brown', 20, 4800.00, 0),
(175, 103, '', 'Gold', 20, 6200.00, 0),
(176, 104, '', 'Black', 20, 5400.00, 0),
(177, 105, '', 'Black', 20, 5300.00, 0),
(178, 106, '', 'Black', 20, 5100.00, 0),
(179, 107, '', 'Rose Gold', 20, 6500.00, 0),
(180, 108, '', 'Black', 20, 5500.00, 0),
(181, 109, '', 'Black', 20, 5600.00, 0),
(182, 110, '', 'Black', 20, 5300.00, 0),
(183, 111, '', 'Silver', 20, 5900.00, 0),
(184, 112, '', 'White', 20, 5100.00, 0),
(201, 113, 'M', 'White', 120, 6000.00, 0),
(202, 113, 'L', 'Blue', 100, 6200.00, 0),
(203, 114, 'S', 'Black', 80, 5900.00, 0),
(204, 114, 'XL', 'Grey', 90, 6300.00, 0),
(205, 115, 'L', 'Navy', 150, 7000.00, 0),
(206, 115, 'M', 'Charcoal', 170, 7200.00, 0),
(207, 116, 'S', 'Beige', 200, 7500.00, 0),
(208, 116, 'XL', 'Black', 110, 6800.00, 0),
(209, 117, 'S', 'Pink', 130, 5100.00, 0),
(210, 117, 'M', 'White', 150, 5400.00, 0),
(211, 118, 'L', 'Blue', 140, 5600.00, 0),
(212, 118, 'XL', 'Black', 160, 5800.00, 0),
(213, 119, 'M', 'Grey', 200, 6000.00, 0),
(214, 119, 'S', 'Navy', 220, 6300.00, 0),
(215, 120, 'L', 'Charcoal', 170, 7000.00, 0),
(216, 120, 'XL', 'Black', 130, 6500.00, 0),
(217, 175, 'M', 'Green', 25, 24500.00, 0),
(218, 175, 'L', 'Navy Blue', 12, 28000.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_details`
--

CREATE TABLE `shipping_details` (
  `id` int(11) NOT NULL,
  `grand_total` decimal(10,2) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `payment_method` enum('card','cod') DEFAULT NULL,
  `card_name` varchar(255) DEFAULT NULL,
  `card_number` varchar(20) DEFAULT NULL,
  `expiry_date` varchar(7) DEFAULT NULL,
  `cvv` varchar(3) DEFAULT NULL,
  `OrderID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipping_details`
--

INSERT INTO `shipping_details` (`id`, `grand_total`, `full_name`, `address`, `phone`, `email`, `city`, `postal_code`, `country`, `payment_method`, `card_name`, `card_number`, `expiry_date`, `cvv`, `OrderID`) VALUES
(1, 0.00, 'Tharini Rehansa Rajapaksha', '8 canal economic center road Dambulla', '+94771740070', '123.rehansa@gmail.com', 'Dambulla', '21100', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '4442 1300 0315 1', '0000-00', '558', NULL),
(2, 0.00, 'Tharini Rehansa Rajapaksha', '8 canal economic center road dambulla', '+94771740070', '123.rehansa@gmail.com', 'Dambulla', '21100', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '4424 1300 5489 7', '0000-00', '456', NULL),
(3, 37170.00, 'Ajith Rajapaksha ', '8 canal economic center road dambulla', '+94771740070', '123.rehansa@gmail.com', 'Dambulla', '21100', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '4424 1300 7855 2', '0000-00', '741', NULL),
(4, 37170.00, 'Tharini Rajapaksha', '8 canal economic center road dambulla', '+94779970602', '123.rehansa@gmail.com', 'Dambulla', '21100', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '4424 1546 4611 3', NULL, '963', NULL),
(5, 37170.00, 'Tharini Rajapaksha', '8 canal economic center road dambulla', '+94779970602', '123.rehansa@gmail.com', 'Dambulla', '21100', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '4424 1546 4611 3', NULL, '963', NULL),
(6, 37170.00, 'Tharini Rehansa Rajapaksha', '8 canal economic center road dambulla', '+94771740070', '123.rehansa@gmail.com', 'Dambulla', '21100', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '4442 1355 4762 6', '2026-10', '741', NULL),
(7, 0.00, 'Tharini Rehansa Rajapaksha', '8 canal economic center road dambulla', '+94771740070', '123.rehansa@gmail.com', 'Dambulla', '21100', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '4424 1549 8732 1', '2028-04', '159', NULL),
(8, 0.00, 'Tharini Rajapaksha', '7 hills, sirimal waththa road colombo 04', '+94779970602', '123.rehansa@gmail.com', 'Kandy', '21100', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '4412 6569 5631 6', '2028-08', '357', NULL),
(9, 0.00, 'Tharini Rajapaksha', '7 hill road Colombo 04', '+94771740070', '123.rehansa@gmail.com', 'Colombo', '22000', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '5456 5426 9565 4', '2026-07', '654', NULL),
(10, 0.00, 'Tharini Rehansa Rajapaksha', '7 hill colombo 07', '+94771740070', '123.rehansa@gmail.com', 'Colombo', '22000', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '9854 6958 2695 4', '2027-10', '852', NULL),
(11, 0.00, 'Tharini Rehansa Rajapaksha', '7 hills colombo 04', '+94771740070', '123.rehansa@gmail.com', 'Colombo', '22000', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '9874 2698 5426 5', '2027-03', '741', NULL),
(12, 0.00, 'Tharini Rehansa Rajapaksha', 'eco park center road matale', '+94771740070', '123.rehansa@gmail.com', 'Matale', '22000', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '9523 6542 3652 6', '2027-08', '753', NULL),
(13, 0.00, 'Tharini Rehansa Rajapaksha', 'eco park center road matale', '+94771740070', '123.rehansa@gmail.com', 'Matale', '22000', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '9523 6542 3652 6', '2027-08', '753', NULL),
(14, 0.00, 'Tharini Rajapaksha', 'Sirimal waththa colombo 004', '+94771740070', '123.rehansa@gmail.com', 'Colombo', '22000', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '8451 6984 1265 8', '2027-05', '456', NULL),
(15, 0.00, 'Tharini Rajapaksha', 'sirimal waththa road colombo 004', '+94771740070', '123.rehansa@gmail.com', 'Colombo', '22000', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '9584 1526 5841 2', '2027-03', '741', NULL),
(16, 0.00, 'Tharini Rehansa Rajapaksha', '8 canal eco colombo', '+94771740070', '123.rehansa@gmail.com', 'Colombo', '22000', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '9584 1236 5123 6', '2027-03', '741', NULL),
(17, 0.00, 'Tharini Rehansa Rajapaksha', 'colombo', '+94771740070', '123.rehansa@gmail.com', 'Colombo', '22000', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '9584 5265 8412 6', '2028-05', '741', NULL),
(18, 0.00, 'Tharini Rehansa Rajapaksha', 'kandy', '+94771740070', '123.rehansa@gmail.com', 'Kandy', '23000', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '8452 3684 1256 4', '2025-07', '741', NULL),
(19, 0.00, 'Tharini Rajapaksha', 'kandy', '+94771740070', '123.rehansa@gmail.com', 'kandy', '23000', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '5845 1236 5412 6', '2026-06', '741', NULL),
(20, 0.00, 'Tharini Rajapaksha', 'kandy', '+94771740070', '123.rehansa@gmail.com', 'kandy', '23000', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '5412 6953 6523 6', '2026-09', '741', NULL),
(21, 0.00, 'Tharini Rajapaksha', 'kandy', '+94771740070', '123.rehansa@gmail.com', 'kandy', '23000', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '4184 8648 5416 2', '2026-03', '741', NULL),
(22, 0.00, 'Tharini Rajapaksha', 'kandy', '+94771740070', '123.rehansa@gmail.com', 'kandy', '21100', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '8767853524524525', '2024-07', '741', NULL),
(23, 0.00, 'Tharini Rajapaksha', 'Kandy', '+94771740070', '123.rehansa@gmail.com', 'kandy', '22000', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '4598 4656 2656 1', '2026-02', '741', NULL),
(24, 0.00, 'Tharini Rajapaksha', '8 Canal economic center road dambulla', '+94771740070', '123.rehansa@gmail.com', 'Dambulla', '21100', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '5845 2654 2365 2', '2026-06', '741', NULL),
(25, 0.00, 'Tharini Rajapaksha', '8 Canal economic center road dambulla', '+94741302860', '123.rehansa@gmail.com', 'Dambulla', '22000', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '5415 4582 6542 6', '2026-06', '741', NULL),
(26, 0.00, 'Tharini Rajapaksha', '8 canal economic center road dambulla', '+94771740070', '123.rehansa@gmail.com', 'Dambulla', '21100', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '9845 2659 8426 9', '2026-06', '741', NULL),
(27, 0.00, 'Tharini Rajapaksha', '8 canal economic center road dambulla', '+94771740070', '123.rehansa@gmail.com', 'Dambulla', '21100', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '7426 4846 2641 4', '2026-07', '741', NULL),
(28, 0.00, 'Tharini Rajapaksha', '8 canal', '+94741302860', '123.rehansa@gmail.com', 'Kandy', '21100', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '8954 6958 4695 8', '2027-10', '741', NULL),
(29, 0.00, 'Tharini Rehansa Rajapaksha', '8 canal', '+94771740070', '123.rehansa@gmail.com', 'kandy', '21100', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '5365 2365 2365 2', '2025-06', '741', NULL),
(30, 0.00, 'Tharini Rajapaksha', '8 canal \\r\\n', '+94771740070', '123.rehansa@gmail.com', 'Dambulla', '21100', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '8451 6952 3541 3', '2025-11', '741', NULL),
(31, 0.00, 'Tharini Rajapaksha', '8 canal', '+94771740070', '123.rehansa@gmail.com', 'kandy', '21100', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '5126 5841 2658 4', '2026-03', '741', NULL),
(32, 0.00, 'Tharini Rajapaksha', '8 canal', '+94771740070', '123.rehansa@gmail.com', 'kandy', '21100', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '8456 9854 2658 4', '2025-10', '741', NULL),
(33, 0.00, 'Tharini Rajapaksha', '8 canal', '+94741302860', '123.rehansa@gmail.com', 'Dambulla', '21100', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '6857 4258 9654 1', '2024-06', '741', NULL),
(34, 0.00, 'Tharini Rajapaksha', '8 canal', '+94771740070', '123.rehansa@gmail.com', 'Dambulla', '21100', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '5845 6952 6541 2', '2024-10', '741', NULL),
(35, 0.00, 'Tharini Rajapaksha', '8 canal', '+94771740070', '123.rehansa@gmail.com', 'kandy', '21100', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '9852 6592 3523 6', '2024-10', '741', NULL),
(36, 0.00, 'Tharini Rajapaksha', '8 canal', '+94771740070', '123.rehansa@gmail.com', 'kandy', '21100', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '7826 5415 1521 2', '2024-11', '741', NULL),
(37, 0.00, 'Tharini Rajapaksha', '8 canal', '+94771740070', '123.rehansa@gmail.com', 'Dambulla', '21100', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '8451 2516 5165 2', '2024-11', '741', NULL),
(38, 0.00, 'Tharini Rajapaksha', '8 canal eco', '+94771740070', '123.rehansa@gmail.com', 'kandy', '22000', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '4854 1652 1515 1', '2024-11', '741', NULL),
(39, 0.00, 'Anna', '7 hill rose street Sydney Australia', '+94779970602', 'Anna@gmail.com', 'Sydney', '2340', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '5874 5695 2365 8', '2027-06', '741', NULL),
(40, 0.00, 'Anna Watson', '7 hills', '+94771740070', 'Anna@gmail.com', 'Sydney', '2340', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '8415 2658 4658 4', '2025-06', '741', NULL),
(41, 0.00, 'Anna Watson', '8 canal', '+94771740070', '123.rehansa@gmail.com', 'Dambulla', '22000', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '8456 9845 6584 1', '2026-10', '741', NULL),
(42, 0.00, 'Anna Watson', '7 hills ', '+94771740070', 'Anna@gmail.com', 'kandy', '22000', 'Sri Lanka', 'card', 'Anna Watson', '8456 9542 6356 5', '2026-06', '741', NULL),
(43, 0.00, 'Tharini Rehansa Rajapaksha', '8 canal', '+94771740070', '123.rehansa@gmail.com', 'Dambulla', '21100', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '8456 9586 9586 9', '2025-06', '741', NULL),
(44, 0.00, 'Tharini Rajapaksha', '356/5 rajakiya widiya colombo 004', '+94771740070', '123.rehansa@gmail.com', 'Colombo', '21100', 'Sri Lanka', 'card', 'Tharini Rajapaksha', '5984 1265 4126 5', '2027-06', '741', 21);

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `CartID` int(11) NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `Quantity` int(11) NOT NULL DEFAULT 1,
  `Price` decimal(10,2) NOT NULL,
  `TotalPrice` decimal(10,2) GENERATED ALWAYS AS (`Quantity` * `Price`) VIRTUAL,
  `DateAdded` timestamp NOT NULL DEFAULT current_timestamp(),
  `Size` varchar(255) DEFAULT NULL,
  `Color` varchar(255) DEFAULT NULL,
  `PromotionPercentage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `SubCategoryID` int(11) NOT NULL,
  `SubCategoryName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`SubCategoryID`, `SubCategoryName`) VALUES
(1, 'T-shirt'),
(2, 'Blouse'),
(3, 'Shirt'),
(4, 'Sweater'),
(5, 'Tank top'),
(6, 'Jeans'),
(7, 'Skirt'),
(8, 'Shorts'),
(9, 'Trousers'),
(10, 'Leggings'),
(11, 'Dress'),
(12, 'Jacket'),
(13, 'Coat'),
(14, 'Blazer'),
(15, 'Cardigan'),
(16, 'Tracksuit'),
(17, 'Suits'),
(18, 'Pajama'),
(19, 'Bra'),
(20, 'Panties'),
(21, 'Underwears'),
(22, 'Sneaker'),
(23, 'Sandal'),
(24, 'Boot'),
(25, 'Slipper'),
(26, 'Formal shoe'),
(27, 'Hat'),
(28, 'Bag'),
(29, 'Jewelry'),
(30, 'Watches'),
(31, 'Sunglasses'),
(32, 'Wallets'),
(33, 'Formal Shirt'),
(34, 'Formal Pants');

-- --------------------------------------------------------

--
-- Table structure for table `track_order`
--

CREATE TABLE `track_order` (
  `TrackOrderID` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `TotalPrice` decimal(10,2) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `OrderDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `Status` varchar(50) NOT NULL,
  `ExpectedDelivery` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `track_order`
--

INSERT INTO `track_order` (`TrackOrderID`, `ProductName`, `Quantity`, `Price`, `TotalPrice`, `Email`, `OrderDate`, `Status`, `ExpectedDelivery`) VALUES
(1, 'Long Sleeve Curved Hem Shirt', 1, 5600.00, 5600.00, '123.rehansa@gmail.com', '2024-12-27 13:00:55', 'Shipped', '2025-01-03'),
(2, 'Rad Graphic Tshirt', 1, 3150.00, 3150.00, '123.rehansa@gmail.com', '2024-12-27 13:04:36', 'Pending', '2025-01-03'),
(3, 'Polo T-Shirt', 1, 2700.00, 2700.00, '123.rehansa@gmail.com', '2024-12-27 13:09:43', 'Pending', '2025-01-03'),
(4, 'Hat', 1, 5200.00, 5200.00, '123.rehansa@gmail.com', '2024-12-27 13:29:28', 'Pending', '2025-01-03'),
(8, 'Check Designed Pant', 1, 3400.00, 3400.00, 'Anna@gmail.com', '2024-12-28 05:35:05', 'Pending', '2025-01-04'),
(9, 'Woollen Sweaters', 1, 3800.00, 3800.00, 'Anna@gmail.com', '2024-12-28 05:35:05', 'Pending', '2025-01-04'),
(10, 'Formal Pants', 1, 6000.00, 6000.00, 'Anna@gmail.com', '2024-12-29 04:24:34', 'Pending', '2025-01-05'),
(11, 'Wallet', 1, 5100.00, 5100.00, 'Anna@gmail.com', '2024-12-29 04:24:34', 'Pending', '2025-01-05'),
(12, 'Long Coat', 1, 3800.00, 3800.00, '123.rehansa@gmail.com', '2024-12-29 06:02:39', 'Pending', '2025-01-05'),
(13, 'Flared Knee Length Skirt', 1, 3800.00, 3800.00, '123.rehansa@gmail.com', '2024-12-29 06:02:39', 'Pending', '2025-01-05'),
(14, 'Shawl Collar Blazer', 1, 3800.00, 3800.00, '123.rehansa@gmail.com', '2024-12-29 06:02:39', 'Pending', '2025-01-05'),
(15, 'Sleeve Belted Midi Cutlon Dress', 1, 4100.00, 4100.00, '123.rehansa@gmail.com', '2024-12-29 06:02:39', 'Pending', '2025-01-05'),
(16, 'Boot', 1, 4200.00, 4200.00, '123.rehansa@gmail.com', '2024-12-29 06:02:39', 'Pending', '2025-01-05'),
(17, 'Hat', 1, 4800.00, 4800.00, '123.rehansa@gmail.com', '2024-12-29 06:02:39', 'Pending', '2025-01-05'),
(18, 'Sunglass', 1, 5100.00, 5100.00, '123.rehansa@gmail.com', '2024-12-29 06:02:39', 'Pending', '2025-01-05'),
(19, 'Men s Green Donegal Tweed 3 Piece Suit', 1, 24500.00, 24500.00, '123.rehansa@gmail.com', '2024-12-30 04:52:16', 'Pending', '2025-01-06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminregister`
--
ALTER TABLE `adminregister`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`),
  ADD KEY `GenderID` (`GenderID`);

--
-- Indexes for table `categorysubcategory`
--
ALTER TABLE `categorysubcategory`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SubCategoryID` (`SubCategoryID`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customerregister`
--
ALTER TABLE `customerregister`
  ADD PRIMARY KEY (`CustomerID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`GenderID`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`InvoiceID`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `GenderID` (`GenderID`),
  ADD KEY `CategoryID` (`CategoryID`),
  ADD KEY `SubCategoryID` (`SubCategoryID`);

--
-- Indexes for table `productdetails`
--
ALTER TABLE `productdetails`
  ADD PRIMARY KEY (`DetailID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `shipping_details`
--
ALTER TABLE `shipping_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`CartID`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`SubCategoryID`);

--
-- Indexes for table `track_order`
--
ALTER TABLE `track_order`
  ADD PRIMARY KEY (`TrackOrderID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminregister`
--
ALTER TABLE `adminregister`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `categorysubcategory`
--
ALTER TABLE `categorysubcategory`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customerregister`
--
ALTER TABLE `customerregister`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_details`
--
ALTER TABLE `customer_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `GenderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `InvoiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `productdetails`
--
ALTER TABLE `productdetails`
  MODIFY `DetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT for table `shipping_details`
--
ALTER TABLE `shipping_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  MODIFY `CartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `SubCategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `track_order`
--
ALTER TABLE `track_order`
  MODIFY `TrackOrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`GenderID`) REFERENCES `gender` (`GenderID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`GenderID`) REFERENCES `gender` (`GenderID`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`),
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`SubCategoryID`) REFERENCES `subcategory` (`SubCategoryID`);

--
-- Constraints for table `productdetails`
--
ALTER TABLE `productdetails`
  ADD CONSTRAINT `productdetails_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
