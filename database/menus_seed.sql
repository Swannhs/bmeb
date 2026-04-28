INSERT INTO menus (id, parent_id, label, url, "order", color, target, is_active, created_at, updated_at) VALUES
(1, NULL, 'হোম', '/', 1, '#FF4500', '_self', 1, datetime('now'), datetime('now')),
(2, NULL, 'আমাদের সম্পর্কে', '#', 2, '#FF1493', '_self', 1, datetime('now'), datetime('now')),
(3, NULL, 'কার্যক্রম', '#', 3, '#00BFFF', '_self', 1, datetime('now'), datetime('now')),
(4, NULL, 'ফর্ম সমূহ', '#', 4, '#32CD32', '_self', 1, datetime('now'), datetime('now')),
(5, NULL, 'রেজাল্ট আর্কাইভ', 'http://www.educationboardresults.gov.bd/', 5, '#1E90FF', '_blank', 1, datetime('now'), datetime('now')),
(6, NULL, 'প্রতিবেদন', '#', 6, '#FF69B4', '_self', 1, datetime('now'), datetime('now')),
(7, NULL, 'পুরাতন ওয়েবসাইট', 'http://bmeb.ebmeb.gov.bd/', 7, '#00CED1', '_blank', 1, datetime('now'), datetime('now')),
(8, NULL, 'যোগাযোগ', '/p/691997ad933eb65569ddddf3', 8, '#8A2BE2', '_self', 1, datetime('now'), datetime('now')),
(9, NULL, 'জুলাই পুনর্জাগরণ...', '/p/691997b6933eb65569dde558', 9, '#FFA500', '_self', 1, datetime('now'), datetime('now'));

-- Submenus for 'আমাদের সম্পর্কে' (id=2)
INSERT INTO menus (parent_id, label, url, "order", is_active, created_at, updated_at) VALUES
(2, 'ইতিহাস', '/p/691997bf933eb65569ddec81', 1, 1, datetime('now'), datetime('now')),
(2, 'বোর্ডের কার্যাবলি', '/p/691997c8933eb65569ddf224', 2, 1, datetime('now'), datetime('now')),
(2, 'আইন ও বিধিসমুহ', '/p/691997cd933eb65569ddf41b', 3, 1, datetime('now'), datetime('now')),
(2, 'সাংগঠনিক কাঠামো', '/p/691997d6933eb65569ddf895', 4, 1, datetime('now'), datetime('now')),
(2, 'কর্মকর্তাবৃন্দ', '/pages/officers', 5, 1, datetime('now'), datetime('now'));

-- Submenus for 'কার্যক্রম' (id=3)
INSERT INTO menus (parent_id, label, url, "order", is_active, created_at, updated_at) VALUES
(3, 'বার্ষিক ক্রয় পরিকল্পনা', '/p/691997b1933eb65569dde140', 1, 1, datetime('now'), datetime('now')),
(3, 'ই-ফাইলিং কার্যক্রম', '/p/691997bd933eb65569ddeb2d', 2, 1, datetime('now'), datetime('now')),
(3, 'বাল্য বিবাহ রোধ কার্যক্রম', '/p/691997bd933eb65569ddeb2d', 3, 1, datetime('now'), datetime('now'));
