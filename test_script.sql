INSERT INTO restaurants (name, address, phone, rating, price, vegan, vegetarian, halal, kosher, glutenFree, studentDiscount, created_at, updated_at) VALUES
('The Gourmet Spoon', '123 Main St', '555-555-5555', 5, 2, 1.0, 0.0, 0.0, 0.0, 1.0, 1.0, NOW(), NOW()),
('Maple Delights', '456 Maple Ave', '555-555-5556', 4, 2, 0.0, 1.0, 0.0, 0.0, 1.0, 0.0, NOW(), NOW()),
('Oak Bistro', '789 Oak Dr', '555-555-5557', 3, 2, 0.0, 1.0, 1.0, 0.0, 1.0, 1.0, NOW(), NOW()),
('Elm Street Diner', '321 Elm St', '555-555-5558', 2, 2, 0.0, 0.0, 0.0, 1.0, 1.0, 0.0, NOW(), NOW()),
('Pine Avenue Grill', '654 Pine Ave', '555-555-5559', 5, 2, 1.0, 1.0, 0.0, 0.0, 1.0, 1.0, NOW(), NOW()),
('Maple Drive Eatery', '987 Maple Dr', '555-555-5560', 4, 2, 1.0, 1.0, 0.0, 0.0, 1.0, 0.0, NOW(), NOW()),
('Elm Street Cafe', '135 Elm St', '555-555-5561', 3, 2, 0.0, 1.0, 0.0, 0.0, 1.0, 1.0, NOW(), NOW()),
('Pine Avenue Bistro', '246 Pine Ave', '555-555-5562', 2, 2, 0.0, 0.0, 1.0, 0.0, 1.0, 0.0, NOW(), NOW()),
('Maple Drive Diner', '864 Maple Dr', '555-555-5563', 5, 2, 1.0, 1.0, 0.0, 0.0, 1.0, 1.0, NOW(), NOW()),
('Elm Street Grill', '579 Elm St', '555-555-5564', 4, 2, 1.0, 1.0, 0.0, 0.0, 1.0, 0.0, NOW(), NOW());


INSERT INTO reviews (user_id, restaurant_id, text, title, rating, created_at, updated_at) VALUES
(1, 1, 'Great food and service at The Gourmet Spoon', 'Excellent Experience', 5, NOW(), NOW()),
(1, 1, 'The Gourmet Spoon has a great wine selection', 'Great Wine Selection', 4, NOW(), NOW()),
(1, 2, 'Maple Delights has a cozy atmosphere', 'Cozy and Comfortable', 4, NOW(), NOW()),
(1, 2, 'Maple Delights offers delicious pancakes', 'Delicious Pancakes', 5, NOW(), NOW()),
(1, 3, 'Oak Bistro offers a variety of dishes', 'Variety of Choices', 3, NOW(), NOW()),
(1, 3, 'Oak Bistro has a great outdoor seating', 'Great Outdoor Seating', 4, NOW(), NOW()),
(1, 4, 'Elm Street Diner is a great place for family meals', 'Family Friendly', 2, NOW(), NOW()),
(1, 4, 'Elm Street Diner offers a kids menu', 'Kids Menu Available', 3, NOW(), NOW()),
(1, 5, 'Pine Avenue Grill has the best steak', 'Best Steak in Town', 5, NOW(), NOW()),
(1, 5, 'Pine Avenue Grill offers a great view', 'Great View', 4, NOW(), NOW()),
(1, 6, 'Maple Drive Eatery is perfect for brunch', 'Perfect Brunch Spot', 4, NOW(), NOW()),
(1, 6, 'Maple Drive Eatery has a great selection of pastries', 'Great Pastries', 5, NOW(), NOW()),
(1, 7, 'Elm Street Cafe has a great coffee selection', 'Great Coffee Selection', 3, NOW(), NOW()),
(1, 7, 'Elm Street Cafe is a great place to work', 'Great Workspace', 4, NOW(), NOW()),
(1, 8, 'Pine Avenue Bistro is a great place for date nights', 'Romantic Spot', 2, NOW(), NOW()),
(1, 8, 'Pine Avenue Bistro has a great wine list', 'Great Wine List', 3, NOW(), NOW()),
(1, 9, 'Maple Drive Diner has a classic diner feel', 'Classic Diner', 5, NOW(), NOW()),
(1, 9, 'Maple Drive Diner offers great breakfast options', 'Great Breakfast Options', 4, NOW(), NOW()),
(1, 10, 'Elm Street Grill has a great burger', 'Great Burger', 4, NOW(), NOW()),
(1, 10, 'Elm Street Grill is a great place for watching sports', 'Great for Sports', 5, NOW(), NOW());




