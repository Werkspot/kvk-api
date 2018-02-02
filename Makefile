default: help

help:
	@echo "Usage:"
	@echo "     make [command]"
	@echo "Available commands:"
	@grep '^[^#[:space:]].*:' Makefile | grep -v '^default' | grep -v '^_' | sed 's/://' | xargs -n 1 echo ' -'

coverage:
	rm -rf coverage; ./vendor/bin/phpunit --coverage-html=coverage/ --coverage-clover=coverage/clover.xml

all-tests:
	$(MAKE) unit-tests
	$(MAKE) integration-tests

unit-tests:
	./vendor/bin/phpunit --testsuite unit

integration-tests:
	./vendor/bin/phpunit --testsuite integration

cs-fix:
	./vendor/bin/php-cs-fixer fix --verbose
