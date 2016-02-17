[Example Website](http://people.oregonstate.edu/~bodalj/cs340/movie-tv-database/)

# Installation
* Make sure to set .private folder to 700
* Copy .private/config-example.ini to .private/config.ini and set permissions to 700
```
    chmod 700 .private
    cp .private/config-example.ini .private/config.ini
    chmod 700 .private/config.ini
```
# Restore Database
    mysql -u [username] -p -D [dbname] < database/all_db_backup.sql
