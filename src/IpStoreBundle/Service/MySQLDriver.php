<?php

namespace IpStoreBundle\Service;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\ORM\EntityManagerInterface;
use IpStoreBundle\Entity\IpStore;

class MySQLDriver implements DriverInterface
{

    /**
     * @var EntityManager
     */
    protected $em;

    private $validator;


    /**
     * @param EntityManagerInterface $dm
     */
    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    /**
     * @param string $ip
     * @return null|string
     */
    public function validation(string $ip): ?string
    {
        if (!filter_var($ip, FILTER_VALIDATE_IP) && !filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return "$ip is not a valid IP address";
        }

        return null;
    }

    /**
     * @param $ip
     * @return int
     */
    public function add(string $ip): int
    {
        $ipStore = $this->em->getRepository(IpStore::class)->findOneBy(['ip' => $ip]);

        if (!$ipStore) {
            $ipStore = new IpStore();
            $ipStore->setIp($ip);
            $ipStore->setCount(1);
            $ipCount = 1;
        }else{
            $ipCount = $ipStore->getCount() + 1;
            $ipStore->setCount($ipCount);
        }

        $this->em->persist($ipStore);
        $this->em->flush();

        return $ipCount;
    }

    /**
     * @param string $ip
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function query(string $ip): int
    {
        $ipCount = 0;

        $ipStore = $this->em->getRepository(IpStore::class)->findOneBy(['ip' => $ip]);

        if ($ipStore) {
            $ipCount = $ipStore->getCount();
        }

        return $ipCount;
    }
}


