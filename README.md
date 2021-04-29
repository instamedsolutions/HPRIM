<p align="center">
<a href="https://travis-ci.org/senaranya/HL7"><img src="https://travis-ci.org/senaranya/HL7.svg?branch=master" alt="Build Status"></a>
<a href="https://packagist.org/packages/Akarah/hl7"><img src="https://poser.pugx.org/Akarah/hl7/downloads" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/Akarah/hl7"><img src="https://poser.pugx.org/Akarah/hl7/v/stable" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/Akarah/hl7"><img src="https://poser.pugx.org/Akarah/hl7/license" alt="License"></a>
</p>

**Important: Supported PHP version has been updated to 7.3+. Last supported versions: for PHP 7.2 => [2.0.2](https://github.com/senaranya/HL7/tree/2.0.2), for PHP 7.0 or 7.1 => [1.5.4](https://github.com/senaranya/HL7/tree/1.5.4)**

## Introduction

A PHP-based HPRIM v2.x Parsing and Generating library, inspired by Net-HL7 package (perl).

## Installation

```bash
composer require Akarah/hprim
```

## Usage
### Import library
```php
// First, import classes from the library as needed...
use Akarah\HPRIM\Message;
use Akarah\HPRIM\Segment;
use Akarah\HPRIM\Segments\MSH;
```

### Parsing
```php
// Create a Message object from a HL7 string
$msg = new Message("MSH|^~\\&|1|\rPID|||abcd|\r"); // Either \n or \r can be used as segment endings
$P = $msg->getSegmentByIndex(1);
echo $pid->getField(3); // prints 'John'
echo $msg->toString(true); // Prints entire HPRIM string

// Get the first segment
$msg->getFirstSegmentInstance('H'); // Returns the first PID segment. Same as $msg->getSegmentsByName('PID')[0];

// Check if a segment is present in the message object
$msg->hasSegment('P'); // return true or false based on whether PID is present in the $msg object

// Check if a message is empty
$msg = new Message();
$msg->isempty(); // Returns true
```

### Creating new messages
```php
// Create an empty Message object, and populate H and P segments... 
```


### Other 

Visit [docs\README](docs/README.md) for details on available APIs

- All HPRIM message beginning with H segment
- All HPIM message have L segment at end
