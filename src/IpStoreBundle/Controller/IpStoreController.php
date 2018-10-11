<?php

namespace IpStoreBundle\Controller;

use IpStoreBundle\Form\AddForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IpStoreBundle\Service\MySQLDriver;
use Symfony\Component\HttpFoundation\Request;


class IpStoreController extends Controller
{
    public function indexAction()
    {
        return $this->render('@IpStore/IpStore/index.html.twig');
    }

    /**
     * @param Request $request
     * @param MySQLDriver $mySQLDriver
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request, MySQLDriver $mySQLDriver)
    {
        $form = $this->createForm(
            AddForm::class,
            null,
            [
                'action' => $this->generateUrl('ip_store_add'),
            ]
        );
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $ip = $form->get('ip')->getData();

            $errors = $mySQLDriver->validation($ip);
            $ipCount = $errors ? null : $mySQLDriver->add($ip);
        }

        return $this->render('@IpStore/IpStore/add.html.twig', [
            'form' => $form->createView(),
            'ipCount' => $ipCount ?? null,
            'errors' => $errors ?? null,
        ]);
    }

    /**
     * @param Request $request
     * @param MySQLDriver $mySQLDriver
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function queryAction(Request $request, MySQLDriver $mySQLDriver)
    {
        $form = $this->createForm(
            AddForm::class,
            null,
            [
                'action' => $this->generateUrl('ip_store_query'),
            ]
        );
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $ip = $form->get('ip')->getData();

            $errors = $mySQLDriver->validation($ip);
            $ipCount = $errors ? null : $mySQLDriver->query($ip);
        }

        return $this->render('@IpStore/IpStore/query.html.twig', [
            'form' => $form->createView(),
            'ipCount' => $ipCount ?? null,
            'errors' => $errors ?? null,
        ]);
    }
}
