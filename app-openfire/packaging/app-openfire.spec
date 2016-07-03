
Name: app-openfire
Epoch: 1
Version: 0.0.1
Release: 1%{dist}
Summary: Openfire Collaboration Server
License: GPLv3
Group: ClearOS/Apps
Source: %{name}-%{version}.tar.gz
Buildarch: noarch
Requires: %{name}-core = 1:%{version}-%{release}
Requires: app-base

%description
Openfire is an XMPP server, which is a server that facilitates XML based communication, such as chat.

%package core
Summary: Openfire Collaboration Server - Core
License: LGPLv3
Group: ClearOS/Libraries
Requires: app-base-core
Requires: app-base-core >= 1:1.2.6
Requires: app-network-core
Requires: app-storage-core >= 1:1.4.7
Requires: docker-engine >= 1.11

%description core
Openfire is an XMPP server, which is a server that facilitates XML based communication, such as chat.

This package provides the core API and libraries.

%prep
%setup -q
%build

%install
mkdir -p -m 755 %{buildroot}/usr/clearos/apps/openfire
cp -r * %{buildroot}/usr/clearos/apps/openfire/

install -D -m 0644 packaging/openfire.php %{buildroot}/var/clearos/base/daemon/openfire.php
install -D -m 0644 packaging/openfire.service %{buildroot}/usr/lib/systemd/system/openfire.service
install -D -m 0644 packaging/openfire_default.conf %{buildroot}/etc/clearos/storage.d/openfire_default.conf

%post
logger -p local6.notice -t installer 'app-openfire - installing'

%post core
logger -p local6.notice -t installer 'app-openfire-core - installing'

if [ $1 -eq 1 ]; then
    [ -x /usr/clearos/apps/openfire/deploy/install ] && /usr/clearos/apps/openfire/deploy/install
fi

[ -x /usr/clearos/apps/openfire/deploy/upgrade ] && /usr/clearos/apps/openfire/deploy/upgrade

exit 0

%preun
if [ $1 -eq 0 ]; then
    logger -p local6.notice -t installer 'app-openfire - uninstalling'
fi

%preun core
if [ $1 -eq 0 ]; then
    logger -p local6.notice -t installer 'app-openfire-core - uninstalling'
    [ -x /usr/clearos/apps/openfire/deploy/uninstall ] && /usr/clearos/apps/openfire/deploy/uninstall
fi

exit 0

%files
%defattr(-,root,root)
/usr/clearos/apps/openfire/controllers
/usr/clearos/apps/openfire/htdocs
/usr/clearos/apps/openfire/views

%files core
%defattr(-,root,root)
%exclude /usr/clearos/apps/openfire/packaging
%dir /usr/clearos/apps/openfire
/usr/clearos/apps/openfire/deploy
/usr/clearos/apps/openfire/language
/usr/clearos/apps/openfire/libraries
/var/clearos/base/daemon/openfire.php
/etc/clearos/storage.d/openfire_default.conf
/usr/lib/systemd/system/openfire.service
