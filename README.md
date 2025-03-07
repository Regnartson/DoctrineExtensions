DoctrineExtensions
==================

A set of extensions to Doctrine 2 that add support for functions available in
MsSQL, MySQL, Oracle, PostgreSQL and SQLite.

| DB | Functions |
|:--:|:---------:|
| MsSQL | `ADDTIME, CAST, CONVERT_TZ, COUNTIF, DATE, DATE_FORMAT, DATEADD, DATEDIFF, DAY, DAYNAME, DAYOFWEEK, DAYOFYEAR, EXTRACT, FROM_UNIXTIME, GREATEST, HOUR, IFELSE, IFNULL, INET_ATON, INET_NTOA, INET6_ATON, INET6_NTOA, INSTR, IS_IPV4, IS_IPV4_COMPAT, IS_IPV4_MAPPED, IS_IPV6, LAST_DAY, LEAST, MINUTE, MONTH, MONTHNAME, NOW, PERIOD_DIFF, QUARTER, SECOND, SECTOTIME, STRTODATE, STR_TO_DATE, TIME, TIMEDIFF, TIMESTAMPADD, TIMESTAMPDIFF, TIMETOSEC, UNIX_TIMESTAMP, UTC_TIMESTAMP, WEEK, WEEKDAY, YEAR, YEARMONTH, YEARWEEK` |
| MySQL | `ACOS, ADDTIME, AES_DECRYPT, AES_ENCRYPT, ANY_VALUE, ASCII, ASIN, ATAN, ATAN2, BINARY, BIT_COUNT, BIT_XOR, CAST, CEIL, CHAR_LENGTH, COLLATE, CONCAT_WS, CONVERT_TZ, COS, COT, COUNTIF, CRC32, DATE, DATE_FORMAT, DATEADD, DATEDIFF, DATESUB, DAY, DAYNAME, DAYOFWEEK, DAYOFYEAR, DEGREES, DIV, EXP, EXTRACT, FIELD, FIND_IN_SET, FLOOR, FORMAT, FROM_UNIXTIME, GREATEST, GROUP_CONCAT, HEX, HOUR, IFELSE, IFNULL, INET_ATON, INET_NTOA, INET6_ATON, INET6_NTOA, INSTR, IS_IPV4, IS_IPV4_COMPAT, IS_IPV4_MAPPED, IS_IPV6, LAST_DAY, LEAST, LOG, LOG10, LOG2, LPAD, MAKEDATE, MATCH, MD5, MINUTE, MONTH, MONTHNAME, NOW, NULLIF, PERIOD_DIFF, PI, POWER, QUARTER, RADIANS, RAND, REGEXP, REPLACE, ROUND, RPAD, SECOND, SECTOTIME, SHA1, SHA2, SIN, SOUNDEX, STD, STDDEV, STRTODATE, STR_TO_DATE, SUBSTRING_INDEX, TAN, TIME, TIMEDIFF, TIMESTAMPADD, TIMESTAMPDIFF, TIMETOSEC, UNHEX, UNIX_TIMESTAMP, UTC_TIMESTAMP, UUID_SHORT, VARIANCE, WEEK, WEEKDAY, YEAR, YEARMONTH, YEARWEEK` |
| Oracle | `DAY, LISTAGG, MONTH, NVL, TO_CHAR, TO_DATE, TRUNC, YEAR` |
| Sqlite | `DATE, MINUTE, HOUR, DAY, WEEK, WEEKDAY, MONTH, YEAR, JULIANDAY, STRFTIME, DATE_FORMAT*, CASE WHEN THEN ELSE END, IFNULL, REPLACE, ROUND` |
| PostgreSQL | `DATE_PART, GREATEST, LEAST, COUNT_FILTER, STRING_AGG, TO_DATE, TO_CHAR, AT_TIME_ZONE` |

> Note: Sqlite date functions are implemented as `strftime(format, value)`.
  Sqlite only supports the [most common formats](https://www.sqlite.org/lang_datefunc.html),
  so `date_format` will convert the mysql substitutions to the closest available sqlite substitutions.
  This means `date_format(field, '%b %D %Y') -> Jan 1st 2015` becomes `strftime('%m %d %Y', field) -> 01 01 2015`.

Installation
------------

To install this library, run the command below and you will get the latest
version:

```
composer require regnartson/doctrineextensions
```

If you want to run phpunit:

```
make test
```

If you want to run php-cs-fixer:

```sh
make fix  # (or make lint for a dry-run)
```

Usage
-----

If you are using DoctrineExtensions with Symfony read [How to Register custom DQL Functions](https://symfony.com/doc/current/doctrine/custom_dql_functions.html).

You can find example Symfony configuration for using DoctrineExtensions custom DQL functions in [config](config).

If you are using DoctrineExtensions standalone, you might want to fire up the autoloader:

```php
<?php

$classLoader = new \Doctrine\Common\ClassLoader('DoctrineExtensions', '/path/to/extensions');
$classLoader->register();
```
For more information check out the documentation of [Doctrine DQL User Defined Functions](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/cookbook/dql-user-defined-functions.html).

Notes
-----

- MySQL `DATE_ADD` is available in DQL as `DATEADD(CURRENT_DATE(), 1, 'DAY')`
- MySQL `DATE_SUB` is available in DQL as `DATESUB(CURRENT_DATE(), 1, 'DAY')`
- MySQL `IF` is available in DQL as `IFELSE(field > 0, 'true', 'false')`
