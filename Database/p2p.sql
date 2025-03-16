CREATE TABLE `users` (
  `user_id` integer PRIMARY KEY AUTO_INCREMENT,
  `email` varchar(255) UNIQUE NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone_number` varchar(255),
  `profile_picture_url` varchar(255),
  `bio` text,
  `company_name` varchar(255),
  `is_verified` boolean DEFAULT false,
  `created_at` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP),
  `updated_at` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP),
  `last_login_at` timestamp
);

CREATE TABLE `spaces` (
  `space_id` integer PRIMARY KEY AUTO_INCREMENT,
  `host_id` integer NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255),
  `postal_code` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `latitude` decimal(10,8),
  `longitude` decimal(11,8),
  `capacity` integer NOT NULL,
  `hourly_rate` decimal(10,2) NOT NULL,
  `min_booking_duration` integer NOT NULL COMMENT 'in hours',
  `max_booking_duration` integer COMMENT 'in hours',
  `is_active` boolean DEFAULT true,
  `created_at` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP),
  `updated_at` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `amenities` (
  `amenity_id` integer PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255),
  `category` varchar(255) COMMENT 'e.g., technology, furniture, service, etc.'
);

CREATE TABLE `space_amenities` (
  `space_id` integer NOT NULL,
  `amenity_id` integer NOT NULL,
  PRIMARY KEY (`space_id`, `amenity_id`)
);

CREATE TABLE `space_images` (
  `image_id` integer PRIMARY KEY AUTO_INCREMENT,
  `space_id` integer NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `caption` varchar(255),
  `created_at` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `space_availability` (
  `availability_id` integer PRIMARY KEY AUTO_INCREMENT,
  `space_id` integer NOT NULL,
  `day_of_week` integer NOT NULL COMMENT '0 = Sunday, 1 = Monday, etc.',
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `is_available` boolean DEFAULT true
);

CREATE TABLE `availability_exceptions` (
  `exception_id` integer PRIMARY KEY AUTO_INCREMENT,
  `space_id` integer NOT NULL,
  `exception_date` date NOT NULL,
  `is_available` boolean NOT NULL,
  `start_time` time,
  `end_time` time,
  `reason` varchar(255)
);

CREATE TABLE `bookings` (
  `booking_id` integer PRIMARY KEY AUTO_INCREMENT,
  `space_id` integer NOT NULL,
  `renter_id` integer NOT NULL,
  `start_datetime` timestamp NOT NULL,
  `end_datetime` timestamp NOT NULL,
  `num_attendees` integer,
  `booking_purpose` varchar(255),
  `status` varchar(255) NOT NULL DEFAULT 'pending' COMMENT 'pending, confirmed, cancelled, completed',
  `total_price` decimal(10,2) NOT NULL,
  `service_fee` decimal(10,2) NOT NULL,
  `host_payout` decimal(10,2) NOT NULL,
  `cancellation_reason` text,
  `cancelled_by` integer,
  `created_at` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP),
  `updated_at` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `reviews` (
  `review_id` integer PRIMARY KEY AUTO_INCREMENT,
  `booking_id` integer UNIQUE NOT NULL,
  `reviewer_id` integer NOT NULL,
  `reviewee_id` integer NOT NULL,
  `space_id` integer NOT NULL,
  `rating` integer NOT NULL COMMENT 'between 1 and 5',
  `review_text` text,
  `response_text` text,
  `created_at` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP),
  `updated_at` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `payment_methods` (
  `payment_method_id` integer PRIMARY KEY AUTO_INCREMENT,
  `user_id` integer NOT NULL,
  `payment_type` varchar(255) NOT NULL COMMENT 'credit_card, paypal, etc.',
  `provider_payment_token` varchar(255) NOT NULL,
  `is_default` boolean DEFAULT false,
  `card_last_four` varchar(255),
  `card_brand` varchar(255),
  `expiry_month` integer,
  `expiry_year` integer,
  `billing_zip` varchar(255),
  `created_at` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP),
  `updated_at` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `transactions` (
  `transaction_id` integer PRIMARY KEY AUTO_INCREMENT,
  `booking_id` integer NOT NULL,
  `payment_method_id` integer,
  `transaction_type` varchar(255) NOT NULL COMMENT 'payment, refund, payout',
  `amount` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL COMMENT 'pending, completed, failed',
  `provider_transaction_id` varchar(255),
  `created_at` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP),
  `updated_at` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `messages` (
  `message_id` integer PRIMARY KEY AUTO_INCREMENT,
  `sender_id` integer NOT NULL,
  `recipient_id` integer NOT NULL,
  `booking_id` integer,
  `message_text` text NOT NULL,
  `is_read` boolean DEFAULT false,
  `created_at` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `notifications` (
  `notification_id` integer PRIMARY KEY AUTO_INCREMENT,
  `user_id` integer NOT NULL,
  `notification_type` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `related_id` integer COMMENT 'Can be a booking_id, message_id, etc.',
  `is_read` boolean DEFAULT false,
  `created_at` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `user_settings` (
  `user_id` integer PRIMARY KEY,
  `email_notifications` boolean DEFAULT true,
  `push_notifications` boolean DEFAULT true,
  `sms_notifications` boolean DEFAULT false,
  `marketing_emails` boolean DEFAULT true,
  `updated_at` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `roles` (
  `role_id` integer PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) UNIQUE NOT NULL COMMENT 'e.g., admin, host, renter, moderator, support',
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `user_roles` (
  `user_id` integer NOT NULL,
  `role_id` integer NOT NULL,
  PRIMARY KEY (`user_id`, `role_id`)
);

CREATE TABLE `permissions` (
  `permission_id` integer PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) UNIQUE NOT NULL COMMENT 'e.g., manage_users, approve_listings, view_reports',
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `role_permissions` (
  `role_id` integer NOT NULL,
  `permission_id` integer NOT NULL,
  PRIMARY KEY (`role_id`, `permission_id`)
);

CREATE TABLE `activities` (
  `activity_id` integer PRIMARY KEY AUTO_INCREMENT,
  `user_id` integer COMMENT 'User who performed the action',
  `activity_type` varchar(255) NOT NULL,
  `activity_name` varchar(255) NOT NULL,
  `activity_description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT (CURRENT_TIMESTAMP)
);

