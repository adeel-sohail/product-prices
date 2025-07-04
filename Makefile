.PHONY: save-products tests

save-products:
	php bin/console app:save-product-prices

tests:
	php bin/phpunit

