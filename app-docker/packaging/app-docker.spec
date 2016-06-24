
Name: app-docker
Epoch: 1
Version: 0.0.1
Release: 1%{dist}
Summary: Docker Engine
License: GPLv3
Group: ClearOS/Apps
Source: %{name}-%{version}.tar.gz
Buildarch: noarch
Requires: %{name}-core = 1:%{version}-%{release}
Requires: %{name}-repo = 1:%{version}-%{release}
Requires: app-base

%description
Docker is an open source project to build, ship and run any application as a lightweight container.

%package core
Summary: Docker Engine - Core
License: LGPLv3
Group: ClearOS/Libraries
Requires: app-base-core
Requires: app-base-core >= 1:1.2.6
Requires: app-network-core
Requires: app-storage-core >= 1:1.4.7
Requires: %{name}-repo = 1:%{version}-%{release}
Requires: docker-engine >= 1.11

%package repo
Summary: Docker Engine - Repository
License: LGPLv3
Group: ClearOS/Libraries

%description core
Docker is an open source project to build, ship and run any application as a lightweight container.

This package provides the core API and libraries.

%description repo
Docker is an open source project to build, ship and run any application as a lightweight container.

This package provides the repository information.

%prep
%setup -q
%build

%install
mkdir -p -m 755 %{buildroot}/usr/clearos/apps/docker
cp -r * %{buildroot}/usr/clearos/apps/docker/

install -D -m 0644 packaging/docker.repo %{buildroot}/etc/yum.repos.d/docker.repo
install -D -m 0644 packaging/docker.php %{buildroot}/var/clearos/base/daemon/docker.php

%post
logger -p local6.notice -t installer 'app-docker - installing'

%post core
logger -p local6.notice -t installer 'app-docker-core - installing'

if [ $1 -eq 1 ]; then
    [ -x /usr/clearos/apps/docker/deploy/install ] && /usr/clearos/apps/docker/deploy/install
fi

[ -x /usr/clearos/apps/docker/deploy/upgrade ] && /usr/clearos/apps/docker/deploy/upgrade

exit 0

%preun
if [ $1 -eq 0 ]; then
    logger -p local6.notice -t installer 'app-docker - uninstalling'
fi

%preun core
if [ $1 -eq 0 ]; then
    logger -p local6.notice -t installer 'app-docker-core - uninstalling'
    [ -x /usr/clearos/apps/docker/deploy/uninstall ] && /usr/clearos/apps/docker/deploy/uninstall
fi

exit 0

%files
%defattr(-,root,root)
/usr/clearos/apps/docker/controllers
/usr/clearos/apps/docker/htdocs
/usr/clearos/apps/docker/views

%files core
%defattr(-,root,root)
%exclude /usr/clearos/apps/docker/packaging
%dir /usr/clearos/apps/docker
/usr/clearos/apps/docker/deploy
/usr/clearos/apps/docker/language
/usr/clearos/apps/docker/libraries
/var/clearos/base/daemon/docker.php

%files repo
%defattr(-,root,root)
/etc/yum.repos.d/docker.repo
