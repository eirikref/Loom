PHPUNIT=./vendor/bin/phpunit
PHPCS=./vendor/bin/phpcs
PHPDOC=./vendor/bin/phpdoc
PHPMD=./vendor/bin/phpmd

all: sniff test doc

test:
	@rm -rf ./build/coverage
	$(PHPUNIT) --coverage-html ./build/coverage

sniff:
	$(PHPCS) --standard=PSR2 ./src ./tests

doc:
	@rm -rf ./build/phpdoc
	$(PHPDOC) -d ./src -t ./build/phpdoc

mess:
	$(PHPMD) src,tests text codesize,controversial,design,naming,unusedcode

clean:
	@rm -rf ./build
