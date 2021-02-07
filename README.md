# Upgrade CodeIgniter3 News Tutorial to CodeIgniter4

This repository is a sample of [CodeIgniter3 News Tutorial](https://github.com/kenjis/ci3-news) upgraded to CodeIgniter4 using the *[ci3-to-4-upgrade-helper](https://github.com/kenjis/ci3-to-4-upgrade-helper)*.

See <https://codeigniter.com/userguide3/tutorial/index.html>.

## Folder Structure

```
ci3-to-4-news/
├── app/
├── composer.json
├── composer.lock
├── public/
│   ├── .htaccess
│   └── index.php
└── vendor/
    └── codeigniter4/
        └── framework/
```

## Requirements

- PHP 7.3 or later
- `composer` command (See [Composer Installation](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos))
- Git

## How to Use

### Installation

```
$ git clone https://github.com/kenjis/ci3-to-4-news
$ cd /path/to/ci3-to-4-news/
$ composer install
```

### Database Migration and Seeding

```
$ php spark migrate
$ php spark db:seed NewsSeeder
```

### Run PHP built-in server

```
$ php spark serve
```

## Related Projects for CodeIgniter 4.x

- [CodeIgniter 3 to 4 Upgrade Helper](https://github.com/kenjis/ci3-to-4-upgrade-helper)
- [CodeIgniter4 Application Template](https://github.com/kenjis/ci4-app-template)
- [CodeIgniter3-like Captcha](https://github.com/kenjis/ci3-like-captcha)
