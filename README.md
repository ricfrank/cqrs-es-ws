# Cqrs Event sourcing workshop

 
Requisiti
=

- Vagrant (> 1.8.x) con plugin HostManager (vagrant plugin install vagrant-hostmanager)
- Virtualbox (5.0.x) NOTA: con la versione di vbox 5.1.8 composer potrebbe dare questo errore zlib_decode(): data error la soluzione è aggiornare vbox (https://github.com/composer/composer/issues/5814)


Configurazione del progetto
=
```

cd PATH/DEL/PROGETTO && cp vagrantconfig.yml.dist vagrantconfig.yml && vagrant up
vagrant ssh
cd /var/www
```

Per lanciare i test:

```
cd /var/www
bin/phpunit -c ./ --colors
```