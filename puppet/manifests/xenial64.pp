

####
#
# Apt sources
#

include apt


####
#
# PHP Composer
#

include composer


####
#
# PostgreSQL
#

$postgres_password = 'alltheducksareswimminginthewater'
$postgres_ubuntu_password = 'grandc45'

class { 'postgresql::globals':
    version             => '9.5',
    manage_package_repo => true
} ->
class { 'postgresql::server':
    listen_addresses           => '*',
    ip_mask_deny_postgres_user => '0.0.0.0/32',
    ip_mask_allow_all_users    => '0.0.0.0/0',
    encoding                   => 'utf8',
    locale                     => 'en_US.utf8',
    postgres_password          => $postgres_password,
}

# Create user roles
postgresql::server::role { 'ubuntu':
    password_hash   => postgresql_password('ubuntu', $postgres_ubuntu_password),
    superuser       => true
}

postgresql::server::role { 'artisan_food_co':
    password_hash   => postgresql_password('artisan_food_co', $postgres_password)
}


####
#
# Packages
#

# We install php7.0-cli seperatly so that we can make it a requirement for all other packages
# Without php7.0-cli apache2 would be installed as a dependency of the php7.0-common package
package { ['php7.0-cli']:
    ensure  => present
}

# All the other packages we want
$packages = [
    'nginx',
    'php7.0-common',
    'php7.0-fpm',
    'php7.0-curl',
    'php7.0-sqlite',
    'php7.0-pgsql',
    'php7.0-intl',
    'php7.0-mcrypt',
    'php7.0-gd',
    'php7.0-xml',
    'git',
    'vim',
    'ntp',
    'htop',
    'redis-server'
]

package { $packages:
    ensure  => present,
    require => [
        Exec['apt-get update'],
        Package['php7.0-cli']
    ]
}


####
#
# Services
#
service { 'nginx':
    ensure => running,
    require => Package['nginx'],
}

service { 'php7.0-fpm':
    ensure => running,
    require => Package['php7.0-fpm'],
}

####
#
# Files
#

# nginx
file { 'nginx-conf':
    path => '/etc/nginx/nginx.conf',
    ensure => file,
    require => Package['nginx'],
    notify => Service['nginx'],
    source => 'puppet:///modules/nginx/nginx.conf',
}

# fpm
file { 'www-conf':
    path => '/etc/php/7.0/fpm/pool.d/www.conf',
    ensure => file,
    require => Package['php7.0-fpm'],
    source => 'puppet:///modules/fpm/www.conf',
    notify => Service['php7.0-fpm'],
}

# php.ini
file { 'php-ini-fpm':
    path => '/etc/php/7.0/fpm/php.ini',
    ensure => file,
    require => Package['php7.0-fpm'],
    source => 'puppet:///modules/php/php.ini',
    notify => Service['php7.0-fpm'],
}

file { 'php-ini-cli':
    path => '/etc/php/7.0/cli/php.ini',
    ensure => file,
    require => Package['php7.0-cli'],
    source => 'puppet:///modules/php/php-cli.ini'
}

# vhosts
file { 'nginx-vhost':
    path => '/etc/nginx/sites-available/vhost',
    ensure => file,
    require => Package['nginx'],
    source => 'puppet:///modules/nginx/vhost',
}

file { 'default-nginx-disable':
    path => '/etc/nginx/sites-enabled/default',
    ensure => absent,
    require => Package['nginx'],
}

file { 'nginx-vhost-enable':
    path => '/etc/nginx/sites-enabled/vhost',
    target => '/etc/nginx/sites-available/vhost',
    ensure => link,
    notify => Service['nginx'],
    require => [
        File['nginx-vhost'],
        File['default-nginx-disable'],
    ],
}



####
#
# Commands
#

# Set correct timezone
exec { "set-timezone":
    command => 'sudo /bin/sh -c "echo "Europe/London" > /etc/timezone && sudo dpkg-reconfigure -f noninteractive tzdata"',
    path    => ["/usr/bin", "/usr/sbin"]
}

# Node.js and npm
exec { "install-nodesource":
    command => 'curl -sL https://deb.nodesource.com/setup_5.x | sudo -E bash -',
    path    => ["/bin/", "/sbin/" , "/usr/bin/", "/usr/sbin/"]
}

exec { "install-node":
    command => 'sudo apt-get install -y nodejs',
    path    => ["/bin/", "/sbin/" , "/usr/bin/", "/usr/sbin/"],
    require => Exec['install-nodesource']
}

# Apt
exec { 'apt-get update':
    command => '/usr/bin/apt-get update',
    path    => ["/bin/", "/sbin/" , "/usr/bin/", "/usr/sbin/"]
}
