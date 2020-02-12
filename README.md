# php-project-lvl2
[![Build Status](https://travis-ci.org/zxz112/php-project-lvl2.svg?branch=master)](https://travis-ci.org/zxz112/php-project-lvl2)
[![Maintainability](https://api.codeclimate.com/v1/badges/5130058adfa858d5d7ff/maintainability)](https://codeclimate.com/github/zxz112/php-project-lvl2/maintainability)
Utility to find difference between files.
Install:
  composer global require ilyavvv/php-project-lvl2
  
Render types:
  pretty
  plain
  json
  
Data type:
  json
  yaml
  
Example usage:
  $ gendiff --format plain before.json after.json
{
  - timeout: 20
  + timeout: 50
  - verbose: true
    host: hexlet.io
  + proxy: 123.234.53.22
}

gendiff --format plain before.json after.json

Property 'timeout' was changed. From: '20' to '50'
Property 'verbose' was removed
Property 'proxy' was added with value :'123.234.53.22'i

$ gendiff --format json after.json before.json
[{"type":"changed","key":"timeout","oldValue":20,"newValue":50},{"type":"deleted","key":"verbose","value":true},{"type":"not changed","key":"host","value":"hexlet.io"},{"type":"added","key":"proxy","value":"123.234.53.22"}]
 
