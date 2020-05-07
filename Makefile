default: help

help:
	@echo "Usage:"
	@echo "     make [command]"
	@echo "Available commands:"
	@grep '^[^#[:space:]].*:' Makefile | grep -v '^default' | grep -v '^_' | sed 's/://' | xargs -n 1 echo ' -'

fix-code-standards:
	./vendor/bin/php-cs-fixer fix --verbose

test:
	$(MAKE) test-unit
	$(MAKE) test-integration

test-cs:
	vendor/bin/php-cs-fixer fix --verbose --dry-run

test-coverage:
	rm -rf coverage; ./vendor/bin/phpunit --coverage-html=coverage/ --coverage-clover=coverage/clover.xml

test-integration:
	./vendor/bin/phpunit --testsuite integration

test-unit:
	./vendor/bin/phpunit --testsuite unit
