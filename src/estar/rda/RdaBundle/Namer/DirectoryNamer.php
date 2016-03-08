<?php

namespace estar\rda\RdaBundle\Namer;

use estar\rda\RdaBundle\Entity\Richiestadocumentolibero;
use Vich\UploaderBundle\Naming\DirectoryNamerInterface;
use Vich\UploaderBundle\Mapping\PropertyMapping;
/**
 * DirectoryNamer class.
 */
class DirectoryNamer implements DirectoryNamerInterface
{
    public function directoryName($obj, PropertyMapping  $field) {
        $idRich = $obj->getIdrichiesta();
        if ($obj instanceof Richiestadocumento)
            $idDoc = $obj->getIddocumento();
        else
            $idDoc = "libero".$obj->getId();
        return $upload = 'Richiesta_'.$idRich;
    }
}