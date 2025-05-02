CREATE DATABASE blog_app;

USE blog_app;

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    author VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert some sample data
INSERT INTO posts (title, content, author) VALUES
('Welcome to My Blog', 'This is the first post on my new blog. I hope you enjoy reading my content!', 'Tamanna'),
('How to Learn PHP', 'PHP is a popular server-side scripting language. Here are some tips to learn it effectively...', 'Tamanna'),
('MySQL Basics', 'MySQL is an open-source relational database management system. In this post, we will cover the basics...', 'Tamanna');