#/bin/bash
service apache2 restart
/wait-for-it.sh db:3306
/wait-for-it.sh 127.0.0.1:80
php yii migrate/up --migrationPath=@vendor/macfly/yii2-oauth2-server/src/migrations --interactive=0
./vendor/bin/codecept run
