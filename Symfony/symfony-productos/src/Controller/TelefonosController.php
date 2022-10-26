<?php

namespace App\Controller;

use App\Entity\Telefonos;
use App\Form\TelefonoType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TelefonosController extends AbstractController
{

    #[Route("/telefonos/nuevo", name:"nuevo_contacto")]

    public function nuevo(ManagerRegistry $doctrine, Request $request){
        $telefono = new Telefonos();

        $formulario = $this->createForm(TelefonoType::class,$telefono);
            
        $formulario->handleRequest($request);

        if($formulario->isSubmitted() && $formulario-> isValid()){
            $telefono = $formulario-> getData();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($telefono);
            $entityManager->flush();
            return $this->redirectToRoute('ficha_telefono',[
                "codigo" => $telefono->getId()
            ]);
        }

        return $this->render('nuevo.html.twig',array(
            'formulario'=>  $formulario->createView()
        ));
    }  
    
    #[Route("/telefono/{codigo}", name:"ficha_telefono")]

    public function ficha(ManagerRegistry $doctrine, $codigo):Response{
        $repositorio = $doctrine->getRepository(Telefonos::class);
        $telefono = $repositorio->find($codigo);

        return $this->render('ficha_telefono.html.twig', [
            'telefono'=>$telefono
        ]);
    }

    #[Route("/telefonos/editar/{codigo}", name:"editar_telefono", requirements: ["codigo"=>"\d+"])]

    public function editar(ManagerRegistry $doctrine, Request $request, $codigo){
        $repositorio = $doctrine->getRepository(Telefonos::class);
        $telefono = $repositorio->find($codigo);

        if ($telefono){

            $formulario = $this->createForm(TelefonoType::class, $telefono);
            $formulario->handleRequest($request);
    
            if ($formulario->isSubmitted() && $formulario->isValid()) {
    
                $telefono = $formulario->getData();    
                $entityManager = $doctrine->getManager();
                $entityManager->persist($telefono);
                $entityManager->flush();
    
                return $this->redirectToRoute('ficha_telefono', ["codigo" => $telefono->getId()]);
            }
    
            return $this->render('nuevo.html.twig', array(
                'formulario' => $formulario->createView()
            ));
    
        }else{
    
            return $this->render('ficha_telefono.html.twig', [
                'telefono' => NULL
            ]);
        }
    }

    #[Route("/telefonos/buscar/{marca}", name:"buscar_telefono")]

    public function buscar(ManagerRegistry $doctrine, $marca):Response{
        //filtramos aquellos que contengan la marca 
        $repositorio=$doctrine->getRepository(Telefonos::class);
        $telefonos = $repositorio->findByMarca($marca);
        return $this->render('lista_telefonos.html.twig', [
            'telefonos' =>$telefonos
        ]);
    }

    #[Route("/telefonos/listar", name:"listar_telefonos")]

    public function listar(ManagerRegistry $doctrine):Response{
        $repositorio=$doctrine->getRepository(Telefonos::class);
        $telefonos = $repositorio->findAll();
        return $this->render('lista_telefonos.html.twig', [
            'telefonos' =>$telefonos
        ]);
    }
}
