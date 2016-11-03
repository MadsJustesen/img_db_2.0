# img_db_2.0
Assignment for Internet Technologies 6th semester of Software Engineering

## DATABASE
To set up the database first import the database using the "db_dump.sql" located file in the root directory
Next go into the /config directory and delete the "~" (template post-fix) from the db.php file and edit the contents to match your database-settings (localhost, user, pass)

## SERVER
Run the server from the /public directory with "php -S localhost:3000" or similar

## USERS
There are 1 admin and 5 users pre-installed
* All users have password 'password'

Only admin can delete users (From view "Users")

Usernames:
admin
user_1
user_2
user_3
user_4
user_5

It is also possible to create new users
