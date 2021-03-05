CREATE TABLE `user` (
 `id` varchar(255) NOT NULL,
 `username` varchar(20) NOT NULL,
 `password` varchar(255) NOT NULL,
 `created_at` datetime NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `post` (
 `id` varchar(255) NOT NULL,
 `title` varchar(255) NOT NULL,
 `pictureurl` varchar(255) NOT NULL,
 `text` text NOT NULL,
 `created_at` datetime NOT NULL,
 `author_id` varchar(255) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `post_authorid_user_id` (`author_id`),
 CONSTRAINT `post_authorid_user_id` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `comment` (
 `id` varchar(255) NOT NULL,
 `name` varchar(255) NOT NULL,
 `email` varchar(255) NOT NULL,
 `website` varchar(255) NOT NULL,
 `comment` tinytext NOT NULL,
 `created_at` datetime NOT NULL,
 `post_id` varchar(255) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `comment_postid_post_id` (`post_id`),
 CONSTRAINT `comment_postid_post_id` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




INSERT INTO `user` (`id`, `username`, `password`, `created_at`) VALUES
('6026aab81f9ad', 'renan', '$2y$12$RxerFi05b6Y4LEEW6BOj0eEVHb2N9zOYSu8lTmVg7SYUqWxcQhCrO', CURRENT_TIME()),
('6026ab418e1e0', 'maria', '$2y$12$qmfmX9eSKYO2s1CDvD/dxeiniNhpOWzzpufmwigiT5akEKRsIm7XO', CURRENT_TIME());


INSERT INTO `post` (`id`, `title`, `pictureurl`, `text`, `created_at`, `author_id`) VALUES
('6026bc6e45f00', 'Post 1', 'https://via.placeholder.com/180x100', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin consequat, massa ac commodo ultricies, dolor erat consequat metus, a iaculis mauris libero id diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin euismod massa fermentum nisl faucibus, ut mollis enim iaculis. In in justo et orci blandit tempor. Phasellus nec auctor purus. Morbi interdum at ligula sed tristique. Nulla sit amet vestibulum sapien. Integer convallis, augue nec tempor consequat, neque libero mollis augue, nec mattis erat sapien id ante. Curabitur tristique neque ut sapien accumsan euismod. Curabitur est dui, imperdiet non fringilla id, bibendum eget felis. Suspendisse rhoncus est sit amet massa tempus porttitor. In laoreet, risus sed aliquam mattis, dolor est efficitur quam, a gravida dolor nulla ac justo. Donec ut erat nulla. Nulla rhoncus convallis quam sit amet placerat.', '2021-02-12 14:37:16', '6026aab81f9ad'),
('6026bcd29acc0', 'Post 2', 'https://via.placeholder.com/180x100', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin consequat, massa ac commodo ultricies, dolor erat consequat metus, a iaculis mauris libero id diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin euismod massa fermentum nisl faucibus, ut mollis enim iaculis. In in justo et orci blandit tempor. Phasellus nec auctor purus. Morbi interdum at ligula sed tristique. Nulla sit amet vestibulum sapien. Integer convallis, augue nec tempor consequat, neque libero mollis augue, nec mattis erat sapien id ante. Curabitur tristique neque ut sapien accumsan euismod. Curabitur est dui, imperdiet non fringilla id, bibendum eget felis. Suspendisse rhoncus est sit amet massa tempus porttitor. In laoreet, risus sed aliquam mattis, dolor est efficitur quam, a gravida dolor nulla ac justo. Donec ut erat nulla. Nulla rhoncus convallis quam sit amet placerat.', '2021-02-12 14:37:35', '6026aab81f9ad'),
('6026bce5596c4', 'Post 3', 'https://via.placeholder.com/180x100', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin consequat, massa ac commodo ultricies, dolor erat consequat metus, a iaculis mauris libero id diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin euismod massa fermentum nisl faucibus, ut mollis enim iaculis. In in justo et orci blandit tempor. Phasellus nec auctor purus. Morbi interdum at ligula sed tristique. Nulla sit amet vestibulum sapien. Integer convallis, augue nec tempor consequat, neque libero mollis augue, nec mattis erat sapien id ante. Curabitur tristique neque ut sapien accumsan euismod. Curabitur est dui, imperdiet non fringilla id, bibendum eget felis. Suspendisse rhoncus est sit amet massa tempus porttitor. In laoreet, risus sed aliquam mattis, dolor est efficitur quam, a gravida dolor nulla ac justo. Donec ut erat nulla. Nulla rhoncus convallis quam sit amet placerat.', '2021-02-12 14:37:50', '6026aab81f9ad'),
('6026bd105e54f', 'Post 4', 'https://via.placeholder.com/180x100', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin consequat, massa ac commodo ultricies, dolor erat consequat metus, a iaculis mauris libero id diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin euismod massa fermentum nisl faucibus, ut mollis enim iaculis. In in justo et orci blandit tempor. Phasellus nec auctor purus. Morbi interdum at ligula sed tristique. Nulla sit amet vestibulum sapien. Integer convallis, augue nec tempor consequat, neque libero mollis augue, nec mattis erat sapien id ante. Curabitur tristique neque ut sapien accumsan euismod. Curabitur est dui, imperdiet non fringilla id, bibendum eget felis. Suspendisse rhoncus est sit amet massa tempus porttitor. In laoreet, risus sed aliquam mattis, dolor est efficitur quam, a gravida dolor nulla ac justo. Donec ut erat nulla. Nulla rhoncus convallis quam sit amet placerat.', '2021-02-12 14:38:50', '6026aab81f9ad');



INSERT INTO `comment` (`id`, `name`, `email`, `website`, `comment`, `created_at`, `post_id`, `commenter_id`) VALUES ('6026d2d30b95c', 'commenter 1', 'commenter1@test.com', 'https://commenterwebsite.com.br', 'Great post!', CURRENT_TIME(), '6026bc6e45f00');
INSERT INTO `comment` (`id`, `name`, `email`, `website`, `comment`, `created_at`, `post_id`, `commenter_id`) VALUES ('6026d2d30b964', 'commenter 2', 'commenter1@test.com', 'https://commenterwebsite.com.br', 'Great post!', CURRENT_TIME(), '6026bc6e45f00');