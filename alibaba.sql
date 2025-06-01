-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2025 at 11:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alibaba`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `ban_id` int(11) DEFAULT NULL,
  `ban_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `ban_id`, `ban_image`) VALUES
(1, 1, 'upload_image/WhatsApp Image 2025-05-01 at 03.12.23_8bc02355.jpg'),
(2, 1, 'upload_image/WhatsApp Image 2025-05-01 at 02.54.19_0f05c3df.jpg'),
(3, 2, 'upload_image/WhatsApp Image 2025-05-01 at 02.54.19_0f05c3df.jpg'),
(4, 3, 'upload_image/WhatsApp Image 2025-05-01 at 03.12.23_8bc02355.jpg'),
(5, 3, 'upload_image/WhatsApp Image 2025-05-01 at 02.54.18_b84109f4.jpg'),
(6, 4, 'upload_image/WhatsApp Image 2025-05-01 at 02.54.18_1c332e29.jpg'),
(7, 5, 'upload_image/WhatsApp Image 2025-05-01 at 02.54.17_344be1ef.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `product_id` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `title`, `image`, `product_price`, `quantity`, `product_id`, `created_at`, `user_id`) VALUES
(10, 'Premium Classic Cotton Shirt for Timeless Comfort', 'upload_image/pexels-dhanno-19248046.jpg', 2500.00, 1, '1', '2025-05-23 21:52:17', 3),
(21, 'Premium Classic Cotton Shirt for Timeless Comfort', 'upload_image/pexels-dhanno-19248046.jpg', 2500.00, 6, '1', '2025-05-23 22:00:44', 5),
(22, 'Womens Elegant Floral Printed Maxi Dress – Perfect for Casual Outings & Summer Events', 'upload_image/pexels-dhanno-20516290.jpg', 3000.00, 2, '10', '2025-05-25 02:27:51', 6),
(23, 'Unisex Oversized Winter Hoodie – Fleece-Lined Comfort for Cold Weather Style', 'upload_image/pexels-dhanno-31874438.jpg', 5000.00, 3, '14', '2025-05-25 02:28:09', 6),
(24, 'Premium Classic Cotton Shirt for Timeless Comfort', 'upload_image/pexels-dhanno-19248046.jpg', 2500.00, 4, '1', '2025-05-31 16:23:17', 10),
(25, 'Classic Blue Denim Jeans for Women – High Waist Stretch Fit for All-Day Comfort', 'upload_image/pexels-dhanno-31874438.jpg', 5000.00, 1, '11', '2025-05-31 16:33:39', 10);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `cat_image` varchar(255) NOT NULL,
  `cat_heading` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `cat_image`, `cat_heading`) VALUES
(1, 'upload_image/pexels-dhanno-19221331.jpg', 'Lawn'),
(2, 'upload_image/pexels-dhanno-19248046.jpg', 'Embroidred'),
(3, 'upload_image/pexels-dhanno-19401518.jpg', 'Printed'),
(4, 'upload_image/pexels-dhanno-19401523.jpg', 'Winter');

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `checkout_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email_address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`checkout_id`, `firstname`, `lastname`, `country`, `street_address`, `city`, `phone`, `email_address`) VALUES
(1, 'aliza', 'fatima', 'Pakistan', 'p/o saleema abad , Qumber sha Tehsil Jampur', 'Qumber shah', '12345678901', 'email_address'),
(2, 'aliza', 'fatima', 'pakistan', 'p/o saleema abad , Qumber sha Tehsil Jampur', 'Qumber shah', '12345678901', 'email_address'),
(3, 'urwa', 'fatima', 'Pakistan', 'p/o saleema abad , Qumber sha Tehsil Jampur', 'Qumber shah', '12345678901', 'email_address'),
(4, 'aliza', 'fatima', 'Pakistan', 'p/o saleema abad , Qumber sha Tehsil Jampur', 'Qumber shah', '12345678901', 'email_address'),
(5, 'aliza', 'fatima', 'Pakistan', 'p/o saleema abad , Qumber sha Tehsil Jampur', 'Qumber shah', '12345678901', 'email_address'),
(6, 'check', 'accuracy', 'Pakistan', 'p/o saleema abad , Qumber sha Tehsil Jampur', 'Qumber shah', '12345678901', 'email_address'),
(7, 'aliza', 'fatima', 'Pakistan', 'p/o saleema abad , Qumber sha Tehsil Jampur', 'Qumber shah', '12345678901', 'email_address'),
(8, 'Test', 'accuracy', 'Pakistan', 'p/o saleema abad , Qumber sha Tehsil Jampur', 'Qumber shah', '45678907655', 'email_address'),
(9, 'aliza', 'fatima', 'Pakistan', 'p/o saleema abad , Qumber sha Tehsil Jampur', 'Qumber shah', '12345678901', 'email_address'),
(10, 'urwa', 'fatima', 'Pakistan', 'p/o saleema abad , Qumber sha Tehsil Jampur', 'Qumber shah', '12345678901', 'email_address'),
(11, 'aliza', 'fatima', 'Pakistan', 'p/o saleema abad , Qumber sha Tehsil Jampur', 'Qumber shah', '12345678901', 'email_address');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email_address` varchar(150) NOT NULL,
  `item_title` varchar(150) NOT NULL,
  `item_image` varchar(255) DEFAULT NULL,
  `item_price` decimal(10,2) NOT NULL,
  `item_quantity` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_title` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_id`, `product_image`, `product_title`, `price`, `created_at`) VALUES
