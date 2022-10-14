<?php

namespace App\Controller;

use App\Entity\Contacto;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactoController extends AbstractController
{
   
    private $contactos = [
        1 => ["nombre" => "Juan Pérez", "telefono" => "524142432", "email" => "juanp@ieselcaminas.org"],
        2 => ["nombre" => "Ana López", "telefono" => "58958448", "email" => "anita@ieselcaminas.org"],
        5 => ["nombre" => "Mario Montero", "telefono" => "5326824", "email" => "mario.mont@ieselcaminas.org"],
        7 => ["nombre" => "Laura Martínez", "telefono" => "42898966", "email" => "lm2000@ieselcaminas.org"],
        9 => ["nombre" => "Nora Jover", "telefono" => "54565859", "email" => "norajover@ieselcaminas.org"]
    ];
    #[Route("/contacto/insertar", name:"insertar_contacto")]

    public function insertar(ManagerRegistry $doctrine){
        $entityManager = $doctrine->getManager();
        foreach ($this->contactos as $c) {
            $contacto = new Contacto();
            $contacto ->setNombre($c["nombre"]);
            $contacto ->setTelefono($c["telefono"]);
            $contacto ->setEmail($c["email"]);
            $entityManager ->persist($contacto);
        }
        try{
            //solo se necesitara hacer flush una vez y confirmara todas las operaciones pendientes
            $entityManager->flush();
            return new Response("Contactos insertados ");
        }catch (\Exception $e){
            return new Response("Error al insertar objetos" . $e->getMessage());
        }
    }

    #[Route("/contacto/{codigo}", name:"ficha_contacto")]

    public function ficha(ManagerRegistry $doctrine, $codigo):Response{
        $repositorio = $doctrine->getRepository(Contacto::class);
        $contacto = $repositorio->find($codigo);

        return $this->render('ficha_contacto.html.twig', [
            'contacto'=>$contacto
        ]);
    }
    

    public function listaOld($codigo):Response{
        //si no existeel elemento con dicha clave devolvemos null 
        $resultado = ($this->contactos[$codigo]?? null);
        
        return $this-> render('ficha_contacto.html.twig',[
            'contacto' => $resultado
            ]);
        
    }

    #[Route("/contacto/buscar/{texto}", name:"buscar_contacto")]

    public function buscar(ManagerRegistry $doctrine, $texto):Response{
        //filtramos aquellos que contengan el texto en el nombre
        $repositorio=$doctrine->getRepository(Contacto::class);
        $contactos = $repositorio->findByName($texto);
        return $this->render('lista_contactos.html.twig', [
            'contactos' =>$contactos
        ]);
    }

    public function buscarOld($texto):Response{
        $resultados = array_filter($this -> contactos, function($contacto) use($texto){
            return strpos($contacto["nombre"], $texto) !== FALSE;
        });
            return $this->render('lista_contactos.html.twig',[
                'contactos' =>$resultados
            ]);
        
    }

    
}
