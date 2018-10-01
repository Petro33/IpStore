<?php

namespace IpStoreBundle\Controller;

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
        $ip = $request->request->get('ip');

        if($ip) {
            $errors = $mySQLDriver->validation($ip);
            $ipCount = $errors ? null : $mySQLDriver->add($ip);
        }

        return $this->render('@IpStore/IpStore/add.html.twig', [
            'ip' => $ip,
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
        $ip = $request->query->get('ip');

        if($ip) {
            $errors = $mySQLDriver->validation($ip);
            $ipCount = $errors ? null : $mySQLDriver->query($ip);
        }

        return $this->render('@IpStore/IpStore/query.html.twig', [
            'ip' => $ip,
            'ipCount' => $ipCount ?? null,
            'errors' => $errors ?? null,
        ]);
    }
}
