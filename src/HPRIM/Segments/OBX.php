<?php

namespace Akarah\HPRIM\Segments;

use Akarah\HPRIM\Segment;

/**
 * OBX (Patient ID) HPRIM segment class

 */
class OBX extends Segment
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

        parent::__construct('OBX', $fields); // HEADER of sequency

        if (isset($fields)) {
            return;
        }
    }


    /**
     * @param int $position
     * @return array|string|null
     */
    public function getResults(int $position = 6)
    {
        return $this->getField(6);
    }



}
