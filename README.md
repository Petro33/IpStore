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