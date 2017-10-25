CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `type` text NOT NULL,
  `service` text NOT NULL,
  `name` text NOT NULL,
  `queued` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