ALTER TABLE `spaces` ADD FOREIGN KEY (`host_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `space_amenities` ADD FOREIGN KEY (`space_id`) REFERENCES `spaces` (`space_id`);

ALTER TABLE `space_amenities` ADD FOREIGN KEY (`amenity_id`) REFERENCES `amenities` (`amenity_id`);

ALTER TABLE `space_images` ADD FOREIGN KEY (`space_id`) REFERENCES `spaces` (`space_id`);

ALTER TABLE `space_availability` ADD FOREIGN KEY (`space_id`) REFERENCES `spaces` (`space_id`);

ALTER TABLE `availability_exceptions` ADD FOREIGN KEY (`space_id`) REFERENCES `spaces` (`space_id`);

ALTER TABLE `bookings` ADD FOREIGN KEY (`space_id`) REFERENCES `spaces` (`space_id`);

ALTER TABLE `bookings` ADD FOREIGN KEY (`renter_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `bookings` ADD FOREIGN KEY (`cancelled_by`) REFERENCES `users` (`user_id`);

ALTER TABLE `reviews` ADD FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`);

ALTER TABLE `reviews` ADD FOREIGN KEY (`reviewer_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `reviews` ADD FOREIGN KEY (`reviewee_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `reviews` ADD FOREIGN KEY (`space_id`) REFERENCES `spaces` (`space_id`);

ALTER TABLE `payment_methods` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `transactions` ADD FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`);

ALTER TABLE `transactions` ADD FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`payment_method_id`);

ALTER TABLE `messages` ADD FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `messages` ADD FOREIGN KEY (`recipient_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `messages` ADD FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`);

ALTER TABLE `notifications` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `user_settings` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `user_roles` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `user_roles` ADD FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);

ALTER TABLE `role_permissions` ADD FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);

ALTER TABLE `role_permissions` ADD FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`permission_id`);

ALTER TABLE `activities` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
