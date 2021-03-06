Artisan Food Co.
========================

A brochure website for the Artisan Food Company.

## Things that will help you with using this project:

* [SonataAdminBundle](http://sonata-project.org/bundles/admin/master/doc/index.html) powers the CMS / Admin site.
* [SonataUserBundle](https://sonata-project.org/bundles/user/master/doc/index.html) for user management (extends [FOSUserBundle](https://github.com/FriendsOfSymfony/FOSUserBundle)).
* [SonataMediaBundle](http://sonata-project.org/bundles/media/master/doc/index.html) for image, video, file management.
* [SonataSeoBundle](https://sonata-project.org/bundles/seo/2-x/doc/index.html) for title and meta tag management.
* [The admin theme used](https://almsaeedstudio.com/themes/AdminLTE/index2.html)
* [Autoprefixer](https://github.com/postcss/autoprefixer) is used to add / remove vendor prefixes from compiled css.


## Getting Started

* Clone this repository
* Run `npm install`
* Run `gulp` and leave it running
* Make sure you have the vagrant plugins `vagrant-vbguest` and `vagrant-dns` installed. (`vagrant plugin install plugin-name`)
* In a new terminal CD to the project route and run `vagrant up`
* Run `vagrant dns --install`
* After the VM has booted run `vagrant ssh`. CD to `/vagrant/` and run `composer update`
* When composer has finished run `./bash/createDatabase.sh`
* Then `php app/console assets:install --symlink`
* Go to `http://artisan-food-co.dev/app_dev.php` or `http://artisan-food-co.dev/app_dev.php/admin/`

## Create an Admin user
* Run `vagrant ssh`. CD to `/vagrant/` and run `php app/console fos:user:create`
* Grant the user `ROLE_SUPER_ADMIN` with `php app/console fos:user:promote`

## Live Reload
For live reloading install the [LiveReload extension in Chrome](https://chrome.google.com/webstore/detail/livereload/jnihajbhpnppcggbcgedagnkighmdlei)

## Connecting PGAdmin
Out the box this project uses a PostgreSQL database. To administer with pgAadmin connect with:
* Host: `localhost`
* Port: `5432`
* username: `ubuntu`
* Passsword: `granc45`
