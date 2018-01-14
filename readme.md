# Reliqui

[![Laravel Version](https://shield.with.social/cc/github/reliqui/reliqui/master.svg?style=flat-square)](https://packagist.org/packages/laravel/framework)
[![StyleCI](https://styleci.io/repos/110965973/shield?branch=master)](https://styleci.io/repos/110965973)
[![Latest Stable Version](https://img.shields.io/github/release/reliqui/reliqui.svg?style=flat-square)](https://github.com/reliqui/reliqui/releases)
 
Reliqui is free and open source scheduling system for outpatient appointments to provide the easiest service for hospital patients or clinics.

* Physical Appointment
* Multiple Hospital/Clinic
* Health History
* Specialities/Polyclinics
* Doctor's Schedule
* Doctor & Staff Management

## Requirements

The following tools are required in order to start the installation.

- [VirtualBox](https://www.virtualbox.org/)
- [Vagrant](https://www.vagrantup.com/)
- [Laravel Homestead](https://laravel.com/docs/5.5/homestead)

## Installation

> Note that you are free to customize `reliqui.test` tld to whatever you want.

1. Clone this repository: `git clone git@github.com:reliqui/reliqui.git ~/code/reliqui`
2. Copy `.env.example` paste and rename `.env`
3. Open `.env` file and update your environment
4. Configuring [Homestead.yaml](https://laravel.com/docs/5.5/homestead), go to `/home/user/Homestead`
5. Add `192.168.10.10 reliqui.test` to your computer's `/etc/hosts` file
6. Run `vagrant up`
7. SSH into your Vagrant box, go to `/home/vagrant/code/reliqui` and run `composer install`
8. Generate app key `php artisan key:generate`
9. Setup a working e-mail driver like [Mailtrap](https://mailtrap.io/)

You can now visit the app in your browser by visiting [http://reliqui.test](http://reliqui.test).

## Contributing

Fork the repository, make the code changes then submit a pull request.

Please, be very clear on your commit messages and pull requests, empty pull request messages may be rejected without reason.

## Code of Conduct

Please read our [Code of Conduct](code_of_conduct.md) before contributing or engaging in discussions.

## Security Vulnerabilities

If you discover any security related issues, please email davidhasiholans@gmail.com instead of using the issue tracker.

## License

Reliqui is released under the [GPLv3 license](LICENSE).
