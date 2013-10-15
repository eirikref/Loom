PHPUNIT=./vendor/bin/phpunit
PHPCS=./vendor/bin/phpcs
PHPDOC=./vendor/bin/phpdoc.php

all: sniff test doc

test:
	@rm -rf ./build/coverage
	$(PHPUNIT) --coverage-html ./build/coverage

sniff:
	$(PHPCS) --standard=PSR2 ./src ./tests

doc:
	@rm -rf ./build/phpdoc
	$(PHPDOC) -d ./src -t ./build/phpdoc

clean:
	@rm -rf ./build
