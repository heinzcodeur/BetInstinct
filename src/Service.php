<?php


namespace App;


use App\Entity\BetInstinct\Affiche;
use App\Entity\BetInstinct\Association;
use App\Entity\BetInstinct\Athlete;
use App\Entity\BetInstinct\Bet;
use App\Entity\BetInstinct\Classement;
use App\Entity\BetInstinct\Formule;
use App\Entity\BetInstinct\Game;
use App\Entity\BetInstinct\Transaction;
use App\Entity\BetInstinct\TypedePari;
use App\Repository\BetInstinct\AthleteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Service extends AbstractController
{


    public static function Archivage($entities, EntityManagerInterface $entityManager)
    {
        foreach ($entities as $a) {
            //si entité de type Affiche
            if (get_class($a) == "App\Entity\BetInstinct\Affiche") {
                //on convertit la date du schedule en timestamp)
                $s = strtotime($a->getSchedule()->format('d-m-Y'));
                $date = new \DateTime('now');
                //on convertit la date actuel en timestamp)
                $today = strtotime($date->format('d-m-Y'));
                //on note lecart positif des deux dates en timestamp(secondes)
                $ecart = $today - $s;
                //on convertit l'écart en jours
                $ecartype = intval(round($ecart / 60 / 60 / 24));
                //si ecartype >1 on archive l'affiche
                if ($ecartype > 1) {
                    $a->setArchived(1);
                    $entityManager->flush();
                }
            } elseif (get_class($a) == "App\Entity\BetInstinct\Pronostic") {
                $s = strtotime($a->getCreated()->format('d-m-Y'));
                $date = new \DateTime('now');
                $today = strtotime($date->format('d-m-Y'));
                $ecart = $today - $s;
                $ecartype = intval(round($ecart / 60 / 60 / 24));
                if ($ecartype > 1) {
                    $a->setArchived(1);
                    $entityManager->flush();
                }
            } else {
                $s = strtotime($a->getCreated()->format('d-m-Y'));
                $date = new \DateTime('now');
                $today = strtotime($date->format('d-m-Y'));
                $ecart = $today - $s;
                $ecartype = intval(round($ecart / 60 / 60 / 24));
                if ($ecartype > 1) {
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

    public static function createRanking(Athlete $athlete, $associationId, EntityManagerInterface $entityManager)
    {
        $ranking = new Classement();
        // $last = $this->getDoctrine()->getRepository(\App\Entity\BetInstinct\Classement::class)->findOneBy([], ['id' => 'desc']);
        $last = $entityManager->getRepository(Classement::class)->findOneBy([], ['id' => 'desc']);
        $rank = $last->getRanking() + 1;
        $association = $entityManager->getRepository(Association::class)->find($associationId);
        $ranking->setAssociation($association);
        $ranking->setJoueur($athlete);
        $ranking->setRanking($rank + 1);

        return $ranking;
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

    public static function nbPoinstMitemps($affiche, EntityManagerInterface $entityManager, $t)
    {

        $bet = new bet();
        $bet->setAffiche($affiche);
        $type = $entityManager->getRepository(TypedePari::class)->find($t);
        $bet->setTypedePari($type);
        $bet->setCote1(1.34);
        $bet->setCote2(2.41);
        $bet->setCote3(1.41);
        $bet->setCote4(2.21);
        $bet->setCote5(1.47);
        $bet->setCote6(2.05);
        $bet->setCote7(1.54);
        $bet->setCote8(1.91);
        $bet->setCote9(1.62);
        $bet->setCote10(1.78);
        $bet->setCote11(1.72);
        $bet->setCote12(1.68);
        $bet->setCote13(1.84);
        $bet->setCote14(1.58);
        $bet->setCote15(1.96);
        $bet->setCote16(1.51);
        $bet->setCote17(2.11);
        $bet->setCote18(1.44);
        $bet->setCote19(2.25);
        $bet->setCote20(1.38);
        $bet->setCote21(2.45);
        $bet->setCote22(1.32);

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

    public static function nbPointsQT1($affiche, EntityManagerInterface $entityManager, $t)
    {

        $bet = new bet();

        $bet->setAffiche($affiche);
        $type = $entityManager->getRepository(TypedePari::class)->find($t);

        $bet->setTypedePari($type);
        $bet->setCote1(1.39);
        $bet->setCote2(2.21);
        $bet->setCote3(1.52);
        $bet->setCote4(1.96);
        $bet->setCote5(1.72);
        $bet->setCote6(1.68);
        $bet->setCote7(2.01);
        $bet->setCote9(1.51);
        $bet->setCote9(2.35);
        $bet->setCote9(1.35);

        return $bet;
    }

    public static function nbPointsEquipeAmitemps($affiche, EntityManagerInterface $entityManager, $t)
    {

        $bet = new bet();

        $bet->setAffiche($affiche);
        $type = $entityManager->getRepository(TypedePari::class)->find($t);

        $bet->setTypedePari($type);
        $bet->setCote1(1.44);
        $bet->setCote2(2.10);
        $bet->setCote3(1.56);
        $bet->setCote4(1.88);
        $bet->setCote5(1.72);
        $bet->setCote6(1.68);
        $bet->setCote7(1.92);
        $bet->setCote9(1.54);
        $bet->setCote9(2.15);
        $bet->setCote9(1.43);

        return $bet;
    }

    public static function nbPointsEquipeBmitemps($affiche, EntityManagerInterface $entityManager, $t)
    {

        $bet = new bet();

        $bet->setAffiche($affiche);
        $type = $entityManager->getRepository(TypedePari::class)->find($t);

        $bet->setTypedePari($type);
        $bet->setCote1(1.44);
        $bet->setCote2(2.10);
        $bet->setCote3(1.56);
        $bet->setCote4(1.88);
        $bet->setCote5(1.72);
        $bet->setCote6(1.68);
        $bet->setCote7(1.92);
        $bet->setCote8(1.54);
        $bet->setCote9(2.15);
        $bet->setCote10(1.43);

        return $bet;
    }

    public static function premiereEquipe50points($affiche, EntityManagerInterface $entityManager, $t)
    {
        $bet = new bet();

        $bet->setAffiche($affiche);
        $type = $entityManager->getRepository(TypedePari::class)->find($t);

        $bet->setTypedePari($type);
        $bet->setCote1(2, 35);
        $bet->setCote2(1.39);

        return $bet;
    }

    public static function premiereEquipe40points($affiche, EntityManagerInterface $entityManager, $t)
    {
        $bet = new bet();

        $bet->setAffiche($affiche);
        $type = $entityManager->getRepository(TypedePari::class)->find($t);

        $bet->setTypedePari($type);
        $bet->setCote1(2, 35);
        $bet->setCote2(1.39);

        return $bet;
    }

    public static function premiereEquipe30points($affiche, EntityManagerInterface $entityManager, $t)
    {
        $bet = new bet();

        $bet->setAffiche($affiche);
        $type = $entityManager->getRepository(TypedePari::class)->find($t);

        $bet->setTypedePari($type);
        $bet->setCote1(2, 35);
        $bet->setCote2(1.39);

        return $bet;
    }

    public static function premiereEquipe20points($affiche, EntityManagerInterface $entityManager, $t)
    {
        $bet = new bet();

        $bet->setAffiche($affiche);
        $type = $entityManager->getRepository(TypedePari::class)->find($t);

        $bet->setTypedePari($type);
        $bet->setCote1(2, 35);
        $bet->setCote2(1.39);

        return $bet;
    }

    public static function mytimestamp(\DateTime $schedule)
    {
        $date = new \DateTime('now');
        $schedate = strtotime($schedule->format('d-m-Y'));
        $now = strtotime($date->format('d-m-Y'));
        $str = $now - $schedate;
        $value = 0;

        switch ($str) {
            case $str < 60:
                $value = 'minutes';
                break;
            case $str < 24:
                $value = 'heures';
                break;
            case $str > 24:
                $value = 'jours';
                break;
            default:
                $value = 'maintenant';
        }

        return $value;

    }


    public static function filterIndex(EntityManagerInterface $entityManager, $class, $operator = null, $field = null, $predicate = null)
    {

        $queryBuilder = $entityManager->createQueryBuilder();
        if ($operator != null) {
            //$alias='a';
            $queryBuilder->select('a')
                ->from($class, 'a')
                ->where('a.archived = 0')
                //->$operator($alias.'archived '.$predicate.' '.$value)
                ->orderBy('a.id', 'DESC');
        } else {
            $fieldphrase = $field != null ? '->where(a.archived = 0)' : '';
            $queryBuilder->select('a')
                ->from($class, 'a')
                ->where('a.archived = 0')
                ->orderBy('a.id', 'DESC');
        }
        $query = $queryBuilder->getQuery();
        $items = $query->getResult();

        return $items;

    }

    public static function dateString(\DateTime $date)
    {
        return $date->format('d-m-Y H:i:s');
    }

    public static function mise($banroll, $pourcentage)
    {
        $mise = ceil(($banroll * $pourcentage) / 100);
        return $mise;
    }

    public static function VainqueurNombre2points($affiche, EntityManagerInterface $entityManager, $t)
    {
        $bet = new bet();

        $bet->setAffiche($affiche);
        $type = $entityManager->getRepository(TypedePari::class)->find($t);

        $bet->setTypedePari($type);

        $bet->setCote1(2.81);
        $bet->setCote2(3.65);
        $bet->setCote3(2.85);
        $bet->setCote4(3.75);

        return $bet;
    }

    public static function premierQTresultat($affiche, EntityManagerInterface $entityManager, $t)
    {
        $bet = new bet();

        $bet->setAffiche($affiche);
        $type = $entityManager->getRepository(TypedePari::class)->find($t);

        $bet->setTypedePari($type);

        $bet->setCote1(1.61);
        $bet->setCote2(11.51);
        $bet->setCote3(2.05);

        return $bet;
    }

    public static function margeduvainqueur($affiche, EntityManagerInterface $entityManager, $t)
    {
        $bet = new bet();

        $bet->setAffiche($affiche);
        $type = $entityManager->getRepository(TypedePari::class)->find($t);

        $bet->setTypedePari($type);
        $bet->setCote1(2.45);
        $bet->setCote2(2.45);
        $bet->setCote3(4.01);
        $bet->setCote4(5.71);
        $bet->setCote5(10.01);
        $bet->setCote6(21.01);
        $bet->setCote7(35.01);

        return $bet;
    }

    public static function createSimpleGame($formule, $pronostic, $parieur, $cote, $mise)
    {

        $game = new Game();
        $game->setFormule($formule);
        $game->setName(Service::dateString(new \DateTime('now')));
        $game->addProno($pronostic);
        $game->setCreated(new \DateTimeImmutable('now'));
        $game->setParieur($parieur);
        $game->setCoteTotale($cote);
        $game->setFormule($formule);
        $game->setMise($mise);
        $game->setResultat('en attente');
        $game->setIsArchived(false);
        $game->setIsConfirm(true);


        return $game;
    }

    public static function createTransac($game)
    {

        $transac = new Transaction();
        $transac->setType('retrait');
        $transac->setMontant($game->getMise());
        $transac->setAuteur($game->getParieur());
        $transac->setCreatedAt(new \DateTimeImmutable('now'));

        //on met à jour le solde du parieur
        $solde = $game->getParieur()->getSolde();
        $balance = $solde->getBalance();
        $solde->setBalance($balance - $game->getMise());
        $transac->setGame($game);

        return $transac;
    }

    public static function occurencs($a, $b)
    {
        $occurences = [];
        $check = false;
        $tabA = explode(',', $a);
        $tabB = explode(',', $b);
        for ($i = 0; $i < count($tabA); $i++) {
            for ($j = 0; $j < count($tabB); $j++) {
                if ($tabA[$i] == $tabB[$j]) {
                    $occurences[] = $tabB[$j];
                }
            }
        }
        if (count($occurences) == count($tabB)) {
            $check = true;
        }
        return $check;
    }

    public static function makeTriple($tab)
    {
        $arr = [];
        for ($i = 0; $i < count($tab); $i++) {
            for ($j = 1; $j < count($tab); $j++) {
                for ($k = 2; $k < count($tab); $k++) {
                    if ($tab[$i] != $tab[$j]) {
                        if ($tab[$j] != $tab[$k]) {
                            $text = $tab[$i] . '-' . $tab[$j] . '-' . $tab[$k];
                            foreach ($arr as $a) {
                                if (count($arr) > 0) {
                                    self::occurencs($text,$a);
                            }
                            }
                        }
                        $arr[] = $text;
                    }
                }
            }
        }
    }
}

