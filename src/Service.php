<?php


namespace App;


use App\Entity\BetInstinct\Association;
use App\Entity\BetInstinct\Athlete;
use App\Entity\BetInstinct\Bet;
use App\Entity\BetInstinct\Classement;
use App\Entity\BetInstinct\TypedePari;
use App\Repository\BetInstinct\AthleteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Service extends AbstractController
{


    public static function Archivage($entities, EntityManagerInterface $entityManager)
    {
        foreach ($entities as $a) {
            if (get_class($a) == "App\Entity\BetInstinct\Affiche") {
                $s = strtotime($a->getSchedule()->format('d-m-Y'));
                $date = new \DateTime('now');
                $today = strtotime($date->format('d-m-Y'));
                $ecart = $today - $s;
                $ecartype = intval(round($ecart / 60 / 60 / 24));
                if ($ecartype > 10) {
                    $a->setArchived(1);
                    $entityManager->flush();
                }
            } elseif (get_class($a) == "App\Entity\BetInstinct\Pronostic") {
                $s = strtotime($a->getCreated()->format('d-m-Y'));
                $date = new \DateTime('now');
                $today = strtotime($date->format('d-m-Y'));
                $ecart = $today - $s;
                $ecartype = intval(round($ecart / 60 / 60 / 24));
                if ($ecartype > 7) {
                    $a->setArchived(1);
                    $entityManager->flush();
                }
            } else {
                $s = strtotime($a->getCreated()->format('d-m-Y'));
                $date = new \DateTime('now');
                $today = strtotime($date->format('d-m-Y'));
                $ecart = $today - $s;
                $ecartype = intval(round($ecart / 60 / 60 / 24));
                if ($ecartype > 9) {
                    $a->setIsArchived(1);
                    $entityManager->flush();
                }
            }

        }
    }

    public static function checkAthlete($athlete, AthleteRepository $athleteRepository)
    {
        $checkathlete = $athleteRepository->findBy(['nom' => $athlete->getNom(), 'genre' => $athlete->getGenre()]);
        return $checkathlete;
    }

    public static function createRanking(Athlete $athlete, $associationId, Classement $ranking, EntityManagerInterface $entityManager)
    {
        // $last = $this->getDoctrine()->getRepository(\App\Entity\BetInstinct\Classement::class)->findOneBy([], ['id' => 'desc']);
        $last = $entityManager->getRepository(Classement::class)->findOneBy([], ['id' => 'desc']);
        $rank = $last->getRanking() + 1;
        $association = $entityManager->getRepository(Association::class)->find($associationId);
        $ranking->setAssociation($association);
        $ranking->setJoueur($athlete);
        $ranking->setRanking($rank + 1);
    }

    public static function ecartGagnant($affiche, EntityManagerInterface $entityManager, $t)
    {

        $bet = new bet();
        $bet->setAffiche($affiche);
        $type = $entityManager->getRepository(TypedePari::class)->find($t);
        $bet->setTypedePari($type);
        $bet->setCote1(4.41);
        $bet->setCote2(3.75);
        $bet->setCote3(6.01);
        $bet->setCote4(7.25);
        $bet->setCote5(11.01);
        $bet->setCote6(12.01);
        $bet->setCote7(6.25);
        $bet->setCote8(7.51);
        $bet->setCote9(13.01);
        $bet->setCote10(23.01);
        $bet->setCote11(46.01);
        $bet->setCote12(60.01);

        return $bet;
    }

    public static function nbPoints($affiche, EntityManagerInterface $entityManager, $t)
    {

        $bet = new bet();
        $bet->setAffiche($affiche);
        $type = $entityManager->getRepository(TypedePari::class)->find($t);
        $bet->setTypedePari($type);
        $bet->setCote1(1.96);
        $bet->setCote2(1.24);
        $bet->setCote3(1.31);
        $bet->setCote4(1.38);
        $bet->setCote5(1.48);
        $bet->setCote6(1.52);
        $bet->setCote7(1.58);
        $bet->setCote8(1.64);
        $bet->setCote9(1.78);
        $bet->setCote10(1.86);
        $bet->setCote11(1.94);
        $bet->setCote12(2.01);
        $bet->setCote13(2.11);
        $bet->setCote14(2.21);
        $bet->setCote15(2.45);
        $bet->setCote16(2.45);
        $bet->setCote17(2.85);
        $bet->setCote18(3.25);
        $bet->setCote19(1.21);
        $bet->setCote20(1.26);
        $bet->setCote21(1.32);
        $bet->setCote22(1.39);
        $bet->setCote23(1.45);
        $bet->setCote24(1.52);
        $bet->setCote25(1.62);
        $bet->setCote26(1.72);
        $bet->setCote27(1.72);
        $bet->setCote28(1.85);
        $bet->setCote29(1.97);
        $bet->setCote30(2.02);
        $bet->setCote31(2.22);
        $bet->setCote32(2.61);
        $bet->setCote33(2.75);
        $bet->setCote34(2.95);
        $bet->setCote35(3.11);
        $bet->setCote36(3.51);

        return $bet;
    }

    public static function vainqueur($affiche, EntityManagerInterface $entityManager, $t)
    {
        $bet = new bet();

        $bet->setAffiche($affiche);
        $type = $entityManager->getRepository(TypedePari::class)->find($t);
        $bet->setTypedePari($type);
        $bet->setCote1($affiche->getCoteFavorite());
        $bet->setCote2($affiche->getCoteOutsider());

        return $bet;
    }

    public static function total3points($affiche, EntityManagerInterface $entityManager, $t)
    {
        $bet = new bet();

        $bet->setAffiche($affiche);
        $type = $entityManager->getRepository(TypedePari::class)->find($t);

        $bet->setTypedePari($type);
        $bet->setCote1(1.71);
        $bet->setCote2(1.91);

        return $bet;
    }
}

