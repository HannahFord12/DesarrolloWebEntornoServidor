<?php

namespace App\Controller;

use App\Entity\Contacto;
use App\Entity\Provincia;
use App\Form\ContactoType;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactoController extends AbstractController
{
    #[Route("/contacto/nuevo", name:"nuevo_contacto")]

    public function nuevo(ManagerRegistry $doctrine, Request $request){
        $contacto = new Contacto();

        $formulario = $this->createForm(ContactoType::class,$contacto);
            
        $formulario->handleRequest($request);

        if($formulario->isSubmitted() && $formulario-> isValid()){
            $contacto = $formulario-> getData();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($contacto);
            $entityManager ->flush();
            return $this->redirectToRoute('ficha_contacto',[
                "codigo" => $contacto->getId()
            ]);
        }

        return $this->render('nuevo.html.twig',array(
            'formulario'=>  $formulario->createView()
        ));
    }

    #[Route("/contacto/editar/{codigo}", name:"editar_contacto", requirements: ["codigo"=>"\d+"])]

    public function editar(ManagerRegistry $doctrine, Request $request, $codigo){
        $repositorio = $doctrine->getRepository(Contacto::class);
        $contacto = $repositorio->find($codigo);

        if ($contacto){

            $formulario = $this->createForm(ContactoType::class, $contacto);
            $formulario->handleRequest($request);
    
            if ($formulario->isSubmitted() && $formulario->isValid()) {
    
                $contacto = $formulario->getData();    
                $entityManager = $doctrine->getManager();
                $entityManager->persist($contacto);
                $entityManager->flush();
    
                return $this->redirectToRoute('ficha_contacto', ["codigo" => $contacto->getId()]);
            }
    
            return $this->render('nuevo.html.twig', array(
                'formulario' => $formulario->createView()
            ));
    
        }else{
    
            return $this->render('ficha_contacto.html.twig', [
                'contacto' => NULL
            ]);
        }
    }

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

    #[Route("/contacto/update/{id}/{nombre}", name:"modificar_contacto")]

    public function update(ManagerRegistry $doctrine, $id, $nombre):Response{
        $entityManager = $doctrine->getManager();
        $repositorio = $doctrine->getRepository(Contacto::class);
        $contacto = $repositorio->find($id);
        if ($contacto){
            $contacto->setNombre($nombre);
            try{
                $entityManager->flush();
                return $this-> render('ficha_contacto.html.twig',[
                    'contacto' => $contacto
                ]);
            }catch(\Exception $e){
                return new Response("Error insertando objetos");
            }
        }else{
            return $this->render('ficha_contacto.html.twig',[
                'contacto' => null
            ]);
        }
    }

    #[Route("/contacto/delete/{id}", name:"eliminar_contacto")]

    public function delete(ManagerRegistry $doctrine, $id):Response{
        $entityManager = $doctrine->getManager();
        $repositorio = $doctrine->getRepository(Contacto::class);
        $contacto = $repositorio->find($id);
        if ($contacto){
            try{
                $entityManager->remove($contacto);
                $entityManager->flush();
                return new Response("Contacto eliminado correctamente");
            }catch(\Exception $e){
                return new Response("Error al eliminar objeto");
            }
        }else{
            return $this->render('ficha_contacto.html.twig',[
                'contacto' => null
            ]);
        }
    }

    #[Route("/contacto/insertarConProvincia", name:"insertar_con_proincia_contacto")]

    public function insertarConProvincia(ManagerRegistry $doctrine):Response{
        $entityManager = $doctrine->getManager();
        $provincia = new Provincia();

        $provincia->setNombre("Alicante");
        $contacto = new Contacto();

        $contacto->setNombre("Inserción de prueba con provincia");
        $contacto->setTelefono("908782739");
        $contacto->setEmail("insercion.prueba.provincia@contacto.es");
        $contacto->setProvincia($provincia);

        $entityManager->persist($provincia);
        $entityManager->persist($contacto);

        $entityManager->flush();
        return $this->render('ficha_contacto.html.twig',[
            'contacto' => $contacto
        ]);
    }

    #[Route("/contacto/insertarSinProvincia", name:"insertar_sin_proincia_contacto")]

    public function insertarSinProvincia(ManagerRegistry $doctrine):Response{
        $entityManager = $doctrine->getManager();
        $repositorio = $doctrine->getRepository(Provincia::class);

        $provincia = $repositorio->findOneBy(["nombre" => "Alicante"]);
        $contacto = new Contacto();

        $contacto->setNombre("Inserción de prueba sin provincia");
        $contacto->setTelefono("908782739");
        $contacto->setEmail("insercion.prueba.sin.provincia@contacto.es");
        $contacto->setProvincia($provincia);

        $entityManager->persist($contacto);

        $entityManager->flush();
        return $this->render('ficha_contacto.html.twig',[
            'contacto' => $contacto
        ]);
    }
    
    
    
}
