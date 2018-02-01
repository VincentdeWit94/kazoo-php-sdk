ROOT = $(shell readlink -f .)

.PHONY = fmt

CHANGED ?= $(shell git --no-pager diff --name-only HEAD origin/master -- *.php)

FORMATTER ?= ./vendor/bin/phpcbf

fmt: $(FORMATTER)
	$(FORMATTER) $(CHANGED)

$(FORMATTER):
	@$(ROOT)/composer update
