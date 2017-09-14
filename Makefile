all: start

start:
	@bin/docker/start.sh

install:
	@bin/docker/install.sh

deps:
	@bin/docker/deps.sh

build:
	@bin/tasks/build.sh

sync:
	@bin/docker/sync.sh

ssh:
	@bin/docker/ssh.sh

ssh-staging:
	@bin/tasks/ssh-staging.sh

rebuild:
	@bin/docker/rebuild.sh

stop:
	@bin/docker/stop.sh

restart:
	@bin/docker/restart.sh

clean:
	@bin/docker/clean.sh

.PHONY: build sync ssh ssh-staging rebuild stop restart clean
