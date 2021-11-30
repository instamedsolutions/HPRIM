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
composer require akarah/hprim
```

## Usage
### Import library
```php
// First, import classes from the library as needed...
use Akarah\HPRIM\Message;
use Akarah\HPRIM\Segment;
use Akarah\HPRIM\Segments\H;
use Akarah\HPRIM\Segments\P;
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

### Send messages to remote listeners

Side note: In order to run Connection you need to install PHP ext-sockets [https://www.php.net/manual/en/sockets.installation.php](https://www.php.net/manual/en/sockets.installation.php)

```php
$ip = '127.0.0.1'; // An IP
$port = '12001'; // And Port where a HL7 listener is listening
$message = new Message($hl7String); // Create a Message object from your HL7 string

// Create a Socket and get ready to send message. Optionally add timeout in seconds as 3rd argument (default: 10 sec)
$connection = new Connection($ip, $port);
$response = $connection->send($message); // Send to the listener, and get a response back
echo $response->toString(true); // Prints ACK from the listener
```
### ACK
Handle ACK message returned from a remote HL7 listener... 
```php
$ack = (new Connection($ip, $port))->send($message); // Send a HL7 to remote listener
$returnString = $ack->toString(true);
if (strpos($returnString, 'MSH') === false) {
    echo "Failed to send HL7 to 'IP' => $ip, 'Port' => $port";
}
$msa = $ack->getSegmentsByName('MSA')[0];
$ackCode = $msa->getAcknowledgementCode();
if ($ackCode[1] === 'A') {
    echo "Received ACK from remote\n";
}
else {
    echo "Received NACK from remote\n";
    echo "Error text: " . $msa->getTextMessage();
}
```
Create an ACK response from a given HL7 message:
```php
$msg = new Message("MSH|^~\\&|1|\rABC|1||^AAAA1^^^BB|", null, true);
$ackResponse = new ACK($msg);
```
Options can be passed while creating ACK object:
```php
$msg = new Message("MSH|^~\\&|1|\rABC|1||^AAAA1^^^BB|", null, true);
$ackResponse = new ACK($msg, null, ['SEGMENT_SEPARATOR' => '\r\n', 'HL7_VERSION' => '2.5']);
```

### Other 

Visit [docs\README](docs/README.md) for details on available APIs

- All HPRIM message beginning with H segment
- All HPIM message have L segment at end


All segment level getter/setter APIs can be used in two ways - 
* If a position index isn't provided as argument (1st argument for getters, 2nd for setters), a standard index is used.  
`$pid->setPatientName('John Doe')` -> Set patient name at position 5 as per HL7 v2.3 [standard](https://corepointhealth.com/resource-center/hl7-resources/hl7-pid-segment)  
`$pid->getPatientAddress()` -> Get patient address from standard 11th position


* To use a custom position index, provide it in the argument:  
`$pid->setPatientName('John Doe', 6)` -> Set patient name at 6th position in PID segment  
`$pid->getPatientAddress(12)` -> Get patient address from 12th position  

### Issues
Bug reports and feature requests can be submitted on the [Github Issue Tracker](https://github.com/senaranya/HL7/issues).

### Contributing
See [CONTRIBUTING.md](CONTRIBUTING.md) for information.
