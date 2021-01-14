# web-store
A fully functional and secure shopping site with front-end and back-end implementation. Written primarily in PHP, utilizing MySQL for database connections. Users are able to add products to cart, purchase products, and write reviews. Site admins have the ability to insert/remove products, manage reviews, track all incoming/outgoing orders using varied search criteria, ship orders to users, etc.

Execute by loading the files into a server, performing a database dump using the file 'projectx.sql', and accessing the 'index.php' file with a browser. From here, go to signup on the upper right to create a user account. Any user account can be changed to an admin account only through modification of the database, by simply changing the 'isAdmin' column to 1 (SQL for changing to admin account: UPDATE Users SET isAdmin = 1 WHERE *userID = x or email_ID = 'y'*). A preview of the site without execution is available through the 'preview_images folder'
