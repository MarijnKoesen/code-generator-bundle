<?php
namespace MarijnKoesen\CodeGeneratorBundle\Controller;


use codegenerator\CodeGenerator;
use codegenerator\generator\ClassGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CodeGeneratorController extends Controller
{
    public function indexAction()
    {
        $generator = new CodeGenerator();
        $modules = $this->container->getParameter('marijnk_koesen_code_generator.modules');

        $html = $generator->generateHtml(\codegenerator\Request::getCurrentRequest(), $modules);

        return $this->render(
            'MarijnKoesenCodeGeneratorBundle::index.html.twig',
            array(
                'generatorHtml' => $html
            )
        );
    }
}
