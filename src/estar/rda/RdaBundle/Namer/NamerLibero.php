<?php

namespace estar\rda\RdaBundle\Namer;

use Vich\UploaderBundle\Naming\NamerInterface;
use Vich\UploaderBundle\Mapping\PropertyMapping;
/**
 * Namer class.
 */
class NamerLibero implements NamerInterface
{
    /**
     * Creates a name for the file being uploaded.
     *
     * @param object $obj The object the upload is attached to.
     * @param string $field The name of the uploadable field to generate a name for.
     * @return string The file name.
     */
    function name($obj, PropertyMapping $field)
    {
        $file = $obj->docFile;
        //$extension = $file->guessExtension();
        $idRich = $obj->getIdrichiesta();
        $idDoc = $obj->getId();
        //return 'Richiesta_'.$idRich.'_Documento_'.$idDoc.'.'.$extension;
        return 'Richiesta_'.$idRich.'_Documento_'.$idDoc;
    }
}