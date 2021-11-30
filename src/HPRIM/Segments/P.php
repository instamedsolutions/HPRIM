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
        // HOW TO BUILD A SEGMENT PATIENT ?
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
        /*
        $this->setField(5, 'SANDRO^FERRARI');
        $this->setField(6, '20/03/1994');
        $this->setField(7, 'M');
        $this->setField(9, '2500 HAMEAU PREVERT ROUEN');
        $this->setField(11, 'tel');
        $this->setField(15, '175cm');
        $this->setField(16, '80Kg');
        $this->setField(17, 'base64imagePatient');
        */

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

    // GETTER AND SETTER OK IN P SEGMENT

    //SETTER FUNCTIONS
    public function setNameInP($value, int $position = 6)
    {
        return $this->setField($position, $value);
    }

    public function setBirthDateInP($value, int $position = 8)
    {
        return $this->setField($position, $value);
    }

    public function setSexeInP($value, int $position = 9)
    {
        return $this->setField($position, $value);
    }

    public function setAdresseInP($value, int $position = 10)
    {
        return $this->setField($position, $value);
    }

    public function setPhoneInP($value, int $position = 11)
    {
        return $this->setField($position, $value);
    }

    public function setSizeInP($value, int $position = 16)
    {
        return $this->setField($position, $value);
    }

    public function setWeightInP($value, int $position = 17)
    {
        return $this->setField($position, $value);
    }

    public function setImageInP($value, int $position = 18)
    {
        return $this->setField($position, $value);
    }

    //GETTER FUNCTIONS
    public function getNameInP(int $position = 6)
    {
        return $this->getField($position);
    }

    public function getBirthDateInP(int $position = 8)
    {
        return $this->getField($position);
    }

    public function getSexeInP(int $position = 9)
    {
        return $this->getField($position);
    }

    public function getAdresseInP(int $position = 10)
    {
        return $this->getField($position);
    }

    public function getPhoneInP(int $position = 11)
    {
        return $this->getField($position);
    }

    public function getSizeInP(int $position = 16)
    {
        return $this->getField($position);
    }

    public function getWeightInP(int $position = 17)
    {
        return $this->getField($position);
    }

    public function getImageInP(int $position = 18)
    {
        return $this->getField($position);
    }
}