(1, '1', 'upload_image/pexels-dhanno-19221331.jpg', 'Alibaba – Unfolding Fashion, One Outfit at a Time', 2300.00, '2025-05-23 00:43:48'),
(2, '10', 'upload_image/pexels-dhanno-20516290.jpg', 'Womens Elegant Floral Printed Maxi Dress – Perfect for Casual Outings & Summer Events', 3000.00, '2025-05-23 01:01:04'),
(3, '11', 'upload_image/pexels-dhanno-19248045.jpg', 'Classic Blue Denim Jeans for Women – High Waist Stretch Fit for All-Day Comfort', 2800.00, '2025-05-23 01:06:25'),
(4, '11', 'upload_image/pexels-dhanno-19221331.jpg', 'Classic Blue Denim Jeans for Women – High Waist Stretch Fit for All-Day Comfort', 40000.00, '2025-05-23 01:08:41'),
(5, '12', 'upload_image/pexels-dhanno-19401518.jpg', 'Classic Blue Denim Jeans for Women – High Waist Stretch Fit for All-Day Comfort', 5000.00, '2025-05-23 01:09:07'),
(6, '12', 'upload_image/pexels-dhanno-19248028.jpg', 'Classic Blue Denim Jeans for Women – High Waist Stretch Fit for All-Day Comfort', 50000.00, '2025-05-23 01:15:20'),
(7, '13', 'upload_image/pexels-dhanno-31874432.jpg', 'Unisex Oversized Winter Hoodie – Fleece-Lined Comfort for Cold Weather Style', 23000.00, '2025-05-23 01:25:58'),
(8, '14', 'upload_image/pexels-dhanno-19248046.jpg', 'Unisex Oversized Winter Hoodie – Fleece-Lined Comfort for Cold Weather Style', 6000.00, '2025-05-23 01:27:43');

-- --------------------------------------------------------

--
-- Table structure for table `products_details`
--

