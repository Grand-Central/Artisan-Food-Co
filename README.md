CMS Bootstrap
========================

A Symfony project with Sonata Admin to use as a base for new projects allowing you to get up and running as quickly as possible.

## Things that will help you with using this project:

* [SonataAdminBundle documentation](http://sonata-project.org/bundles/admin/master/doc/index.html)
* [SonataMediaBundle documentation](http://sonata-project.org/bundles/media/master/doc/index.html)
* [The admin theme used](https://almsaeedstudio.com/themes/AdminLTE/index2.html)


## Getting Started

* [Duplicate this repository to a new GutHub repository for your project.](https://help.github.com/articles/duplicating-a-repository/)
* Clone your new repository.
* In the project root run `./bash/initProject.sh` to initialise the project.
* Run `npm install`.
* Run `gulp` and leave it running.
* Make sure you have the vagrant plugins `vagrant-vbguest` and `vagrant-dns` installed. (`vagrant plugin install plugin-name`)
* In a new terminal CD to the project route and run `vagrant up`.
* Run `vagrant dns --install`
* After the VM has booted run `vagrant ssh`. CD to `/vagrant/` and run `composer update`.
* When composer has finished run `./bash/createDatabase.sh`.
* Then `php app/console assets:install --symlink`.
* Go to `http://cms-bootstrap.dev/app_dev.php` or `http://cms-bootstrap.dev/app_dev.php/admin/`.

## Create an Admin user
* Run `vagrant ssh`. CD to `/vagrant/` and run `php app/console fos:user:create`.
* Grant the user `ROLE_SUPER_ADMIN` with `php app/console fos:user:promote`

## Live Reload
For live reloading install the [LiveReload extension in Chrome](https://chrome.google.com/webstore/detail/livereload/jnihajbhpnppcggbcgedagnkighmdlei).

## Connecting PGAdmin
Out the box this project uses a PostgreSQL database. To administer with pgAadmin connect with:
* Host: `localhost`
* Port: `5432`
* username: `ubuntu`
* Passsword: `granc45`
