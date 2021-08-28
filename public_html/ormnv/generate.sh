rm -rf "generated-classes" && 
rm -rf "generated-conf" && 
rm -rf "generated-reversed-database" && 
rm -rf "generated-sql"

sudo php "/home/nviame/public_html/vendor/propel/propel/bin/propel.php" reverse "mysql:host=localhost;dbname=nviame;user=nviame_app;password=RB1fr30a"
sudo cp "generated-reversed-database/schema.xml" "schema.xml"
# edit schema.xml with <database identifierQuoting="true"
sudo php "/home/nviame/public_html/vendor/propel/propel/bin/propel.php" sql:build --overwrite
sudo php "/home/nviame/public_html/vendor/propel/propel/bin/propel.php" model:build
sudo php "/home/nviame/public_html/vendor/propel/propel/bin/propel.php" config:convert
cd ..
composer dump-autoload
