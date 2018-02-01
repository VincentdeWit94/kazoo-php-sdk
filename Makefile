ROOT = $(shell readlink -f .)

.PHONY = fmt

CHANGED ?= $(shell git --no-pager diff --name-only HEAD origin/master -- *.php)

FORMATTER ?= ./vendor/bin/phpcbf

fmt: $(FORMATTER)
	$(FORMATTER) --standard=$(ROOT)/phpcs_ruleset.xml --config-set default_standard PSR1 $(CHANGED)

$(FORMATTER):
	@$(ROOT)/composer update
	phpcs --config-set default_standard PSR
