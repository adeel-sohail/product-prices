.PHONY: save-products run-tests

save-products:
	php bin/console app:save-product-prices

run-tests:
	php bin/phpunit

