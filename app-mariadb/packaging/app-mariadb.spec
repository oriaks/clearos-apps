
Name: app-mariadb
Epoch: 1
Version: 0.0.1
Release: 1%{dist}
Summary: MariaDB Database Server
License: GPLv3
Group: ClearOS/Apps
Source: %{name}-%{version}.tar.gz
Buildarch: noarch
Requires: %{name}-core = 1:%{version}-%{release}
Requires: app-base

%description
MariaDB is a popular database system.  It can be configured to run database driven applications, websites, CRM and practically any other resource requiring a relational storage service.

%package core
Summary: MariaDB Database Server - Core
License: LGPLv3
Group: ClearOS/Libraries
Requires: app-base-core
Requires: app-base-core >= 1:1.2.6
Requires: app-network-core
Requires: app-storage-core >= 1:1.4.7
Requires: docker-engine >= 1.11
Requires: phpMyAdmin >= 4.4.9

%description core
MariaDB is a popular database system.  It can be configured to run database driven applications, websites, CRM and practically any other resource requiring a relational storage service.

This package provides the core API and libraries.

%prep
%setup -q
%build

%install
mkdir -p -m 755 %{buildroot}/usr/clearos/apps/mariadb
cp -r * %{buildroot}/usr/clearos/apps/mariadb/

install -D -m 0644 packaging/mariadb.php %{buildroot}/var/clearos/base/daemon/mariadb.php
install -D -m 0644 packaging/mariadb.service %{buildroot}/usr/lib/systemd/system/mariadb.service
install -D -m 0644 packaging/mariadb_default.conf %{buildroot}/etc/clearos/storage.d/mariadb_default.conf

%post
logger -p local6.notice -t installer 'app-mariadb - installing'

%post core
logger -p local6.notice -t installer 'app-mariadb-core - installing'

if [ $1 -eq 1 ]; then
    [ -x /usr/clearos/apps/mariadb/deploy/install ] && /usr/clearos/apps/mariadb/deploy/install
fi

[ -x /usr/clearos/apps/mariadb/deploy/upgrade ] && /usr/clearos/apps/mariadb/deploy/upgrade

exit 0

%preun
if [ $1 -eq 0 ]; then
    logger -p local6.notice -t installer 'app-mariadb - uninstalling'
fi

%preun core
if [ $1 -eq 0 ]; then
    logger -p local6.notice -t installer 'app-mariadb-core - uninstalling'
    [ -x /usr/clearos/apps/mariadb/deploy/uninstall ] && /usr/clearos/apps/mariadb/deploy/uninstall
fi

exit 0

%files
%defattr(-,root,root)
/usr/clearos/apps/mariadb/controllers
/usr/clearos/apps/mariadb/htdocs
/usr/clearos/apps/mariadb/views

%files core
%defattr(-,root,root)
%exclude /usr/clearos/apps/mariadb/packaging
%dir /usr/clearos/apps/mariadb
/usr/clearos/apps/mariadb/deploy
/usr/clearos/apps/mariadb/language
/usr/clearos/apps/mariadb/libraries
/var/clearos/base/daemon/mariadb.php
/etc/clearos/storage.d/mariadb_default.conf
/usr/lib/systemd/system/mariadb.service
