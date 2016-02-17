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
    mysql --user=[username] --password=[password] --host=oniddb.cws.oregonstate.edu -D [dbname] < all_db_backup.sql

# Backup Database
    mysqldump --compact --ad-drop-table --user=[username] --password=[password] --host=oniddb.cws.oregonstate.edu [dbname] | sed "/ SET /d" > all_db_backup.sql
