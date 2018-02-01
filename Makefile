ROOT = $(shell readlink -f .)

.PHONY = fmt

CHANGED := $(shell git --no-pager diff --name-only HEAD origin/master -- *.php)

fmt:
