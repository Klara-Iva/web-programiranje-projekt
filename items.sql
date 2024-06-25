-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2024 at 09:07 PM
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
-- Database: `myapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `long_description` text DEFAULT NULL,
  `picture_url` varchar(255) DEFAULT NULL,
  `bloom_months` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `short_description`, `long_description`, `picture_url`, `bloom_months`) VALUES
(1, 'Red Rose', 'Beautiful red rose.', 'The rose is a type of flowering shrub. Its name comes from the Latin word Rosa. The flowers of the rose grow in many different colors, from the well-known red rose to yellow roses and sometimes white or purple roses.', 'https://www.pamsposies.com/assets/img/dictionary/rose-main.jpg', '5,6,7,8,9,10'),
(2, 'Tulip', 'Vibrant tulip flower.', 'Tulips are spring-blooming perennials that grow from bulbs. Depending on the species, tulip plants can be between 4 inches and 28 inches high. The flowers are usually large, showy and brightly colored, generally red, pink, yellow, or white.', 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcTOrMNz3BHenLXvLrJeh1UzWDK1ZtaXrwG84T65A2LrA3JlI_cU', '3,4,5'),
(3, 'Daisy', 'White daisy flower.', 'Daisies are a family of flowering plants, also known as Asteraceae. These plants are characterized by a composite flower head and often have a disc surrounded by petals. Daisies are found in diverse habitats, from forests to grasslands.', 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcS0HySqriyqqY3wglw1nF59LUldtl1PnLvs1QRDu5RMZYJgfDh_', '5,6,7'),
(4, 'Sunflower', 'Tall sunflower.', 'Sunflowers are large, daisy-like flowers with bright yellow petals and a contrasting darker center. They are known for their tall, sturdy stems and can grow to great heights. Sunflowers are not only beautiful but also produce seeds that are edible.', 'https://eos.com/wp-content/uploads/2023/09/how-to-grow-sunflower.png.webp', '6,7,8'),
(5, 'Lily', 'Fragrant lily flower.', 'Lilies are a group of flowering plants that are important in culture and literature in much of the world. Most species are native to the temperate northern hemisphere. Lilies are tall perennials ranging in height from 2 to 6 ft.', 'https://cdn.britannica.com/77/120977-050-41EE9568/Easter-lily.jpg', '5,6,7'),
(6, 'Orchid', 'Exotic orchid.', 'Orchids are a diverse and widespread family of flowering plants, with blooms that are often colorful and fragrant. Orchids are known for their complex flowers and are found in almost every habitat apart from glaciers.', 'https://live-production.wcms.abc-cdn.net.au/a98e62177d7b43f482960f211b254e62?impolicy=wcms_crop_resize&cropH=563&cropW=1000&xPos=0&yPos=0&width=862&height=485', '1,2,3,4,5,6,7,8,9,10,11,12'),
(7, 'Daffodil', 'Bright yellow daffodil.', 'Daffodils are a genus of predominantly spring perennials in the amaryllis family, Amaryllidaceae. Common names include daffodil, narcissus, and jonquil. They have conspicuous flowers with six petal-like tepals.', 'https://www.gardenia.net/wp-content/uploads/2023/03/27876097_sOptimized-1.webp', '2,3,4'),
(8, 'Bluebell', 'Delicate bluebell flower.', 'Bluebells are bulbous perennial plants that are often found in woodlands. They have blue, bell-shaped flowers that hang down from one side of a stem. Bluebells are known for creating beautiful carpets of blue in the spring.', 'https://www.floraqueen.com/blog/wp-content/uploads/2020/01/shutterstock_611801570.jpg', '4,5'),
(9, 'Marigold', 'Cheerful marigold.', 'Marigolds are known for their bright orange and yellow colors. They are easy to grow and can bloom from early summer until frost. Marigolds are often used in gardens to attract pollinators and are also used in cultural celebrations.', 'https://m.media-amazon.com/images/I/81MvKhAUG4L.jpg', '5,6,7,8,9'),
(10, 'Lavender', 'Calming lavender flower.', 'Lavender is a genus of 47 known species of flowering plants in the mint family. It is native to the Old World and is found from Cape Verde and the Canary Islands, Europe across to northern and eastern Africa, the Mediterranean, and southwest Asia.', 'https://cdn.shopify.com/s/files/1/0573/3993/6868/t/6/assets/lavender-herb-1667488792930.jpg?v=1667488793', '6,7,8'),
(11, 'Cherry Blossom', 'Delicate cherry blossoms.', 'Cherry blossoms are known for their beautiful, delicate flowers that bloom in spring. They are widely celebrated in many cultures for their fleeting beauty.', 'https://www.realestate.com.au/news-image/w_2000,h_1500/v1657825043/news-lifestyle-content-assets/wp-content/production/Charry-blossoms-hero.jpg?_i=AA', '3,4,5'),
(12, 'Peony', 'Large, fragrant peonies.', 'Peonies are large, fragrant flowers that bloom in late spring to early summer. They are known for their lush, full blooms and come in a variety of colors.', 'https://cdn.britannica.com/40/189540-050-1307654B/garden-peonies.jpg', '5,6,7'),
(13, 'Iris', 'Colorful iris flowers.', 'Irises are colorful flowers that come in a range of colors including blue, purple, white, and yellow. They bloom in spring and early summer and are known for their unique shape.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQNyq6iwDv8ChJEHg29lEFaKItvUPssNKblOQ&s', '4,5,6'),
(14, 'Magnolia', 'Elegant magnolia blooms.', 'Magnolias are large, fragrant flowers that bloom in spring. They are known for their impressive size and beautiful, creamy white petals.', 'https://hips.hearstapps.com/hmg-prod/images/magnolia-tree-65f21c8331903.jpg', '3,4,5'),
(15, 'Hydrangea', 'Clusters of hydrangea flowers.', 'Hydrangeas are known for their large clusters of flowers that come in a variety of colors including pink, blue, and white. They bloom in summer and are popular in gardens.', 'https://cdn.mos.cms.futurecdn.net/ycbHmPmHY2TvEvLDNwJUoH.jpg', '6,7,8'),
(16, 'Camellia', 'Elegant camellia flowers.', 'Camellias are known for their beautiful, rose-like flowers that bloom in winter and spring. They come in a variety of colors including red, pink, and white.', 'https://harrodsoutdoor.com/wp-content/uploads/2024/01/shutterstock_1959852712-1.jpg', '1,2,3,4'),
(17, 'Poppy', 'Bright poppy flowers.', 'Poppies are known for their bright, showy flowers that bloom in late spring and early summer. They come in a variety of colors including red, orange, and yellow.', 'https://silverfallsseed.com/wp-content/uploads/2016/01/Red-Poppy-tower-2017-43.jpg', '5,6,7'),
(18, 'Freesia', 'Fragrant freesia blooms.', 'Freesias are known for their fragrant flowers that bloom in late winter and early spring. They come in a variety of colors including yellow, white, and purple.', 'https://t3.ftcdn.net/jpg/00/91/52/98/360_F_91529811_kg0AExuGaggoyhFqreHQnDQxyRQdUJg4.jpg', '2,3,4'),
(19, 'Geranium', 'Vibrant geranium flowers.', 'Geraniums are popular garden plants known for their vibrant flowers and long blooming period. They come in a variety of colors including pink, red, and white.', 'https://www.southernliving.com/thmb/n0pXVuKp81T_Vb5DS8OkAuBVr_E=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/gettyimages-130794718-2000-d158ca96c9d1412790348d3a328ba0ae.jpg', '5,6,7,8'),
(20, 'Petunia', 'Colorful petunia flowers.', 'Petunias are known for their colorful, trumpet-shaped flowers that bloom from spring to fall. They are popular in hanging baskets and garden beds.', 'https://cdn.britannica.com/89/131089-050-A4773446/flowers-garden-petunia.jpg', '4,5,6,7,8,9'),
(66709, 'White rose', 'Elegant white rose.', 'White roses symbolize purity, innocence, and new beginnings. They are often used in weddings and other celebrations.', 'https://i.etsystatic.com/8642388/r/il/aecb95/1297556594/il_570xN.1297556594_in9b.jpg', '6,7,8,9,10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66712;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
