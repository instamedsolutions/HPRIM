<?php
require 'vendor/autoload.php';

/*
* This file is used for print example of HPRIM message
*/

use Akarah\HPRIM\Message;
use Akarah\HPRIM\Segments\H;
use Akarah\HPRIM\Segments\L;
use Akarah\HPRIM\Segments\P;

$msg = new Message();
$headerSequencyH = new H();
$patientIDP = new P();
$endSequencyL = new L();


// TODO: Segment P PatientIdentity

$msg->addSegment($headerSequencyH);
$msg->addSegment($patientIDP);
$msg->addSegment($endSequencyL);

echo nl2br($msg->toString(true) );


/**************EXAMPLE SEQUENCE******************** */


echo '<br/><br/><br/>';
echo '<br/><br/><br/>';
echo 'Trame Exemple';
echo '<br/><br/><br/>';

$exemple = 'H|~^\&|0.HPR||001~ORIGIN||ORU|||002~DESTINATION||P|H2.2~C|201301011200<br/>
P|1|01|02|02|JEAN~PIERRE||19500101|M||1 RUE DE LA PAIX~~PARIS~~75001|||||||||||||||~~UNIT<br/>
OBR|1||~001|AU~AU~L|R||201301011200||||N|||201301011200||UNIT~UNITE A~L<br/>
A|~UNIT~UNITE A~L|01 23 45 67 89|||||201301011200||ORIGIN|I<br/>
OBX|1|NM|AU~Acide urique~L|||µmol/L|||||I|||201301011200|BIOCH~80~AU~140~0~P<br/>
L|1<br/>';

echo '<br/><br/><br/>';
echo $exemple;

?>