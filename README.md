# ZETA NETWORTH MANAGEMENT

Zeta is a central web application for managing assets and finances.

## Technologies used

Following [technologies](https://www.geeksforgeeks.org/web-technology/) are used.
+ HTML
+ CSS
+ JS
  + JQUERY
  + AJAX
+ PHP
+ SQL
  + MYSQL

## Features / Protections
+ Sign Up
+ Password reset (done in a secure and friendly manner)
+ Mail Validation (ensure user has access to the email they used to make the account)
+ CSRF protection for all features/forms
+ Account Deletion
+ All features are protected from SQL Injection using PHP prepared statements
+ XSS protection (see video for how to impliment when adding your own pages with untrusted data on them)
+ All passwords are hashed so that even with access to the database attackers could not obtain users password
+ Login (protected against brute force/dictionary attacks)
+ ... possibly more that I did not think of at the time of writing this
## Essential Functions
```bash
test reference: utils.php
```

```php
require('utils.php')

# returns 'true' or 'false'
function updateDB ($table, $attr, $value, $cond) {
con->query(UPDATE $table SET $attr = $value WHERE $cond
}
```

## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://de.wikipedia.org/wiki/MIT-Lizenz)
