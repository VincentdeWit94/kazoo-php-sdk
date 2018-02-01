ROOT = $(shell readlink -f .)

.PHONY = fmt set-defaults

CHANGED ?= $(shell git --no-pager diff --name-only HEAD origin/master -- *.php)

FORMATTER ?= ./vendor/bin/phpcbf
CHECKER ?= ./vendor/bin/phpcs

fmt: $(FORMATTER)
	@$(FORMATTER) $(CHANGED)

$(FORMATTER):
	@$(ROOT)/composer update
	@$(MAKE) set-defaults

set-defaults:
	@$(CHECKER) --config-set default_standard PSR1
	@$(CHECKER) --config-set report_format summary
	@$(CHECKER) --config-set colors 1
	@$(CHECKER) --config-set tab_width 4
