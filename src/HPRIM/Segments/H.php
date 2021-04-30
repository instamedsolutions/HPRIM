<?php

namespace Akarah\HPRIM\Segments;

use Akarah\HPRIM\Segment;
use DateTime;

/**
 * H (message header) HPRIM segment class
 *
 * Usage:
 * ```php
 * $seg = new MSH();
 *
 * $seg->setField(9, "ADT^A24");
 * echo $seg->getField(1);
 * ```
 * Reference: http://interopsante.org/offres/doc_inline_src/412/HPsante24-modif%5B0%5D.pdf
 */
class H extends Segment
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
        //TODO: Build default sequency
        //TODO: Setter function

        // HOW TO BUILD A H SEGMENT ? 
        //0 : Header : H
        //1 : Definition des séparateurs '^~\\&'
        //2 : F ( Nom de fichier)
        //3 : F ( password)
        //4 : Id émétteur
        //5 : Message envoyé ( F)
        //6 : 'Table HPRIM 1
        //7 : Phone
        //8 : F 
        //9 : Id récépteur
        //10 : F ( comments )
        //11 : F
        //12 : Version HPRIM
        //13 : Message Time 

        parent::__construct('H', $fields);
        $this->setField(2, '^~\\&');
        $this->setField(4, '556859874');
        $this->setField(5, 'ADM');
        $this->setField(6, 'TABLE HPRIM 1');
        $this->setField(9, '98745968422');
        $this->setField(12, '1.2');
        $date = new DateTime();
        $this->setField(13, $date->format('Y-m-d H:i:s'));

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

    
    //SETTER FUNCTIONS 
    public function setDateTimeOfMessage($value, int $position = 7)
    {
        return $this->setField($position, $value);
    }

    //GETTER FUNCTIONS
    public function getDateTimeOfMessage(int $position = 7)
    {
        return $this->getField($position);
    }

    /**
     * Get HL7 version, e.g. 2.1, 2.3, 3.0 etc.
     * @param int $position
     * @return array|null|string
     */
    public function getVersionId(int $position = 12)
    {
        return $this->getField($position);
    }
}
