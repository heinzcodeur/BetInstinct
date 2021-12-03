<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Affiche;
use App\Entity\BetInstinct\Bet;
use App\Entity\BetInstinct\TypedePari;
use App\Entity\BetInstinct\User;
use App\Form\BetInstinct\AfficheType;
use App\Repository\BetInstinct\AfficheRepository;
use App\Service;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bet/instinct/affiche")
 */
class AfficheController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_affiche_index", methods={"GET"})
     */
    public function index(AfficheRepository $afficheRepository, EntityManagerInterface $entityManager): Response
    {
        //Service::Archivage($afficheRepository->findAll(),$entityManager);
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('a')
            ->from(Affiche::class, 'a')
            ->where('a.archived = 0')
            ->orderBy('a.id','DESC');

        $query = $queryBuilder->getQuery();
        return $this->render('bet_instinct/affiche/index.html.twig', [
            'affiches' => $query->getResult(),
        ]);
    }

    /**
     * @Route("/new", name="bet_instinct_affiche_new", methods={"GET","POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $affiche = new Affiche();
        $bet=new Bet();
        $bet2=new Bet();

        $form = $this->createForm(AfficheType::class, $affiche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //on check le type de sport de l'affiche
            //si affiche football
           if($affiche->getTournoi()->getSport()->getId()==3){
               //si foot on cree un bet Resultat Foot
               $type=$this->getDoctrine()->getRepository(TypedePari::class)->find(22);
               $bet->setTypedePari($type);
            $bet->setAffiche($affiche);
            $bet->setCote1($affiche->getCoteFavorite());
            $bet->setCote2($affiche->getCoteMatchNull());
            $bet->setCote3($affiche->getCoteOutsider());
            //ensuite on cree un bet score exact
               $type2=$this->getDoctrine()->getRepository(TypedePari::class)->find(23);
               $bet2->setAffiche($affiche);
               $bet2->setTypedePari($type2);

               $cote=[8.50,8,7.25,10.5,9.51,16,18,17,28,55,38,34,50,85,200,16,7.25,11,36,110,25,15,26,13,50,30,29,110,65,65,75,350,180,170,200,350];

               $bet2->setCote1(8.5);
               $bet2->setCote2(8);
               $bet2->setCote3(7.25);
               $bet2->setCote4(10.5);
               $bet2->setCote5(9.51);
               $bet2->setCote6(16);
               $bet2->setCote7(18);
               $bet2->setCote8(17);
               $bet2->setCote9(28);
               $bet2->setCote10(55);
               $bet2->setCote11(38);
               $bet2->setCote12(34);
               $bet2->setCote13(50);
               $bet2->setCote14(85);
               $bet2->setCote15(200);
               $bet2->setCote16(16);
               $bet2->setCote17(7.25);
               $bet2->setCote18(11);
               $bet2->setCote19(36);
               $bet2->setCote20(110);
               $bet2->setCote21(25);
               $bet2->setCote22(15);
               $bet2->setCote23(26);
               $bet2->setCote24(13);
               $bet2->setCote25(50);
               $bet2->setCote26(30);
               $bet2->setCote27(29);
               $bet2->setCote28(110);
               $bet2->setCote29(65);
               $bet2->setCote30(65);
               $bet2->setCote31(75);
               $bet2->setCote32(350);
               $bet2->setCote33(180);
               $bet2->setCote34(1870);
               $bet2->setCote35(200);
               $bet2->setCote35(350);

                $betScoreMultiChance = new Bet();
                $betScoreMultiChance->setAffiche($affiche);
               $typescoreMulti=$this->getDoctrine()->getRepository(TypedePari::class)->find(24);
               $betScoreMultiChance->setTypedePari($typescoreMulti);
               $betScoreMultiChance->setCote1(3.75);
               $betScoreMultiChance->setCote2(9);
               $betScoreMultiChance->setCote3(13.5);
               $betScoreMultiChance->setCote4(80);
               $betScoreMultiChance->setCote5(3.95);
               $betScoreMultiChance->setCote6(8.5);
               $betScoreMultiChance->setCote7(8);
               $betScoreMultiChance->setCote8(17);
               $betScoreMultiChance->setCote9(20);
               $betScoreMultiChance->setCote10(65);
               $betScoreMultiChance->setCote11(3.65);



               /* foreach ($cote as $key=>$value){
                    //$bet2
                    $k=$key+1;
                    $ku='$cote'.$k;
                   if(property_exists($bet2,$ku)) {
                       $bet2->setCote.$k.'(3)';
                   }
                     //($ku);
                    //$prop='cote'.$key+1;
                     //$ku;
                }*/


           }
           //si affiche basket
           elseif($affiche->getTournoi()->getSport()->getId()==2){
                    $ecartgagnant=Service::ecartGagnant($affiche,$entityManager,25);
                    $entityManager->persist($ecartgagnant);
                    $nbpoints=Service::nbPoints($affiche,$entityManager,27);
                    $entityManager->persist($nbpoints);
                    $vainqueurBasket = Service::vainqueur($affiche,$entityManager,2);
                    $entityManager->persist($vainqueurBasket);
                    $troispoints=Service::total3points($affiche,$entityManager,29);
                    $entityManager->persist($troispoints);
                    $nbpointsQT1=Service::nbPointsQT1($affiche,$entityManager,35);
                    $entityManager->persist($nbpointsQT1);
                    $nbpointsQT2=Service::nbPointsQT1($affiche,$entityManager,40);
                    $entityManager->persist($nbpointsQT2);
                    $nbpointsQT3=Service::nbPointsQT1($affiche,$entityManager,41);
                    $entityManager->persist($nbpointsQT3);
                    //$nbpointsMiTemps=Service::nbPoinstMitemps($affiche,$entityManager,38);
                    //$entityManager->persist($nbpointsMiTemps);
                    $premiere50points = Service::premiereEquipe50points($affiche, $entityManager,34);
                    $entityManager->persist($premiere50points);
                    $premiere40points = Service::premiereEquipe40points($affiche, $entityManager,33);
                    $entityManager->persist($premiere40points);
                    $premiere30points = Service::premiereEquipe30points($affiche, $entityManager,32);
                    $entityManager->persist($premiere30points);
                    $premiere20points = Service::premiereEquipe20points($affiche, $entityManager,31);
                    $entityManager->persist($premiere20points);
                    $vainqueurNbPpoints = Service::VainqueurNombre2points($affiche, $entityManager,37);
                    $entityManager->persist($vainqueurNbPpoints);
                    $premierQTres = Service::premierQTresultat($affiche,$entityManager,38);
                    $entityManager->persist($premierQTres);
                    $margevainqueur = Service::margeduvainqueur($affiche, $entityManager,26);
                    $entityManager->persist($margevainqueur);
                    //$nbpointsMiTempsEquipeA = Service::nbPointsEquipeAmitemps($affiche,$entityManager,38);
                    //$entityManager->persist($nbpointsMiTempsEquipeA);
                   // $nbpointsMiTempsEquipeB = Service::nbPointsEquipeBmitemps($affiche,$entityManager,36);
                    //$entityManager->persist($nbpointsMiTempsEquipeB);
           }
           else {
               //sinon on cree un bet vainqueur tennis
               $bet->setAffiche($affiche);
               $type = $this->getDoctrine()->getRepository(TypedePari::class)->find(2);
               $bet->setTypedePari($type);
               $bet->setCote1($affiche->getCoteFavorite());
               $bet->setCote2($affiche->getCoteOutsider());
               //ensuite on cree un bet score exact dame
               $bet2->setAffiche($affiche);
               $type2 = $this->getDoctrine()->getRepository(TypedePari::class)->find(1);
               $bet2->setTypedePari($type2);
               $bet2->setCote1(2.2);
               $bet2->setCote2(3.6);
               $bet2->setCote3(3.3);
               $bet2->setCote4(4.2);
                //on cree un bet nombre de sets
               $bet3 = new Bet();
               $bet3->setAffiche($affiche);
               $typeNbSets = $this->getDoctrine()->getRepository(TypedePari::class)->find(6);
               $bet3->setTypedePari($typeNbSets);
               $bet3->setCote1(1.5);
               $bet3->setCote2(2.05);
                //on cree un bet score set1
               $betScoreSet1 = new Bet();
               $betScoreSet1->setAffiche($affiche);
               $typeScoreSet1 = $this->getDoctrine()->getRepository(TypedePari::class)->find(3);
               $betScoreSet1->setTypedePari($typeScoreSet1);
               $betScoreSet1->setCote1(48);
               $betScoreSet1->setCote2(14);
               $betScoreSet1->setCote3(8);
               $betScoreSet1->setCote4(5.11);
               $betScoreSet1->setCote5(4.91);
               $betScoreSet1->setCote6(12);
               $betScoreSet1->setCote7(6.25);
               $betScoreSet1->setCote8(90);
               $betScoreSet1->setCote9(30);
               $betScoreSet1->setCote10(16);
               $betScoreSet1->setCote11(7.75);
               $betScoreSet1->setCote12(6.75);
               $betScoreSet1->setCote13(17);
               $betScoreSet1->setCote14(7.5);
                //on cree un bet vainqueur set1
               $betSet1Vainqueur = new Bet();
               $betSet1Vainqueur->setAffiche($affiche);
               $typeSet1V=$this->getDoctrine()->getRepository(TypedePari::class)->find(19);
               $betSet1Vainqueur->setTypedePari($typeSet1V);
               $betSet1Vainqueur->setCote1(1.45);
               $betSet1Vainqueur->setCote2(2.15);

               //on cree un bet score exact set1 multichoix
               $betScoreExactSet1multiChoix = new Bet();
               $betScoreExactSet1multiChoix->setAffiche($affiche);
               $typeScoreMulti=$this->getDoctrine()->getRepository(TypedePari::class)->find(28);
               $betScoreExactSet1multiChoix->setTypedePari($typeScoreMulti);
               $betScoreExactSet1multiChoix->setCote1(4.75);
               $betScoreExactSet1multiChoix->setCote1(3.51);
               $betScoreExactSet1multiChoix->setCote1(6.51);
               $betScoreExactSet1multiChoix->setCote1(5.51);
               $betScoreExactSet1multiChoix->setCote1(2.75);
               $betScoreExactSet1multiChoix->setCote1(7.01);
           }
            //dd($bet);
            $affiche->setArchived(0);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($affiche);
            if(isset($bet)){
                $entityManager->persist($bet);
            }
            if(isset($bet2)){
                $entityManager->persist($bet2);
            }
            if(isset($bet3)){
                $entityManager->persist($bet3);
            }
            if(isset($betScoreMultiChance)){
                $entityManager->persist($betScoreMultiChance);
            }
            if(isset($betSet1Vainqueur)){
                $entityManager->persist($betSet1Vainqueur);
            }
            if(isset($betScoreSet1)){
                $entityManager->persist($betScoreSet1);
            }
            if(isset($betScoreExactSet1multiChoix)){
                $entityManager->persist($betScoreExactSet1multiChoix);
            }
           /*  if(isset($ecartgagnant)){
                $entityManager->persist($ecartgagnant);
            }
            if(isset($vainqueurBasket)){
                $entityManager->persist($vainqueurBasket);
            }
            if(isset($troispoints)){
                $entityManager->persist($troispoints);
            }
            if(isset($nbpoints)){
                $entityManager->persist($nbpoints);
            }*/
            $entityManager->flush();

            return $this->redirectToRoute('bet_instinct_affiche_show',['id'=>$affiche->getId()]);
        }

        return $this->renderForm('bet_instinct/affiche/new.html.twig', [
            'affiche' => $affiche,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_affiche_show", methods={"GET"})
     */
    public function show(Affiche $affiche): Response
    {
        /*foreach($affiche->getBet() as $p){
            dump($p);
        }
        dd('titi');*/
        dump($affiche);

        return $this->render('bet_instinct/affiche/show.html.twig', [
            'affiche' => $affiche,
        ]);
    }

    /**
     * @Route("archive/{id}", name="bet_instinct_affiche_archive")
     */
    public function archiverAffiche(Affiche $affiche, EntityManagerInterface $entityManager){
        $affiche->setArchived(1);
        $entityManager->flush();
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_affiche_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Affiche $affiche): Response
    {
        $form = $this->createForm(AfficheType::class, $affiche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_affiche_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/affiche/edit.html.twig', [
            'affiche' => $affiche,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_affiche_delete", methods={"POST"})
     */
    public function delete(Request $request, Affiche $affiche): Response
    {
        if ($this->isCsrfTokenValid('delete'.$affiche->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($affiche);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_affiche_index', [], Response::HTTP_SEE_OTHER);
    }
}
