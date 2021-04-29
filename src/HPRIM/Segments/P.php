<?php

namespace Akarah\HPRIM\Segments;

use Akarah\HPRIM\Segment;

/**
 * P ( Patient ID) HPRIM segment class
*/
class P extends Segment
{
    /**
     *
     * @param null|array $fields
     * @param null|array $hl7Globals
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public function __construct(array $fields = null, array $hprimGlobals = null)
    {
        // HOW TO BUILD A SEGMENT PATIENT
        //0 : Header type : P
        //1 : 1
        //2 : F
        //3 F
        //4 F
        //5 Nom^NomFamille 
        //6 BirthDate
        //7 : Sexe ( M or F)
        //8 : F
        //9 Adresse
        //10 : F
        //11 : téléphone
        //12 : F
        //13 : F
        //14 : F 
        //15 : Taille
        //16 : Poids
        //17 : Comment

        parent::__construct('P', $fields);
        $this->setField(1, '1');

        if (isset($fields)) {
            return;
        }
    }

    public function setField(int $index, $value = ''): bool
    {
        if (($index === 1) && strlen($value) !== 1) {
            return false;
        }
        if (($index === 2) && strlen($value) !== 4) {
            return false;
        }

        return parent::setField($index, $value);
    }
}
