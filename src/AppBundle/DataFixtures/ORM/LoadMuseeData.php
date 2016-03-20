<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Musee;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadMuseeData implements FixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $url="http://opendata.paris.fr/explore/dataset/liste-musees-de-france-a-paris/download/?format=json&timezone=Europe/Berlin";
        $contents = file_get_contents($url);
        $contents = utf8_encode($contents);
        $json = json_decode($contents, true);

        foreach ($json as $object)
        {
            $fields = $object['fields'];
            if (isset($fields['coordonnees_']) && isset($fields['fermeture_annuelle']))
            {
                $musee = new Musee();
                $musee->setNom($fields['nom_du_musee']);
                $musee->setCoordonnees($fields['coordonnees_']);
                $musee->setAdresse($fields['adr']);
                $musee->setCodePostal($fields['cp']);
                $musee->setVille($fields['ville']);
                $musee->setSiteWeb($fields['sitweb']);
                $musee->setStatut($fields['ferme'] !== 'NON');
                $musee->setReouverture($fields['periode_ouverture']);
                $musee->setFermetureAnnuelle($fields['fermeture_annuelle']);
                $musee->setPeriodesOuverture($fields['periode_ouverture']);

                $manager->persist($musee);
            }
        }

        $manager->flush();
    }
}