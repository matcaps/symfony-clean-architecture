user := $(shell id -u)
group := $(shell id -g)

.DEFAULT_GOAL := help
.PHONY: help
help: ## Affiche cette aide
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

.PHONY: test
test: ##Lance les tests
	./vendor/bin/phpunit

.PHONY: format
format: ##formattage
	./vendor/bin/phpcbf
	./vendor/bin/phpcs

.PHONY: analyse
analyse: ##formattage
	./vendor/bin/phpstan analyse

.PHONY: commit
commit: ##formattage
	./vendor/bin/phpcbf
	./vendor/bin/phpcs
	./vendor/bin/phpstan analyse

