is_windows = (RbConfig::CONFIG['host_os'] =~ /mswin|mingw|cygwin/)

Vagrant.configure("2") do |config|
  config.vm.box = "symfony-ubuntu1204-x64"

  # Use https://github.com/covex-nn/vagrant-symfony2 to create "symfony-ubuntu1204-x64" base box
  #
  # config.vm.box_url = "http://vagrantstore.apnet.ru/symfony-ubuntu1204-x64-latest.box"

  config.vm.network :private_network, ip: "192.168.80.80"
  config.vm.hostname = "importer.local"

  if not is_windows
    config.vm.synced_folder ".", "/vagrant", nfs: true
  end

  config.vm.provider :virtualbox do |v|
    v.name = "Apnet.AsseticImporter"
    v.customize ["modifyvm", :id, "--natdnsproxy1", "on"]
    v.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
  end

  config.vm.provision "shell", path: "vagrant/provision.sh"
end
