RMDIR /Q/S "generated-classes"
RMDIR /Q/S "generated-conf"
RMDIR /Q/S "generated-reversed-database"
RMDIR /Q/S "generated-sql"
php "C:\laragon\www\Nviame\vendor\propel\propel\bin\propel.php" reverse "mysql:host=localhost;dbname=nviame;user=nviame_app;password=RB1fr30a"
copy "generated-reversed-database\\schema.xml" %cd% /Y
php "C:\laragon\www\Nviame\vendor\propel\propel\bin\propel.php" sql:build --overwrite
php "C:\laragon\www\Nviame\vendor\propel\propel\bin\propel.php" model:build
php "C:\laragon\www\Nviame\vendor\propel\propel\bin\propel.php" config:convert
cd.. && composer dump-autoload