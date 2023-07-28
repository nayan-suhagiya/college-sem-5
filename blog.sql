-- Drop the tables in reverse order of their creation (to handle foreign key constraints)

-- Drop the foreign key constraints on dependent tables first

-- Drop Wishlist table
DROP TABLE IF EXISTS Wishlist;

-- Drop Post_Tag table
DROP TABLE IF EXISTS Post_Tag;

-- Drop Post_Category table
DROP TABLE IF EXISTS Post_Category;

-- Drop Comments table
DROP TABLE IF EXISTS Comments;

-- Drop Blog_Posts table
DROP TABLE IF EXISTS Blog_Posts;

-- Drop Tags table
DROP TABLE IF EXISTS Tags;

-- Drop Categories table
DROP TABLE IF EXISTS Categories;

-- Drop Users table
DROP TABLE IF EXISTS Users;
CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    user_type ENUM('client', 'admin') NOT NULL DEFAULT 'client',
    image VARCHAR(100),
    created_at DATETIME,
    updated_at DATETIME
);

CREATE TABLE Blog_Posts (
    post_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    content TEXT NOT NULL,
    tags VARCHAR(200),
    featured_image VARCHAR(100),
    created_at DATETIME,
    updated_at DATETIME,
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

CREATE TABLE Comments (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    content TEXT NOT NULL,
    created_at DATETIME,
    FOREIGN KEY (post_id) REFERENCES Blog_Posts(post_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

CREATE TABLE Categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE Tags (
    tag_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE Post_Category (
    post_id INT NOT NULL,
    category_id INT NOT NULL,
    PRIMARY KEY (post_id, category_id),
    FOREIGN KEY (post_id) REFERENCES Blog_Posts(post_id),
    FOREIGN KEY (category_id) REFERENCES Categories(category_id)
);

CREATE TABLE Post_Tag (
    post_id INT NOT NULL,
    tag_id INT NOT NULL,
    PRIMARY KEY (post_id, tag_id),
    FOREIGN KEY (post_id) REFERENCES Blog_Posts(post_id),
    FOREIGN KEY (tag_id) REFERENCES Tags(tag_id)
);

CREATE TABLE Wishlist (
    wishlist_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    post_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    image VARCHAR(100) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (post_id) REFERENCES Blog_Posts(post_id)
);

INSERT INTO Users (name, email, password, user_type, image, created_at, updated_at)
VALUES
    ('John Doe', 'john@example.com', 'password123', 'admin', 'profile.jpg', NOW(), NOW()),
    ('Jane Smith', 'jane@example.com', 'password456', 'client', 'avatar.jpg', NOW(), NOW());

INSERT INTO Blog_Posts (user_id, title, content, tags, featured_image, created_at, updated_at)
VALUES
    (1, 'First Blog Post', 'This is the content of the first blog post.', 'technology, coding', 'post1.jpg', NOW(), NOW()),
    (2, 'Second Blog Post', 'This is the content of the second blog post.', 'travel, adventure', 'post2.jpg', NOW(), NOW());

INSERT INTO Comments (post_id, user_id, content, created_at)
VALUES
    (1, 2, 'Great post!', NOW()),
    (1, 1, 'Nice content!', NOW());
INSERT INTO Comments (post_id, user_id, content, created_at)
VALUES
    (1, 2, 'Great post!', NOW()),
    (1, 1, 'Nice content!', NOW());
INSERT INTO Categories (name)
VALUES
    ('Technology'),
    ('Travel');
INSERT INTO Tags (name)
VALUES
    ('coding'),
    ('adventure');
INSERT INTO Post_Category (post_id, category_id)
VALUES
    (1, 1),
    (1, 2);
INSERT INTO Post_Tag (post_id, tag_id)
VALUES
    (1, 1),
    (1, 2);
INSERT INTO Wishlist (user_id, post_id, name, price, image)
VALUES
    (2, 1, 'First Blog Post Wishlist', 99.99, 'wishlist1.jpg'),
    (1, 2, 'Second Blog Post Wishlist', 79.99, 'wishlist2.jpg');
