[Example Website](http://people.oregonstate.edu/~bodalj/cs340/movie-tv-database/)

# Installation
* Make sure to set .private folder to 700
* Copy .private/config-example.ini to .private/config.ini and set permissions to 700
```
    chmod 700 .private
    cp .private/config-example.ini .private/config.ini
    chmod 700 .private/config.ini
```

* Update the config.ini with your information

# Drop/Create Database
    Navigate to databases/creation
    mysql --user=[username] --password=[password] --host=oniddb.cws.oregonstate.edu -D [dbname] < drop_create_tables.sql

# Insert test data
    Navigate to database/creation
    mysql --user=[username] --password=[password] --host=oniddb.cws.oregonstate.edu -D [dbname] < insert_test_data.sql

