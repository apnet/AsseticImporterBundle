is_windows = (RbConfig::CONFIG['host_os'] =~ /mswin|mingw|cygwin/)

Vagrant.configure("2") do |config|
  config.vm.box = "covex/symfony-ubuntu1404-x64"

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
  config.vm.provision "shell", path: "vagrant/sync-vendor.php"
end