CREATE TABLE `products_details` (
  `id` int(11) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `final_price` decimal(10,2) NOT NULL,
  `expected_price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `main_image` varchar(255) DEFAULT NULL,
  `image1` varchar(255) DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `image3` varchar(255) DEFAULT NULL,
  `image4` varchar(255) DEFAULT NULL,
  `care_instruction` text DEFAULT NULL,
  `disclaimer` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_details`
--

INSERT INTO `products_details` (`id`, `product_id`, `title`, `description`, `final_price`, `expected_price`, `quantity`, `main_image`, `image1`, `image2`, `image3`, `image4`, `care_instruction`, `disclaimer`) VALUES
(1, '1', 'Premium Classic Cotton Shirt for Timeless Comfort', 'Experience unparalleled comfort and style with our Classic Cotton Shirt, crafted from 100% pure cotton for breathability and softness. Designed to fit perfectly for all-day wear, this shirt is your ideal companion for casual outings or smart-casual events. Its timeless design ensures you never go out of fashion, while the durable fabric guarantees long-lasting quality. Available in multiple colors to suit every personality.\r\n\r\n', 2500.00, 2200.00, 6, 'upload_image/pexels-dhanno-19248046.jpg', 'upload_image/pexels-dhanno-19401523.jpg', 'upload_image/pexels-dhanno-19401518.jpg', 'upload_image/pexels-dhanno-19221331.jpg', 'upload_image/light beige.png', 'Machine wash cold with like colors\r\n\r\nDo not bleach\r\n\r\nTumble dry low or hang to dry\r\n\r\nIron on low heat if needed', 'Colors may slightly vary due to monitor settings and lighting\r\n\r\nMinor variations in fabric or pattern may occur due to batch differences\r\n\r\nPlease check size chart carefully before ordering\r\n\r\nProduct images are for illustrative purposes only'),
(2, '10', 'Womens Elegant Floral Printed Maxi Dress – Perfect for Casual Outings & Summer Events', 'Crafted from 100% breathable cotton, this slim-fit t-shirt is designed for comfort and style. Perfect for daily wear or layering under jackets.Stay effortlessly elegant with our floral maxi dress. Made with lightweight fabric\r\n\r\n', 3000.00, 2800.00, 6, 'upload_image/pexels-dhanno-20516290.jpg', 'upload_image/pexels-dhanno-31323190.jpg', 'upload_image/pexels-dhanno-29699411.jpg', 'upload_image/pexels-dhanno-19248045.jpg', 'upload_image/pexels-dhanno-20420594.jpg', 'Do not bleach  \r\n• Tumble dry low or hang dry  \r\n• Iron on low heat if needed  \r\n• Do not dry clean unless specified  \r\n• Wash and dry inside out to preserve color and print', 'Dry clean recommended for best results  \r\n• Hand wash separately in cold water  \r\n• Do not soak for long periods '),
(3, '11', 'Classic Blue Denim Jeans for Women – High Waist Stretch Fit for All-Day Comfort', 'Crafted from 100% breathable cotton, this slim-fit t-shirt is designed for comfort and style. Perfect for daily wear or layering under jackets', 5000.00, 4500.00, 8, 'upload_image/pexels-dhanno-31874438.jpg', 'upload_image/pexels-dhanno-20420594.jpg', 'upload_image/pexels-dhanno-19292777.jpg', 'upload_image/pexels-dhanno-29699411.jpg', 'upload_image/pexels-dhanno-31323190.jpg', 'Machine wash cold with like colors  \r\n• Do not bleach  \r\n• Tumble dry low or hang dry  \r\n• Iron on low heat if needed  \r\n• Do not dry clean unless specified  ', 'Dry clean recommended for best results  \r\n• Hand wash separately in cold water  \r\n• Do not soak for long periods  \r\n• Iron on reverse side at low temperature  \r\n'),
(4, '14', 'Unisex Oversized Winter Hoodie – Fleece-Lined Comfort for Cold Weather Style', 'Crafted from 100% breathable cotton, this slim-fit t-shirt is designed for comfort and style. Perfect for daily wear or layering under jackets.', 5000.00, 4600.00, 5, 'upload_image/pexels-dhanno-31874438.jpg', 'upload_image/pexels-dhanno-25288420.jpg', 'upload_image/pexels-dhanno-19292777.jpg', 'upload_image/pexels-dhanno-20614170.jpg', 'upload_image/pexels-dhanno-29699411.jpg', 'Machine wash cold with like colors  \r\n• Do not bleach  \r\n• Tumble dry low or hang dry  \r\n• Iron on low heat if needed  \r\n• Do not dry clean unless specified  ', 'Machine wash cold with like colors  \r\n• Do not bleach  \r\n• Tumble dry low or hang dry  \r\n• Iron on low heat if needed  \r\n• Do not dry clean unless specified  '),
(5, '13', 'Unisex Oversized Winter Hoodie – Fleece-Lined Comfort for Cold Weather Style', 'Crafted from 100% breathable cotton, this slim-fit t-shirt is designed for comfort and style. Perfect for daily wear or layering under jackets.', 5000.00, 4600.00, 5, 'upload_image/pexels-dhanno-20420594.jpg', 'upload_image/pexels-dhanno-25288420.jpg', 'upload_image/pexels-dhanno-19248046.jpg', 'upload_image/pexels-dhanno-19401523.jpg', 'upload_image/pexels-dhanno-20614168.jpg', 'Machine wash cold with like colors  \r\n• Do not bleach  \r\n• Tumble dry low or hang dry  \r\n• Iron on low heat if needed  \r\n• Do not dry clean unless specified  ', 'Machine wash cold with like colors  \r\n• Do not bleach  \r\n• Tumble dry low or hang dry  \r\n• Iron on low heat if needed  \r\n• Do not dry clean unless specified  '),
(6, '12', 'Unisex Oversized Winter Hoodie – Fleece-Lined Comfort for Cold Weather Style', 'Crafted from 100% breathable cotton, this slim-fit t-shirt is designed for comfort and style. Perfect for daily wear or layering under jackets.', 5000.00, 4600.00, 5, 'upload_image/pexels-dhanno-31874438.jpg', 'upload_image/WhatsApp Image 2025-04-29 at 04.58.41_536e5472.jpg', 'upload_image/pexels-dhanno-19248046.jpg', 'upload_image/pexels-dhanno-20614157.jpg', 'upload_image/pexels-dhanno-20516290.jpg', 'Machine wash cold with like colors  \r\n• Do not bleach  \r\n• Tumble dry low or hang dry  \r\n• Iron on low heat if needed  \r\n• Do not dry clean unless specified  ', 'Machine wash cold with like colors  \r\n• Do not bleach  \r\n• Tumble dry low or hang dry  \r\n• Iron on low heat if needed  \r\n• Do not dry clean unless specified  ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `phone`, `role`, `password`) VALUES
(3, 'zoni', 'zoni1234@gmail.com', '12345678901', 1, '123456'),
(5, 'Aliza Fatima', 'alizafatimaa34@gmail.com', '12345678901', NULL, '123456'),
(6, 'Kainat Fatima', 'kainatfatima34@gmail.com', '12345678901', NULL, '123456'),
(7, 'Check', 'check123@gmail.com', '12345678901', NULL, '123456'),
(8, 'new', 'new123@gmail.com', '12345678901', NULL, '123456'),
(9, 'test123@gmail.com', 'test123@gmail.com', '12345678901', NULL, '123456'),
(10, 'Test2', 'Test2123@gmail.com', '12345678901', NULL, '123456'),
(11, 'seher', 'seher123@gmail.com', '12345678901', NULL, '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `fk_cart_user` (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`checkout_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_details`
--
ALTER TABLE `products_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `checkout_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products_details`
--
ALTER TABLE `products_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
