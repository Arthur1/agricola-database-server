.PHONY: build
build:
	docker compose build

.PHONY: start
start:
	docker compose up -d

.PHONY: stop
stop:
	docker compose down

.PHONY: ps
ps:
	docker compose ps

.PHONY: exec
exec:
	docker compose exec --user 1000 app bash
