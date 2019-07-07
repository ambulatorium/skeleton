## Introduction

**Ambulatory is outpatient care platform for your website.** Carefully designed to be consistent, fast, easy to use, and meet the needs of outpatient services in health facilities. [Learn more about ambulatory care >>>](https://www.rasmussen.edu/degrees/nursing/blog/what-is-ambulatory-care/)

## Installation

This repository only holds the skeleton application as a fresh start to build your ambulatory project.

Create new Ambulatory project via Composer:

```
composer create-project --prefer-dist ambulatory/skeleton myclinic
```

Once Composer is done, migrate the database table.

```
php artisan ambulatory:migrate
```

Create a symbolic link to ensure file uploads are publicly accessible from the web:

```
php artisan storage:link
```

Head to `yourproject.test/myclinic` and use the provided email and password to log in.


## Security Vulnerabilities

If you discover a security vulnerability within Ambulatory, please send an e-mail to [davidhsianturi@gmail.com](mailto:davidhsianturi@gmail.com). All security vulnerabilities will be promptly addressed.

## License

Ambulatory is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
