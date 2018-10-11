IP Store

Command for start project

git clone https://github.com/Petro33/IpStore.git

composer install

php bin/console doctrine:database:create

php bin/console doctrine:schema:create

php bin/console server:run

Link for query ip
http://localhost:8000/ip-store/query

Link for add ip
http://localhost:8000/ip-store/add



IP Store

IP store mini application is for storing and querying IP addresses (IPv4 and IPv6).
Application will run in a multi-machine environment. In this environment the application will
be reading heavy but it needs to be optimized for being writing heavy also. In many occasion
the writings will be concurent, they are not allowed to cause data loss or to be dirty.

As reading processes will dominate, therefore B-Tree must be used for storing and
searching data. A counter must be stored with IP addresses to indicate how many times they
were added to the storage.

Counter cannot be searched for and ordering cannot be completed with it.


On the interfaces the following operations implemented:

• Add – Valid IP address can be added to the storage with this call, returning value, the
counter, how many times have been added to the storage

• Query – This call indicates how many times a valid IP address was added to the storage.




