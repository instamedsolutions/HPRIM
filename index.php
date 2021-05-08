<?php
require 'vendor/autoload.php';

/*
* This file is used for print example of HPRIM message
*/

use Akarah\HL7\Message as HL7Message;
use Akarah\HPRIM\Segments\OBR;
use Akarah\HPRIM\Message;
use Akarah\HPRIM\Segments\C;
use Akarah\HPRIM\Segments\H;
use Akarah\HPRIM\Segments\L;
use Akarah\HPRIM\Segments\P;

$msg = new Message();
$headerSequencyH = new H();
$patientIDP = new P();
$endSequencyL = new L();


echo 'ADM : Patient admission <br/><br/> ';
/************************* */
// ADM Sequency

$msg->addSegment($headerSequencyH);
$msg->addSegment($patientIDP);
$msg->addSegment($endSequencyL);

echo nl2br($msg->toString(true) );

echo '<br/><br/>ORU : Appointment <br/><br/> ';


/************************* */
// ORA Sequency : Appointment


$msg2 = new Message();

$headerSequencyH = new H();
$patientIDP = new P();
$patientIDP->setPhoneInP('0235282525');
$appointmentOBR = new OBR(); 
$CommenttoAppointment = new C();
$endSequencyL = new L();

$msg2->addSegment($headerSequencyH);
$msg2->addSegment($patientIDP);
$msg2->addSegment($appointmentOBR);
$msg2->addSegment($CommenttoAppointment);
$msg2->addSegment($endSequencyL);

echo nl2br($msg2->toString(true) );


/**************EXAMPLE SEQUENCE******************** */

echo '<br/><br/><br/>';
echo 'Trame Exemple';
echo '<br/>';

$exemple = 'H||^~\&||111111|ORX|TABLE HPRIM 1|||222222|||1.2|2021-05-05 13:25:08|<br/>
        P|1||||Waelchi^Landen|2016-01-21|F||addr||02||||41|37|img|<br/>
        OBR|1|1234|||Emergency||1937-02-06 05:42:32|||||ACTIO|||||CH belvedere|<br/>
        C|1||img|1|<br/>
        L|1|<br/>';


echo '<br/>Parsing example <br/>';


echo $exemple;


/************************************************* */

// HOW TO PARSE A MESSAGE ? 
//$msg = new Message($msg2->toString(true)); // Real message 

$msg = new Message($exemple); // String, used in dataservice

echo '<br/><br/>';
echo 'Nombre de segment : ' . count($msg->getSegments());
echo '<br/><br/>';
echo $msg->segmentToString($msg->getSegments()[0]);
echo '<br/>';
echo $msg->segmentToString($msg->getSegments()[1]);
echo '<br/>';
echo $msg->segmentToString($msg->getSegments()[2]);
echo '<br/>';
echo $msg->segmentToString($msg->getSegments()[3]);
echo '<br/>';
echo $msg->segmentToString($msg->getSegments()[4]);

echo '<br/><br/>';

if ($msg->hasSegment('H')){
    echo($msg->getSegmentsByName('H')[0]->getIdTransmitterInH());
    echo($msg->getSegmentsByName('H')[0]->getIdReceiverInH());
}

echo '<br/><br/>';

if ($msg->hasSegment('P')){
    echo('P birthDate : '. $msg->getSegmentsByName('P')[0]->getBirthDateInP() . '<br/>');
    echo('P sexe : '. $msg->getSegmentsByName('P')[0]->getSexeInP() . '<br/>');
    echo('P adresse : '. $msg->getSegmentsByName('P')[0]->getAdresseInP() . '<br/>');
    echo('P phone : '. $msg->getSegmentsByName('P')[0]->getPhoneInP() . '<br/>');
    echo('P size : '. $msg->getSegmentsByName('P')[0]->getSizeInP() . '<br/>');
    echo('P weight : '. $msg->getSegmentsByName('P')[0]->getWeightInP() . '<br/>');
    echo('P image  : '. $msg->getSegmentsByName('P')[0]->getImageInP() . '<br/>');
    echo('P firstname : '.  $msg->getSegmentsByName('P')[0]->getNameInP()[0] . '<br/>');
    echo('P lastname : '. $msg->getSegmentsByName('P')[0]->getNameInP()[1] . '<br/>');
}

echo '<br/><br/>';

if ($msg->hasSegment('OBR')){
    echo('OBR idSequency : ' . $msg->getSegmentsByName('OBR')[0]->getIdSequencyInOBR() . '<br/>');
    echo('OBR typeAppointment : ' . $msg->getSegmentsByName('OBR')[0]->getTypeAppointmentInOBR() . '<br/>');
    echo('OBR appointment Time : ' . $msg->getSegmentsByName('OBR')[0]->getAppointmentTimeInOBR() . '<br/>');
    echo('OBR ActionCode : ' . $msg->getSegmentsByName('OBR')[0]->getActionCodeInOBR() . '<br/>');
    echo('OBR prescripteur : ' . $msg->getSegmentsByName('OBR')[0]->getPrescriptorInOBR() . '<br/>');
}

echo '<br/><br/>';

if ($msg->hasSegment('C')){
    echo('C MediaName : ' . $msg->getSegmentsByName('C')[0]->getMediaNameInC() . '<br/>');
    echo('C MediaContent : ' . $msg->getSegmentsByName('C')[0]->getMediaContentInC() . '<br/>');
}

echo '<br/><br/>';
/*
if ($msg->hasSegment('L')){
    echo($msg->getSegmentsByName('L')[0]);
}
*/


?>