# Reliqui

[![Laravel Version](https://shield.with.social/cc/github/reliqui/reliqui/master.svg?style=flat-square)](https://packagist.org/packages/laravel/framework)
[![Build Status](https://travis-ci.org/reliqui/reliqui.svg?branch=master)](https://travis-ci.org/reliqui/reliqui)
[![StyleCI](https://styleci.io/repos/110965973/shield?branch=master)](https://styleci.io/repos/110965973)
[![Latest Stable Version](https://img.shields.io/github/release/reliqui/reliqui.svg?style=flat-square)](https://github.com/reliqui/reliqui/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

 
Reliqui is open source scheduling system for outpatients appointments to provide the easiest service for hospital patients or clinics.

* Scheduling Physical Appointment
* Multiple Hospital/Clinic
* Health History
* Specialities/Polyclinics
* Doctor's Schedule
* Doctor & Staff Management

## General Discussion

If you have any questions, ideas, feedback or thoughts on this project please make a comment on the [general discussion](https://github.com/orgs/reliqui/teams/hooray-team) instead of using the issue tracker.

## Installation

### Prerequisites

* To run this project, you must have PHP 7 installed.
* You should setup a host on your web server for your local domain. For this you could also configure [Laravel Homestead](https://laravel.com/docs/5.6/homestead) or [Valet](https://laravel.com/docs/5.6/valet).

### Step 1

Begin by cloning this repository to your machine, and installing all Composer & NPM dependencies.

1. `git clone git@github.com:reliqui/reliqui.git`
2. `cd reliqui && composer install && npm install`
3. `php artisan reliqui:install`
4. `npm run dev`

### Step 2

Next, boot up a server and seed databases & visit [http://reliqui.test](http://reliqui.test).

1. Seed DB: `php artisan db:seed`, Type `yes` in instruction and you will get the owner account.
2. Visit: `http://reliqui.test/settings/groups` to seed one or more hospital/clinic.

## Contributing

Fork the repository, make the code changes then submit a pull request.

Please, be very clear on your commit messages and pull requests, empty pull request messages may be rejected without reason.

## Code of Conduct

Please read our [Code of Conduct](code_of_conduct.md) before contributing or engaging in discussions.

## Security Vulnerabilities

If you discover any security related issues, please email davidhasiholans@gmail.com instead of using the issue tracker.

## License

The [MIT license](LICENSE).
