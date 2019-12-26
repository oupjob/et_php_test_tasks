SELECT * FROM `authors` WHERE id IN (SELECT author_id FROM authors_2_books GROUP BY author_id HAVING COUNT(book_id) <= 6)
