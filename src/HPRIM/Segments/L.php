<?php

namespace Akarah\HPRIM\Segments;

use Akarah\HPRIM\Segment;

/**
 * L (Patient ID) HPRIM segment class

 */
class L extends Segment
{
    /**
     * Create an instance of the MSH segment.
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
        //0 : Header : H
        //1 : Definition des séparateurs
        //2 : 

        parent::__construct('L', $fields); // HEADER of sequency
        $this->setField(1, '1');       // Set Separator
        //$this->setField(2, 'L');       // Set Separator
        //$this->setField(2, '1');       // Set Separator

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
}
