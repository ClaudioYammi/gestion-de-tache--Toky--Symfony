<?php

namespace App\Controller;
use App\Repository\EmployerRepository;
use App\Repository\ListeTacheRepository;
use App\Repository\TacheRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;


class ChartjsController extends AbstractController
{
    /**
     * @Route("/chartjs", name="app_chartjs")
     */
    public function chartjs(EmployerRepository $nombre,ListeTacheRepository $tache,UserRepository $user,TacheRepository $t)
    {
        $nombres = $nombre->countEmployer();
        $counte  = [];
        foreach ($nombres as $nombre) {
           $count = $nombre["count"];
        }

        $taches = $tache->countListeTache();
        $counteTacheListe = [];
        foreach ($taches as $tache) {
            $countTacheList = $tache["counte"];
        }

        $users = $user->countUser();
        $contuser = [];
        foreach ($users as $user) {
            $countuser = $user["counte"];
        }
        // $taches = $t->countTache();
        // $counteTache = [];
        // foreach ($taches as $tache) {
        //     $countTache = $tache["counte"];
        // }




        return $this->render('chartjs/index.html.twig',[
            'count' => json_encode($count),
            'countListe' => json_encode($countTacheList),
            'countUser' => json_encode($countuser),
            // 'countTache' => json_encode($countTache),
            
        ]);
    }
}
