# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|
  # The most common configuration options are documented and commented below.
  # For a complete reference, please see the online documentation at
  # https://docs.vagrantup.com.

  # Every Vagrant development environment requires a box. You can search for
  # boxes at https://atlas.hashicorp.com/search.
  config.vm.box = "ubuntu/xenial64"

  # vagrant-dns config. See https://github.com/BerlinVagrant/vagrant-dns
  machine = "#{ENV['COMPUTERNAME'] || `hostname -s`[0..-2]}".downcase
  config.dns.tld = "artisan-food-co.dev"
  config.dns.tlds = ["artisan-food-co.dev", "artisan-food-co.#{machine}"]
  config.vm.hostname = "artisan-food-co.#{machine}.mylocaldomain.local"
  config.dns.patterns = [/^.*artisan-food-co.dev$/, "^.*artisan-food-co.#{machine}$"]

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine. In the example below,
  # accessing "localhost:8080" will access port 80 on the guest machine.
  # config.vm.network :forwarded_port, guest: 80, host: 8080

  # Create a private network, which allows host-only access to the machine
  # using a specific IP.
  config.vm.network :private_network, ip: "192.168.33.46"

  # Create a public network, which generally matched to bridged network.
  # Bridged networks make the machine appear as another physical device on
  # your network.
  config.vm.network :public_network

  # Set a hostname
  config.vm.hostname = 'vagrant-xenial';

  # Share an additional folder to the guest VM. The first argument is
  # the path on the host to the actual folder. The second argument is
  # the path on the guest to mount the folder. And the optional third
  # argument is a set of non-required options.
  config.vm.synced_folder ".", "/vagrant", nfs: true
  # config.vm.synced_folder "app/cache", "/vagrant/app/cache", :mount_options => ['dmode=777', 'fmode=777']
  # config.vm.synced_folder "app/logs", "/vagrant/app/logs", :mount_options => ['dmode=777', 'fmode=777']
  # config.vm.synced_folder ".", "/vagrant", type: "rsync", rsync__exclude: [".git/", "app/cache/", "app/logs/"]

  # Provider-specific configuration so you can fine-tune various
  # backing providers for Vagrant. These expose provider-specific options.
  # Example for VirtualBox:
  #
  config.vm.provider :virtualbox do |vb|
    vb.name = "artisan-food-co"
    # This allows symlinks to be created within the /vagrant root directory,
    # which is something librarian-puppet needs to be able to do. This might
    # be enabled by default depending on what version of VirtualBox is used.
    vb.customize ["setextradata", :id, "VBoxInternal2/SharedFoldersEnableSymlinksCreate/v-root", "1"]

    # Use VBoxManage to customize the VM. For example to change memory:
    vb.customize [
      "modifyvm", :id,
      "--memory", "2048",
      "--cpus", "2"
    ]
  end

  # Create a forwarded port mapping which allows access the
  # PostgreSQL instance within the machine from the 5432 port on the
  # host machine. If you already have a running Postgres on the host
  # system you need to change the "host" value to point to a free
  # port number
  config.vm.network :forwarded_port, guest: 5432, host: 5432

  config.vm.provision :shell do |shell|
    shell.inline = "export DEBIAN_FRONTEND=noninteractive;
                    apt-get install -y puppet;
                    mkdir -p /etc/puppet/modules;
                    puppet module install puppetlabs-apt --version 2.2.1;
                    puppet module install puppetlabs-postgresql --version 4.7.1;
                    puppet module install willdurand/composer --version 1.1.1;
                    mkdir -p /vagrant;
                    apt-get update;"
  end

  config.vm.provision :puppet, :module_path => "puppet/modules" do |puppet|
    puppet.manifests_path = "puppet/manifests"
    puppet.manifest_file  = "xenial64.pp"
    puppet.options = ['--verbose --hiera_config /vagrant/puppet/hiera.yaml']
  end

end
