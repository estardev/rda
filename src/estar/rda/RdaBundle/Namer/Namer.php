<?php

namespace estar\rda\RdaBundle\Namer;

use Vich\UploaderBundle\Naming\NamerInterface;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use estar\rda\RdaBundle\Entity\Richiestadocumento;
use estar\rda\RdaBundle\Entity\Richiestadocumentolibero;
/**
 * Namer class.
 */
class Namer implements NamerInterface
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
        if ($obj instanceof Richiestadocumento)
            $file = $obj->docFile;
        else
            $file = $obj->getImageFile();
        $extension = $file->guessExtension();
        $idRich = $obj->getIdrichiesta();
        if ($obj instanceof Richiestadocumento)
            $idDoc = $obj->getIddocumento();
        else
            $idDoc = "libero".substr(md5(rand()), 0, 7);
        return 'Richiesta_'.$idRich.'_Documento_'.$idDoc.'.'.$extension;
    }
}