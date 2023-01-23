/* Here's the SQL code that I used to create the table and insert the log records into the database: */
CREATE TABLE logs (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    level VARCHAR(20) NOT NULL,
    message TEXT NOT NULL,
    context TEXT,
    created_at DATETIME NOT NULL
);

/*

This SQL code creates a table named logs with the following columns:

    id          : an auto-incrementing primary key
    level       : a varchar column that stores the log level
    message     : a text column that stores the log message
    context     : a text column that stores the log context, it's optional.
    created_at  : a datetime column that stores the time when the log was created
  
*/

/* And the SQL code that I used to insert log records into the database is: */
INSERT INTO logs (level, message, context, created_at) VALUES (:level, :message, :context, :created_at)

/* 

    This SQL code inserts a new log record into the logs table with the values provided for the level, message, context, and created_at columns.

    In the PHP class, I've used these SQL statements to insert the records into the database through the prepare statement of PDO.

    Please note that, you'll need to create the table logs in your database before you start inserting the log records.

*/
