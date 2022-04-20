# Laravel SQL Logger 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lobotomised/laravel-sql-logger.svg?style=flat-square)](https://packagist.org/packages/lobotomised/laravel_sql_logger)
[![GitHub Tests Action Status](https://github.com/lobotomised/laravel_sql_logger/actions/workflows/test.yml/badge.svg)](https://github.com/lobotomised/laravel_sql_logger/actions/workflows/test.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/lobotomised/laravel_sql_logger.svg?style=flat-square)](https://packagist.org/packages/lobotomised/laravel_sql_logger)

This package allows you to log all your SQL queries in a log file

## Installation
You can install the package via composer

```bash
composer require --dev lobotomised/laravel_sql_logger
```
By default, no query is log. Logging will be enabled when `DB_DEBUG` is `true`. 

## Testing

```bash
composer test
```
