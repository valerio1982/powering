Ambiente di sviluppo:

Database: MySQL v.5.7.36
Web Server: Apache/2.4.51
Versione PHP: 7.4.26

Creare un virtual host sul web Server puntando alla cartella public del progetto, ad esempio:

<VirtualHost *:80>
    ServerName powering.test.it
    DocumentRoot "D:/www/powering/public"
    SetEnv APPLICATION_ENV "development"
    <Directory "D:/www/powering/public">
        DirectoryIndex index.php
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>

Per modificare i dati di accesso al database, modificare il file ./config/autoload/doctrine.local.php 


Per invocare i servizi REST usare gli url (supponendo che la base sia http://powering.test.it):
Invio JSON Automezzi: http://powering2.test.it/getAutomezzi
invio JSON Filiali: http://powering2.test.it/getFiliali