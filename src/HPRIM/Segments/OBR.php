<?php

namespace Akarah\HPRIM\Segments;

use Akarah\HPRIM\Segment;

/**
 * OBR (Patient ID) HPRIM segment class

 */
class OBR extends Segment
{
    /**
     * Create an instance of the OBR segment.
     *
     * If an array argument is provided, all fields will be filled from that array. Note that for composed fields and
     * sub-components, the array may hold sub-arrays and sub-sub-arrays. If the reference is not given, the MSH segment
     * will be created with the MSH 1,2,7,10 and 12 fields filled in for convenience.
     *
     * @param null|array $fields
     * @param null|array $hl7Globals
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public function __construct(array $fields = null, array $hprimGlobals = null)
    {

        // http://interopsante.org/offres/doc_inline_src/412/HPsante24-modif%5B0%5D.pdf
        //0 : Header : OBR
        //1 : Rang ( 1 )
        //2 : 1234
        //3 : F
        //4 : F
        //5 : Analyse ou acte
        //6 : Priorité (F )
        //7 : Datetime du rendez-vous
        //8 : F datetime prelevement
        //9 : F datetime fin prelevement
        //10 : F 
        //11 : F
        //12 : Code Action
        //13 : Risque F
        //17 : ( F ) Prescripteur

        parent::__construct('OBR', $fields); // HEADER of sequency
        
        $this->setField(1, '1');       // Rang
        $this->setField(2, '1234'); // id echantillon
        //$this->setField(5, 'Urgency'); 
        //$this->setField(7, 'DateTimeRDV');
        $this->setField(12, 'ACTIO');
        //$this->setField(17, 'prescripteur');

        if (isset($fields)) {
            return;
        }
    }

    /**
     * Set the field specified by index to value.
     *
     * Indices start at 1, to stay with the HL7 standard. Trying to set the value at index 0 has no effect. Setting the
     * value on index 1, will effectively change the value of FIELD_SEPARATOR for the message containing this segment,
     * if the value has length 1; setting the field on index 2 will change the values of COMPONENT_SEPARATOR,
     * REPETITION_SEPARATOR, ESCAPE_CHARACTER and SUBCOMPONENT_SEPARATOR for the message, if the string is of length 4.
     *
     * @param int $index Index of field
     * @param string $value
     * @return bool
     * @access public
     */
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

    //GETTER AND SETTER : OK FOR OBR SEQUENCY


    //SETTER FUNCTIONS
    public function setIdSequencyInOBR($value, int $position = 2)
    {
        return $this->setField($position, $value);
    }

    public function setTypeAppointmentInOBR($value, int $position = 5)
    {
        return $this->setField($position, $value);
    }

    public function setAppointmentTimeInOBR($value, int $position = 7)
    {
        return $this->setField($position, $value);
    }

    public function setActionCodeInOBR($value, int $position = 12)
    {
        return $this->setField($position, $value);
    }

    public function setPrescriptorInOBR($value, int $position = 17)
    {
        return $this->setField($position, $value);
    }

    //GETTER FUNCTIONS
    public function getIdSequencyInOBR(int $position = 2)
    {
        return $this->getField($position);
    }

    public function getTypeAppointmentInOBR(int $position = 5)
    {
        return $this->getField($position);
    }

    public function getAppointmentTimeInOBR(int $position = 7)
    {
        return $this->getField($position);
    }

    public function getActionCodeInOBR(int $position = 12)
    {
        return $this->getField($position);
    }

    public function getPrescriptorInOBR(int $position = 17)
    {
        return $this->getField($position);
    }
}
